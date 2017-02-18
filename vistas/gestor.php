<?php
	include_once 'plantillas/documento-inicio.inc.php';
	include_once 'plantillas/navbar.inc.php';
	include_once 'plantillas/panel-control-inicio.inc.php';

	switch ($gestorActual) {
		case '':
			$cantidadEntradasActivas = RepositorioEntrada :: contarEntradasActivasUsuario(Conexion :: getConexion(), $_SESSION['idUsuario']);
			$cantidadEntradasInactivas = RepositorioEntrada :: contarEntradasInactivasUsuario(Conexion :: getConexion(), $_SESSION['idUsuario']);
			$cantComentarios = RepositorioComentario :: contarComentariosUsuario(Conexion :: getConexion(), $_SESSION['idUsuario']);
			include_once 'plantillas/gestor-generico.inc.php';
			break;
		case 'entradas':
			$arrayEntradas = RepositorioEntrada :: getEntradasPorFechaDescendente(Conexion :: getConexion(), $_SESSION['idUsuario']);
			include_once 'plantillas/gestor-entradas.inc.php';
			break;
		case 'comentarios':
			include_once 'plantillas/gestor-comentarios.inc.php';
			break;
		case 'favoritos':
			include_once 'plantillas/gestor-favoritos.inc.php';
			break;

	}

	include_once 'plantillas/panel-control-cierre.inc.php';