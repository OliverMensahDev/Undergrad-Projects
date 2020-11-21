<?php
include('header.php');
include ("session.php");
$query = mysql_query("SELECT  firstname, lastname FROM student_post WHERE stdPost_id=$session_id ");
$row = mysql_fetch_array($query);
$fname =$row['firstname'];
$lname = $row['lastname'];
$name = $fname . " " . $lname;
?>
<body class='well'>
  <?php include('nav.php') ?>
  <h4 class="alert alert-success col-xs-12 alertPaddingTop" style="font-weight:bold; text-align:center;">
    Add Product Details
  </h4>
  <div class="container-fluid sell">
    <form role="form" method="post" enctype="multipart/form-data" onsubmit="return Checkfiles(this);">
      <div class="form-group">
        <label for="title">Item Name</label>
          <input type="text" name="name"  class="form-first-name form-control" id="form-first-name" required>
        </div>
        <div class="form-group">
          <label for="">Add Some Specs about your gadget</label>
            <textarea class="form-control" name="content" rows="3" cols='100%' placeholder="Like 8GB, 740 HDD, TOUCHSCREEN, etc"></textarea>
        </div>
      <div class="form-group">
        <label for="">Select Category</label>
        <select class="form-control" name="category" required>
          <option value="Phones">Phone</option>
          <option value="Clothes">Clothes</option>
          <option value="Shoes">Shoes</option>
          <option value="Tablets">Tablet</option>
          <option value="Laptops">Laptop</option>
          <option value="Peripherals">Peripherals</option>
        </select>
    </div>
    <div class="form-group">
      <label for="">Currency Type</label>
      <select class="form-control" name="currency" required>
        <option value="$">Dollars</option>
        <option value="GHS">Ghana Cedis</option>
      </select>
  </div>
    <div class="form-group">
      <label for="">Price of Item(Value)</label>
      <input type="int" name="price" class="form-control">
    </div>
    <div class="form-group">
      <label for="">Is price Of your Item Negotiable?</label>
      <select class="form-control" name="nego" required>
        <option value="The price of the item you have chosen is negotiable">Yes</option>
        <option value="The price of the item you have chosen is NOT negotiable">No</option>
      </select>
  </div>
    <div class="form-group">
      <label for="image">Item Photo:</label>
      <input type="file" class="form-control"  name="image" id ='image' required accept="image/*" onChange="validate(this.value)">
<!-- image validation -->
      <script type="text/javascript">
      function validate(file) {
        var ext = file.split(".");
        ext = ext[ext.length-1].toLowerCase();
        var arrayExtensions = ["jpg" , "jpeg", "png"];

        if (arrayExtensions.lastIndexOf(ext) == -1) {
          alert("Invalid File Format");
          $("#image").val("");
        }
      }
</script>

    </div>
    <button type="submit" name="submit" class="btn" id='but'>Post</button>
    </form>
    </div>
    <?php
    if(isset($_POST['submit'])){
      $name = $_POST['name'];
      $content = $_POST['content'];
      $category= $_POST['category'];
      //image
     $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
     $image_name = addslashes($_FILES['image']['name']);
     $image_size = getimagesize($_FILES['image']['tmp_name']);
     move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $_FILES["image"]["name"]);
     $itemImage = "upload/" . $_FILES["image"]["name"];
    // date_added
    $date =date('Y-m-d' );
    $day =  date('l');
    $Date = $day . ', ' . $date;
    //negotiable and price
    $nego = $_POST['nego'];
    $price = $_POST['price'];

    //time difference
    $then = time();

    mysql_query("INSERT INTO products (name,content,category,itemImage, date_added, stdPost_id, price, negotiable, diff)
    values('$name','$content','$category','$itemImage','$Date', '$session_id','$price', '$nego', '$then')")or die(mysql_error());
    ?>
      <script >
                var delay = 100;
                	setTimeout(function(){ window.location = 'nortifier.php'  }, delay);
      </script>

      <?php
    }
?>
</body>
</html>
