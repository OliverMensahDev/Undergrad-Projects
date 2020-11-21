<div class="container-fluid  padding-top-nav"></div>
<div class="col-md-12 col-xs-12 details-margin">
 <div class="panel panel-default">
   <div class="panel-heading panel-heading-green">
     <h3 class="panel-title text-center">
Product Details
<a href="<?php echo base_url()?>" class="btn btn-primary pull-right">Return To HomePage</a>
</h3>
</div>
<div class="panel-body">
<div class="row details">
<div class="col-md-4">
  <img class="hoverImage" src="<?php echo base_url() ?>uploads/<?php echo  $product->image; ?>">
</div>
<div class="col-md-8">
  <h3><?php echo strtoupper($product->title)?></h3>
  <div class="details-price">
    Price: GH¢ <?php echo $product->price ?>
  </div>
  <div class="details-description">
    <p>
       <?php echo $product->description ?>

    </p>
  </div>
  <div class="details-buy">
    <form role="form" action="<?php echo base_url()?>cart/add" method="post">
      QTY: <input class="qty" type="text" name="qty" value="1"/>
      <input type="hidden" name="item_number" value="<?php echo $product->id?>">
      <input type="hidden" name="price" value="<?php echo $product->price?>">
      <input type="hidden" name="title" value="<?php echo $product->title?>">
      <br>
      <button class="btn btn-primary add" type="submit" name="button">Add To Cart</button>
    </form>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('body').delay(5000).fadeIn();
    $('.add').on('click', function(){
      alert(" Item has been added to the cart");
    });
  });
</script>
