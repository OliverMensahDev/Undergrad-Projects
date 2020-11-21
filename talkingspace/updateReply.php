<?php
require_once("core/init.php");
$user = new User;
$uid = $_POST['user_id'];
$body= $_POST['bodyd'];
if($user->updateComment($uid,$body)){
   redirect("index.php", "No Permission granted", "error");
 }else{
  redirect("index.php", "errror", "error");
}
