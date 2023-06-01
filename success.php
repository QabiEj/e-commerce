<?php
require_once 'config.php';
 
// Once the transaction has been approved, we need to complete it.
if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
    $transaction = $gateway->completePurchase(array(
        'payer_id'             => $_GET['PayerID'],
        'transactionReference' => $_GET['paymentId'],
    ));
    $response = $transaction->send();
 
    if ($response->isSuccessful()) {
        // The customer has successfully paid.
        $arr_body = $response->getData();
 
        $payment_id = $arr_body['id'];
        $payer_id = $arr_body['payer']['payer_info']['payer_id'];
        $payer_email = $arr_body['payer']['payer_info']['email'];
        $amount = $arr_body['transactions'][0]['amount']['total'];
        $currency = PAYPAL_CURRENCY;
        $payment_status = $arr_body['state'];
 
        $db->query("INSERT INTO payments(payment_id, payer_id, payer_email, amount, currency, payment_status) VALUES('". $payment_id ."', '". $payer_id ."', '". $payer_email ."', '". $amount ."', '". $currency ."', '". $payment_status ."')");
 
        echo "Payment is successful. Your transaction id is: ". $payment_id;
    } else {
        echo $response->getMessage();
    }
} else {
    echo 'Transaction is declined';
}
?>