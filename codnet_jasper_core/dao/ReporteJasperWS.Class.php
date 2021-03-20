<?php

/**
 *
 * @author bernardo
 * @since 28-03-2011
 *
 * Manager para ReporteJasper.
 *
 */
require_once( JASPER_CLIENT );

class ReporteJasperWS{

	/**
	 * se listan los reportes.
	 * @param $criterio
	 * @return unknown_type
	 */
	public static function getReportesJasper(){
		/* llamar al web service */
		$uri = JASPER_URI;
		$_SESSION["username"]=JASPER_USER;
		$_SESSION["password"]=JASPER_PWD;
	
		$pos = strrpos($uri, "/");
		if($pos === false || $pos == 0) {
			$parentUri="/";
		}else{
			$parentUri = substr($uri, 0, $pos );
		}
		
		//leemos los reportes con el webservice
		$result = ws_list($uri);
		if (get_class($result) == 'SOAP_Fault'){
			$errorMessage = $result->getFault()->faultstring;
			throw new GenericException( $errorMessage );
		}else{
			$folders = getResourceDescriptors($result);
		}

		$reportesArray = array();
		
		for ($i=0; $i < count($folders); ++$i){
			
			$resource = $folders[$i];
			//nos quedamos sólo con los reportes (TODO ver de navegar carpetas).
		    if ( $resource['type'] == 'reportUnit'){
		            	
		    	$link = WEB_PATH . "doAction?action=ver_filtroReporteJasper&uri=" . $resource['uri'];
		            	
			    $reportesArray[] = array ("REPORTE_URI" => $resource['uri'] , "REPORTE_NOMBRE" => utf8_decode( $resource['label'] ) , "REPORTE_DESCRIPCION" =>  utf8_decode($resource['description']));
		            
		    }
		}
		//ordenamos el listado.
		//$reportesArray = ReporteJasperWS::orderMultiDimensionalArray ($reportesArray, 'REPORTE_NOMBRE');

		$reportes = new ItemCollection();

		for ($i=0; $i < count($reportesArray); ++$i){
			
			$next = $reportesArray[$i];
			
			$oReporte = new ReporteJasper();
			$oReporte->setDs_descripcion( $next["REPORTE_DESCRIPCION"] );
			$oReporte->setDs_nombre( $next["REPORTE_NOMBRE"] );
			$oReporte->setDs_reporteUri($next["REPORTE_URI"] );
			$reportes->addItem( $oReporte );	
		}
		
		return $reportes;
	}

	public static function getFiltroReporteJasperUri( $uri ){
		$_SESSION["username"]=JASPER_USER;
		$_SESSION["password"]=JASPER_PWD;
		
		$result = ws_get($uri);
		if (get_class($result) == 'SOAP_Fault'){
			$errorMessage = $result->getFault()->faultstring;
			throw new GenericException( $errorMessage );
		}
		else{
			$folders = getResourceDescriptors($result);
		}

		if (count($folders) != 1 || $folders[0]['type'] != 'reportUnit'){
			$errorMessage =  "<H1>Invalid RU ($uri)</H1>";
			$errorMessage .=  "<pre>$result</pre>";
			throw new GenericException( $errorMessage );
		}

		$reportUnit = $folders[0];

		$parametersCount = 0;
		$resources = $reportUnit['resources'];
		// Find the datasource uri...
		$dsUri = '';
		for ($i=0; $i< count($resources); ++$i){
			$rd = $resources[$i];

			if ($rd['type'] == TYPE_DATASOURCE ){
				$dsUri = $rd['properties'][PROP_REFERENCE_URI]['value'];  //getReferenceUri();
			}
			else if (	$rd['type'] == TYPE_DATASOURCE_JDBC ||
			$rd['type'] == TYPE_DATASOURCE_JNDI ||
			$rd['type'] == TYPE_DATASOURCE_BEAN ) {
				$dsUri = $rd['uri'];
			}
		}

		$oFiltroReporteJasper = new FiltroReporteJasper();
		$oFiltroReporteJasper->setDatasourceUri( $dsUri );
		$oFiltroReporteJasper->setReportUnit( $reportUnit );
		$oFiltroReporteJasper->setDs_reporteUri( $uri );
		return $oFiltroReporteJasper;

	}

	public static function getParamValue( $param_name ){
		$value = $_GET[$param_name];
		return $value;
	}

	public static function getReporteJasperUri( $uri ){
		$_SESSION["username"]=JASPER_USER;
		$_SESSION["password"]=JASPER_PWD;
		
		
		 $online = JASPER_URI;
		 $offline = JASPER_HISTORICO_URI;

		 //20110214 - Chequeamos si el radio button indica obtener el reporte desde la base offline.
		 $fuente =  $_GET['fuente'];;
		 if($fuente=='offline'){
			//reemplazamos JASPER_URI por JASPER_HISTORICO_URI.
			$uri = str_replace($online, $offline, $uri);
			}
			

		$result = ws_get($uri);
		if (get_class($result) == 'SOAP_Fault'){
			$errorMessage = $result->getFault()->faultstring;
			throw new GenericException( $errorMessage );
		}else	{
			$folders = getResourceDescriptors($result);
		}

		if (count($folders) != 1 || $folders[0]['type'] != 'reportUnit'){
			$errorMessage =  "<H1>Invalid RU ($uri)</H1>";
			$errorMessage .=  "<pre>$result</pre>";
			throw new GenericException( $errorMessage );
		}

		$reportUnit = $folders[0];

		// 2. Prepare the parameters array looking in the $_GET for params
		// starting with PARAM_ ...
		//

		$report_params = array();

		//$moveToPage = "executeReport.php?uri=$uri";
		$moveToPage = "doAction?action=ver_reporteJasper&uri=$uri";

		foreach (array_keys($_GET) AS $param_name){
			if (strncmp("PARAM_", $param_name,6) == 0){
				//$report_params[substr($param_name,6)] = $_GET[$param_name];
				$report_params[substr($param_name,6)] = ReporteJasperWS::getParamValue( $param_name );
					
			}

			if ($param_name != "page" && $param_name != "uri"){
				$moveToPage .= "&".urlencode($param_name)."=". urlencode($_GET[$param_name]);
			}
		}

		$moveToPage .="&page=";

		// 3. Execute the report
		$output_params = array();
		$output_params[RUN_OUTPUT_FORMAT] = $_GET['format'];
		if ( $_GET['format'] == RUN_OUTPUT_FORMAT_HTML){
			$page = 0;
			if ($_GET['page'] != '') $page = $_GET['page'];
			//$output_params[RUN_OUTPUT_PAGE] = $page;
		}

		$result = ws_runReport($uri, $report_params,  $output_params, $attachments);

		// 4.
		if (get_class($result) == 'SOAP_Fault'){
			$errorMessage = $result->getFault()->faultstring;
			throw new GenericException( $errorMessage );
		}

		$operationResult = getOperationResult($result);

		if ($operationResult['returnCode'] != '0'){
			$errorMessage = "Error executing the report:<br><font color=\"red\">".$operationResult['returnMessage']."</font>";
			throw new GenericException( $errorMessage );
		}

		if (is_array($attachments)){
				
			/*
			 if ($_GET['format'] == RUN_OUTPUT_FORMAT_PDF){
				header ( "Content-type: application/pdf" );
				$contenido = $attachments["cid:report"] ;
				}
				else if ($_GET['format'] == RUN_OUTPUT_FORMAT_HTML){
				// 1. Save attachments....
					
				// 2. Print the report....
				header ( "Content-type: text/html");
				foreach (array_keys($attachments) as $key){
				if ($key != "cid:report"){
				$f = fopen("images/".substr($key,4),"w");
				fwrite($f, $attachments[$key]);
				fclose($f);
				}
				}
					
				//echo "<center>";
					
				$prevpage = ($page > 0) ? $page-1 : 0;
				$nextpage = $page+1;
					
				//echo "<a href=\"".$moveToPage.$prevpage."\">Prev page</a> | <a href=\"".$moveToPage.$nextpage."\">Next page</a>";
				//echo "</center><hr>";
					
				$contenido = $attachments["cid:report"];
					
				//print_r(array_keys($attachments));
					
				}
				else if ($_GET['format'] == RUN_OUTPUT_FORMAT_XLS){
				header ( 'Content-type: application/xls' );
				header ( 'Content-Disposition: attachment; filename="report.xls"');
				$contenido = $attachments["cid:report"] ;
				}
				*/
				
			$contenido = $attachments["cid:report"] ;
				
				
			//si el contenido es html, hay que guardar los attachments.
			if ($_GET['format'] == RUN_OUTPUT_FORMAT_HTML){
				// 1. Save attachments....
				foreach (array_keys($attachments) as $key){
					if ($key != "cid:report"){
						$f = fopen("images/".substr($key,4),"w");
						fwrite($f, $attachments[$key]);
						fclose($f);
					}
				}

			
				$contenido = utf8_decode( $contenido );
				
				//limpiamos el html para que devuelva sólo lo que está dentro del tag <body>
				$inicio_body = strpos($contenido,  "<body>");
				$fin_body = strpos($contenido,  "</body>");
				$long_body = $fin_body - $inicio_body;
				$contenido = substr( $contenido, $inicio_body+6, $long_body);
				$volver = "<input type='button' onclick='javascript: history.back();'	value='Nueva b&uacute;squeda'>";
				$volver_listado = "<input type=\"button\" onclick=\"javascript: window.location='" . WEB_PATH.   "doAction?action=listar_reportesJasper'\"	value=\"Volver al listado\">";
				$contenido .=  '<br> <center>' . $volver . '&nbsp;&nbsp;' . $volver_listado . '</center>';
				
				$contenido =  "<div id='jasper'>$contenido</div>";
				
			}
			
			
				
		} else {
			$errorMessage = "No attachment found!";
			throw new GenericException( $errorMessage );
		}


		$oReporteJasper = new ReporteJasper();
		$oReporteJasper->setDs_contenido( $contenido );
		$oReporteJasper->setDs_formato( $_GET['format'] );

		return $oReporteJasper;

	}
	//INTERFACE IListar.

	function getEntidades ( CriterioBusqueda $criterio ){
		return  $this->getReportesJasper( $criterio );
	}

	function getCantidadEntidades (  CriterioBusqueda $criterio ){
		return $this->cantidad ;
	}
	
	
	static function orderMultiDimensionalArray ($toOrderArray, $field, $inverse = false) {  
	       $position = array();  
	       $newRow = array();  
	       foreach ($toOrderArray as $key => $row) {  
	               $position[$key]  = $row[$field];  
	               $newRow[$key] = $row;  
	       }  
	       if ($inverse) {  
	           arsort($position);  
	       }  
	       else {  
	           asort($position);  
	       }  
	       $returnArray = array();  
	       foreach ($position as $key => $pos) {       
	           $returnArray[] = $newRow[$key];  
	       }  
	       return $returnArray;  
	}	
}