<?php
/**
 * acción para los request del componente grilla
 * 
 * para cada grilla específica tenemos que crear una subclase
 * que define el entitymanager y el columnmodel.
 * 
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 15-12-2011
 *
 */
class CMPGridExportXlsAction extends CMPGridAction{

	public function execute(){

		$oGrid = $this->buildGrid();
		
		$oGrid->show();
		
		return null;
	}

	protected function getGridRenderer( $oGrid ){
		
		return new GridXlsRenderer();
		
	}
	
	
}
?>