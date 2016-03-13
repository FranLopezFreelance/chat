<?php

if($_POST){

	include 'models/connect.php';
	include 'models/Mensajes.model.php';

	$men = new Mensaje($db);

	$men->enviaMensaje($_POST);

}else{
	header("index.php");
}

?>