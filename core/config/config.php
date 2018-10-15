<?php

namespace core\config;

/**
 * 
 */
class config
{
	private $arr_var = ["STATUS_OK"=>2,
						"STATUS_FAIL"=>1,
						"RUTA_MODULO_MENU"=>"/namespace_mvc_socket/modulos",
						"BASE_PUBLIC"=>"/namespace_mvc_socket/public",
						"NAME_PROYECT"=>"namespace_mvc_socket",
						"DS"=>DIRECTORY_SEPARATOR,
						"N_PATH"=>0,
						"SESSION_NAME_USER"=>"user",
						];

	private $arr_db = ['host'=>'localhost',
						'username'=>'root',
						'pwd'=>'',
						'dbname'=>'chat_prueba'
						];
	
	public function getGlobalVariable()
	{
		return $this->arr_var;
	}

	public function getConfigDb()
	{
		return $this->arr_db;
	}

	public function setConfigDb($arr_db)
	{
		$this->arr_db = $arr_db;
	}
	
	public function setGlobalVariable($arr_var)
	{
		foreach ($arr_var as $key => $value) {
			$this->arr_var[strtoupper($key)] = $value;
		}
	}

	public function setNumberPath($npath)
	{
		$this->setGlobalVariable(["N_PATH"=>$npath]);
	}

	public function setNameProyect($name_proyect)
	{
		$this->setGlobalVariable(["RUTA_MODULO_MENU"=>"/".$name_proyect."/modulos","BASE_PUBLIC"=>"/".$name_proyect."/public","NAME_PROYECT"=>$name_proyect]);
	}

	public function setSessionName($session_name)
	{
		$this->setGlobalVariable(["SESSION_NAME_USER"=>$session_name]);
	}

	public function getSessionName()
	{
		return $this->arr_var["SESSION_NAME_USER"];
	}

	public function exportGlobals()
	{
		foreach ($this->arr_var as $key => $value) {
			define($key,$value);
		}
	}

}

// define('STATUS_OK',2);
// define('STATUS_FAIL',1);

// /* CONFIGURACION DEL SERVIDOR Y RUTAS*/
// define('DS',DIRECTORY_SEPARATOR);
// define('NAME_PROYECT', 'prueba_socket_ssl');
// define('BASE_PUBLIC',"/".NAME_PROYECT."/public");
// define('DIR_MODULOS_BASE',dirname(__FILE__));
// define('RUTA_MODULO_MENU','/'.NAME_PROYECT.'/modulos'); // para el menu 
// define('LIB',DIR_MODULOS_BASE.DS."util"); // path de la libreria
// define('N_PATH', 0); // la ubicacion del proyecto con respecto a ña raiz del dominio
// define('SESSION_NAME_USER', 'user');

// define('SERVER_SSL', true);
// // configuracion del servidor con socket_strem o  con socket (necesario configurar el virtual host si es con ssl)
// define('USE_SOCKET_STREAM', false); // false => usar socket (necesario configurar el virtual host si es con ssl)
// 									// true => usar stream_socket (configurar servidor con el archivo pem) obs:
// 									// no compatible con firefox segun pruebas de crt autofirmado

// /* CONFIGURACION DE LA CONEXION A BD*/
// // require_once(LIB.DS."SelectPdo.php");
// $config = ['host'=>'localhost',
// 			'username'=>'root',
// 			'pwd'=>'',
// 			'dbname'=>'chat_prueba'
// 			];
// $selectPdo = new SelectPdo();
// $db = $selectPdo->config($config);

// // TABLAS DE LA BASE DE DATOS

// define("TBL_USUARIO","usuario");