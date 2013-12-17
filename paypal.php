<?php

$user = "ivanokulichev_api1.gmail.com";
$password = "1387277645";
$signature = "AFcWxV21C7fd0v3bYYYRCpSSRl31A.egghqKl.E205I4sUQ58HZ70p.G";
$params = array(
    'METHOD'    =>  'SetExpressChekout',
    'USER'      =>  $user,
    'SIGNATURE' =>  $signature,
    'PWD'      =>  $password,
    'RETURN'    =>  'http//loclahost/LAB/Paypal/process.php',
    'CANCELURL' =>  'http//loclahost/LAB/Paypal/cancel.php',
    
    'PAYMENTREQUEST_0_AMT'  =>  $totalttc,
    'PAYMENTREQUEST_0_CURRENCYCODE' =>  'EUR'
);

$endpoint = 'https//api-3T.sandbox.paypal.com/nvp';
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL =>  $endpoint,
    CURLOPT_PORT    =>  1,
    CURLOPT_POSTFIELDS  => $params,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_SSL_VERIFYPEER  => FALSE,
    CURLOPT_SSL_VERIFYHOST  => FALSE,
    CURLOPT_VERBOSE => 1
));

$response = curl_exec($curl);
$responseArray = array();
parse_str($response, $responseArray);
var_dump($responseArray);
curl_close($curl);
die();
?>