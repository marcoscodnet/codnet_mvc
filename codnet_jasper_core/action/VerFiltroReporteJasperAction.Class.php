<?php 

/**
 * Acción para visualizar los filtros de un reporte.
 *  
 * @author bernardo
 * @since 28-03-2011
 * 
 */
class VerFiltroReporteJasperAction extends CdtOutputAction{


	protected function getXTemplate(){
		return new XTemplate( CDT_JASPER_TEMPLATE_VER_FILTRO_REPORTE );
	}
	
	/**
	 * @return forward.
	 */
	protected function getOutputContent(){
		$xtpl = $this->getXTemplate();
		
		$xtpl->assign ( 'titulo', $this->getOutputTitle() );
		
		$uri = "/";
		if ($_GET['id'] != '')
			$uri = $_GET['id'];
				
		$_GET['uri'] = $uri;
		$manager = new ReporteJasperManager();
		
		try{
			
			$oFiltroReporteJasper = $manager->getFiltroReporteJasperUri ( $uri );
			
			//mostramos el filtro del reporte.
			$this->parseFiltro( $xtpl, $oFiltroReporteJasper );
			
			//seteamos el datasource.
			$cd = CdtUtils::getParam('cd_datasource');
			$xtpl->assign ( 'cd_datasource', $cd );
			
			
		}catch(GenericException $ex){
			$oFiltroReporteJasper = new FiltroReporteJasper();
			//TODO ver si se muestra un mensaje de error.
			$xtpl->assign ( 'titulo', $ex->getMessage() );
		}			

		
		
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
		//return "algo tiene que mostrar";
	}

	
	protected function getOutputTitle(){
		return "Filtros del Reporte";
	}
	
	protected function parseFiltro( XTemplate $xtpl, FiltroReporteJasper $oFiltroReporteJasper ){
		
		$reportUnit = $oFiltroReporteJasper->getReportUnit();
		$resources = $oFiltroReporteJasper->getResources();
		$dsUri = $oFiltroReporteJasper->getDatasourceUri();
		$uri = $oFiltroReporteJasper->getDs_reporteUri();
		
		
		$xtpl->assign ( 'REPORT_URI', $uri );

		
		$label = htmlentities( utf8_decode($reportUnit['label']) );
		$xtpl->assign ( 'REPORT_LABEL', $label );
		
		$description = htmlentities( utf8_decode($reportUnit['description']) );
		$xtpl->assign ( 'REPORT_DESCRIPTION', $description );
		
		// Show all input controls
		$parametersCount=0;
		for ($i=0; $i< count($resources); ++$i){
			$rd = $resources[$i];

			if ($rd['type'] == TYPE_INPUT_CONTROL ){
				$parametersCount++;
			
			
				$paramLabel = htmlentities( utf8_decode($rd['label']) );
				$paramName = utf8_decode( "PARAM_".$rd['name'] );
				
				$xtpl->assign ( 'PARAM_LABEL', $paramLabel );
				$xtpl->assign ( 'PARAM_NAME', $paramName );
				
				$controlType = $rd['properties'][PROP_INPUTCONTROL_TYPE]['value'];
	
				$is_date = false;
				$is_date_time = false;
				$rd_resources = $rd['resources'];
				for ($i2=0; $i2< count($rd_resources); ++$i2){
					$r = $rd_resources[$i2];
					if( $r['type'] == TYPE_DATA_TYPE ){
						$dataType =  $r['properties'][PROP_DATATYPE_TYPE]['value'];
						if( $dataType == DT_TYPE_DATE){
							$is_date = true;	
						}				
						else if( $dataType == DT_TYPE_DATE_TIME){
							$is_date_time = true;	
						}				
					}	
				}
			
				
				if ($controlType == IC_TYPE_BOOLEAN){
					$xtpl->parse('main.param.param_boolean');
				}
				else if ($controlType == IC_TYPE_SINGLE_VALUE && !$is_date){
					$xtpl->parse('main.param.param_single');
				}
			
				else if ($controlType == IC_TYPE_SINGLE_VALUE && $is_date){
					$xtpl->parse('main.param.param_date');
				}
	
				else if ($controlType == IC_TYPE_SINGLE_VALUE && $is_date_time){
					$xtpl->parse('main.param.param_datetime');
				}
				
				else if ($controlType == IC_TYPE_SINGLE_SELECT_LIST_OF_VALUES)
				{
					$listOfValues = array();
					foreach ($rd['resources'] AS $lov){
						if ($lov['type'] == TYPE_LOV){
							$listOfValues = $lov;
							break;
						}
					}
	
					//  LOV->properties { [PROP_LOV]->properties { [0]{name,value}, [1]{name,value}... } }
					//  name = key
					//  value = label
	
					foreach ($listOfValues['properties'][PROP_LOV]['properties'] AS $lovItem){
						
						$name = htmlspecialchars( utf8_decode( $lovItem['name']) );
						$value = htmlentities( utf8_decode( $lovItem['value']) ) ;
						
						$xtpl->assign ( 'LOV_LABEL', $name );
						$xtpl->assign ( 'LOV_VALUE', $value );
						
						$xtpl->parse('main.param.param_lov.option');
						
					}
				
					$xtpl->parse('main.param.param_lov');                
				}
				
				else if ($controlType == IC_TYPE_SINGLE_SELECT_QUERY){
			
				
					// Get the list of entries....
	
					$result = ws_get($rd['uri'],
					array( IC_GET_QUERY_DATA => $dsUri ) );
		
					$rds = getResourceDescriptors($result);
					$rd =$rds[0];
		
					$datarows = $rd['properties'][PROP_QUERY_DATA]['properties'];
		
					foreach ($datarows AS $datarow){
						$row_value = $datarow['value'];
						$row_label = "";
						$k = 0;
						foreach ($datarow['properties'] AS $datacolumn){
							if ($k > 0) $row_label .= "   |   ";
							$row_label .= $datacolumn['value'];
							$k++;
						}
						$value = htmlspecialchars( utf8_decode($row_value) );
						$label = htmlspecialchars( utf8_decode($row_label) );

						$xtpl->assign ( 'LOV_LABEL', $label );
						$xtpl->assign ( 'LOV_VALUE', $value );
						
						$xtpl->parse('main.param.param_query_lov.option');

					}
					$xtpl->parse('main.param.param_query_lov');
				}
				
	
				$paramDescription = htmlentities( $rd['description'] );	
				$xtpl->assign ( 'PARAM_DESCRIPTION', $paramDescription );
				
				$xtpl->parse ( 'main.param');		
	
				
			}//es un parámetro.
			
		}//show inputs control
		
		
	}//FIN
	
}