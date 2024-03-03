<?php
require_once "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Omnipay\Omnipay;
 
define('CLIENT_ID', getenv('CLIENT_ID'));
define('CLIENT_SECRET', getenv('CLIENT_SECRET'));
 
define('PAYPAL_RETURN_URL', 'http://localhost/e-commerce/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/e-commerce/cancel.php');
define('PAYPAL_CURRENCY', 'EUR'); // set your currency here

// Connect with the database
$db = new mysqli(getenv('MARIADB_HOST'), getenv('MARIADB_USER'), getenv('MARIADB_PASS'), getenv('MARIADB_DB')); 
 
if ($db->connect_errno) {
    die("Connect failed: ". $db->connect_error);
}
 
$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live?>