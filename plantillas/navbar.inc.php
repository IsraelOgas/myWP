<?php	
	include_once 'app/ControlSesion.inc.php';
	include_once 'app/config.inc.php';

	Conexion::abrirConexion();
	$cantUsuarios = RepositorioUsuario::getCantidadUsuarios(Conexion::getConexion());
?>

<nav class = "navbar navbar-default navbar-static-top">
	<div class = "container">
		<div class = "navbar-headers">
			<button type = "button" class = "navbar-toggle collapsed" data-toggle = "collapse" data-target = "#navbar" aria-expanded = "false" aria-controls = "navbar">
				<span class = "sr-only">Este botón despliega la barra de navegación</span>
				<span class = "icon-bar"></span>
				<span class = "icon-bar"></span>
				<span class = "icon-bar"></span>
			</button>
			<a class = "navbar-brand" href = "<?php echo SERVIDOR?>">NombreDeLaPagina</a>
		</div>
		<div id = "navbar" class = "navbar-collapse collapse">
			<?php 
				if(!ControlSesion :: sesionIniciada())
				{
			 ?>
			<ul class = "nav navbar-nav">
				<li>
					<a href="<?php echo RUTA_ENTRADAS?>">
						<i class="fa fa-address-book-o" aria-hidden="true"></i> Entradas
					</a>
				</li>
				<li>
					<a href="<?php echo RUTA_FAVORITOS?>">
						<span class = "glyphicon glyphicon-star" aria-hidder = "true"></span> Favoritos
					</a>
				</li>
				<li>
					<a href="<?php echo RUTA_AUTORES?>">
						<span class = "glyphicon glyphicon-education" aria-hidder = "true"></span> Autores
					</a>
				</li>
			</ul>
			<?php
				}
			?>
			<ul class = "nav navbar-nav navbar-right">
				<?php
					if(ControlSesion :: sesionIniciada())
					{
						?>
						<li>
							<a href  = "#">
								<span class = "glyphicon glyphicon-user" aria-hidder = "true"></span> 
									<?php 
										echo ' ' . $_SESSION['nombreUsuario'];
									?>
							</a>
						</li>
						<li>
							<a href  = "<?php echo RUTA_GESTOR?>">
								<span class = "glyphicon glyphicon-dashboard" aria-hidder = "true"></span> Gestor
							</a>
						</li>
						<li>
							<a href = "<?php echo RUTA_LOGOUT?>">
								<span class = "glyphicon glyphicon-log-out" aria-hidder = "true"></span> Cerrar Sesión
							</a>
						</li>
						<?php
					} else {
						?>
							<li>
								<a href="#">
									<span class = "glyphicon glyphicon-user" aria-hidder = "true"></span>
										<?php
											echo $cantUsuarios;
										?>
								</a>
							</li>

							<li>
								<a href="<?php echo RUTA_LOGIN?>">
									<span class = "glyphicon glyphicon-log-in" aria-hidder = "true"></span> Iniciar Sesión
								</a>
							</li>

							<li>
								<a href="<?php echo RUTA_REGISTRO?>">
									<span class = "glyphicon glyphicon-plus" aria-hidder = "true"></span> Registrarse
								</a>
							</li>
						<?php
					}
				?>
			</ul>
		</div>
	</div>
</nav>