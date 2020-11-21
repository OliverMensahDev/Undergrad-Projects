function validate(){
var fname = $('#fname').val().replace(/\s/g, '').toLowerCase();
var lname = $('#lname').val().replace(/\s/g, '').toLowerCase();
var oname = $('#oname').val().replace(/\s/g, '').toLowerCase();
var email = $('#email').val().toLowerCase();
var validMail = fname + '.' + lname+'@ashesi.edu.gh';

//staff email
 var sfname= fname.charAt(0);
 var slname= lname.charAt(0);
 var soname= oname.charAt(0);
 var validSMail = sfname + lname + oname+'@ashesi.edu.gh';
 var validSMail1 = sfname  + oname+'@ashesi.edu.gh';
 //validating email
if(email != validMail || email != validSMail || email != validSMail1 ){
  alert("Invalid Email. Use Your school email.");
  return false;
}
}
