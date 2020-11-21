<?php
require_once("../config/config.php");
require_once("../libraries/Database.php");
require_once("../libraries/Topic.php");
$topic = new Topic;
$uid = $_POST['uid'];
if($topic->deleteReply($uid)){
  echo "TRUE";
}else{
 echo "FALSE";
}

?>
