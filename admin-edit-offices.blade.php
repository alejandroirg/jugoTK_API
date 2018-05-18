<?php
header('Access-Control-Allow-Origin: *');

include('connection.blade.php');

$name = $_POST["name"];
$id = $_POST["id"];

//Building and executing the query
$query = "UPDATE oficinas SET oficina = '$name' WHERE oficinaID = $id";
$statement = $pdo->prepare($query);
$statement->execute();
$response["message"] = "Éxito";
$response["status"] = 1;

echo json_encode($response);