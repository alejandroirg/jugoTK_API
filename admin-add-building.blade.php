<?php

header('Access-Control-Allow-Origin: *');

include('connection.blade.php');

$name = $_POST["name"];

//Building and executing the query
$query = "INSERT INTO edificios (nombre) VALUES ('$name')";
$statement = $pdo->prepare($query);
$statement->execute();
$response["message"] = "Éxito";
$response["status"] = 1;

echo json_encode($response);