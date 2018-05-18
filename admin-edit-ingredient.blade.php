<?php
header('Access-Control-Allow-Origin: *');

include('connection.blade.php');

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$precio = $_POST["precio"];
$icono = $_POST["icono"];
$disponible = $_POST["disponible"];
$tipo = $_POST["tipo"];
$producto = $_POST["producto"];
$porcion = $_POST["porcion"];
$calorias = $_POST["cal"]; // Es el unico diferente


//Building and executing the query
$query = "UPDATE ingredientes
SET 
nombre = '$nombre',
precio = $precio,
icono = '$icono',
disponible = $disponible,
tipo = '$tipo',
producto = '$producto',
porcion = '$porcion',
calorias = $calorias
WHERE ingredienteID = $id";
$statement = $pdo->prepare($query);
$statement->execute();
$response["message"] = "Éxito";
$response["status"] = 1;

echo json_encode($response);