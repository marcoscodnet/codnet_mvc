<?php 

/**
 * Acción para visualizar un paypalTx.
 *  
 * @author modelBuilder
 * @since 15-08-2011
 * 
 */
class VerPaypalTxAction extends OutputAction{

	/**
	 * consulta un paypalTx.
	 */
	protected function getContenido(){
			
		$xtpl = $this->getXTemplate ();
		
		if (isset ( $_GET ['id'] )) {
			$cd_paypalTx = FormatUtils::getParam('id');
			
			
			try{
				$id = FormatUtils::getParam('id');			
			
				$criterio = new CriterioBusqueda();
				$criterio->addFiltro('cd_paypal_tx', $id, '=');
			
				$manager = new PaypalTxManager();
				$oPaypalTx = $manager->getPaypalTx( $criterio );
				
			}catch(GenericException $ex){
				$oPaypalTx = new PaypalTx();
				//TODO ver si se muestra un mensaje de error.
			}			

			//se muestra el paypalTx.
			$this->parseEntidad( $xtpl, $oPaypalTx );
			
			
		}
		
		$xtpl->assign ( 'titulo', 'Detalle de PaypalTx' );
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
	}

	protected function getTitulo(){
		return "Ver PaypalTx";
	}

	public function getXTemplate(){ 
		return new XTemplate ( CDT_PAGOS_GATEWAY_TEMPLATE_VER_PAYPALTX );
	}
	
	public function parseEntidad($xtpl, $oPaypalTx){ 

				
		$xtpl->assign ( 'cd_paypal_tx', stripslashes ( $oPaypalTx->getCd_paypal_tx () ) );
		$xtpl->assign ( 'cd_paypal_tx_label', CDT_PAGOS_GATEWAY_PAYPAL_TX_CD_PAYPAL_TX );
				
		$xtpl->assign ( 'ds_txn_id', stripslashes ( $oPaypalTx->getDs_txn_id () ) );
		$xtpl->assign ( 'ds_txn_id_label', CDT_PAGOS_GATEWAY_PAYPAL_TX_DS_TXN_ID );
				
		$xtpl->assign ( 'cd_pago', stripslashes ( $oPaypalTx->getCd_pago () ) );
		$xtpl->assign ( 'cd_pago_label', CDT_PAGOS_GATEWAY_PAYPAL_TX_CD_PAGO );
				
		
		$tx = str_replace("\n\r","<br />", $oPaypalTx->getDs_paypal_tx () ) ;
		$tx = str_replace("\n","<br />", $tx ) ;
		$tx = str_replace("\r","<br />", $tx ) ;
		$xtpl->assign ( 'ds_paypal_tx', stripslashes ( $tx ) );
		$xtpl->assign ( 'ds_paypal_tx_label', CDT_PAGOS_GATEWAY_PAYPAL_TX_DS_PAYPAL_TX );
				
		$xtpl->assign ( 'dt_fecha', stripslashes ( $oPaypalTx->getDt_fecha () ) );
		$xtpl->assign ( 'dt_fecha_label', CDT_PAGOS_GATEWAY_PAYPAL_TX_DT_FECHA );
				
		$xtpl->assign ( 'ds_type', stripslashes ( $oPaypalTx->getDs_type () ) );
		$xtpl->assign ( 'ds_type_label', CDT_PAGOS_GATEWAY_PAYPAL_TX_DS_TYPE );
		
		
	}
}
