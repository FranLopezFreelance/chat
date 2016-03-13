<?php
session_start();

include 'models/connect.php';
include 'models/Usuarios.model.php';
include 'models/Mensajes.model.php';

$usu = new Usuario($db);
$men = new Mensaje($db);

if($_SESSION['usuario']){
	$usuario = ucwords($_SESSION['usuario']);
  $idYo = ucwords($_SESSION['id']);
}else{
	header("location:login.php");
}


if($_GET['u']){
	$id = $_GET['u'];
  $idOtro = $id;
	$otroUsuario = $usu->getOtroUsuario($id);
}else{
	header("location:index.php");
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
    <nav id="nav" class="navbar navbar-default navbar-fixed-top">
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

		  	<h4>Conversación con <?php  echo $otroUsuario; ?></h4>

		  	<hr />

          <div id='chat' class="col-md-12">
              <div class="cargando"><img src='images/cargando.gif' width="100px" /></div>
          </div>

		  </div>
		</div>
    </div> <!-- /container -->
          

          <div id="cajaMensaje" class="col-md-12">
            <div class="col-md-5"></div>
            <div class="col-md-7 cajaTextArea">
              <form>  
                <textarea id="mensaje" cols="40" rows="2" placeholder="Mensaje"></textarea><br />
                <a class="btn btn-success" id="submit" onclick="enviaMensaje($('#mensaje').val(), $('#id_de').val(), $('#id_para').val());return false;">Enviar</a>
                <input type="hidden" id="id_de" value="<?php echo $idYo; ?>" />
                <input type="hidden" id="id_para" value="<?php echo $idOtro; ?>" />
              </form>
            </div>
          </div>

    <audio id="notMensajeChat" src="audio/mensajeChat.mp3"> </audio>
    <audio id="notMensajeCon" src="audio/mensajeContactos.mp3"> </audio>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="dist/js/scripts.js"></script>
    <?php
    echo "<script>
      $(document).ready(function(){
          var cantAnterior = 0;
          var mensajesOtro = 0;
          var entradaChat = 0;
          setInterval(function(){
            $('#contactos').load('contactos.php?usuario=$usuario&idYo=$idYo');
            $('#chat').load('conversacion.php?idYo=$idYo&idOtro=$idOtro');
            mensajesOtro = $('.mensajeOtro').length;
            if(cantAnterior<mensajesOtro){
              $('#chat').animate({ scrollTop: $('#chat')[0].scrollHeight});
              if(entradaChat==1){
                document.getElementById('notMensajeChat').play();             
              }
              entradaChat = 1;
            }
            cantAnterior = $('.mensajeOtro').length;
          }, 1000);
      });
    </script>";
    ?>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>