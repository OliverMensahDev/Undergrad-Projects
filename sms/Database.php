<?php
/**
*Class to create and issue database connections
*This would force the system to use an available database instance or create a new one
**/
class Database{
   private static $dbh = NULL;
   private $conn =null;

   private function __construct(){
       try {
            //$this->conn = new PDO("mysql:host=localhost;port=3306;dbname=sms","root","");
            //$this->conn = new PDO("mysql:host=localhost;port=3306;dbname=sms","root","Ashesi@123456789");
            $this->conn = new PDO("mysql:host=localhost;port=3306;dbname=id3588497_sms","id3588497_olivermensah","08swanzy");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
      }catch(PDOException $e)
      {
       // echo "Connection failed: " . $e->getMessage();
      }
  }

   /**
   *Method to get a database instance or create one if none is to be found
   *@param void
   *@return database connection instance
   */
   public static function getInstance(){
      if(NULL === self::$dbh){
         self::$dbh = (new Database())->conn;
      }
      return self::$dbh;
   }
}

