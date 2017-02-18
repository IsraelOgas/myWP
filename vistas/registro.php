<?php
	include_once 'app/Conexion.inc.php';
	include_once 'app/Usuario.inc.php';	
	include_once 'app/RepositorioUsuario.inc.php';
	include_once 'app/ValidadorRegistro.inc.php';
	include_once 'app/Redireccion.inc.php';
	include_once 'app/config.inc.php';

	if (isset($_POST['enviar'])) {
		Conexion :: abrirConexion();

		$validador = new ValidadorRegistro($_POST['nombre'], $_POST['correo'], $_POST['clave1'], $_POST['clave2'], Conexion :: getConexion());

		if($validador -> registroValido())
		{
			$usuario = new Usuario('', $validador -> getNombre(), 
							$validador -> getCorreo(), 
								password_hash($validador -> getClave(), PASSWORD_DEFAULT), 
									'', 
										'');
			$usuarioInsertado = RepositorioUsuario :: insertarUsuario(Conexion :: getConexion(), $usuario);

			if ($usuarioInsertado) {
				/*Redirigir a REGISTRO_CORRECTO*/
				$nombreUsuario = $usuario -> getNombre();
				Redireccion :: Redirigir(RUTA_REGISTRO_CORRECTO . '/' . $nombreUsuario);
			}
		}
		Conexion :: cerrarConexion();
	}

	$titulo = 'Registro';

	include_once 'plantillas/documento-inicio.inc.php';
	include_once 'plantillas/navbar.inc.php';
?>

	<div class = "container">
		<div class = "jumbotron">
			<h1 class= "text-center">Formulario de registro</h1>

		</div>
	</div>

	<div class = "container">
		<div class = "row">
			<div class = "col-md-6 text-center">
				<div class = "panel panel-default">
					<div class = "panel-heading">
						<h3 class = "panel-title">
							Instrucciones
						</h3>
					</div>
					<div class = "panel-body">
						<br>
						<p class = "text-justify">
							Para unirte al Blog introduce un nombre de usuario, email y contraseña. El correo que escribas debe ser real ya que necesitarás gestionar tu cuenta. Se recomienda usar por lo menos una mayúscula, minusculas, numeros y simbolos en la contraseña.
						</p>
						<br>
						<a href="#">¿Ya tienes cuenta?</a>
						<br>
						<br>
						<a href="">¿Olvidaste tu contraseña?</a>
						<br>
						<br>

					</div>
				</div>
			</div>

			<div class = "col-md-6">
				<div class = "panel panel-default">
					<div class = "panel-heading">
						<h3 class = "panel-title text-center">
							Intruduce tus datos
						</h3>
					</div>
					<div class = "panel-body">
						<form role = "form" method = "post" action = "<?php echo RUTA_REGISTRO ?>">
							<?php
								if (isset($_POST['enviar'])) 
								{
									include_once 'plantillas/registro-validado.inc.php';
								} else {
									include_once 'plantillas/registro-vacio.inc.php';
								}
							?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
	include_once 'plantillas/documento-cierre.inc.php';
?>