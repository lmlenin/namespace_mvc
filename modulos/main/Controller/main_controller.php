<?php

/**
* 
*/
namespace modulos\main\Controller;

use modulos\main\Model\main_model;
// define("DIR_MODULO",dirname(dirname(__FILE__)));
// require_once(DIR_MODULO.'/Model/main_model.php');
class main_controller
{
	private $model;
	function __construct()
	{
		$this->model = new main_model();
	}


	public function sandbox()
	{
		echo "sandbox";
	}

	public function index()
	{
		// ob_start();
		// unset($_SESSION["user"]);
		// var_dump($_SESSION);
		// exit();
		echo "Function de inicio";
		// require_once(DIR_MODULOS_BASE.DS."base_html/header.php");
		// require_once(DIR_MODULO.DS."View/main.php");
		// require_once(DIR_MODULOS_BASE.DS."base_html/footer.php");
		// $my_html = ob_get_clean();
		// echo json_encode(array('status'=>2,"html"=>$my_html));
	}

	public function login() // muestra el login
	{
		// require_once(DIR_MODULO.DS."View/login.php");
		echo "login";
	}

	public function userLogin() // para la validacion del usuario y contraseña
	{
		global $db;
		$user = $_POST['usuario'];
		$pwd = $_POST['password'];
		$error = array();
		if(!$user){
			$error['usuario'] = "Ingrese un usuario";
		}
		if(!$pwd){
			$error['password'] = "Ingrese una contraseña";
		}

		if(count($error)>0){
			sendJsonData(array('status'=>STATUS_FAIL,"error"=>$error));
			exit();
		}

		$data_user = $db->from(TBL_USUARIO)
			->where("usu_usuario = ?",$user)
			->where("usu_clave = ?",$pwd)
			->fetchRow();
		
		if($data_user){
			// creo la sesion del usuario
			
			$_SESSION[SESSION_NAME_USER] = $data_user;
			sendJsonData(array("status"=>STATUS_OK));
		}else{
			sendJsonData(array('status'=>STATUS_FAIL,"reason"=>"Usuario o contraseña incorrecta"));
			exit();
		}

	}

}