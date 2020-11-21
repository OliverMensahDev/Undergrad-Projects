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
<?php if ($this->session->flashdata('product_edited')): ?>
  <div class="alert alert-success away">
    <?php echo $this->session->flashdata('product_edited'); ?>
  </div>
<?php endif; ?>
<?php if ($this->session->flashdata('product_deleted')): ?>
  <div class="alert alert-success away">
    <?php echo $this->session->flashdata('product_deleted'); ?>
  </div>
<?php endif; ?>
<?php if ($this->session->flashdata('product_not_deleted')): ?>
  <div class="alert alert-success away">
    <?php echo $this->session->flashdata('product_not_deleted'); ?>
  </div>
<?php endif; ?>
<?php if ($this->session->flashdata('category_edited')): ?>
  <div class="alert alert-success away">
    <?php echo $this->session->flashdata('category_edited'); ?>
  </div>
<?php endif; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <h1 class="text-center">Existing Products</h1>
      <hr>
      <form  method="post" >
        <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
        <thead>
          <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Category</th>
            <th>Price</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php if ($products): ?>
            <?php foreach ($products as $key => $value): ?>
              <tr >
                <td><?php echo $value->title; ?></td>
                <td><img src="<?php echo base_url()."uploads/".$value->image; ?>" alt="" width="80px"></td>
                <td><?php echo $value->name; ?></td>
                <td><?php echo "GHS". $value->price; ?></td>
                <td width="120">
                  <a rel="tooltip" title="Edit Item" class="btn btn-success" href="<?php echo base_url()?>products/edit/<?php echo $value->id."/".$value->image?>">Edit
                  </a>
                </td>
                <td width="120">
                  <a rel="tooltip"  title="Delete Item"  class="btn btn-danger" href="<?php echo base_url()?>products/delete/<?php echo $value->id."/".$value->image?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>

          <?php else: ?>
            <p>No Data Available Now</p>
          <?php endif; ?>
        </tbody>
</table>
</form>
    </div>
      <div class="col-md-1">
      </div>
    <div class="col-md-4">
      <h1 class="text-center">Existing Categories</h1>
      <hr>
      <form  method="post" >
        <table cellpadding="0" cellspacing="0" border="0" class="table" id="example1">
        <thead>
          <tr>
            <th>Name</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php if ($categories): ?>
          <?php foreach ($categories as $key => $value): ?>
            <tr >
              <td><?php echo $value->name ?></td>
              <td width="120">
                <a rel="tooltip" title="Edit Item" class="btn btn-success" href="<?php echo base_url()?>products/editCategory/<?php echo $value->id?>">Edit
                </a>
              </td>
              <td width="120">
                <a rel="tooltip"  title="Delete Item"  class="btn btn-danger" href="<?php echo base_url()?>products/deleteCategory/<?php echo $value->id?>">Delete</a>
              </td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No Data Available Now</p>
        <?php endif; ?>
</tbody>
</table>
</form>
    </div>
    <div class="col-md-1">
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $('.away').fadeOut(4000);
  $('#example').dataTable( {
    "bSort": false
    } );
  $('#example1').dataTable( {
    "bSort": false
    } );
  });

</script>
