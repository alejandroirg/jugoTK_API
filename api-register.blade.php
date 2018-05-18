<?php
header('Access-Control-Allow-Origin: *');

$name = $_POST['name'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$password = $_POST['password'];
$firebaseToken = $_POST['firebaseToken'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

include('connection.blade.php');

$query = "SELECT * FROM users WHERE email = '".$email."'";
$statement = $pdo->prepare($query);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
if(!$users)
{
$statement = $pdo->prepare("INSERT INTO users (name, email, telephone, password, firebaseToken) VALUES ('". $name ."','". $email ."','". $telephone ."','". $hashed_password ."','$firebaseToken')");
$statement->execute();
$response["status"] = 1;
}else{
$response["message"] = "This email is already registered";	
$response["status"] = 0;	
}
echo json_encode($response);
