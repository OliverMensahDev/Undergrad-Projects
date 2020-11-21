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
                </ul>
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
                 <form  method="post" >
                        <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>

                          </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($totalUsers as $key => $value): ?>
                              <tr>
                                <td><?php echo $value->name ?></td>
                                <td><?php echo $value->username ?></td>
                                <td><?php echo $value->email ?></td>
                                <td><?php echo $value->activated ?></td>
                                <?php if ($value->activated=="INACTIVE" && !empty($value->prompted_date)): ?>
                                  <td><button class="btn btn-warning" disabled>User prompted</button></td>
                                <?php elseif($value->activated=="INACTIVE" ): ?>
                                  <td><a href="<?php echo BASE_URL ."sendMessage.php?email=".urlEnCoded($value->email). "&username=". urlEnCoded($value->username)?>" class="btn btn-primary">Prompt User</a></td>
                                  <?php else: ?>
                                    <td><a href="<?php echo BASE_URL."delete.php?profile=".$value->id ?>" class="btn btn-danger">Delete</a></td>
                                <?php endif; ?>
                                <td>
                                  <?php if ($value->prompted_date=="NOW()" && $value->activated=="INACTIVE"): ?>
                                    <td><a href="<?php echo BASE_URL ."activateMessage.php?email=".urlEnCoded($value->email). "&username=". urlEnCoded($value->username)?>" class="btn btn-success">Activate User(Username Recieved)</a></td>
                                  <?php endif; ?>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>

                              </tr>
                            <?php endforeach; ?>
                        </tbody>
                </table>
                </form>
                </div>
          </div>
        </div>
      </div>
    </section>

    <div class="modal fade" id="addPass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Change Password</h4>
        </div>
        <div class="modal-body">
        <form method="post" action="adminChangePassword.php">
          <div class="form-group">
            <label>Old Password</label>
            <input type="password" class="form-control"  required name="p0">
            <input type="hidden" value="<?php echo $admin->password?>" name="hidden">
          </div>
          <div class="form-group">
            <label>New Password</label>
            <input type="password" class="form-control" required name="p1">
          </div>
          <div class="form-group">
            <label>Confirm  New Password</label>
            <input type="password" class="form-control"  required name="p2">
          </div>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="do_change">Change Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
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

  <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Add Product</h4>
          <p><em>Please add product category if the category does not exist before adding the product</em></p>
        </div>
        <div class="modal-body">
        <form method="post" action="addProduct.php">
          <div class="form-group">
            <label>Label</label>
            <input type="text" class="form-control" placeholder="Product Label" required name="label">
          </div>
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" placeholder="Product Name" optional name="name">
          </div>
          <div class="form-group">
            <label>Prodcut Category</label>
            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="category_id">
            </select>
          </div>
         <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
          <button type="submit" class="btn btn-primary" name="do_AddProduct">Add Product</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addCheckout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Add a New Checkout</h4>
          <p><em>Please add client if the name of student does not exist </em></p>
        </div>
        <div class="modal-body">
        <form method="post" action="addCheckout.php">
          <div class="form-group">
            <label>Client Name</label>
            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="client_id">

            </select>
          </div>
          <div class="form-group">
            <label>Prodcut Name</label>
            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="product_id">

          </div>
          <div class="form-group">
            <label>Qunatity</label>
            <input type="number" class="form-control" placeholder="Quantity" required name="quantity" maxlength="10">
          </div>
          <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
          <button type="submit" class="btn btn-primary" name="do_CheckOut">Save changes</button>
          </form>
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
