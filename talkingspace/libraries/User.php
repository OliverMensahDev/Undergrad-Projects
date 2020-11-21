<?php
/**Oliver Mensah
* User class
*
*
*/
class User{
  private $db;
  public function __construct()
  {
    $this->db = new Database;
  }
  /**
  * userExist
  *@param $username
  *
  */
  function userExist($username){
    $this->db->query("SELECT * FROM users where username= :username");
    $this->db->bind(":username",$username);
    $this->db->resultset();
    if ($this->db->rowCount()>0) {
       return true;
     }
  }
  /**
  * register
  *@param $data
  *
  */
  public function register($data){
    $this->db-> query("INSERT INTO
    users(name, email,avatar, username, password, about, last_activity)
    VALUES(:name, :email,:avatar,:username, :password,:about,:last_activity)");
    $this->db->bind(":name", $data['name']);
    $this->db->bind(":email", $data['email']);
    $this->db->bind(":username", $data['username']);
    $this->db->bind(":avatar", $data['profile']);
    $this->db->bind(":password", $data['password']);
    $this->db->bind(":about", $data['about']);
    $this->db->bind(":last_activity", $data['last_activity']);
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }

  /**
  *
  *uploadAvatar
  *
  */

 public function uploadAvatar()
  {
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["profile"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if file already exists
    if(file_exists($target_file)) {
      redirect("register.php","Sorry, file already exists.","error");
      $uploadOk = 0;
    }
    // Check file size
    if($_FILES["profile"]["size"] > 500000) {
      redirect("register.php","Sorry, your file is too large.", "error");
      $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      redirect("register.php","Sorry, only JPG, JPEG, PNG & GIF files are allowed.", "error");
      $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        redirect("register.php","Sorry, your file was not uploaded.", "error");
        // if everything is ok, try to upload file
        } else {
          if(
            move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {
            return true;
        } else {
           redirect("register.php", "Sorry, there was an error uploading your file.", "error");
           }
       }
  }
  /**
  * setClientData
  *@param $row
  *
  */
  private function setClientData($row){
   $_SESSION['user_id']= $row->id;
   $_SESSION['username']= $row->name;
   $_SESSION['email']= $row->email;
 }
 /**
 * login
 *@param $username $password
 *
 */
  public function login($username, $password)
  {
    $this->db->query("SELECT * FROM users where username = :username and activated ='ACTIVE'");
    $this->db->bind(":username", $username);
    $row = $this->db->single();
    if (password_verify($password, $row->password) && $this->db->rowCount() > 0) {
      $this->setClientData($row);
      return true;
    }else{
      return false;
    }
  }
  /**
  * delete
  *@param $user_id
  *
  */
  public function delete($user_id)
  {
    $this->db->query("UPDATE users SET activated ='INACTIVE' WHERE id=:uid");
    $this->db->bind(":uid", $user_id);
    if ($this->db->execute()) {
      return true;
    }
  }
  /**
  * prompted
  *@param $username
  *
  */
  public function prompted($username)
  {
    $this->db->query("UPDATE users SET prompted_date ='NOW()' WHERE username=:u");
    $this->db->bind(":u", $username);
    if ($this->db->execute()) {
      return true;
    }
  }

  /**
  * activate
  *@param $username
  *
  */
  public function activate($username)
  {
    $this->db->query("UPDATE users SET activated='ACTIVE' WHERE username=:u");
    $this->db->bind(":u", $username);
    if ($this->db->execute()) {
      return true;
    }
  }
  /**
  * setAdminData
  *@param $row
  *
  */
  private function setAdminData($row){
    $_SESSION['isAdmin_logged_in'] = true;
    $_SESSION['admin_id']= $row->id;
    $_SESSION['adminusername']= $row->username;
  }
  /**
  * loginAdmin
  *@param $email, $password
  *
  */

  public function loginAdmin($email, $password)
 {
   $this->db->query("SELECT * FROM  admin WHERE email = :email");
   $this->db->bind(":email", $email);
  if( $row = $this->db->single()){
    if (password_verify($password, $row->password) && $this->db->rowCount() > 0 ) {
      $this->setAdminData($row);
      return true;
    }else{
      return false;
    }
  }else{
    return false;
  }

 }

 /**
 * order
 *@param $data
 *
 */
  public function order($data){
    $this->db-> query("INSERT INTO orders(user_id, movie_id, download_url)
    VALUES(:uid, :mid,:dlink)");
    $this->db->bind(":uid", $data['user_id']);
    $this->db->bind(":mid", $data['movie_id']);
    $this->db->bind(":dlink", $data['download_link']);
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }

  /**
  * movieOrderCheck
  *@param $user_id, $movie_id
  *
  */
  public function movieOrderCheck($user_id, $movie_id)
  {
    $this->db->query("SELECT * FROM orders where user_id= :uid AND movie_id=:mid");
    $this->db->bind(":uid",$user_id);
    $this->db->bind(":mid",$movie_id);
    $this->db->resultset();
    if ($this->db->rowCount()>0) {
       return true;
     }
  }

  /**
  * logOut
  *
  */
  public function logOut()
  {
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    return true;
  }
  /**
  * logOutAdmin
  *
  */
  public function logOutAdmin()
  {
    unset($_SESSION['isAdmin_logged_in']);
    unset($_SESSION['admin_id']);
    unset($_SESSION['adminusername']);
    return true;
  }

  /**
  * addCategory
  *@param $data
  */
  public function addCategory($data)
  {
    $this->db-> query("INSERT INTO categories(name) VALUES(:name)");
    $this->db->bind(":name", $data);
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }

  /**
  * getUser
  *@param $user_id
  */

  public function getUser($user_id){
   $this->db->query("SELECT * FROM users WHERE id=:user_id");
   $this->db->bind(":user_id", $user_id);
   return $this->db->single();
 }

 /**
 * updateUser
 *@param $data,$user_id
 */

 public function updateUser($data,$user_id){
   $this->db->query("UPDATE users SET
   email = :e,
   username = :u,
   about = :a,
   password  =  :p,
   last_activity = :l
   WHERE id = :uid;
   ");
   $this->db->bind(":e", $data['email']);
   $this->db->bind(":u", $data['username'] );
   $this->db->bind(":a",   $data['about']);
   $this->db->bind(":p",   $data['password']);
   $this->db->bind(":l",$data['last_activity']);
   $this->db->bind(":uid", $user_id);
   if($this->db->execute()){
     return true;
   }
  }
  /**
  * allUsrs
  */
 public function allUsrs()
 {
   $this->db->query("SELECT * FROM users");
   $this->db->resultset();
   return $this->db->rowCount();
 }
  /**
  * getUsrs
  */
 public function getUsers()
 {
   $this->db->query("SELECT * FROM users");
   return  $this->db->resultset();
 }
 /**
 * allActiveUsrs
 */
 public function allActiveUsrs()
 {
   $this->db->query("SELECT * FROM users where activated='ACTIVE'");
   $this->db->resultset();
   return $this->db->rowCount();
 }
}
