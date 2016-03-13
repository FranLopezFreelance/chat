<?php

$idYo = $_GET['idYo'];
$idOtro = $_GET['idOtro'];

include 'models/connect.php';
include 'models/Mensajes.model.php';

$men = new Mensaje($db);

$men->cargarMensajes($idYo, $idOtro);

$men->setearMensajesLeidos($idYo, $idOtro);

?>