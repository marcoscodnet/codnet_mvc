<?php

/**
 * Acción para recibir de paypal una notificación
 *
 * @author bernardo
 * @since 08-08-2011
 *
 */
abstract class PaypalNotificationAction extends Action{

	//archivo para loguear la comunicación con paypal.
	private $log;
	
	//arreglo con la información de paypal.
	private $data;

	//procesa la notificación de paypal y retorna la información
	//de la comunicación con paypal (un array key=value)
	protected abstract function getNotificationData();

	//forward for success.
	protected abstract function getForwardSuccess();

	//forward for failure.
	protected abstract function getForwardError();

	//crea un archivo para el log.
	protected abstract function createLog();

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureOutputAction#executeImpl()
	 */
	public function execute(){

		//lo hacemos en dos pasos para asegurnos de que ante un fallo
		//en el proceso del pago, nos quede el log de la notificación.
		
		// 1- obtenemos la información de la notificación de paypal. 
		try{

			//creamos el log para paypal.
			$this->createLog();
			
			$this->writeLog('Inicio');
			
			//obtenemos los datos de la notificación.
			$this->setData( $this->getNotificationData() );
					
			//log de la notificación de paypal en la base de datos.
			$this->agregarPaypalTx();
			
			$procesar = true;
			
		}catch(IPNInvalidException $ipn_ex){
			$this->writeLog('Failure - Error en la notificación: ' . $ipn_ex->getMessage());
			$forward = null;
			$this->doForwardException( $ipn_ex, $this->getForwardError() );
			
		}catch(PDTFailException $pdt_ex){
			$this->writeLog('Failure - Error en la notificación: ' . $pdt_ex->getMessage());
			$forward = null;
			$this->doForwardException( $pdt_ex, $this->getForwardError() );
			
		}catch(GenericException $ex){
			$this->writeLog('Failure - Error en la notificación: ' . $ex->getMessage());
			$forward = null;
			$this->doForwardException( $ex, $this->getForwardError() );
			
		}

		// 2- procesamos la notificación.
		
		if($procesar)
		try{
					
			//inicio de la transacción.
			DbManager::begin_tran();
				
			//procesamos la notificación.
			$this->processNotification();

			//commit de la transacción.
			DbManager::save();

			$this->writeLog('Success.');
			fclose($this->log);
			
			$forward = $this->getForwardSuccess();

		}catch(PagoNotFoundException $pago_ex){
			
			$this->writeLog('Failure - PagoNotFoundException - Error procesando la notificación: ' . $pago_ex->getMessage() );
			fclose($this->log);
			
			//rollback de la transacción.
			DbManager::undo();
			$forward = null;
			$this->doForwardException( $pago_ex, $this->getForwardError() );
				
		}catch(GenericException $ex){

			$this->writeLog('Failure - GenericException - Error procesando la notificación: ' . $ex->getMessage() );
			fclose($this->log);

			//rollback de la transacción.
			DbManager::undo();
			$forward = null;
			$this->doForwardException( $ex, $this->getForwardError() );
		}
							


		return $forward;
			
	}

	protected function agregarPaypalTx(){

		$oPaypalTx = new PaypalTx ( );

		$oPaypalTx->setDs_txn_id ( $this->data[CDT_PAGOS_GATEWAY_PAYPAL_NOTIFICATION_VAR_TXN_ID] );

		$oPaypalTx->setCd_pago ( $this->data[CDT_PAGOS_GATEWAY_PAYPAL_VAR_INVOICE] );

		//armamos un texto con toda la data enviada por paypal.
		$ds_paypal = "";
		foreach ($this->data as $key => $val) {
			$ds_paypal .= " $key = $val \n";
			
		}
		$oPaypalTx->setDs_paypal_tx ( $ds_paypal );

		$oPaypalTx->setDt_fecha ( $fecha = FuncionesComunes::getFechaHoraActual() );

		$oPaypalTx->setDs_type ( $this->getNotificationType() );

		$manager = new PaypalTxManager();
		$manager->agregarPaypalTx( $oPaypalTx );

	}
	
	protected abstract function getNotificationType();

	
	protected function processNotification(){

		//chequeamos qué tipo de transacción es.
		$txnType = $this->data[CDT_PAGOS_GATEWAY_PAYPAL_NOTIFICATION_VAR_TXN_TYPE];
		
		$this->writeLog('***********************************');
		$this->writeLog("Process Tx Type:  $txnType ");
		$this->writeLog('***********************************');
		
		
		if( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_ADJUSTMENT )
			//TODO;
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_CART )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_EXPRESS_CHECKOUT )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_MASSPAY )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_MERCH_PMT )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_MP_SIGNUP )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_NEW_CASE )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_RECURRING_PAYMENT )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_RECURRING_PAYMENT_EXPIRED )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_RECURRING_PAYMENT_PROFILE_CREATED )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_RECURRING_PAYMENT_SKIPPED )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SEND_MONEY )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_CANCEL )
			//TODO
			//se cancela una suscripción.
			$this->processSubscriptionCanceled();
			
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_EOT )
			//TODO
			//finaliza el perído de una suscripción.
			$this->processSubscriptionEOT();
			
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_FAILED )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_MODIFY )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_PAYMENT )
			
			//se recibe un pago por una suscripción.
			$this->processSubscriptionPayment();
			
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_SIGNUP )
			
			//se recibe un alta de una suscripción.
			$this->processSubscriptionSignup();
			
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_VIRTUAL_TERMINAL )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_WEB_ACCEPT )
			//TODO
			$this->writeLog("TO DO.");
		
	}
	
	/**
	 * se recupera el pago asociado a la transacción (invoice).
	 */
	protected function getPagoAsociado(){
		
		$cd_pago = $this->data[ CDT_PAGOS_GATEWAY_PAYPAL_VAR_INVOICE ];
		$manager = new PagoManager();
		$oPago = $manager->getPagoPorId($cd_pago);
		
		if($oPago==null || $oPago->getCd_pago()==0)
			throw new PagoNotFoundException();			
		
		return $oPago;
	}

		
	/**
	 * se procesa el signup de una suscripción.
	 */
	protected function processSubscriptionSignup(){
		
		$this->writeLog("processSubscriptionSignup: TO DO.");
		
	}
	
	
	/**
	 * se procesa la finalización de una suscripción.
	 */
	protected function processSubscriptionEOT(){
		
		$paymentStatus = $this->data[CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS];
		$this->writeLog( CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS . "=" . $paymentStatus );
		
		// traemos el pago asociado.
		$oPago = $this->getPagoAsociado();
		
		//procesamos el pago como "finalizado".
		$this->processPaymentSubscriptionEOT( $oPago );
	}
	
	/**
	 * se procesa la finalización una subscripción.
	 * @param $oPago
	 * @return true si se puede procesar, false si ya fue procesado previamente.
	 */
	protected function processPaymentSubscriptionEOT( Pago $oPago ){

		//chequeamos si ya fue procesado.
		if( $oPago->getCd_estadopago() != CDT_PAGOS_GATEWAY_ESTADOPAGO_SUBSCRIPCION_FINALIZADA ){
			
			$oPago->setDt_fechacambioestado( FuncionesComunes::getFechaHoraActual() );
			$oPago->setCd_estadopago( CDT_PAGOS_GATEWAY_ESTADOPAGO_SUBSCRIPCION_FINALIZADA );
			$manager = new PagoManager();
			$manager->modificarPago( $oPago );
			
			$this->writeLog("pago " . $oPago->getCd_pago() . ": subscription eot ");
			return true;
		}else{
			$this->writeLog("pago " . $oPago->getCd_pago() . ": ya había sido completado previamente.");
			return false;
		}
	}
	
	
	/**
	 * se procesa la cancelación de una suscripción.
	 * (la baja de una subscripción)
	 */
	protected function processSubscriptionCanceled(){
	
		$paymentStatus = $this->data[CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS];
		$this->writeLog( CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS . "=" . $paymentStatus );
		
		// traemos el pago asociado.
		$oPago = $this->getPagoAsociado();
		
		//procesamos el pago como "subscription canceled".
		$this->processPaymentSubscriptionCanceled( $oPago );
					
	}
	
	/**
	 * se cancele una subscripción.
	 * @param $oPago
	 * @return true si se puede procesar, false si ya fue procesado previamente.
	 */
	protected function processPaymentSubscriptionCanceled( Pago $oPago ){

		//chequeamos si ya fue procesado.
		if( $oPago->getCd_estadopago() != CDT_PAGOS_GATEWAY_ESTADOPAGO_SUBSCRIPCION_CANCELADA ){
			
			$oPago->setDt_fechacambioestado( FuncionesComunes::getFechaHoraActual() );
			$oPago->setCd_estadopago( CDT_PAGOS_GATEWAY_ESTADOPAGO_SUBSCRIPCION_CANCELADA );
			$manager = new PagoManager();
			$manager->modificarPago( $oPago );
			
			$this->writeLog("pago " . $oPago->getCd_pago() . ": subscription canceled ");
			return true;
		}else{
			$this->writeLog("pago " . $oPago->getCd_pago() . ": ya había sido completado previamente.");
			return false;
		}
	}
	
	
	/**
	 * se procesa el pago de una suscripción.
	 */
	protected function processSubscriptionPayment(){
		

		$paymentStatus = $this->data[CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS];
		$this->writeLog( CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS . "=" . $paymentStatus );
		
		// traemos el pago asociado.
		$oPago = $this->getPagoAsociado();

		
		// tratamos el pago de acuerdo al status.
		if($paymentStatus == CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_CANCELED_REVERSAL )
			//TODO $this->processPaymentCanceledReversal( $oPago );
			$this->writeLog("TO DO.");
		elseif($paymentStatus == CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_COMPLETED )
			$this->processPaymentCompleted( $oPago );
			
		elseif($paymentStatus == CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_CREATED )
			//TODO $this->processPaymentCreated( $oPago );
			$this->writeLog("TO DO.");
		elseif($paymentStatus == CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_DENIED )
			//TODO $this->processPaymentDenied( $oPago );
			$this->writeLog("TO DO.");
		elseif($paymentStatus == CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_EXPIRED )
			//TODO $this->processPaymentExpired( $oPago );
			$this->writeLog("TO DO.");
		elseif($paymentStatus == CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_FAILED )
			//TODO $this->processPaymentFailed( $oPago );
			$this->writeLog("TO DO.");
		elseif($paymentStatus == CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_PENDING )
			//TODO $this->processPaymentPending( $oPago );
			$this->writeLog("TO DO.");
		elseif($paymentStatus == CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_PROCESSED )
			//TODO $this->processPaymentProcessed( $oPago );
			$this->writeLog("TO DO.");
		elseif($paymentStatus == CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_REFUNDED )
			//TODO $this->processPaymentRefunded( $oPago );
			$this->writeLog("TO DO.");
		elseif($paymentStatus == CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_REVERSED )
			//TODO $this->processPaymentReversed( $oPago );
			$this->writeLog("TO DO.");
		elseif($paymentStatus == CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_VOIDED )
			//TODO $this->processPaymentVoided( $oPago );
			$this->writeLog("TO DO.");

	}

	/**
	 * se completa un pago.
	 * @param $oPago
	 * @return true si se puede procesar, false si ya fue procesado previamente.
	 */
	protected function processPaymentCompleted( Pago $oPago ){

		//chequeamos si ya fue completado el pago.
		if( $oPago->getCd_estadopago() != CDT_PAGOS_GATEWAY_ESTADOPAGO_CONFIRMADO ){
			
			$oPago->setDt_fechacambioestado( FuncionesComunes::getFechaHoraActual() );
			$oPago->setCd_estadopago( CDT_PAGOS_GATEWAY_ESTADOPAGO_CONFIRMADO );
			$manager = new PagoManager();
			$manager->modificarPago( $oPago );
			
			$this->writeLog("pago " . $oPago->getCd_pago() . ": confirmed ");
			return true;
		}else{
			$this->writeLog("pago " . $oPago->getCd_pago() . ": ya había sido completado previamente.");
			return false;
		}
	}
	

	public function getLog(){
		return $this->log;
	}
	
	public function setLog( $value ){
		return $this->log = $value ;
	}
	
	public function writeLog( $value ){
		FuncionesComunes::_log( $value , $this->log);
	}
	
	public function getData(){
		return $this->data;
	}
	
	public function setData( $value ){
		return $this->data = $value ;
	}
	
	
}
