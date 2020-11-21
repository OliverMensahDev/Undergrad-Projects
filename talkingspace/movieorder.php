<?php
include 'core/init.php';
if(isNomalUsr()){
  $user = new Cart;
  if(filter_has_var(INPUT_POST, "buy")){
    $data = array();
    $data['user_id'] =$_SESSION['user_id'];
    $data['download_link'] = $_POST['download_link'];
    $data['movie_id']   = $_POST['movie_id'];
    $user->add($data['movie_id'], $data['download_link'],$data['movie_id']);
    foreach ($_SESSION['cart_item'] as  $values) {
      foreach ($values as $key => $value) {
        echo $key . " " . $value . "<br><br>";
      }
    }
//     if(!$user->movieOrderCheck($data['user_id'],$data['movie_id'])){
//       if($user->order($data)){
//         email($_SESSION['email'], $_SESSIN['username'], "<i>Thank you for using our service. Use this <a href= ". $data['download_link']. " target='_blank'>link</a> to download the movie you ordered <br>
//         </i>", 'movies.php', "Your movie has been sent to your email. Use the link to to access it");
// }
// }else{
//   redirect("index.php","You have already have the link to access the movie. If you need your downloading link, kindly contact us", "error");
// }
}
}else{
  redirect("index.php","Permission Denied to access this page.", "error");
}
