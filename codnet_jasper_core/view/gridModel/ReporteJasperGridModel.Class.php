<?php 

/** 
 * GridModel para ReporteJasper
 *  
 * @author codnet archetype builder
 * @since 29-12-2011
 */ 
class ReporteJasperGridModel extends GridModel{

	
	public function ReporteJasperGridModel( ){

		parent::__construct();
		$this->initModel();
		
	}
	
	private function initModel(){
		
		$this->buildModel( "ds_nombre", CDT_JASPER_LBL_REPORTEJASPER_DS_NOMBRE,  100 );
		
		$this->buildModel( "ds_descripcion", CDT_JASPER_LBL_REPORTEJASPER_DS_DESCRIPCION,  150 );
		
	}
	
		
	/**
	 * (non-PHPdoc)
	 * @see GridModel::getTitle();
	 */
	function getTitle(){
		return CDT_JASPER_MSG_REPORTEJASPER_TITLE_LIST;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see GridModel::getEntityManager();
	 */
	public function getEntityManager(){
		return new ReporteJasperManager();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see GridModel::getRowActionsModel( $item );
	 */
	public function getRowActionsModel( $item ){
		
		$ds_action = 'ver_filtroReporteJasper'  ; //. $item->getDs_reporteUri();
		
		//$this->parseAccion( $xtpl, '', $href, 'search.gif' , 'ver reporte ' . $item->getDs_nombre());
		
		$action = $this->buildRowAction( $ds_action, $ds_action, CDT_CMP_GRID_MSG_VIEW . " " . CDT_JASPER_LBL_REPORTEJASPER, CDT_UI_IMG_SEARCH, "view" ) ;
		
		$actions = new ItemCollection();
		$actions->addItem( $action );
		
		return $actions;
		
		
	}

	public function getEntityId( $anObject ){
			
		return $anObject->getDs_reporteUri();
			
	}
}
?>
