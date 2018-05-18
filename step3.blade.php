<?php
header('Access-Control-Allow-Origin: *');

$product = $_POST['product'];
$type = $_POST['type'];
$size = $_POST['size'];
$prevsize = $_POST['prevsize'];

include('connection.blade.php');

//El de la derecha define cuantos son
//SELECT * FROM ingredientes WHERE producto = "Jugos" AND tipo = "Frutas" LIMIT 16,8
//Jugos Frutas 8
$query = "SELECT * FROM ingredientes WHERE producto = '$product' AND tipo = '$type' LIMIT $prevsize,$size";
//$query = "SELECT * FROM ingredientes WHERE producto = '$product' AND tipo = '$type' LIMIT $size";

$statement = $pdo->prepare($query);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

$response["status"] = 1;
$response["results"] = $results;

echo json_encode($response);
