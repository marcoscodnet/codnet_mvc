<?php 

/**
 * Acción para mostrar que la nueva clave solicitada fue enviada exitosamente.
 * 
 * @author bernardo
 * @since 12-09-2011
 * 
 */
class SolicitarClaveSuccessWebAction extends OutputAction{

	
	/*
	 * contenido a mostrar.
	 */
	protected function getContenido(){
		
		$xtpl = new XTemplate ( CDT_SEGURIDAD_TEMPLATE_SOLICITAR_CLAVE_SUCCESS );
		
		$xtpl->assign ( 'WEB_PATH', WEB_PATH );
		$xtpl->assign ( 'titulo', $this->getTitulo() );
		
		$xtpl->assign ( 'mensaje', CDT_SEGURIDAD_MSG_NUEVA_PASSWORD_ENVIADA );
		
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