<?php
if($_GET['u']){
	$usuario = $_GET['u'];
	require 'models/connect.php';
	require 'models/Usuarios.model.php';
	$usu = new Usuario($db);
	$usu->desconectar($usuario);
	session_start();
	$_SESSION['usuario'] = null;
	session_destroy();
	header("location:index.php");
}else{
	header("location:index.php");
}



?>