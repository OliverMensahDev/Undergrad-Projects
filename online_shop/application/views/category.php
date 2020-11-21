<div class="container-fluid  padding-top-nav">
<div class="panel panel-default">
  <div class="panel-heading panel-heading-green">
    <h3 class="panel-title text-center">
      <?php foreach ($categories as $product): ?>
        <?php echo ucwords($product->name); ?>
        <?php break;?>
      <?php endforeach;?>
    </h3>
</div>
<div class="panel-body">
<div class="row">
  <?php if ($categories): ?>
    <?php foreach ($categories as $product): ?>
      <div class="col-md-4 game">
        <a href="<?php echo base_url()?>products/details/<?php echo  $product->id; ?>">
        <div class="game-price">
          GH¢ <?php echo $product->price; ?>
        </div>
        <div class="game-image">
            <img class="hoverImage" src="<?php echo base_url() ?>uploads/<?php echo  $product->image; ?>">
        </div>
        <div class="game-title">
        <?php echo  strtoupper($product->title);?>
        </div>
        </a>
        <div class="game-add">
          <form role="form" action="<?php echo base_url()?>cart/add" method="post">
            QTY: <input class="qty" type="text" name="qty" value="1"/>
            <input type="hidden" name="item_number" value="<?php echo $product->id?>">
            <input type="hidden" name="price" value="<?php echo $product->price?>">
            <input type="hidden" name="title" value="<?php echo $product->title?>">
            <br>
            <button class="btn btn-primary add" type="submit" name="submit">Add To Cart</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
    <div class="row text-center">
        <div class="col-md-12">
      <div class="row"><?php echo $pagination;?></div>
     </div>
   </div>
  <?php else: ?>
    <div class="text-center">
      <h3>No Product is available under this category</h3>
    </div>
  <?php endif; ?>
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
