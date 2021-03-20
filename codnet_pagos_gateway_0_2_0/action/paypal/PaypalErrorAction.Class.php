<?php 

/**
 * Acción para mostrar que hubo un error procesando la notificación
 * de paypal.
 * 
 * @author bernardo
 * @since 16-08-2011
 * 
 */
class PaypalErrorAction extends OutputAction{

	
	/*
	 * contenido a mostrar.
	 */
	protected function getContenido(){
		
		$xtpl = new XTemplate ( CDT_PAGOS_GATEWAY_TEMPLATE_PAYPAL_ERROR );
		
		$xtpl->assign ( 'WEB_PATH', WEB_PATH );
		$xtpl->assign ( 'titulo', $this->getTitulo() );
		
		$msg = FormatUtils::getParam('msg');
		
		$xtpl->assign ( 'mensaje', $msg );
		
		$xtpl->parse ( 'main' );
		
		return $xtpl->text ( 'main' );	
	}
	
		
	protected function getTitulo(){
		return CDT_PAGOS_GATEWAY_TITLE_PAYPAL_ERROR;
	}
			
}