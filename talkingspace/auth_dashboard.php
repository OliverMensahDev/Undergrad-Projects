<?php
require("core/init.php");
if (isAdmin()) {
  $template = new Template("templates/admin_dashboard.php");
  $users = new User;
  $topics = new Topic;
  $template->title= "Administrative Usage";
  $template->totalUsers = $users->allUsrs();
  $template->totalTopics = $topics->getTotaltopics();
  $template->totalComments = $topics->getTotalComments();
  $template->totalActiveUsers = $users->allActiveUsrs();
  echo $template;

}else{
  redirect("authuser.php", "Cannot access this page","error");
}
