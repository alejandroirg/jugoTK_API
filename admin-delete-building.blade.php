<?php
header('Access-Control-Allow-Origin: *');

include('connection.blade.php');

$id = $_POST["id"];

//Building and executing the query
$query = "DELETE FROM edificios WHERE edificioID = $id";
$statement = $pdo->prepare($query);
$statement->execute();
$response["message"] = "Éxito";
$response["status"] = 1;

echo json_encode($response);