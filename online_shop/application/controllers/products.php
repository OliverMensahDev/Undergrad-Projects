<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Products extends CI_Controller
{
  //constructor
    public function __construct()
    {
      parent::__construct();
      $this->load->library("pagination");
    }
    //index page method
    public function index()
    {

      $data['title'] ="A Place to get Affordable Clothes";
      $data['products'] = $this->product_model->get_ProductslimitBy8();
      $data['main_content'] ='products';
      $this->load->view('layouts/main', $data);
    }
    //get product details method
    public function details($id)
    {
      $data['title'] ="Details of Product";
      $data['product'] = $this->product_model->get_Product($id);
      $data['main_content'] ='details';
      $this->load->view('layouts/main', $data);
    }
     //get products by category id  method
    public function category($id)
    {
      $config['base_url'] = base_url()."products/category/".$id;
      $config['total_rows'] = $this->product_model->total_product_per_category($id);
      $config['per_page'] = 2;
      $choice = $config["total_rows"] / $config["per_page"];
      $config["num_links"] = floor($choice);
      $config["uri_segment"] = 4;
      $config['full_tag_open'] = '<ul class="pagination">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['prev_link'] = '&laquo';
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = '&raquo';
      $config['next_tag_open'] = '<li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
      $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      $data['title'] = "All Products in " . serialize($this->product_model->get_categoryName($id));
      $data['categories'] = $this->product_model->get_productByCat($id,$config["per_page"], $page);
      $data['pagination'] = $this->pagination->create_links();
      $data['main_content'] ='category';
      $this->load->view('layouts/main', $data);
    }
  //all products page controller method
  public function all()
  {
    $config['base_url'] = base_url()."products/all/";
    $config['total_rows'] = $this->product_model->total_product_count();
    $config['per_page'] = 6;
    $choice = $config["total_rows"] / $config["per_page"];
    $config["num_links"] = floor($choice);
    $config["uri_segment"] = 3;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data['title'] ="All Products";
    $data['allProducts'] =  $this->product_model->get_Products($config["per_page"], $page);
    $data['pagination'] = $this->pagination->create_links();
    $data['main_content'] ='allProducts';
    $this->load->view('layouts/main', $data);
  }
  //search by name and category id]
  public function search()
  {
    $data['title'] = "Search Results";
    $data['search'] = $this->product_model->getProduct(ucwords($this->input->post('name')), $this->input->post('category'));
    $data['main_content'] ='search';
    $this->load->view('layouts/main', $data);
  }
  //add category method
  public function addCategory()
  {
      if ($this->product_model->checkCat(ucwords($this->input->post('category')))==0) {
          if ($this->product_model->insertCat()) {
              $this->session->set_flashdata("cat_added", "A new catgory has been added", 300);
              redirect('dashboard');
          }
      } else {
          $this->session->set_flashdata("cat_failed", "Category already exist", 300);
          redirect('dashboard');
      }
  }
  //add product method
    public function addProduct()
    {
        if ($this->product_model->checkProduct(ucwords($_POST['title']), $_POST['category_id'], $_POST['price'], $_POST['description'])) {
            if ($this->product_model->addProduct()) {
                $this->session->set_flashdata("product_added", "A new product has  been added", 300);
                redirect("dashboard");
            } else {
                $this->session->set_flashdata("product_failed", "could not be added", 300);
                redirect("dashboard");
            }
        } else {
            $this->session->set_flashdata("product_exist", "Product already exist", 300);
            redirect('dashboard');
        }
    }
    //edit product information
    public function edit($id, $path)
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
        $this->form_validation->set_rules('category_id', 'Category ID', 'trim|required|xss_clean');
        $data['product'] = $this->product_model->get_Product($id);
        if ($this->form_validation->run() == false) {
            $data['main_content'] = 'editProduct';
            $this->load->view('layouts/mainUser', $data);
        } else {
            if ($this->product_model->edit($id, $path)) {
                $this->session->set_flashdata("product_edited", "Successfully edited an item", 300);
                redirect("dashboard");
            }
        }
    }
    //delete product information
    public function delete($id, $path)
    {
        if ($this->product_model->delete($id)) {
            $absolute_path = FCPATH . "uploads/".$path;
            $username = "olivermensah";
            chown($absolute_path, $username);
            unlink($absolute_path);
            $this->session->set_flashdata("product_deleted", "Successfully deleted an item", 300);
            redirect("dashboard");
        } else {
            $this->session->set_flashdata("product_not_deleted", "Could not delete an item", 300);
            redirect("dashboard");
        }
    }
    //edit catagory method
    public function editCategory($id)
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[3]|xss_clean');
        $data['category'] = $this->product_model->get_category($id);
        if ($this->form_validation->run() == false) {
            $data['main_content'] = 'editCategory';
            $this->load->view('layouts/mainUser', $data);
        } else {
            if ($this->product_model->editCategory($id)) {
                $this->session->set_flashdata("category_edited", "Successfully edited category", 300);
                redirect("dashboard");
            }
        }
      }
      //delete category  by id
    public function deleteCategory($id)
    {
        if ($this->product_model->deleteCategory($id)) {
            $this->session->set_flashdata("category_edited", "Successfully deleted a category", 300);
            redirect("dashboard");
        }
    }
}
