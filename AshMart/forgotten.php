<?php include('header.php');
?>
<body class="well">
<?php include('nav.php') ?>
<h4 class="alert alert-success alertPaddingTop" style="font-weight:bold; text-align:center;">
Please Provide your Email and Phone Number to reset the password
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
     $row=mysql_fetch_array($query);
     $fname = $row['firstname'];
     $lname = $row['lastname'];
     $oname = $row['othername'];
     $name = $fname . " ". $oname ." ". $lname;
     require_once "vendor/autoload.php";
     //PHPMailer Object
     $mail = new PHPMailer;
     //Enable SMTP debugging.
     $mail->SMTPDebug = 3;
     //Set PHPMailer to use SMTP.
     $mail->isSMTP();
     //Set SMTP host name
     $mail->Host = "smtp.gmail.com";
     //Set this to true if SMTP host requires authentication to send email
     $mail->SMTPAuth = true;
     //Provide username and password
     $mail->Username = "sellorgetviashmart@gmail.com";
     $mail->Password = "08swanzy";
     //If SMTP requires TLS encryption then set it
     $mail->SMTPSecure = "tls";
     //Set TCP port to connect to
     $mail->Port = 587;
     $mail->From = "sellorgetviashmart@gmail.com";
     $mail->FromName = "AshMart";
     $mail->addAddress("$email", "$name");
     $mail->isHTML(true);
    $mail->Subject = "Reset your paassword";
    $mail->Body = "<p>Hello <?php echo $name; ?>, kindly use the link below to reset your password<p> <br><a href='localhost/reset.php?email=$email' target ='_blank'>Reset Password</a>";
    if(!$mail->send())
    {
      echo "Mailer Error: " . $mail->ErrorInfo;
    }else{
      echo "Message has been sent successfully";
      }
  }
}
?>
</body>
</html>
