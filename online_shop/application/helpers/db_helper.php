<?php
//get categories
function get_categories_h(){
  $CI = get_instance();
  return $CI->product_model->get_categories();
}

function get_popular_h(){
  $CI = get_instance();
  return $CI->product_model->get_popular();
}
