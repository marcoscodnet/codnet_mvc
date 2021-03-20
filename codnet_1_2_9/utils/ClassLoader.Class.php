<?php

/**
 * Realiza el include de las clases.
 * 
 * @author bernardo
 * @since 02-03-2010
 */
class ClassLoader{
	
	
	/*
	 * Mantener esta clase como singleton ya no tiene sentido.
	 * 
	 * Ahora las clases se cargan en un hashmap en sesión.
	 * 
	 */
	
	private static $instancia;
	private $classpath;
	
	
	private function __construct(){
		 
	}

	public static function getInstance(){
		if (  !self::$instancia instanceof self ) {
			self::$instancia = new self;
			
			//self::$instancia->setClasspath(self::$instancia->armarDirectorios(APP_PATH.CLASS_PATH));
			
			
		}
		
		return self::$instancia;
	}
	
	
	/**
	 * carga la clase (include_once).
	 * @param $ds_class_name nombre de la clase a cargar.
	 * @return null.
	 */
	static function loadClass($ds_class_name){
		if(!class_exists($ds_class_name)){
			$current = self::getInstance();
			$ds_file_name = $current->getClassFile($ds_class_name);
			//echo $ds_file_name;
			include_once $ds_file_name;
		}
	}

	/**
	 * obtiene la ubicación de la clase.
	 * @param $ds_class_name nombre de la clase a buscar.
	 * @return $filename url de la clase.
	 */
	public function getClassFile($ds_class_name){
	
		if( CLASS_LOADER_FROM_SESSION )
			return $this->getClassFileSession($ds_class_name);
		else
			return $this->getClassFileCache($ds_class_name);
		
	}
	
	/**
	 * obtiene la ubicación de la clase.
	 * @param $ds_class_name nombre de la clase a buscar.
	 * @return $filename url de la clase.
	 */
	public function getClassFileCache($ds_class_name){

		
		include APP_PATH . 'conf/hashClassMap.php';
		$key = $ds_class_name.'.Class.php';
		
		if (!isset($hash["$key"]) || !is_file($hash["$key"]) ){
			$directorios = explode(",", CLASS_PATH);
			$hashAux = array();
			for ($index = 0; $index < count($directorios); $index++) {
				$dir = $directorios[$index];
				$hashAux = array_merge ($hashAux,  $this->armarHash($dir) );
			}
			$fp = fopen(APP_PATH . 'conf/hashClassMap.php', 'w');
			fwrite($fp,"<?php \n");

			foreach ($hashAux as $key => $value) {
				//fwrite($fp, '$hash["'.$key.'"]="'.$value.'";');
				fwrite($fp, "\t\$hash[\"$key\"]=\"$value\";\n");
			}
			fwrite($fp,' ?>');
			fclose($fp);
			include APP_PATH. 'conf/hashClassMap.php';
		}

		$ds_file_name = $hash["$key"];
		$found = !empty( $ds_file_name ) ;

		
		if(!$found)
			throw new ClassNotFoundException($ds_class_name);
		return $ds_file_name;
	}

	/**
	 * obtiene la ubicación de la clase.
	 * @param $ds_class_name nombre de la clase a buscar.
	 * @return $filename url de la clase.
	 */
	public function getClassFileSession($ds_class_name){
		if ( !isset($_SESSION ["hashClasses"]) ){
			//$_SESSION ["hashClasses"] = $this->armarHash(APP_PATH.CLASS_PATH);
			$directorios = explode(",", CLASS_PATH);
			$hash = array();
			for ($index = 0; $index < count($directorios); $index++) {
				$dir = $directorios[$index];
				$hash = array_merge ($hash,  $this->armarHash($dir) );
			}
			$_SESSION ["hashClasses"] = $hash;
			
		}

		$ds_file_name = $_SESSION ["hashClasses"][$ds_class_name . '.Class.php'];
			
		$found = !empty( $ds_file_name ) && is_file( $ds_file_name ) ;				
		
		
		//si no encuentra la clase, volvemos a generar el hashmap por si es una clase nueva.
		if(!$found){
			//$_SESSION ["hashClasses"] = $this->armarHash(APP_PATH.CLASS_PATH);
			$directorios = explode(",", CLASS_PATH);
			$hash = array();
			for ($index = 0; $index < count($directorios); $index++) {
				$dir = $directorios[$index];
				$hash = array_merge ($hash,  $this->armarHash($dir) );
			}
			$_SESSION ["hashClasses"] = $hash;
			
			$ds_file_name = $_SESSION ["hashClasses"][$ds_class_name . '.Class.php'];
			$found = !empty( $ds_file_name ) && is_file( $ds_file_name ) ;
		}
		
		if(!$found)
			throw new ClassNotFoundException($ds_class_name);
		return $ds_file_name;
	}

	
	/*
	 * @deprecated
	 */
	public function armarDirectorios($dir){
		$directorios = array();
		// Open a known directory, and proceed to read its contents
		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {
		        while (($file = readdir($dh)) !== false) {
		            $dirNext = $dir.'/'.$file;
		            if($file!='.' && $file!='..' && is_dir($dirNext) &&(!strstr($file,'svn'))){
		            	array_push ( $directorios, $dirNext );
		            	$subdirectorios = $this->armarDirectorios($dirNext);
		            	$i = 0;
		            	$limit = count ( $subdirectorios );
						while ( $i < $limit ) {
							$subdir = $subdirectorios [$i];
							array_push ( $directorios, $subdir );
							$i++;
						}
		            }
		        }
		        closedir($dh);
		    }
		}
		return $directorios;
	}

	/*
	 * arma un hash donde la key es el nombre de una clase y el value es el path al archivo de la clase.
	 * 
	 * NombreClase -> Url ubicación física: Cliente -> /cdt/modelo/Cliente.Class.php
	 * 
	 */
	public function armarHash($dir){
		$hash = array();
		
		//vemos los directorios a no tener en cuenta, a excluir.
		$excluded = explode(",", CLASS_PATH_EXCLUDE);
		if (empty ( $excluded ))
			 $excluded=array();
		
		if (is_dir($dir) && !in_array($dir, $excluded ) ) { //debe ser un directorio y no tiene que estar excluido del classpath
		    if ($dh = opendir($dir)) {
		        while (($file = readdir($dh)) !== false) {
		            $dirNext = $dir.'/'.$file;
		            if($file!='.' && $file!='..' && (!strstr($file,'svn')) && (!$this->isExcluded($file)) ){
		            	
		            	if( is_dir($dirNext) ){
		            		
		            		$hash = array_merge ($hash,  $this->armarHash($dirNext) );
		            								
		            	}elseif(strstr($file,'.Class.php')){
				            //vamos armando el hash.
				            $hash[$file] = $dirNext ; 	
		            	}
		            }
		        }
		        closedir($dh);
		    }
		}
		return $hash;
	}
	
	
	private function setClasspath($value){
		$this->classpath = $value;
	}
	
	private function getClasspath(){
		return $this->classpath;
	}

	/**
	 * retorna true si el directorio $dir está dentro de la lista
	 * de directorios excluidos, sino false.
	 * TODO revisarlo
	 */
	protected function isExcluded( $dir ){
		$directorios_excluidos = explode(",",CLASS_PATH_EXCLUDE);
		foreach ( $directorios_excluidos as $key => $excluded ) {  
            if( $dir == $excluded ) {  
             return true;  
            }  
  		}
  		return false;   
	}
}
