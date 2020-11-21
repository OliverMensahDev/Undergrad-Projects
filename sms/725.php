<?php
session_start();
//DISPLAY PHP ERRORS
// error_reporting(0);
error_reporting(E_ALL); ini_set('display_errors', 1);
//INCLUDE APPLICATIONS SCRIPT
include 'ApplicationFunctions.php';
//DEFINE CURRENT DATE
date_default_timezone_set('GMT');
$time = date('Y-m-d H:i:s');
$ussd = new ApplicationFunctions();
$msisdn = $_GET['number'];
$data = $_GET['body'];
$sessionID = $_GET['sessionID'];
//FUNCTION TO CHECK IF SESSION EXISTS AND THE SESSION COUNT
/*GET SESSION STATE OF THE USER*/
$sess = intval($ussd ->sessionManager($msisdn));
//CREATING LOG
//$write = $time . "|Request|" . $msisdn . "|" . $sessionID . "|" . $data ."|".$sess. PHP_EOL;
//file_put_contents('ussd_access.log', $write, FILE_APPEND);
if ($sess == 0){
    #NO SESSION WAS FOUND -> DISPLAY WELCOME MENU
    $ussd -> IdentifyUser($msisdn);
    $reply = "Osborn Cash Service" . "\r\n" ."1. Transfer Money" . "\r\n" ."2. Cancel";
    $type = "1";
} else {
    switch($sess) { 
        case 1 : #SESSION COUNT =1 #SERVICE LEVEL 1
            if ($data=='1'){
                $reply = "Enter Phone Number";
                $type = "1";
                $ussd-> UpdateTransactionType($msisdn, "transaction_type", 'phone');
                break;
            }elseif ($data=='2'){
                $reply = "Thank you for using our service";
                $type = "0";
                $ussd -> deleteSession($msisdn);
                break;
            }else{
                $reply = "Invalid Option Selected";
                $type = "0";
                $ussd -> deleteSession($msisdn);
                break;
            }
        case 2 : #SESSION COUNT =2 #SERVICE LEVEL 2
            $reply = "Enter Amount";
            if($ussd->isPhone($data)){
                $_SESSION["phoneNumber"] = $data;
            }
            $type = "1";
            $ussd -> UpdateTransactionType($msisdn, "amount", 'amount');
            break;
        case 3 : #SESSION COUNT =3 #SERVICE LEVEL 3           
            $vendor= $ussd->assignVendor($_SESSION["phoneNumber"]);
            $uid = 'oliver.mensah';
            $pass = 'oliver.mensah';
            $tp = uniqid();
            $pin = $uid . $pass .time();
            $pin = md5($pin);
            $post = [
                'number' => $msisdn,
                'vendor' => $vendor,
                'uid'   => $uid,
                'pass' => $pass,
                'tp'=> $tp,
                'cbk'=>"https://firebasetalk.000webhostapp.com/callback.php",
                'amt'=> $data,
                'msg'=> 'Osborn Pay',
                'trans_type'=> "debit"
            ];
            $reply = "About sending $data to " . $_SESSION["phoneNumber"];
            $_SESSION['vender'] = $vendor;
            $_SESSION['tp'] = $tp;
            $_SESSION['amt'] = $data;
            $info = $ussd->makeRequest("http://pay.npontu.com/api/pay", $post);
            if($info['status'] =='success'){
                $ussd->addTransaction($data,$_SESSION["phoneNumber"], 'DEBIT', 'SUCCESS');
                $post = [
                        "username"=>"AshesiMoney",
                        "password" =>"ashesi@123",
                        "type" => 0,
                        "dlr" => 1,
                        "destination"=>$_SESSION["phoneNumber"],
                        "source"=>"Osborn Pay",
                        "message" => "You have received GHC". $_SESSION['amt'] ." from $msisdn"
                ];
                $ussd->sendSMS("http://api.deywuro.com/bulksms/",$post );
            }else{
                $ussd->addTransaction($data,$_SESSION["phoneNumber"], 'DEBIT', 'FAILED');
            }
            $type = "1";
            $ussd -> deleteSession($msisdn);
            break;
        default:
            $reply = "More session counts and menus to come.";
            $type = "0";
            $ussd -> deleteSession($msisdn);
            break;
        }
    }
    $response=$msisdn.'|'.$reply.'|'.$sessionID.'|'.$type;
    //$write = $time . "|Request_reply|". $response . PHP_EOL;
   // file_put_contents('ussd_access.log', $write, FILE_APPEND);
    echo $response;
?>

