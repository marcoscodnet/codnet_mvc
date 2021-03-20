<?php 

/**
 * Acción para exportar a excel.
 * 
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
class ExcelEstadoPagosAction extends ExportExcelCollectionAction{

	protected function getIListar(){
		return new EstadoPagoManager();
	}

	protected function getTableModel(ItemCollection $items){
		return new EstadoPagoTableModel($items);
	}

	protected function getCampoOrdenDefault(){
		return cd_estadopago;
	}


	public function getTitulo(){
		return "Listado de EstadoPagos";
	}

	public function getNombreArchivo(){
		return "estadopagos";
	}

	
}
