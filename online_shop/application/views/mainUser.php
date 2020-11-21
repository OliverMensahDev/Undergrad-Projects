<div class="container" style="margin-top:100px;">
  <?php if ($this->session->flashdata('fail_logined')): ?>
    <div class="alert alert-danger 1 text-center">
        <?php echo $this->session->flashdata('fail_logined');?>
    </div>
  <?php endif; ?>
  <div class="row" style="margin-top:20px;">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <div class="alert alert-success">
        <h1 class="text-center">Login</h1>
      </div>
      <form role="form" action="<?php echo base_url();?>mainUser/login" method="post">
        <div class="form-group">
          <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" name="user_login" class="btn btn-primary">Login</button>
      </form>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>
<script type="text/javascript">
$(document).ready( function() {
      $('.1').delay(4000).fadeOut();
  });
</script>
