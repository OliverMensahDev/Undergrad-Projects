<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
	 <link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet">
	 <link href="<?php echo base_url();?>assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/bucket_deals.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/js/jquery.min.js" charset="utf-8"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js" charset="utf-8"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js" charset="utf-8"></script>
    <script src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js" charset="utf-8"></script>
  </head>
   <body>
     <body>
   <nav class="navbar navbar-inverse navbar-fixed-top">
     <div class="container">
       <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand">The Gaming Place</a>
       </div>
       <div id="navbar" class="collapse navbar-collapse">
         <ul class="nav navbar-nav navbar-right">
         <?php if($this->session->userdata('username')): ?>
           <li><a data-toggle='modal' href="#addProduct">Add Product</a></li>
           <li><a data-toggle='modal' href="#addCategory">Add Category</a></li>
           <li><a data-toggle='modal' href="<?php echo base_url();?>" target="_blank">Visit Site</a></li>
           <form class="navbar-form navbar-right" method="post" action="<?php echo base_url(); ?>mainUser/logout">
          <button name="submit" type="submit" class="btn btn-default">logout</button>
        </form>

       <?php endif; ?>
         </ul>
       </div>
     </div>
   </nav>
