<?php

header('Access-Control-Allow-Origin: *');

include('connection.blade.php');

class ingredient{
	public $ingredienteID;
    public $nombre;
    public $precio;
    public $icono;
    public $disponible;
    public $tipo;
    public $producto;
    public $porcion;
    public $orden;
    public $calorias; 
}


//Building and executing the query
$query = "SELECT * FROM ingredientes";
$statement = $pdo->prepare($query);
$statement->execute();
$ingredients = $statement->fetchAll(PDO::FETCH_CLASS, 'ingredient');

$arranged_ingredients = array();

foreach($ingredients as $ingredient):
    
    $one_ingredient = array(
    "id" => $ingredient->ingredienteID,
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

array_push($arranged_ingredients, $one_ingredient);

endforeach;

$response["ingredients"] = $arranged_ingredients;
$response["status"] = 1;

echo json_encode($response);