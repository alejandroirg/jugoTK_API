<?php
header('Access-Control-Allow-Origin: *');


$name = $_POST['name'];
$schedule = $_POST['schedule'];
$office = $_POST['office'];
$cart = $_POST['cart'];
$total = $_POST['total'];

//ID de la orden de conekta
$ord = $_POST['ord'];

//ID del user de conekta
$user = $_POST['user'];

include('connection.blade.php');

// INSERT INTO pedidos (conektaOrderID,user_id,status,fecha) VALUES ("A187263872", 2,"Pendiente",1525965215)

$query = "INSERT INTO pedidos (conektaOrderID,user_id,user_name,oficina,horario,carrito,total,status,fecha) 
VALUES ('$ord',$user,'$name','$office','$schedule','$cart',$total,'Pendiente',NOW())";
$statement = $pdo->prepare($query);
$statement->execute();

$response["status"] = 1;

echo json_encode($response);