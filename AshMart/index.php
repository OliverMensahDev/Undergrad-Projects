<?php include("header.php") ;?>
<body>
      <!-- navbar-fixed-top topnav -->
    <?php include("nav.php"); ?>
    <!-- Banner header section -->
    <div class="intro-banner">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="intro-inner">
                        <h1>Welcome to AshMart </h1>
                        <h3>Sell/Get Items Which Students no Longer Use on Campus </h3>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">

                            <li>
                                <a href="sell.php" class="btn btn-default btn-lg">
                                    <span class="button-title"><i class="fa fa-tags"></i>Sell Now</span>
                                </a>
                            </li>

                            <li>
                                <a href="order.php" class="btn btn-default btn-lg">
                                    <span class="button-title"><i class="fa fa-shopping-cart"></i>Order Now</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
    			<h3 class = "alert alert-success" style =" font-weight:Bolder; text-align:center">Latest Items</h3>
        </div>
      </div>
    </div>
    <div class="container-fluid well" id='latest'>
      <div class="row" style="padding-top:10px">
        <?php include("getDetails.php") ?>
      </div>
      <?php //include 'modal_latest.php'; ?>
    </div>
    </body>
</html>
