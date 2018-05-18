<?php

header('Access-Control-Allow-Origin: *');

include('connection.blade.php');

$office_name = $_POST["name"];
$building_id = $_POST["building_id"];

//Building and executing the query
$query = "INSERT INTO oficinas (oficina,edificioID) VALUES ('$office_name',$building_id)";
$statement = $pdo->prepare($query);
$statement->execute();
$response["message"] = "Éxito";
$response["status"] = 1;

echo json_encode($response);