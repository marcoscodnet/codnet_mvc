<?php

/**
 * Excepción para indicar un pago no existe.
 * 
 * @author bernardo
 * @since 16-08-2011
 */
class PDTFailException extends GenericException{
	
	public function PDTFailException($msg=""){
		$cod = 0;
		parent::__construct($msg);
	}
}
