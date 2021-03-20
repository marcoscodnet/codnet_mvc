<?php

class FiltroReporteJasper {
	
	private $datasourceUri;
	private $reportUnit;
	private $ds_reporteUri;
	
	//M�todo constructor 
	

	function FiltroReporteJasper() {
		
		$this->datasourceUri = '';
		$this->reportUnit = array();
		$this->ds_reporteUri = '';
	}
	
	//M�todos Get 
	

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
	
	
	//M�todos Set 
	

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

