<?php 

/**
 * Acción para modificar un AccionFuncion.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class ModificarAccionFuncionAction extends EditarAccionFuncionAction{


	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#editar($oEntidad)
	 */
	protected function editar($oEntidad){
		$manager = new AccionFuncionManager();
		$manager->modificarAccionFuncion( $oEntidad );
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardSuccess()
	 */
	protected function getForwardSuccess(){
		return 'modificar_accionfuncion_success';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardError()
	 */
	protected function getForwardError(){
		return 'modificar_accionfuncion_error';
	}
		
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureAction#getFuncion()
	 */
	public function getFuncion(){
		return CDT_SEGURIDAD_FUNCION_MODIFICAR_ACCIONFUNCION;
	}

	public function getIdEntidad(){
		return FormatUtils::getParamPOST('id');
	}
	
	
	protected function getActionForwardFailure(){
		return 'modificar_accionfuncion_init';
	}
	
}
