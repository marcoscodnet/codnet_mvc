<?php 

/**
 * Acción para mostrar que fue cancelada la operación de pago en paypal.
 * 
 * @author bernardo
 * @since 10-08-2011
 * 
 */
class PaypalCanceledAction extends OutputAction{

	
	/*
	 * contenido a mostrar.
	 */
	protected function getContenido(){
		
		$xtpl = new XTemplate ( CDT_PAGOS_GATEWAY_PAYPAL_CANCELED );
		
		$xtpl->assign ( 'WEB_PATH', WEB_PATH );
		$xtpl->assign ( 'titulo', $this->getTitulo() );
		$xtpl->assign ( 'mensaje', CDT_PAGOS_GATEWAY_MSG_PAYPAL_CANCELED);
		
		$xtpl->parse ( 'main' );
		
		return $xtpl->text ( 'main' );	
	}
	
		
	protected function getTitulo(){
		return CDT_PAGOS_GATEWAY_TITLE_PAYPAL_CANCELED;
	}
			
}