<?php
require_once("core/init.php");
if (isset($_GET['thread'])) {
   $template = new Template("templates/editThread.php");
   $template->title = "Edit Thread";
   $topic = new Topic;
   $template->topic = $topic ->getTopicOnly($_GET['thread']);
   $template->getAllCategories = getAllCategories();
   echo $template;
 }else{
   redirect("index.php", "No Permission granted", "error");
 }
