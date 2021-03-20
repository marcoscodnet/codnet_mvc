<?php

require_once( APP_PATH . '/jasper/client.php');

session_start();
if ($_SESSION["username"] == '')
{
	header("Location: " . WEB_PATH . "/reportes");
	exit();
}

$currentUri = "/";

if ($_GET['uri'] != '')
{
	$currentUri = $_GET['uri'];
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

?>

<input type="hidden" name="uri" value="<?php echo $currentUri ?>">

<table id="reportes_filtrar">

	<tr>
		<td colspan="3">
		<h1><?php echo  htmlspecialchars(  $reportUnit['label']   ) ; ?></h1>
		</td>
	</tr>
	<?php


	// Show all input controls
	for ($i=0; $i< count($resources); ++$i){
		$rd = $resources[$i];

		if ($rd['type'] == TYPE_INPUT_CONTROL ){
			$parametersCount++;
			?>
	<tr>
		<td align="right" style="padding: 10px;"><?php echo $rd['label']; ?></td>
		<td><?php   
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
		
		if ($controlType == IC_TYPE_BOOLEAN)
		{
			?> <input type="checkbox" value="true"
			name="<?php echo "PARAM_".$rd['name']; ?>"> <?php                
		}
		else if ($controlType == IC_TYPE_SINGLE_VALUE && !$is_date){
			
			?> <input type="text" name="<?php echo "PARAM_".$rd['name']; ?>"> <?php
		}
		else if ($controlType == IC_TYPE_SINGLE_VALUE && $is_date){
			
			?> <input type="text" name="<?php echo "PARAM_".$rd['name']; ?>" id="<?php echo "PARAM_".$rd['name']; ?>"> 

				<script type="text/javascript">
				$(function() {
					$("#<?php echo "PARAM_".$rd['name']; ?>").datepicker();
				});
				</script>

				<!-- para determinar que es una fecha -->	
				<input type="hidden" name="<?php echo "PARAM_".$rd['name'] . "_DATE"; ?>" value="1">
				
			
			<?php
		}
		else if ($controlType == IC_TYPE_SINGLE_VALUE && $is_date_time){
			
			?> <input type="text" name="<?php echo "PARAM_".$rd['name']; ?>" id="<?php echo "PARAM_".$rd['name']; ?>"> 

				<script type="text/javascript">
				$(function() {
					$("#<?php echo "PARAM_".$rd['name']; ?>").datepicker({dateFormat: 'mm/dd/yy'});
				});
				</script>
					
				
			<?php
		}
		else if ($controlType == IC_TYPE_SINGLE_SELECT_LIST_OF_VALUES)
		{
			?> <select name="<?php echo "PARAM_".$rd['name']; ?>">
			<?php

			$listOfValues = array();
			foreach ($rd['resources'] AS $lov)
			{
				if ($lov['type'] == TYPE_LOV)
				{
					$listOfValues = $lov;
					break;
				}
			}

			//  LOV->properties { [PROP_LOV]->properties { [0]{name,value}, [1]{name,value}... } }
			//  name = key
			//  value = label

			foreach ($listOfValues['properties'][PROP_LOV]['properties'] AS $lovItem)
			{
				?>
			<option value="<?php echo htmlspecialchars($lovItem['name']); ?>"><?php echo ( htmlentities($lovItem['value']) ) ; ?></option>
			<?php
			}

			?>
		</select> <?php                
		}
		else if ($controlType == IC_TYPE_SINGLE_SELECT_QUERY)
		{
			?> <select name="<?php echo "PARAM_".$rd['name']; ?>">
			<?php
			// Get the list of entries....

			$result = ws_get($rd['uri'],
			array( IC_GET_QUERY_DATA => $dsUri ) );

			$rds = getResourceDescriptors($result);
			$rd =$rds[0];

			$datarows = $rd['properties'][PROP_QUERY_DATA]['properties'];

			foreach ($datarows AS $datarow)
			{
				$row_value = $datarow['value'];
				$row_label = "";
				$k = 0;
				foreach ($datarow['properties'] AS $datacolumn)
				{
					if ($k > 0) $row_label .= "   |   ";
					$row_label .= $datacolumn['value'];
					$k++;
				}
				?>
			<option value="<?php echo htmlspecialchars($row_value); ?>"><?php echo htmlspecialchars($row_label); ?></option>
			<?php
			}
			?>
		</select></td>
		<td><?php echo $rd['description']; ?></td>
	</tr>
	<?php
		}
		}
	}
	?>

	<tr>
		<td valign="top" style="padding: 10px">Formato del reporte</td>
		<td colspan="2" style="padding: 10px"><INPUT TYPE=RADIO NAME="format"
			checked VALUE="PDF"> <img src="images/pdf.png" class="no-border"
			alt="pdf" title="pdf" /> <br />
		<!-- INPUT TYPE=RADIO NAME="format" VALUE="XLS"> <img src="images/xls.gif"
			class="no-border" alt="excel" title="excel" /> <br /-->
		<INPUT CHECKED TYPE=RADIO NAME="format" VALUE="HTML"> <img
			src="images/pantalla.gif" class="no-border" alt="en pantalla"
			title="en pantalla" /> <br />
		</td>
	</tr>
	<tr>
		<td valign="top" style="padding: 10px">Fuente de datos</td>
		<td colspan="2" style="padding: 10px">
			<INPUT CHECKED TYPE=RADIO NAME="fuente" VALUE="online"> Base de datos online <br />
			<INPUT TYPE=RADIO NAME="fuente" VALUE="offline"> Base de datos offline (Hist&oacute;rico)
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center"><input type="submit"
			value="Ver reporte"></td>
	</tr>
</table>
