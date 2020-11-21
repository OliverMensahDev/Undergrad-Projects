<nav class="navbar navbar-default navbar-fixed-top topnav">
    <!-- topnav -->
    <div class="container topnav">
        <!-- Logo -->
        <div class="navbar-header">
            <button type="button"class="navbar-toggle collapsed" data-toggle="collapse"
                 aria-expanded="false" aria-controls="navbar" data-target="#mainNavBar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand"><span id="logoSpan">AshMart</span></a>
        </div>

        <!-- Menu Items -->
        <div class="collapse navbar-collapse " id="mainNavBar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php"><i class="fa fa-home fa-fw"></i>HOME</a></li>
                <!--<li><a href="about.php"><i class="fa fa-info-circle"></i>ABOUT US </a></li>-->
                <!-- <li><a  href="#myModal" data-toggle="modal">Sell Your Unused Gadgets</a></li> -->
                <li><a  href="sell.php"><i class="fa fa-tags"></i>SELL NOW </a></li>
                <li><a  href="order.php"><i class="fa fa-shopping-cart"></i>BUY NOW</a></li>
                <li><a href="contact.php"><i class="fa fa-phone-square"></i>CONTACT US</a></li>
            </ul>
        </div>

    </div>
</nav>

<script>     
$(document).ready(function() {   
  var url = this.location.pathname;
  var filename = url.substring(url.lastIndexOf('/')+1);
  $('a[href="' + filename + '"]').parent().addClass('active');

});

$('.nav a').on('click', function(){
    $('.navbar-toggle').click()
});
</script>
