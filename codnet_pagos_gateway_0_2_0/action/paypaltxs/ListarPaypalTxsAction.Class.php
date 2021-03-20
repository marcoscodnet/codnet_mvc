<?php

/**
 * Acción listar paypalTxs.
 * 
 * @author modelBuilder
 * @since 15-08-2011
 * 
 */
class ListarPaypalTxsAction extends ListarAction {

    protected function getListarTableModel(ItemCollection $items) {
        return new PaypalTxTableModel($items);
    }

    protected function getOpciones() {
        //$opciones[] = $this->buildOpcion('altapaypalTx', 'Agregar PaypalTx', 'alta_paypaltx_init');
        //return $opciones;
        return array();
    }

    protected function getFiltros() {
        
        $filtros = array();
        		
		$filtros[] = $this->buildFiltro('cd_paypal_tx', CDT_PAGOS_GATEWAY_PAYPAL_TX_CD_PAYPAL_TX);
				
		$filtros[] = $this->buildFiltro('ds_txn_id', CDT_PAGOS_GATEWAY_PAYPAL_TX_DS_TXN_ID);
				
		$filtros[] = $this->buildFiltro('cd_pago', CDT_PAGOS_GATEWAY_PAYPAL_TX_CD_PAGO);
				
		$filtros[] = $this->buildFiltro('ds_paypal_tx', CDT_PAGOS_GATEWAY_PAYPAL_TX_DS_PAYPAL_TX);
				
		$filtros[] = $this->buildFiltro('dt_fecha', CDT_PAGOS_GATEWAY_PAYPAL_TX_DT_FECHA);
				
		$filtros[] = $this->buildFiltro('ds_type', CDT_PAGOS_GATEWAY_PAYPAL_TX_DS_TYPE);
		
        return $filtros;
    }

    protected function parseAcciones(XTemplate $xtpl, $item) {

        $this->parseAccionesDefault($xtpl, $item, $item->getCd_paypal_tx(), 'paypaltx', 'paypaltx', true, false, false);
    }


    protected function getEntidadManager() {
        return new PaypalTxManager();
    }

    protected function getCampoOrdenDefault() {
        return 'cd_paypal_tx';
    }

    protected function getTitulo() {
        return 'Administraci&oacute;n de PaypalTxs';
    }

    protected function getUrlAccionListar() {
        return 'listar_paypaltxs';
    }

    protected function getForwardError() {
        return 'listar_paypaltxs_error';
    }

    protected function getMenuActivo() {
        return "PaypalTxs";
    }

    protected function getCartelEliminar($entidad) {
		$xtpl = new XTemplate(CDT_PAGOS_GATEWAY_TEMPLATE_BAJA_PAYPALTX);
        $xtpl->assign('cd_paypal_tx', $entidad->getCd_paypal_tx());
        $xtpl->parse('main');
        $text = addslashes($xtpl->text('main'));
        return FormatUtils::quitarEnters($text);
    }

}
