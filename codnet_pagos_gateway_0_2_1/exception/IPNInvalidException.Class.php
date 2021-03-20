<?php

/**
 * Excepción para indicar un pago no existe.
 * 
 * @author bernardo
 * @since 16-08-2011
 */
class IPNInvalidException extends GenericException{
	
	public function IPNInvalidException($msg=""){
		$cod = 0;
		parent::__construct($msg);
	}
}
