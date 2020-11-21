<!-- Modal -->
<?php
$csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
);
 ?>
<script src="<?php echo base_url(); ?>assets/js/validation.js" charset="utf-8"></script>
    <div class="modal fade" id="addProduct" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Product</h4> <em>if the product category is not in the select option,
               go to add category link to add category before adding this product</em>
          </div>
          <div class="modal-body">
            <?php echo validation_errors('<div class="alert alert-danger">','</div>') ?>
              <form role= "form" action="<?php echo base_url()?>products/addProduct" method="post" name="form"  onsubmit="return validate()"enctype="multipart/form-data">
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
              <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Enter name of product" required>
              </div>
              <div class="form-group">
                <label>Brief Description of Product</label>
                <textarea name="description" rows="8" cols="80" class="form-control">
                  This is a brand made by Gucci Company. Made of cotton, bla bla bla
                </textarea>
              </div>
              <label>Select Category</label>
              <div class="form-group">
                <select class="form-control" name="category_id">
                  <?php foreach (get_categories_h() as $popular): ?>
                  <option value="<?php echo$popular->id?>"><?php echo $popular->name ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Enter or choose price</label>
                <input type="number" name="price" class="form-control" id="price" required>
              </div>
             <div class="form-group">
                <input type="file" name="image" id="image" class="form-control" required  accept="image/*" onChange="validateImage(this.value)">
              </div>
              <button type="submit" name="submit" class=" form-control btn  btn-success" id="add">Add</button>
            </form>
          </form>
          </div>
        </div>
      </div>
    </div>

 <script type="text/javascript">
 function validate(){
  if(document.getElementById("price").value <= 0){
     alert("Price cannot be 0 or less");
     return false;
   }
 }
 </script>
