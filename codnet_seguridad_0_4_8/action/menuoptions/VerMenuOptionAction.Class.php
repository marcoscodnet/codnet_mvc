<?php 

/**
 * Acción para visualizar un MenuOption.
 *  
 * @author modelBuilder
 * @since 05-07-2011
 * 
 */
class VerMenuOptionAction extends OutputAction{

	/**
	 * consulta un MenuOption.
	 */
	protected function getContenido(){
			
		$xtpl = $this->getXTemplate ();
		
		if (isset ( $_GET ['id'] )) {
			$cd_MenuOption = FormatUtils::getParam('id');
			
			
			try{
				$id = FormatUtils::getParam('id');			
			
				$criterio = new CriterioBusqueda();
				$criterio->addFiltro('cd_menuoption', $id, '=');
			
				$manager = new MenuOptionManager();
				$oMenuOption = $manager->getMenuOption( $criterio );
				
			}catch(GenericException $ex){
				$oMenuOption = new MenuOption();
				//TODO ver si se muestra un mensaje de error.
			}			

			//se muestra el MenuOption.
			$this->parseEntidad( $xtpl, $oMenuOption );
			
			
		}
		
		$xtpl->assign ( 'titulo', 'Detalle de MenuOption' );
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
	}

	protected function getTitulo(){
		return "Ver MenuOption";
	}

	public function getXTemplate(){ 
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_VER_MENUOPTION );
	}
	
	public function parseEntidad($xtpl, $oMenuOption){ 

				
		$xtpl->assign ( 'cd_menuoption', stripslashes ( $oMenuOption->getCd_menuoption () ) );
		$xtpl->assign ( 'cd_menuoption_label', CDT_SEGURIDAD_MENUOPTION_CD_MENUOPTION );
		
		$xtpl->assign ( 'nombre', stripslashes ( $oMenuOption->getNombre () ) );
		$xtpl->assign ( 'nombre_label', CDT_SEGURIDAD_MENUOPTION_NOMBRE );
				
		$xtpl->assign ( 'href', stripslashes ( $oMenuOption->getHref () ) );
		$xtpl->assign ( 'href_label', CDT_SEGURIDAD_MENUOPTION_HREF );
				
		$xtpl->assign ( 'cd_funcion', stripslashes ( $oMenuOption->getCd_funcion () ) );
		$xtpl->assign ( 'cd_funcion_label', CDT_SEGURIDAD_MENUOPTION_CD_FUNCION);
		
		$xtpl->assign ( 'orden', stripslashes ( $oMenuOption->getOrden () ) );
		$xtpl->assign ( 'orden_label', CDT_SEGURIDAD_MENUOPTION_ORDEN );
				
		$xtpl->assign ( 'cd_menugroup', stripslashes ( $oMenuOption->getCd_menugroup () ) );
		$xtpl->assign ( 'cd_menugroup_label', CDT_SEGURIDAD_MENUOPTION_CD_MENUGROUP);
		
		$xtpl->assign ( 'cssclass', stripslashes ( $oMenuOption->getCssclass () ) );
		$xtpl->assign ( 'cssclass_label', CDT_SEGURIDAD_MENUOPTION_CSSCLASS );
				
		$xtpl->assign ( 'descripcion_panel', stripslashes ( $oMenuOption->getDescripcion_panel () ) );
		$xtpl->assign ( 'descripcion_panel_label', CDT_SEGURIDAD_MENUOPTION_DESCRIPCION_PANEL );
		
	}
}
