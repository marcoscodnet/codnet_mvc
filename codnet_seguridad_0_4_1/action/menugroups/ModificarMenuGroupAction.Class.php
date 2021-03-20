<?php 

/**
 * Acción para modificar un MenuGroup.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class ModificarMenuGroupAction extends EditarMenuGroupAction{


	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#editar($oEntidad)
	 */
	protected function editar($oEntidad){
		$manager = new MenuGroupManager();
		$manager->modificarMenuGroup( $oEntidad );
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardSuccess()
	 */
	protected function getForwardSuccess(){
		return 'modificar_menugroup_success';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getForwardError()
	 */
	protected function getForwardError(){
		return 'modificar_menugroup_error';
	}
		
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureAction#getFuncion()
	 */
	public function getFuncion(){
		return CDT_SEGURIDAD_FUNCION_MODIFICAR_MENUGROUP;
	}

	public function getIdEntidad(){
		return FormatUtils::getParamPOST('id');
	}
	
	
	protected function getActionForwardFailure(){
		return 'modificar_menugroup_init';
	}
	
}
