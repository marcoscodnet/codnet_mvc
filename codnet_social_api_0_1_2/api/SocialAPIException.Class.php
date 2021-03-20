<?php

/**
 * Excepción para manejar los errores
 * de las APIs de las redes sociales.
 * 
 * @author bernardo
 * @since 28-09-2011
 */
class SocialAPIException extends Exception{
	
	public function SocialAPIException($msg=null, $cod=0){
		
		if($msg==null)
			$msg = "Error en la comunicación con la API";
		
		parent::__construct($msg, $cod);
	}
	
}
