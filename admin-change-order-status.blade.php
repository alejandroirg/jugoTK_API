<?php

header('Access-Control-Allow-Origin: *');

include('connection.blade.php');

$order_id = $_POST["id"];
$status = $_POST["status"];

//Building and executing the query
$query = "UPDATE pedidos SET status = '$status' WHERE pedidoID = $order_id";
$statement = $pdo->prepare($query);
$statement->execute();
$response["message"] = "Éxito";
$response["status"] = 1;

echo json_encode($response);