<?php 

/**
 * Acción para exportar a excel.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class ExcelMenugroupsAction extends ExportExcelCollectionAction{

	protected function getIListar(){
		return new MenuGroupManager();
	}

	protected function getTableModel(ItemCollection $items){
		return new MenuGroupTableModel($items);
	}

	protected function getCampoOrdenDefault(){
		return cd_menugroup;
	}

	public function getFuncion(){
		return CDT_SEGURIDAD_FUNCION_LISTAR_MENUGROUP;
	}

	public function getTitulo(){
		return "Listado de Menugroups";
	}

	public function getNombreArchivo(){
		return "menugroups";
	}

	
}
