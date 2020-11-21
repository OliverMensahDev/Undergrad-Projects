<?php include("includes/header.php"); ?>
<div class="container">
  <p id="success"></p>
   <p id="error"></p>
  <div class="row">
    <div class="col-md-2">
      <img src="<?php echo BASE_URL."images/". $topic->avatar?>" alt="" class="img-responsive img-circle">
    </div>
    <div class="col-md-8">
      <h2 class="text-center"><?php  echo $topic->title?></h2>
      <hr>
      <p class="lead"><?php echo $topic->body?></p> <br>
      <?php if (isNomalUsr()): ?>
        <h3 class="text-center">Reply to Post</h3>
        <form action="" method="post" onsubmit="return sendMessage(this)">
          <input type="hidden" class="uid" name="user_id" value="<?php echo isset($_SESSION['user_id'])?$_SESSION['user_id']:''; ?>">
            <input type="hidden" class="tid" name="topic_id" value="<?php echo $topic->id?>">
            <div class="form-group">
               <textarea name="body" rows="4" cols="50" class="body form-control" required></textarea>
             </div>
             <button type="submit" name="comment" class="btn btn-success pull-right" id="button-comment">Add Comment</button>
        </form>
      <?php endif; ?>
      <br><br>
      <h1 class="lead text-center"> <?php echo $totalReplies; ?> Comments</h1>
      <?php foreach ($replies as $key => $value): ?>
           <div class="row"  id='comments' class="">
               <div class="col-md-4">
                  <a href="users.php?user=<?php echo $value->user_id?>"><?php echo $value->username. " replied  on " . "<br> ". dateFormat($value->create_date)?></a>
               </div>
               <div class="col-md-8">
                 <p class="lead"><?php echo $value->body?></p>
                 <a class="pull-right" id="reply" style="margin-top:-5px;">reply to Comment</a>
                 <br>
                   <?php if (replyToreply($value->replyId)): ?>
                    <?php foreach (replyToreply($value->replyId) as $replyToreply): ?>
                      <div class="row well"   id='replyToreply'   class="margin-bottom:10x">
                      <div class="col-md-4">
                         <a href="users.php?user=<?php echo $replyToreply->replyToreply_user_id?>"><?php echo $_SESSION['username'] ." replied  on " . "<br> ". dateFormat($value->create_date)?></a>
                      </div>
                      <div class="col-md-8">
                        <p class="lead"><?php echo $replyToreply->replyToreply_body?></p>
                      </div>
                    </div>
                    <?php endforeach; ?>
                 <?php endif; ?>

                  <form action="" method="post" onsubmit="return sendReplyToReply(this)" id="form">
                    <input type="hidden" class="uid" name="user_id" value="<?php echo isset($_SESSION['user_id'])?$_SESSION['user_id']:''; ?>">
                    <input type="hidden" class="tid" name="reply_id" value="<?php echo $value->replyId?>">
                    <div class="form-group">
                     <textarea name="body" rows="5" cols="100" class="body form-control" required></textarea>
                   </div>
                   <button type="submit" name="comment" class="btn btn-success pull-right" id="button-comment">Update</button>
                   <br>
                  </form>
                </div>
             </div>
      <?php endforeach; ?>
     </div>
    </div>
  </div>
<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
function sendMessage(form){
  var uid = form.user_id.value;
  var tid = form.topic_id.value;
  var body = form.body.value;
  if(body.length >0){
    //form.body.
    var xmlhttp = new XMLHttpRequest();
    var params= "tid="+tid +"&uid="+uid+"&body="+body ;
    xmlhttp.open("POST", "<?php echo BASE_URL?>ajax/comment.php", true);
    //Send the proper header information along with the request
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {//Call a function when the state changes.
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
         var response = xmlhttp.responseText.trim();
         console.log(response);
         if(response == "TRUE"){
           form.body.value = "";
           var success = document.getElementById('success');
           success.innerHTML  = "<div class='glyphicon glyphicon-ok alert alert-success' style='background:green; color:white'>Successfully commented on the topic</div>";
           getComment();
           document.getElementsByClassName('hideform').style.display='none';
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
  }

  function getComment() {
    var output = '';
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "<?php echo BASE_URL?>/ajax/getCurrentComment.php", true);
    xhr.onreadystatechange = function() {
      if(xhr.readyState == 4 && xhr.status == 200) {
          var response = this.responseText;
          console.log(response);
          var result = JSON.parse(response);
          output = `
          <div class="col-md-4">
              <a href="users.php?user=${result.user_id}" class="pull-right"> ${result.username} replied on ${result.create_date}</a>
          </div>
          <div class="col-md-8">
            <p class="lead">${result.body}</p>
          </div>
          `;

      }
      $("#comments").prepend(output)
    }
    xhr.send();
  }
  function sendReplyToReply(form){
    var uid = form.user_id.value;
    var tid = form.reply_id.value;
    var body = form.body.value;
    if(body.length >0){
      //form.body.
      var xmlhttp = new XMLHttpRequest();
      var params= "tid="+tid +"&uid="+uid+"&body="+body;
      xmlhttp.open("POST", "<?php echo BASE_URL?>ajax/replyTorepy.php", true);
      //Send the proper header information along with the request
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.onreadystatechange = function() {//Call a function when the state changes.
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
           var response = xmlhttp.responseText.trim();
           console.log(response);
           if(response == "TRUE"){
             form.body.value = "";
             var success = document.getElementById('success');
             success.innerHTML  = "<div class='glyphicon glyphicon-ok alert alert-success' style='background:green; color:white'>Successfully replied on the comment</div>";
             getCommentToComment()
             form.style.display ='none';
           }
           if(response == "FALSE"){
             console.log(this.responseText);
             var error = document.getElementById('error');
             error.innerHTML  = "<div class='glyphicon glyphicon-remove alert alert-danger' style='background:tomato; color:white'>Could not Successfully post s</div>";
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
    }


  function getCommentToComment() {
    var output = '';
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "<?php echo BASE_URL?>/ajax/getCurrentComment.php", true);
    xhr.onreadystatechange = function() {
      if(xhr.readyState == 4 && xhr.status == 200) {
          var response = this.responseText;
          console.log(response);
          var result = JSON.parse(response);
          output = `
          <div class="col-md-4">
              <a href="users.php?user=${result.user_id}" class="pull-right"> ${result.username} replied on ${result.create_date}</a>
          </div>
          <div class="col-md-8">
            <p class="lead">${result.body}</p>
          </div>
          `;


      }
      $("#replyToreply").prepend(output)
    }
    xhr.send();
  }
  //hide commment form on page load
  var form = document.querySelectorAll('#form');
  window.onload = function(){
     form.forEach(el=>{
       el.style.display = 'none';
     })
  }
  //show comment form
  var reply = document.querySelectorAll('#reply');
  reply.forEach((elem, index) => {
    elem.onclick = function(){
      this.style.display = 'none';
      form[index].style.display = 'block';
    }
  });
</script>
