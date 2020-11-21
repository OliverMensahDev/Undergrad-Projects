<?php
require("core/init.php");
if(isNomalUsr()){
$topic = new Topic;
$template = new Template("templates/create.php");
$template->title = "Talking Space || Create Thread";
$template->getAllCategories = getAllCategories();
function sanitize($data){
  $data = stripslashes($data);
  $data = preg_replace("/[^a-zA-Z0-9\s\p{P}]/", "", $data);
  $data = htmlentities($data);
  return $data;
}
if(filter_has_var(INPUT_POST, "postThread")){
  $data = array();
  $data['category_id'] = sanitize($_POST['category_id']);
  $data['user_id'] = sanitize($_POST['user_id']);
  $data['title'] = sanitize($_POST['title']);
  $data['body'] = sanitize($_POST['body']);
  if($topic->postThread($data)){
    redirect("index.php", "Thread has been successfully created", "success");
  }
}
echo $template;
}
else{
    $error = new Template("templates/error.php");
    echo $error;
  }
