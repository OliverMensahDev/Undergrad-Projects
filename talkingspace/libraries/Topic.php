<?php
/**Oliver Mensah
 * Topic
 */
class Topic{
  private $db;

  /**
   * Topic constructor
   *
   */
  public function __construct(){
    $this->db = new Database();
  }
  /**
   * get all topics in the datatabase
   * @param $key
   */
  public function getAllTopics(){
    $this->db->query("SELECT topics.*, users.username, users.avatar, categories.name  FROM topics
        INNER JOIN users
        ON topics.user_id = users.id
        INNER JOIN  categories
        ON topics.category_id = categories.id
        ORDER BY create_date DESC
    ");
    return $this->db->resultset();
  }
  /**
   * postThread
   * @param $data
   */
  public function postThread($data){
    $this->db-> query("INSERT INTO topics(category_id,	user_id, title,body)
    VALUES(:cid, :uid,:title, :body)");
    $this->db->bind(":cid", $data['category_id']);
    $this->db->bind(":uid", $data['user_id']);
    $this->db->bind(":title", $data['title']);
    $this->db->bind(":body", $data['body']);
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }
  /**
   * postThread
   * @param $data
   */
  public function updateThread($data, $id){
    $this->db-> query("UPDATE  topics SET category_id = :cid,user_id=:uid, title= :title,body=:body WHERE id=:id");
    $this->db->bind(":cid", $data['category_id']);
    $this->db->bind(":uid", $data['user_id']);
    $this->db->bind(":title", $data['title']);
    $this->db->bind(":body", $data['body']);
    $this->db->bind(":id", $id);
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }
  /**
   * postComment
   * @param $uid,$tid, $body
   */
  public function postComment($uid,$tid, $body){
    $this->db-> query("INSERT INTO replies(user_id,topic_id,body)
    VALUES(:uid, :tid, :body)");
    $this->db->bind(":uid", $uid);
    $this->db->bind(":tid",$tid);
    $this->db->bind(":body", $body);
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }

  /**
   * postComment
   * @param $uid,$tid, $body
   */
  public function updateComment($id, $body){
    $this->db-> query("UPDATE replies SET body=:b WHERE id=:id");
    $this->db->bind(":b", $body);
    $this->db->bind(":id",$id);
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }
  /**
   * postComment
   * @param $uid,$tid, $body
   */
  public function replyToreply($uid,$tid, $body){
    $this->db-> query("INSERT INTO replyToreply(replyToreply_user_id,replyToreply_reply_id,	replyToreply_body)
    VALUES(:uid, :tid, :body)");
    $this->db->bind(":uid", $uid);
    $this->db->bind(":tid",$tid);
    $this->db->bind(":body", $body);
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }
  /**
   * getTopic
   * @param $id
   */
public function getTopic($id){
  $this->db->query("SELECT topics.*, users.username, users.name, users.avatar FROM topics
                    INNER JOIN users
                    ON topics.user_id = users.id
                    WHERE topics.id = :id
                    ");
  $this->db->bind(":id",$id);
   return $this->db->single();
 }
  /**
   * getTopic
   * @param $id
   */
public function getTopicOnly($id){
  $this->db->query("SELECT topics.* FROM topics   WHERE topics.id = :id
                    ");
  $this->db->bind(":id",$id);
   return $this->db->single();
 }
 /**
  *getReplies
  * @param $topic_id
  */
  public function getReplies($topic_id){
    $this->db->query("SELECT replies.id as replyId, replies.user_id,replies.body, replies.topic_id, replies.create_date, users.* FROM replies
                      INNER JOIN users
                       ON replies.user_id = users.id
                      WHERE replies.topic_id = :topic_id
                      ORDER BY replies.id DESC
                    ");
    $this->db->bind(":topic_id",$topic_id);
  return $this->db->resultset();
}
 /**
  *getReplies
  * @param $topic_id
  */
  public function getReply($reply_id){
    $this->db->query("SELECT * FROM replies WHERE id =:id");
    $this->db->bind(":id",$reply_id);
    return $this->db->single();
}
 /**
  *getReplies
  * @param $topic_id
  */
  public function deleteReply($reply_id){
    $this->db->query("DELETE FROM replies WHERE id =:id");
    $this->db->bind(":id",$reply_id);
    if($this->db->execute()){
      return true;
    }
}
 /**
  *getReplies
  * @param $topic_id
  */
  public function deleteThread($id){
    $this->db->query("DELETE FROM topics WHERE id =:id");
    $this->db->bind(":id",$id);
    if($this->db->execute()){
      return true;
    }
}
  public function getTotalReplies($topic_id){
    $this->db->query("SELECT replies.*, users.* FROM replies
                      INNER JOIN users
                       ON replies.user_id = users.id
                      WHERE replies.topic_id = :topic_id
                      ORDER BY replies.id DESC
                    ");
    $this->db->bind(":topic_id",$topic_id);
   $this->db->resultset();
   return $this->db->rowCount();
}
/**
 *getLastReply
 */
 public function getLastReply(){
   $this->db->query("SELECT * FROM replies ORDER BY id DESC");
   return $this->db->single();
}
/**
 *getUser
 *@param $user_id
 */
public function getUser($user_id){
 $this->db->query("SELECT * FROM users WHERE id=:user_id");
 $this->db->bind(":user_id", $user_id);
 return $this->db->single();
}
/**
 *getUserTopics
 *@param $user_id
 */
public function getUserTopics($user_id){
  $this->db->query("SELECT * FROM topics WHERE user_id=:user_id");
  $this->db->bind(":user_id", $user_id);
 return $this->db->resultset();
}
/**
 *getUserReplies
 *@param $user_id
 */
public function getUserReplies($user_id){
  $this->db->query("SELECT * FROM replies WHERE user_id=:user_id");
  $this->db->bind(":user_id", $user_id);
 return $this->db->resultset();
}
/**
 *getByCategory
 *@param $category_id
 */
public function getByCategory($category_id){
     $this->db->query("SELECT topics.*, users.username, users.avatar, categories.name FROM topics
           INNER JOIN users
           ON topics.user_id = users.id
           INNER JOIN  categories
          ON topics.category_id = categories.id
         WHERE topics.category_id=:category_id
        ");
    $this->db->bind(":category_id",$category_id);
    return $this->db->resultset();
}
/**
 *getTotaltopics
 *
 */
   public function getTotaltopics(){
     $this->db->query("SELECT * FROM topics");
     $this->db->resultset();
   return $this->db->rowCount();
  }
  /**
   *getTotalComments
   *
   */
  public function getTotalComments()
  {
    $this->db->query("SELECT * FROM replies");
    $this->db->resultset();
    return $this->db->rowCount();
  }
  /**
   *getTotalUsers
   *
   */
  public function getTotalUsers(){
     $this->db->query("SELECT * FROM users");
     $this->db->resultset();
    return $this->db->rowCount();
  }
  /**
   *getTotalUsers
   *
   */
  public function getCategory($category_id){
       $this->db->query("SELECT * FROM categories WHERE id=:category_id");
       $this->db->bind(":category_id", $category_id);
      return $this->db->single();
}
/**
 *getTotalUsers
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
 *getAllComments
 *
 */
public function getAllComments()
{
  $this->db->query("SELECT * FROM replies");
  $this->db->resultset();
  return $this->db->rowCount();
}
}
