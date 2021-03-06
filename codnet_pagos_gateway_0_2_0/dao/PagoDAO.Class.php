<?php 

/** 
 * Autogenerated class 
 *  
 *  @author modelBuilder 
 *  @since 20-07-2011
 */ 
class PagoDAO { 

	public static function insertarPago(Pago $oPago) { 
		$db = DbManager::getConnection(); 

		
		$cd_pago = $oPago->getCd_pago();
		
		$ds_descripcion = $oPago->getDs_descripcion();
		
		$dt_fecha = $oPago->getDt_fecha();
		
		$dt_fechacambioestado = $oPago->getDt_fechacambioestado();
		
		$cd_estadopago = $oPago->getCd_estadopago();
		
		$cd_usuario = $oPago->getCd_usuario();
		

		$sql = "INSERT INTO " . CDT_PAGOS_GATEWAY_TABLA_PAGO   .  " (dt_fecha, dt_fechacambioestado, cd_estadopago, cd_usuario, ds_descripcion) VALUES('$dt_fecha', '$dt_fechacambioestado', '$cd_estadopago', '$cd_usuario', '$ds_descripcion')"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$cd_pago = $db->sql_nextid();
        $oPago->setCd_pago( $cd_pago );
        
		$db->sql_freeresult($result);
	}


	public static function modificarPago(Pago $oPago) { 
		$db = DbManager::getConnection(); 

		
		$cd_pago = $oPago->getCd_pago();
		
		$dt_fecha = $oPago->getDt_fecha();
		
		$dt_fechacambioestado = $oPago->getDt_fechacambioestado();
		
		$cd_estadopago = $oPago->getCd_estadopago();
		
		$cd_usuario = $oPago->getCd_usuario();
		
		$ds_descripcion = $oPago->getDs_descripcion();
		
		$sql = "UPDATE " . CDT_PAGOS_GATEWAY_TABLA_PAGO   .  " SET dt_fecha = '$dt_fecha', dt_fechacambioestado = '$dt_fechacambioestado', cd_estadopago = '$cd_estadopago', cd_usuario = '$cd_usuario', ds_descripcion = '$ds_descripcion' WHERE cd_pago = $cd_pago "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$db->sql_freeresult($result);
	}


	public static function eliminarPago(Pago $oPago) { 
		$db = DbManager::getConnection(); 

		$cd_pago = $oPago->getCd_pago();

		$sql = "DELETE FROM " . CDT_PAGOS_GATEWAY_TABLA_PAGO   .  " WHERE cd_pago = $cd_pago "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$db->sql_freeresult($result);
	}


	public static function getPagos(CriterioBusqueda $criterio) { 
		$db = DbManager::getConnection(); 


		$sql  = "SELECT P.*, U.*, EP.ds_estadopago FROM " . CDT_PAGOS_GATEWAY_TABLA_PAGO   .  " P ";
		$sql .= "LEFT JOIN " . CDT_SEGURIDAD_TABLA_USUARIO   .  " U ON U.cd_usuario = P.cd_usuario ";
		$sql .= "LEFT JOIN " . CDT_PAGOS_GATEWAY_TABLA_ESTADOPAGO   .  " EP ON EP.cd_estadopago = P.cd_estadopago ";
		  
		$sql .= $criterio->buildFiltro();
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = ResultFactory::toCollection($db, $result, new PagoFactory());
		$db->sql_freeresult($result);
		return $items;
	}


	public static function getCantPagos(CriterioBusqueda $criterio) { 
		$db = DbManager::getConnection(); 


		$sql  = "SELECT count(*) as count FROM " . CDT_PAGOS_GATEWAY_TABLA_PAGO   .  " P "; 
		$sql .= "LEFT JOIN " . CDT_SEGURIDAD_TABLA_USUARIO   .  " U ON U.cd_usuario = P.cd_usuario ";
		$sql .= "LEFT JOIN " . CDT_PAGOS_GATEWAY_TABLA_ESTADOPAGO   .  " EP ON EP.cd_estadopago = P.cd_estadopago ";
		$sql .= $criterio->buildFiltroSinPaginar();
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$next = $db->sql_fetchassoc($result);
		$cant = $next['count'];
		$db->sql_freeresult($result);
		return ((int) $cant);
	}


	public static function getPago(CriterioBusqueda $criterio) { 
		$db = DbManager::getConnection(); 


		$sql  = "SELECT P.*, U.*, EP.ds_estadopago FROM " . CDT_PAGOS_GATEWAY_TABLA_PAGO   .  " P ";
		$sql .= "LEFT JOIN " . CDT_SEGURIDAD_TABLA_USUARIO   .  " U ON U.cd_usuario = P.cd_usuario ";
		$sql .= "LEFT JOIN " . CDT_PAGOS_GATEWAY_TABLA_ESTADOPAGO   .  " EP ON EP.cd_estadopago = P.cd_estadopago ";
		
		$sql .= $criterio->buildFiltro();
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new PagoFactory();
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

} 
?>
