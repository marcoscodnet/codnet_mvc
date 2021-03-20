<?php 

/**
 * Acción que visualiza los términos y condiciones para
 * la registración de usuarios.
  * 
 * @author bernardo
 * @since 12-09-2011
 * 
 */
class TerminosCondicionesAction extends OutputAction{

		
	protected function getTitulo(){
		return CDT_SEGURIDAD_MSG_TERMINOS_CONDICIONES_TITULO;
	}
	
	/**
	 * @return forward.
	 */
	protected function getContenido(){
			
		$xtpl = $this->getXTemplate();
		
		$xtpl->assign ( 'WEB_PATH', WEB_PATH );
		
		$xtpl->assign ( 'titulo', $this->getTitulo() );
		
		$xtpl->parse ( 'main' );
		
		return $xtpl->text ( 'main' );		
		
	}
	

	protected function getLayout(){
		$oClass = new ReflectionClass( CDT_SEGURIDAD_TERMINOS_CONDICIONES_LAYOUT );
		$oLayout = $oClass->newInstance();
		
		return $oLayout;
	}
	
	public function getXTemplate(){
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_TERMINOS_CONDICIONES );		
	}
	
}