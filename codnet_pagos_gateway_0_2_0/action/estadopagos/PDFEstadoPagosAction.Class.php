<?php 

/**
 * Acción para exportar a pdf.
 * 
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
class PDFEstadoPagosAction extends ExportPDFCollectionAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/pdf/ExportPDFCollectionAction#getIListar()
	 */
	protected function getIListar(){
		return new EstadoPagoManager();
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/pdf/ExportPDFCollectionAction#getTableModel($items)
	 */
	protected function getTableModel(ItemCollection $items){
		return new EstadoPagoTableModel($items);
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/pdf/ExportPDFCollectionAction#getCampoOrdenDefault()
	 */
	protected function getCampoOrdenDefault(){
		return cd_estadopago;
	}


	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/pdf/ExportPDFCollectionAction#getOrientacion()
	 */
	protected function getOrientacion(){
		return "L";
	}

	
}
