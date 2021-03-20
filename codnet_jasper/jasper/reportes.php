<?php

include("../includes/includes.php");


include( APP_PATH . "/jasper/getReports.php");


function orderMultiDimensionalArray ($toOrderArray, $field, $inverse = false) {  
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

$page 	= $_POST['page']; // get the requested page
$limit 	= $_POST['rows']; // get how many rows we want to have into the grid
$sidx 	= $_POST['sidx']; // get index row - i.e. user click to sort
$sord 	= $_POST['sord']; // get the direction


if(!$page) $page = 1;
if(!$sidx) $sidx = 1;
if(!$sord) $sord = "ASC";
if(!$limit) $limit = 1000;



//leemos los reportes con el webservice
$reportes = array();

for ($i=0; $i < count($folders); ++$i){
	
	$resource = $folders[$i];
	//nos quedamos sólo con los reportes (TODO ver de navegar carpetas).
    if ( $resource['type'] == 'reportUnit'){
            	
    	$link = WEB_PATH . "/reportes_filtrar?uri=" . $resource['uri'];
            	
	    $reportes[] = array ("REPORTE_ID" => "<a href='$link'>" . $i . "</a>", "REPORTE_NOMBRE" => "<a href='$link'>" . $resource['label'] . "</a>", "REPORTE_LABEL" =>  $resource['label']);
            
    }
}

$reportes = orderMultiDimensionalArray ($reportes, 'REPORTE_LABEL');

$count 	= count($reportes);

if($count > 0) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
if($page > $total_pages) $page = $total_pages;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)

//armamos la estructura json con los reportes obtenidos.

$json->page = $page;
$json->total = $total_pages;
$json->records = $count;
$i = 0;

foreach($reportes as $reporte) {
	$json->rows[$i]['id'] = $reporte["REPORTE_ID"];
	$json->rows[$i]['cell'] = array($reporte["REPORTE_NOMBRE"]);
	$i++;
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($json);

?>