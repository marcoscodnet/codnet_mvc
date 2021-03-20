<?php 

/**
 * Acción para inicializar el contexto para modificar
 * un MenuGroup.
 *  
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class ModificarMenuGroupInitAction extends EditarMenuGroupInitAction{

	protected function getEntidad(){
		$oMenuGroup = null;

		if (isset ( $_GET ['id'] )) {
			//recuperamos dado su identifidor.
			$id = FormatUtils::getParam('id');			
			
			$criterio = new CriterioBusqueda();
			$criterio->addFiltro('cd_menugroup', $id, '=');
			
			$manager = new MenuGroupManager();
			$oMenuGroup = $manager->getMenuGroup( $criterio );
			
		}else{
		
			$oMenuGroup = parent::getEntidad();
		
		}
		return $oMenuGroup ;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureAction#getFuncion()
	 */
	public function getFuncion(){
		return CDT_SEGURIDAD_FUNCION_MODIFICAR_MENUGROUP;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureOutputAction#getTitulo()
	 */
	protected function getTitulo(){
		return "Modificar MenuGroup";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getAccionSubmit()
	 */
	protected function getAccionSubmit(){
		return "modificar_menugroup";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getMostrarCodigo()
	 */
	protected function getMostrarCodigo(){
		return true;
	}	
		
}
