<?php
/**
 * Administra las conexiones a la bbdd.
 *
 * @author bernardo
 * @since 11-03-2010
 *
 */
class DbManager {

	private static $instancia;
	private $databases;

	private function __construct(){
				
	}

	public static function getInstance(){
		if (  !self::$instancia instanceof self ) {
			self::$instancia = new self;
		}
		return self::$instancia;
	}

	public static function connect($dbhost = DB_HOST, $dbuser = DB_USER, $dbpassword = DB_PASSWORD, $dbname = DB_NAME, $dbclass = DB_CLASS){
		$current = self::getInstance();
		return $current->init( $dbhost, $dbuser, $dbpassword, $dbname, $dbclass);
	}

	public static function undo($index=0) {
		$current = self::getInstance();
		if($index==0){
			//buscamos la última conección.
			$index =  $current->getDatabaseCount(); 
		}
		return $current->getDatabase($index)->rollback_tran();
	}

	public static function begin_tran($index=0) {
		$current = self::getInstance();
		if($index==0){
			//buscamos la última conección.
			$index =  $current->getDatabaseCount(); 
		}
		return $current->getDatabase($index)->begin_tran();
	}

	public static function save($index=0) {
		$current = self::getInstance();
		if($index==0){
			//buscamos la última conección.
			$index =  $current->getDatabaseCount(); 
		}
		return $current->getDatabase($index)->commit_tran();
	}

	public static function close($index=0) {
		$current = self::getInstance();
		if($index==0){
			//buscamos la última conección.
			$index =  $current->getDatabaseCount(); 
		}
		
		$res = true;
		
		//cerramos la conección si es que existe.
		if( $current->existDatabase($index) ){
			
			$res = $current->getDatabase($index)->sql_close();
			
			$current->databaseUnset( $index );
			
			
		}
		
		return $res;
	}
	
	public static function getConnection($index=0) {
		$current = self::getInstance();
		if($index==0){
			//buscamos la última conección.
			$index =  $current->getDatabaseCount(); 
		}
		
		return $current->getDatabase($index);
	}
	
	public function databaseUnset($index){
		
		unset($this->databases[$index]);
		//reindexamos.
		$this->databases = array_values($this->databases);
	}
	
	public function existDatabase($index){
		
		return ($index > -1) && ($index <= $this->getDatabaseCount());
	}
	
	public function getDatabaseCount(){
		return count($this->databases) - 1;
	}
	
	public function getDatabase( $index=0 ) {
		//return DbManager::init( $dbhost, $dbuser, $dbpasswd, $dbname);
		//return $this->databases[$index];

		if($index<0)
			$index = 0;
			
		//si index no existe, iniciamos una nueva conección a la base de datos.
		if( !$this->existDatabase($index) )
			$index = $this->init( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_CLASS, $index);
		
		return $this->databases[$index];
	}
	
	
	/**
	 * conecta a la base y retorna la instancia.
	 * @return unknown_type
	 */
	private function init($dbhost, $dbuser, $dbpasswd, $dbname, $dbclass, $index=null) {
		//instanciamos la base por reflection.
		$oClass = new ReflectionClass( $dbclass );

		$database  = $oClass->newInstance();
		$database->connect($dbhost, $dbuser, $dbpasswd, $dbname );
		
		if (! $database->db_connect_id()) {
			throw new DBException ( "No se puede establecer la conexión con la base de datos" );
		}
		
		if($index!=null){
			$this->databases[$index] = $database;
			$res = $index;
		}else{ 
			$this->databases[] = $database;
			$res = count($this->databases) - 1;;
		}
		
		return $res;
	}

	static function message_die($error_type, $error_message) {
		throw new DBException ( $error_message );
	}


}

?>