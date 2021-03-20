<?php 

/**
 * Acción para inicializar el contexto para modificar
 * un AccionFuncion.
 *  
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class ModificarAccionFuncionInitAction extends EditarAccionFuncionInitAction{

	protected function getEntidad(){
		$oAccionFuncion = null;

		if (isset ( $_GET ['id'] )) {
			//recuperamos dado su identifidor.
			$id = FormatUtils::getParam('id');			
			
			$criterio = new CriterioBusqueda();
			$criterio->addFiltro('cd_accionfuncion', $id, '=');
			
			$manager = new AccionFuncionManager();
			$oAccionFuncion = $manager->getAccionFuncion( $criterio );
			
		}else{
		
			$oAccionFuncion = parent::getEntidad();
		
		}
		return $oAccionFuncion ;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureAction#getFuncion()
	 */
	public function getFuncion(){
		return CDT_SEGURIDAD_FUNCION_MODIFICAR_ACCIONFUNCION;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureOutputAction#getTitulo()
	 */
	protected function getTitulo(){
		return "Modificar AccionFuncion";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getAccionSubmit()
	 */
	protected function getAccionSubmit(){
		return "modificar_accionfuncion";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getMostrarCodigo()
	 */
	protected function getMostrarCodigo(){
		return true;
	}	
		
}
