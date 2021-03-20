<?php 

/**
 * Acción para inicializar el contexto para editar
 * un pago.
 * 
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
abstract class EditarPagoInitAction  extends EditarInitAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getXTemplate()
	 */
	protected function getXTemplate(){
		return new XTemplate ( CDT_PAGOS_GATEWAY_TEMPLATE_EDITAR_PAGO );		
	}

	
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
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#parseEntidad($entidad, $xtpl)
	 */
	protected function parseEntidad($entidad, XTemplate $xtpl){
		$oPago = FormatUtils::ifEmpty($entidad, new Pago());

				
		$xtpl->assign ( 'cd_pago', stripslashes ( $oPago->getCd_pago () ) );
		$xtpl->assign ( 'cd_pago_label', CDT_PAGOS_GATEWAY_PAGO_CD_PAGO );
				
		$xtpl->assign ( 'dt_fecha', stripslashes ( $oPago->getDt_fecha () ) );
		$xtpl->assign ( 'dt_fecha_label', CDT_PAGOS_GATEWAY_PAGO_DT_FECHA );
				
		$xtpl->assign ( 'dt_fechacambioestado', stripslashes ( $oPago->getDt_fechacambioestado () ) );
		$xtpl->assign ( 'dt_fechacambioestado_label', CDT_PAGOS_GATEWAY_PAGO_DT_FECHACAMBIOESTADO );
		
		$xtpl->assign ( 'ds_descripcion', stripslashes ( $oPago->getDs_descripcion() ) );
		$xtpl->assign ( 'ds_descripcion_label', CDT_PAGOS_GATEWAY_PAGO_DS_DESCRIPCION );
		
		
		$xtpl->assign ( 'cd_estadopago_label', CDT_PAGOS_GATEWAY_PAGO_CD_ESTADOPAGO );
		$selected =  $oPago->getCd_estadopago();
		$this->parseEstadoPago($selected, $xtpl );
		
		$xtpl->assign ( 'cd_usuario_label', CDT_PAGOS_GATEWAY_PAGO_CD_USUARIO );
		$selected =  $oPago->getCd_usuario();
		$this->parseUsuario($selected, $xtpl );
		
		

	}

	
	protected function parseEstadoPago($selected, XTemplate $xtpl ){
	
		$manager = new EstadoPagoManager();
		$criterio = new CriterioBusqueda();
		$estadopagos = $manager->getEstadoPagos( $criterio );
		
		foreach($estadopagos as $key => $oEstadoPago) {
		
			$xtpl->assign ( 'ds_estadoPago', $oEstadoPago->getCd_estadopago() );
			$xtpl->assign ( 'cd_estadoPago', FormatUtils::selected($oEstadoPago->getCd_estadopago(), $selected ) );
			
			$xtpl->parse ( 'main.estadopagos_option' );
		}	
	}
	
	
	protected function parseUsuario($selected, XTemplate $xtpl ){
	
		$manager = new UsuarioManager();
		$criterio = new CriterioBusqueda();
		$usuarios = $manager->getUsuarios( $criterio );
		
		foreach($usuarios as $key => $oUsuario) {
		
			$xtpl->assign ( 'ds_usuario', $oUsuario->getCd_usuario() );
			$xtpl->assign ( 'cd_usuario', FormatUtils::selected($oUsuario->getCd_usuario(), $selected ) );
			
			$xtpl->parse ( 'main.usuarios_option' );
		}	
	}
	

}
