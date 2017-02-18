<?php

class RepositorioUsuario{

	public static function getUsuarios($conexion)
	{
		$usuarios = array();

		if(isset($conexion))
		{
			try 
			{
				include_once 'Usuario.inc.php';

				$sql = "SELECT * FROM usuarios";
				$sentencia = $conexion -> prepare($sql);
				$sentencia -> execute();

				$resultado = $sentencia -> fetchAll();

				if(count($resultado))
				{
					foreach ($resultado as $fila) {
						$usuarios[] = new Usuario(
							$fila['id'], $fila['nombre'], $fila['correo'], $fila['password'], $fila['fecha_registro'], $fila['activo']
							);
					}
				}else{
					print "No hay usuarios";
				}
			} catch (PDOException $e) {
				print "ERROR" . $e -> getMessage();
			}
		}
		return $usuarios;
	}

	public static function getCantidadUsuarios($conexion)
	{
		$totalUsuarios = null;

		if(isset($conexion))
		{
			try 
			{
				$sql = "SELECT COUNT(*) as total FROM usuarios";
				
				$sentencia = $conexion -> prepare($sql);
				$sentencia -> execute();
				$resultado = $sentencia -> fetch();

				$totalUsuarios = $resultado['total'];
			} catch (Exception $e) {
				print "ERROR" . $e -> getMessage();
			}
		}
		return $totalUsuarios;
	}

	public static function insertarUsuario($conexion, $usuario)
	{
		$usuarioInsertado = false;

		if(isset($conexion))
		{
			try 
			{
				$sql = "INSERT INTO usuarios(nombre, correo, password, fecha_registro, activo) VALUES(:nombre, :correo, :password, NOW(), 0)";
				$sentencia = $conexion -> prepare($sql);

				$nombreUsuario = $usuario -> getNombre();
				$correo = $usuario -> getCorreo();
				$contrasena = $usuario -> getPassword();

				$sentencia -> bindParam(':nombre', $nombreUsuario, PDO::PARAM_STR);
				$sentencia -> bindParam(':correo', $correo, PDO::PARAM_STR);
				$sentencia -> bindParam(':password', $contrasena, PDO::PARAM_STR);

				$usuarioInsertado = $sentencia -> execute();
			} catch (PDOException $e) {
				print 'ERROR' . $e -> getMessage();
			}
		}
		return $usuarioInsertado;
	}

	public static function nombreExiste($conexion, $nombre)
	{
		$nombreExistente = true;

		if(isset($conexion))
		{
			try 
			{
				$sql = "SELECT * FROM usuarios WHERE nombre = :nombre";

				$sentencia = $conexion -> prepare($sql);
				$sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado))
				{
					$nombreExistente = true;
				} else {
					$nombreExistente = false;
				}
			} catch (PDOException $e) {
				print 'ERROR' . $e -> getMessage();
			}
		}
		return $nombreExistente;
	}

	public static function correoExiste($conexion, $correo)
	{
		$correoExistente = true;

		if(isset($conexion))
		{
			try 
			{
				$sql = "SELECT * FROM usuarios WHERE correo = :correo";

				$sentencia = $conexion -> prepare($sql);
				$sentencia -> bindParam(':correo', $correo, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if(count($resultado))
				{
					$correoExistente = true;
				} else {
					$correoExistente = false;
				}
			} catch (PDOException $e) {
				print 'ERROR' . $e -> getMessage();
			}
		}
		return $correoExistente;
	}

	public static function getUsuarioPorCorreo($conexion, $correo)
	{
		$usuario = null;
		if(isset($conexion))
		{
			try 
			{
				include_once 'Usuario.inc.php';

				$sql = "SELECT * FROM usuarios WHERE correo = :correo";
				$sentencia = $conexion -> prepare($sql);
				$sentencia -> bindParam(':correo',$correo, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado = $sentencia -> fetch();

				if(!empty($resultado))
				{
					$usuario = new Usuario($resultado['id'], 
						$resultado['nombre'], 
							$resultado['correo'], 
								$resultado['password'],
									$resultado['fecha_registro'], 
										$resultado['activo']);
				}
			} catch (PDOException $e) 
			{
				print 'ERROR' . $e -> getMessage();
			}
		}
		return $usuario;
	}

	public static function getUsuarioPorID($conexion, $id)
	{
		$usuario = null;
		if(isset($conexion))
		{
			try 
			{
				include_once 'Usuario.inc.php';
				
				$sql = "SELECT * FROM usuarios WHERE id = :id";
				$sentencia = $conexion -> prepare($sql);
				$sentencia -> bindParam(':id',$id, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado = $sentencia -> fetch();

				if(!empty($resultado))
				{
					$usuario = new Usuario($resultado['id'], 
						$resultado['nombre'], 
							$resultado['correo'], 
								$resultado['password'],
									$resultado['fecha_registro'], 
										$resultado['activo']);
				}
			} catch (PDOException $e) 
			{
				print 'ERROR' . $e -> getMessage();
			}
		}
		return $usuario;
	}
}