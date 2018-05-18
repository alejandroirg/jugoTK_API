<?php

header('Access-Control-Allow-Origin: *');

  $cus = $_POST['cus'];
  $id = $_POST['id'];

 include('connection.blade.php');

// UPDATE users SET conektaToken = "123" WHERE user_id = 1
$statement = $pdo->prepare("
	UPDATE users 
	SET conektaToken = '$cus'
	WHERE user_id = $id");
$statement->execute();
$response["status"] = 1;

echo json_encode($response);
