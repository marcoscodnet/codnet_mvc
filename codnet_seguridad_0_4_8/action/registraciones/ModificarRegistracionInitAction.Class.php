<?php 

/**
 * Acción para inicializar el contexto para modificar
 * un registracion.
 *  
 * @author modelBuilder
 * @since 13-07-2011
 * 
 */
class ModificarRegistracionInitAction extends EditarRegistracionInitAction{

	protected function getEntidad(){
		$oRegistracion = null;

		if (isset ( $_GET ['id'] )) {
			//recuperamos dado su identifidor.
			$id = FormatUtils::getParam('id');			
			
			$criterio = new CriterioBusqueda();
			$criterio->addFiltro('cd_registracion', $id, '=');
			
			$manager = new RegistracionManager();
			$oRegistracion = $manager->getRegistracion( $criterio );
			
		}else{
		
			$oRegistracion = parent::getEntidad();
		
		}
		return $oRegistracion ;
	}

	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureOutputAction#getTitulo()
	 */
	protected function getTitulo(){
		return "Modificar Registracion";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getAccionSubmit()
	 */
	protected function getAccionSubmit(){
		return "modificar_registracion";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getMostrarCodigo()
	 */
	protected function getMostrarCodigo(){
		return true;
	}	
		
}
