<?php 

/**
 * Acción listar reportes desde Jasper.
 * 
 * @author bernardo
 * @since 28-03-2011
 * 
 */
class ListarReportesJasperAction extends ListarAction{

	protected function getListarTableModel( ItemCollection $items ){
		return new ReporteJasperTableModel($items);
	}
		
	/*
	protected function getOpciones(){
		//$opciones[]= $this->buildOpcion('altaperfil', 'Agregar Perfil', 'alta_perfil_init');
		//return $opciones;
		return array();
	}
	
	protected function getFiltros(){
		$filtros[]= $this->buildFiltro('ds_perfil', 'Perfil');
		return $filtros;
	}
	*/

	protected function parseAcciones(XTemplate $xtpl, $item){
		
		$cd_datasource = FormatUtils::getParam('cd_datasource');
		
		
		$href = "doAction?cd_datasource=$cd_datasource&action=ver_filtroReporteJasper&uri=" . $item->getDs_reporteUri();
		$this->parseAccion( $xtpl, '', $href, 'search.gif' , 'ver reporte ' . $item->getDs_nombre());
	}
	
	protected function getEntidadManager(){

		//seteamos el cd del datasource al manager. 
		$cd = FormatUtils::getParam('cd_datasource');
		$manager = new ReporteJasperManager();
		$manager->setCd_datasource( $cd );
		return $manager;
	}
	
	protected function getCampoOrdenDefault(){
		return 'ds_nombre';
	}
	
	protected function getTitulo(){
		return 'Reportes Jasper';
	}
	
	protected function getUrlAccionListar(){
		return 'listar_reportes_jasper';
	}

	
	protected function getUrlAccionExportarPdf(){
		return 'pdf_reportesJasper';
	}
	
	protected function getUrlAccionExportarExcel(){
		return 'excel_reportesJasper';
	}
	
	protected function getForwardError(){
		return 'listar_reportes_jasper_error';
	}

	protected function getMenuActivo(){
		return "Reportes Jasper";
	}
	
	
	protected function getCartelEliminar($entidad){
		return "";
	}
	
}