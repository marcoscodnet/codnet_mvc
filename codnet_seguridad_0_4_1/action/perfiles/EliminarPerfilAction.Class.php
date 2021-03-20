<?php 

/**
 * Acci�n para eliminar un perfil.
 * 
 * @author bernardo
 * @since 09-03-2010
 * 
 */
class EliminarPerfilAction extends Action{

	/**
	 * se elimina un perfil.
	 * @return boolean (true=exito).
	 */
	public function execute(){
		
		$cd_perfil =  FormatUtils::getParam('id');
		
		//se inicia una transacci�n.
		DbManager::begin_tran();
		
		try{
			$manager = new PerfilManager();			
			$manager->eliminarPerfil( $cd_perfil);
			$forward = 'eliminar_perfil_success';
			//commit de la transacci�n.
			DbManager::save();
			
		}catch(GenericException $ex){
			$forward = 'eliminar_perfil_error';
			$this->setDs_forward_params( 'er=1'.'&msg=' .$ex->getMessage() . '&code=' . $ex->getCode() );
			//rollback de la transacci�n.
			DbManager::undo();
		}
		
		return $forward;
	}

	
}