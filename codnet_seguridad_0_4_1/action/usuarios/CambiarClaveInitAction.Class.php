<?php 

/**
 * Acción para inicializar el contexto para cambiar la
 * clave del usuario logueado.
 * 
 * @author bernardo
 * @since 16-03-2010
 * 
 */
class CambiarClaveInitAction extends SecureOutputAction{

	/**
	 * inicializa el contexto para cambiar la clave
	 * del usuario.
	 * @return forward.
	 */
	protected function getContenido(){
			
		$xtpl = $this->getXTemplate ();
		
		if (isset ( $_GET ['er'] )) {
			$xtpl->assign ( 'classMsj', 'msjerror' );
			$xtpl->assign ( 'msj', 'Contraseña Actual incorrecta' );
			$xtpl->parse ( 'main.msj' );
		} else {
			$xtpl->assign ( 'classMsj', '' );
			$xtpl->assign ( 'msj', '' );
		}
		
		$xtpl->assign ( 'titulo', 'Cambiar clave' );
		$xtpl->assign ( 'WEB_PATH', WEB_PATH );
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
	}
	
	public function getFuncion(){
		return CDT_SEGURIDAD_FUNCION_CAMBIAR_CLAVE;
	}
	
	public function getTitulo(){
		return "Cambiar clave";
	}
	
	public function getXTemplate(){
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_CAMBIAR_CLAVE );
	}
}