<?php
class user{
    public $name;
    public $email;
    public $telephone;
    public $password;
    }

$user = $_POST['name'];
$password = $_POST['password'];

include('connection.blade.php');

 //Building the query
$query = "SELECT * FROM users WHERE name = '$user'";
$statement = $pdo->prepare($query);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_CLASS, 'user');

foreach($users as $user): ?>
<?php 

if (password_verify($password, $user->password)){
echo 'Password is valid!';
}else{
echo 'Invalid password.';
}
 ?>
<h4>Name: <?php echo $user->name ?></h4><br>
<h4>Email: <?php echo $user->email ?></h4><br>
<h4>Telephone: <?php echo $user->telephone ?></h4><br>
<h4>Password: <?php echo $user->password ?></h4><br>
<?php endforeach;
