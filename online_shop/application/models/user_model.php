<?php
class User_model extends CI_Model{
  public function register(){
    $data = array(
      'firstname' =>$this->security->xss_clean($this->input->post('firstname')),
      'lastname' =>$this->security->xss_clean($this->input->post('lastname')),
      'email' =>$this->security->xss_clean($this->input->post('email')),
      'username' =>$this->input->post('username'),
      'password' =>$this->security->xss_clean(md5($this->input->post('password')))
    );
    return $this->db->insert('users',$data);
  }

//check if user exist
  public function verify($username){
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('username',$username);
    if($this->db->get()->num_rows() == 0){
      return true;
    }
    else{
      return false;
    }
  }

  //login
  public function login($username, $password){
    $this->db->select("*");
    $this->db->from("users");
    $this->db->where('username',$username);
    $this->db->where('password',$password);
    $result = $this->db->get();
    if($result->num_rows() == 1){
      $logged_in_data = array(
        "logged_in" => true,
        "username"  => $result->row(0)->username,
        "email"     => $result->row(0)->email,
        "user_id"     => $result->row(0)->id,
        "name"      => $result->row(0)->firstname . " ". $result->row(0)->lastname
      );
      $this->session->set_userdata($logged_in_data);
     return true;
    }else {
      return false;
    }
  }
}
