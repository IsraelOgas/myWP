<?php
	include_once 'app/config.inc.php';
	include_once 'app/Conexion.inc.php';
	include_once 'app/Entrada.inc.php';

	class RepositorioEntrada
	{
		public static function insertarEntrada($conexion, $autor)
		{
			$entradaInsertada = false;

			if(isset($conexion))
			{
				try 
				{
					$sql = "INSERT INTO entradas(autor_id, url, titulo, texto, fecha, activa) VALUES(:autorID, :url, :titulo, :texto, NOW(), 0)";
					$sentencia = $conexion -> prepare($sql);

					$autorID_E = $autor -> getAutorID();
					$url_E = $autor -> getURL();
					$tituloE = $autor -> getTitulo();
					$textoE = $autor -> getTexto();

					$sentencia -> bindParam(':autorID', $autorID_E, PDO::PARAM_STR);
					$sentencia -> bindParam(':url', $url_E, PDO::PARAM_STR);
					$sentencia -> bindParam(':titulo', $tituloE, PDO::PARAM_STR);
					$sentencia -> bindParam(':texto', $textoE, PDO::PARAM_STR);

					$entradaInsertada = $sentencia -> execute();
				} catch (PDOException $e) {
					print 'ERROR' . $e -> getMessage();
				}
			}
			return $entradaInsertada;
		}

		public static function getTodasEntradasPorFechaDescendentes($conexion)
		{
			$entradas = [];
			
			if (isset($conexion)) 
			{
				try 
				{
					$sql = 'SELECT * FROM entradas ORDER BY fecha DESC';

					$sentencia = $conexion -> prepare($sql);
					$sentencia -> execute();
					$resultado = $sentencia -> fetchAll();

					if(count($resultado))
					{
						foreach ($resultado as $fila) 
						{
							$entradas[] = new Entrada($fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']);
						}
					}
				} catch (PDOException $e) {
					print 'ERROR' . $e -> getMessage();
				}
			}
			return $entradas;
		}

		public static function getEntradaPorURL($conexion, $url)
		{
			$entrada = null;

			if (isset($conexion)) 
			{
				try 
				{
					$sql = "SELECT * FROM entradas WHERE url LIKE :url";
					$sentencia = $conexion -> prepare($sql);
					$sentencia -> bindParam(':url', $url, PDO::PARAM_STR);
					$sentencia -> execute();

					$resultado = $sentencia -> fetch();

					if(!empty($resultado))
					{
						$entrada = new Entrada ($resultado['id'], $resultado['autor_id'], $resultado['url'], $resultado['titulo'], $resultado['texto'], $resultado['fecha'], $resultado['activa']);
					}

				} catch (PDOException $e) {
					print 'ERROR' . $e -> getMessage();
				}
			}
			return $entrada;
		}

		public static function getEntradasRandom($conexion, $limite)
		{
			$entradas = [];

			if(isset($conexion))
			{
				try 
				{
					$sql = "SELECT * FROM entradas ORDER BY RAND() LIMIT  $limite";
					$sentencia = $conexion -> prepare($sql);
					$sentencia -> execute();
					$resultado = $sentencia -> fetchAll();

					if (count($resultado)) {
						foreach ($resultado as $fila) {
							$entradas[] = new Entrada($fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']);
						}
					}
				} catch (PDOException $e) {
					print 'ERROR' . $e -> getMessage(); 
				}
			}
			return $entradas;
		}

		public static function contarEntradasActivasUsuario($conexion, $idUsuario)
		{
			$totalEntradas = 0;

			if (isset($conexion)) 
			{
				try 
				{
					$sql = "SELECT COUNT(*) as total_entradas FROM entradas WHERE autor_id = :autorID AND activa = 1";
					$sentencia = $conexion -> prepare($sql);
					$sentencia -> bindParam(':autorID', $idUsuario, PDO::PARAM_STR);
					$sentencia -> execute();

					$resultado = $sentencia -> fetch();

					if(!empty($resultado))
					{
						$totalEntradas = $resultado['total_entradas'];
					}

				} catch (PDOException $e) {
					print 'ERROR' . $e -> getMessage();
				}
			}

			return $totalEntradas;
		}

		public static function contarEntradasInactivasUsuario($conexion, $idUsuario)
		{
			$totalEntradas = 0;

			if (isset($conexion)) 
			{
				try 
				{
					$sql = "SELECT COUNT(*) as total_entradas FROM entradas WHERE autor_id = :autorID AND activa = 0";
					$sentencia = $conexion -> prepare($sql);
					$sentencia -> bindParam(':autorID', $idUsuario, PDO::PARAM_STR);
					$sentencia -> execute();

					$resultado = $sentencia -> fetch();

					if(!empty($resultado))
					{
						$totalEntradas = $resultado['total_entradas'];
					}

				} catch (PDOException $e) {
					print 'ERROR' . $e -> getMessage();
				}
			}

			return $totalEntradas;
		}

		public static function getEntradasPorFechaDescendente($conexion, $idUsuario)
		{
			$entradasObtenidas = [];

			if(isset($conexion))
			{
				try 
				{
					$sql = "SELECT a.id, a.autor_id, a.url, a.titulo, a.texto, a.fecha, a.activa, COUNT(b.id) AS 'cantComentarios' FROM entradas a LEFT JOIN comentarios b ON a.id = b.entrada_id WHERE a.autor_id = :autorID GROUP BY a.id ORDER BY a.fecha DESC";
					$sentencia = $conexion -> prepare($sql);
					$sentencia -> bindParam(':autorID', $idUsuario, PDO::PARAM_STR);
					$sentencia -> execute();
					$resultado = $sentencia -> fetchAll();

					if (count($resultado)) {
						foreach ($resultado as $fila) {
							$entradasObtenidas[] = array(new Entrada($fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], 
								$fila['activa']), $fila['cantComentarios']);

						}
					}
				} catch (PDOException $e) {
					print 'ERROR' . $e -> getMessage(); 
				}
			}
			return $entradasObtenidas;
		}
	}
