<?php

class ReporteJasper {
	
	private $ds_descripcion;
	private $ds_nombre;
	private $ds_reporteUri;
	
	private $ds_contenido;
	private $ds_formato;
	
	//Método constructor 
	

	function ReporteJasper() {
		
		$this->ds_descripcion = '';
		$this->ds_nombre = '';
		$this->ds_reporteUri = '';
		$this->ds_contenido = '';
		$this->ds_formato = '';
	}
	
	//Métodos Get 
	

	function getDs_descripcion() {
		return $this->ds_descripcion;
	}
	
	function getDs_nombre() {
		return $this->ds_nombre;
	}
	
	function getDs_reporteUri() {
		return $this->ds_reporteUri;
	}
	
	function getDs_contenido() {
		return $this->ds_contenido;
	}
	
	function getDs_formato() {
		return $this->ds_formato;
	}
	
	//Métodos Set 
	

	function setDs_descripcion($value) {
		$this->ds_descripcion = $value;
	}
	
	function setDs_nombre($value) {
		$this->ds_nombre = $value;
	}
	
	function setDs_reporteUri($value) {
		$this->ds_reporteUri = $value;
	}
	
	function setDs_contenido($value) {
		$this->ds_contenido = $value;
	}

	function setDs_formato($value) {
		$this->ds_formato = $value;
	}	
}

