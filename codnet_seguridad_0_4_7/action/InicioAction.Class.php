<?php 

/**
 * Acción para redireccionar a la página de incio
 * del usuario logueado.
 * 
 * @author bernardo
 * @since 16-03-2010
 * 
 */
class InicioAction extends OutputAction{

	/**
	 * @return forward.
	 */
	protected function getContenido(){
		return "";
	}

	
	public function getTitulo(){
		return NOMBRE_APLICACION;
	}
}