<?php 

/**
 * Acción listar reportes desde Jasper.
 * 
 * @author bernardo
 * @since 28-03-2011
 * 
 */
class ListarReportesJasperAction extends CMPGridAction {

	protected function getGridModel( CMPGrid $oGrid ){
		
		return new  ReporteJasperGridModel();
	}

}