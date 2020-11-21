
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

//chcking name username email and passwor
var title = /^[A-Za-z ]{5,40}$/;
var des = /^[\w]$/;
function validate(form){
var name = form.title.value;
var desc = form.description.value;


var errors = [];

 if(!ck_name.test(title)) {
errors[errors.length] = "You must have valid product name.";
 }
 if (!ck_email.test(desc)) {
  errors[errors.length] = "You must have proper description of product ";
 }
 if (errors.length > 0) {
  reportErrors(errors);
  return false;
 }
  return true;
}

function reportErrors(errors){
 var msg = "Please Enter Valid Data...\n";
 for (var i = 0; i<errors.length; i++) {
 var numError = i + 1;
  msg += "\n" + numError + ". " + errors[i];
}
 alert(msg);
}
