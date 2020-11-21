<?php
require("core/init.php");
if(isAdmin()){
  redirect("auth_dashboard.php");
}else{
$template = new Template("templates/adminlogin.php");
$template->title = "Free Your mind || Admin Login";
$user = new User;
if(isset($_POST['do_login'])){
  $phone = $_POST['email'];
  $password = $_POST['password'];
  if($user->loginAdmin($phone, $password))
  {
    redirect("auth_dashboard.php", "Successfully Logged in", "success");
  }
  else{
    redirect("authuser.php", "Could not logged in", "error");
  }
}
echo $template;
}
