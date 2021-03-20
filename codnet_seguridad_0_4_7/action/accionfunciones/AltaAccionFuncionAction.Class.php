<?php 

/**
 * Acción para dar de alta un AccionFuncion.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class AltaAccionFuncionAction extends EditarAccionFuncionAction{


	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#editar($oEntidad)
	 */
	protected function editar($oEntidad){
		$manager = new AccionFuncionManager();
		$manager->agregarAccionFuncion( $oEntidad );
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardSuccess()
	 */
	protected function getForwardSuccess(){
		return 'alta_accionfuncion_success';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardError()
	 */
	protected function getForwardError(){
		return 'alta_accionfuncion_error';
	}
		
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureAction#getFuncion()
	 */
	public function getFuncion(){
		return CDT_SEGURIDAD_FUNCION_ALTA_ACCIONFUNCION;
	}
	

	protected function getActionForwardFailure(){
		return 'alta_AccionFuncion_init';
	}
	
}
