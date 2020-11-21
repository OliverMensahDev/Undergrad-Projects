<?php
require('core/init.php');
if(!isNomalUsr()){
$user = new User;
$validator= new Validator;
$template = new Template('templates/register.php');
$template->title = "Talking Space || Register";
$template->getAllCategories = getAllCategories();

if(filter_has_var(INPUT_POST, "register")){
  $data = array();
  $fname = sanitise($_POST['fname']);
  $lname = sanitise($_POST['lname']);
  $data['name'] = $fname . " " . $lname;
  $data['email'] = sanitise($_POST['email']);
  $data['username'] = sanitise($_POST['username']);
  $data['about'] = htmlentities($_POST['about']);
  $pass      = htmlentities($_POST['password']);
  $data['last_activity'] = date('Y-m-d H:i:s');
  $data['password'] = password_hash($pass, PASSWORD_DEFAULT, array("cost"=>11));
 $array_fields = array('fname', 'lname','email', 'username', 'password');
 if(!$user->userExist($data['username'])){
  if($validator->isRequired($array_fields)) {
    if($validator->isValidEmail($data['email'])){
      if(empty($_FILES['profile']['name'])){
       $data['profile'] = "noimage.png";
     }else if($user->uploadAvatar()){
        $data['profile'] =$_FILES['profile']['name'];
      }else{
        redirect('register.php',"Image could not be uploaded", "error");
      }if($user->register($data)){
          redirect('login.php',"User Successfully registered, You can now login", "success");
       }else{
         redirect('register.php',"Unsucessful registration", "error");
        }
        }else{
          redirect('register.php',"Invalid Email", "error");
        }
      }else{
        $data = $validator->isRequired($array_fields);
        $val = implode(",", $data);
        redirect("register.php",$val, "error");
      }
  }else{
    redirect('register.php',"Account Already Exist. Check you details very well before submitting", "error");
  }
}
echo $template;
}else{
  redirect("index.php","You cannot register again once you have logged in.", "error");
}
