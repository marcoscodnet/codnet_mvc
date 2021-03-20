<?php 

/**
 * Acción para eliminar un usuario.
 * 
 * @author bernardo
 * @since 04-03-2010
 * 
 */
class EliminarUsuarioAction extends Action{

	/**
	 * se elimina un usuario.
	 * @return boolean (true=exito).
	 */
	public function execute(){
		
		$cd_usuario = FormatUtils::getParam('id');
	
		//se inicia una transacción.
		DbManager::begin_tran();
		
		try{  					
			//se elimina el usuario.
			$manager = new UsuarioManager();
			$manager->eliminarUsuario( $cd_usuario );
			$forward = 'eliminar_usuario_success';
			//commit de la transacción.
			DbManager::save();
		}catch(GenericException $ex){
			$forward = 'eliminar_usuario_error';
			$this->setDs_forward_params( 'er=1'.'&msg=' .$ex->getMessage() . '&code=' . $ex->getCode());
			//rollback de la transacción.
			DbManager::undo();
		}

		return $forward;
	}

	
}