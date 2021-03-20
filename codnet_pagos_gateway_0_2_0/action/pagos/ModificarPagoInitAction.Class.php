<?php 

/**
 * Acción para inicializar el contexto para modificar
 * un pago.
 *  
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
class ModificarPagoInitAction extends EditarPagoInitAction{

	protected function getEntidad(){
		$oPago = null;

		if (isset ( $_GET ['id'] )) {
			//recuperamos dado su identifidor.
			$id = FormatUtils::getParam('id');			
			
			$criterio = new CriterioBusqueda();
			$criterio->addFiltro('cd_pago', $id, '=');
			
			$manager = new PagoManager();
			$oPago = $manager->getPago( $criterio );
			
		}else{
		
			$oPago = parent::getEntidad();
		
		}
		return $oPago ;
	}

	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureOutputAction#getTitulo()
	 */
	protected function getTitulo(){
		return "Modificar Pago";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getAccionSubmit()
	 */
	protected function getAccionSubmit(){
		return "modificar_pago";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getMostrarCodigo()
	 */
	protected function getMostrarCodigo(){
		return true;
	}	
		
}
