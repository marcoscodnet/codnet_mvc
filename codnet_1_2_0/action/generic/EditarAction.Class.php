<?php

/**
 * Acciï¿½n para para editar una entidad.
 *
 * @author bernardo
 * @since 21-04-2010
 *
 */
abstract class EditarAction extends Action{

	/**
	 * entidad a editar.
	 * @return unknown_type
	 */
	protected abstract function getEntidad();

	/**
	 * se edita la entidad.
	 * @param $oEntidad
	 * @return unknown_type
	 */
	protected abstract function editar($oEntidad);

	/**
	 * forward para el success de la ediciï¿½n.
	 * @return unknown_type
	 */
	protected abstract function getForwardSuccess();

	/**
	 * forward para cuando hay error.
	 * @return unknown_type
	 */
	protected abstract function getForwardError();


	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureOutputAction#executeImpl()
	 */
	public function execute(){

		//se inicia una transacción.
		DbManager::begin_tran();
		
		try{
			$oEntidad = $this->getEntidad();
			$this->editar( $oEntidad );
			$forward = $this->getForwardSuccess();
			//commit de la transacción.
			DbManager::save();
		}catch(GenericException $ex){
			//rollback de la transacción.
			DbManager::undo();
			$forward = $this->doForwardException( $ex, $this->getForwardError() );
		}

		return $forward;
	}

	public function getIdEntidad(){
		return FormatUtils::getParam('id');
	}
	
	

}