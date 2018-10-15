<?php

namespace modulos\dashboard\Controller;
use modulos\dashboard\Model\dashboard_model;

/**
* 
*/
// define("DIR_MODULO",dirname(dirname(__FILE__)));
// require_once(DIR_MODULO.'/Model/dashboard_model.php');
class dashboard_controller
{
	private $model;
	function __construct()
	{
		$this->model = new dashboard_model();
	}


	public function sandbox()
	{
		echo "sandbox";
	}

	public function index()
	{
		global $view;
		// echo "dashboard";
		// ob_start();
		// require_once(DIR_MODULOS_BASE.DS."base_html/header.php");
		$view->setVar("clave","valor");
		$view->view("dashboard.html");
		// require_once(DIR_MODULO.DS."View/dashboard.php");
		// require_once(DIR_MODULOS_BASE.DS."base_html/footer.php");
		// $my_html = ob_get_clean();
		// echo json_encode(array('status'=>2,"html"=>$my_html));
	}

	
}