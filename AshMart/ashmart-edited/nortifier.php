<?php
include('header.php');
include ("session.php");
$query = mysql_query("SELECT  firstname, lastname FROM student_post WHERE stdPost_id=$session_id ");
$row = mysql_fetch_array($query);
$fname =$row['firstname'];
$lname = $row['lastname'];
$name = $fname . " " . $lname;
?>
<body class='well'>
  <?php include('nav.php') ?>
  <h4 class="  alertPaddingTop">

  </h4>
  <div class="container-fluid  nortifier">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <h1> Hello  <?php echo $name; ?></h1>
        <p>
          It is great you have decided to sell your item via our platform. <br>
          For security reasons, your posted item will be verified and made available
          within the next 5 minutes.
        </p>
        <p>
          You can now logout if you have nothing more to sell.
        </p>
        <h4 class=" alert alert-success alertPaddingTop">
          <div class=" muted pull-left">&nbsp;</div>
          <div  class=" muted pull-right"><a  title="Click to Logout" href="seller_logout.php">Logout</a></div>
        </h4>
      </div>
      <div class="col-md-3">
      </div>
    </div>
  </div>
</body>
</html>
