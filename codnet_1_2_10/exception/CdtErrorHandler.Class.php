<?php

/**
 * Clase para manejar los errores de php.
 * 
 * @author bernardo
 * @since 07-09-2011
 */
class CdtErrorHandler {
	
	public function doHandle(  $errno, $errstr, $errfile, $errline ){
		
		CdtUtils::log_error();
		$msg = "errno: " . $errno;
		CdtUtils::log_error( $msg );
			
		$msg = "errstr: " . $errstr;
		CdtUtils::log_error( $msg );
			
		$msg = "errfile: " . $errfile;
		CdtUtils::log_error( $msg );
			
		$msg = "errline: " . $errline;
		CdtUtils::log_error( $msg );
			
	}
}
