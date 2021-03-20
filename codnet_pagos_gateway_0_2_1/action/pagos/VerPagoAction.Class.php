<?php 

/**
 * Acción para visualizar un pago.
 *  
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
class VerPagoAction extends OutputAction{

	/**
	 * consulta un pago.
	 */
	protected function getContenido(){
			
		$xtpl = $this->getXTemplate ();
		
		if (isset ( $_GET ['id'] )) {
			$cd_pago = FormatUtils::getParam('id');
			
			
			try{
				$id = FormatUtils::getParam('id');			
			
				$criterio = new CriterioBusqueda();
				$criterio->addFiltro('cd_pago', $id, '=');
			
				$manager = new PagoManager();
				$oPago = $manager->getPago( $criterio );
				
			}catch(GenericException $ex){
				$oPago = new Pago();
				//TODO ver si se muestra un mensaje de error.
			}			

			//se muestra el pago.
			$this->parseEntidad( $xtpl, $oPago );
			
			
		}
		
		$xtpl->assign ( 'titulo', 'Detalle de Pago' );
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
	}

	protected function getTitulo(){
		return "Ver Pago";
	}

	public function getXTemplate(){ 
		return new XTemplate ( CDT_PAGOS_GATEWAY_TEMPLATE_VER_PAGO );
	}
	
	public function parseEntidad($xtpl, $oPago){ 

				
		$xtpl->assign ( 'cd_pago', stripslashes ( $oPago->getCd_pago () ) );
		$xtpl->assign ( 'cd_pago_label', CDT_PAGOS_GATEWAY_PAGO_CD_PAGO );
				
		$xtpl->assign ( 'dt_fecha', stripslashes ( FuncionesComunes::fechaHoraMysqlaPHP($oPago->getDt_fecha () ) ) );
		$xtpl->assign ( 'dt_fecha_label', CDT_PAGOS_GATEWAY_PAGO_DT_FECHA );
				
		$xtpl->assign ( 'dt_fechacambioestado', stripslashes ( FuncionesComunes::fechaHoraMysqlaPHP( $oPago->getDt_fechacambioestado () ) ) );
		$xtpl->assign ( 'dt_fechacambioestado_label', CDT_PAGOS_GATEWAY_PAGO_DT_FECHACAMBIOESTADO );
				
		$xtpl->assign ( 'cd_estadopago', stripslashes ( $oPago->getEstadopago()->getDs_estadopago() ) );
		$xtpl->assign ( 'cd_estadopago_label', CDT_PAGOS_GATEWAY_PAGO_CD_ESTADOPAGO );
				
		$xtpl->assign ( 'ds_descripcion', stripslashes ( $oPago->getDs_descripcion() ) );
		$xtpl->assign ( 'ds_descripcion_label', CDT_PAGOS_GATEWAY_PAGO_DS_DESCRIPCION );
				
		$xtpl->assign ( 'cd_usuario', stripslashes ( $oPago->getUsuario()->getDs_nomusuario() ) );
		$xtpl->assign ( 'cd_usuario_label', CDT_PAGOS_GATEWAY_PAGO_CD_USUARIO );
		
		
	}
}
