<?php
session_start(); //para las variables de sesion
error_reporting(0);
include("./app/conexion.php");

	$user = $_POST['usuario'];
	$password = $_POST['password'];

	$query = "CALL `tubagua`.`loginUser`('$user', '$password', @respuesta)";
	if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
	$query = "SELECT @respuesta, id FROM usuario WHERE usuario = '$user'";
	if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
	$row = mysqli_fetch_assoc($result);

	if($row['@respuesta'] == 1){
		$_SESSION['iva'] = floatval((floatval(12)/100)+1);
		$_SESSION['id_user'] = $row['id'];
		$_SESSION['username'] = $user;
		echo 1;
	}else{
		echo 0;
	}
?>
