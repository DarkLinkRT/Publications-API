<?php

class Connection {

	private $BD_usuario;
	private $BD_contrasenia;
	private $BD_nombre;
	private $BD_servidor;
	private $conexion;

	//Constructor de la clase BD
    function __construct() {
		$this->BD_usuario= "root"; //USUARIO
		$this->BD_contrasenia= ""; // CONTRASEÑA DEL  USUARIO
		$this->BD_nombre= "publications"; // NOMBRE DE LA BASE DE DATOS
		$this->BD_servidor= "localhost"; // DIRECCION DEL SERVIDOR
    }
	//Abrir la conexion a la base  de datos
	function abrirConexion(){
		try{
			$this->conexion = mysqli_connect($this->BD_servidor,
											$this->BD_usuario,
											$this->BD_contrasenia,
											$this->BD_nombre);
											$this->conexion->set_charset('utf8');
		}
		catch(Exception $e){}						
	}
	//Cerra la conexión de la base de datos
	function cerrarConexion(){
       mysqli_close($this->conexion);		
	}
	//Realizar una consulta en la BD
	function Mysql_Exec($comandoSQL){
		$this->abrirConexion();//Abre la conexion
		$resultado = mysqli_query($this->conexion,$comandoSQL);//Mandar la consulta
		$this->cerrarConexion();//Cerrar la conexion
		return $resultado; //Regresar el resultado de la consulta
	}

	//Funcion para regresar la conexion
	function obtenerConexion(){
		$this->abrirConexion();//Abre la conexion
		return $this->conexion;
	}


}


?>