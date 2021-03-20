<?php
//require_once( APP_PATH . '/jasper/client.php');
session_start();
if ($_SESSION["username"] == ''){
	$errorMessage = "";

	$_SESSION["username"]=JASPER_USER;
	$_SESSION["password"]=JASPER_PWD;
	//$_SESSION["username"]="hirsch";
	//$_SESSION["password"]="hirsch";
	
}


$currentUri = "/";
$parentUri = "/";

if ($_GET['uri'] != ''){
	$currentUri = $_GET['uri'];
}

$currentUri = JASPER_URI;
//$currentUri = '/organizations/organization_1/reports/Hirsch';


$pos = strrpos($currentUri, "/");
if($pos === false || $pos == 0) {
	$parentUri="/";
}else{
	$parentUri = substr($currentUri, 0, $pos );
}
$result = ws_list($currentUri);
if (get_class($result) == 'SOAP_Fault'){
	$errorMessage = $result->getFault()->faultstring;
}else{
	$folders = getResourceDescriptors($result);
	
}
?>