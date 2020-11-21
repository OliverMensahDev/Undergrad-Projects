<?php
require('core/init.php');
if(isNomalUsr()){
  $template = new Template('templates/movies.php');
  $template->title = "Talking Space || Movies";
  $template->getAllCategories = getAllCategories();
  echo $template;
}else{
  redirect("index.php","Permission Denied to access this page.", "error");
}
