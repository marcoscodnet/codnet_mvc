<?php 

/**
 * Acción para editar un MenuGroup.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
abstract class EditarMenuGroupAction extends EditarAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getEntidad()
	 */
	protected function getEntidad(){
		
		//se construye el MenuGroup a modificar.
		$oMenuGroup = new MenuGroup ( );
		
				
		$oMenuGroup->setCd_menugroup ( FormatUtils::getParamPOST('cd_menugroup') );	
				
		$oMenuGroup->setOrden ( FormatUtils::getParamPOST('orden') );	
				
		$oMenuGroup->setWidth ( FormatUtils::getParamPOST('width') );	
				
		$oMenuGroup->setNombre ( FormatUtils::getParamPOST('nombre') );	
				
		$oMenuGroup->setAction ( FormatUtils::getParamPOST('action') );	
				
		$oMenuGroup->setCssclass ( FormatUtils::getParamPOST('cssclass') );	
		
					
		return $oMenuGroup;
	}
	
		
}
