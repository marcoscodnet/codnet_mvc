<?php

/**
 * Representa el layout básico para exportar a Excel:
 * 
 * @author bernardo
 * @since 03-06-2010
 */
class LayoutExcelJasper extends Layout{
	
	//nombre del archivo excel.
	private $nombreArchivo;
	
	public function setNombreArchivo($value){
		$this->nombreArchivo = $value;
	}
	public function getNombreArchivo(){
		return $this->nombreArchivo;
	}

	public function show(){
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-type:application/vnd.ms-excel;charset:ISO-8859-1;");
		header("Content-Disposition: attachment; filename=". $this->getNombreArchivo() .".xls");
		header("Content-Transfer-Encoding: binary");
		
		return $this->getContenido();
	}

	public function setMenu( $value ){}
	public function showLayout(){
		return $this->show();
	}
}
