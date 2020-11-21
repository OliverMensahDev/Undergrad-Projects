<?php
include('conn/db.php');
$accepted= $_POST['id'];
mysql_query("UPDATE products set accepted=1 where product_id='$accepted'");
 ?>
