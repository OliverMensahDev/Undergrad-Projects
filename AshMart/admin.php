<?php include('header.php');
session_start();
?>
<body class="well">
<?php include('nav.php') ?>
<h4 class="alert alert-success alertPaddingTop" style="font-weight:bold; text-align:center;">
  Admin Login
</h4>
  <div class="container-fluid  login">
					<form method="post" role="form">
				    <div class="form-group">
				      <label for="username">Username:</label>
				      <input type="text" class="form-control" name="username" id="username" required>
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
					$username = $_POST['username'];
					$password = $_POST['password'];
					$query = "SELECT * FROM admin WHERE username='$username'";
					$result = mysql_query($query)or die(mysql_error());
					$row = mysql_fetch_array($result);
					$num_row = mysql_num_rows($result);

          $date =date('Y-m-d h:ia' );
          $day =  date('l');
          $Date = $day . ', ' . $date;

					if( $num_row == 1) {
            	$_SESSION['id']=$row['admin_id'];
              mysql_query("insert into admin_log (username,login_date,admin_id)
              values('$username','$Date',".$row['admin_id'].")")or die(mysql_error());
				?>
				<script>
				alert("Successfully Logged In")
				var delay = 100;
					setTimeout(function(){ window.location = 'activity_log.php'  }, delay);
				</script>
				<?php 	}else{ ?>
				<script>
				alert("Wrong Credentials, Cannot Logged In")
				var delay = 100;
					setTimeout(function(){ window.location = 'admin.php'  }, delay);
				</script>
				<?php
			}
			}
				?>
</script>
</body>
</html>
