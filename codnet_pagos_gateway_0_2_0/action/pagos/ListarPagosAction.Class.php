<?php

/**
 * Acción listar pagos.
 * 
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
class ListarPagosAction extends ListarAction {

    protected function getListarTableModel(ItemCollection $items) {
        return new PagoTableModel($items);
    }

    protected function getOpciones() {
        //$opciones[] = $this->buildOpcion('altapago', 'Agregar Pago', 'alta_pago_init');
        //return $opciones;
        return array();
    }

    protected function getFiltros() {
        
        $filtros = array();
        		
		$filtros[] = $this->buildFiltro('cd_pago', CDT_PAGOS_GATEWAY_PAGO_CD_PAGO);
				
		//$filtros[] = $this->buildFiltro('dt_fecha', CDT_PAGOS_GATEWAY_PAGO_DT_FECHA);
				
		//$filtros[] = $this->buildFiltro('dt_fechacambioestado', CDT_PAGOS_GATEWAY_PAGO_DT_FECHACAMBIOESTADO);
				
		//$filtros[] = $this->buildFiltro('cd_estadopago', CDT_PAGOS_GATEWAY_PAGO_CD_ESTADOPAGO);
				
		//$filtros[] = $this->buildFiltro('ds_calendario', CDT_PAGOS_GATEWAY_PAGO_CD_CALENDARIO);
				
		$filtros[] = $this->buildFiltro('ds_nomusuario', CDT_PAGOS_GATEWAY_PAGO_CD_USUARIO);
		
        return $filtros;
    }

    protected function parseAcciones(XTemplate $xtpl, $item) {

        $this->parseAccionesDefault($xtpl, $item, $item->getCd_pago(), 'pago', 'pago', true, false, false);
    }


    protected function getEntidadManager() {
        return new PagoManager();
    }

    protected function getCampoOrdenDefault() {
        return 'cd_pago';
    }

    protected function getTitulo() {
        return 'Administraci&oacute;n de Pagos';
    }

    protected function getUrlAccionListar() {
        return 'listar_pagos';
    }

    protected function getForwardError() {
        return 'listar_pagos_error';
    }

    protected function getMenuActivo() {
        return "Pagos";
    }

    protected function getCartelEliminar($entidad) {
		$xtpl = new XTemplate(CDT_PAGOS_GATEWAY_TEMPLATE_BAJA_PAGO);
        $xtpl->assign('cd_pago', $entidad->getCd_pago());
        $xtpl->parse('main');
        $text = addslashes($xtpl->text('main'));
        return FormatUtils::quitarEnters($text);
    }

}
