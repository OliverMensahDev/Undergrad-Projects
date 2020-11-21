<?php
/**Oliver Mensah
* helper function for messaging
*
*
*/
function redirect($page=FALSE, $message=NULL, $message_type= NULL){
  //checking for page
  if(is_string($page)){
    $location=$page;
  }else{
    $location = $_SERVER['SCRIPT_NAME'];
  }
  //checking for message_
  if($message !=NULL){
    //set  SESSionmessage
   $_SESSION['message'] = $message;
  }
  //checking for $message_type
  if($message_type !=NULL){
    //set  SESSionmessage
   $_SESSION['message_type'] = $message_type ;
  }
  //redirect
  header('Location:'.$location);
  exit;
}
/**
* isNomalUsr
*/
function isNomalUsr(){
  if(isset($_SESSION['user_id'])){
    return true;
  }
}
/**
* isAdmin
*/
function isAdmin(){
  if(isset($_SESSION['admin_id'])){
    return true;
  }
}


function displayMessage(){
  if(!empty($_SESSION['message'])){
    $message = $_SESSION['message'];
    if(!empty($_SESSION['message_type'])){
      $message_type = $_SESSION['message_type'];
      if($message_type=="error"){
        echo
        "
              <div class='glyphicon glyphicon-remove alert alert-danger' style='background:tomato; color:white'>".$message. "</div>
        ";
      }else{
          echo
          "
                <div class='glyphicon glyphicon-ok alert alert-success' style='background:green; color:white'>".$message. "</div>
          ";
      }
    }
    //unset variables
   unset($_SESSION['message']);
   unset($_SESSION['message_type']);
  }else{
    echo "";
  }
}

function getAllCategories(){
  $db = new Database;
  $db->query("SELECT * FROM categories");
  return $db->resultset();
}

function replyCount($topic_id){
  $db = new Database;
  $db->query("SELECT * FROM replies where topic_id = :topic_id");
  $db->bind(":topic_id",$topic_id);
  $row = $db->resultset();
  return $db->rowCount();
}

function userPostsCount($user_id){
  $db = new Database;
  $db->query("SELECT * FROM topics
    WHERE user_id =:user_id
  ");
  $db->bind(':user_id', $user_id);
  $db->resultset();
  $topics = $db->rowCount();

  $db->query("SELECT * FROM replies
    WHERE user_id =:user_id
  ");
  $db->bind(':user_id', $user_id);
  $db->resultset();
  $replies= $db->rowCount();
  return $topics + $replies;
}
function email($email, $username, $emailMessage,$page, $successMessage)
{
  require_once "vendor/autoload.php";
  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = true;
  $mail->Username = "mensaholiver08@gmail.com";
  $mail->Password = "0544892841";
  $mail->SMTPSecure = "ssl";
  $mail->Port = 587;
  $mail->From = "mensaholiver08@gmail.com";
  $mail->FromName = "Oliver Mensah";
  $mail->addAddress($email, $username);
  $mail->addReplyTo('mensaholiver08@gmail.com', 'Talkinspace');
  $mail->isHTML(true);
  $mail->Subject = "What is on your mind, Get your voice heard";
  $mail->Body = $emailMessage;
  $mail->AltBody = "This is the plain text version of the email content";

  if(!$mail->send())
  {
      echo "Mailer Error: " . $mail->ErrorInfo;
  }
  else
  {
    ob_clean();
    redirect($page, $successMessage, "success");
  }
}
function replyToreply($reply){
  $db = new Database;
  $db->query("SELECT * FROM replyToreply WHERE replyToreply_reply_id = :u");
  $db->bind(":u", $reply);
  return $db->resultset();

}
