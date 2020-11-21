<?php
require('core/init.php');
  $template = new Template('templates/users.php');
  $topic =  new Topic;
  $template->title = "Talking Space || User Profile";
  $template->getAllCategories = getAllCategories();
  if(isset($_GET['user'])){
    $template->user = $topic->getUser($_GET['user']);
    $template->postedTopics = $topic->getUserTopics($_GET['user']);
    $template->postedReplies = $topic->getUserReplies($_GET['user']);
    echo $template;
}else{
  redirect("index.php","Permission Denied to access this page.", "error");
}
