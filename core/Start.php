<?php

namespace core;

class Start {

    static public function autoloadCore($classn) {
    	// global $ds;
    	// var_dump($classn);exit();
    	$ds = DIRECTORY_SEPARATOR;
        if(strpos($classn, "\\") !== false){
        	$classn = trim($classn,"\\");
        	$path = dirname(__DIR__).$ds.str_replace("\\", $ds, $classn).".php";
	        self::requires($path);
	        // echo "carga 1";
        }else{
        	$path = __DIR__.$ds.$classn.".php";
        	self::requires($path);
        	// echo "carga2";
        }
        // callComposer();
    }

    static private function requires($path)
    {
		if(is_readable($path)){
			require_once($path);
		}else{
			trigger_error("File $path not found",E_USER_ERROR);
			exit();
    	}
	}

	static public function autoloadModulos($classn)
	{
		$ds = DIRECTORY_SEPARATOR;
		// var_dump($classn);
		$path = dirname(__DIR__).$ds.str_replace("\\", $ds, $classn).".php";
		// var_dump($path);
		self::requires($path);
	}
}

spl_autoload_register("core\Start::autoloadModulos");
spl_autoload_register("core\Start::autoloadCore");

?>