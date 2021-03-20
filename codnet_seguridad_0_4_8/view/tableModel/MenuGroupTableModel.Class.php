<?php 

/** 
 * Autogenerated class 
 *  
 *  @author modelBuilder 
 *  @since 04-07-2011 
 */ 
class MenuGroupTableModel extends ListarTableModel{

	private $columnNames = array();

	private $columnWidths = array();
	
	public function MenuGroupTableModel(ItemCollection $items){
		$this->items = $items;
		$this->initColumns();
	}
	
	private function initColumns(){
		
		$this->columnNames[] = CDT_SEGURIDAD_MENUGROUP_CD_MENUGROUP;
		$this->columnWidths[] = 80;
		
		$this->columnNames[] = CDT_SEGURIDAD_MENUGROUP_ORDEN;
		$this->columnWidths[] = 80;
		
		$this->columnNames[] = CDT_SEGURIDAD_MENUGROUP_WIDTH;
		$this->columnWidths[] = 80;
		
		$this->columnNames[] = CDT_SEGURIDAD_MENUGROUP_NOMBRE;
		$this->columnWidths[] = 80;
		
		$this->columnNames[] = CDT_SEGURIDAD_MENUGROUP_ACTION;
		$this->columnWidths[] = 80;
		
		$this->columnNames[] = CDT_SEGURIDAD_MENUGROUP_CSSCLASS;
		$this->columnWidths[] = 80;
		
	}
	
		
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/view/tableModel/TableModel#getTitle()
	 */
	function getTitle(){
		return "Menugroups";
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
		$oMenuGroup = $anObject;
		$value=0;
		switch ($columnIndex) {
			
			case 0: $value= $oMenuGroup->getCd_menugroup(); break;
			
			case 1: $value= $oMenuGroup->getOrden(); break;
			
			case 2: $value= $oMenuGroup->getWidth(); break;
			
			case 3: $value= $oMenuGroup->getNombre(); break;
			
			case 4: $value= $oMenuGroup->getAction(); break;
			
			case 5: $value= $oMenuGroup->getCssclass(); break;
			
			default: $value='';	break;
		}
		return $value;
	}
	
	public function getEncabezados(){
	 	
	 	$encabezados[]= $this->buildTh($this->getColumnName(0), 'cd_menugroup', 'cd_menugroup');
	 	
	 	$encabezados[]= $this->buildTh($this->getColumnName(1), 'orden', 'orden');
	 	
	 	$encabezados[]= $this->buildTh($this->getColumnName(2), 'width', 'width');
	 	
	 	$encabezados[]= $this->buildTh($this->getColumnName(3), 'nombre', 'nombre');
	 	
	 	$encabezados[]= $this->buildTh($this->getColumnName(4), 'action', 'action');
	 	
	 	$encabezados[]= $this->buildTh($this->getColumnName(5), 'cssclass', 'cssclass');
	 	
	 	return $encabezados;	
	}
	
}
?>