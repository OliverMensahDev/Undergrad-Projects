<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bucket Deals | <?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta content='yes' name='mobile-web-app-capable'/>
    <link rel="manifest" href="<?php echo base_url();?>assets/images/ico/manifest.json">
    <meta name="theme-color" content="#6fa8dc">
    <meta name="msapplication-navbutton-color" content="#6fa8dc">
    <meta name="apple-mobile-web-app-status-bar-style" content="#6fa8dc">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
	 <link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/bucket_deals.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/js/jquery.min.js" charset="utf-8"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js" charset="utf-8"></script>
    <script src="<?php echo base_url();?>assets/js/script.js" charset="utf-8"></script>
  </head>
  <body>
  <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url()?>/assets/images/logo.jpg" width="100px" ></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo base_url()?>">HOME</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">CATEGORIES
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()?>products/All/">All Products</a></li>
            <?php foreach (get_categories_h() as $categories):?>
              <li><a href="<?php echo base_url()?>products/category/<?php echo$categories->id?>"><?php echo  $categories->name ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li><a href="<?php echo base_url()?>cart/"><i class="fa fa-shopping-cart"></i>MY CART <span class="badge"><?php echo $this->cart->total_items(); ?></span></a></li>
        <?php if (!$this->session->userdata('logged_in')): ?>
          <li><a data-toggle="modal" href="#signin" >SIGN IN</a></li>
          <li><a data-toggle="modal" href="#join">JOIN</a></li>
        <?php else: ?>
            <form class="navbar-form navbar-right" method="post" action="<?php echo base_url(); ?>users/logout">
           <button name="submit" type="submit" class="btn btn-default">logout</button>
         </form>
        <?php endif; ?>
        <li><a href="#search" data-toggle="modal"><span class="glyphicon glyphicon-search"></span></a></li>
      </ul>
    </div>
  </div>
  </nav>
<script>
  $(document).ready(function(){
    $('.game-image').hover(function() {
        $(".game-image").addClass('transition');

    }, function() {
        $(".game-image").removeClass('transition');
    });
});
</script>
