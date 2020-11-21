<?php
require('core/init.php');
if(isNomalUsr()){
  $template = new Template('templates/moviedetails.php');
  $template->title = "Talking Space || Movie Details";
  $template->getAllCategories = getAllCategories();
  echo $template;
}else{
  redirect("index.php","Permission Denied to access this page.", "error");
}
