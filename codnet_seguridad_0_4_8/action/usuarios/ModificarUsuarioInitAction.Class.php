<?php 

/**
 * Acción para inicializar el contexto para modificar
 * un usuario.
 *  
 * @author bernardo
 * @since 14-03-2010
 * 
 */
class ModificarUsuarioInitAction extends EditarUsuarioInitAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getXTemplate()
	 */
	protected function getXTemplate(){
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_MODIFICAR_USUARIO );		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureAction#getFuncion()
	 */
	public function getFuncion(){
		return CDT_SEGURIDAD_FUNCION_MODIFICAR_USUARIO;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureOutputAction#getTitulo()
	 */
	protected function getTitulo(){
		return "Modificar Usuario";
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getAccionSubmit()
	 */
	protected function getAccionSubmit(){
		return "modificar_usuario";
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/bulfon/bulfon/action/almacenes/EditarAlmacenInitAction#getEntidad()
	 */
	protected function getEntidad(){
		$oUsuario = null;
		if (isset ( $_GET ['id'] )) {
			//recuperamos dado su identifidor.
			$cd_usuario = FormatUtils::getParam('id');
			
			$manager = new UsuarioManager();
			$oUsuario = $manager->getUsuarioPorId( $cd_usuario );
		}else{
		
			$oUsuario = parent::getEntidad();
		}
		
		return $oUsuario;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getMostrarCodigo()
	 */
	protected function getMostrarCodigo(){
		return true;
	}
	
}