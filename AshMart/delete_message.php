<?php
include('conn/db.php');
$id = $_POST['id'];
mysql_query("DELETE FROM feedback where id='$id'");
 ?>
