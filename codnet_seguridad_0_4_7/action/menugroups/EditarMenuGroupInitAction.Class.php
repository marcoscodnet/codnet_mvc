<?php 

/**
 * Acción para inicializar el contexto para editar
 * un MenuGroup.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
abstract class EditarMenuGroupInitAction  extends EditarInitAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getXTemplate()
	 */
	protected function getXTemplate(){
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_EDITAR_MENUGROUP );		
	}

	
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
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#parseEntidad($entidad, $xtpl)
	 */
	protected function parseEntidad($entidad, XTemplate $xtpl){
		$oMenuGroup = FormatUtils::ifEmpty($entidad, new MenuGroup());

				
		$xtpl->assign ( 'cd_menugroup', stripslashes ( $oMenuGroup->getCd_menugroup () ) );
		$xtpl->assign ( 'cd_menugroup_label', CDT_SEGURIDAD_MENUGROUP_CD_MENUGROUP );
				
		$xtpl->assign ( 'orden', stripslashes ( $oMenuGroup->getOrden () ) );
		$xtpl->assign ( 'orden_label', CDT_SEGURIDAD_MENUGROUP_ORDEN );
				
		$xtpl->assign ( 'width', stripslashes ( $oMenuGroup->getWidth () ) );
		$xtpl->assign ( 'width_label', CDT_SEGURIDAD_MENUGROUP_WIDTH );
				
		$xtpl->assign ( 'nombre', stripslashes ( $oMenuGroup->getNombre () ) );
		$xtpl->assign ( 'nombre_label', CDT_SEGURIDAD_MENUGROUP_NOMBRE );
				
		$xtpl->assign ( 'action', stripslashes ( $oMenuGroup->getAction () ) );
		$xtpl->assign ( 'action_label', CDT_SEGURIDAD_MENUGROUP_ACTION );
				
		$xtpl->assign ( 'cssclass', stripslashes ( $oMenuGroup->getCssclass () ) );
		$xtpl->assign ( 'cssclass_label', CDT_SEGURIDAD_MENUGROUP_CSSCLASS );
		
		
		
		

	}

	

}
