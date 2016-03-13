<?php
require 'models/connect.php';
require 'models/Usuarios.model.php';

$usuario = new Usuario($db);

$data = $usuario->login($_POST);

if($data){
	session_start();
	$_SESSION['usuario'] = $data['usuario'];
	$_SESSION['id'] = $data['id'];
	header("location:index.php");
}else{
	header("location:login.php?response='Usuario o contraseña erroneos'");
}

?>