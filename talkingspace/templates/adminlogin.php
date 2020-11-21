<?php include 'includes/adminHeader.php'; ?>
<link rel="stylesheet" href="<?php echo BASE_URL ?>templates/css/styles.css">
    <?php displayMessage()?>
    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <form id="login" action="authuser.php" method="post" class="well">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Enter your email" required name="email">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" required name="password">
                  </div>
                  <button type="submit" class="btn btn-default btn-block"  name="do_login">Login</button>
              </form>
          </div>
        </div>
      </div>
    </section>
    <?php include 'includes/footer.php'; ?>
    <script type="text/javascript">
    window.onload = function(){
      document.getElementById('background').classList.add("background-for-login");
    }
    </script>
