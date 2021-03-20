<?php 

/**
 * Acción para exportar a pdf.
 * 
 * @author modelBuilder
 * @since 15-08-2011
 * 
 */
class PDFPaypalTxsAction extends ExportPDFCollectionAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/pdf/ExportPDFCollectionAction#getIListar()
	 */
	protected function getIListar(){
		return new PaypalTxManager();
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/pdf/ExportPDFCollectionAction#getTableModel($items)
	 */
	protected function getTableModel(ItemCollection $items){
		return new PaypalTxTableModel($items);
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/pdf/ExportPDFCollectionAction#getCampoOrdenDefault()
	 */
	protected function getCampoOrdenDefault(){
		return cd_paypal_tx;
	}


	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/pdf/ExportPDFCollectionAction#getOrientacion()
	 */
	protected function getOrientacion(){
		return "L";
	}

	
}
