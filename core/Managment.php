<?php
/**
 * 
 */
namespace core;
use core\config\config;
class Managment extends config
{
	const NO_FOUND_PAGE = 404;

	private $modulos = array();
	private $url_uri = array();
	private $uri_login = ""; // login general
	private $uri_main = ""; // posible uso cuando tenga una web q administrar
	private $module_public = "";
	private $enable_error = false;
	private $module_start = "";
	private $disableValidateSession = false;

	private $log_error =  array();

	function __construct()
	{
		session_start();
		date_default_timezone_set('America/Lima');
		$this->url_uri = $this->getCurrentUri();
		$this->setGlobalVariable(["DIR_MODULOS_BASE"=>dirname(__DIR__)."/modulos"]);
		$this->exportGlobals();
	}

	public function setNameFunctionLogin($uri)
	{
		if($this->module_public){
			$this->uri_login = $uri;
		}else{
			$this->setLogError("Modulo publico no definido");
			return false;
		}
	}

	public function setNameFunctionMain($uri)
	{
		if($this->module_public){
			$this->uri_main = $uri;
		}else{
			$this->setLogError("Modulo publico no definido");
			return false;
		}
	}

	public function setModulePublic($module)
	{
		if($this->searchModule($module)){
			$this->module_public = $module;
		}else{
			$this->setLogError("No se pudo añadir ".$module." como modulo público");
			return false;
		}
	}

	public function setModule($module)
	{

		if(!$this->searchModule($module))
		{
			$this->modulos[strtolower($module)] = $module;
		}
		return true;
	}

	public function deleteModule($module)
	{
		if($this->searchModule($module)){
			unset($this->modulos[$this->searchModule($module)]);
		}
		return true;
	}

	public function setModuleStart($module)
	{
		if($this->searchModule($module)){
			$this->module_start = $module;
			return true;
		}else{
			$this->setLogError("No se encontro el modulo: ".$module);
			return false;
		}
	}

	public function searchModule($module,$index=0)
	{
		if($module){
			return array_search($module, $this->modulos);
		}else{
			$this->setLogError("Modulo ".$module." no encontrado o no estas autorizado");
			return false;
		}		
	}

	private function getCurrentUri()
	{
	    $uri = urldecode($_SERVER['REQUEST_URI']);
	    $split = explode('?',$uri);
	    $uri = $split[0];
	    if (substr($uri,0,1) =='/')
	    {
	      $uri = substr($uri,1);
	    }
	    $prmuri = explode('/',$uri);
	    // limpiar valores vacios
	    // resetar indices del array
	    $prmuri = array_filter($prmuri, "strlen");
	    $prmuri = array_values($prmuri);

	    return $prmuri;
	}

	public function disableValidateSession()
	{
		$this->disableValidateSession = true;
	}

	private function isLoged()
	{
		if(isset($_SESSION[SESSION_NAME_USER]))
		{
			return true;
		}else{
			$this->setLogError("Usuario no logueado");
			return false;
		}
	}
	public function getUriAll()
	{
		return $this->url_uri;
	}

	public function getPrm($index)
	{
	    if(count($this->url_uri)>(N_PATH+$index)){
	    	if($this->url_uri[(N_PATH+$index)]){
				return $this->url_uri[(N_PATH+$index)];
			}else{
				return '';
			}
	    }else{
	    	return '';
	    }
	}

	// private function getPathModuleController($module,$controller = "",$call_default_controller = false)
	// {
	// 	if($controller){
	// 		$name_controller = $controller;
	// 	}else{
	// 		if($call_default_controller){
	// 			$name_controller = $module."_controller";
	// 			$path = DIR_MODULOS_BASE.DS.strtolower($module).DS."Controller".DS.strtolower($name_controller).".php";
	// 			return array('path'=>$path,"name_controller"=>$name_controller);
	// 		}
	// 		$name_controller = "index";
	// 		$path = DIR_MODULOS_BASE.DS.strtolower($module).DS.strtolower($name_controller).".php";
	// 	}
	// 	if(!isset($path)){
	// 		$path = DIR_MODULOS_BASE.DS.strtolower($module).DS."Controller".DS.strtolower($name_controller).".php";
	// 	}
	// 	return $path;

	// }
	// llama a una funcion dentro del modulo publico
	// private function redirectPublic($uri,$validajax = false)
	// {
	// 	if(!$this->module_public){
	// 		$this->setLogError("No hay modulo publico cargado, use setModulePublic($module)");
	// 		return false;
	// 	}
	// 	if($uri == $this->uri_login){
	// 		ob_start();
	// 	}
	// 	// $name_controller = $this->module_public."_controller";
	// 	// $path_controller = DIR_MODULOS_BASE.DS.strtolower($this->module_public).DS."Controller".DS.strtolower($name_controller).".php";
	// 	$path_controller = $this->getPathModuleController($this->module_public,"",true);
	// 	if($this->requiereFile($path_controller['path']))
	// 	{
	// 		// $controller = new $name_controller();
	// 		$controller = new $path_controller['name_controller'];
	// 		$controller->$uri();
	// 		if($uri == $this->uri_login && $this->isAjaxRequest()){
	// 			$html = ob_get_clean();
	// 			sendJsonData(array('status'=>STATUS_OK,'html'=>$html));
	// 		}
	// 	}
	// 	exit();
	// }

	public function redirect($module)
	{
		if($this->searchModule($module)){
			header("Location:/".NAME_PROYECT."/".$module);
			exit();
		}else{
			$this->setLogError("No se pudo cargar el modulo: ".$module);
			return false;
		}
	}

	private function isAjaxRequest()
	{
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			return true;
		}else{
			return false;
		}
	}

	public function setLogError($text)
	{
		if($this->enable_error){
			$this->log_error[] = $text;
		}
		return true;
	}

	public function getLogError()
	{
		return $this->log_error;
	}

	// private function requiereFile($path)
	// {
	// 	// $a = str_replace("/", "\\", $path);
	// 	// var_dump($a);
	// 	if(file_exists($path))
	// 	{
	// 		require_once($path);
	// 		return true;
	// 	}else{
	// 		$this->setLogError("No existe el fichero: ".$path);
	// 		return false;
	// 	}
	// }

	// function aun no funcional 
	protected function errorHandler($errno, $errstr, $errfile, $errline)
	{	
		$hoy = new DateTime();
	    switch ($errno) {
	       case E_WARNING:
	       		echo "E_WARNING : ".$errstr." in ".$errfile."\n line: ".$errline."\t".$hoy->format("Y-m-d H:i:s").PHP_EOL;
	            exit();
	            break;
	        case E_NOTICE:
	        	echo "E_WARNING : ".$errstr." in ".$errfile."\n line: ".$errline."\t".$hoy->format("Y-m-d H:i:s").PHP_EOL;
	            exit();
	            break;
	        default:
	            echo "ERROR : ".$errstr." in ".$errfile."\n line: ".$errline."\t".$hoy->format("Y-m-d H:i:s").PHP_EOL;
	            exit();
	            break;
        }
	}

	public function enableErrorHandler()
	{
		ini_set("display_errors", "on");
		error_reporting( E_ALL );
		// $var = set_error_handler(array($this,'errorHandler'));
		// $this->error = new TestErrorHandler;
		// $var = set_error_handler(array($this,'errorHandler'));
		// $var = set_error_handler(array($this,'errorHandler'));
		// var_dump($var);
		// $error = new Error();
		$this->enable_error = true;
	}

	public function disableErrorHandler()
	{
		ini_set("display_errors", "off");
		$this->enable_error = false;
	}

	public function showPageError($id_error)
	{
		switch ($id_error) {
			case self::NO_FOUND_PAGE:
				// $this->requiereFile(DIR_MODULOS_BASE.DS."util".DS."error.php");
				$this->startController("\\core\\error\\error404\\error404","show");
				break;
			default:
				
				break;
		}
	}

	public function getNamespace($url_module,$name_controller,$function)
	{
		if(empty($url_module)){
			$url_module = $this->module_public;
		}
		if(empty($name_controller)){
			$name_controller = $url_module."_controller";
		}
		if(empty($function)){
			$function = "index";
		}
		$n["namespace"] = "modulos\\".$url_module."\\"."Controller"."\\".$name_controller;
		$n["function"] = $function;
		return $n;
	}

	private function startController($controller = '',$function = '')
	{
		if(empty($controller) || empty($function)){
			$this->setLogError("Controller/function no definido");
			return false;
		}
		$view = new View();
		$GLOBALS["view"] = $view;
		$controller = new $controller;
		if(method_exists($controller,$function)){
			$controller->$function();
		}
		exit();
	}

	public function start()
	{
		// $this->setGlobalVariable(["DIR_MODULOS_BASE"=>dirname(__DIR__)."/modulos"]);
		$url_module = $this->getPrm(1);
		$name_controller = $this->getPrm(2);
		$function = $this->getPrm(3);

		if(count($this->url_uri) == 1){ // cuando a la ruta del proyecto
			$this->redirect($this->module_start);
		}
		if($url_module != $this->module_public){
			$n = $this->getNamespace($this->module_public,$this->module_public."_controller",$this->uri_login);
			if(!$this->disableValidateSession){
				if(!$this->isLoged()){
					$this->startController($n["namespace"],$n["function"]);
				}
			}
		}
		if($this->searchModule($url_module)){
			$n = $this->getNamespace($url_module,$name_controller,$function);
			$this->startController($n["namespace"],$n["function"]);
		}
		$this->showPageError(self::NO_FOUND_PAGE);
	}


}





?>
