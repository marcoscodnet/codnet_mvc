<?php 

/**
 * Acción para dar de alta un pago.
 * 
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
class AltaPagoAction extends EditarPagoAction{


	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#editar($oEntidad)
	 */
	protected function editar($oEntidad){
		$manager = new PagoManager();
		$manager->agregarPago( $oEntidad );
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardSuccess()
	 */
	protected function getForwardSuccess(){
		return 'alta_pago_success';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardError()
	 */
	protected function getForwardError(){
		return 'alta_pago_error';
	}
		

	protected function getActionForwardFailure(){
		return 'alta_pago_init';
	}
	
}
