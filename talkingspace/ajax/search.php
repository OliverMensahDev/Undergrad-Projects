<?php
require_once("../config/config.php");
function sanitise($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlentities($data);
  return $data;
}
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        echo("error to con");
    }else{
        $data = isset($_GET["search"])? sanitise($_GET["search"]): null;
        $result = mysqli_query($con,"SELECT title, id FROM topics where title Like'%$data%'");
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
               $data[] = $row;
        }
        echo json_encode($data);
    }
  $con->close();

?>
