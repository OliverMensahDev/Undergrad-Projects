<?php
require('core/init.php');
if(!isNomalUsr()){
$template = new Template('templates/login.php');
$template->title = "Talking Space || Login";
$template->getAllCategories = getAllCategories();
$user = new User;
if(filter_has_var(INPUT_POST, "login")){
  $username = sanitise($_POST['username']);
  $password = sanitise($_POST['password']);
  if($user->login($username, $password)){
    redirect("index.php","Welcome ". $_SESSION['username'], "success");
  }else{
    redirect("login.php","Could not log in. Check your credentials well", "error");
  }
}
echo $template;
}else{
  redirect("index.php","You have already logged in. You cannot log in again", "error");
}
