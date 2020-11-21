<?php
require_once("../config/config.php");
require_once("../libraries/Database.php")
$user = new User;
$delete = $_POST['profile']
if($user->delete($delete)){
   echo "TRUE";
}
else{
  echo "FALSE";
}
}
