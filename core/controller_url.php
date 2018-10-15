<?php
    
    require_once("lib.config.php");
    require_once("lib.functions.php");
    require_once(LIB.DS."util.php");
    require_once("Managment.php");
    $managment = new Managment();

    // $_SESSION['user'] = array("staus");
    // var_dump($_SESSION);
    // unset($_SESSION['user']);
    // var_dump($_SESSION);
    $managment->setModule("main");
    $managment->setModule("dashboard");
    $managment->setModule("mantenimiento");

    $managment->setModulePublic("main");
    $managment->setNameFunctionLogin("login");
    $managment->setNameFunctionMain("index");// ahora no usado , es para la pagina web administrable

    $managment->setModuleStart("dashboard");
    $managment->enableErrorHandler();
    $managment->start();
    // var_dump($managment->getLogError());
    // $url_format = array();
    // $_modules = array();
    // $url_format = getCurrentUri();
    // $urlModule = getPrm(1);

    // var_dump($urlModule);
    // exit();
    // log
    // $log = new log_web();
    // $log->registrarLog();

    // if($urlModule){
    //     if(file_exists(DIR_MODULOS_BASE.DS.$urlModule)){
    //         $name_controller = getPrm(2);
    //         if($name_controller == ''){
    //             $is_base = true;
    //             $archivo = 'index.php';
    //         }
    //         if(isset($is_base)){
    //             $ruta =  DIR_MODULOS_BASE.DS.strtolower($urlModule).DS.$archivo;
    //         }else{
    //             $ruta =  DIR_MODULOS_BASE.DS.strtolower($urlModule).DS."Controller".DS.strtolower($name_controller).".php";
    //         }
    //         // var_dump($ruta);exit();
    //         if(file_exists($ruta)){
    //             require_once($ruta);
    //             // echo "se importa ".$ruta;
    //             // echo $function;
    //             if(getPrm(3)){
    //                 $function = getPrm(3);
    //                 $controller = new $name_controller();
    //                 $controller->$function();
    //             }
                
    //         }else{
    //             // header("Location: /validacion_dev/validacion_bootstrap/modulos/util/error.php");
    //             require_once("util/error.php");
    //         }

    //         exit();
    //     }else{
    //         // header("Location: /validacion_dev/validacion_boostrap/modulos/error.php");
    //         require_once("util/error.php");
    //         // echo "no existe";
    //     }
    	
    // }else{
    // 	// header("Location: /validacion_dev/validacion_bootstrap/modulos/configuracion");
    //     require_once("base_html/header.php");
    //     require_once("base_html/footer.php");
    // }
