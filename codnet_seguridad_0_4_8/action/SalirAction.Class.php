<?php 

/**
 * Acción para desloguearse del sistema.
 * 
 * @author bernardo
 * @since 16-03-2010
 * 
 */
class SalirAction extends Action{

	/**
	 * se desloguea el usuario logueado.
	 * @return forward.
	 */
	public function execute(){
		
		$oUsuario = new Usuario ( );
		if (unserialize ( $_SESSION ['usuario'] )) {
			$oUsuario = unserialize ( $_SESSION ['usuario'] );
		}

		$oUsuario->cerrarSesion ();
		
		$forward='salir_success';
		return $forward;
	}
	
}