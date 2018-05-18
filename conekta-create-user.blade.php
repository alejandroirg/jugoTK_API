<?php

header('Access-Control-Allow-Origin: *');

  $name = $_POST['name'];
  $email = $_POST['email'];
  $telephone = $_POST['telephone'];
  $token = $_POST['token'];

//Conekta::Customer.find(customer.id)

//BAD CARD AND USER
//4000000000000002
//tok_test_card_declined  

//GOOD CARD AND USER
//tok_test_visa_4242
//cus_2iVmXj2CPxB1ZS1kq

//Remember that its:
//1.- Create token with card info
//2.- Create a user with that token
//3.- Make an order with that user

//require_once("conekta-php/lib/Conekta.php");
require_once('vendor/conekta/conekta-php/lib/Conekta.php');
\Conekta\Conekta::setApiKey("key_guzpHWawMfJieVXqyx2rzw");
\Conekta\Conekta::setApiVersion("2.0.0");

$response["status"] = 1;

try {
  $customer = \Conekta\Customer::create(
    array(
      "name" => $name,
      "email" => $email,
      "phone" => $telephone,
      "payment_sources" => array(
        array(
            "type" => "card",
            "token_id" => $token
        )
      )//payment_sources
    )//customer
  );
} catch (\Conekta\ProccessingError $error){
  $response["status"] = 0;
  echo $error->getMessage();
  $response["message"] = $error->getMessage();
} catch (\Conekta\ParameterValidationError $error){
  $response["status"] = 0;
  echo $error->getMessage();
  $response["message"] = $error->getMessage();
} catch (\Conekta\Handler $error){
  $response["status"] = 0;
  echo $error->getMessage();
  $response["message"] = $error->getMessage();
}

$response["user"] = $customer;

echo json_encode($response);