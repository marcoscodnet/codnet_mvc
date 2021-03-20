<?php

class FiltroReporteJasper {
	
	private $datasourceUri;
	private $reportUnit;
	private $ds_reporteUri;
	
	//Método constructor 
	

	function FiltroReporteJasper() {
		
		$this->datasourceUri = '';
		$this->reportUnit = array();
		$this->ds_reporteUri = '';
	}
	
	//Métodos Get 
	

	function getDatasourceUri() {
		return $this->datasourceUri;
	}
	
	function getReportUnit() {
		return $this->reportUnit;
	}
	
	function getResources() {
		return $this->reportUnit['resources'];
	}
	
	function getDs_reporteUri() {
		return $this->ds_reporteUri;
	}
	
	
	//Métodos Set 
	

	function setDatasourceUri($value) {
		$this->datasourceUri = $value;
	}
	
	function setReportUnit($value) {
		$this->reportUnit = $value;
	}
	
	function setDs_reporteUri($value) {
		$this->ds_reporteUri = $value;
	}	
}

