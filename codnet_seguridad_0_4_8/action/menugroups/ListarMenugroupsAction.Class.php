<?php

/**
 * Acción listar menugroups.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class ListarMenugroupsAction extends ListarAction {

    protected function getListarTableModel(ItemCollection $items) {
        return new MenuGroupTableModel($items);
    }

    protected function getOpciones() {
        $opciones[] = $this->buildOpcion('altaMenuGroup', 'Agregar MenuGroup', 'alta_menugroup_init');
        return $opciones;
    }

    protected function getFiltros() {
        //TODO $filtros[] = $this->buildFiltro('ds_pais', 'Pa&iacute;s');
        $filtros = array();
        return $filtros;
    }

    protected function parseAcciones(XTemplate $xtpl, $item) {

        $this->parseAccionesDefault($xtpl, $item, $item->getCd_menugroup(), 'menugroup', 'menugroup', true, true, true);
    }

    public function getFuncion() {
        return CDT_SEGURIDAD_FUNCION_LISTAR_MENUGROUP;
    }

    protected function getEntidadManager() {
        return new MenuGroupManager();
    }

    protected function getCampoOrdenDefault() {
        return 'cd_menugroup';
    }

    protected function getTitulo() {
        return 'Administraci&oacute;n de Menugroups';
    }

    protected function getUrlAccionListar() {
        return 'listar_menugroups';
    }

    protected function getForwardError() {
        return 'listar_menugroups_error';
    }

    protected function getMenuActivo() {
        return "Menugroups";
    }

    protected function getCartelEliminar($entidad) {
		$xtpl = new XTemplate(CDT_SEGURIDAD_TEMPLATE_BAJA_MENUGROUP);
        $xtpl->assign('cd_menugroup', $entidad->getCd_menugroup());
        $xtpl->parse('main');
        $text = addslashes($xtpl->text('main'));
        return FormatUtils::quitarEnters($text);
    }

}
