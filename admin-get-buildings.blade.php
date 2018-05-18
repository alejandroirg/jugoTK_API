<?php

header('Access-Control-Allow-Origin: *');

include('connection.blade.php');

class building{
    public $edificioID;
    public $nombre; 
}


//Building and executing the query
$query = "SELECT * FROM edificios";
$statement = $pdo->prepare($query);
$statement->execute();
$buildings = $statement->fetchAll(PDO::FETCH_CLASS, 'building');

$arranged_buildings = array();

foreach($buildings as $building):
    
    $one_building = array(
    "id" => $building->edificioID,    
    "nombre" => $building->nombre,
    );

array_push($arranged_buildings, $one_building);

endforeach;

$response["buildings"] = $arranged_buildings;
$response["status"] = 1;

echo json_encode($response);