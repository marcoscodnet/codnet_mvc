<?php

/**
 * Acción para recibir de paypal una notificación PDT
 *
 * @author bernardo
 * @since 08-08-2011
 *
 */
class PaypalPDTAction extends PaypalNotificationAction{

	protected function getNotificationType(){
		return "pdt";
	}
	protected function createLog(){

		$tx = FormatUtils::getParamPOST(CDT_PAGOS_GATEWAY_PAYPAL_PDT_TX_TOKEN);

		$fecha = FuncionesComunes::getFechaHoraActual();

		$_Log = fopen(CDT_PAGOS_GATEWAY_PAYPAL_LOG_PATH. "paypal_pdt_$fecha". "_" . "$tx.log", "a+") or die("Operation Failed!");

		$this->setLog( $_Log );
	}

	protected function getNotificationData(){

		$handler = new PaypalPDTHandler();
		return $handler->process( $this->getLog() );
	}

	protected function getForwardSuccess(){

		//se muestra una página con los datos de success del pago.
		$data = $this->getData();
		$params = 'cd_pago=' . $data[CDT_PAGOS_GATEWAY_PAYPAL_VAR_INVOICE];
		$this->setDs_forward_params($params);
			
		return "paypal_pdt_success";
	}

	protected function getForwardError(){
		//se muestra una página con los datos de failure del pago.
		return "paypal_pdt_error";
	}


}
