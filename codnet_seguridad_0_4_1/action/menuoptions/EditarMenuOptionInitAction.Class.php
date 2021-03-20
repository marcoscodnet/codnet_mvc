<?php 

/**
 * Acción para inicializar el contexto para editar
 * un MenuOption.
 * 
 * @author modelBuilder
 * @since 05-07-2011
 * 
 */
abstract class EditarMenuOptionInitAction  extends EditarInitAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getXTemplate()
	 */
	protected function getXTemplate(){
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_EDITAR_MENUOPTION );		
	}

	
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
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#parseEntidad($entidad, $xtpl)
	 */
	protected function parseEntidad($entidad, XTemplate $xtpl){
		$oMenuOption = FormatUtils::ifEmpty($entidad, new MenuOption());

				
		$xtpl->assign ( 'cd_menuoption', stripslashes ( $oMenuOption->getCd_menuoption () ) );
		$xtpl->assign ( 'cd_menuoption_label', CDT_SEGURIDAD_MENUOPTION_CD_MENUOPTION );
				
		$xtpl->assign ( 'nombre', stripslashes ( $oMenuOption->getNombre () ) );
		$xtpl->assign ( 'nombre_label', CDT_SEGURIDAD_MENUOPTION_NOMBRE );
				
		$xtpl->assign ( 'href', stripslashes ( $oMenuOption->getHref () ) );
		$xtpl->assign ( 'href_label', CDT_SEGURIDAD_MENUOPTION_HREF );
				
		$xtpl->assign ( 'orden', stripslashes ( $oMenuOption->getOrden () ) );
		$xtpl->assign ( 'orden_label', CDT_SEGURIDAD_MENUOPTION_ORDEN );
				
		$xtpl->assign ( 'cssclass', stripslashes ( $oMenuOption->getCssclass () ) );
		$xtpl->assign ( 'cssclass_label', CDT_SEGURIDAD_MENUOPTION_CSSCLASS );
				
		$xtpl->assign ( 'descripcion_panel', stripslashes ( $oMenuOption->getDescripcion_panel () ) );
		$xtpl->assign ( 'descripcion_panel_label', CDT_SEGURIDAD_MENUOPTION_DESCRIPCION_PANEL );
		
		
		
		$xtpl->assign ( 'cd_menugroup_label', CDT_SEGURIDAD_MENUOPTION_CD_MENUGROUP );
		$selected =  $oMenuOption->getCd_menugroup();
		$this->parseMenuGroup($selected, $xtpl );
		
		
		$xtpl->assign ( 'cd_funcion_label', CDT_SEGURIDAD_MENUOPTION_CD_FUNCION );
		$selected =  $oMenuOption->getCd_funcion();
		$this->parseFuncion($selected, $xtpl );
		
		

	}

	
	protected function parseMenuGroup($selected, XTemplate $xtpl ){
	
		$manager = new MenuGroupManager();
		$criterio = new CriterioBusqueda();
		$menugroups = $manager->getMenugroups( $criterio );
		
		foreach($menugroups as $key => $oMenuGroup) {
		
			$xtpl->assign ( 'ds_MenuGroup', $oMenuGroup->getCd_menugroup() );
			$xtpl->assign ( 'cd_MenuGroup', FormatUtils::selected($oMenuGroup->getCd_menugroup(), $selected ) );
			
			$xtpl->parse ( 'main.menugroups_option' );
		}	
	}
	
	protected function parseFuncion($selected, XTemplate $xtpl ){
	
		$manager = new FuncionManager();
		$criterio = new CriterioBusqueda();
		$funciones = $manager->getFunciones( $criterio );
		
		foreach($funciones as $key => $oFuncion) {
		
			$xtpl->assign ( 'ds_funcion', $oFuncion->getDs_funcion() );
			$xtpl->assign ( 'cd_funcion', FormatUtils::selected($oFuncion->getCd_funcion(), $selected ) );
			
			$xtpl->parse ( 'main.funciones_option' );
		}	
	}

}
