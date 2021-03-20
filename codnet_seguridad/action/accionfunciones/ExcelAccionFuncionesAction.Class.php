<?php 

/**
 * Acción para exportar a excel.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class ExcelAccionFuncionesAction extends ExportExcelCollectionAction{

	protected function getIListar(){
		return new AccionFuncionManager();
	}

	protected function getTableModel(ItemCollection $items){
		return new AccionFuncionTableModel($items);
	}

	protected function getCampoOrdenDefault(){
		return cd_accionfuncion;
	}

	public function getFuncion(){
		return CDT_SEGURIDAD_FUNCION_LISTAR_ACCIONFUNCION;
	}

	public function getTitulo(){
		return "Listado de AccionFunciones";
	}

	public function getNombreArchivo(){
		return "accionfunciones";
	}

	
}
