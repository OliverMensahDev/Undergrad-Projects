<?php include 'core/init.php'; ?>
<?php
$user = new User();
if(isAdmin()){
 if(isset($_POST['do_AddCategory'])){
  $user = new User();
    if($user->addCategory(ucwords(strtolower($_POST['name'])))){
      redirect("auth_dashboard.php","Category successfully added","success");
  }else{
    redirect("auth_dashboard.php", "Failed to add category","error");
  }
}
}else{
  redirect("index.php","No permission for you ", "error");
}
