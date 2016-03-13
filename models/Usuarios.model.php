<?php

class Usuario {

	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function check_login($usuario){
		if(!$usuario){
			$login = null;
		}else{
			$login = $usuario;
		}

		return $login;
	}

	public function login($data){	
		$usuario = $data['usuario'];
		$pass = $data['pass'];

    	$statement = $this->db->prepare("SELECT * FROM usuarios WHERE usuario='$usuario' AND pass='$pass'");
    	$statement->execute();
   		$rows = $statement->rowCount();

		if($rows>0){
			$this->db->query("UPDATE usuarios SET online = 1 WHERE usuario='$usuario' AND pass='$pass'");
			
			$results = $this->db->query("SELECT * FROM usuarios WHERE usuario='$usuario' AND pass='$pass'");

			while($usuario = $results->fetchObject()){
				$data['usuario'] = $usuario->usuario;
				$data['id'] = $usuario->id;
			}

		}else{
			$data = null;
		}

		return $data;
	}

	public function getCantCon($usuario){
		$statement = $this->db->prepare("SELECT * FROM usuarios WHERE online=1 AND usuario!='$usuario'");
    	$statement->execute();
   		$rows = $statement->rowCount();
   		return "(".$rows.")";
	}

	public function getConectados($usuario, $idYo){
		$data = $this->db->query("SELECT * FROM usuarios WHERE online=1 AND usuario!='$usuario'");
		while($usuarios = $data->fetchObject()){
			echo "<p><img src='images/conectado.png' /> <a href='chat.php?u=".$usuarios->id."'>".ucfirst($usuarios->usuario)."</a>";
			$idOtro = $usuarios->id;
			$statement = $this->db->prepare("SELECT * FROM mensajes WHERE id_de=$idOtro AND id_para=$idYo AND leido=0");
    		$statement->execute();
   			$rows = $statement->rowCount();
   			if($rows>0){
   				echo " <span class='nuevoMensaje'> $rows </span></p>";
   				for($i=0;$i<$rows;$i++){
   					echo " <input class='menSinLeer' type='hidden' value='$rows' />";
   				}
   			}
		}
	}

	public function getCantDes($usuario){
		$statement = $this->db->prepare("SELECT * FROM usuarios WHERE online=0 AND usuario!='$usuario'");
    	$statement->execute();
   		$rows = $statement->rowCount();
   		return "(".$rows.")";
	}

	public function getDesconectados($usuario, $idYo){
		$data = $this->db->query("SELECT * FROM usuarios WHERE online=0 AND usuario!='$usuario'");
		while($usuarios = $data->fetchObject()){
			echo "<p><img src='images/desconectado.png' /> <a href='chat.php?u=".$usuarios->id."'>".ucfirst($usuarios->usuario)."</a>";
			$idOtro = $usuarios->id;
			$statement = $this->db->prepare("SELECT * FROM mensajes WHERE id_de=$idOtro AND id_para=$idYo AND leido=0");
    		$statement->execute();
   			$rows = $statement->rowCount();
   			if($rows>0){
   				echo " <span class='nuevoMensaje'> $rows </span></p>";
   			}
		}
	}

	public function getOtroUsuario($id){
		$data = $this->db->query("SELECT * FROM usuarios WHERE id=$id");
		while($otroUsuario = $data->fetchObject()){
			if($otroUsuario->online==0){
				$estado = "<span class='estadoChatOFF'>(Desconectado)</span>";
			}else{
				$estado = "<span class='estadoChatON'>(En línea)</span>";
			}
			return ucfirst($otroUsuario->usuario)." ".$estado;
		}
	}

	public function desconectar($usuario){
		$this->db->query("UPDATE usuarios SET online=0 WHERE usuario='$usuario'");
	}
}

?>