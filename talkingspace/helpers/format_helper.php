<?php
//date
function dateFormat($date){
  return date("F j, Y g:ia", strtotime($date));
}

//
function urlEnCoded($url){
  $str = preg_replace("/\s*/","",$url);
  $str = strtolower($str);
  $str = urlencode($str);
  return $str;
}
function sanitise($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlentities($data);
  return $data;
}
