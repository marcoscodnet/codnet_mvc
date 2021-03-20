<?php 

/** 
 * Autogenerated class 
 *  
 *  @author modelBuilder 
 *  @since 20-07-2011 
 */ 
class EstadoPagoTableModel extends ListarTableModel{

	private $columnNames = array();

	private $columnWidths = array();
	
	public function EstadoPagoTableModel(ItemCollection $items){
		$this->items = $items;
		$this->initColumns();
	}
	
	private function initColumns(){
		
		$this->columnNames[] = CDT_PAGOS_GATEWAY_ESTADOPAGO_CD_ESTADOPAGO;
		$this->columnWidths[] = 80;
		
		$this->columnNames[] = CDT_PAGOS_GATEWAY_ESTADOPAGO_DS_ESTADOPAGO;
		$this->columnWidths[] = 80;
		
	}
	
		
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/view/tableModel/TableModel#getTitle()
	 */
	function getTitle(){
		return "EstadoPagos";
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/view/tableModel/TableModel#getColumnCount()
	 */
	function getColumnCount(){
		return count($this->columnNames);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/view/tableModel/TableModel#getColumnName($columnIndex)
	 */
	function getColumnName($columnIndex){
		return $this->columnNames[$columnIndex];
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/view/tableModel/TableModel#getColumnWidth($columnIndex)
	 */
	function getColumnWidth($columnIndex){
		return $this->columnWidths[$columnIndex];
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/view/tableModel/TableModel#getRowCount()
	 */
	function getRowCount(){
		$this->items->size();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/view/tableModel/TableModel#getValueAt($rowIndex, $columnIndex)
	 */
	function getValueAt($rowIndex, $columnIndex){
		$oObject = $this->items->getObjectByIndex($rowIndex);
		return $this->getValue($oObject, $columnIndex);
	}

	public function getValue($anObject, $columnIndex){
		$oEstadoPago = $anObject;
		$value=0;
		switch ($columnIndex) {
			
			case 0: $value= $oEstadoPago->getCd_estadopago(); break;
			
			case 1: $value= $oEstadoPago->getDs_estadopago(); break;
			
			default: $value='';	break;
		}
		return $value;
	}
	
	public function getEncabezados(){
	 	
	 	$encabezados[]= $this->buildTh($this->getColumnName(0), 'cd_estadopago', 'cd_estadopago');
	 	
	 	$encabezados[]= $this->buildTh($this->getColumnName(1), 'ds_estadopago', 'ds_estadopago');
	 	
	 	return $encabezados;	
	}
	
}
?>
