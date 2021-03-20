<?php 

/**
 * Acción para exportar a excel.
 * 
 * @author modelBuilder
 * @since 13-07-2011
 * 
 */
class ExcelRegistracionesAction extends ExportExcelCollectionAction{

	protected function getIListar(){
		return new RegistracionManager();
	}

	protected function getTableModel(ItemCollection $items){
		return new RegistracionTableModel($items);
	}

	protected function getCampoOrdenDefault(){
		return cd_registracion;
	}


	public function getTitulo(){
		return "Listado de Registraciones";
	}

	public function getNombreArchivo(){
		return "registraciones";
	}

	
}
