<?php 

/**
 * Acción para editar un AccionFuncion.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
abstract class EditarAccionFuncionAction extends EditarAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getEntidad()
	 */
	protected function getEntidad(){
		
		//se construye el AccionFuncion a modificar.
		$oAccionFuncion = new AccionFuncion ( );
		
				
		$oAccionFuncion->setCd_accionfuncion ( FormatUtils::getParamPOST('cd_accionfuncion') );	
				
		$oAccionFuncion->setCd_funcion ( FormatUtils::getParamPOST('cd_funcion') );	
				
		$oAccionFuncion->setDs_accion ( FormatUtils::getParamPOST('ds_accion') );	
		
					
		return $oAccionFuncion;
	}
	
		
}
