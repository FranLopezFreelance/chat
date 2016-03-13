<?php

/*$dsn = 'mysql:dbname=chat;host=127.0.0.1;charset=utf8';
$user = 'root';
$password = '';*/

$dsn = 'mysql:dbname=t1000515_chat;host=localhost;charset=utf8';
$user = 't1000515_chat';
$password = 'naVEsova59';

try{
	
	$db = new PDO($dsn,$user,$password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

} catch (PDOException $e) {
	$response["status"] = "error";
    $response["message"] = 'Connection failed: ' . $e->getMessage();
    $response["data"] = null;
    //echoResponse(200, $response);
    exit;
}

?>
