<?php
require('core/init.php');
if(isset($_GET['category'])){
$template = new Template('templates/categories.php');
$topic =  new Topic;
$template->title = "Talking Space || Categories";
$template->getAllCategories = getAllCategories();
$template->topics = $topic->getByCategory($_GET['category']);
$template->category = $topic->getCategory($_GET['category']);
echo $template;
}
