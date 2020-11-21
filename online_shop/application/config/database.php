<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//get heroku cleaDB connection information 
$clearDB_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$clearDB_server = $clearDB_url["host"];
$clearDB_username = $clearDB_url["user"];
$clearDB_password = $clearDB_url["pass"];
$clearDB_db = substr($clearDB_url["path"],1);

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = $clearDB_server;
$db['default']['username'] = $clearDB_username ;
$db['default']['password'] = $clearDB_password;
$db['default']['database'] = $clearDB_db;
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */
