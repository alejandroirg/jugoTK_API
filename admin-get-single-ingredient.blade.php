<?php

header('Access-Control-Allow-Origin: *');

class ingredient{
    public $ingredienteID; //
    public $nombre; //
    public $precio;
    public $icono;
    public $disponible;
    public $tipo; // pero si
    public $producto; 
    public $porcion;
    public $orden;
    public $calorias;
}

include('connection.blade.php');

$id = $_POST["id"];

//Building and executing the query
$query = "SELECT * FROM ingredientes WHERE ingredienteID = $id";
$statement = $pdo->prepare($query);
$statement->execute();
$ingredients = $statement->fetchAll(PDO::FETCH_CLASS, 'ingredient');

$arranged_ingredient = array();

 foreach($ingredients as $ingredient):
    
    $theingredient = array(
    "ingredienteID" => $ingredient->ingredienteID,    
    "nombre" => $ingredient->nombre,
    "precio" => $ingredient->precio,
    "icono" => $ingredient->icono,
    "disponible" => $ingredient->disponible,
    "tipo" => $ingredient->tipo,
    "producto" => $ingredient->producto,
    "porcion" => $ingredient->porcion,
    "orden" => $ingredient->orden,
    "calorias" => $ingredient->calorias
    );

    array_push($arranged_ingredient, $theingredient);

endforeach;

$response["ingredient"] = $arranged_ingredient;
$response["status"] = 1;

echo json_encode($response);