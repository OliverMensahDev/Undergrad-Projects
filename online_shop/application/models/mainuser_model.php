<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mainuser_model extends CI_Model{
  //login
  public function login($username, $password){
    $this->db->where('username',$username);
    $this->db->where('password',$password);
    $result = $this->db->get("admin");
    if($result->num_rows() == 1){
      return $result->row(0)->id;
    }else {
      return false;
    }
  }

}
