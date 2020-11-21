<div class="col-md-8 col-xs-12">
 <div class="panel panel-default">
   <div class="panel-heading panel-heading-green">
     <h3 class="panel-title">
Customer Registeration Form
</h3>
</div>
<div class="panel-body">
  <?php if ($this->session->flashdata('could_not_register')): ?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('could_not_register');?>
   </div>
  <?php endif; ?>
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
<script type="text/javascript">
$(document).ready( function() {
      $('.alert').delay(4000).fadeOut();
  });
</script>
