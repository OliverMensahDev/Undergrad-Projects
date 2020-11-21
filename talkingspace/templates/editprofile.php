<?php include 'includes/header.php'; ?>
<div class="col-md-8 col-md-offset-2" style="margin-top:50px;">
<div class="main-col">
<div class="block">
<h4 class="text-center">Edit Profile Page</h4>
<?php displayMessage(); ?>
<hr>
<form role="form"  method="post" action="update.php">
  <div class="form-group">
    <label>Full Name* </label>
    <input type="text" class="form-control" placeholder="Enter Your Name" name="name" required
    value="<?php echo $user->name?>">
  </div>
  <div class="form-group">
    <label>Username* </label>
    <input type="text" class="form-control" placeholder="Enter Your Username" name="username"  required
    value="<?php echo $user->username ?>">
  </div>
<div class="form-group">
  <label>Email address*</label>
  <input type="email" class="form-control" placeholder="Enter Your Email" name="email" required
  value="<?php echo $user->email ?>">
</div>
<div class="form-group">
  <label>Password*</label>
  <input type="password" class="form-control"  placeholder="Enter Your Password" name="password" required
  value="<?php echo $user->password ?>">
</div>
<div class="form-group">
  <label>About Me</label>
  <textarea class="form-control" rows="5" name="about" required><?php echo $user->about ?></textarea>
</div>
<button name="update" type="submit" class="btn btn-success">Update</button>
</form>
<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
window.onload = function(){
  document.getElementById('background').classList.add("background-for-login");
}

</script>
