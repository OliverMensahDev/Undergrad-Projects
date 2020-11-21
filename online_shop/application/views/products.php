<div class="container-fluid  padding-top-nav"></div>
<?php if ($this->session->flashdata('could_not_register')): ?>
  <div class="alert alert-danger">
      <?php echo $this->session->flashdata('could_not_register');?>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('registered')): ?>
  <div class="alert alert-success">
      <?php echo $this->session->flashdata('registered');?>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('logout')): ?>
  <div class="alert alert-success">
      <?php echo $this->session->flashdata('logout');?>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('fail_login')): ?>
  <div class="alert alert-danger">
      <?php echo $this->session->flashdata('fail_login');?>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('pass_login')): ?>
  <div class="alert alert-success">
      <?php echo $this->session->flashdata('pass_login');?>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('message')): ?>
  <div class="alert alert-success">
      <?php echo $this->session->flashdata('message');?>
  </div>
<?php endif; ?>

<!-- <div class="container-fluid">
  <div class="row text-center">
   <div class="col-md-4 hideOnMobile">
   <h1 class="text-lg">#1 Place To Shop</h1>
   </div>
   <div class="col-md-2 hideOnMobile">
     <i class="fa fa-arrow-circle-right fa-lg"></i>
   </div>
   <div class="col-md-6 ">
      <img src="<?php// echo base_url()?>/assets/images/logo.jpg" width="250">
   </div>
  </div>
</div> -->

<div class="container-fluid jumbotron">
<div class="container slider-padding">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="<?php echo base_url();?>assets/images/1.jpg" width="100%" height="150px">
        <div class="carousel-caption text-center">
          <h3>Our Shop</h3>
          <p>Come get the most fashionable clothes at cheaper price.</p>
        </div>
      </div>
      <div class="item">
        <img src="<?php echo base_url();?>assets/images/2.jpg" width="100%" height="150px">
        <div class="carousel-caption text-center">
          <h3>Chicago</h3>
          <p>Thank you, Chicago - A night we won't forget.</p>
        </div>
      </div>
      <div class="item">
        <img src="<?php echo base_url();?>assets/images/3.jpg" width="100%" height="150px">
        <div class="carousel-caption text-center">
          <h3>LA</h3>
          <p>Even though the traffic was a mess, we had the best time playing at Venice Beach!</p>
        </div>
      </div>
    </div>
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

</div>
</div>

<div id="recent_items" class="bg-1">
<div class="container">
  <h3 class="text-center">Most Recent Items</h3>
    <div class="row text-center">
        <?php foreach ($products as $product): ?>
          <div class="col-sm-4">
            <div class="thumbnail">
            <a href="<?php echo base_url()?>products/details/<?php echo  $product->id; ?>">
            <div class="game-price">
              GH¢ <?php echo $product->price; ?>
            </div>
            <div class="game-image">
                <img src="<?php echo base_url() ?>uploads/<?php echo  $product->image; ?>">
            </div>
            <div class="game-title">
            <?php echo  $product->title;?>
            </div>
            </a>
            <div class="game-add">
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
        <?php endforeach; ?>
    </div>
  </div>
</div>
</div>
<!-- Footer -->
<footer class="text-center">
</footer>
<script type="text/javascript">
  $(document).ready(function() {
    $('.alert').delay(5000).fadeOut();
  });
  $('.add').on('click', function(){
    alert(" Item has been added to the cart");
  })
</script>
</body>
</html>
