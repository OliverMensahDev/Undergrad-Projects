<?php
session_start();
require('./ApplicationFunctions.php');
$ussd = new ApplicationFunctions;
if( isset($_REQUEST['transaction_id']) && isset($_REQUEST['responseMessage'])  && isset($_REQUEST['status'])){
    echo $_SESSION['tp'];
    $data = $ussd->makeRequest("http://pay.npontu.com/api/pay", $post);
    if( $data['status'] == 'success'){
        $ussd->addTransaction($_SESSION['amt'],$_SESSION["phoneNumber"], 'CREDIT', 'SUCCESS');
    }else{
        $ussd->addTransaction($_SESSION['amt'],$_SESSION["phoneNumber"], 'CREDIT', 'FAILED');
    }
}else{
    
}