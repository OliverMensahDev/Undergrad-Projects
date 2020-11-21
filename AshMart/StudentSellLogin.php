<?php include('header.php');
session_start();
?>
<body class="well">
<?php include('nav.php') ?>
<h4 class="alert alert-success alertPaddingTop" style="font-weight:bold; text-align:center;">
  Login to Sell
</h4>
  <div class="container-fluid  login">
  					<form method="post" role="form">
  				    <div class="form-group">
  				      <label for="username">Email:</label>
  				      <input type="email" class="form-control" name="email" required>
  				    </div>
  				  <div class="form-group">
  				    <label for="pwd">Password:</label>
  				    <input type="password" class="form-control" name="password" id="pwd" required>
  				  </div>
  				  <button type="submit" name="login" class="btn btn-primary"><i class="icon-signin"></i>Login</button>
  					</form>
</div>
				<?php

				if(isset($_POST['login'])){
					$email = $_POST['email'];
					$password = $_POST['password'];
          $passhash = md5($password);
					$result = mysql_query("SELECT * FROM  student_post where email='$email' AND password='$passhash'")or die(mysql_error());
					$row = mysql_fetch_array($result);
					$num_row = mysql_num_rows($result);
					if( $num_row ==1 ){
            	$_SESSION['id']=$row['stdPost_id'];
              // mysql_query("insert into patient_log (Question,username,login_date,patient_id)
              // values('$FacilityName','$username',NOW(),".$row['admin_id'].")")or die(mysql_error());
				?>
        <script>
				alert("Successfully Logged In")
				var delay = 100;
					setTimeout(function(){ window.location = 'sell.php'  }, delay);
				</script>
				<?php
      	}else{
          ?>
				<script>
				if(alert("Wrong Credentials, Cannot Logged In")){
				var delay = 100;
					setTimeout(function(){ window.location = 'student_Sell_login.php'  }, delay);
        }
				</script>
				<?php
			}
			}
				?>
</body>
</html>
