<?php

/**
 * Acción listar menuoptions.
 * 
 * @author modelBuilder
 * @since 05-07-2011
 * 
 */
class ListarMenuoptionsAction extends ListarAction {

    protected function getListarTableModel(ItemCollection $items) {
        return new MenuOptionTableModel($items);
    }

    protected function getOpciones() {
        $opciones[] = $this->buildOpcion('altaMenuOption', 'Agregar MenuOption', 'alta_menuoption_init');
        return $opciones;
    }

    protected function getFiltros() {
        $filtros[] = $this->buildFiltro('nombre', 'Nombre');
        return $filtros;
    }

    protected function parseAcciones(XTemplate $xtpl, $item) {

        $this->parseAccionesDefault($xtpl, $item, $item->getCd_menuoption(), 'menuoption', 'menuoption', true, true, true);
    }


    protected function getEntidadManager() {
        return new MenuOptionManager();
    }

    protected function getCampoOrdenDefault() {
        return 'cd_menuoption';
    }

    protected function getTitulo() {
        return 'Administraci&oacute;n de Menuoptions';
    }

    protected function getUrlAccionListar() {
        return 'listar_menuoptions';
    }

    protected function getForwardError() {
        return 'listar_menuoptions_error';
    }

    protected function getMenuActivo() {
        return "Menuoptions";
    }

    protected function getCartelEliminar($entidad) {
		$xtpl = new XTemplate(CDT_SEGURIDAD_TEMPLATE_BAJA_MENUOPTION);
        $xtpl->assign('cd_menuoption', $entidad->getCd_menuoption());
        $xtpl->parse('main');
        $text = addslashes($xtpl->text('main'));
        return FormatUtils::quitarEnters($text);
    }

}
