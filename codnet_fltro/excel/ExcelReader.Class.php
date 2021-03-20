<?php
require_once( 'importar_excel.php' );

/**
 * Clase para leer un excel.
 *
 * @author marcos
 *
 */
class ExcelReader extends Spreadsheet_Excel_Reader {
	
	/**
	 * Constructor
	 *
	 * Some basic initialisation
	 */
	function ExcelReader($file='',$store_extended_info=true,$outputEncoding='') {
		parent::__construct($file,$store_extended_info,$outputEncoding);
	}
	
}
?>