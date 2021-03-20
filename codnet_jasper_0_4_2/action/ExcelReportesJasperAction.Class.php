<?php 

/**
 * Acción para exportar el listado de reporetes jasper a excel .
 * 
 * @author bernardo
 * @since 06-05-2011
 * 
 */
class ExcelReportesJasperAction extends ExportExcelCollectionAction{

	protected function getIListar(){
		return new ReporteJasperManager();
	}

	protected function getTableModel(ItemCollection $items){
		return new ReporteJasperTableModel($items);
	}

	protected function getCampoOrdenDefault(){
		return 'ds_nombre';
	}


	public function getTitulo(){
		return "Listado de Reportes Jasper";
	}

	public function getNombreArchivo(){
		return "reportes_jasper";
	}

	
}