<?php

/**
 * Acción para recibir de paypal una notificación PDT
 *
 * @author bernardo
 * @since 08-08-2011
 *
 */
class PaypalIPNAction extends PaypalNotificationAction{

	protected function getNotificationType(){
		return "ipn";
	}
	
	protected function createLog(){
		
		$txn_id = FormatUtils::getParamPOST(CDT_PAGOS_GATEWAY_PAYPAL_NOTIFICATION_VAR_TXN_ID);

		$fecha = FuncionesComunes::getFechaHoraActual();
		
		$_Log = fopen(CDT_PAGOS_GATEWAY_PAYPAL_LOG_PATH. "paypal_ipn_$fecha". "_" . "$txn_id.log", "a+") or die("Operation Failed!");
		
		$this->setLog( $_Log );
	}
	
	protected function getNotificationData(){
		
		$handler = new PaypalIPNHandler();
		return $handler->process( $this->getLog() );
		
	}

	protected function getForwardSuccess(){
		return "";
	}
	
	protected function getForwardError(){

		return "";
		
	}	
}
