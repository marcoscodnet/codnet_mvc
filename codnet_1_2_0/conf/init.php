<?php 	
//incluimos el classLoader.
include_once CDT_MVC_PATH . 'utils/ClassLoader.Class.php';

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
}

include_once('templates.php');
?>