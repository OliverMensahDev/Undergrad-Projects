<?php
require("core/init.php");
if (isAdmin()) {
  $template = new Template("templates/manageusers.php");
  $users = new User;
  $template->title= "Administrative Usage";
  $template->totalUsers = $users->getUsers();
  echo $template;

}else{
  redirect("authuser.php", "Cannot access this page","error");
}
