<?php

/**
 * Acción listar estadoPagos.
 * 
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
class ListarEstadoPagosAction extends ListarAction {

    protected function getListarTableModel(ItemCollection $items) {
        return new EstadoPagoTableModel($items);
    }

    protected function getOpciones() {
        $opciones[] = $this->buildOpcion('altaestadoPago', 'Agregar EstadoPago', 'alta_estadopago_init');
        return $opciones;
    }

    protected function getFiltros() {
        
        $filtros = array();
        		
		$filtros[] = $this->buildFiltro('cd_estadopago', CDT_PAGOS_GATEWAY_ESTADOPAGO_CD_ESTADOPAGO);
				
		$filtros[] = $this->buildFiltro('ds_estadopago', CDT_PAGOS_GATEWAY_ESTADOPAGO_DS_ESTADOPAGO);
		
        return $filtros;
    }

    protected function parseAcciones(XTemplate $xtpl, $item) {

        $this->parseAccionesDefault($xtpl, $item, $item->getCd_estadopago(), 'estadopago', 'estadopago', true, true, true);
    }


    protected function getEntidadManager() {
        return new EstadoPagoManager();
    }

    protected function getCampoOrdenDefault() {
        return 'cd_estadopago';
    }

    protected function getTitulo() {
        return 'Administraci&oacute;n de EstadoPagos';
    }

    protected function getUrlAccionListar() {
        return 'listar_estadopagos';
    }

    protected function getForwardError() {
        return 'listar_estadopagos_error';
    }

    protected function getMenuActivo() {
        return "EstadoPagos";
    }

    protected function getCartelEliminar($entidad) {
		$xtpl = new XTemplate(CDT_PAGOS_GATEWAY_TEMPLATE_BAJA_ESTADOPAGO);
        $xtpl->assign('cd_estadopago', $entidad->getCd_estadopago());
        $xtpl->parse('main');
        $text = addslashes($xtpl->text('main'));
        return FormatUtils::quitarEnters($text);
    }

}
