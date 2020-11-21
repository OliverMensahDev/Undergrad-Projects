<?php
class Users extends CI_Controller{
  public function register(){
    //form validation_errors
    $this->form_validation->set_rules('firstname','First Name', 'trim|required');
    $this->form_validation->set_rules('lastname','Last   Name', 'trim|required');
    $this->form_validation->set_rules('email','Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('username','Username', 'trim|required|min_length[6]|max_length[50]');
    $this->form_validation->set_rules('password','Password', 'trim|required|min_length[6]|max_length[50]');
    $this->form_validation->set_rules('password2','Confirm Password', 'trim|required|matches[password]|min_length[6]|max_length[50]');
    if($this->form_validation->run()==FALSE){
      $this->session->set_flashdata('could_not_register', "oops...Error .  Make sure passwords are the same. Username and password has a minimum length of 6 ",300);
      redirect('products');
  }else{
      if($this->user_model->verify($this->input->post('username'))){
        if($this->user_model->register()){
          $this->session->set_flashdata("registered", "You have registered, you can now login",300);
          redirect('products');
      }
    }else{
      $this->session->set_flashdata("could_not_register", "User name exit");
      redirect('products');
    }
  }
  }
  //user login
  public function login()
  {
    $this->form_validation->set_rules('username','Username', 'trim|required|min_length[6]|max_length[50]');
    $this->form_validation->set_rules('password','Password', 'trim|required|min_length[6]|max_length[50]');
    $username = $this->input->post('username');
    $password = md5($this->input->post('password'));
    if($this->user_model->login($username, $password)){
      $this->session->set_flashdata("pass_login", $this->session->userdata("name"). ", you are warmly welcomed. You can checkout your order if you have ordered");
      redirect('products');
    }else{
      $this->session->set_flashdata("fail_login","Sorry login is not valid");
      redirect('products');
    }
  }
  public function logout()
  {
    //unset all
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('name');
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('logged_in');
    $this->session->sess_destroy();
    $this->session->set_flashdata("logout","You successfully logged out");
    redirect('products');
  }
}
