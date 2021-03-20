<?php 

/**
 * Acción para dar de alta un estadoPago.
 * 
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
class AltaEstadoPagoAction extends EditarEstadoPagoAction{


	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#editar($oEntidad)
	 */
	protected function editar($oEntidad){
		$manager = new EstadoPagoManager();
		$manager->agregarEstadoPago( $oEntidad );
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardSuccess()
	 */
	protected function getForwardSuccess(){
		return 'alta_estadopago_success';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardError()
	 */
	protected function getForwardError(){
		return 'alta_estadopago_error';
	}
		

	protected function getActionForwardFailure(){
		return 'alta_estadoPago_init';
	}
	
}
