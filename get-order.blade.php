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

$user = $_POST['user'];

include('connection.blade.php');

// SELECT * FROM pedidos WHERE user_id = 44 AND status <> 'Entregado'

$query = "SELECT * FROM pedidos WHERE user_id = $user AND status <> 'Entregado'";
$statement = $pdo->prepare($query);
$statement->execute();
$orders = $statement->fetchAll(PDO::FETCH_CLASS, 'order');

$arranged_orders = array();

 foreach($orders as $order):
    
    $one_order = array(
    "pedidoID" => $order->pedidoID,    
    "user_name" => $order->user_name,
    "oficina" => $order->oficina,
    "horario" => $order->horario,
    "carrito" => $order->carrito,
    "total" => $order->total,
    "status" => $order->status,
    "fecha" => $order->fecha
    );

array_push($arranged_orders, $one_order);

endforeach;

$response["orders"] = $arranged_orders;
$response["status"] = 1;

echo json_encode($response);

