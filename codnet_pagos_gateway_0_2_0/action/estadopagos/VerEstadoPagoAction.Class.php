<?php 

/**
 * Acción para visualizar un estadoPago.
 *  
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
class VerEstadoPagoAction extends OutputAction{

	/**
	 * consulta un estadoPago.
	 */
	protected function getContenido(){
			
		$xtpl = $this->getXTemplate ();
		
		if (isset ( $_GET ['id'] )) {
			$cd_estadoPago = FormatUtils::getParam('id');
			
			
			try{
				$id = FormatUtils::getParam('id');			
			
				$criterio = new CriterioBusqueda();
				$criterio->addFiltro('cd_estadopago', $id, '=');
			
				$manager = new EstadoPagoManager();
				$oEstadoPago = $manager->getEstadoPago( $criterio );
				
			}catch(GenericException $ex){
				$oEstadoPago = new EstadoPago();
				//TODO ver si se muestra un mensaje de error.
			}			

			//se muestra el estadoPago.
			$this->parseEntidad( $xtpl, $oEstadoPago );
			
			
		}
		
		$xtpl->assign ( 'titulo', 'Detalle de EstadoPago' );
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
	}

	protected function getTitulo(){
		return "Ver EstadoPago";
	}

	public function getXTemplate(){ 
		return new XTemplate ( CDT_PAGOS_GATEWAY_TEMPLATE_VER_ESTADOPAGO );
	}
	
	public function parseEntidad($xtpl, $oEstadoPago){ 

				
		$xtpl->assign ( 'cd_estadopago', stripslashes ( $oEstadoPago->getCd_estadopago () ) );
		$xtpl->assign ( 'cd_estadopago_label', CDT_PAGOS_GATEWAY_ESTADOPAGO_CD_ESTADOPAGO );
				
		$xtpl->assign ( 'ds_estadopago', stripslashes ( $oEstadoPago->getDs_estadopago () ) );
		$xtpl->assign ( 'ds_estadopago_label', CDT_PAGOS_GATEWAY_ESTADOPAGO_DS_ESTADOPAGO );
		
		
	}
}
