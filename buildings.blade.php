<?php
header('Access-Control-Allow-Origin: *');

include('connection.blade.php');


$query = "SELECT * FROM edificios";

$statement = $pdo->prepare($query);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

$response["status"] = 1;
$response["results"] = $results;

echo json_encode($response);
