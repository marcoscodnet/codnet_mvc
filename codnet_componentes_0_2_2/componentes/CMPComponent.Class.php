<?php

abstract class CMPComponent{

	public abstract function show();

	protected function getLayout(){
		return new LayoutSimple();
	}
	
	protected function getTitulo(){
		return "";
	}

	public function getValue($item, $method, $itemClass=""){
			
		if(!empty($itemClass)){
			$method = "get" . ucfirst( $method );

			$reflectionMethod = new ReflectionMethod( get_class( $item ) , $method);

			return $reflectionMethod->invoke( $item );
		}else
			
			return $item[$method];
	}

	public function invokeMethod($clazz, $method, $params ){
		
		$oClass = new ReflectionClass($clazz);
		$oInstance = $oClass->newInstance();

		$reflectionMethod = new ReflectionMethod( get_class( $oInstance ) , $method);

		$value = $reflectionMethod->invoke( $oInstance, $params );

		return $value;
		
	}
	
	
	
}
?>