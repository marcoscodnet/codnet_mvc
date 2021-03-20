<?php

/**
 * Provee métodos para utilizar reflection.
 *
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 13-09-2011
 */
class CdtReflectionUtils{


	/**
	 * se obtiene una instance de la clase $className
	 * @param unknown_type $className nombre de la clase a instanciar.
	 */
	public static function newInstance( $className ){

		$oClass = new ReflectionClass($className);
		$oInstance = $oClass->newInstance();

		return $oInstance;
	}

	/**
	 * Se invoca el setter del $fieldName sobre la instancia $oInstance.
	 * @param unknown_type $oInstance
	 * @param unknown_type $methodName
	 * @param unknown_type $args
	 */
	public static function doSetter( $oInstance, $field, $value=null ){

		//TODO tratar los args.
		$method = self::buildSetter( $field );
		
		self::invoke( $oInstance, $method, $value );
			
	}

	/**
	 * Se invoca el getter del $fieldName sobre la instancia $oInstance.
	 * @param unknown_type $oInstance
	 * @param unknown_type $methodName
	 * @param unknown_type $args
	 */
	public static function doGetter( $oInstance, $field ){

		//TODO tratar los args.
		$method = self::buildGetter( $field );
		
		return self::invoke( $oInstance, $method );
			
	}
	
	/**
	 * Se invoca el método $methoName sobre la instancia $oInstance.
	 * @param unknown_type $oInstance
	 * @param unknown_type $methodName
	 * @param unknown_type $args
	 */
	public static function invoke( $oInstance, $methodName, $args=null ){

		//TODO tratar los args.
			
		$reflectionMethod = new ReflectionMethod( get_class( $oInstance ) , $methodName);
		$value = $reflectionMethod->invoke( $oInstance, $args );
			
		return $value;
	}


	/**
	 * forma el getter para un atributo.
	 * @param string $field
	 */
	public static function buildGetter( $field ){

		return "get" . ucfirst( $field );
	}
	
	/**
	 * forma el setter para un atributo.
	 * @param string $field
	 */
	public static function buildSetter( $field ){

		return "set" . ucfirst( $field );
	}	
}
