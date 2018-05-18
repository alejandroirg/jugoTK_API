<?php
header('Access-Control-Allow-Origin: *');

include('connection.blade.php');

//horarioID horario diaID
$query = "SELECT horarios.horarioID, horarios.horario, horarios.diaID, dias.nombre FROM horarios INNER JOIN dias ON horarios.diaID = dias.diaID";

$statement = $pdo->prepare($query);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

$response["status"] = 1;
$response["results"] = $results;

echo json_encode($response);
