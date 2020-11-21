<?php 
function sendMail($email ){
    $to = $email; 
    $subject = 'Verfiy Account';

// Message
$message = "
<html>
<head>
  <title>Account Verification</title>
</head>
<body>
  <p>Kindly use this <a href=></a></p>
  </table>
</body>
</html>
";
// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
$headers[] = 'From: Birthday Reminder <birthday@example.com>';
$headers[] = 'Cc: birthdayarchive@example.com';
$headers[] = 'Bcc: birthdaycheck@example.com';

// Mail i
mail($to, $subject, $message, implode("\r\n", $headers));
}