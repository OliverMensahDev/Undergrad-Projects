<script type="text/javascript">
    $(window).scroll(function ()
    {
	  if($(document).height() <= $(window).scrollTop() + $(window).height())
	  {
		loadmore();
	  }
    });

    function loadmore()
    {
      var val = document.getElementById("row_no").value;
      $.ajax({
      type: 'post',
      url: 'get_results.php',
      data: {
       getresult:val
      },
      success: function (response) {
	  var content = document.getElementById("search");
      content.innerHTML = content.innerHTML+response;

      // We increase the value by 10 because we limit the results by 10
      document.getElementById("row_no").value = Number(val)+10;
      }
      });
    }
</script>
<?php
$ip = '41.79.97.5';
//$ip ="::1";
$getIp = $_SERVER['REMOTE_ADDR'];
if($ip == $getIp){
 include('header.php') ;
 ?>
   <body>
     <?php include("nav.php");?>
     <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.0/jquery.quicksearch.js'></script>
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
                <input type="text" name="search" class='form-control' id="id_search" placeholder="Search item by name or category" autofocus  />
              </div>
       			</fieldset>
       			<br/>
       		</form>
         </div>
         <div class="col-xs-6">
           <div class="dropdown">
         <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select a category
          <span class="caret"></span></button>
           <ul class="dropdown-menu">
              <li><a href="laptop_Search.php" class="btn btn-info">Laptops</a></li>
              <li><a href="phones_Search.php" class="btn btn-info">Phones</a></li>
              <li><a href="shoes_Search.php" class="btn btn-info">Shoes</a></li>
              <li><a href="clothes_Search.php" class="btn btn-info">Clothes</a></li>
              <li><a href="peripherals_Search.php" class="btn btn-info">Peripherals</a></li>
          </ul>
       </div>
     </div>
       </div>
         <div class="row" id='search' >
           <?php
           $sql = mysql_query("SELECT product_id, name, category, content, date_added, itemImage,
             firstname, lastname,othername, class FROM  products  INNER  JOIN student_post
             ON products.stdPost_id = student_post.stdPost_id WHERE accepted=1  ORDER BY  product_id  DESC LIMIT 12"
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
          <input type="hidden" id="row_no" value="10">
        </div>
   </body>
   </html>
   <?php
 }else{
    include('header.php');
    ?>
   <body class="well">
   <?php include('nav.php') ?>
   <h4 class="alert alert-success alertPaddingTop" style="font-weight:bold; text-align:center;">
     This site is for campus use. To access the platform, you must be in school.
   </h4>
 <?php
 }
  ?>
