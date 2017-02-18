<?php

	include_once 'app/config.inc.php';
	include_once 'app/Conexion.inc.php';

	include_once 'app/Usuario.inc.php';
	include_once 'app/Entrada.inc.php';
	include_once 'app/Comentario.inc.php';

	include_once 'app/RepositorioUsuario.inc.php';
	include_once 'app/RepositorioEntrada.inc.php';
	include_once 'app/RepositorioComentario.inc.php';

	Conexion :: abrirConexion();

	for($usuarios = 0; $usuarios < 100; $usuarios++)
	{
		$nombre = stringAleatorios(10);
		$correo = stringAleatorios(5).'@'.stringAleatorios(3);
		$password = password_hash('0000', PASSWORD_DEFAULT);

		$usuario = new Usuario('', $nombre, $correo, $password, '', '');

		RepositorioUsuario :: insertarUsuario(Conexion :: getConexion(), $usuario);
	}

	for ($entradas = 0; $entradas < 100; $entradas++) { 
		$titulo = stringAleatorios(10);
		$url = $titulo;
		$texto = lorem();
		$autor = rand(1, 100);

		$entrada = new Entrada ('', $autor, $url, $titulo, $texto, '', '');
		RepositorioEntrada :: insertarEntrada(Conexion :: getConexion(), $entrada);
	}

	for ($comentarios = 0; $comentarios < 100; $comentarios++) { 
		$titulo = stringAleatorios(10);
		$texto = lorem();
		$autor = rand(1, 100);
		$entrada = rand(1, 100);

		$comentario = new Comentario ('', $autor, $entrada, $titulo, $texto, '');
		RepositorioComentario :: insertarComentario(Conexion :: getConexion(), $comentario);
	}

	function stringAleatorios($longitud)
	{
		$caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$cantCaracteres = strlen($caracteres);
			$stringAleatorio = '';

			for ($i = 0; $i < $longitud; $i++) { 
				$stringAleatorio .= $caracteres[rand(0, $cantCaracteres - 1)];
			}

			return $stringAleatorio;
	}

	function lorem()
	{
		$lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a sodales dui. Suspendisse sit amet tellus aliquam, iaculis diam ac, luctus quam. Aenean felis eros, placerat at tempus vel, venenatis eu lorem. Sed quis molestie nibh, vitae auctor enim. Duis ac consequat metus. Phasellus egestas ultricies nulla sit amet placerat. Nunc elementum orci nisl, et varius nunc congue a. Ut eu nisl euismod mi fringilla finibus nec at eros. Quisque efficitur non sem sit amet dictum. Nam at ante volutpat, tempor massa quis, gravida eros.

		Duis aliquam libero tortor, nec dignissim sapien porttitor sed. Cras viverra placerat massa, ac bibendum lorem tristique eu. Vestibulum laoreet varius nisl eget suscipit. Vestibulum id odio pharetra nisl gravida interdum ac eget nunc. In et risus et massa feugiat lobortis nec et metus. Nullam eget erat et lorem ultricies ultricies. Donec ac congue ante, in aliquam enim. Nam finibus, elit a fringilla aliquam, nisi risus pellentesque est, vitae pellentesque nisi augue vel augue. Pellentesque mollis varius purus sit amet ullamcorper. Fusce nisl tellus, eleifend ac odio pulvinar, pharetra tincidunt dui. Donec sit amet blandit dolor.

		Aliquam magna mi, auctor at volutpat ut, molestie sed enim. Fusce eget ex sit amet risus porta vehicula in sed ipsum. Quisque tincidunt, erat at imperdiet tincidunt, lectus orci facilisis enim, at pulvinar lectus libero et diam. Ut quis dolor interdum, suscipit ex at, egestas nunc. Proin dignissim tortor enim, at scelerisque ante mattis nec. Fusce imperdiet odio suscipit, consequat magna non, imperdiet nulla. Nam scelerisque urna quis nisi vestibulum, a molestie elit consequat. Aenean eu ornare metus. Maecenas congue congue felis sed molestie.

		Vestibulum rhoncus porttitor erat at fermentum. Vestibulum feugiat malesuada nisl. Maecenas pulvinar molestie orci, nec tristique dui eleifend vel. Mauris mattis eu velit sit amet pulvinar. Ut ultricies eget nisi eu pellentesque. Fusce non enim eget nisi facilisis auctor sed vitae lorem. Fusce faucibus laoreet augue, non viverra augue cursus a. Ut eget magna velit. Proin accumsan nisi eget ex tempus pharetra id et lectus. Sed ultrices, magna at congue feugiat, lectus libero iaculis dolor, efficitur luctus erat leo id justo. Ut nisi est, finibus in ligula iaculis, ullamcorper pharetra massa. Pellentesque lorem augue, commodo vestibulum tincidunt in, gravida vel libero. Aenean tincidunt consequat risus ac pulvinar. Suspendisse tortor libero, ornare nec congue imperdiet, tincidunt eu tortor. Praesent feugiat ornare arcu non semper.

		Nunc tincidunt magna non tortor facilisis, sed luctus quam congue. Quisque vel augue quam. Fusce nec mi sit amet sem aliquam elementum. Nam pellentesque dui vitae luctus varius. Sed sed tellus nisi. Donec tristique, purus id posuere imperdiet, ligula mi varius tellus, nec convallis dui augue id velit. Nam risus lorem, posuere vel dui at, scelerisque semper dolor. In hac habitasse platea dictumst. Aenean in fermentum leo. Etiam a nulla tempor, eleifend risus vitae, ultricies leo. Curabitur condimentum magna a dictum pharetra. Nullam dictum ante in ex ornare euismod in non leo. Vivamus iaculis elit eget dolor placerat, id iaculis massa fringilla. Vivamus ligula sem, auctor eget rhoncus vestibulum, rhoncus a augue. Nam mattis eleifend massa, vitae ultricies diam molestie in.';
	
		return $lorem;
	}