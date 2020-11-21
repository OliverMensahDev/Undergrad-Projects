<!-- Modal -->
<script src="<?php echo base_url(); ?>assets/js/validation.js" charset="utf-8"></script>
    <div class="modal fade" id="join" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Register Here </h4>
          </div>
          <div class="modal-body">
            <?php echo validation_errors('<div class="alert alert-danger">','</div>') ?>
          <form role="form"  method="post" action="<?php echo base_url();?>users/register">
          <div class="form-group">
            <label>First Name* </label>
            <input type="text" class="form-control" placeholder="Enter Your First Name" name="firstname">
          </div>
          <div class="form-group">
            <label>Last Name* </label>
            <input type="text" class="form-control" placeholder="Enter Your Last Name" name="lastname">
          </div>
          <div class="form-group">
          <label>Email address*</label>
          <input type="email" class="form-control" placeholder="Enter Your Email"  name="email">
          </div>
          <div class="form-group">
          <label>Choose Username*</label>
          <input type="tel" class="form-control" placeholder="Enter Your Username"  name="username">
          </div>
          <div class="form-group">
          <label>Password*</label>
          <input type="password" class="form-control"  placeholder="Enter Your Password"  name="password">
          </div>
          <div class="form-group">
          <label>Confirm Password*</label>
          <input type="password" class="form-control"  placeholder="Confirm Your Password"  name="password2">
          </div>
          <button type="submit" class="btn btn-primary" name="register">Register</button>
          </form>
          </div>
          </div>
          </div>
        </div>
