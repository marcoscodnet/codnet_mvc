<?php
/**
 * 
 * @author bernardo
 * @since 04-03-2010
 * 
 * Construye un objeto.
 *
 */

class GenericFactory implements ObjectFactory{
	
	private $className ;
	
	public function GenericFactory(){
	}
	
	public function getClassName(){
		return $this->className;		
	}
	
	public function setClassName($value){
		$this->className = $value;		
	}
	
	/**
	 * construye un objeto dada la fila corriente de la consulta.
	 * @param $next lectura corriente de una consulta.
	 * @return objeto mapeado.
	 */
	public function build($next ){
		
		$oClass = new ReflectionClass( $this->getClassName() );
		$oObject = $oClass->newInstance();
		
		foreach ($next as $field => $value) {
			$metodoSet = "set". ucwords( $field );
			$clazz = get_class( $oObject );
			$reflectionMethod = new ReflectionMethod( $clazz , $metodoSet);
			$reflectionMethod->invoke( $oObject , $value);
		}
		return $oObject;
	}
}
?>