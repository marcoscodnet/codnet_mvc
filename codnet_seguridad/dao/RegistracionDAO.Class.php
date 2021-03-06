<?php 

/** 
 * Autogenerated class 
 *  
 *  @author modelBuilder 
 *  @since 13-07-2011
 */ 
class RegistracionDAO { 

	public static function insertarRegistracion(Registracion $oRegistracion) { 
		$db = DbManager::getConnection(); 

		
		$cd_registracion = $oRegistracion->getCd_registracion();
		
		$ds_codigoactivacion = $oRegistracion->getDs_codigoactivacion();
		
		$dt_fecha = $oRegistracion->getDt_fecha();
		
		$ds_nomusuario = $oRegistracion->getDs_nomusuario();
		
		$ds_apynom = $oRegistracion->getDs_apynom();
		
		$ds_mail = $oRegistracion->getDs_mail();
		
		$ds_password = $oRegistracion->getDs_password();
		
		$cd_pais = FormatUtils::ifEmpty($oRegistracion->getCd_pais(), 'null');
		
		$ds_telefono = $oRegistracion->getDs_telefono();
		
		$ds_domicilio = $oRegistracion->getDs_domicilio();
		

		$sql = "INSERT INTO registracion (ds_codigoactivacion, dt_fecha, ds_nomusuario, ds_apynom, ds_mail, ds_password, cd_pais, ds_telefono, ds_domicilio) VALUES('$ds_codigoactivacion', '$dt_fecha', '$ds_nomusuario', '$ds_apynom', '$ds_mail', '$ds_password', $cd_pais, '$ds_telefono', '$ds_domicilio')"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$db->sql_freeresult($result);
	}


	public static function modificarRegistracion(Registracion $oRegistracion) { 
		$db = DbManager::getConnection(); 

		
		$cd_registracion = $oRegistracion->getCd_registracion();
		
		$ds_codigoactivacion = $oRegistracion->getDs_codigoactivacion();
		
		$dt_fecha = $oRegistracion->getDt_fecha();
		
		$ds_nomusuario = $oRegistracion->getDs_nomusuario();
		
		$ds_apynom = $oRegistracion->getDs_apynom();
		
		$ds_mail = $oRegistracion->getDs_mail();
		
		$ds_password = $oRegistracion->getDs_password();
		
		$cd_pais = FormatUtils::ifEmpty($oRegistracion->getCd_pais(), 'null');
		
		$ds_telefono = $oRegistracion->getDs_telefono();
		
		$ds_domicilio = $oRegistracion->getDs_domicilio();
		


		$sql = "UPDATE registracion SET ds_codigoactivacion = '$ds_codigoactivacion', dt_fecha = '$dt_fecha', ds_nomusuario = '$ds_nomusuario', ds_apynom = '$ds_apynom', ds_mail = '$ds_mail', ds_password = '$ds_password', cd_pais = $cd_pais, ds_telefono = '$ds_telefono', ds_domicilio = '$ds_domicilio' WHERE cd_registracion = $cd_registracion "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$db->sql_freeresult($result);
	}


	public static function eliminarRegistracion(Registracion $oRegistracion) { 
		$db = DbManager::getConnection(); 

		$cd_registracion = $oRegistracion->getCd_registracion();

		$sql = "DELETE FROM registracion WHERE cd_registracion = $cd_registracion "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$db->sql_freeresult($result);
	}


	public static function getRegistraciones(CriterioBusqueda $criterio) { 
		$db = DbManager::getConnection(); 


		$sql = "SELECT * FROM registracion "; 
		$sql .= $criterio->buildFiltro();
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = ResultFactory::toCollection($db, $result, new RegistracionFactory());
		$db->sql_freeresult($result);
		return $items;
	}


	public static function getCantRegistraciones(CriterioBusqueda $criterio) { 
		$db = DbManager::getConnection(); 


		$sql = "SELECT count(*) as count FROM registracion "; 
		$sql .= $criterio->buildFiltroSinPaginar();
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$next = $db->sql_fetchassoc($result);
		$cant = $next['count'];
		$db->sql_freeresult($result);
		return ((int) $cant);
	}


	public static function getRegistracion(CriterioBusqueda $criterio) { 
		$db = DbManager::getConnection(); 


		$sql = "SELECT * FROM registracion "; 
		$sql .= $criterio->buildFiltro();
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new RegistracionFactory();
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

} 
?>
