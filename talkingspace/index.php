<?php
require('core/init.php');
$template = new Template('templates/index.php');
$topic =  new Topic;
$template->title = "Talking Space || Free your mind";
$template->getAllCategories = getAllCategories();
$template->topics = $topic->getAllTopics();
echo $template;
