<?php 

/** 
 * Autogenerated class 
 *  
 *  @author modelBuilder 
 *  @since 04-07-2011
 */ 
class AccionFuncionDAO { 

	public static function insertarAccionFuncion(AccionFuncion $oAccionFuncion) { 
		$db = DbManager::getConnection(); 

		
		$cd_accionfuncion = $oAccionFuncion->getCd_accionfuncion();
		
		$cd_funcion = $oAccionFuncion->getCd_funcion();
		
		$ds_accion = $oAccionFuncion->getDs_accion();
		

		$sql = "INSERT INTO accionfuncion (cd_funcion, ds_accion) VALUES('$cd_funcion', '$ds_accion')"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$db->sql_freeresult($result);
	}


	public static function modificarAccionFuncion(AccionFuncion $oAccionFuncion) { 
		$db = DbManager::getConnection(); 

		
		$cd_accionfuncion = $oAccionFuncion->getCd_accionfuncion();
		
		$cd_funcion = $oAccionFuncion->getCd_funcion();
		
		$ds_accion = $oAccionFuncion->getDs_accion();
		


		$sql = "UPDATE accionfuncion SET cd_funcion = '$cd_funcion', ds_accion = '$ds_accion' WHERE cd_accionfuncion = $cd_accionfuncion "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$db->sql_freeresult($result);
	}


	public static function eliminarAccionFuncion(AccionFuncion $oAccionFuncion) { 
		$db = DbManager::getConnection(); 

		$cd_accionfuncion = $oAccionFuncion->getCd_accionfuncion();

		$sql = "DELETE FROM accionfuncion WHERE cd_accionfuncion = $cd_accionfuncion "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$db->sql_freeresult($result);
	}


	public static function getAccionFunciones(CriterioBusqueda $criterio) { 
		$db = DbManager::getConnection(); 


		$sql = "SELECT af.*, f.ds_funcion FROM accionfuncion af ";
		$sql .= " LEFT JOIN funcion f ON f.cd_funcion=af.cd_funcion "; 
		$sql .= $criterio->buildFiltro();
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = ResultFactory::toCollection($db, $result, new AccionFuncionFactory());
		$db->sql_freeresult($result);
		return $items;
	}


	public static function getCantAccionFunciones(CriterioBusqueda $criterio) { 
		$db = DbManager::getConnection(); 


		$sql = "SELECT count(*) as count FROM accionfuncion "; 
		$sql .= $criterio->buildFiltroSinPaginar();
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$next = $db->sql_fetchassoc($result);
		$cant = $next['count'];
		$db->sql_freeresult($result);
		return ((int) $cant);
	}


	public static function getAccionFuncion(CriterioBusqueda $criterio) { 
		$db = DbManager::getConnection(); 


		$sql = "SELECT af.*, f.ds_funcion FROM accionfuncion af ";
		$sql .= " LEFT JOIN funcion f ON f.cd_funcion=af.cd_funcion "; 
		$sql .= $criterio->buildFiltro();
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new AccionFuncionFactory();
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

} 
?>