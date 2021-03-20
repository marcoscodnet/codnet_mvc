<?php 

/**
 * Acción para editar un MenuOption.
 * 
 * @author modelBuilder
 * @since 05-07-2011
 * 
 */
abstract class EditarMenuOptionAction extends EditarAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getEntidad()
	 */
	protected function getEntidad(){
		
		//se construye el MenuOption a modificar.
		$oMenuOption = new MenuOption ( );
		
				
		$oMenuOption->setCd_menuoption ( FormatUtils::getParamPOST('cd_menuoption') );	
				
		$oMenuOption->setNombre ( FormatUtils::getParamPOST('nombre') );	
				
		$oMenuOption->setHref ( FormatUtils::getParamPOST('href') );	
				
		$oMenuOption->setCd_funcion ( FormatUtils::getParamPOST('cd_funcion') );	
				
		$oMenuOption->setOrden ( FormatUtils::getParamPOST('orden') );	
				
		$oMenuOption->setCd_menugroup ( FormatUtils::getParamPOST('cd_menugroup') );	
				
		$oMenuOption->setCssclass ( FormatUtils::getParamPOST('cssclass') );	
				
		$oMenuOption->setDescripcion_panel ( FormatUtils::getParamPOST('descripcion_panel') );	
		
					
		return $oMenuOption;
	}
	
		
}
