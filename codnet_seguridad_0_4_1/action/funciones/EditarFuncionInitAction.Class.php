<?php 

/**
 * Acción para inicializar el contexto para editar
 * un funcion.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
abstract class EditarFuncionInitAction  extends EditarInitAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getXTemplate()
	 */
	protected function getXTemplate(){
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_EDITAR_FUNCION );		
	}

	
	protected function getEntidad(){
		
		//se construye el funcion a modificar.
		$oFuncion = new Funcion ( );
	
				
		$oFuncion->setCd_funcion ( FormatUtils::getParamPOST('cd_funcion') );	
				
		$oFuncion->setDs_funcion ( FormatUtils::getParamPOST('ds_funcion') );	
		
		
		return $oFuncion;
	}	
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#parseEntidad($entidad, $xtpl)
	 */
	protected function parseEntidad($entidad, XTemplate $xtpl){
		$oFuncion = FormatUtils::ifEmpty($entidad, new Funcion());

				
		$xtpl->assign ( 'cd_funcion', stripslashes ( $oFuncion->getCd_funcion () ) );
		$xtpl->assign ( 'cd_funcion_label', CDT_SEGURIDAD_FUNCION_CD_FUNCION );
				
		$xtpl->assign ( 'ds_funcion', stripslashes ( $oFuncion->getDs_funcion () ) );
		$xtpl->assign ( 'ds_funcion_label', CDT_SEGURIDAD_FUNCION_DS_FUNCION );
		
		
		
		

	}

	

}
