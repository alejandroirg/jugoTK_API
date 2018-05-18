<?php
header('Access-Control-Allow-Origin: *');

//jugoTK3

include('connection.blade.php');

//oficinas.nombre ya NO, ahora es: oficinas.oficina

//horarioID horario diaID
$query = "SELECT oficinas.oficinaID, oficinas.oficina, oficinas.edificioID, edificios.nombre FROM oficinas INNER JOIN edificios ON oficinas.edificioID = edificios.edificioID";

$statement = $pdo->prepare($query);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

$response["status"] = 1;
$response["results"] = $results;

echo json_encode($response);
