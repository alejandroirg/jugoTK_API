<?php

header('Access-Control-Allow-Origin: *');

include('connection.blade.php');

$nombre = $_POST["nombre"];
$precio = $_POST["precio"];
$icono = $_POST["icono"];
$disponible = $_POST["disponible"];
$tipo = $_POST["tipo"];
$producto = $_POST["producto"];
$porcion = $_POST["porcion"];
$calorias = $_POST["cal"]; // El unico que no concuerda con el nombre

//Building and executing the query
$query = "INSERT INTO ingredientes (nombre,precio,icono,disponible,tipo,producto,porcion,calorias) 
          VALUES ('$nombre',$precio,'$icono',$disponible,'$tipo','$producto','$porcion',$calorias)";
$statement = $pdo->prepare($query);
$statement->execute();
$response["message"] = "Éxito";
$response["status"] = 1;

echo json_encode($response);