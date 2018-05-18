<?php
header('Access-Control-Allow-Origin: *');

$email = $_POST['email'];

$to = $email;
$subject = "Registro Exitoso";
$txt = "Te haz registrado exitosamente a The Juice Club.";
$headers = "From: alex.rdz97@hotmail.com";
mail($to,$subject,$txt,$headers);
?>