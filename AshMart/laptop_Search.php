<?php include('header.php') ;?>
 <body>
   <?php include("nav.php");?>
   <script src='js/quickSearch.jquery.js'></script>
   <script>
   $(function () {
     $('input#id_search').quicksearch('div#search div.panel');

     });
 </script>

   <div class="container-fluid well">
     <div class="row" style="margin-top:70px">
       <div class="col-xs-6">
         <form action="#" role='form'>
     			<fieldset>
            <div class="form-group">
              <input type="text" name="search" class='form-control' id="id_search" placeholder="Search item by name ONLY" autofocus  />
            </div>
     			</fieldset>
     			<br/>
     		</form>
       </div>
       <div class="col-xs-6">
         <h4 class="alert alert-success  pull-right" style="font-weight:bold;">
           <a href="order.php">Back</a>
         </h4>
     </div>
     </div>
       <div class="row" id='search'>
         <?php
         $sql = mysql_query("SELECT product_id, name, category, content, date_added, itemImage,
           firstname, lastname,othername, class FROM  products  INNER  JOIN student_post
           ON products.stdPost_id = student_post.stdPost_id WHERE accepted=1 and category='Laptops'  ORDER BY  product_id  DESC LIMIT 12"
           );
           if(is_resource($sql) && mysql_num_rows($sql) > 0){
         while($row=mysql_fetch_array($sql)){
           $name = $row['name'];
           $img = $row['itemImage'];
           $date = $row['date_added'];
           $fn = $row['firstname'];
           $ln = $row['lastname'];
           $on = $row['othername'];
           $FN = $fn . ' '. $ln;
           $class = $row['class'];
           $id = $row['product_id'];
           echo "
           <div class='col-sm-3 col-xs-12'>
           <div class='panel panel-default'>
             <div class='panel-heading'>
               <h4 class='imgName'>$name </h4>
               <p>posted on:<br> $date</p>
                </p>
             </div>
               <div class='panel-body'>
                 <img class ='img-rounded img-responsive imgCustom'
                 src=' $img' alt='item$id' >
             </div>
             <div class='panel-footer'>
             <a href='viewOrder.php?pnref=$id' class='btn btn-info btn-responsive' role='button'>View Details and Order</a>
           </div>
           </div>
           </div>
           ";
           }
           }else{
           echo "
           <div class='col-sm-12 col-xs-12'>
           <h4 class='noItems'>No Recent Items</h4>
           </div>
           ";
           }
           ?>

        </div>
      </div>
 </body>
 </html>
