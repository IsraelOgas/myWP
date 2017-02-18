<?php
	include_once 'app/config.inc.php';
	include_once 'app/Conexion.inc.php';
	include_once 'app/RepositorioUsuario.inc.php';
	include_once 'app/ValidadorLogin.inc.php';
	include_once 'app/ControlSesion.inc.php';
	include_once 'app/Redireccion.inc.php';

	if(ControlSesion :: sesionIniciada())
	{
		Redireccion :: redirigir(SERVIDOR);
	}

	if(isset($_POST['login']))
	{
		Conexion :: abrirConexion();

		$validador = new ValidadorLogin($_POST['correo'], $_POST['clave'], Conexion :: getConexion());

		if($validador -> getError() === '' && !is_null($validador -> getUsuario()))
		{
			//Iniciar Sesion
			ControlSesion :: iniciarSesion($validador -> getUsuario() -> getID(), 
				$validador -> getUsuario() -> getNombre());

			//Redirigir a Index
			Redireccion :: redirigir(SERVIDOR);
		} else {
			echo 'Falló';
		}

		Conexion :: cerrarConexion();
	}

	$titulo = 'Login';

	include_once 'plantillas/documento-inicio.inc.php';
	include_once 'plantillas/navbar.inc.php';
?>

	<div class = "container">
		<div class = "row">
			<div class = "col-md-3">
			</div>

			<div class = "col-md-6">	
				<div class = "panel panel-default">	
					<div class = "panel-heading text-center">
						<h4>Iniciar Sesion</h4>
					</div>
					<div class = "panel-body">
						<form class = "form" method = "post" action = "<?php echo RUTA_LOGIN ?>">
							<h4>Introduce tus datos</h4>
							<br>
							<div class="input-group margin-bottom-sm">
							 	<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
								<label form = "email" class = "sr-only">correo electronico</label>
								<input type = "email" name = "correo" id = "correo" class = "form-control" placeholder = "Email" 
								<?php 
									if(isset($_POST['login']) && isset($_POST['correo']) && !empty($_POST['correo']))
									{
										echo 'value = "' . $_POST['correo'] . '"';
									}
								?> 
								required autofocus>
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
								<label form = "email" class = "sr-only">Contraseña</label>
								<input type = "password" name = "clave" id = "clave" class = "form-control" placeholder = "Contraseña" required>
								<?php
									if(isset($_POST['login']))
									{
										$validador -> mostrarError();
									}
								?>
							</div>
							<br>
							<button type = "submit" name = "login" class = "btn btn-lg  btn-block">
								Iniciar Sesión
							</button>
						</form>
						<br>
						<div class = "text-center">
							<a href = "#">¿Olvidaste tu contraseña?</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>