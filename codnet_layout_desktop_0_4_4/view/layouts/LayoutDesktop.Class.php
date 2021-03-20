<?php

/**
 * Representa un layout tipo collabtive:
 * 	
 *
 * Este layout debe mostrar menúes, una superior (Solapas) y uno lateral.
 * 
 * vamos a agregar un archivo de configuración donde indicamos para cada acción:
 *  - las solapas a mostrar en el menú superior (menugroups)
 *  - la solapa que debe estar activa (menugroup)
 *  - las opciones a mostrar en el menú lateral (menuoptions)
 *	 
 * (usamos navigation.xml)
 * 
 * @author bernardo
 * @since 03-02-2011
 */
class LayoutDesktop extends Layout{

	
	//para segurizar los menúes.
	protected $oUsuario;
	
	public function show(){
		
		//buscamos si la acción ejecutada tiene una configuración especial
		//para los menúes.
		$menuGroupActivo = '';
		$menuGroups = '';
		$menuOptions = '';
		
		
		$navegacion = LoadNavigation::getInstance();
		$accionActual = FormatUtils::getCurrentAction();
		$accion = $navegacion->getAccionPorNombre( $accionActual );
		
		if( !empty( $accion ) ) {
			if( array_key_exists('menuGroupActivo',$accion) )
				$menuGroupActivo = $accion['menuGroupActivo'];
			
			if( array_key_exists('menuGroups',$accion) )
				$menuGroups = $accion['menuGroups'];
				
			if( array_key_exists('menuOptions',$accion) )
				$menuOptions = $accion['menuOptions'];
		}
		
		
		//seteamos el usuario para chequear permisos sobre los menúes.
		
		if( SeguridadUtils::isUsuarioLogueado())
			$this->oUsuario = SeguridadUtils::getUsuarioLogueado();
		else
			$this->oUsuario = new Usuario();
		
		/*
		$oUsuario->setCd_usuario( $_SESSION ["cd_usuarioSession"] );
		$oUsuario->setFunciones( $_SESSION ["funciones"] );
		$oUsuario->setDs_nomusuario( $_SESSION ["ds_usuario"] );
		$this->oUsuario = $oUsuario;
		*/
		
		$xtpl = $this->getXTemplate ( $menuGroupActivo, $menuOptions );
		
		$xtpl->assign('titulo', $this->getTitulo());
		$xtpl->assign('header', $this->getHeader());
		$xtpl->assign('user', $this->oUsuario->getDs_nomusuario() );
		$xtpl->assign('content', $this->getContenido());
		$xtpl->assign('footer', $this->getFooter());
		$this->parseMetaTags($xtpl);
		$this->parseEstilos($xtpl);
		$this->parseScripts($xtpl);

		$this->parseException($xtpl);
		
		//seteamos los menúes.
		if( !empty($menuGroupActivo) )
			$this->parseMenuSolapas($xtpl, $menuGroups, $menuGroupActivo);
			
		$this->parseMenuSuperiorDerecho($xtpl);
		$this->parseMenuLateral($xtpl, $menuOptions, $menuGroupActivo);
		
		$xtpl->parse('main');

		return $xtpl->text('main');
	}

	protected function getXTemplate( $menuGroupActivo='', $menuOptions ){
		
		//si no tiene menugroupactivo o se indicó que no hay opciones, entonces el template es sin menú lateral.
		if( empty($menuGroupActivo) || (!empty($menuOptions) &&  ($menuOptions=='false') ) )
			return new XTemplate (CDT_LAYOUT_DESKTOP_TEMPLATE_DEFAULT);
		else
			return new XTemplate (CDT_LAYOUT_DESKTOP_TEMPLATE_MENU);
	}
	
	
	/**
	 * parsea el menu lateral.
	 * @param unknown_type $xtpl
	 * @return unknown_type
	 */
	protected function parseMenuLateralAction($action, $xtpl){
	
		$action->parseMenuLateral($this, $xtpl);
	}
	
	/**
	 * parsea el menu lateral.
	 * @param unknown_type $xtpl
	 * @return unknown_type
	 */
	protected function parseMenuLateral($xtpl, $menuOptions, $menuGroupActivo){
		
		if( empty( $menuOptions )){
			$this->parseMenuLateralDeMenuGroupActivo( $xtpl, $menuGroupActivo );
		}else{

			//instanciamos el menú por reflection.
			$default_menu = DEFAULT_MENU;
			if( !empty($default_menu) ){
				$oClass = new ReflectionClass(DEFAULT_MENU);
				$oMenu = $oClass->newInstance();
	
				//obtenemos la lista de menuoptions (id's).
				$menuoptionsId = explode ( "," , $menuOptions );
				
				$menuoptions = $oMenu->getMenuOptionsPorId( $menuoptionsId );
				
				foreach($menuoptions as $key => $opcion){
							
					$this->parseMenuOption( $xtpl, $opcion );
					
				}
			}
		}
		
		
	}
	
	/**
	 * parsea el menu lateral.
	 * @param unknown_type $xtpl
	 * @return unknown_type
	 */
	protected function parseMenuLateralDeMenuGroupActivo($xtpl, $menuGroupActivo){
		//instanciamos el menú por reflection.
		$default_menu = DEFAULT_MENU;
		if( !empty($default_menu) ){
			$oClass = new ReflectionClass(DEFAULT_MENU);
			$oMenu = $oClass->newInstance();

			foreach($oMenu->getGrupos() as $key => $menuGroup) {

				//buscamos el menugroup.				
				if($menuGroupActivo==$menuGroup->getCd_menugroup()){
				
					//mostramos cada item del menugroup.
					
					foreach($menuGroup->getOpciones() as $key => $opcion){
						
						$this->parseMenuOption( $xtpl, $opcion );
							
					}
					
				}
				
			}
		}		
		
	}
	public function getAction(){
		return $this->oAction;
	}
	
	public function setAction($action){
		$this->oAction = $action;
	}
	
	protected function parseMenuSolapas($xtpl, $menuGroups, $menuGroupActivo){
		
		/* si menuGroups está vacío, se muestran todos los menúes */
		
		if( empty($menuGroups) ){
			$this->parseMenuSolapasTodas( $xtpl, $menuGroupActivo );
			
		}else{
			
			//obtenemos la lista de menugroups (id's).
			$menugroupsId = explode ( "," , $menuGroups );
			
			//instanciamos el menú por reflection.
			$default_menu = DEFAULT_MENU;
			if( !empty($default_menu) ){
				$oClass = new ReflectionClass(DEFAULT_MENU);
				$oMenu = $oClass->newInstance();

				foreach($menugroupsId as $key => $id) {
				
					$menuGroup = $oMenu->getMenuGroupPorId( $id );
						
					$css_class = $menuGroup->getDs_cssclass();
					if( !empty($css_class) ){
	
						$this->parseMenuGroup( $xtpl, $menuGroup, $menuGroupActivo );
							
					}
				}
			}
				
		}
		
	}

	protected function parseMenuGroup(XTemplate $xtpl, $menuGroup, $menuGroupActivo){
		
		//if( $menuGroup->tieneAcceso( $this->oUsuario->getFunciones() ) ){
			
			$xtpl->assign('css_li_class', $menuGroup->getCssclass() );
				
			if($menuGroupActivo==$menuGroup->getCd_menugroup())
				$xtpl->assign('css_a_class', "active");
			else
				$xtpl->assign('css_a_class', "");
			
			$xtpl->assign('href', 'doAction?action=' . $menuGroup->getAction());
			
			$xtpl->assign('action_description', $menuGroup->getNombre());				
			$xtpl->parse('main.menu_solapas');
		
		//}
		
	}

	protected function parseMenuOption(XTemplate $xtpl, $menuOption){
		
		//if( $menuOption->tieneAcceso( $this->oUsuario->getFunciones() ) ){
			
			$xtpl->assign('css_class', $menuOption->getCssclass());
			$xtpl->assign('action_description', $menuOption->getNombre());
			$xtpl->assign('href', $menuOption->getHref());				
			$xtpl->parse('main.menu_lateral');
		
		//}
		
	}
	
	
	protected function parseMenuSolapasTodas($xtpl, $menuGroupActivo){
		
		if( !empty($menuGroupActivo) ) {
		
			//instanciamos el menú por reflection.
			$default_menu = DEFAULT_MENU;
			if( !empty($default_menu) ){
				$oClass = new ReflectionClass(DEFAULT_MENU);
				$oMenu = $oClass->newInstance();
	
				foreach($oMenu->getGrupos() as $key => $menuGroup) {
	
					$css_class = $menuGroup->getCssclass();
					if( !empty($css_class) ){
	
						$this->parseMenuGroup( $xtpl, $menuGroup, $menuGroupActivo );
							
					}
				}
			}
		}
		
	}


	protected function parseException(XTemplate $xtpl){
		$exception = $this->getException();
		if( !empty($exception) ){
		
			$xtpl->assign('error_message', $exception->getMessage() );
			$xtpl->parse('main.error_message');
		}		
		
	}
	
	
	protected function getHeader(){
		$xtpl = new XTemplate (CDT_LAYOUT_DESKTOP_TEMPLATE_HEADER);
		$xtpl->assign('app_titulo', CDT_MVC_APP_TITULO);
		$xtpl->assign('app_subtitulo', CDT_MVC_APP_SUBTITULO);
		$xtpl->parse('main');
		return $xtpl->text('main');
	}
	
	protected function getFooter(){
		$xtpl = new XTemplate (CDT_LAYOUT_DESKTOP_TEMPLATE_FOOTER);
		$xtpl->parse('main');
		return $xtpl->text('main');
	}
	
	protected function parseMetaTags($xtpl){
		$xtpl->assign('http_equiv', 'X-UA-Compatible');
		$xtpl->assign('meta_content', 'IE=7');
		$xtpl->parse('main.meta_tag');
				
		$xtpl->assign('http_equiv', 'Content-Type');
		$xtpl->assign('meta_content', 'text/html; charset=ISO-8859-1');
		$xtpl->parse('main.meta_tag');
				
	}
	
	protected function parseEstilos($xtpl){
		
		$xtpl->assign('css', WEB_PATH ."css/desktop/calendar.css");
		$xtpl->parse('main.estilo');		
		
		$xtpl->assign('css', WEB_PATH ."css/desktop/style_form.css");
		$xtpl->parse('main.estilo');
		
		$xtpl->assign('css', WEB_PATH ."css/desktop/style_iefix.css");
		$xtpl->parse('main.estilo');		
		
		$xtpl->assign('css', WEB_PATH ."css/desktop/css_menu_panel.css");
		$xtpl->parse('main.estilo');		
		
		$xtpl->assign('css', WEB_PATH ."css/desktop/estilos.css");
		$xtpl->parse('main.estilo');
		
		$xtpl->assign('css', WEB_PATH ."css/desktop/screensmall.css");
		$xtpl->parse('main.estilo');		

        $xtpl->assign('css', WEB_PATH ."css/desktop/jquery-ui-1.7.2.custom.css");
		$xtpl->parse('main.estilo');
		
		$xtpl->assign('css', WEB_PATH ."css/desktop/jquery.alerts.css");
		$xtpl->parse('main.estilo');
		
		$xtpl->assign('css', WEB_PATH ."css/desktop/jquery.ui.core.css");
		$xtpl->parse('main.estilo');
		
		$xtpl->assign('css', WEB_PATH ."css/desktop/jVal.css");
		$xtpl->parse('main.estilo');
		
		
	}
	
	protected function parseScripts($xtpl){
		
		$xtpl->assign('js', WEB_PATH ."js/funciones.js");
		$xtpl->parse('main.script');

		$xtpl->assign('js', WEB_PATH ."js/jquery/jquery-1.3.2.min.js");
		$xtpl->parse('main.script');

        $xtpl->assign('js', WEB_PATH ."js/jquery/jquery-ui-1.7.2.custom.min.js");
		$xtpl->parse('main.script');
		
		
        $xtpl->assign('js', WEB_PATH ."js/jquery/jquery.feedback-1.2.0.js");
		$xtpl->parse('main.script');
		
		$xtpl->assign('js', WEB_PATH ."js/jquery/jquery.alerts.js");
		$xtpl->parse('main.script');
		
		$xtpl->assign('js', WEB_PATH ."js/jquery/jquery.ui.datepicker-es.js");
		$xtpl->parse('main.script');
		
		$xtpl->assign('js', WEB_PATH ."js/jquery/jVal.js");
		$xtpl->parse('main.script');
		
		$xtpl->assign('js', WEB_PATH . "js/jquery/jquery.form.js");
        $xtpl->parse('main.script');
        
		// script para chequear la cantidad de caracteres de un textarea
        $xtpl->assign('js', WEB_PATH ."js/jquery/jquery.jqEasyCharCounter.min.js");
		$xtpl->parse('main.script');
	}

	


	
	protected function parseMenuSuperiorDerecho($xtpl){
		
		$xtpl->assign('css_class', "desktop");
		$xtpl->assign('action', "inicio");
		$xtpl->assign('action_description', "Inicio");
		$xtpl->parse('main.menu_superior_derecha');
		
	}

	public function getMensajeErrorFormateado(){
		$exception = $this->getException();
		if( !empty( $exception) ){	
			$msg  = '<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">' ;
			$msg .= '	<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>';
			$msg .= $exception->getMessage();
			$msg .= '	</p>';
			$msg .= '</div>';
		}else $msg='';
		
		return $msg;		
	}		
	
}
