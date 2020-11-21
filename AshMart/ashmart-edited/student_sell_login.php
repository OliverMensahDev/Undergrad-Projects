<?php
// $ip = '41.79.97.5';
// //$ip ="::1";
// $getIp = $_SERVER['REMOTE_ADDR'];
// if($ip==$getIp){
  include('header.php');
  session_start();
  ?>
  <body class="well">
  <?php include('nav.php') ?>
  <h4 class="alert alert-success alertPaddingTop" style="font-weight:bold; text-align:center;">
    Login to Sell or Create an Account if you have not Registered.
  </h4>
  <div >
    <div class="container-fluid  ">
    				<div class="row">
    				  <div class="col-md-4">
    				  </div>
              <div class="col-md-4  login">
                <form method="post" role="form">
                  <div class="form-group">
                    <label for="username">Email</label>
                    <input type="email" class="form-control" name="email"  required>
                  </div>
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" name="password"  required>
                </div>
                <button type="submit" name="login" class="btn btn-primary"><i class="icon-signin"></i>Login</button>
                <a href="student_sell_signup.php">Or Click here to register</a>
                <br>
                <br>
                <a href="forgotten.php" class='btn btn-info' style="text-align:center;">Forgotten Password?</a>

                </form>
              </div>
              <div class="col-md-4">

              </div>
    				</div>
    				</div>

  </div>
  				<?php

  				if(isset($_POST['login'])){
  					$email = $_POST['email'];
  					$password = $_POST['password'];
            $passhash = md5(	$password );
  					$result = mysql_query("SELECT email,password,stdPost_id FROM  student_post where email='$email' AND password='$passhash'")or die(mysql_error());
  					$row = mysql_fetch_array($result);
  					$num_row = mysql_num_rows($result);
  					if( $num_row ==1 ) {
              	$_SESSION['id']=$row['stdPost_id'];
  				?>
  				<script>
  				alert("Successfully Logged In");
  					window.location = 'sell.php';
  				</script>
  				<?php
        	}else{
          ?>
  				<script>
  				if(alert("Wrong Credentials, Check your email and password. Email should be lowercase")){
  				window.location = 'student_Sell_login.php';
        }
  				</script>
  				<?php
  			}
  			}
  	?>
  </body>
  </html>
 <?php
// }else{
//    include('header.php');
//    ?>
<!--  <body class="well">
//   <?php //include('nav.php') ?>
//   <h4 class="alert alert-success alertPaddingTop" style="font-weight:bold; text-align:center;">
//     This site is for campus use. To access the platform, you must be in school.
//   <h4>
// <?php
// }
//  ?>
