<?php include 'includes/header.php'; ?>
<?php displayMessage(); ?>
<div class="col-md-4 col-md-offset-4" style="margin-top:50px;">
<div class="main-col">
<div class="block">
<h4 class="text-center">A platform for discussing various topics.</h4>
<hr>
<br>
<form role="form"  method="post" action="login.php">
<div class="form-group">
  <label>Username</label>
  <input type="text" class="form-control" placeholder="Enter Your username" name="username" required>
</div>
<div class="form-group">
  <label>Password</label>
  <input type="password" class="form-control"  placeholder="Enter Your Password" name="password" required>
</div>
<button type="submit" class="btn btn-success" name="login">Login</button>
<br>
<br>
<div align="center">
  <a href="<?php echo BASE_URL?>register.php" class="btn btn-primary">No Account? Register Here</a>
</div>
</form>
<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
window.onload = function(){
  document.getElementById('background').classList.add("background-for-login");
}
</script>
