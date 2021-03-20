<?php 

/**
 * Acción para exportar a excel.
 * 
 * @author modelBuilder
 * @since 05-07-2011
 * 
 */
class ExcelMenuoptionsAction extends ExportExcelCollectionAction{

	protected function getIListar(){
		return new MenuOptionManager();
	}

	protected function getTableModel(ItemCollection $items){
		return new MenuOptionTableModel($items);
	}

	protected function getCampoOrdenDefault(){
		return cd_menuoption;
	}


	public function getTitulo(){
		return "Listado de Menuoptions";
	}

	public function getNombreArchivo(){
		return "menuoptions";
	}

	
}
