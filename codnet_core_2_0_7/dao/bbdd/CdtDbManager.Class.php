<?php
/**
 * Administra las conexiones a la bbdd.
 *
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 11-03-2010
 *
 */
class CdtDbManager {

	private static $instancia;
	private $databases;

	private function __construct(){
				
	}

	/**
	 * se obtiene la instancia del manager.
	 * @return CdtDbManager
	 */
	public static function getInstance(){
		if (  !self::$instancia instanceof self ) {
			self::$instancia = new self;
		}
		return self::$instancia;
	}

	/**
	 * se realiza la conexi�n a la base de datos.
	 * @param string $dbhost host de la bbdd
	 * @param string $dbuser user de la bbd
	 * @param string $dbpassword password del user
	 * @param string $dbname nomnbre de la bbdd
	 * @param $dbclass clase que implementa la interfaz para interactuar con la bbdd
	 */
	public static function connect($dbhost = DB_HOST, $dbuser = DB_USER, $dbpassword = DB_PASSWORD, $dbname = DB_NAME, $dbclass = DB_CLASS){
		$current = self::getInstance();
		return $current->init( $dbhost, $dbuser, $dbpassword, $dbname, $dbclass);
	}

	/**
	 * rollback de la operaci�n sobre la base de datos.
	 * si no se indica el �ndice de la conexi�n, se toma la conexi�n actual.
	 * @param int $index �ndice de la conexi�n.
	 */
	public static function undo($index=-1) {
		$current = self::getInstance();
		if($index==-1){
			//buscamos la �ltima conecci�n.
			$index =  $current->getDatabaseCount(); 
		}
		return $current->getDatabase($index)->rollback_tran();
	}

	/**
	 * se inicializa una transacci�n sobre la base de datos
	 * si no se indica el �ndice de la conexi�n, se toma la conexi�n actual.
	 * @param int $index �ndice de la conexi�n.
	 */
	public static function begin_tran($index=-1) {
		$current = self::getInstance();
		if($index==-1){
			//buscamos la �ltima conecci�n.
			$index =  $current->getDatabaseCount(); 
		}
		return $current->getDatabase($index)->begin_tran();
	}

	/**
	 * commit de la operaci�n sobre la base de datos.
	 * si no se indica el �ndice de la conexi�n, se toma la conexi�n actual.
	 * @param int $index �ndice de la conexi�n.
	 */
	public static function save($index=-1) {
		$current = self::getInstance();
		if($index==-1){
			//buscamos la �ltima conecci�n.
			$index =  $current->getDatabaseCount(); 
		}
		return $current->getDatabase($index)->commit_tran();
	}

	
	/**
	 * se cierra la conexci�n con la base de datos.
	 * si no se indica el �ndice de la conexi�n, se toma la conexi�n actual.
	 * @param int $index �ndice de la conexi�n.
	 */
	public static function close($index=-1) {
		$current = self::getInstance();
		if($index==-1){
			//buscamos la �ltima conecci�n.
			$index =  $current->getDatabaseCount(); 
		}
		
		$res = true;
		
		//cerramos la conecci�n si es que existe.
		if( $current->existDatabase($index) ){
			
			$res = $current->getDatabase($index)->sql_close();
			
			$current->databaseUnset( $index );
			
			
		}
		
		return $res;
	}
	
	/**
	 * se obtiene una conexi�n a una base de datos.
	 * si no se indica el �ndice de la conexi�n, se toma la conexi�n actual.
	 * @param int $index �ndice de la conexi�n.
	 */
	public static function getConnection($index=-1) {
		$current = self::getInstance();
		if($index==-1){
			//buscamos la �ltima conecci�n.
			$index =  $current->getDatabaseCount(); 
		}
		
		return $current->getDatabase($index);
	}
	
	
	/**
	 * se elimina una conexi�n dado su �ndice
	 * 
	 */
	public function databaseUnset($index){
		
		unset($this->databases[$index]);
		//reindexamos.
		$this->databases = array_values($this->databases);
	}
	
	/**
	 * 
	 * se cheque si existe una conexi�n dado un �ndice
	 * @param int $index �ndice de la conexi�n.
	 * @return boolean
	 */
	public function existDatabase($index){
		
		return ($index > -1) && ($index <= $this->getDatabaseCount());
	}
	
	/**
	 * retorna la cantidad de conexiones
	 * @return int.
	 */
	public function getDatabaseCount(){
		return count($this->databases) - 1;
	}
	
	/**
	 * retorna una base de datos dado el �ndice de conexi�n.
	 * @param int $index �ndice de la conexi�n.
	 * @return CdtIDatabase
	 */
	public function getDatabase( $index=-1 ) {
		//return DbManager::init( $dbhost, $dbuser, $dbpasswd, $dbname);
		//return $this->databases[$index];

		if($index<0)
			$index = 0;
			
		//si index no existe, iniciamos una nueva conecci�n a la base de datos.
		if( !$this->existDatabase($index) )
			$index = $this->init( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_CLASS, $index);
		
		return $this->databases[$index];
	}
	
	
	/**
	 * conecta a la base y retorna la instancia.
	 * @param string $dbhost host de la bbdd
	 * @param string $dbuser user de la bbd
	 * @param string $dbpassword password del user
	 * @param string $dbname nomnbre de la bbdd
	 * @param $dbclass clase que implementa la interfaz para interactuar con la bbdd
	 * @param int $index �ndice de la conexi�n.
	 * @return CdtIDatabase 
	 */
	private function init($dbhost, $dbuser, $dbpasswd, $dbname, $dbclass, $index=null) {
		//instanciamos la base por reflection.
		$database  = CdtReflectionUtils::newInstance( $dbclass ) ;
		$database->connect($dbhost, $dbuser, $dbpasswd, $dbname );
		
		if (! $database->db_connect_id()) {
			throw new DBException ( "No se puede establecer la conexi�n con la base de datos" );
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