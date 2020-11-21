<?php

class Cart extends CI_Controller
{
    public $tax ;
    public $shipping;
    public $total = 0;
    public $total_amount;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
    }


    public function index()
    {
        //load view
  $data['main_content'] = 'cart';
        $this->load->view('layouts/main', $data);
    }

    public function add()
    {
        //Item data
  $data = array(
    'id'=> $this->input->post('item_number'),
    'qty'=> $this->input->post('qty'),
    'price'=> $this->input->post('price'),
    'name'=> $this->input->post('title')
  );
// print_r($data);
 $this->cart->insert($data);
        redirect(null, 'refresh');
    }

    public function update($in_cart = null)
    {
        $data = $_POST;
        $this->cart->update($data);
        redirect('cart', 'refresh');
    }

    public function emptyCart()
    {
        $this->cart->destroy();
        redirect('cart', 'refresh');
    }


    public function sendOnlyEmail()
    {
        //configure email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'mensaholiver08@gmail.com'; // email id
        $config['smtp_pass'] = '0544892841'; // email password
        $config['mailtype'] = 'html';
        $config['wordwrap'] = true;
        $config['charset'] = 'iso-8859-1';
        $config['newline'] = "\r\n"; //use double quotes here
        $this->email->initialize($config);
        $amount = $this->cart->total() + $this->config->item('shipping');
        $message =
        "BUCKET DEALS ONLINE SHOPPING <br>
         <em>shop with us </em>
         <br>
         <br>
         Thank you ". $this->session->userdata('username')." for doing transaction with us. <br>
         Your ordered items and shipping cost <br>
         amounting to GHS ".$amount ."</br>
         <a href='http://localhost/online_shop'> Continue to the page to search for more items</a>";
        $subject = "Ordered Items from Company name here";
        $to_email= $this->session->userdata['email'];
        //send mail
        $this->email->from("mensaholiver08@gmail.com", "Bucket Deals");
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        $check = false;
        foreach ($this->input->post('item_name') as $key => $value) {
                $item_id = $this->input->post('item_code') [$key];
                $product = $this->product_model->get_Product($item_id);
                $order_data = array(
                    'product_id' =>$item_id,
                    'user_id' =>$this->session->userdata('user_id'),
                    'transaction_id' =>0,
                    'qty' =>$this->input->post('item_qty') [$key],
                    'price' =>$subtotal,
                    'address' => "By Email",
                    'address2' => "By Email",
                    'city' => "By Email",
                    'state' => "By Email",
                    'zipcode' => "By Email"
                  );
               
               $check =  $this->product_model->add_order($order_data);
            }
            if($check){
              if ($this->email->send()) {
                $this->session->set_flashdata(
                  "message", "Thanks for the order, you have been sent an email. Kindly go and check your email inbox now");
                 $this->cart->destroy();

            redirect("products");

            }
            else {
            $this->session->set_flashdata("message", "Error in sending email");
            redirect("products");
        }
        }
        else {
            $this->session->set_flashdata("message", "Error while sending data to database");
            redirect("products");
        } 
    }


    public function process()
    {
      //loading mpower library
        include APPPATH . 'third_party/mpower/mpower.php';
        ## Setup your API Keys
        MPower_Setup::setMasterKey("f18e40d3-c7c8-47ef-b2a7-2611177e7648");
        MPower_Setup::setPublicKey("test_public_WHWxGzexuurOo2BGkfwoN_mHyCk");
        MPower_Setup::setPrivateKey("test_private_h9f3ahVfRzVgWJeEWMt2KRFtZhs");
        MPower_Setup::setMode("test");
        MPower_Setup::setToken("427ec7daa710bd37f82e");
          ## Setup your checkout store information
        MPower_Checkout_Store::setName("Bucket  Deals");
        MPower_Checkout_Store::setTagline("Bucket Deals| Ashesi");
        MPower_Checkout_Store::setPhoneNumber("0544892841");
        MPower_Checkout_Store::setPostalAddress("PMB CT3 1243");
        //redirect page when cancel cehckout
        MPower_Checkout_Store::setCancelUrl("http://localhost/online_shop/" );
        //redirect page after succcessfull payment
        MPower_Checkout_Store::setReturnUrl("http://localhost/online_shop/");

        //creating an object of the checkout invoice
        $co = new MPower_Checkout_Invoice();
        if ($_POST) {
      //get each product
        foreach ($this->input->post('item_name') as $key => $value) {

              //set the tax and shipping from config
              $this->tax = $this->config->item('tax');
              $this->shipping = $this->config->item('shipping');

              $item_id = $this->input->post('item_code') [$key];
              $product = $this->product_model->get_Product($item_id);

              $co->addItem($product->title, $this->input->post('item_qty') [$key], $product->price, $this->input->post('item_qty') [$key] * $product->price);
            //total
              $subtotal = $product->price * $this->input->post('item_qty') [$key];
              $this->total = $this->total + $subtotal;

            //order array  to add to order Table
              $order_data = array(
              'product_id' =>$item_id,
              'user_id' =>$this->session->userdata('user_id'),
              'transaction_id' =>0,
              'qty' =>$this->input->post('item_qty') [$key],
              'price' =>$subtotal,
              'address' => $this->input->post('address'),
              'address2' => $this->input->post('address2'),
              'city' => $this->input->post('city'),
              'state' => $this->input->post('state'),
              'zipcode' => $this->input->post('zipcode')
            );
          }
          //get grand total
          $this->total_amount = $this->total + $this->shipping + $this->tax;
              }

              if ($co->setTotalAmount($this->total_amount)) {
                  foreach ($order_data as $value) {
                    //saving to database
                    $this->product_model->add_order($value);
                  }
              }
              if ($co->create()) {
                  header("Location: ".$co->getInvoiceUrl());
              } 
              if($co->return_url =="http://localhost/online_shop/"){
                $this->cart->destroy();
                 $this->session->set_flashdata("thanks_for_order", "Thanks for the order");
              }
            }
          }
