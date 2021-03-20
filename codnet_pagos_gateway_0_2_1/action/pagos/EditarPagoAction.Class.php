<?php 

/**
 * Acción para editar un pago.
 * 
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
abstract class EditarPagoAction extends EditarAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getEntidad()
	 */
	protected function getEntidad(){
		
		//se construye el pago a modificar.
		$oPago = new Pago ( );
		
				
		$oPago->setCd_pago ( FormatUtils::getParamPOST('cd_pago') );	
				
		$oPago->setDt_fecha ( FormatUtils::getParamPOST('dt_fecha') );	
				
		$oPago->setDt_fechacambioestado ( FormatUtils::getParamPOST('dt_fechacambioestado') );	
				
		$oPago->setCd_estadopago ( FormatUtils::getParamPOST('cd_estadopago') );	
				
		$oPago->setDs_descripcion ( FormatUtils::getParamPOST('ds_descripcion') );	
				
		$oPago->setCd_usuario ( FormatUtils::getParamPOST('cd_usuario') );	
		
					
		return $oPago;
	}
	
		
}
