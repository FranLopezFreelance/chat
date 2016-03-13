<?php
session_start();

include 'models/connect.php';
include 'models/Usuarios.model.php';

$usu = new Usuario($db);

if($_SESSION['usuario']){
	$usuario = ucwords($_SESSION['usuario']);
  $idYo = ucwords($_SESSION['id']);
}else{
	header("location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Chat</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">CHAT</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuario: <?php echo $usuario; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="desconectar.php?u=<?php echo $usuario; ?>">Desconectar</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

		<div class="row">
		  <div class="col-md-3">
        <div id='contactos'>
          <h4>Contactos</h4>
          <hr />
          <p><img src='images/cargando.gif' width="100px" /></p>
        </div>
		  </div>
		  <div class="col-md-9">
		  	
		  </div>
		</div>

    </div> <!-- /container -->

    <audio id="notMensajeCon" src="audio/mensajeContactos.mp3"> </audio>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
    <?php
    echo "<script>
      $(document).ready(function(){
        var cantAnterior = 0;
        var menSinLeer = 0;
        var entrada = 0;
          setInterval(function(){
            $('#contactos').load('contactos.php?usuario=$usuario&idYo=$idYo');
            menSinLeer = $('.menSinLeer').length;
           
            if(cantAnterior<menSinLeer){
              if(entrada>0){
                document.getElementById('notMensajeCon').play();
              }
              entrada = 1;          
            }
            cantAnterior = $('.menSinLeer').length;
          }, 1000);  
      });
    </script>";
    ?>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>