<?php

class JasperDAO{
	

	static function getJasperUri( $cd_jasperDatasource ) {
		
		$db = CdtDbManager::getConnection();
		
		$sql = "SELECT ds_uri FROM jasper_datasource";
		$sql .= " WHERE cd_datasource = $cd_jasperDatasource";
		
		$result = $db->sql_query ( $sql );
	
		if(!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());
		
		if ($db->sql_numrows () > 0) {
			$temp = $db->sql_fetchassoc ( $result );
			$uri = $temp['ds_uri'];
		}
		
		$db->sql_freeresult($result);
		return $uri;
	}
	

}
?>