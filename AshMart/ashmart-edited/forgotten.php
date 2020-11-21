<?php include('header.php');
?>
<body class="well">
<?php include('nav.php') ?>
<h4 class="alert alert-success alertPaddingTop" style="font-weight:bold; text-align:center;">
Please Provide your Email and Phone Number to reset the password
</h4>
  <div class="container-fluid  ">
  					<div class="row">
              <div class="col-md-4">
              </div>
              <div class="col-md-4 login">
                <form method="post" role="form">
      				    <div class="form-group">
      				      <label for="username">Email</label>
      				      <input type="email" class="form-control" name="email" placeholder=' Email should be lowercase' required>
      				    </div>
      				  <div class="form-group">
      				    <label for="phone">Phone:</label>
      				    <input type="tell" class="form-control" name="phone"  required>
      				  </div>
      				  <button type="submit" name="submit" class="btn btn-primary"><i class="icon-signin"></i>Submit</button>
      					</form>
              </div>
              <div class="col-md-4">
              </div>

  					</div>
  				</div>
<?php
if (isset($_POST['submit'])) {
  $phone = strip_tags($_POST['phone']);
  $email = strip_tags($_POST['email']);
  $query= mysql_query("SELECT * from student_post where email='$email' and phone_number ='$phone'") or die(mysql_error());
  $num_row = mysql_num_rows($query);
  if($num_row==1){
    $row=mysql_fetch_array($query);
    $fname = $row['firstname'];
    $lname = $row['lastname'];
    $oname = $row['othername'];
    $phash= $row['pass'];
    $name = $fname . " ". $oname ." ". $lname;
    $email= $row['email'];
?>
<script type="text/javascript">
  alert("User Information  Exist");
  window.location ="reset.php?name=<?php echo urldecode($name);?>&email=<?php echo urldecode($email);?>&nphref=<?php echo urlencode($phash);?>";
</script>
<?php
    }else{
    ?>
    <script>
    if(alert("Wrong Credentials, User Information do NOT Exist")){
    window.location="forgotten.php";
  }
    </script>
    <?php
  }

}
?>
</body>
</html>
