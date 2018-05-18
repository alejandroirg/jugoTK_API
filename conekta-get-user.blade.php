<?php 
header('Access-Control-Allow-Origin: *');

require_once('vendor/conekta/conekta-php/lib/Conekta.php');
\Conekta\Conekta::setApiKey("key_guzpHWawMfJieVXqyx2rzw");
\Conekta\Conekta::setApiVersion("2.0.0");

$cus = $_POST['cus'];

$customer = \Conekta\Customer::find($cus);

$response["user"] = $customer;
$response["status"] = 1;

 echo json_encode($response);
