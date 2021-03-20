<?php 

/**
 * Acción para dar de alta un MenuOption.
 * 
 * @author modelBuilder
 * @since 05-07-2011
 * 
 */
class AltaMenuOptionAction extends EditarMenuOptionAction{


	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#editar($oEntidad)
	 */
	protected function editar($oEntidad){
		$manager = new MenuOptionManager();
		$manager->agregarMenuOption( $oEntidad );
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardSuccess()
	 */
	protected function getForwardSuccess(){
		return 'alta_menuoption_success';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardError()
	 */
	protected function getForwardError(){
		return 'alta_menuoption_error';
	}
		

	protected function getActionForwardFailure(){
		return 'alta_MenuOption_init';
	}
	
}
