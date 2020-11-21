<?php
require_once("../config/config.php");
require_once("../libraries/Database.php");
require_once("../libraries/Topic.php");
$topic = new Topic;
$uid = $_POST['uid'];
$tid = $_POST['tid'];
$body= $_POST['body'];
if($topic->replyToreply($uid,$tid, $body)){
  echo "TRUE";
}else{
 echo "FALSE";
}

?>
