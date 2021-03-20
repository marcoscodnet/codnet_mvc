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
		
		
		$oUsuario->setDs_nomusuario ( FormatUtils::getParamPOST('ds_nomusuario') ) ;
		
		$oUsuario->setDs_mail (  FormatUtils::getParamPOST('ds_mail') ) ;
		
		return $oUsuario;
	}
		
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#parseEntidad($entidad, $xtpl)
	 */
	protected function parseEntidad($entidad, XTemplate $xtpl){
		
		$oUsuario = FormatUtils::ifEmpty($entidad, new Usuario());

		
		$xtpl->assign ( 'lbl_nomusuario', CDT_SEGURIDAD_REGISTRACION_DS_NOMUSUARIO );
		
		
		$xtpl->assign ( 'ds_nomusuario', stripslashes ( $oUsuario->getDs_nomusuario() ) );
		
		
		$xtpl->assign ( 'lbl_mail', CDT_SEGURIDAD_REGISTRACION_DS_MAIL );
		$xtpl->assign ( 'ds_mail', stripslashes ( $oUsuario->getDs_mail () ) );

		$xtpl->assign ( 'cd_usuario', $oUsuario->getCd_usuario () );

		$xtpl->assign ( 'lbl_password', CDT_SEGURIDAD_REGISTRACION_DS_PASSWORD );
		
		
		$xtpl->assign ( 'lbl_codigoseguridad', CDT_SEGURIDAD_MSG_CODIGOSEGURIDAD );
		$xtpl->assign ( 'lbl_repeat_password', CDT_SEGURIDAD_MSG_REPEAT_PASSWORD );
		
		$xtpl->assign ( 'debe_leer_terminos', CDT_SEGURIDAD_MSG_LEER_TERMINOS );
		$xtpl->assign ( 'ingrese_nomusuario', CDT_SEGURIDAD_MSG_INGRESE_NOMUSUARIO );
		$xtpl->assign ( 'mail_invalido', CDT_SEGURIDAD_MSG_EMAIL_INVALIDO );
		$xtpl->assign ( 'ingrese_password', CDT_SEGURIDAD_MSG_INGRESE_PASSWORD );
		$xtpl->assign ( 'passwords_incorrectas', CDT_SEGURIDAD_MSG_PASSWORDS_INCORRECTAS );
		$xtpl->assign ( 'cambiar_imagen', CDT_SEGURIDAD_MSG_CAMBIAR_IMAGEN );
		$xtpl->assign ( 'txt_he_leido', CDT_SEGURIDAD_MSG_HE_LEIDO );
		$xtpl->assign ( 'btn_register_label', CDT_SEGURIDAD_LBL_BTN_REGISTER );
		$xtpl->assign ( 'campos_obligatorios', CDT_SEGURIDAD_MSG_CAMPOS_OBLIGATORIOS );
		
		$xtpl->assign ( 'txt_terminos_titulo', CDT_SEGURIDAD_MSG_TERMINOS_CONDICIONES_TITULO );
		$xtpl->assign ( 'txt_terminos_aceptar', CDT_SEGURIDAD_MSG_TERMINOS_CONDICIONES_ACEPTAR );
		
		$xtpl->assign ( 'sid_captcha', md5(time()) );
		
	}
	
	protected function getTitulo(){
		return CDT_SEGURIDAD_MSG_REGISTRAR_USUARIO_TITULO;
	}
	
	/**
	 * @return forward.
	 */
	protected function getContenido(){
			
		$oEntidad = $this->getEntidad();
		$xtpl = $this->getXTemplate();
		
		$xtpl->assign ( 'WEB_PATH', WEB_PATH );
		
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
		
		return $xtpl->text ( 'main' );		
		
	}
	

	protected function getLayout(){
		$oClass = new ReflectionClass( CDT_SEGURIDAD_REGISTRACION_LAYOUT );
		$oLayout = $oClass->newInstance();
		
		return $oLayout;
	}
	
	public function getXTemplate(){
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_REGISTRAR_USUARIO );		
	}
	
}