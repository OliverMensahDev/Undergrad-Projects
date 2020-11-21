<?php
require_once("../config/config.php");
require_once("../libraries/Database.php");
require_once("../libraries/Topic.php");
$topic = new Topic;
$uid = $_POST['uid'];
$body= $_POST['body'];
if($topic->updateComment($uid,$body)){
  $row = $topic->getReply($uid);
  echo json_encode($row);
}else{
 echo "FALSE";
}

?>
