<?php
class MainUser extends CI_Controller{
  public function index(){
    $data['main_content'] ='mainUser';
    $this->load->view('layouts/mainUser', $data);
  }
  //user login
  public function login()
  {
    $this->form_validation->set_rules('username','Username', 'trim|required|min_length[6]|max_length[50]');
    $this->form_validation->set_rules('password','Password', 'trim|required|min_length[6]|max_length[50]');
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $user_id = $this->mainuser_model->login($username, $password);
    if($user_id){
      //create session of user data
      $data = array(
        'user_id'=>$user_id,
        'username'=>$username,
        'admin_logged_in'=>true
      );
      $this->session->set_userdata($data);
      $this->session->set_flashdata("pass_login","You are logged in");
      redirect('dashboard');
    }else{
      $this->session->set_flashdata("fail_logined","Sorry login is not valid");
      redirect('mainUser');
    }
  }
  public function logout()
  {
    //unset all
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('logged_in');
    $this->session->sess_destroy();
    $this->session->set_flashdata("logout","You successfully logged out");
    redirect('products');
  }
  //add category
  public function addCategory(){

  }
}
