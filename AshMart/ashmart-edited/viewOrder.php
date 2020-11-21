<?php
 include('header.php') ;
 $get_ProductID = $_GET['pnref'];
 ?>
 <body>
   <?php include("nav.php");?>
   <?php
      $query = mysql_query("SELECT product_id, name,itemImage,  category, content,price, negotiable,
        firstname, lastname,othername, class, phone_number FROM  products  INNER  JOIN student_post
        ON products.stdPost_id = student_post.stdPost_id where product_id='$get_ProductID'"
        );
         $row= mysql_fetch_array($query);
         $name = $row['name'];
         $img = $row['itemImage'];
         $category = $row['category'];
         $content =$row['content'];
         $price =$row['price'];
         $nego =$row['negotiable'];
         $fn = $row['firstname'];
         $ln = $row['lastname'];
         $on = $row['othername'];
         $FN = $fn . '  '. $on . ' '. $ln;
         $class = $row['class'];
         $phone = $row['phone_number'];
         $id = $row['product_id'];
         echo "
         <div class='wrapper'>
            <div class='container well'>
              <div class='row'>
               <div class='col-md-5 col-sm-6'>
                 <img class ='img-rounded img-responsive' src=' $img' alt='item$id' >
              </div>
              <div class='col-md-7 col-sm-6'>
                <h2>Product Details</h2>
                <hr/>
                <h4>Name & Category: $name,  $category</h4>
                <p>Description: $content</p>
                <p>Price: $price</p>
                <p>$nego</p>
                <br>
                <h2>Product Owner Info</h2>
                <hr/>
                <h4>Name: $FN   </h4>
                <h4>Year Group: $class    </h4>
                <h4>Call/ Whatsapp: $phone   </h4>
             </div>
            </div>
          </div>
        </div>
         ";
      ?>
 </body>
 </html>
