<?php

namespace modulos\main;
use modulos\main\Controller\main_controller;

class index
{
	
	function __construct()
	{
		$c_main = new main_controller();
		$c_main->index();
	}
}
// include_once('Controller/main_controller.php');
