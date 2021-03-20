<?php 

/**
 * Acción para editar un registracion.
 * 
 * @author modelBuilder
 * @since 13-07-2011
 * 
 */
abstract class EditarRegistracionAction extends EditarAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getEntidad()
	 */
	protected function getEntidad(){
		
		//se construye el registracion a modificar.
		$oRegistracion = new Registracion ( );
		
				
		$oRegistracion->setCd_registracion ( FormatUtils::getParamPOST('cd_registracion') );	
				
		$oRegistracion->setDs_codigoactivacion ( FormatUtils::getParamPOST('ds_codigoactivacion') );	
				
		$oRegistracion->setDt_fecha ( FormatUtils::getParamPOST('dt_fecha') );	
				
		$oRegistracion->setDs_nomusuario ( FormatUtils::getParamPOST('ds_nomusuario') );	
				
		$oRegistracion->setDs_apynom ( FormatUtils::getParamPOST('ds_apynom') );	
				
		$oRegistracion->setDs_mail ( FormatUtils::getParamPOST('ds_mail') );	
				
		$oRegistracion->setDs_password ( FormatUtils::getParamPOST('ds_password') );	
				
		$oRegistracion->setCd_pais ( FormatUtils::getParamPOST('cd_pais') );	
				
		$oRegistracion->setDs_telefono ( FormatUtils::getParamPOST('ds_telefono') );	
				
		$oRegistracion->setDs_domicilio ( FormatUtils::getParamPOST('ds_domicilio') );	
		
					
		return $oRegistracion;
	}
	
		
}
