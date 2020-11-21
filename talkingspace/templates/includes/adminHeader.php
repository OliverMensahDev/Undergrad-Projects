<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title><?php echo $title ?></title>
    <link href="<?php echo BASE_URL;?>templates/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>templates/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>templates/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>templates/css/adminCss.css" rel="stylesheet">
</head>
<body id="background">
  <div class="loader"></div>
  <nav class="navbar navbar-inverse navbar-fixed-top">
       <div class="container-fluid">
         <div class="navbar-header">
           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
             <span class="sr-only">Toggle navigation</span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
           <a class="navbar-brand"><span id="brand1">Talk</span><span id="brand2">in</span><span id="brand3">Space</span></a>
         </div>
         <div id="navbar" class="navbar-collapse collapse">
           <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="<?php echo BASE_URL?>">Home</a>
            </li>
             <?php if (isAdmin()): ?>
              <li  >
                <a href="<?php echo BASE_URL?>logoutAdmin.php">Logout</a>
              </li>
             <?php endif; ?>
           </ul>
         </div>
       </div>
     </nav>
