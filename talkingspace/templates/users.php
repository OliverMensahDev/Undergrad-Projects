<?php include'includes/header.php' ?>
<div class="container">
  <p id="success"></p>
   <p id="error"></p>
   <?php displayMessage(); ?>
 <div class="row">
   <div class="col-md-3">
     <div class="panel panel-default">
       <?php if ($user->id==$_SESSION['user_id']): ?>
         <div class="panel-heading">
          <a href="<?php echo BASE_URL."edit.php?profile=". $_SESSION['user_id']?>" class="pull-left btn btn-primary">Edit Profile</a>
          <a href="<?php echo BASE_URL."delete.php?profile=". $_SESSION['user_id']?>" class="pull-right btn btn-danger">Delete Profile</a>
          <div class="clearfix">
          </div>
         </div>
       <?php endif; ?>
      <div class="panel-body text-center">
        <img src="<?php echo BASE_URL. "images/".$user->avatar ?>" alt="" class="img-responsive img-circle">
      </div>
      <div class="panel-footer text-center">
        <h4><?php echo $user->name ?></h4>
         <p><?php echo $user->username?></p>
         <p><?php echo $user->email?></p>
         <a>Active since <?php echo dateFormat($user->join_date)?></a>
         <br>
         <?php if ($user->about): ?>
           <h4><span class="badge">Bio</span></h4>
            <p class="text-justify"><?php echo $user->about ?></p>
         <?php endif; ?>
      </div>

    </div>
   </div>
   <div class="col-md-9">
     <div class="panel panel-default">
      <div class="panel-heading"> <?php echo userPostsCount($user->id) . " Posts and Comments"?>  </div>
      <div class="panel-body">
        <div id="exTab1">
          <ul  class="nav nav-tabs">
            <li class="active">
              <a  href="#Topics" data-toggle="tab">Topics Posted</a>
            </li>
            <li>
              <a href="#Comments" data-toggle="tab">Comments Posted</a>
			     </li>
         </ul>
         <div class="tab-content clearfix">
			  <div class="tab-pane active" id="Topics">
          <div class="block">
          <?php if ($postedTopics): ?>
            <?php foreach ($postedTopics as $key => $value): ?>
              <div class="row">
                <div class="block col-md-12">
                  <a href="<?php echo BASE_URL."topic.php?topic=".urlEnCoded($value->id)?>"><h3><?php echo $value->title ?></h3></a>
                   <p><?php echo replyCount($value->id) . " replies"?></p>
                   <p>Posted on <?php echo $value->create_date ?></p>
                   <?php if ($user->id==$_SESSION['user_id']): ?>
                     <div class="panel-heading">
                      <a href="<?php echo BASE_URL."editThread.php?thread=".$value->id ?>" class=" btn btn-primary">Edit</a>
                      <a href="<?php echo BASE_URL."deleteThread.php?thread=".$value->id?>" class=" btn btn-danger">Delete</a>
                      <div class="clearfix">
                      </div>
                     </div>
                   <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
            <?php else: ?>
              No Thread has been Created <a href="users.php?user=<?php echo $user->id?>">@<?php echo $user->username ?></a>
          <?php endif; ?>
          </div>
				</div>
				<div class="tab-pane" id="Comments">
          <div class="block">
          <?php if ($postedReplies): ?>
            <?php foreach ($postedReplies as $key => $value): ?>
              <div class="row">
                <div class="block col-md-12">
                  <div class="php">
                    <a href="<?php echo BASE_URL."topic.php?topic=".urlEnCoded($value->topic_id)?>"><h3><?php echo $value->body ?></h3></a>
                     <p>Posted on <?php echo $value->create_date ?></p>
                  </div>
                  <div class="js"> </div>
                   <?php if ($user->id==$_SESSION['user_id']): ?>
                     <div class="panel-heading">
                      <a  type="button" data-toggle="modal" data-target="#addCheckout" class=" btn btn-primary delete">Edit</a>
                      <a  type="button" data-toggle="modal" data-target="#delete" class=" btn btn-danger delete" >Delete</a>


                      <div class="modal fade" id="addCheckout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Edit</h4>
                            </div>
                            <div class="modal-body">
                              <form action="" method="post" onsubmit="return sendMessage(this)" id="form">
                                <input type="hidden" class="uid" name="user_id" value="<?php echo $value->id ?>"
                                <div class="form-group">
                                 <textarea name="body" rows="5" cols="100" class="body form-control" required
                                 ><?php echo $value->body?></textarea>
                               </div>
                               <button type="submit" name="comment" class="btn btn-success pull-right" id="button-comment">Update</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                            </div>
                            <div class="modal-body">
                              <form action="" method="post" onsubmit="return deleteReply(this)" id="form">
                                <input type="hidden" class="uid" name="user_id" value="<?php echo $value->id ?>">
                                <button class="btn btn-default" name="cancel"  id="cancel" data-dismiss="modal" aria-label="Close">Cancel</button>
                               <button type="submit" name="comment" id="comment"class="btn btn-danger pull-right" id="button-comment">Yes</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                     </div>
                   <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
            <?php else: ?>
              No Replies has been Created <a href="users.php?user=<?php echo $user->id?>">@<?php echo $user->username ?></a>
          <?php endif; ?>
          </div>
				</div>
			</div>
      </div>
    </div>
   </div>
 </div>
</div>
<?php include("includes/footer.php") ?>
<script type="text/javascript">
function sendMessage(form){
  var uid = form.user_id.value;
  var body = form.body.value;
  if(body.length >0){
    //form.body.
    var xmlhttp = new XMLHttpRequest();
    var params= "uid="+uid+"&body="+body ;
    xmlhttp.open("POST", "<?php echo BASE_URL?>ajax/updateReply.php", true);
    //Send the proper header information along with the request
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {//Call a function when the state changes.
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
         var response = xmlhttp.responseText;
         console.log(response);
          $("#addCheckout").modal('hide');
          $(".php").hide();
          var data = JSON.parse(response);
          var output =
          ` <a href="topic.php?topic=${data.topic_id}"><h3>${data.body}</h3></a>
           <p>Posted on ${data.create_date}</p>
          `;
          $('.js').html("");
          $('.js').html(output);
          var error = document.getElementById('success');
          error.innerHTML  = "<div class='glyphicon glyphicon-ok alert alert-success' style='background:green; color:white'>Successfully update</div>";
         if(response == "FALSE"){
           console.log(this.responseText);
           var error = document.getElementById('error');
           error.innerHTML  = "<div class='glyphicon glyphicon-remove alert alert-danger' style='background:tomato; color:white'>Could not Successfully post comment</div>";
         }
      }
    }
  }
    xmlhttp.send(params);
    setInterval(function() {
      var alert = document.getElementById('success');
      success.innerHTML = ''
   }, 4000);
    return false;
  }

function deleteReply(form){
  var uid = form.user_id.value;
    //form.body.
    var xmlhttp = new XMLHttpRequest();
    var params= "uid="+uid ;
    xmlhttp.open("POST", "<?php echo BASE_URL?>ajax/deleteComment.php", true);
    //Send the proper header information along with the request
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {//Call a function when the state changes.
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
         var response = xmlhttp.responseText.trim();
         console.log(response);
         if(response == "TRUE"){
          $("#delete").modal('hide');
          $(".php").hide();
          $('.js').html("");
          $(".delete").hide();

          var success = document.getElementById('success');
          success.innerHTML  = "<div class='glyphicon glyphicon-ok alert alert-success' style='background:green; color:white'>Successfully delete</div>";
        }
         if(response == "FALSE"){
           console.log(this.responseText);
           var error = document.getElementById('error');
           error.innerHTML  = "<div class='glyphicon glyphicon-remove alert alert-danger' style='background:tomato; color:white'>Could not Successfully post comment</div>";
         }
    }
  }
    xmlhttp.send(params);
    setInterval(function() {
      var alert = document.getElementById('success');
      success.innerHTML = ''
   }, 4000);
    return false;
  }
  </script>
