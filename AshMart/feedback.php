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
<h4 class="alert alert-success col-sm-10 alertPaddingTop" style="font-weight:bold; text-align:center;">
  FeedBack
</h4>
<h4 class="alert alert-danger col-sm-2 alertPaddingTop" style="font-weight:bold; text-align:center;">
  <a href="seller_logout.php">Logout Here</a>
</h4>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 col-xs-12">
  								<form  method="post" >
  									<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
										<thead>
										  <tr>
                        <th>Sender Name</th>
												<th>Sender Image</th>
                        <th>Message</th>
                        <th>Delete Message</th>

                      </tr>
                    </thead>
										<tbody>
                  <?php
                  $sql = mysql_query("SELECT * FROM feedback"
                    );
                    if(is_resource($sql) && mysql_num_rows($sql) > 0){
                  while($row=mysql_fetch_array($sql)){
                    $name = $row['name'];
                    $email = $row['email'];
                    $content = $row['content'];
                    $id = $row['id'];
									  ?>
                    <tr class="del">
                      <td><?php  echo $name; ?></td>
                      <td><?php echo $email; ?></td>
                      <td>&nbsp;<?php echo $content; ?></td>
                      <td width="120">
                        <a rel="tooltip" title="Delete Post" id="<?php echo $id; ?>"  class="btn btn-danger delete_info">Delete Post
                        </a>
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
        if(confirm("Are you sure you want to delete the message?")){
          $.ajax({
            type: "POST",
            url: "delete_message.php",
            data: ({id: id}),
            cache: false,
            success: function(html){
              $(".del"+id).fadeOut('slow');
          }
        });
        }else{
          return false;
        }
        });



      </script>
    </body>
    </html>
