<?php 

/**
 * Acción para inicializar el contexto para editar
 * un estadoPago.
 * 
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
abstract class EditarEstadoPagoInitAction  extends EditarInitAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getXTemplate()
	 */
	protected function getXTemplate(){
		return new XTemplate ( CDT_PAGOS_GATEWAY_TEMPLATE_EDITAR_ESTADOPAGO );		
	}

	
	protected function getEntidad(){
		
		//se construye el estadoPago a modificar.
		$oEstadoPago = new EstadoPago ( );
	
				
		$oEstadoPago->setCd_estadopago ( FormatUtils::getParamPOST('cd_estadopago') );	
				
		$oEstadoPago->setDs_estadopago ( FormatUtils::getParamPOST('ds_estadopago') );	
		
		
		return $oEstadoPago;
	}	
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#parseEntidad($entidad, $xtpl)
	 */
	protected function parseEntidad($entidad, XTemplate $xtpl){
		$oEstadoPago = FormatUtils::ifEmpty($entidad, new EstadoPago());

				
		$xtpl->assign ( 'cd_estadopago', stripslashes ( $oEstadoPago->getCd_estadopago () ) );
		$xtpl->assign ( 'cd_estadopago_label', CDT_PAGOS_GATEWAY_ESTADOPAGO_CD_ESTADOPAGO );
				
		$xtpl->assign ( 'ds_estadopago', stripslashes ( $oEstadoPago->getDs_estadopago () ) );
		$xtpl->assign ( 'ds_estadopago_label', CDT_PAGOS_GATEWAY_ESTADOPAGO_DS_ESTADOPAGO );
		
		
		
		

	}

	

}
