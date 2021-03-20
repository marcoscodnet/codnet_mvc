<?php

/**
 * Representa el layout básico para exportar a Excel:
 * 
 * @author bernardo
 * @since 03-06-2010
 */
class LayoutExcel extends LayoutHeaderContentFooter{
	
	//nombre del archivo excel.
	private $nombreArchivo;
	
	public function setNombreArchivo($value){
		$this->nombreArchivo = $value;
	}
	public function getNombreArchivo(){
		return $this->nombreArchivo;
	}
	
	
	protected function getHeader(){
		return "";
	}
	
	protected function getFooter(){
		return "";
	}
	
	protected function parseMetaTags($xtpl){
	}
	
	protected function parseEstilos($xtpl){
	}
	
	protected function parseScripts($xtpl){
	}

	public function show(){
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-type:application/vnd.ms-excel;charset:ISO-8859-1;");
		header("Content-Disposition: attachment; filename=". $this->getNombreArchivo() .".xls");
				
		
		return parent::show();
	}

	public function setMenu( $value ){}
	public function showLayout(){
		return $this->show();
	}
}
