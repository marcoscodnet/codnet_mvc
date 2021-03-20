<?php
/**
 * 
 * @author bernardo
 * @since 28-03-2011
 * 
 * Table model para reportes jasper.
 * 
 */

class ReporteJasperTableModel extends ListarTableModel{

	private $columnNames = array('Nombre', 'Descripción');

	private $columnWidths = array(110, 165);

	public function ReporteJasperTableModel(ItemCollection $items){
		$this->items = $items;
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/view/tableModel/TableModel#getTitle()
	 */
	function getTitle(){
		return "Reportes Jasper";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/view/tableModel/TableModel#getColumnCount()
	 */
	function getColumnCount(){
		return 2;
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
		$oReporteJasper = $this->items->getObjectByIndex($rowIndex);
		return $this->getValue($oReporteJasper, $columnIndex);
	}

	public function getValue($anObject, $columnIndex){
		$oReporteJasper = $anObject;
		$value=0;
		switch ($columnIndex) {
			case 0: $value= htmlentities( $oReporteJasper->getDs_nombre() ); break;
			case 1: $value= htmlentities( $oReporteJasper->getDs_descripcion() ); break;
			default: $value='';	break;
		}
		return $value;
	}

	public function getEncabezados(){
		$encabezados[]= $this->buildTh($this->getColumnName(0), 'ds_nombre', 'Nombre del reporte');
		$encabezados[]= $this->buildTh($this->getColumnName(1), 'ds_descripcion', 'Descripción');
		return $encabezados;
	}

}
?>