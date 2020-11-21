//regex for form inputs
var  ck_username = /^[A-Za-z]{4,20}$/;
var  ck_password =  /^[A-Za-z]{4,20}$/;

// var  ck_username = /^[A-Za-z0-9_]{4,20}$/;
// var ck_password =  /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;

var ck_fname = /^[A-Za-z]{3,40}$/;
var ck_lname = /^[A-Za-z]{3,40}$/;
var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
function validate(form){
	var username = form.username.value;
	var password = form.password.value;
	var fname = form.fname.value;
	var lname = form.lname.value;
	var email = form.email.value;

	var errors = [];
	var gender = document.getElementsByClassName('genderSelect');
	var major = document.getElementById('majorSelect');

	var errors = [];
	if(!ck_username.test(username)) {
	  errors[errors.length] = "Choose valid username .";
	}
	if (!ck_password.test(password)) {
     errors[errors.length] = "Choose words for password but must contain four characters";
	}
	if (!ck_fname.test(fname)) {
		errors[errors.length] = "Use valid first name";
	}
 if (!ck_lname.test(lname)) {
		errors[errors.length] = "Use valid last name";
	}
 if(!ck_email.test(email)){
		errors[errors.length] = "Use valid email";
	}
	if(gender.checked ==false){
		errors[errors.length] = "Please Select Gender type";
  }
  if(major.selectedIndex == 0){
		errors[errors.length] = "Please Select Major type";
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
