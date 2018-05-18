<?php

header('Access-Control-Allow-Origin: *');

$cus = $_POST['cus'];

$productos = $_POST['productos'];
$cantidad = $_POST['cantidad'];
$ingredientes = $_POST['ingredientes'];
$tamano = $_POST['tamano'];
$costo = $_POST['costo'];
$cal = $_POST['cal'];

//
$horario = $_POST['horario'];
//
$oficina = $_POST['oficina'];

$total = $_POST['total'];

// Line Items
$line_items = array(

);

for($i=0; $i < count($productos);$i++){
    $item = array(
    "name"=> $productos[$i],
    "unit_price"=> $costo[$i],
    "quantity"=> $cantidad[$i]
    );
    array_push($line_items, $item);
}


// Full Cart

$cart = array(

);

for($i=0; $i < count($productos);$i++){
    $product = array(
    "name"=> $productos[$i],
    "unit_price"=> $costo[$i],
    "quantity"=> $cantidad[$i],
    "ingredientes"=> $ingredientes[$i],
    "tamaño" => $tamano[$i],
    "cal" => $cal[$i]
    );
    array_push($cart, $product);
}
//BAD CARD AND USER
//4000000000000002
//tok_test_card_declined  

//GOOD CARD AND USER
//tok_test_visa_4242
//cus_2iVmXj2CPxB1ZS1kq

require_once('vendor/conekta/conekta-php/lib/Conekta.php');
\Conekta\Conekta::setApiKey("key_guzpHWawMfJieVXqyx2rzw");
\Conekta\Conekta::setApiVersion("2.0.0");

$response["status"] = 1;

//La orden
try{
  $order = \Conekta\Order::create(
    array(
      "line_items" => $line_items, //line_items
      "shipping_lines" => array(
        array(
          "amount" => $total,
           "carrier" => "FEDEX"
        )
      ), //shipping_lines - physical goods only
      "currency" => "MXN",
      "customer_info" => array(
        "customer_id" => $cus
      ), //customer_info
      "shipping_contact" => array(
        "address" => array(
          "street1" => "Calle 123, int 2",
          "postal_code" => "06100",
          "country" => "MX"
        )//address
      ), //shipping_contact - required only for physical goods
      "metadata" => array("reference" => "12987324097", "Horario" => $horario, "Oficina" => $oficina, "Carrito" => $cart),
      "charges" => array(
          array(
              "payment_method" => array(
                      "type" => "default"
              ) //payment_method - use customer's <code>default</code> - a card
          ) //first charge
      ) //charges
    )//order
  );
} catch (\Conekta\ProcessingError $error){
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

$response["order"] = $order;
$response["schedule"] = $horario;
$response["office"] = $oficina;
$response["cart"] = $cart;
$response["total"] = $total;

echo json_encode($response);

// try{
//   $order = \Conekta\Order::create(
//     array(
//       "line_items" => array(
//         array(
//           "name" => "Tacos",
//           "unit_price" => 1000,
//           "quantity" => 12
//         )//first line_item
//       ), //line_items
//       "shipping_lines" => array(
//         array(
//           "amount" => 1500,
//            "carrier" => "FEDEX"
//         )
//       ), //shipping_lines - physical goods only
//       "currency" => "MXN",
//       "customer_info" => array(
//         "customer_id" => "cus_2iZ2UawM73X6p2gM6"
//       ), //customer_info
//       "shipping_contact" => array(
//         "address" => array(
//           "street1" => "Calle 123, int 2",
//           "postal_code" => "06100",
//           "country" => "MX"
//         )//address
//       ), //shipping_contact - required only for physical goods
//       "metadata" => array("reference" => "12987324097", "more_info" => "lalalalala"),
//       "charges" => array(
//           array(
//               "payment_method" => array(
//                       "type" => "default"
//               ) //payment_method - use customer's <code>default</code> - a card
//           ) //first charge
//       ) //charges
//     )//order
//   );
// } catch (\Conekta\ProcessingError $error){
//   echo $error->getMessage();
// } catch (\Conekta\ParameterValidationError $error){
//   echo $error->getMessage();
// } catch (\Conekta\Handler $error){
//   echo $error->getMessage();
// }

// $response["order"] = $order;

// echo json_encode($response);
