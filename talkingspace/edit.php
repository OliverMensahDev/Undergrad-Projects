<?php
require_once("core/init.php");
if (isset($_GET['profile'])) {
 if($_SESSION['user_id']==$_GET['profile']){
   $user = new User;
   $template = new Template("templates/editprofile.php");
   $template->title = "Edit User";
   $template->user = $user->getUser($_GET['profile']);
   echo $template;
 }else{
   redirect("index.php", "No Permission granted", "error");
 }
}else{
  redirect("index.php", "No Permission granted", "error");
}
