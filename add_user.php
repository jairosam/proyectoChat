<?php

require_once("BaseDatos/Conexion.php");
use BaseDatos\Conexion;

if ($_POST) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$number = $_POST['number'];
	$address = $_POST['address'];

	$conexion=new Conexion;
	$sql = "INSERT INTO `usuarios`(`name`, `email`, `password`, `number`, `address`) VALUES ('" . $name . "','" . $email . "','" . $password . "','" . $number . "','" . $address . "')";

	$query = mysqli_query($conexion->con, $sql);
	if ($query) {
		session_start();
		$_SESSION['name'] = $name;
		header('Location: home.php');
	} else {
		echo "Algo salió mal";
	}
}
