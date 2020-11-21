<?php
require_once("core/init.php");
if(isNomalUsr()){
 if(filter_has_var(INPUT_POST,"update")){
   $user = new User;
   $validator = new Validator;
   $data = array();
   $name = sanitise($_POST['name']);
   $data['email'] = sanitise($_POST['email']);
   $data['username'] = sanitise($_POST['username']);
   $data['about'] = htmlentities($_POST['about']);
   $pass      = htmlentities($_POST['password']);
   $data['last_activity'] = date('Y-m-d H:i:s');
   $data['password'] = password_hash($pass, PASSWORD_DEFAULT, array("cost"=>11));
   $array_fields = array('name','email', 'username', 'password');
   if($validator->isRequired($array_fields)) {
     if($user->updateUser($data,$_SESSION['user_id'])){
    redirect("index.php", "User profile successfully updated", "success");
   }else{
     redirect("edit.php", "Update was not successful", "error");
   }
 }else{
   redirect("edit.php", "Fields are required", "error");
 }
}else{
  redirect("index.php", "No Permission granted, This is not your page", "error");
}
}else{
  redirect("index.php", "No Permission granted 2", "error");
}
