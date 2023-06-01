<?php
require_once "vendor/autoload.php";
 
use Omnipay\Omnipay;
 
define('CLIENT_ID', 'AUlpyjRm4L4cm8Vj3oi9n-kZJxWAKz-vircJRReAXEONIHjy1ksLnzaoMqT0nQ9hxBCNDbwiuw51F9fw');
define('CLIENT_SECRET', 'ENjLXeDP9hmrh0XrYNdodwxxmnQEFtPa17LLlfCp6yD-tYlcx0MrLFaafkVUHfuBmewUKtMhMwK5KTSy');
 
define('PAYPAL_RETURN_URL', 'http://localhost/e-commerce/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/e-commerce/cancel.php');
define('PAYPAL_CURRENCY', 'EUR'); // set your currency here
 
// Connect with the database
$db = new mysqli('localhost', 'root', '', 'estore'); 
 
if ($db->connect_errno) {
    die("Connect failed: ". $db->connect_error);
}
 
$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live?>