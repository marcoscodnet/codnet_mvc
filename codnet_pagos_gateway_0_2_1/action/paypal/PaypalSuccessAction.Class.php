<?php 

/**
 * Acci�n para mostrar que la nueva clave solicitada fue enviada exitosamente.
 * 
 * @author bernardo
 * @since 26-05-2011
 * 
 */
class PaypalSuccessAction extends OutputAction{

	
	/*
	 * contenido a mostrar.
	 */
	protected function getContenido(){
		
		$xtpl = new XTemplate ( CDT_PAGOS_GATEWAY_TEMPLATE_PAYPAL_SUCCESS );
		
		$xtpl->assign ( 'WEB_PATH', WEB_PATH );
		$xtpl->assign ( 'titulo', $this->getTitulo() );
		$xtpl->assign ( 'mensaje', CDT_PAGOS_GATEWAY_MSG_PAYPAL_SUCCESS);
		
		$xtpl->parse ( 'main' );
		
		return $xtpl->text ( 'main' );	
	}
	
		
	protected function getTitulo(){
		return CDT_PAGOS_GATEWAY_TITLE_PAYPAL_SUCCESS;
	}
			
}