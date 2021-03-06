<?php

	include_once 'app/Conexion.inc.php';
	include_once 'app/RepositorioUsuario.inc.php';
	include_once 'app/EscritorEntradas.inc.php';

	$titulo = 'Blog de Prueba';

	include_once 'plantillas/documento-inicio.inc.php';
	include_once 'plantillas/navbar.inc.php';
?>

	<div class = "container">
		<div class = "jumbotron">
			<h1>Blog Random</h1>
			<p>El blog donde encontraras cosas sin sentido</p>
		</div>
	</div>

	<div class = "container">
		<div class = "row">
			<div class = "col-md-4">
				<div class = "row">
					<div class = "col-md-12">
						<div class = "panel panel-default">
							<div class = "panel-heading">
								<h4>
									<span class = "glyphicon glyphicon-search" aria-hidder = "true"></span> Búsqueda
								</h4>
							</div>
							<div class = "panel-body">
								<div class = "form-group">
									<input type = "search" class = "form-control" placeholder = "Ingrese la palabra a buscar">
								</div>
								<button class = "form-control">Buscar</button>
							</div>
						</div>
					</div>
				</div>
				<div class = "row">
					<div class = "col-md-12">
						<div class = "panel panel-default">
							<div class = "panel-heading">
								<span class = "glyphicon glyphicon-filter" aria-hidder = "true"></span> Filtro
							</div>

							<div class = "panel-body">

							</div>
						</div>
					</div>
				</div>
				<div class = "row">
					<div class = "col-md-12">
						<div class = "panel panel-default">
							<div class = "panel-heading">
								<span class = "glyphicon glyphicon-calendar" aria-hidder = "true"></span> Archivo
							</div>

							<div class = "panel-body">

							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class = "col-md-8">
				<?php
					EscritorEntradas :: escribirEntradas();
				?>
			</div>
		</div>
	</div>
<?php
	include_once 'plantillas/documento-cierre.inc.php';
?>