<?php 

/**
 * Acción para dar de alta un usuario.
 * 
 * @author bernardo
 * @since 14-03-2010
 * 
 */
class AltaUsuarioAction extends EditarUsuarioAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#editar($oEntidad)
	 */
	protected function editar($oEntidad){
		$manager = new UsuarioManager();
		$manager->agregarUsuario($oEntidad );			
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardSuccess()
	 */
	protected function getForwardSuccess(){
		return 'alta_usuario_success';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardError()
	 */
	protected function getForwardError(){
		return 'alta_usuario_error';
	}
		
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureAction#getFuncion()
	 */
	public function getFuncion(){
		return CDT_SEGURIDAD_FUNCION_ALTA_USUARIO;
	}
		
}