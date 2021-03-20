<?php 

/**
 * 
 * @author bernardo
 * @since 28-03-2011
 * 
 * Manager para ReporteJasper.
 *
 */
class ReporteJasperManager implements IListar{

	private $cantidad=0;
	
	private $cd_datasource=1;
	
	
	public function setCd_datasource($value){
		$this->cd_datasource = $value;
	}
	
	/**
	 * se listan los reportes.
	 * @param $criterio
	 * @return unknown_type
	 */
	public function getReportesJasper(CriterioBusqueda $criterio=null){
		$criterio = FormatUtils::ifEmpty( $criterio, new CriterioBusqueda());				
		
		
		//seteamos la uri de los reportes.
		if(!empty($this->cd_datasource)){
			
			$uri = JasperDAO::getJasperUri( $this->cd_datasource );
		}
		
		/* llamar al web service */
		$reportes = ReporteJasperWS::getReportesJasper( $uri );

		
		$this->cantidad = $reportes->size();
		return $reportes;
	}
	
	public function getFiltroReporteJasperUri( $uri ){
	
		return ReporteJasperWS::getFiltroReporteJasperUri( $uri );
				
	}

	public function getReporteJasperUri( $uri, $cd_datasource="" ){
	
		return ReporteJasperWS::getReporteJasperUri( $uri, $cd_datasource );
				
	}
	
	//INTERFACE IListar.
	
	function getEntidades ( CriterioBusqueda $criterio ){
		return  $this->getReportesJasper( $criterio );
	}
	
	function getCantidadEntidades (  CriterioBusqueda $criterio ){
		return $this->cantidad ;
	}
}