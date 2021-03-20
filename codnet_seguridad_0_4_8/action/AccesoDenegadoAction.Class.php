<?php 

/**
 * Acción para redireccionar a la página de
 * acceso denegado.
 * 
 * @author bernardo
 * @since 16-03-2010
 * 
 */
class AccesoDenegadoAction extends OutputAction{

	/**
	 * @return forward.
	 */
	protected function getContenido(){
		
		$xtpl = $this->getXTemplate ();
		$xtpl->assign ( 'WEB_PATH', WEB_PATH );
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
	}
		
	public function getTitulo(){
		return '';
	}

	public function getXTemplate(){
		return new XTemplate ( CDT_SEGURIDAD_PATH . 'view/templates/accesodenegado.html' );		
	}
	
}