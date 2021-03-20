<?php 

/**
 * Acción para inicializar el contexto para modificar
 * un funcion.
 *  
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class ModificarFuncionInitAction extends EditarFuncionInitAction{

	protected function getEntidad(){
		$oFuncion = null;

		if (isset ( $_GET ['id'] )) {
			//recuperamos dado su identifidor.
			$id = FormatUtils::getParam('id');			
			
			$criterio = new CriterioBusqueda();
			$criterio->addFiltro('cd_funcion', $id, '=');
			
			$manager = new FuncionManager();
			$oFuncion = $manager->getFuncion( $criterio );
			
		}else{
		
			$oFuncion = parent::getEntidad();
		
		}
		return $oFuncion ;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureAction#getFuncion()
	 */
	public function getFuncion(){
		return CDT_SEGURIDAD_FUNCION_MODIFICAR_FUNCION;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureOutputAction#getTitulo()
	 */
	protected function getTitulo(){
		return "Modificar Funcion";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getAccionSubmit()
	 */
	protected function getAccionSubmit(){
		return "modificar_funcion";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getMostrarCodigo()
	 */
	protected function getMostrarCodigo(){
		return true;
	}	
		
}
