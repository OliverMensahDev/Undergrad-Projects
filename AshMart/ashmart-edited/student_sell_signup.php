<?php include('header.php');?>
<?php include ('nav.php'); ?>
<body class="well">
<h4 class="alert alert-success alertPaddingTop" style="font-weight:bold; text-align:center;">
  Sign up Here
</h4>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
      </div>
      <div class="col-md-4  signup">
        <form method="post"role="form" enctype="multipart/form-data" onsubmit="return validate();">
          <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="firstname"  id='fname' required placeholder="your firstname like Oliver">
          </div>
          <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" name="lastname" id='lname' required placeholder="your lastname like Mensah">
          </div>
          <div class="form-group">
            <label for="othername">Other Name</label>
            <input type="text" class="form-control" name="othername"  id='oname' optional placeholder="your other like Kwadwo">
          </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" id="email" required  placeholder="your email">
          <!-- <script src="js/validateEmail.js" charset="utf-8"></script> -->
        </div>
        <div class="form-group">
          <label for="class">Year Group:</label>
          <select class="form-control" name="class">
          <?php
            $years = range(2017, 2020);
            foreach ($years as $yr) {
              echo '<option value='.$yr.'>'.$yr.'</option>';
            }
          ?>
          </select>
        </div>
        <div class="form-group">
          <label for="phone">Phone:</label>
          <input type="tel" class="form-control" name="phone" required placeholder="your phone number like 0544 892 841">
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" name="password" id="pwd" required>
        </div>
        <button type="submit" name="save" class="btn btn-primary"><i class="icon-plus-sign icon-large"></i>Save</button>
       </form>
      </div>
      <div class="col-md-4">      
      </div>

    </div>
  </div>
<?php
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
     }

   if(isset($_POST['save'])){
      $firstname =test_input($_POST["firstname"]);
      $lastname =test_input($_POST["lastname"]);
      $othername =test_input($_POST["othername"]);
      $email = $_POST['email'];
      $class = test_input ($_POST['class']);
      $phone = $_POST['phone'];
      $password = $_POST['password'];
      $passhash  =md5($password);
      $query = mysql_query("SELECT * FROM student_post where email='$email' or  phone_number = '$phone' ")or die(mysql_error());
      $count = mysql_num_rows($query);
      if ($count > 0){
          ?>
    <script>
      alert('Data Already Exist');
      window.location ="student_sell_signup.php";
    </script>
    <?php
    }
    else{
    mysql_query("insert into student_post  (firstname, lastname, othername,  email, class, phone_number,  password,pass)
     values('$firstname', '$lastname', '$othername','$email', '$class', '$phone','$passhash','$password')")or die(mysql_error());
    //mysql_query("insert into activity_log (date,username,action) values(NOW(),'$admin_username','Added Staff User $firstname')")or die(mysql_error());
  ?>
  <script>
  alert("Your information is successfully added");
  window.location="StudentSellLogin.php";
  </script>
  <?php
  }
  }
  ?>
</body>
</html>
