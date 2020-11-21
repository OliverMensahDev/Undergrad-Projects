<?php
require_once("../config/config.php");
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        echo("error to con");
    }else{
        $result = mysqli_query($con,"SELECT replies.* , users.username FROM replies
          INNER JOIN users on replies.user_id = users.id  ORDER BY replies.id DESC");
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    }
  $con->close();

?>
