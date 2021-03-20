<?php

/**
 * Acci�n para recibir de paypal una notificaci�n
 *
 * @author bernardo
 * @since 08-08-2011
 *
 */
abstract class PaypalNotificationAction extends Action{

	//archivo para loguear la comunicaci�n con paypal.
	private $log;
	
	//arreglo con la informaci�n de paypal.
	private $data;

	//procesa la notificaci�n de paypal y retorna la informaci�n
	//de la comunicaci�n con paypal (un array key=value)
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
		//en el proceso del pago, nos quede el log de la notificaci�n.
		
		// 1- obtenemos la informaci�n de la notificaci�n de paypal. 
		try{

			//creamos el log para paypal.
			$this->createLog();
			
			$this->writeLog('Inicio');
			
			//obtenemos los datos de la notificaci�n.
			$this->setData( $this->getNotificationData() );
					
			//log de la notificaci�n de paypal en la base de datos.
			$this->agregarPaypalTx();
			
			$procesar = true;
			
		}catch(IPNInvalidException $ipn_ex){
			$this->writeLog('Failure - Error en la notificaci�n: ' . $ipn_ex->getMessage());
			$forward = null;
			$this->doForwardException( $ipn_ex, $this->getForwardError() );
			
		}catch(PDTFailException $pdt_ex){
			$this->writeLog('Failure - Error en la notificaci�n: ' . $pdt_ex->getMessage());
			$forward = null;
			$this->doForwardException( $pdt_ex, $this->getForwardError() );
			
		}catch(GenericException $ex){
			$this->writeLog('Failure - Error en la notificaci�n: ' . $ex->getMessage());
			$forward = null;
			$this->doForwardException( $ex, $this->getForwardError() );
			
		}

		// 2- procesamos la notificaci�n.
		
		if($procesar)
		try{
					
			//inicio de la transacci�n.
			DbManager::begin_tran();
				
			//procesamos la notificaci�n.
			$this->processNotification();

			//commit de la transacci�n.
			DbManager::save();

			$this->writeLog('Success.');
			fclose($this->log);
			
			$forward = $this->getForwardSuccess();

		}catch(PagoNotFoundException $pago_ex){
			
			$this->writeLog('Failure - PagoNotFoundException - Error procesando la notificaci�n: ' . $pago_ex->getMessage() );
			fclose($this->log);
			
			//rollback de la transacci�n.
			DbManager::undo();
			$forward = null;
			$this->doForwardException( $pago_ex, $this->getForwardError() );
				
		}catch(GenericException $ex){

			$this->writeLog('Failure - GenericException - Error procesando la notificaci�n: ' . $ex->getMessage() );
			fclose($this->log);

			//rollback de la transacci�n.
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

		//chequeamos qu� tipo de transacci�n es.
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
			//se cancela una suscripci�n.
			$this->processSubscriptionCanceled();
			
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_EOT )
			//TODO
			//finaliza el per�do de una suscripci�n.
			$this->processSubscriptionEOT();
			
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_FAILED )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_MODIFY )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_PAYMENT )
			
			//se recibe un pago por una suscripci�n.
			$this->processSubscriptionPayment();
			
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_SIGNUP )
			
			//se recibe un alta de una suscripci�n.
			$this->processSubscriptionSignup();
			
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_VIRTUAL_TERMINAL )
			//TODO
			$this->writeLog("TO DO.");
		elseif( $txnType == CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_WEB_ACCEPT )
			//TODO
			$this->writeLog("TO DO.");
		
	}
	
	/**
	 * se recupera el pago asociado a la transacci�n (invoice).
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
	 * se procesa el signup de una suscripci�n.
	 */
	protected function processSubscriptionSignup(){
		
		$this->writeLog("processSubscriptionSignup: TO DO.");
		
	}
	
	
	/**
	 * se procesa la finalizaci�n de una suscripci�n.
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
	 * se procesa la finalizaci�n una subscripci�n.
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
			$this->writeLog("pago " . $oPago->getCd_pago() . ": ya hab�a sido completado previamente.");
			return false;
		}
	}
	
	
	/**
	 * se procesa la cancelaci�n de una suscripci�n.
	 * (la baja de una subscripci�n)
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
	 * se cancele una subscripci�n.
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
			$this->writeLog("pago " . $oPago->getCd_pago() . ": ya hab�a sido completado previamente.");
			return false;
		}
	}
	
	
	/**
	 * se procesa el pago de una suscripci�n.
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
			$this->writeLog("pago " . $oPago->getCd_pago() . ": ya hab�a sido completado previamente.");
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
