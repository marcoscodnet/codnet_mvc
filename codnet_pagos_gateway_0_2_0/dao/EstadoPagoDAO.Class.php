<?php 

/** 
 * Autogenerated class 
 *  
 *  @author modelBuilder 
 *  @since 20-07-2011
 */ 
class EstadoPagoDAO { 

	public static function insertarEstadoPago(EstadoPago $oEstadoPago) { 
		$db = DbManager::getConnection(); 

		
		$cd_estadopago = $oEstadoPago->getCd_estadopago();
		
		$ds_estadopago = $oEstadoPago->getDs_estadopago();
		

		$sql = "INSERT INTO " . CDT_PAGOS_GATEWAY_TABLA_ESTADOPAGO   .  " (ds_estadopago) VALUES('$ds_estadopago')"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$db->sql_freeresult($result);
	}


	public static function modificarEstadoPago(EstadoPago $oEstadoPago) { 
		$db = DbManager::getConnection(); 

		
		$cd_estadopago = $oEstadoPago->getCd_estadopago();
		
		$ds_estadopago = $oEstadoPago->getDs_estadopago();
		


		$sql = "UPDATE " . CDT_PAGOS_GATEWAY_TABLA_ESTADOPAGO   .  " SET ds_estadopago = '$ds_estadopago' WHERE cd_estadopago = $cd_estadopago "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$db->sql_freeresult($result);
	}


	public static function eliminarEstadoPago(EstadoPago $oEstadoPago) { 
		$db = DbManager::getConnection(); 

		$cd_estadopago = $oEstadoPago->getCd_estadopago();

		$sql = "DELETE FROM " . CDT_PAGOS_GATEWAY_TABLA_ESTADOPAGO   .  " WHERE cd_estadopago = $cd_estadopago "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$db->sql_freeresult($result);
	}


	public static function getEstadoPagos(CriterioBusqueda $criterio) { 
		$db = DbManager::getConnection(); 


		$sql = "SELECT * FROM " . CDT_PAGOS_GATEWAY_TABLA_ESTADOPAGO   .  " "; 
		$sql .= $criterio->buildFiltro();
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = ResultFactory::toCollection($db, $result, new EstadoPagoFactory());
		$db->sql_freeresult($result);
		return $items;
	}


	public static function getCantEstadoPagos(CriterioBusqueda $criterio) { 
		$db = DbManager::getConnection(); 


		$sql = "SELECT count(*) as count FROM " . CDT_PAGOS_GATEWAY_TABLA_ESTADOPAGO   .  " "; 
		$sql .= $criterio->buildFiltroSinPaginar();
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$next = $db->sql_fetchassoc($result);
		$cant = $next['count'];
		$db->sql_freeresult($result);
		return ((int) $cant);
	}


	public static function getEstadoPago(CriterioBusqueda $criterio) { 
		$db = DbManager::getConnection(); 


		$sql = "SELECT * FROM " . CDT_PAGOS_GATEWAY_TABLA_ESTADOPAGO   .  " "; 
		$sql .= $criterio->buildFiltro();
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new EstadoPagoFactory();
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

} 
?>
