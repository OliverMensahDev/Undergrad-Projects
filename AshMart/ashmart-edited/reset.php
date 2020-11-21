<?php include('header.php');
?>
<body class="well">
<?php include('nav.php') ?>
<h4 class="alert alert-success alertPaddingTop" style="font-weight:bold; text-align:center;">
Your Account Information
</h4>
<div >
  <div class="container-fluid  ">
  <div class="row">
    <div class="col-md-4"
    </div>
    <div class="col-md-4  login">
      <?php
      $getEmail = $_GET['email'];
      $getname  = $_GET['name'];
      $getPass = $_GET['nphref'];
      ?>
      <h4>Name: <?php echo $getname ;?></h4>
      <h4>Email: <?php echo $getEmail ;?></h4>
      <h4>Password: <?php echo $getPass; ?></h4>
    </div>
    <div class="col-md-4">

    </div>

  </div>

</div>
</div>
</body>
</html>
