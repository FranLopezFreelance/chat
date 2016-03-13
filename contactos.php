<?php
$usuario = $_GET['usuario'];
$idYo = $_GET['idYo'];

include 'models/connect.php';
include 'models/Usuarios.model.php';

$usu = new Usuario($db);

echo "<h4>Contactos</h4>";

echo "<hr />";

echo "<p>En línea ".$usu->getCantCon($usuario)."</p>";

$usu->getConectados($usuario, $idYo);

echo "<p>Desconectados ".$usu->getCantDes($usuario)."</p>";

$usu->getDesconectados($usuario, $idYo); 

?>