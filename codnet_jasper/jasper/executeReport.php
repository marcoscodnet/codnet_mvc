<?php
 
 //require_once('client.php');
 //include("../includes/includes.php");

 //obtenemos el valor del parámetro.
 function getParamValue( $param_name ){
	$value = $_GET[$param_name];
 	
 	//es fecha? -> lo pasamos a timestamp.
 	/*if( isset( $_GET[$param_name . "_DATE"] )){
		$fecha = explode ( "/", $value );
		$value = mktime(0,0,0, $fecha[1], $fecha[0], $fecha[2]);
 	}*/

 	return $value;
 }
 
 session_start();
 if ($_SESSION["username"] == '')
 {
 	header("Location: index.php");
     	exit();
 }
 
 // 1 Get the ReoportUnit ResourceDescriptor...
 $currentUri = "/";
 
 if ($_GET['uri'] != '')
 {
 	$currentUri = $_GET['uri'];
 }

 $online = JASPER_URI;
 $offline = JASPER_HISTORICO_URI;
 
 //20110214 - Chequeamos si el radio button indica obtener el reporte desde la base offline.
 $fuente =  $_GET['fuente'];;
 if($fuente=='offline'){
 	//reemplazamos JASPER_URI por JASPER_HISTORICO_URI.
 	$currentUri = str_replace($online, $offline, $currentUri);
 }
 $result = ws_get($currentUri);
 if (get_class($result) == 'SOAP_Fault')
 {
 	$errorMessage = $result->getFault()->faultstring;
 	
 	echo $errorMessage;
 	exit();
 }
 else
 {
 	$folders = getResourceDescriptors($result);
 }
 
 if (count($folders) != 1 || $folders[0]['type'] != 'reportUnit')
 {
 	 echo "<H1>Invalid RU ($currentUri)</H1>";
 	 echo "<pre>$result</pre>";
 	 
 	 exit(); 
 }

 $reportUnit = $folders[0];
 
 // 2. Prepare the parameters array looking in the $_GET for params
 // starting with PARAM_ ...
 //
 
 $report_params = array();
 
 $moveToPage = "executeReport.php?uri=$currentUri";
 
 foreach (array_keys($_GET) AS $param_name)
 {
 	if (strncmp("PARAM_", $param_name,6) == 0)
 	{
 		//$report_params[substr($param_name,6)] = $_GET[$param_name];
 		$report_params[substr($param_name,6)] = getParamValue( $param_name );
 		
 	}
 	
 	if ($param_name != "page" && $param_name != "uri")
 	{
 		$moveToPage .= "&".urlencode($param_name)."=". urlencode($_GET[$param_name]);	
 	}
}
 
$moveToPage .="&page=";
 
 // 3. Execute the report
 $output_params = array();
 $output_params[RUN_OUTPUT_FORMAT] = $_GET['format'];
 if ( $_GET['format'] == RUN_OUTPUT_FORMAT_HTML)
 {
     $page = 0;
     if ($_GET['page'] != '') $page = $_GET['page'];
     //$output_params[RUN_OUTPUT_PAGE] = $page;
 }
 
 $result = ws_runReport($currentUri, $report_params,  $output_params, $attachments);
 
 
 
// 4. 
if (get_class($result) == 'SOAP_Fault')
 {
 	$errorMessage = $result->getFault()->faultstring;
 	
 	echo $errorMessage;
 	exit();
 }
 
 
$operationResult = getOperationResult($result);
 
 if ($operationResult['returnCode'] != '0')
 {
 	echo "Error executing the report:<br><font color=\"red\">".$operationResult['returnMessage']."</font>";		
 	exit();
 }
 
 if (is_array($attachments))
 {
 	if ($_GET['format'] == RUN_OUTPUT_FORMAT_PDF)
 	{
 		header ( "Content-type: application/pdf" );
 		echo( $attachments["cid:report"]);
 	}
 	else if ($_GET['format'] == RUN_OUTPUT_FORMAT_HTML)
 	{
 		// 1. Save attachments....
 		
 		// 2. Print the report....
 		
 		
 		header ( "Content-type: text/html");
 		foreach (array_keys($attachments) as $key)
 		{
 			if ($key != "cid:report")
 			{
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
 		
 		echo $attachments["cid:report"];
 		
 		//print_r(array_keys($attachments));
 		
 	}
 	else if ($_GET['format'] == RUN_OUTPUT_FORMAT_XLS)
 	{
  		header ( 'Content-type: application/xls' );
  		header ( 'Content-Disposition: attachment; filename="report.xls"');
  		echo( $attachments["cid:report"]);
  		
	}  	

	exit(); 	
 } else echo "No attachment found!";

?>