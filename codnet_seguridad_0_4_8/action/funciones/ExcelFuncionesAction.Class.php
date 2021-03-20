<?php 

/**
 * Acción para exportar a excel.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class ExcelFuncionesAction extends ExportExcelCollectionAction{

	protected function getIListar(){
		return new FuncionManager();
	}

	protected function getTableModel(ItemCollection $items){
		return new FuncionTableModel($items);
	}

	protected function getCampoOrdenDefault(){
		return cd_funcion;
	}

	public function getFuncion(){
		return CDT_SEGURIDAD_FUNCION_LISTAR_FUNCION;
	}

	public function getTitulo(){
		return "Listado de Funciones";
	}

	public function getNombreArchivo(){
		return "funciones";
	}

	
}
