<?php 

/** 
 * Autogenerated class 
 *  
 *  @author modelBuilder 
 *  @since 04-07-2011
 */ 
class FuncionDAO { 

	public static function insertarFuncion(Funcion $oFuncion) { 
		$db = DbManager::getConnection(); 

		
		$cd_funcion = $oFuncion->getCd_funcion();
		
		$ds_funcion = $oFuncion->getDs_funcion();
		

		$sql = "INSERT INTO funcion (ds_funcion) VALUES('$ds_funcion')"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$db->sql_freeresult($result);
	}


	public static function modificarFuncion(Funcion $oFuncion) { 
		$db = DbManager::getConnection(); 

		
		$cd_funcion = $oFuncion->getCd_funcion();
		
		$ds_funcion = $oFuncion->getDs_funcion();
		


		$sql = "UPDATE funcion SET ds_funcion = '$ds_funcion' WHERE cd_funcion = $cd_funcion "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$db->sql_freeresult($result);
	}


	public static function eliminarFuncion(Funcion $oFuncion) { 
		$db = DbManager::getConnection(); 

		$cd_funcion = $oFuncion->getCd_funcion();

		$sql = "DELETE FROM funcion WHERE cd_funcion = $cd_funcion "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$db->sql_freeresult($result);
	}


	public static function getFunciones(CriterioBusqueda $criterio) { 
		$db = DbManager::getConnection(); 


		$sql = "SELECT * FROM funcion "; 
		$sql .= $criterio->buildFiltro();
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = ResultFactory::toCollection($db, $result, new FuncionFactory());
		$db->sql_freeresult($result);
		return $items;
	}


	public static function getCantFunciones(CriterioBusqueda $criterio) { 
		$db = DbManager::getConnection(); 


		$sql = "SELECT count(*) as count FROM funcion "; 
		$sql .= $criterio->buildFiltroSinPaginar();
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$next = $db->sql_fetchassoc($result);
		$cant = $next['count'];
		$db->sql_freeresult($result);
		return ((int) $cant);
	}


	public static function getFuncion(CriterioBusqueda $criterio) { 
		$db = DbManager::getConnection(); 


		$sql = "SELECT * FROM funcion "; 
		$sql .= $criterio->buildFiltro();
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new FuncionFactory();
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

} 
?>
