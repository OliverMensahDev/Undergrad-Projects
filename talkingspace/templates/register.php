<?php include 'includes/header.php'; ?>
<div class="col-md-8 col-md-offset-2" style="margin-top:10px;">
<div class="main-col">
<div class="block">
<h4 class="text-center">A simple platform to ask and answer questions</h4>
<?php displayMessage(); ?>
<hr>
<form role="form" enctype="multipart/form-data" method="post" action="register.php" onsubmit="return validate(this)">
  <div class="form-group">
    <label>First Name* </label>
    <input type="text" class="form-control" placeholder="Enter Your Name" name="fname" required
      value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : ''  ?>"
    >
  </div>
  <div class="form-group">
    <label>Last Name* </label>
    <input type="text" class="form-control" placeholder="Enter Your Name" name="lname" required
    value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : ''  ?>"
    >
  </div>
  <div class="form-group">
    <label>Username* </label>
    <input type="text" class="form-control" placeholder="Enter Your Username" name="username" required
    value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''  ?>"
    >
  </div>
<div class="form-group">
  <label>Email address*</label>
  <input type="email" class="form-control" placeholder="Enter Your Email" name="email" required
  value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''  ?>"
  >
</div>
<div class="form-group">
  <label>Password*</label>
  <input type="password" class="form-control"  placeholder="Enter Your Password" name="password" required
  value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''  ?>"
  >
</div>
<div class="form-group">
  <label>Upload your image if you don't want to stay anonymous)</label>
  <input type="file"  name="profile"  id ='image'  accept="image/*" onChange="validateImage(this.value)">
</div>
<div class="form-group">
  <label>About Me</label>
  <textarea class="form-control" rows="5" name="about" required
  ><?php echo isset($_POST['about']) ? $_POST['about'] : ''  ?></textarea>
</div>
<button name="register" type="submit" class="btn btn-success">Register</button>
</form>
<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
window.onload = function(){
  document.getElementById('background').classList.add("background-for-login");
}
//checking image
function validateImage(file) {
  var ext = file.split(".");
  ext = ext[ext.length-1].toLowerCase();
  var arrayExtensions = ["jpg" , "jpeg", "png"];
  if (arrayExtensions.lastIndexOf(ext) == -1) {
    alert("Item selected is not a valid image");
    $("#image").val("");
  }
}

//regex for form inputs
var ck_fname = /^[A-Za-z]{2,40}$/;
var ck_lname = /^[A-Za-z]{2,40}$/;
var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
function validate(form){
	var fname = form.fname.value;
	var lname = form.lname.value;
	var email = form.email.value;

	var errors = [];
	var errors = [];
	if (!ck_fname.test(fname)) {
		errors[errors.length] = "Use valid first name, only letters";
	}
 if (!ck_lname.test(lname)) {
		errors[errors.length] = "Use valid last name, only letters";
	}
 if(!ck_email.test(email)){
		errors[errors.length] = "Use valid email";
	}
  if(errors.length > 0) {
		reportErrors(errors);
		return false;
 }
 return true;
}

function reportErrors(errors){
 var msg = "";
 for (var i = 0; i<errors.length; i++) {
 var numError = i + 1;
  msg += "\n" + numError + ". " + errors[i];
}
 alert(msg);
}

</script>
