<?php
class Product_model extends CI_Model{
  // Get total product based on Category id
  public function total_product_per_category($id)
  {
    $this->db->select('*');
    $this->db->from("products");
    $this->db->where("products.category_id", $id);
    return $this->db->count_all_results();
  }
  // Get total product  in the database
  public function total_product_count()
  {
    return $this->db->count_all("products");
  }
  // Get all products
  public function get_Products($limit, $start)
  {
        $this->db->limit($limit, $start);
        $query = $this->db->get("products");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
  //get only 6 items
  public function get_ProductslimitBy8(){
    $this->db->select('*');
    $this->db->from('products');
    $this->db->order_by("id","desc");
    $this->db->limit(6);
    return $this->db->get()->result();
  }
  //get a  single product
  public function get_Product($id){
      $this->db->select('*');
      $this->db->from('products');
      $this->db->where('id', $id);
      return $this->db->get()->row();
    }
    //get categories
  public function get_categories(){
        $this->db->select('*');
        $this->db->from('categories');
        return $this->db->get()->result();
      }
    //get categories
  public function get_category($id){
    $this->db->select('*');
    $this->db->from("categories");
    $this->db->where('id', $id);
    return $this->db->get()->row();
      }
      //get name of category using its id
  public function get_categoryName($id){
    $this->db->select('name');
    $this->db->from("categories");
    $this->db->where('id', $id);
    return $this->db->get()->row();
      }
      //get most popular products base on orders
  public function get_popular(){
        $this->db->select('P.*,COUNT(O.product_id) as total');
        $this->db->from('orders as O');
        $this->db->join('products as P', 'O.product_id=P.id','INNER');
        $this->db->group_by('O.product_id');
        $this->db->order_by('total','desc');
        $this->db->limit(5);
        return $this->db->get()->result();
      }

      // Get all products
        public function get_productByCat($id,$limit, $start){
          $this->db->select('products.*,categories.name');
          $this->db->from('products');
          $this->db->join('categories', 'products.category_id=categories.id','INNER');
          $this->db->where('products.category_id', $id);
          $this->db->limit($limit, $start);
          $this->db->order_by("products.id","desc");
          return $this->db->get()->result();
        }
          // Get all products and its category
        public function getProducts(){
          $this->db->select('products.*,categories.name');
          $this->db->from('products');
          $this->db->join('categories', 'products.category_id=categories.id','INNER');
          $this->db->order_by("products.id","desc");
          return $this->db->get()->result();
        }
        //check category name exists
          public function checkCat($name){
            $this->db->select('*');
            $this->db->from('categories');
            $this->db-> where('name',$name);
            return $this->db->get()->num_rows();
          }

          //Insert Category
          public function insertCat(){
            $data = array(
              'name' =>ucwords($this->input->post('category'))
            );
            return $this->db->insert('categories',$data);
          }

          //check category name exists
            public function checkProduct($title, $category_id, $price, $description){
              $this->db->select('*');
              $this->db->from('products');
              $this->db-> where('title',$title);
              $this->db-> where('category_id',$category_id);
              $this->db-> where('price',$price);
              $this->db-> where('description',$description);
              if($this->db->get()->num_rows()==0){
                return true;
              }else{
                return false;
              }
            }

        //add new product
        public function addProduct(){
          $data = array(
            'category_id' => $this->security->xss_clean($_POST['category_id']),
            'title' => ucwords($this->security->xss_clean($_POST['title'])),
            'description' => $this->security->xss_clean($_POST['description']),
            'price' => $this->security->xss_clean($_POST['price'])
          );
          //setting  image preferences
          $config['upload_path'] = 'uploads/';
          $config['overwrite'] = false;
          $config['allowed_types'] = 'jpg|png|jpeg|PNG|JPEG|JPG';
          $config['quality'] = '100%';
          $config['remove_spaces'] = true;
          $config['max_size']  = '90';// in KB
          $this->load->library('upload',$config);
          if( ! $this->upload->do_upload('image'))
          {
            $this->session->set_flashdata('message_failed', $this->upload->display_errors('', ''));
            redirect('dashboard');
          }else{
            $image = $this->upload->data();
            if($image['file_name']){
              //Image Resizing
              $config['source_image'] = "uploads/".$image['file_name'];
              $config['maintain_ratio'] = FALSE;
              $config['width'] = 311;
              $config['height'] = 162;
              $this->load->library('image_lib',$config);
              if ( ! $this->image_lib->resize()){
                $this->session->set_flashdata('message_failed', $this->image_lib->display_errors('', ''));
                redirect("dashboard");
              }
              $data['image'] = $image['file_name'];
            }
          }
         return   $this->db->insert('products', $data);
        }

        //get product base on name and category id
        public function getProduct($name, $category_id){
            $this->db->select('*');
            $this->db->from('products');
            $this->db->like('title', $name);
            $this->db->like('category_id', $category_id);
            return $this->db->get()->result();
          }
          //add orders to db
          public function add_order($order_data){
            return $this->db->insert("orders", $order_data);
          }

          //edit function
          public function edit($id, $path)
          {
            $data = array(
              'category_id' => $this->security->xss_clean($_POST['category_id']),
              'title' => ucwords($this->security->xss_clean($_POST['title'])),
              'description' => $this->security->xss_clean($_POST['description']),
              'price' => $this->security->xss_clean($_POST['price'])
          );
          //setting  image preferences
          $config['upload_path'] = 'uploads/';
          $config['overwrite'] = false;
          $config['allowed_types'] = 'jpg|png|jpeg|PNG|JPEG|JPG';
          $config['quality'] = '100%';
          $config['remove_spaces'] = true;
          $config['max_size']  = '90';// in KB
          $this->load->library('upload',$config);
          if(  $this->upload->do_upload('image'))
          {
            $image = $this->upload->data();
            if($image['file_name']){
              //Image Resizing
              $config['source_image'] = "uploads/".$image['file_name'];
              $config['maintain_ratio'] = FALSE;
              $config['width'] = 311;
              $config['height'] = 162;
              $this->load->library('image_lib',$config);
              if ( ! $this->image_lib->resize()){
                $this->session->set_flashdata('message_failed', $this->image_lib->display_errors('', ''));
                redirect("dashboard");
              }
              $data['image'] = $image['file_name'];
              $absolute_path = FCPATH . "uploads/".$path;
              $username = "olivermensah";
              chown($absolute_path, $username);
              unlink($absolute_path);
            }
          }
            $this->db->where("id", $id);
            return $this->db->update("products", $data);
            }
          //edit function
          public function editCategory($id)
          {
            $data = array(
              'name' => $this->security->xss_clean($_POST['name']),
          );
            $this->db->where("id", $id);
            return $this->db->update("categories", $data);
            }

            public function delete($id)
            {
               $this->db->where("id", $id);
               return $this->db->delete("products");
            }
            public function deleteCategory($id)
            {
               $this->db->where("id", $id);
               return $this->db->delete("categories");
            }
          }
