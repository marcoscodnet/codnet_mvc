<?php 

/** 
 * DAO para CdtRegistration 
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtRegistrationDAO { 

	/**
	 * se persiste la nueva entity 
	 * @param CdtRegistration $oCdtRegistration entity a persistir.
	 */
	public static function addCdtRegistration(CdtRegistration $oCdtRegistration) { 
		$db = CdtDbManager::getConnection(); 

		
		$ds_activationcode = $oCdtRegistration->getDs_activationcode();
		
		$dt_date = $oCdtRegistration->getDt_date();
		
		$ds_username = $oCdtRegistration->getDs_username();
		
		$ds_name = $oCdtRegistration->getDs_name();
		
		$ds_email = $oCdtRegistration->getDs_email();
		
		$ds_password = $oCdtRegistration->getDs_password();
		
		$ds_phone = $oCdtRegistration->getDs_phone();
		
		$ds_address = $oCdtRegistration->getDs_address();
		
		$tableName = CDT_SECURE_TABLE_CDTREGISTRATION;
		
		$sql = "INSERT INTO $tableName (ds_activationcode, dt_date, ds_username, ds_name, ds_email, ds_password, ds_phone, ds_address) VALUES('$ds_activationcode', '$dt_date', '$ds_username', '$ds_name', '$ds_email', '$ds_password', '$ds_phone', '$ds_address')"; 

		CdtUtils::log_debug( "signup 5 $sql ");
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		CdtUtils::log_debug( "signup 6 ");
			
		//seteamos el nuevo id.
		$cd = $db->sql_nextid();
        $oCdtRegistration->setCd_registration( $cd );
        
        CdtUtils::log_debug( "signup 7 ");
	}


	/**
	 * se modifica la entity
	 * @param CdtRegistration $oCdtRegistration entity a modificar.
	 */
	public static function updateCdtRegistration(CdtRegistration $oCdtRegistration) { 
		$db = CdtDbManager::getConnection(); 

		
		$ds_activationcode = $oCdtRegistration->getDs_activationcode();
		
		$dt_date = $oCdtRegistration->getDt_date();
		
		$ds_username = $oCdtRegistration->getDs_username();
		
		$ds_name = $oCdtRegistration->getDs_name();
		
		$ds_email = $oCdtRegistration->getDs_email();
		
		$ds_password = $oCdtRegistration->getDs_password();
		
		$ds_phone = $oCdtRegistration->getDs_phone();
		
		$ds_address = $oCdtRegistration->getDs_address();
		
		
		$cd_registration = CdtFormatUtils::ifEmpty( $oCdtRegistration->getCd_registration(), 'null' );
		
		

		$tableName = CDT_SECURE_TABLE_CDTREGISTRATION;
		
		$sql = "UPDATE $tableName SET ds_activationcode = '$ds_activationcode', dt_date = '$dt_date', ds_username = '$ds_username', ds_name = '$ds_name', ds_email = '$ds_email', ds_password = '$ds_password', ds_phone = '$ds_phone', ds_address = '$ds_address' WHERE cd_registration = $cd_registration "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se elimina la entity
	 * @param CdtRegistration $oCdtRegistration entity a eliminar.
	 */
	public static function deleteCdtRegistration(CdtRegistration $oCdtRegistration) { 
		$db = CdtDbManager::getConnection(); 

		$cd_registration = $oCdtRegistration->getCd_registration();

		$tableName = CDT_SECURE_TABLE_CDTREGISTRATION;
		
		$sql = "DELETE FROM $tableName WHERE cd_registration = $cd_registration "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se obtiene una colecci�n de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return ItemCollection[CdtRegistration]
	 */
	public static function getCdtRegistrations(CdtSearchCriteria $oCriteria) { 
		
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTREGISTRATION;

		$sql = "SELECT * FROM $tableName ";
		//TODO left joins
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = CdtResultFactory::toCollection($db, $result, new CdtRegistrationFactory());
		$db->sql_freeresult($result);
		return $items;
	}

	
	/**
	 * se obtiene la cantidad de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return int
	 */
	public static function getCdtRegistrationsCount(CdtSearchCriteria $oCriteria) { 
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTREGISTRATION;
		
		$sql = "SELECT count(*) as count FROM $tableName "; 
		//TODO left joins
		
		$sql .= $oCriteria->buildCriteriaWithoutPaging();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$next = $db->sql_fetchassoc($result);
		$cant = $next['count'];
		$db->sql_freeresult($result);
		return ((int) $cant);
	}


	/**
	 * se obtiene un entity dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return CdtRegistration
	 */
	public static function getCdtRegistration(CdtSearchCriteria $oCriteria) { 

		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTREGISTRATION;
		
		$sql = "SELECT * FROM $tableName ";
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new CdtRegistrationFactory();
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

} 
?>
