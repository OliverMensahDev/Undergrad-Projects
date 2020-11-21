<?php
include('conn/db.php');
$id = $_POST['id'];
mysql_query("DELETE FROM products where product_id='$id'");
mysql_query("DELETE FROM student_post where stdPost_id='$id'");
 ?>
