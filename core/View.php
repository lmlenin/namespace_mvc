<?php
namespace core;
/**
 * 
 */
class View
{
	private $vars = array();

	public function setVar($clave,$valor)
	{
		global $managment;
		if(empty($clave)){
			$managment->setLogError("Clave no asignada");
			return false;
		}

		$this->vars[$clave] = $valor;
	}

	public function getVars()
	{
		return $this->vars;
	}

	public function view($name_vista,$is_return = false)
	{
		global $managment;
		$module = strtolower($managment->getPrm(1));
		$path = DIR_MODULOS_BASE.DS.$module.DS."View".DS.$name_vista;
		if(is_readable($path)){
			extract($this->getVars());
			ob_start();
			require_once($path);
			$my_html = ob_get_clean();
			if($is_return){
				return $my_html;
			}else{
				echo $my_html;
			}
		}else{
			trigger_error("File $path not found",E_USER_ERROR);
		}
	}
}
?>