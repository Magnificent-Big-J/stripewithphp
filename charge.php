<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('vendor/autoload.php');
require_once('config.php');
require_once('lib/Database.php');
require_once('models/Customer.php');
require_once('models/Transaction.php');

use models\Customer;
use models\Transaction;
use Stripe\StripeClient;

// Sanitize POST Array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$stripe = new StripeClient('sk_test_1rvUPGeBP0PZf8lUCjD1WYJ900VyMIJo8w');

$first_name = $POST['first_name'];
$last_name = $POST['last_name'];
$email = $POST['email'];
$token = $POST['stripeToken'];

// Create Customer In Stripe
$customer = $stripe->customers->create([
    'description' => 'PHP Mentorship',
    'email' => $email,
    'payment_method' => 'pm_card_visa',
]);

//Charge Customer

$data = array('amount'=>50000,
    'currency'=>'zar',
    'description' =>'PHP Mentorship',
    'source' =>$token);

$charge = $stripe->charges->create($data);

//Customer Data
$customerData = array(
    'id' => $customer->id,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email
);

$createCustomer = new Customer();
$createCustomer->addCustomer($customerData);

//Transactions

// Transaction Data
$transactionData = [
    'id' => $customer->id,
    'customer_id' => $customer->id,
    'product' => $charge->description,
    'amount' => $charge->amount,
    'currency' => $charge->currency,
    'status' => $charge->status,
];

// Instantiate Transaction
$transaction = new Transaction();

// Add Transaction To DB
$transaction->addTransaction($transactionData);

//Redirect to success
header('Location: success.php?tid='. $charge->id .'&product='.$charge->description);
