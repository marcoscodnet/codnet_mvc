<?php 

/**
 * Acción para editar un funcion.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
abstract class EditarFuncionAction extends EditarAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getEntidad()
	 */
	protected function getEntidad(){
		
		//se construye el funcion a modificar.
		$oFuncion = new Funcion ( );
		
				
		$oFuncion->setCd_funcion ( FormatUtils::getParamPOST('cd_funcion') );	
				
		$oFuncion->setDs_funcion ( FormatUtils::getParamPOST('ds_funcion') );	
		
					
		return $oFuncion;
	}
	
		
}
