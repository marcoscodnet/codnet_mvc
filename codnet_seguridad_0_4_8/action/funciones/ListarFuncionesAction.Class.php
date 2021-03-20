<?php

/**
 * Acción listar funciones.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class ListarFuncionesAction extends ListarAction {

    protected function getListarTableModel(ItemCollection $items) {
        return new FuncionTableModel($items);
    }

    protected function getOpciones() {
        $opciones[] = $this->buildOpcion('altafuncion', 'Agregar Funcion', 'alta_funcion_init');
        return $opciones;
    }

    protected function getFiltros() {
        $filtros[] = $this->buildFiltro('ds_funcion', 'Nombre');
        return $filtros;
    }
    

    protected function parseAcciones(XTemplate $xtpl, $item) {

        $this->parseAccionesDefault($xtpl, $item, $item->getCd_funcion(), 'funcion', 'funcion', true, true, true);
    }

    public function getFuncion() {
        return CDT_SEGURIDAD_FUNCION_LISTAR_FUNCION;
    }

    protected function getEntidadManager() {
        return new FuncionManager();
    }

    protected function getCampoOrdenDefault() {
        return 'cd_funcion';
    }

    protected function getTitulo() {
        return 'Administraci&oacute;n de Funciones';
    }

    protected function getUrlAccionListar() {
        return 'listar_funciones';
    }

    protected function getForwardError() {
        return 'listar_funciones_error';
    }

    protected function getMenuActivo() {
        return "Funciones";
    }

    protected function getCartelEliminar($entidad) {
		$xtpl = new XTemplate(CDT_SEGURIDAD_TEMPLATE_BAJA_FUNCION);
        $xtpl->assign('cd_funcion', $entidad->getCd_funcion());
        $xtpl->parse('main');
        $text = addslashes($xtpl->text('main'));
        return FormatUtils::quitarEnters($text);
    }

}
