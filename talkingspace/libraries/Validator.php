<?php
/**Oliver Mensah
* Validation class
*
*
*/
class Validator{
/**
*valid required fields
**/
 public function isRequired($array_fields)
  {
     $empty = array();
    foreach ($array_fields as $field) {
      if($_POST[''.$field]==""){
        array_push($empty, $field);
        return $empty;
      }else {
        return true;
      }
    }
  }

/**
*isValidEmail
*@param $email
*/
  public function isValidEmail($email)
  {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      return true;
    }else{
      return false;
    }
  }
  /**
  *passwordMatch
  *@param $p1, $p2
  */
  public function passwordMatch($p1, $p2)
  {
    if($p1==$p2){
      return true;
    }else{
      return false;
    }
  }

}
