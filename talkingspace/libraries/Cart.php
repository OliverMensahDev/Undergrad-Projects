<?php
class Cart{

  public function __construct()
  {
  }
  public function add($id, $name, $link)
  {
		$itemArray = array($id=>array('id'=>$id, 'name'=>$name, 'link'=>$link));
		if(!empty($_SESSION["cart_item"])) {
			if(in_array($id,array_keys($_SESSION["cart_item"]))) {
        echo "exist";
			} else {
        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
			}
		} else {
			$_SESSION["cart_item"] = $itemArray;
		}
	}
}
