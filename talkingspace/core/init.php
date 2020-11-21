<?php
/**Oliver Mensah
* Entry point
*
*
*/
session_start();
//error_reporting(0);
require_once("config/config.php");
require_once('helpers/format_helper.php');
require_once('helpers/db_helper.php');
spl_autoload_register(function ($class_name) {
  $path = 'libraries/'.$class_name. '.php';
  if(file_exists($path)){
  require_once($path );
}
});
