<?php 

/**
 * Acción para exportar a excel.
 * 
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
class ExcelPagosAction extends ExportExcelCollectionAction{

	protected function getIListar(){
		return new PagoManager();
	}

	protected function getTableModel(ItemCollection $items){
		return new PagoTableModel($items);
	}

	protected function getCampoOrdenDefault(){
		return cd_pago;
	}


	public function getTitulo(){
		return "Listado de Pagos";
	}

	public function getNombreArchivo(){
		return "pagos";
	}

	
}
