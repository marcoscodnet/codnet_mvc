<?php

/**
 * Utilidades para el tratamiento de formatos.
 * 
 * @author bernardo
 * @since 10-03-2010
 */
class FormatUtils{
	
		
	public static function isEmpty($value){
		return $value==null || $value=='' || (is_int($value) && $value==0);
	}

	public static function ifNull($value,$show){
		return ($value==null)?$show:$value;
	}
	
	public static function ifEmpty($value,$show){
		return (FormatUtils::isEmpty($value))?$show:$value; //TODO parse number.
	}
	
	public static function formatEmpty($value){
		return (FormatUtils::isEmpty($value))?'':$value;
	}
	
	public static function quitarEnters($value){
		$value = str_replace("\n", "", $value);
		return str_replace("\r", "", $value);
	}
	
	/**
	 * si cd1=cd2, formatea la salida :
	 *     'cd1' selected='selected'
	 *     
	 * @param unknown_type $cd1
	 * @param unknown_type $cd2
	 * @return unknown_type
	 */
	public static function selected($cd1, $cd2){
		$value='';
		if($cd1==$cd2){
				$value = "'". $cd1. "'" . " selected='selected'" ;
		}else{
				$value = $cd1;				
		}				
		return $value;
	}	

	
	public static function getParamSESSION($name, $default=''){
		if (isset ( $_SESSION[$name] )){
			$value = $_SESSION[$name];
			
		}
		if(empty($value))
			$value = $default;
		return $value;
	}
	
	public static function getParamFILES($name, $default=''){
		if (isset ( $_FILES[$name] )){
			$value = $_FILES[$name];
			
		}
		if(empty($value))
			$value = $default;
		return $value;
	}
	
	public static function getParam($name, $default='', $filter = true, $encode = true){
		if (isset ( $_GET [$name] )){
			if($filter){
				$inputFilter = new InputFilter();
				$value = $inputFilter->process($_GET[$name]);
				if($encode)
					$value = InputFilter::urlEncode($value);
			}
			else
				$value = $_GET [$name];
			
		}
		if(empty($value))
			$value = $default;
		return $value;
	}

	public static function getParamPOST($name, $default='', $filter = true, $encode = false){
		if (isset ( $_POST [$name] )){

			if($filter){
				$inputFilter = new InputFilter();
				$value = $inputFilter->process($_POST[$name]);
				if($encode)
					$value = InputFilter::urlEncode($value);		
			}
			else
				$value = $_POST [$name];
		}
		
		if(empty($value))
			$value = $default;
			
		
			
		return $value;
	}
	
	
		
	/*
	 * retorna la acción que se está ejecutando.
	 */
	public static function getCurrentAction(){
		$inputFilter = new InputFilter();
				
		if (isset ( $_GET ['action'] )) {
			$action = $inputFilter->process($_GET['action']);

		}else{
	
			if (isset ( $_GET ['accion'] )) 
				$action = $inputFilter->process($_GET['accion']);
			else
 				$action = 'page_not_found' ;
 		
		}

		return $action;
	}

	
	public static function formatMessage($msg, $params){
		
		if(!empty($params)){
			
			$count = count ( $params );
			$i=1;
			while ( $i <= $count ) {
				$param = $params [$i-1];
				
				$msg = str_replace('$'.$i, $param, $msg);
				
				$i ++;
			}
			
		}
		return $msg;
		
	
	}
	
}
