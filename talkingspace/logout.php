<?php
include("core/init.php");
if(isNomalUsr()){
$user = new User;
if($user->logout()){
  redirect("index.php", "Successfully logged out", "success");
}}else{
  redirect("index.php","You have not logged in but do you want to log out.", "error");
}
