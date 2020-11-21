<?php include_once 'includes/header.php'; ?>
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-md-6 col-md-offset-3 block">
      <h1 class="text-center">Create Thread</h1>
        <form class="role" action="updateThread.php" method="post" onsubmit="return validate(this)">
          <input type="hidden" name="topic_id" required class="form-control" required
          value='<?php echo $topic->id ?>'>
          <div class="form-group">
              <label for="">Select Category</label>
            <select class="form-control" name="category_id" required >
              <option value="0">Select Category</option>
              <?php if ($getAllCategories): ?>
                <?php foreach ($getAllCategories as $key => $value): ?>
                  <?php if ($topic->category_id == $value->id ): ?>
                    <option value="<?php echo $value->id?>" selected><?php echo $value->name?> </option>
                  <?php endif; ?>
                <?php endforeach; ?>
                <?php else: ?>
                  <option value="no">No Category Yet</option>
              <?php endif; ?>
            </select>
          </div>
          <input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"]?>">
          <div class="form-group">
            <label for="">Thread Title</label>
            <input type="text" name="title" required class="form-control" required
            value='<?php echo $topic->title ?>'>
          </div>
          <div class="form-group">
            <label for="">Thread Body</label>
          <textarea name="body" rows="8" cols="80" class="form-control" required>
            <?php echo $topic->body?>
          </textarea>
          </div>
          <button type="submit" name="postUpdate" class="btn btn-success pull-right">Update</button>
        </form>
    </div>
  </div>
</div>
<?php include_once 'includes/footer.php'; ?>
<script type="text/javascript">
window.onload = function(){
  document.getElementById('background').classList.add("background-for-create");
}

function validate(form){
	var errors = [];
  var cat = form.category_id.value;
	if (cat == "0") {
		errors[errors.length] = "Please Option cannot be selected";
	}
  if(errors.length > 0) {
		reportErrors(errors);
		return false;
 }
 return true;
}

function reportErrors(errors){
 var msg = "";
 for (var i = 0; i<errors.length; i++) {
 var numError = i + 1;
  msg += "\n" + numError + ". " + errors[i];
}
 alert(msg);
}

</script>
