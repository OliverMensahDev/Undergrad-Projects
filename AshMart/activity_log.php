<!DOCTYPE html>
<html lang="en">
<head>
  <title>AshMart - Get Used Gadgets From Your Own Colleagues</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600' rel='stylesheet' type='text/css'>
  <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" charset="utf-8"></script>
    <!--  custom css-->
    <link rel="stylesheet" href="css/style.css" media="screen" title="no title">
</head>
<?php
include('conn/db.php');
include('admin_session.php');
?>
<body class="well">
<?php include('nav.php') ?>
<h4 class="alert alert-success col-sm-8 alertPaddingTop" style="font-weight:bold; text-align:center;">
  Click Delete if the image posted violetes our standard. Click Accept to sell via AshMart
</h4>
<h4 class="alert alert-danger col-sm-2 alertPaddingTop" style="font-weight:bold; text-align:center;">
  <a href="feedback.php" target="_blank">Read Feedback</a>
</h4>
<h4 class="alert alert-info col-sm-2 alertPaddingTop" style="font-weight:bold; text-align:center;">
  <a href="seller_logout.php">Logout Here</a>
</h4>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 col-xs-12">
  								<form  method="post" >
  									<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
										<thead>
										  <tr>
                        <th>Item Name</th>
												<th>Item Image</th>
                        <th>Posted By</th>
                        <th>Posted About</th>
                        <th>Delete Item</th>
                        <th>Accept Item</th>
                      </tr>
                    </thead>
										<tbody>
                  <?php
                  $sql = mysql_query("SELECT  products.product_id,   products.name, products.itemImage,  products.diff,
                    student_post.firstname, student_post.lastname,
                    student_post.othername, student_post.class FROM  products INNER  JOIN student_post   ON
                     products.stdPost_id = student_post.stdPost_id where accepted=0
                     ORDER BY  product_id  DESC"
                    );
                    if(is_resource($sql) && mysql_num_rows($sql) > 0){
                  while($row=mysql_fetch_array($sql)){
                    $name = $row['name'];
                    $img = $row['itemImage'];
                    $fn = $row['firstname'];
                    $ln = $row['lastname'];
                    $on = $row['othername'];
                    $FN = $fn . ' '. $ln;
                    $class = $row['class'];
                    $id = $row['product_id'];
                    //time difference
                    $then = $row['diff'];
                    $now = time();
                    $diff = round(abs($now- $then) / 60,2);
									  ?>
                    <tr class="del">
                      <td><?php  echo $name; ?></td>
                      <td>&nbsp;<img class ='img-rounded img-responsive activity'
                       src="<?php echo $img; ?>" alt="img$id" /></td>
                      <td>&nbsp;<?php echo $FN. ' '. $class; ?></td>
                      <td>&nbsp;<?php echo $diff . ' min ago'; ?></td>
                      <td width="120">
                        <a rel="tooltip" title="Delete Post" id="<?php echo $id; ?>"  class="btn btn-danger delete_info">Delete Post
                        </a>
                      </td>
                      <td width="120">
                        <a rel="tooltip"  title="Accept Post"   id="<?php echo $id; ?>" class="btn btn-info accept_info">Accept Post</a>
                      </td>
                  </tr>
					      <?php
                }
              }
              ?>
          </tbody>
        </table>
      </form>
      </div>
      </div>
      </div>
      <script type="text/javascript">
      $(document).ready(function(){
        $('#example').dataTable( {
          "bSort": false
          } );
        });
      $('.delete_info').click( function() {
        var id = $(this).attr("id");
        if(confirm("Are you sure you want to delete the posted information?")){
          $.ajax({
            type: "POST",
            url: "delete_log.php",
            data: ({id: id}),
            cache: false,
            success: function(html){
            window.location="activity_log.php";
          }
        });
        }else{
          return false;
        }
        });

        $('.accept_info').click( function() {
          var id = $(this).attr("id");
          if(confirm("Are you sure you want to accept the posted information?")){
            $.ajax({
              type: "POST",
              url: "accept_post.php",
              data: ({id: id}),
              cache: false,
              success: function(html){
              window.location = "activity_log.php";
            }
          });
          }else{
            return false;
          }
          });

      </script>
    </body>
    </html>
