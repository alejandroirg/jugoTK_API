<?php

header('Access-Control-Allow-Origin: *');

include('connection.blade.php');

class office{
	public $oficinaID;
    public $oficina;
    public $edificioID; 
}


//Building and executing the query
$query = "SELECT * FROM oficinas";
$statement = $pdo->prepare($query);
$statement->execute();
$offices = $statement->fetchAll(PDO::FETCH_CLASS, 'office');

$arranged_offices = array();

foreach($offices as $office):
    
    $one_office = array(
    "id" => $office->oficinaID,    
    "name" => $office->oficina,
    "building"=>$office->edificioID
    );

array_push($arranged_offices, $one_office);

endforeach;

$response["offices"] = $arranged_offices;
$response["status"] = 1;

echo json_encode($response);