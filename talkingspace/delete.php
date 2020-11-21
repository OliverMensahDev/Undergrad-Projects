<?php
require_once("core/init.php");
if (isset($_GET['profile'])) {
  if($_SESSION['user_id']==$_GET['profile']){
    $user = new User;
    if($user->delete($_GET['profile'])){
     redirect("logout.php");
   }
 }
  if(isAdmin()){
    $user = new User;
    if($user->delete($_GET['profile'])){
     redirect("manageusers.php", "Successfully deleted", "success");
   }
 }
else{
   redirect("index.php", "No Permission granted", "error");
 }
}
