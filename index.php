<?php 

use core\Managment;
use Nekland\Woketo\Server\WebSocketServer;

use modulos\main\index;


include_once("core/Start.php");
// use core;
// spl_autoload_register("core\Start::autoload"); // A partir de PHP 5.3.0
// var_dump(is_readable(__DIR__ .'/vendor/autoload.php'));
include_once(__DIR__ .'/vendor/autoload.php');
$managment = new Managment();
// exit();
// use core\Managment as mng;
$b = ["TBL_USUARIO"=>"catalogo_usuario"];
$managment->setGlobalVariable($b);
// $a = $managment->getGlobalVariable();
// var_dump($a);
// $managment->exportGlobals();
// var_dump(DIR_MODULOS_BASE);
// exit();

$managment->setModule("main");
$managment->setModule("dashboard");
$managment->setModule("mantenimiento");

$managment->setModulePublic("main");
$managment->setNameFunctionLogin("login");
$managment->disableValidateSession();// revise la variable de sesion SESSION_NAME_USER en config/config.php
// $managment->setNameFunctionMain("index");// ahora no usado , es para la pagina web administrable

$managment->setModuleStart("main");
$managment->enableErrorHandler();
$managment->start();

?>