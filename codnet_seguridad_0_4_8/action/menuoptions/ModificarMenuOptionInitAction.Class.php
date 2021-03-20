<?php 

/**
 * Acción para inicializar el contexto para modificar
 * un MenuOption.
 *  
 * @author modelBuilder
 * @since 05-07-2011
 * 
 */
class ModificarMenuOptionInitAction extends EditarMenuOptionInitAction{

	protected function getEntidad(){
		$oMenuOption = null;

		if (isset ( $_GET ['id'] )) {
			//recuperamos dado su identifidor.
			$id = FormatUtils::getParam('id');			
			
			$criterio = new CriterioBusqueda();
			$criterio->addFiltro('cd_menuoption', $id, '=');
			
			$manager = new MenuOptionManager();
			$oMenuOption = $manager->getMenuOption( $criterio );
			
		}else{
		
			$oMenuOption = parent::getEntidad();
		
		}
		return $oMenuOption ;
	}

	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureOutputAction#getTitulo()
	 */
	protected function getTitulo(){
		return "Modificar MenuOption";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getAccionSubmit()
	 */
	protected function getAccionSubmit(){
		return "modificar_menuoption";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getMostrarCodigo()
	 */
	protected function getMostrarCodigo(){
		return true;
	}	
		
}
