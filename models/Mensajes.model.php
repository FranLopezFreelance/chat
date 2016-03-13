<?php

class Mensaje {

	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function cargarMensajes($idYo, $idOtro){
		$statement = $this->db->prepare("SELECT * FROM mensajes WHERE 
			(id_de=$idYo AND id_para=$idOtro) OR (id_de=$idOtro AND id_para=$idYo)");
    	$statement->execute();
   		$rows = $statement->rowCount();

		if($rows>0){
			$results = $this->db->query("SELECT * FROM mensajes WHERE 
				(id_de=$idYo AND id_para=$idOtro) OR (id_de=$idOtro AND id_para=$idYo)");

			while($mensaje=$results->fetchObject()){
				if($mensaje->id_de == $idYo){
					echo "<div class='mensajeMio col-md-9'>
		              <p name='mensaje_".$mensaje->id."'>".$mensaje->mensaje." <span class='horaMensaje'> ".substr($mensaje->fecha, -8, 5)."</span>";
		              if($mensaje->leido==1){
		              	echo "<img class='tilde' src='images/tilde.png' width='8px' />";
		              }

		             echo "</p>
		            </div>";
				}else{
					echo "<div class='mensajeOtro col-md-9'>
	              	  <p name='mensaje_".$mensaje->id."'>".$mensaje->mensaje." <span class='horaMensaje'> ".substr($mensaje->fecha, -8, 5)."</span></p>
	            	</div>";
				}
			}
		}else{
			echo "<div class='col-md-9 noMensaje'>
				<h2>No hay Mensajes en esta conversación</h2>
			</div>";
		}
	}

	public function setearMensajesLeidos($idYo, $idOtro){
		$this->db->query("UPDATE mensajes SET leido='1' WHERE id_de=$idOtro AND id_para=$idYo");
	}

	public function enviaMensaje($data){
		$mensaje = $data['mensaje'];
		$id_de = $data['id_de'];
		$id_para = $data['id_para'];

		$this->db->query("INSERT INTO mensajes VALUES ('','$id_de','$id_para','$mensaje',NOW(), 0)");
	}


	

}

?>