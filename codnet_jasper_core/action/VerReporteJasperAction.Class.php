<?php 

/**
 * Acci?n para ver un reporte jasper.
 * 
 * @author bernardo
 * @since 29-03-2011
 * 
 */
require_once( JASPER_CLIENT );
		
class VerReporteJasperAction extends CdtOutputAction{

	private $formato;
	/**
	 * layout a utilizar para la salida.
	 * @return Layout
	 */
	protected function getLayout(){
		
		$this->formato = $_GET['format'];
		//creamos el layout dependiento del formato en que debe verse el reporte.
			if ( $this->formato == RUN_OUTPUT_FORMAT_PDF){
				$oLayout = new CdtLayoutPdf();
				$oLayout->setFileName("reporte");
			}
			else if ( $this->formato == RUN_OUTPUT_FORMAT_HTML){
					
				$oLayout = parent::getLayout();
							
			}
			else if ( $this->formato == RUN_OUTPUT_FORMAT_XLS){
				$oLayout = new LayoutExcelJasper();
				$oLayout->setFileName("reporte");
			}
		
		return $oLayout;
	}
	
	/**
	 * @return forward.
	 */
	protected function getOutputContent(){
		
		$uri = "/";
		if ($_GET['uri'] != '')
			$uri = $_GET['uri'];
				
		//obtenemos el datasource.
		$cd_datasource = CdtUtils::getParam('cd_datasource');
			
		$manager = new ReporteJasperManager();
		
		try{
			
			$oReporteJasper = $manager->getReporteJasperUri ( $uri, $cd_datasource );
			
		}catch(GenericException $ex){
			$oReporteJasper = new ReporteJasper();
			
			$this->getLayoutInstance()->setException( $ex );
		}			
		
		return $oReporteJasper->getDs_contenido() ;
	}

	protected function getOutputTitle(){
		return "Reporte Jasper";
	}
	
}