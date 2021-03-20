<?php 	

//para almacenar las clases. 
//0 => en el archivo hashClassMap.php
//1 => en sesión
define("CLASS_LOADER_FROM_SESSION", 0, true);

//para loguear las sentencias sql
define("LOG_SQL",0, true);

//para loguear el debug => CdtUtils::log_debug(...);
define("CDT_DEBUG_LOG", 1, true);
//para loguear errores => CdtUtils::log_error(...);
define("CDT_ERROR_LOG", 1, true);
//para loguear mensajes => CdtUtils::log_message(...);
define("CDT_MESSAGE_LOG", 1, true);	

//incluimos el classLoader.
include_once CDT_MVC_PATH . 'utils/ClassLoader.Class.php';

/*
if (! function_exists ( '__autoload' )) {
	function __autoload($class_name) {
		
		if ($class_name != 'ClassLoader'){
			
			//el class loader se encarga de incluir la clase.
			try{
				ClassLoader::loadClass($class_name);
			}catch(ClassNotFoundException $e){
				//TODO hacer algo!!!					
			}
			
		}
	}
}*/

function autoload($class_name) {
	if ($class_name != 'ClassLoader'){
			
			//el class loader se encarga de incluir la clase.
			try{
				ClassLoader::loadClass($class_name);
			}catch(ClassNotFoundException $e){
				//TODO hacer algo!!!					
			}
			
	}
}
spl_autoload_register('autoload');



include_once('templates.php');
include_once('error_handler.php');
?>