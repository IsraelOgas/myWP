<?php
	include_once "RepositorioUsuario.inc.php";

class ValidadorRegistro
{
	private $avisoInicio;
	private $avisoCierre;

	private $nombre;
	private $correo;
	private $clave;

	private $errorNombre;
	private $errorCorreo;
	private $errorClave1;
	private $errorClave2;

	function __construct($nombre, $correo, $clave1, $clave2, $conexion)
	{
		$this -> avisoInicio = "<br><div class = 'alert alert-danger' role = 'alert'>";
		$this -> avisoCierre = "</div>";
		$this -> nombre = "";
		$this -> correo = "";
		$this -> clave = "";

		$this -> errorNombre = $this -> validarNombre($conexion, $nombre);
		$this -> errorCorreo = $this -> validarCorreo($conexion, $correo);
		$this -> errorClave1 = $this -> validarClave1($clave1);
		$this -> errorClave2 = $this -> validarClave2($clave1,$clave2);

		if($this -> errorClave1 === "" && $this -> errorClave2 === "")
		{
			$this -> clave = $clave1;
		}
	}

	private function variableIniciada($variable)
	{
		if(isset($variable) && !empty($variable))
		{
			return true;
		} else {
			return false;
		}
	}

	private function validarNombre($conexion,$nombre)
	{
		if(!$this -> variableIniciada($nombre))
		{
			return "Debes escribir un nombre de usuario";
		} else {
			$this -> nombre = $nombre;
		}

		if(strlen($nombre) < 6)
		{
			return "El nombre debe contener mas de 6 caracteres";
		}

		if(strlen($nombre) > 24)
		{
			return "El nombre no puede ocupar mas de 24 caracteres";
		}

		if(RepositorioUsuario :: nombreExiste($conexion, $nombre))
		{
			return 'Este nombre de usuario ya está en uso. Por favor prueba otro nombre';
		}

		return "";
	}

	private function validarCorreo($conexion,$correo)
	{
		if(!$this -> variableIniciada($correo))
		{
			return "Debes ingresar un correo";
		} else {
			$this -> correo = $correo;
		}

		if(RepositorioUsuario :: correoExiste($conexion, $correo))
		{
			return "Este correo ya está registrado. Por favor pruebe con otro correo o <a href = '#'>recupere su contraseña</a>";
		}

		return "";
	}

	private function validarClave1($clave1)
	{
		if(!$this -> variableIniciada($clave1))
		{
			return "Debes escribir una contraseña";
		}

		return "";
	}

	private function validarClave2($clave1, $clave2)
	{
		if(!$this -> variableIniciada($clave1))
		{
			return "Primero debes rellenar la contraseña";
		}

		if(!$this -> variableIniciada($clave2))
		{
			return "Debes repetir tu contraseña";
		}

		if($clave1 !== $clave2)
		{
			return "Ambas contraseñas deben coincidir";
		}

		return "";
	}

	public function getNombre()
	{
		return $this -> nombre;
	}

	public function getCorreo()
	{
		return $this -> correo;
	}

	public function getClave()
	{
		return $this -> clave;
	}

	public function getErrorNombre()
	{
		return $this -> errorNombre;
	}

	public function getErrorClave1()
	{
		return $this -> errorClave1;
	}

	public function getErrorClave2()
	{
		return $this -> errorClave2;
	}

	public function mostrarNombre()
	{
		if($this -> nombre != "")
		{
			echo 'value = "' .$this -> nombre. '"';
		}
	}

	public function mostrarCorreo()
	{
		if($this -> correo != "")
		{
			echo 'value = "' . $this -> correo . '"';
		}
	}

	public function mostrarErrorNombre(){
		if($this -> errorNombre !== "")
		{
			echo $this -> avisoInicio . $this -> errorNombre . $this -> avisoCierre;
		}
	}

	public function mostrarErrorCorreo(){
		if($this -> errorCorreo !== "")
		{
			echo $this -> avisoInicio . $this -> errorCorreo . $this -> avisoCierre;
		}
	}

	public function mostrarErrorClave1(){
		if($this -> errorClave1 !== "")
		{
			echo $this -> avisoInicio . $this -> errorClave1 . $this -> avisoCierre;
		}
	}

	public function mostrarErrorClave2(){
		if($this -> errorClave2 !== "")
		{
			echo $this -> avisoInicio . $this -> errorClave2 . $this -> avisoCierre;
		}
	}

	public function registroValido()
	{
		if($this -> errorNombre === "" && 
			$this -> errorCorreo === "" && 
				$this -> errorClave1 === "" &&
					$this -> errorClave2 === "")
		{
			return true;
		} else {
			return false;
		}
	}
}


