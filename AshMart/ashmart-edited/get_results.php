<?php
$sql = mysql_query("SELECT product_id, name, category, content, date_added, itemImage,
  firstname, lastname,othername, class FROM  products
  INNER  JOIN student_post
  ON products.stdPost_id = student_post.stdPost_id
  ORDER BY  product_id  DESC LIMIT 12"
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
