<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  function index()
  {
    $data['categories'] = $this->product_model->get_categories();
    $data['products'] = $this->product_model->getProducts();
    $data['main_content'] = 'dashboard';
    $this->load->view('layouts/mainUser', $data);
  }
  }
