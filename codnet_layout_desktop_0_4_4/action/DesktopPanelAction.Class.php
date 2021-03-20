<?php 

/**
 * Acción para mostrar un panel de control.
 * 
 * @author bernardo
 * @since 08-03-2011
 * 
 */
class DesktopPanelAction extends PanelAction{

	/**
	 * template donde parsear la salida.
	 * @return unknown_type
	 */
	protected function getXTemplate(){
		return new XTemplate( CDT_LAYOUT_DESKTOP_TEMPLATE_PANEL );
	}

	protected function parsePanel( XTemplate $xtpl ){
	
		$menuGroupActivo = FormatUtils::getParam('menuGroupActivo');

		$menuOptions = FormatUtils::getParam('menuOptions');
		
		//instanciamos el menú por reflection.
		$default_menu = DEFAULT_MENU;
		if( !empty($default_menu) ){
			$oClass = new ReflectionClass(DEFAULT_MENU);
			$oMenu = $oClass->newInstance();
		
		
			//si no hay una solapa activa, mostramos todo el menú.
			if( empty($menuGroupActivo) ){
				$this->parseMenu( $xtpl, $oMenu );
			}else{
			
				//si hay opciones definidas las mostramos, sino mostramos las opciones del menú activo.
				if( empty( $menuOptions) ){
					$this->parseMenuGroup( $xtpl, $oMenu, $menuGroupActivo);
				}else{
					
					$this->parseMenuGroupOptions( $xtpl, $oMenu, $menuGroupActivo, $menuOptions );
				}
			}

		}
	}
	
	/**
	 * se parsea una menú group específico.
	 *
	 */
	protected function parseMenuGroupOptions( XTemplate $xtpl, $oMenu, $menuGroupActivo, $menuOptions, $titulo=''){
		
		if( empty( $titulo ) ){
			$menuGroup = $oMenu->getMenuGroupPorId( $menuGroupActivo );
			$titulo = $menuGroup->getDs_nombre();
		}
		
		$opciones = $oMenu->getMenuOptionsPorId( explode(",", $menuOptions ));
		
		$this->parseOpciones($xtpl, $opciones, $titulo );
		
	}
	
	/**
	 * se parsea una menú group específico.
	 *
	 */
	protected function parseMenuGroup( XTemplate $xtpl, $oMenu, $menuGroupActivo, $titulo=''){
		
		$menuGroup = $oMenu->getMenuGroupPorId( $menuGroupActivo );
		
		if( !empty( $menuGroup) ){

			if( empty( $titulo))
				$titulo = $menuGroup->getNombre();
					
			//mostramos cada item del menugroup.
			$this->parseOpciones($xtpl, $menuGroup->getOpciones(), $titulo );
				
		}
	}

	
	function parseOpciones(XTemplate $xtpl, $opciones, $titulo='' ){
		
		//recuperamos el usuario de sessión para chequear los permisos sobre el menú.
		$oUsuario = new Usuario();
		$oUsuario->setCd_usuario( $_SESSION ["cd_usuarioSession"] );
		$oUsuario->setFunciones( $_SESSION ["funciones"] );
	
		
		foreach($opciones as $key => $opcion){

			//if( $opcion->tieneAcceso( $oUsuario->getFunciones() ) ){
				$xtpl->assign('li_class', $opcion->getCssclass());
				
				$descripcion = $opcion->getDescripcion_panel();
				
				if(empty($descripcion))
					$xtpl->assign('descripcion', $opcion->getNombre());
				else
					$xtpl->assign('descripcion', $opcion->getDescripcion_panel());
				$xtpl->assign('href', $opcion->getHref());				
				$xtpl->parse('main.group.item');
			//}
		}
		$xtpl->assign('ds_menugroup', $titulo);
		$xtpl->parse('main.group' );

	}	

	
	/**
	 * se parsea todo el menú.
	 *
	 */
	protected function parseMenu( XTemplate $xtpl, $oMenu ){
		
		foreach( $oMenu->getGrupos() as $menuGroup ){
		
			//mostramos cada item del menugroup.
			$this->parseOpciones($xtpl, $menuGroup->getOpciones(), $menuGroup->getNombre() );
		}			
			
			
	}

	
}