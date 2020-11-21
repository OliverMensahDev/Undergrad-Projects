<?php
require_once('core/init.php');
if(isset($_GET['email']) && isset($_GET['username'])){
$user = new User;
if($user->prompted($_GET['username'])){
  email($_GET['email'], $_GET['username'],"<i>There are a lot cool topics for discussion on our platform. To activate kindly reply this email with your usrnam and your account will b activated</i>","manageusers.php", "User Successfully emailed");
}
}
 ?>
