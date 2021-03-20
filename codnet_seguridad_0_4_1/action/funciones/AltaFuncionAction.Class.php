<?php 

/**
 * Acción para dar de alta un funcion.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class AltaFuncionAction extends EditarFuncionAction{


	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#editar($oEntidad)
	 */
	protected function editar($oEntidad){
		$manager = new FuncionManager();
		$manager->agregarFuncion( $oEntidad );
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardSuccess()
	 */
	protected function getForwardSuccess(){
		return 'alta_funcion_success';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardError()
	 */
	protected function getForwardError(){
		return 'alta_funcion_error';
	}
		
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureAction#getFuncion()
	 */
	public function getFuncion(){
		return CDT_SEGURIDAD_FUNCION_ALTA_FUNCION;
	}
	

	protected function getActionForwardFailure(){
		return 'alta_funcion_init';
	}
	
}
