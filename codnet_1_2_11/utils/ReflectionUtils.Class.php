<?php

/**
 * Provee métodos para utilizar reflection.
 *
 * @author bernardo
 * @since 13-09-2011
 */
class ReflectionUtils{


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
	 * Se invoca el método $methoName sobre la instancia $oInstance.
	 * @param unknown_type $oInstance
	 * @param unknown_type $methodName
	 * @param unknown_type $args
	 */
	public static function invoke( $oInstance, $methodName, $args=null ){

		//TODO tratar los args.
			
		$reflectionMethod = new ReflectionMethod( get_class( $oInstance ) , $methodName);
		$value = $reflectionMethod->invoke( $oInstance );
			
		return $value;
	}


	/**
	 * forma el getter para un atributo.
	 * @param unknown_type $oInstance
	 * @param unknown_type $methodName
	 * @param unknown_type $args
	 */
	public static function buildGetter( $field ){

		return "get" . ucfirst( $field );
	}
}
