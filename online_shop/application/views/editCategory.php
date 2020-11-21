
<div class="container" style="margin-top:150px">
  <div class="row">
    <div class="col-sm-12">
     <ol class=" breadcrumb">
       <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-dashboard">Dashboard</i></a></li>
       <li class="active"><i class="fa fa-plus-square-o">Edit Category</i></li>
     </ol>
  </div>
    <div class="col-md-12">
      <?php echo validation_errors('<div class="alert alert-danger">','</div>') ?>
        <form role= "form" action="<?php echo base_url()?>products/editCategory/<?php echo $category->id?>" method="post">
        <div class="form-group">
          <input type="text" pattern=".{3,}"  name="name" class="form-control" placeholder="Enter Category" required value="<?php  echo $category->name?>">
        </div>
        <button type="submit" name="submit" class="btn btn-success" id="add">Save</button>
      </form>
    </div>
  </div>
</div>
