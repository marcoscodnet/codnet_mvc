<?php
/**
 * Construye un objeto utilizando sus propiedades con reflection.
 *  
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 04-03-2010  
 *
 */

class CdtGenericFactory implements ICdtObjectFactory{
	
	//nombre de la clase a construir.
	private $className ;

	/* Getters & Setters */
	public function getClassName(){
		return $this->className;		
	}
	
	public function setClassName($value){
		$this->className = $value;		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see ICdtObjectFactory::build();
	 */
	public function build($next ){
		
		$oObject = CdtReflectionUtils::newInstance( $this->getClassName() );
		
		foreach ($next as $field => $value) {
			try{
				/*
				$metodoSet = "set". ucwords( $field );
				$clazz = get_class( $oObject );
				$reflectionMethod = new ReflectionMethod( $clazz , $metodoSet);
				$reflectionMethod->invoke( $oObject , $value);
				*/
				CdtReflectionUtils::doSetter( $oObject, $field, $value );
				
			}catch(ReflectionException $re){
				
			}
		}
		return $oObject;
	}
}
?>