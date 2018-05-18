<?php
header('Access-Control-Allow-Origin: *');
$product = $_POST['product'];

if($product == "Cocktail"){
$response["status"] = 3;
echo json_encode($response);
}else{}

include('connection.blade.php');

if($product == "Jugo"){
$query = "SELECT * FROM ingredientes WHERE tipo = 'Bases'";
}else{}

if($product == "Licuado"){
$query = "SELECT * FROM ingredientes WHERE tipo = 'Leches'";
}else{}

$statement = $pdo->prepare($query);
$statement->execute();
$bases = $statement->fetchAll(PDO::FETCH_ASSOC);

$response["status"] = 1;
$response["bases"] = $bases;

echo json_encode($response);

