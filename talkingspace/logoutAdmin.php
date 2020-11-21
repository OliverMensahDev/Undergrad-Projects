<?php
include("core/init.php");
if(isAdmin()){
$user = new User;
if($user->logOutAdmin()){
  redirect("authuser.php", "Successfully logged out", "success");
}}else{
  redirect("authuser.php","You have not logged in but do you want to log out.", "error");
}
