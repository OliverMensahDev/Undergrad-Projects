<?php
  Require 'Database.php';
  /**
  *This class contains core logic of the USSD application
  *
  **/ 
  class ApplicationFunctions{
    public function __construct(){}
    public function __destruct(){}
    
    public function IdentifyUser($msisdn){
      $db = Database::getInstance(); 
      try{
        $stmt = $db->prepare("insert into sessionmanager(msisdn) values (:msisdn)");
        $stmt->bindParam(":msisdn",$msisdn);
        $stmt->execute();
        if($stmt->rowCount() > 0){ 
          return TRUE;
        }
      }catch (PDOException $e) {
        #$e->getMessage();
        return FALSE;
      }
    }
    
    /**
    *Method to delete a user session
    *@param msisdn
    *@return Boolean
    */
    public function deleteSession($msisdn){
      $db = Database::getInstance();
      try{
        $stmt = $db->prepare("Delete FROM sessionmanager where msisdn= :msisdn");
        $stmt->bindParam(":msisdn",$msisdn);
        $stmt->execute(); 
        if($stmt->rowCount() > 0){ 
          return TRUE;
        }
      }catch (PDOException $e) {
        #echo $e->getMessage();
        return FALSE;
      }
    }

    /**
    *Method to reset a users session to the first case. (Delete all of the users records except his msisdn)
     *@param msisdn
     *@return Boolean
     */

    public function deleteAllSession($msisdn){
      $db = Database::getInstance();
      try{
        $stmt = $db->prepare("UPDATE sessionmanager SET transaction_type = NULL where msisdn= :msisdn");
        $stmt->bindParam(":msisdn",$msisdn);
        $stmt->execute(); 
        if($stmt->rowCount() > 0){ 
          return TRUE;
        } 
      }catch(PDOException $e){
        #echo $e->getMessage();
         return FALSE;
      }
    }

   /**
   *Method to update user session with the actual type of transaction or details of the transaction *currently being held
   *@param msisdn, collumn, transaction type
   *@param Boolean
   **/
   public function UpdateTransactionType($msisdn, $col, $trans_type){
      $db = Database::getInstance();
      try{
        $stmt = $db->prepare("update sessionmanager set " .$col. " = :trans_type where msisdn = :msisdn");
        $params = array(":msisdn"=>$msisdn,":trans_type"=>$trans_type); 
        $stmt->execute($params);
        if($stmt->rowCount() > 0){
          return true;
         }
        } catch(PDOException $e){
          #echo $e->getMessage();
          return FALSE;
        }
    }

   /**
   *Method to query specific details from the session manager. (Get value held in a specific column)
   *@param msisdn, specific column to query
   *@return string
   */ 
   public function GetTransactionType($msisdn, $col){
     $db = Database::getInstance();
     try{
         $stmt = $db->prepare("SELECT " .$col. " FROM  sessionmanager WHERE  msisdn = :msisdn");
         $stmt->bindParam(":msisdn",$msisdn);
         $stmt->execute();
         $res = $stmt->fetch(PDO::FETCH_ASSOC);
         if($res !== FALSE){
           return $res[$col];
         } 
      }catch (PDOException $e) {
        #echo $e->getMessage();
         return NULL;
        }
    }

    /**
     *Method to query users session state. checking if the user has an existing session and if so the session count.
     *@param msisdn, specific column to query
     *@return string
     */
    public function  sessionManager($msisdn){  
      $db = Database::getInstance();
      try{  
        $stmt = $db->prepare("SELECT (COUNT(msisdn)+ COUNT(transaction_type) + COUNT(amount)) AS counter FROM sessionmanager WHERE msisdn = :msisdn");
        $stmt->bindParam(":msisdn",$msisdn);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if($res !== FALSE){
          return $res['counter'];
        }
      } catch (PDOException $e) {
        #echo $e->getMessage();
        return NULL;
      }
    }
    public function makeRequest($url,$post){
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      // execute!
      $response = curl_exec($ch);
      // close the connection, release resources used
      curl_close($ch);
      $json_a = json_decode($response, true);
      return $json_a;
    }
    public function sendSMS($url,$post){
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      // execute!
      $response = curl_exec($ch);
      // close the connection, release resources used
      curl_close($ch);
    }

   public function isPhone($str){
    $isPhoneNum = false;
    if (strlen($str) == 10) { 
      $str = preg_replace('/\s+/', '', $str);
      $three= substr($str, 0, 3);
      if($three == "054" || $three =="020" || $three == "024" || $three =="055" || $three == "026"|| $three == "057" || $three == "027"){
        $isPhoneNum = true;
      }
    }
    return $isPhoneNum;
   }

   public function assignVendor($str){
    if (strlen($str) == 10) { 
      $str = preg_replace('/\s+/', '', $str);
      $three= substr($str, 0, 3);
      if($three == "054" || $three == "024" || $three =="055"){
        return "MTN";
      } 
      if($three == "026"|| $three == "056"){
        return "Airtel";
      }
      if($three == "057" || $three == "027"){
        return "Tigo" ;
      }
      if($three =="020" || $three =="050" ){
        return "Vodafone";
      }
    }
   }

   public function addTransaction($amount,$phone_number, $Transaction_Type, $Status){
    $db = Database::getInstance(); 
    try{
      $stmt = $db->prepare("insert into transactions(amount,phone_number, Transaction_Type,Status) 
      values (:amount,:phone_number, :Transaction_Type, :Status)");
      $params = array(":amount"=>$amount,":phone_number"=>$phone_number, ":Transaction_Type"=>$Transaction_Type,	":Status"=>$Status); 
      $stmt->execute($params);
      if($stmt->rowCount() > 0){ 
        return TRUE;
      }
    }catch (PDOException $e) {
      #$e->getMessage();
      return FALSE;
    }
   }
   
   public function getTrans(){
      $db = Database::getInstance();
      try{
          $stmt = $db->prepare("SELECT * FROM transactions");
          $stmt->execute();
          $res = $stmt->fetchAll(PDO::FETCH_OBJ);
          if($res !== FALSE){
            return $res;
          } 
       }catch (PDOException $e) {
         #echo $e->getMessage();
          return NULL;
         }
     }
    }