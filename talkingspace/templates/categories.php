<?php include ('includes/header.php') ; ?>
<div class="jumbotron" style="margin-top:-50px;">
    <div class="">
        <div class="container-fluid">
            <center>
                <h1>All Threads for <?php echo $category->name ?></h1>
            </center>
        </div>
    </div>
</div>
<div class="container ">
 <p id="success"></p>
  <p id="error"></p>
  <?php  displayMessage(); ?>
   <?php if($topics): ?>
      <?php foreach($topics as $topic):?>
          <hr>
         <div class="row">
           <div class="col-md-8 col-md-offset-2">
             <a href="topic.php?topic=<?php echo $topic->id?>">
              <h2 class="post-title">
                <?php echo $topic->title?>
              </h2>
             </a>
             <small><i class="fa fa-eye"></i><?php echo replyCount($topic->id)?></small>
             <h3 class="post-subtitle">
                 <span class="badge badge-success"><a href="categories.php?category=<?php echo $topic->category_id?>" style="color:white;"><?php echo $topic->name?></a></span>
             </h3>
             <p class="post-meta">Asked by <a href="users.php?user=<?php echo $topic->user_id?>"><?php echo $topic->username?></a> on <?php echo dateFormat($topic->create_date)?>
             </p>
              <div class="row">
                <?php if (isNomalUsr()): ?>
                  <div class="col-md-offset-6 col-md-6">
                     <a class="btn btn-primary" id="reply">reply to post</a>
                      <form action="" method="post" onsubmit="return sendMessage(this)" id="form">
                        <input type="hidden" class="uid" name="user_id" value="<?php echo isset($_SESSION['user_id'])?$_SESSION['user_id']:''; ?>">
                        <input type="hidden" class="tid" name="topic_id" value="<?php echo $topic->id?>">
                        <div class="form-group">
                         <textarea name="body" rows="5" cols="100" class="body form-control" required></textarea>
                       </div>
                       <button type="submit" name="comment" class="btn btn-success pull-right" id="button-comment">Add Comment</button>
                      </form>
                 </div>

                <?php endif; ?>
              </div>
          </div>
        </div>
       <?php endforeach;?>
     <?php else:?>
        <h1 class="text-center">No Thread Posted</h1>
     <?php endif; ?>
</div>
<?php include("includes/footer.php") ?>

<!--  ajax for commenting-->
<script type="text/javascript">
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
            form.style.display ='none';
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

</script>
</body>
