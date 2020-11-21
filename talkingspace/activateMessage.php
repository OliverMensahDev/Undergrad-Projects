<?php
require_once('core/init.php');
if(isset($_GET['email']) && isset($_GET['username'])){
$user = new User;
if($user->activate($_GET['username'])){
  email($_GET['email'], $_GET['username'],"<i>You account has been activated</i>", "User Successfully emailed");
}
}
 ?>
