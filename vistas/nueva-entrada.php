<?php
	include_once 'app/Conexion.inc.php';
	include_once 'app/Usuario.inc.php';	
	include_once 'app/RepositorioUsuario.inc.php';
	include_once 'app/ValidadorRegistro.inc.php';

	$titulo = "Nueva entrada del blog";

	include_once 'plantillas/documento-inicio.inc.php';
	include_once 'plantillas/navbar.inc.php';
?>
	<div class = "container">
		<div class = "jumbotron">
			<h2 class= "text-left">Creacion de una nueva entrada</h2>

		</div>
	</div>

<?php
	include_once 'plantillas/documento-cierre.inc.php';
?>