<?php

require "BaseDatos/Conexion.php";
require_once("BaseDatos/GestionBd.php");

use BaseDatos\GestionBd;

session_start();
if($_POST)
{
	$name=$_SESSION['name'];
    $msg=$_POST['msg'];

	$gestor = new GestionBd;

	$gestor->insertar_mensaje($name,$msg);

	header('location: chatpage.php');
}
