<?php
header('Access-Control-Allow-Origin: *');
class user{
    public $name;
    public $email;
    public $telephone;
    public $password;
}

include('connection.blade.php');

$email = $_POST['email'];
$password = $_POST['password'];

//Building and executing the query
$query = "SELECT * FROM users WHERE email = '".$email."'";
$statement = $pdo->prepare($query);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_CLASS, 'user');

if (empty($users)){
    $response["status"] = 0;
    $response["message"] = "The user doesn't exist.";
}else{
 foreach($users as $user):
 if (password_verify($password, $user->password)){
    $response["status"] = 1;
    $response["username"] = $user->name;
    $response["telephone"] = $user->telephone;
    $response["id"] = $user->user_id;
    $response["conektaToken"] = $user->conektaToken;
    $response["message"] = "You Logged In Successfully";
 }else{
    $response["status"] = 0;
    $response["message"] = "Incorrect Password";
 }
endforeach;
}

echo json_encode($response);