<!-- Modal -->
<script src="<?php echo base_url(); ?>assets/js/validation.js" charset="utf-8"></script>
    <div class="modal fade" id="signin" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Login Here</h4>
          </div>
          <div class="modal-body">
            <?php echo validation_errors('<div class="alert alert-danger">','</div>') ?>
            <form role='form' method="post" action="<?php echo base_url(); ?>users/login">
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="Enter Username" required id="cat">
                </div>
              <div class="form-group">
                <input type="password" class="form-control"  name="password" placeholder="Enter Password">
              </div>
              <button name="submit" type="submit" class="btn btn-primary">Login</button>
            </form>
          </div>
          </div>
          </div>
        </div>
