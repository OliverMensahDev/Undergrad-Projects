<?php
require_once("core/init.php");
if(isNomalUsr()){
  function sanitize($data){
    $data = stripslashes($data);
    $data = preg_replace("/[^a-zA-Z0-9\s\p{P}]/", "", $data);
    $data = htmlentities($data);
    return $data;
  }
  if(filter_has_var(INPUT_POST, "postUpdate")){
    $topic = new Topic;
    $data = array();
    $data['category_id'] = sanitize($_POST['category_id']);
    $data['user_id'] = sanitize($_POST['user_id']);
    $data['title'] = sanitize($_POST['title']);
    $data['body'] = sanitize($_POST['body']);
    $data['id'] = sanitize($_POST['topic_id']);
    if($topic->updateThread($data,$data['id'])){
      redirect("users.php?user=".$_SESSION['user_id'], "Thread has been successfully updated", "success");
    }
  }
}else{
  redirect("index.php", "No permission", "success");
}
