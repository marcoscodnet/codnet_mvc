<?php

/**
 * AcciÃ³n listar accionFunciones.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class ListarAccionFuncionesAction extends ListarAction {

    protected function getListarTableModel(ItemCollection $items) {
        return new AccionFuncionTableModel($items);
    }

    protected function getOpciones() {
        $opciones[] = $this->buildOpcion('altaAccionFuncion', 'Agregar AccionFuncion', 'alta_accionfuncion_init');
        return $opciones;
    }

    protected function getFiltros() {
        $filtros[] = $this->buildFiltro('ds_accion', 'Acción');
        return $filtros;
    }
    
    
    protected function parseAcciones(XTemplate $xtpl, $item) {

        $this->parseAccionesDefault($xtpl, $item, $item->getCd_accionfuncion(), 'accionfuncion', 'accionfuncion', true, true, true);
    }

    public function getFuncion() {
        return CDT_SEGURIDAD_FUNCION_LISTAR_ACCIONFUNCION;
    }

    protected function getEntidadManager() {
        return new AccionFuncionManager();
    }

    protected function getCampoOrdenDefault() {
        return 'cd_accionfuncion';
    }

    protected function getTitulo() {
        return 'Administraci&oacute;n de AccionFunciones';
    }

    protected function getUrlAccionListar() {
        return 'listar_accionfunciones';
    }

    protected function getForwardError() {
        return 'listar_accionfunciones_error';
    }

    protected function getMenuActivo() {
        return "AccionFunciones";
    }

    protected function getCartelEliminar($entidad) {
		$xtpl = new XTemplate(CDT_SEGURIDAD_TEMPLATE_BAJA_ACCIONFUNCION);
        $xtpl->assign('cd_accionfuncion', $entidad->getCd_accionfuncion());
        $xtpl->parse('main');
        $text = addslashes($xtpl->text('main'));
        return FormatUtils::quitarEnters($text);
    }

}
