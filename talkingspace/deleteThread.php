<?php
require_once("core/init.php");
if (isset($_GET['thread'])) {
   $topic = new Topic;
   if($topic->deleteThread($_GET['thread'])){
     redirect("users.php?user=".$_SESSION['user_id'], "Thread Successfully deleted", "successs");
   }
}else{
   redirect("index.php", "No Permission granted", "error");
 }
