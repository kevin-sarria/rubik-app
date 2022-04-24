<?php

include('model/conexion.php');

$conexion = conectarDB();


$password = password_hash('12345678', PASSWORD_DEFAULT);


$query = "INSERT INTO `usuarios`(`correo`, `password`, `rol`, `identificacion`) VALUES ('correo@correo.com','$password', '1','1234567890kl123456')";

//$resultado = mysqli_query($conexion, $query);





//echo $resultado;













