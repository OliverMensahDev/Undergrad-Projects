<?php 
function cleanInput($input){
    $input = htmlspecialchars($input);
    return htmlentities( $input);
}