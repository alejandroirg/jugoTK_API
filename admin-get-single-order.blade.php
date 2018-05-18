<?php

header('Access-Control-Allow-Origin: *');

class order{
    public $conektaOrderID; //
    public $user_id; //
    public $user_name;
    public $oficina;
    public $horario;
    public $carrito; // pero si
    public $total; 
    public $status;
    public $fecha;
}

include('connection.blade.php');

$id = $_POST["id"];


//Building and executing the query
$query = "SELECT * FROM pedidos WHERE pedidoID = $id";
$statement = $pdo->prepare($query);
$statement->execute();
$orders = $statement->fetchAll(PDO::FETCH_CLASS, 'order');

$arranged_order = array();

 foreach($orders as $order):
    
    $theorder = array(
    "pedidoID" => $order->pedidoID,    
    "user_name" => $order->user_name,
    "user_id" => $order->user_id,
    "oficina" => $order->oficina,
    "horario" => $order->horario,
    "carrito" => $order->carrito,
    "total" => $order->total,
    "status" => $order->status,
    "fecha" => $order->fecha
    );

    array_push($arranged_order, $theorder);

endforeach;

$response["order"] = $arranged_order;
$response["status"] = 1;

echo json_encode($response);