<?php include('header.php');
?>
<body class="well">
<?php include('nav.php') ?>
<h4 class="alert alert-success alertPaddingTop" style="font-weight:bold; text-align:center;">
Provide New Password
</h4>
<div >
  <div class="container-fluid  login">
  					<form method="post" role="form">
  				    <div class="form-group">
  				      <label for="username">Password</label>
  				      <input type="password" class="form-control" name="pass" placeholder=' Enter a new password' required>
  				    </div>
  				  <button type="submit" name="reset" class="btn btn-primary"><i class="icon-signin"></i>Reset Password</button>
  					</form>
  				</div>

</div>
<?php
$getEmail = $_GET['email'];
if (isset($_POST['reset'])) {
  $pass = strip_tags($_POST['pass']);
  $hass = md5($pass);
  mysql_query("UPDATE student_post SET password='$hass' where email='$getEMail'");
}
?>
</body>
</html>
