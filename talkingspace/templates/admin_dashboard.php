<?php include("includes/adminHeader.php") ?>
<link rel="stylesheet" type="text/css" href=" <?php echo BASE_URL?>templates/css/dataTables.bootstrap.min.css">
<header id="header" style="margin-top:30px">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</h1>
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Create Content
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a type="button" data-toggle="modal" data-target="#addPage">Add Category</a>
            </div>
          </div>
        </div>
      </div>
    </header>
    <?php displayMessage();?>
    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Overview</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span></h2>
                    <a href="<?php echo BASE_URL?>manageusers.php"><h4><?php echo $totalUsers ?> Users</h4></a>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span></h2>
                    <a href="#"><h4><?php echo $totalActiveUsers ?> Active Users</h4></a>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span></h2>
                    <a href="#"><h4><?php echo $totalTopics ?> Questions Posted</h4></a>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span></h2>
                    <a href="#"><h4><?php echo $totalComments ?> Comments</h4></a>
                  </div>
                </div>
              </div>
              </div>
          </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Add Category</h4>
        </div>
        <div class="modal-body">
        <form method="post" action="addCategory.php">
          <div class="form-group">
            <label>Category Name</label>
            <input type="text" class="form-control" placeholder="First  Name" required name="name">
          </div>
           <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
          <button type="submit" class="btn btn-primary" name="do_AddCategory">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  </div>



  <?php
  include("includes/footer.php")
  ?>
 <script src=" <?php echo BASE_URL?>templates/js/bootstrap-select.min.js"></script>
 <script src=" <?php echo BASE_URL?>templates/js/jquery.dataTables.min.js"></script>
 <script src=" <?php echo BASE_URL?>templates/js/.dataTables.bootstrap.min.js"></script>
 <script type="text/javascript">
$(document).ready(function() {
  $('#example').dataTable( {
    "bSort": false
    });
  });

</script>
  </body>
</html>
