<!-- Modal -->
<script src="<?php echo base_url(); ?>assets/js/validation.js" charset="utf-8"></script>
    <div class="modal fade" id="search" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Enter the name and Select Item Category to Search for such Item</h4>
          </div>
          <div class="modal-body">
            <?php echo validation_errors('<div class="alert alert-danger">','</div>') ?>
            <form role='form' method="post" action="<?php echo base_url(); ?>products/search" >
                <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="Enter Name of what you want to seach" required id="cat">
                </div>
              <div class="form-group">
                <select class="form-control" name="category" required id="search">
                    <option value="selectItem">Select Item</option>
                  <?php foreach (get_categories_h() as $categories):?>
                    <option value="<?php echo$categories->id?>"><?php echo  $categories->name ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <button name="submit" type="submit" class="btn btn-success">Search Now</button>
            </form>
          </div>
          </div>
          </div>
        </div>
        <script type="text/javascript">
          $(document).ready(function() {
            $('button').on('click', function(){
              if( $('#search').val() =='selectItem'){
                alert("Select Item cannot be selected as a category");
                return false;
              }
            })
          });
        </script>
