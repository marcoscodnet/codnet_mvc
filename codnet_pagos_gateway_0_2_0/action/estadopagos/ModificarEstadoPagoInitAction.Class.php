<?php 

/**
 * Acción para inicializar el contexto para modificar
 * un estadoPago.
 *  
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
class ModificarEstadoPagoInitAction extends EditarEstadoPagoInitAction{

	protected function getEntidad(){
		$oEstadoPago = null;

		if (isset ( $_GET ['id'] )) {
			//recuperamos dado su identifidor.
			$id = FormatUtils::getParam('id');			
			
			$criterio = new CriterioBusqueda();
			$criterio->addFiltro('cd_estadopago', $id, '=');
			
			$manager = new EstadoPagoManager();
			$oEstadoPago = $manager->getEstadoPago( $criterio );
			
		}else{
		
			$oEstadoPago = parent::getEntidad();
		
		}
		return $oEstadoPago ;
	}

	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureOutputAction#getTitulo()
	 */
	protected function getTitulo(){
		return "Modificar EstadoPago";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getAccionSubmit()
	 */
	protected function getAccionSubmit(){
		return "modificar_estadopago";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getMostrarCodigo()
	 */
	protected function getMostrarCodigo(){
		return true;
	}	
		
}
