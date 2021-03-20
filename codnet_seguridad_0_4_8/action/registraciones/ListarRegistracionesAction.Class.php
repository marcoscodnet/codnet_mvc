<?php

/**
 * Acción listar registraciones.
 * 
 * @author modelBuilder
 * @since 13-07-2011
 * 
 */
class ListarRegistracionesAction extends ListarAction {

    protected function getListarTableModel(ItemCollection $items) {
        return new RegistracionTableModel($items);
    }

    protected function getOpciones() {
        //$opciones[] = $this->buildOpcion('altaregistracion', 'Agregar Registracion', 'alta_registracion_init');
        //return $opciones;
        return array();
    }

    protected function getFiltros() {
        
        $filtros = array();
        		
		$filtros[] = $this->buildFiltro('cd_registracion', CDT_SEGURIDAD_REGISTRACION_CD_REGISTRACION);
				
		$filtros[] = $this->buildFiltro('ds_codigoactivacion', CDT_SEGURIDAD_REGISTRACION_DS_CODIGOACTIVACION);
				
		$filtros[] = $this->buildFiltro('dt_fecha', CDT_SEGURIDAD_REGISTRACION_DT_FECHA);
				
		$filtros[] = $this->buildFiltro('ds_nomusuario', CDT_SEGURIDAD_REGISTRACION_DS_NOMUSUARIO);
				
		$filtros[] = $this->buildFiltro('ds_apynom', CDT_SEGURIDAD_REGISTRACION_DS_APYNOM);
				
		$filtros[] = $this->buildFiltro('ds_mail', CDT_SEGURIDAD_REGISTRACION_DS_MAIL);
				
		$filtros[] = $this->buildFiltro('ds_password', CDT_SEGURIDAD_REGISTRACION_DS_PASSWORD);
				
		$filtros[] = $this->buildFiltro('cd_pais', CDT_SEGURIDAD_REGISTRACION_CD_PAIS);
				
		$filtros[] = $this->buildFiltro('ds_telefono', CDT_SEGURIDAD_REGISTRACION_DS_TELEFONO);
				
		$filtros[] = $this->buildFiltro('ds_domicilio', CDT_SEGURIDAD_REGISTRACION_DS_DOMICILIO);
		
        return $filtros;
    }

    protected function parseAcciones(XTemplate $xtpl, $item) {

        $this->parseAccionesDefault($xtpl, $item, $item->getCd_registracion(), 'registracion', 'registracion', true, false, false);
    }


    protected function getEntidadManager() {
        return new RegistracionManager();
    }

    protected function getCampoOrdenDefault() {
        return 'cd_registracion';
    }

    protected function getTitulo() {
        return 'Administraci&oacute;n de Registraciones';
    }

    protected function getUrlAccionListar() {
        return 'listar_registraciones';
    }

    protected function getForwardError() {
        return 'listar_registraciones_error';
    }

    protected function getMenuActivo() {
        return "Registraciones";
    }

    protected function getCartelEliminar($entidad) {
		$xtpl = new XTemplate(CDT_SEGURIDAD_TEMPLATE_BAJA_REGISTRACION);
        $xtpl->assign('cd_registracion', $entidad->getCd_registracion());
        $xtpl->parse('main');
        $text = addslashes($xtpl->text('main'));
        return FormatUtils::quitarEnters($text);
    }

}
