<?php
	include_once 'app/config.inc.php';
	include_once 'app/Conexion.inc.php';

	include_once 'app/Usuario.inc.php';
	include_once 'app/Entrada.inc.php';
	include_once 'app/Comentario.inc.php';

	include_once 'app/RepositorioUsuario.inc.php';
	include_once 'app/RepositorioEntrada.inc.php';
	include_once 'app/RepositorioComentario.inc.php';

	$componentesURL = parse_url($_SERVER["REQUEST_URI"]);
	$ruta = $componentesURL['path'];
	
	$partesRUTA = explode('/', $ruta);
	$partesRUTA = array_filter($partesRUTA);
	$partesRUTA = array_slice($partesRUTA, 0);

	$rutaElegida = 'vistas/404.php';

	if($partesRUTA[0] == 'myWP')
	{
		if(count($partesRUTA) == 1)
		{
			$rutaElegida = 'vistas/home.php';
		} else if (count($partesRUTA) == 2) {
			switch ($partesRUTA[1]) {
				case 'login':
					$rutaElegida = 'vistas/login.php';
					break;
				case 'logout':
					$rutaElegida = 'vistas/logout.php';
					break;
				case 'registro':
					$rutaElegida = 'vistas/registro.php';
					break;
				case 'gestor':
					$rutaElegida = 'vistas/gestor.php';
					$gestorActual = '';
					break;
				case 'nueva-entrada':
					$rutaElegida = 'vistas/nueva-entrada.php';
					break;

				case 'relleno-bd':
					$rutaElegida = 'vistas/script-relleno.php';
					break;			
			}
		} else if(count($partesRUTA) == 3){
			if($partesRUTA[1] == 'registro-correcto')
			{
				$nombre = $partesRUTA[2];
				$rutaElegida = 'vistas/registro-correcto.php';
			}
			if($partesRUTA[1] == 'entrada')
			{
				$url = $partesRUTA[2];
				Conexion :: abrirConexion();
				$entrada = RepositorioEntrada :: getEntradaPorURL(Conexion :: getConexion(), $url);

				if($entrada != null)
				{
					$autor = RepositorioUsuario :: getUsuarioPorID(Conexion :: getConexion(), $entrada -> getAutorID());
					$comentarios = RepositorioComentario :: getComentarios(Conexion :: getConexion(), $entrada -> getID());
					$entradasRandom = RepositorioEntrada :: getEntradasRandom(Conexion :: getConexion(), 3);
					$rutaElegida = 'vistas/entrada.php';
				}
			}
			if($partesRUTA[1] == 'gestor')
			{
				switch ($partesRUTA[2]) {
					case 'entradas':
						$gestorActual = 'entradas';
						$rutaElegida = 'vistas/gestor.php';
						break;
					case 'comentarios':
						$gestorActual = 'comentarios';
						$rutaElegida = 'vistas/gestor.php';
						break;
					case 'favoritos':
						$gestorActual = 'favoritos';
						$rutaElegida = 'vistas/gestor.php';
						break;
				}
			}
		}
	}

	include_once $rutaElegida;