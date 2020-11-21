<!-- Modal -->
    <div class="modal fade" id="addCategory" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Category</h4>
          </div>
          <div class="modal-body">
            <form role= "form" action="<?php echo base_url()?>products/addCategory" method="post" name="form" onsubmit="return validateName(this)">
              <div class="form-group">
                <input type="text" name="category" class="form-control" placeholder="Enter name of product here" required>
              </div>
              <button type="submit" name="submit" class=" form-control btn  btn-success">Add</button>
            </form>
          </form>
          </div>
        </div>
      </div>
    </div>
 <script type="text/javascript">
 var ck_cat = /^[A-Za-z ]{5,40}$/;
 function validateName(form){
 var name = form.category.value;
 if(!ck_cat.test(name)){
   alert("Only letters are needed for this fields");
   return false;
 }
 </script>
