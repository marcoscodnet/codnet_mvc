<?php 

/**
 * Acción para dar de alta un registracion.
 * 
 * @author modelBuilder
 * @since 13-07-2011
 * 
 */
class AltaRegistracionAction extends EditarRegistracionAction{


	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#editar($oEntidad)
	 */
	protected function editar($oEntidad){
		$manager = new RegistracionManager();
		$manager->agregarRegistracion( $oEntidad );
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardSuccess()
	 */
	protected function getForwardSuccess(){
		return 'alta_registracion_success';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardError()
	 */
	protected function getForwardError(){
		return 'alta_registracion_error';
	}
		

	protected function getActionForwardFailure(){
		return 'alta_registracion_init';
	}
	
}
