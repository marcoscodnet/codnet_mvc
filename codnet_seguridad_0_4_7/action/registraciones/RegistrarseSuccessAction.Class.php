<?php 

/**
 * Acción para mostrar que la registración fur realizada exitosamente.
 * 
 * @author bernardo
 * @since 13-07-2011
 * 
 */
class RegistrarseSuccessAction extends OutputAction{

	
	/*
	 * contenido a mostrar.
	 */
	protected function getContenido(){
		
		$xtpl = new XTemplate ( CDT_SEGURIDAD_TEMPLATE_REGISTRARSE_SUCCESS );
		
		$xtpl->assign ( 'WEB_PATH', WEB_PATH );
		$xtpl->assign ( 'titulo', $this->getTitulo() );
		$xtpl->assign ( 'mensaje', CDT_SEGURIDAD_MSG_REGISTRAR_USUARIO_SUCCESS );
		
		$xtpl->parse ( 'main' );
		
		return $xtpl->text ( 'main' );	
	}
	
		
	protected function getTitulo(){
		return CDT_SEGURIDAD_MSG_REGISTRAR_USUARIO_TITULO;
	}
	

	protected function getLayout(){
		$oClass = new ReflectionClass( CDT_SEGURIDAD_REGISTRACION_LAYOUT );
		$oLayout = $oClass->newInstance();
		
		return $oLayout;
	}

}