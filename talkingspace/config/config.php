 <?php
 // $clearDB_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
 // $clearDB_server = $clearDB_url["host"];
 // $clearDB_username = $clearDB_url["user"];
 // $clearDB_password = $clearDB_url["pass"];
 // $clearDB_db = substr($clearDB_url["path"],1);
 //
 // define("DB_HOST", $clearDB_server );
 // define("DB_USER", $clearDB_username);
 // define("DB_PASS", $clearDB_password);
 // define("DB_NAME", $clearDB_db);
 // define('BASE_URL','http://talkinspace.herokuapp.com/');
 define("DB_HOST","localhost");
 define("DB_USER","root");
 define("DB_PASS","");
 define("DB_NAME", "talkingspace");
 if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
   $uri = 'https://';
 } else {
   $uri = 'http://';
 }
 $uri .= $_SERVER['HTTP_HOST'];
 define('BASE_URL',$uri.'/talkingspace/');
