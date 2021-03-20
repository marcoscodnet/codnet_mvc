<?php 

/**
 * Acción para exportar a excel.
 * 
 * @author modelBuilder
 * @since 15-08-2011
 * 
 */
class ExcelPaypalTxsAction extends ExportExcelCollectionAction{

	protected function getIListar(){
		return new PaypalTxManager();
	}

	protected function getTableModel(ItemCollection $items){
		return new PaypalTxTableModel($items);
	}

	protected function getCampoOrdenDefault(){
		return cd_paypal_tx;
	}


	public function getTitulo(){
		return "Listado de PaypalTxs";
	}

	public function getNombreArchivo(){
		return "paypaltxs";
	}

	
}
