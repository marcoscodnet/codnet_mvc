<?php 

/**
 * Acción para visualizar un menuGroup.
 *  
 * @author modelBuilder
 * @since 07-07-2011
 * 
 */
class VerMenuGroupAction extends OutputAction{

	/**
	 * consulta un menuGroup.
	 */
	protected function getContenido(){
			
		$xtpl = $this->getXTemplate ();
		
		if (isset ( $_GET ['id'] )) {
			$cd_menuGroup = FormatUtils::getParam('id');
			
			
			try{
				$id = FormatUtils::getParam('id');			
			
				$criterio = new CriterioBusqueda();
				$criterio->addFiltro('cd_menugroup', $id, '=');
			
				$manager = new MenuGroupManager();
				$oMenuGroup = $manager->getMenuGroup( $criterio );
				
			}catch(GenericException $ex){
				$oMenuGroup = new MenuGroup();
				//TODO ver si se muestra un mensaje de error.
			}			

			//se muestra el menuGroup.
			$this->parseEntidad( $xtpl, $oMenuGroup );
			
			
		}
		
		$xtpl->assign ( 'titulo', 'Detalle de MenuGroup' );
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
	}

	protected function getTitulo(){
		return "Ver MenuGroup";
	}

	public function getXTemplate(){ 
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_VER_MENUGROUP );
	}
	
	public function parseEntidad($xtpl, $oMenuGroup){ 

				
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
