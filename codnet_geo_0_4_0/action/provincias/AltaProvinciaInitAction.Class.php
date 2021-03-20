<?php 

/**
 * Acci�n para inicializar el contexto para dar de alta
 * una localidad.
 * 
 * @author bernardo
 * @since 18-03-2010
 * 
 */
class AltaProvinciaInitAction extends EditarProvinciaInitAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureOutputAction#getTitulo()
	 */
	protected function getTitulo(){
		return "Alta Provincia";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getAccionSubmit()
	 */
	protected function getAccionSubmit(){
		return "alta_provincia";
	}
	
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getMostrarCodigo()
	 */
	protected function getMostrarCodigo(){
		return false;
	}
}