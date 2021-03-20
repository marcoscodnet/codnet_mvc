<?php 

/**
 * Acción para iniciarlizar el registro en el sistema.
  * 
 * @author bernardo
 * @since 16-03-2010
 * 
 */
class RegistrarseInitAction extends OutputAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getEntidad()
	 */
	protected function getEntidad(){
		$oUsuario = new Usuario ( );
		
		
		if (isset ( $_POST ['apynom'] ))
			$oUsuario->setDs_apynom ( FormatUtils::getParamPOST('apynom') ) ;
		
		if (isset ( $_POST ['mail'] )){//el nombre de usuario será el email.
			$oUsuario->setDs_mail (  FormatUtils::getParamPOST('mail') ) ;
			$oUsuario->setDs_nomusuario (  FormatUtils::getParamPOST('mail') ) ;
		}
		if (isset ( $_POST ['pais'] ))
			$oUsuario->setCd_pais ( FormatUtils::getParamPOST('pais') ) ;

		if (isset ( $_POST ['telefono'] ))
			$oUsuario->setDs_telefono (  FormatUtils::getParamPOST('telefono') ) ;
		
		if (isset ( $_POST ['domicilio'] ))
			$oUsuario->setDs_domicilio(  FormatUtils::getParamPOST('domicilio') ) ;
			
		return $oUsuario;
	}
		
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#parseEntidad($entidad, $xtpl)
	 */
	protected function parseEntidad($entidad, XTemplate $xtpl){
		
		$oUsuario = FormatUtils::ifEmpty($entidad, new Usuario());
		
		$xtpl->assign ( 'ds_apynom', stripslashes ( $oUsuario->getDs_apynom () ) );
		$xtpl->assign ( 'ds_mail', stripslashes ( $oUsuario->getDs_mail () ) );
		$xtpl->assign ( 'ds_nomusuario', stripslashes ( $oUsuario->getDs_nomusuario () ) );
		$xtpl->assign ( 'cd_usuario', $oUsuario->getCd_usuario () );
		$xtpl->assign ( 'ds_telefono', stripslashes ( $oUsuario->getDs_telefono () ) );
		$xtpl->assign ( 'ds_domicilio', stripslashes ( $oUsuario->getDs_domicilio () ) );
		$xtpl->assign ( 'sid_captcha', md5(time()) );
		
		$paisManager = new PaisManager();
		$paises = $paisManager->getPaises( new CriterioBusqueda() );
		
		foreach($paises as $key => $pais) {
			$xtpl->assign ( 'ds_pais', $pais->getDs_pais() );
			$xtpl->assign ( 'cd_pais', FormatUtils::selected($pais->getCd_pais(), $oUsuario->getCd_pais()) );
			
			$xtpl->parse ( 'main.option_pais' );
		}
		
		//TODO sacar a una subclase dentro de ugc
		$oGaleria = new GaleriaEntradasComponent();
		$galeria_contenido = $oGaleria->show();
		$xtpl->assign( 'galeria_entradas', $galeria_contenido );
	}
	
	protected function getTitulo(){
		return "Registraci&oacute;n";
	}
	
	/**
	 * se inicializa el contexto para login en el sistema.
	 * @return forward.
	 */
	protected function getContenido(){
			
		//se conecta a la base de datos.
		DbManager::connect();
		
		$oEntidad = $this->getEntidad();
		$xtpl = $this->getXTemplate();
		
		$xtpl->assign ( 'WEB_PATH', WEB_PATH );
		$xtpl->assign ( 'pais', UGCUtils::getPais() );
		
		$xtpl->assign ( 'tab_class',  UGC_CLASS_TAB_REG );
		$this->parseEntidad( $oEntidad , $xtpl);
		
		//se chequean los errores.
		$msj='';
		if (isset ( $_GET ['code'] )){
			$msj = FormatUtils::getParam('msg','',true,false);
			$xtpl->assign ( 'classMsj', 'msjerror' );
			$xtpl->assign ( 'msj', $msj );
			$xtpl->parse ( 'main.msj' );
		}
		
		$xtpl->assign ( 'registrarse_titulo', CDT_SEGURIDAD_REGISTRARSE_TITULO );
		$xtpl->assign ( 'registrarse_subtitulo', CDT_SEGURIDAD_REGISTRARSE_SUBTITULO );
		
		$xtpl->assign ( 'titulo', $this->getTitulo() );
		
		$xtpl->parse ( 'main' );
		
		//se cierra la conexión.
		DbManager::close();
			
		return $xtpl->text ( 'main' );		
		
	}
	

	protected function getLayout(){
		$oClass = new ReflectionClass(DEFAULT_LAYOUT_WEB);
		$oLayout = $oClass->newInstance();
		
		return $oLayout;
	}
	
	public function getXTemplate(){
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_REGISTRAR_USUARIO );		
	}
	
}