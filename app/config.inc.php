<?php

	/*Informacion BD*/
	define('NOMBRE_SERVIDOR', 'localhost');
	define('NOMBRE_USUARIO','root');
	define('PASSWORD', '');
	define('NOMBRE_BD','myWP');

	/*Rutas WEB*/
	define('SERVIDOR', "http://localhost/myWP");
	define('RUTA_LOGIN', SERVIDOR.'/login');
	define('RUTA_LOGOUT', SERVIDOR.'/logout');
	define('RUTA_REGISTRO', SERVIDOR.'/registro');
	define('RUTA_REGISTRO_CORRECTO', SERVIDOR.'/registro-correcto');

	define('RUTA_GESTOR', SERVIDOR.'/gestor');
	define('RUTA_GESTOR_ENTRADAS', RUTA_GESTOR.'/entradas');
	define('RUTA_GESTOR_COMENTARIOS', RUTA_GESTOR.'/comentarios');
	define('RUTA_GESTOR_FAVORITOS', RUTA_GESTOR.'/favoritos');
	define('RUTA_NUEVA_ENTRADA', SERVIDOR."/nueva-entrada");

	define('RUTA_FAVORITOS', SERVIDOR.'/login.php');
	define('RUTA_AUTORES', SERVIDOR.'/login.php');

	/*Recursos*/
	define('RUTA_CSS', SERVIDOR.'/css/');
	define('RUTA_JS', SERVIDOR.'/js/');