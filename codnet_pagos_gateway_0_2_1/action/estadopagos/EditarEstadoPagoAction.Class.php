<?php 

/**
 * Acción para editar un estadoPago.
 * 
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
abstract class EditarEstadoPagoAction extends EditarAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getEntidad()
	 */
	protected function getEntidad(){
		
		//se construye el estadoPago a modificar.
		$oEstadoPago = new EstadoPago ( );
		
				
		$oEstadoPago->setCd_estadopago ( FormatUtils::getParamPOST('cd_estadopago') );	
				
		$oEstadoPago->setDs_estadopago ( FormatUtils::getParamPOST('ds_estadopago') );	
		
					
		return $oEstadoPago;
	}
	
		
}
