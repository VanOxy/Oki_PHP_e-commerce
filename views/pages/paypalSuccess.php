<?php

require('paypal.php');

$paypal = new Paypal();
$response = $paypal->request('GetExpressCheckoutDetails', array(
    'TOKEN' => $_GET['token']
        ));
if ($response) {
    if ($response['CHECKOUTSTATUS'] == 'PaymentActionCompleted') {
        die('Ce paiement a déjà été validé');
    }
} else {
    var_dump($paypal->errors);
    die();
}

$params = array(
    'TOKEN' => $_GET['token'],
    'PAYERID' => $_GET['PayerID'],
    'PAYMENTACTION' => 'Sale',
    'PAYMENTREQUEST_0_AMT' => $response['PAYMENTREQUEST_0_AMT'],
    'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR'
);
//gérer plusieurs articles
$k = 0;
foreach ($_SESSION['cart'] as $id_prod => $quantity) {
    $product = get_product_cart($id_prod, $connection);
    
    $params["L_PAYMENTREQUEST_0_NAME$k"] = $product['title'];
    $params["L_PAYMENTREQUEST_0_DESC$k"] = '';
    $params["L_PAYMENTREQUEST_0_AMT$k"] = $product['price'];
    $params["L_PAYMENTREQUEST_0_QTY$k"] = $quantity;
    $k++;
}

$response = $paypal->request('DoExpressCheckoutPayment', $params);

if ($response) {
    //var_dump($response);
    $id_payment = $response['PAYMENTINFO_0_TRANSACTIONID'];
    $payment_time = $response['PAYMENTINFO_0_ORDERTIME'];
} else {
    var_dump($paypal->errors);
}

unset($_SESSION['cart']);
unset($_SESSION['total_price']);
?>

<div class="container">
    <br>
    <div class="row alert alert-info">
        <p>Le payement a été éffectué.</p>
        <p>Notre équipe vous remercies de votre collaboration.</p>
    </div>
</div>

