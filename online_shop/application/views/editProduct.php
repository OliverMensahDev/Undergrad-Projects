<script src="<?php echo base_url(); ?>assets/js/validation.js" charset="utf-8"></script>
<?php
if(! $this->session->userdata['admin_logged_in']){
  redirect('mainUser');
}
?><div class="container-fluid  padding-top-nav"></div>
<?php if ($this->session->flashdata('cat_added')): ?>
  <div class="alert alert-success away">
    <?php echo $this->session->flashdata('cat_added'); ?>
  </div>
<?php endif; ?>
<?php if ($this->session->flashdata('cat_failed')): ?>
  <div class="alert alert-danger away">
    <?php echo $this->session->flashdata('cat_failed'); ?>
  </div>
<?php endif; ?>
<?php if ($this->session->flashdata('message_failed')): ?>
  <div class="alert alert-danger away">
    <?php echo $this->session->flashdata('message_failed'); ?>
  </div>
<?php endif; ?>
<?php if ($this->session->flashdata('message')): ?>
  <div class="alert alert-danger away">
    <?php echo $this->session->flashdata('message'); ?>
  </div> 
<?php endif; ?>
<?php if ($this->session->flashdata('product_added')): ?>
  <div class="alert alert-success away">
    <?php echo $this->session->flashdata('product_added'); ?>
  </div>
<?php endif; ?>
<?php if ($this->session->flashdata('product_failed')): ?>
  <div class="alert alert-danger away">
    <?php echo $this->session->flashdata('product_failed'); ?>
  </div>
<?php endif; ?>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
     <ol class=" breadcrumb">
       <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-dashboard">Dashboard</i></a></li>
       <li class="active"><i class="fa fa-plus-square-o">Edit Category</i></li>
     </ol>
  </div>
    <div class="col-md-12">
      <?php echo validation_errors('<div class="alert alert-danger">','</div>') ?>
        <form role= "form" action="<?php echo base_url()?>products/edit/<?php echo $product->id."/".$product->image?>" method="post" name="form"  onsubmit="return validate()"enctype="multipart/form-data">
        <div class="form-group">
          <input type="text" pattern=".{3,}"  name="title" class="form-control" placeholder="Enter name of product" required value="<?php  echo $product->title?>">
        </div>
        <div class="form-group">
          <label>Brief Description of Product</label>
          <textarea pattern=".{3, 200}" name="description" rows="8" cols="80" class="form-control" required>
            <?php echo $product->description?>
          </textarea>
        </div>
        <label>Select Category</label>
        <div class="form-group">
          <select class="form-control" name="category_id" required>
            <?php foreach (get_categories_h() as $popular): ?>
            <option value="<?php echo $popular->id?>"><?php echo $popular->name ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Enter or choose price</label>
          <input type="number" name="price" class="form-control" id="price" required value="<?php echo $product->price?>">
        </div>
       <div class="form-group">
          <input type="file" name="image" id="image" class="form-control"  accept="image/*" onChange="validateImage(this.value)" value="<?php echo $product->image?>">
        </div>
        <button type="submit" name="submit" class="btn btn-success" id="add">Save</button>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {

  });

  function validate(){
   if(document.getElementById("price").value <= 0){
      alert("Price cannot be 0 or less");
      return false;
    }
  }

</script>
