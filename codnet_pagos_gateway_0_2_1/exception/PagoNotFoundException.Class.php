<?php

/**
 * Excepción para indicar un pago no existe.
 * 
 * @author bernardo
 * @since 16-08-2011
 */
class PagoNotFoundException extends GenericException{
	
	public function PagoNotFoundException(){
		$cod = 0;
		parent::__construct("Pago not found");
	}
}
