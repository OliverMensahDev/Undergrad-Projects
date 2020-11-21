<?php include("header.php") ;?>
<body class='well'>
    <?php include("nav.php"); ?>
    <div class="container bg-grey alertPaddingTop">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span>Ashesi University,1 University Avenue, Berekuso</p>
      <p><span class="glyphicon glyphicon-phone"></span>0544892841 / </p>
      <p><span class="glyphicon glyphicon-envelope"></span> sellorgetviaashmart@gmail.com</p>
    </div>
    <div class="col-sm-7">
      <form  method="post">
        <div class="row">
          <div class="col-sm-6 form-group">
            <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
          </div>
          <div class="col-sm-6 form-group">
            <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
          </div>
        </div>
        <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
        <div class="row">
          <div class="col-sm-12 form-group">
            <button class="btn btn-default pull-right" type="submit" name="send">Send</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <!-- Set height and width with CSS -->
<div id="googleMap" style="height:400px;width:100%; padding-top:10px;"></div>

<!-- Add Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAz7lUlTmuiSwykWItU-ge9Bo98VyWqHJg"></script>
<script>
var myCenter = new google.maps.LatLng(5.7597997,-0.2197507);

function initialize() {
var mapProp = {
center:myCenter,
zoom:12,
scrollwheel:false,
draggable:false,
mapTypeId:google.maps.MapTypeId.ROADMAP
};

var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker = new google.maps.Marker({
position:myCenter,
});

marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

  </div>
</div>
<?php
if(isset($_POST['send'])){
  $name= mysql_real_escape_string($_POST['name']);
  $email= mysql_real_escape_string($_POST['email']);
  $comments= mysql_real_escape_string($_POST['comments']);
  $sql ="INSERT INTO feedback(name, email, content) VALUES('$name','$email','$comments')";
  $query = mysql_query($sql);
  if($query){
    ?>
    <script type="text/javascript">
      alert("Thanks for the feedback or the comment");
      window.location= "index.php";
    </script>
    <?php
  }
}
 ?>
    </body>
</html>
