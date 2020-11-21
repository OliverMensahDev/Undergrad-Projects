<?php
require('core/init.php');
$template = new Template('templates/topic.php');
$topic =  new Topic;
$template->title = "Talking Space || Free your mind";
$template->getAllCategories = getAllCategories();
if(isset($_GET['topic'])){
  $template->topic = $topic->getTopic($_GET['topic']);
  $template->replies = $topic->getReplies($_GET['topic']);
  $template->totalReplies = $topic->getTotalReplies($_GET['topic']);
  echo $template;
}
