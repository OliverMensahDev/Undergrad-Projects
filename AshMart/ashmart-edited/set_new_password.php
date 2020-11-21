<?php include('header.php');
?>
<body class="well">
<?php include('nav.php') ?>
<h4 class="alert alert-success alertPaddingTop" style="font-weight:bold; text-align:center;">
Enter a  New Password
</h4>
<div >
  <div class="container-fluid  login">
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

</div>
<?php
if (isset($_POST['submit'])) {
$phone = strip_tags($_POST['phone']);
$email = strip_tags($_POST['email']);
$query= mysql_query("SELECT * from student_post where email='$email' and phone_number ='$phone'") or die(mysql_error());
if($query){
header('Location:set_new_password.php');
exit();
}
}
?>

</body>
</html>
