<?php

/**
 * Acción para inicializar el contexto para
 * solicitar una nueva clave.
 *
 * @author bernardo
 * @since 12-09-2011
 *
 */
class SolicitarClaveWebInitAction extends OutputAction{

	/**
	 * @return forward.
	 */
	protected function getContenido(){
			
		$xtpl = $this->getXTemplate ();

		$xtpl->assign ( 'WEB_PATH', WEB_PATH );

		$msj= FormatUtils::getParam('msg','',true,false);
		if ( !empty($msj) ){
			$xtpl->assign('msj', $msj);
			$xtpl->parse ( 'main.msj' );
		}
		
		$xtpl->assign ( 'titulo', $this->getTitulo() );
		$xtpl->assign ( 'txt_solicitar_clave', CDT_SEGURIDAD_MSG_SOLICITAR_CLAVE );
		$xtpl->assign ( 'txt_email', CDT_SEGURIDAD_MSG_EMAIL);
		$xtpl->assign ( 'txt_ingrese_email', CDT_SEGURIDAD_MSG_INGRESE_EMAIL);
		$xtpl->assign ( 'btn_resetear_password', CDT_SEGURIDAD_MSG_BTN_RESETEAR_PASSWORD);
		$xtpl->assign ( 'txt_campos_obligatorios', CDT_SEGURIDAD_MSG_CAMPOS_OBLIGATORIOS);


		$xtpl->assign('solicitar_clave_action', CDT_SEGURIDAD_SOLICITAR_CLAVE_ACTION);
		
		
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
	}


	public function getXTemplate(){
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_SOLICITAR_CLAVE );
	}
	
	
	protected function getTitulo(){
		return CDT_SEGURIDAD_MSG_SOLICITAR_CLAVE_TITULO;
	}	

	protected function getLayout(){
		$oClass = new ReflectionClass( CDT_SEGURIDAD_SOLICITAR_CLAVE_LAYOUT );
		$oLayout = $oClass->newInstance();		
		return $oLayout;
	}	
	
}