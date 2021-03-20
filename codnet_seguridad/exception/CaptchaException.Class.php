<?php

/**
 * Excepción para indicar que el captcha no es correcta.
 * 
 * @author bernardo
 * @since 12-05-2011
 */
class CaptchaException extends GenericException{
	
	public function CaptchaException(){
		$cod = 0;
		parent::__construct("El código de seguridad ingresado no es válido");
	}
}
