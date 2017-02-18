<?php
	include_once 'app/config.inc.php';
	include_once 'app/Conexion.inc.php';
	include_once 'app/Entrada.inc.php';

	class RepositorioComentario
	{
		public static function insertarComentario($conexion, $comentario)
		{
			$comentarioInsertado = false;

			if(isset($conexion))
			{
				try 
				{
					$sql = "INSERT INTO comentarios(autor_id, entrada_id, titulo, texto, fecha) VALUES(:autorID, :entradaID, :titulo, :texto, NOW())";
					$sentencia = $conexion -> prepare($sql);

					$autorID_C = $comentario -> getAutorID();
					$idEntrada = $comentario -> getEntradaID();
					$tituloC = $comentario -> getTitulo();
					$textoC = $comentario -> getTexto();

					$sentencia -> bindParam(':autorID', $autorID_C, PDO::PARAM_STR);
					$sentencia -> bindParam(':entradaID', $idEntrada, PDO::PARAM_STR);
					$sentencia -> bindParam(':titulo', $tituloC, PDO::PARAM_STR);
					$sentencia -> bindParam(':texto', $textoC, PDO::PARAM_STR);

					$comentarioInsertado = $sentencia -> execute();
				} catch (PDOException $e) {
					print 'ERROR' . $e -> getMessage();
				}
			}
			return $comentarioInsertado;
		}

		public static function getComentarios($conexion, $entradaID)
		{
			$comentarios = array();

			if(isset($conexion))
			{
				try 
				{
					include_once 'Comentario.inc.php';

					$sql = "SELECT * FROM comentarios WHERE entrada_id = :entradaID";
					$sentencia = $conexion -> prepare($sql);
					$sentencia -> bindParam(':entradaID', $entradaID, PDO::PARAM_STR);
					$sentencia -> execute();

					$resultado = $sentencia -> fetchAll();

					if(count($resultado))
					{
						foreach ($resultado as $fila) {
							$comentarios[] = new Comentario($fila['id'], $fila['autor_id'], $fila['entrada_id'], $fila['titulo'], $fila['texto'], $fila['fecha']);
						}
					}
				} catch (PDOException $e) {
					print 'ERROR' . $e -> getMessage();
				}
			}
			return $comentarios;
		}

		public static function contarComentariosUsuario($conexion, $idUsuario)
		{
			$totalComentarios = 0;

			if (isset($conexion)) 
			{
				try 
				{
					$sql = "SELECT COUNT(*) as total_comentarios FROM comentarios WHERE autor_id = :autorID";
					$sentencia = $conexion -> prepare($sql);
					$sentencia -> bindParam(':autorID', $idUsuario, PDO::PARAM_STR);
					$sentencia -> execute();

					$resultado = $sentencia -> fetch();

					if(!empty($resultado))
					{
						$totalComentarios = $resultado['total_comentarios'];
					}

				} catch (PDOException $e) {
					print 'ERROR' . $e -> getMessage();
				}
			}
			return $totalComentarios;
		}

	}