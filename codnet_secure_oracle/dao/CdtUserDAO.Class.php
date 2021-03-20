<?php 

/** 
 * DAO para CdtUser 
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtUserDAO { 

	/**
	 * se persiste la nueva entity
	 * @param CdtUser $oCdtUser entity a persistir.
	 */
	public static function addCdtUser(CdtUser $oCdtUser) { 
		$db = CdtDbManager::getConnection(); 

		$ds_username = $oCdtUser->getDs_username();
		
		$ds_name = $oCdtUser->getDs_name();
		
		$ds_email = $oCdtUser->getDs_email();
		
		$ds_password = $oCdtUser->getDs_password();
		
		$ds_phone = $oCdtUser->getDs_phone();
		
		$ds_address = $oCdtUser->getDs_address();
		
		$cd_usergroup =  CdtFormatUtils::ifEmpty( $oCdtUser->getCd_usergroup(), 'null' );
		
		
		$tableName = CDT_SECURE_TABLE_CDTUSER;
		
		$sql = "INSERT INTO $tableName (ds_username, ds_name, ds_email, ds_password, cd_usergroup, ds_phone, ds_address) VALUES('$ds_username', '$ds_name', '$ds_email', '$ds_password', $cd_usergroup, '$ds_phone', '$ds_address')"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		//seteamos el nuevo id.
		$cd = $db->sql_nextid();
        $oCdtUser->setCd_user( $cd );
	}


	/**
	 * se modifica la entity
	 * @param CdtUser $oCdtUser entity a modificar.
	 */
	public static function updateCdtUser(CdtUser $oCdtUser) { 
		$db = CdtDbManager::getConnection(); 

		
		$ds_username = $oCdtUser->getDs_username();
		
		$ds_name = $oCdtUser->getDs_name();
		
		$ds_email = $oCdtUser->getDs_email();
		
		$ds_phone = $oCdtUser->getDs_phone();
		
		$ds_address = $oCdtUser->getDs_address();
		
		$cd_user = CdtFormatUtils::ifEmpty( $oCdtUser->getCd_user(), 'null' );
		
		$cd_usergroup = CdtFormatUtils::ifEmpty( $oCdtUser->getCd_usergroup(), 'null' );
		
		$tableName = CDT_SECURE_TABLE_CDTUSER;
		
		$sql = "UPDATE $tableName SET ds_username = '$ds_username', ds_name = '$ds_name', ds_email = '$ds_email', cd_usergroup = $cd_usergroup, ds_phone = '$ds_phone', ds_address = '$ds_address' WHERE cd_user = $cd_user "; 
                
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}
	
	/**
	 * se modifica la password del usuario entity
	 * @param CdtUser $oCdtUser entity a modificar.
	 */
	public static function updatePassword(CdtUser $oCdtUser) { 
		
		$db = CdtDbManager::getConnection(); 

		$ds_password = $oCdtUser->getDs_password();
		
		$tableName = CDT_SECURE_TABLE_CDTUSER;
		
		$cd_user = CdtFormatUtils::ifEmpty( $oCdtUser->getCd_user(), 'null' );
		
		$sql = "UPDATE $tableName SET ds_password = '$ds_password' WHERE cd_user = $cd_user "; 

		CdtUtils::log_debug("update password $sql");
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se elimina la entity
	 * @param CdtUser $oCdtUser entity a eliminar.
	 */
	public static function deleteCdtUser(CdtUser $oCdtUser) { 
		$db = CdtDbManager::getConnection(); 

		$cd_user = $oCdtUser->getCd_user();

		$tableName = CDT_SECURE_TABLE_CDTUSER;
		
		$sql = "DELETE FROM $tableName WHERE cd_user = $cd_user "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se obtiene una colección de entities dado el filtro de búsqueda
	 * @param CdtSearchCriteria $oCriteria filtro de búsqueda.
	 * @return ItemCollection[CdtUser]
	 */
	public static function getCdtUsers(CdtSearchCriteria $oCriteria) { 
		
		$db = CdtDbManager::getConnection(); 

		$tableNameUser = CDT_SECURE_TABLE_CDTUSER;
		$tableNameUserGroup = CDT_SECURE_TABLE_CDTUSERGROUP;

		$sql = "SELECT U.*, UG.cd_usergroup as UG_cd_usergroup, UG.ds_usergroup as UG_ds_usergroup FROM $tableNameUser U ";
		$sql .= " LEFT JOIN $tableNameUserGroup UG ON(UG.cd_usergroup=U.cd_usergroup) ";
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = CdtResultFactory::toCollection($db, $result, new CdtUserFactory("", "UG"));
		$db->sql_freeresult($result);
		return $items;
	}

	
	/**
	 * se obtiene la cantidad de entities dado el filtro de búsqueda
	 * @param CdtSearchCriteria $oCriteria filtro de búsqueda.
	 * @return int
	 */
	public static function getCdtUsersCount(CdtSearchCriteria $oCriteria) { 
		$db = CdtDbManager::getConnection(); 

		$tableNameUser = CDT_SECURE_TABLE_CDTUSER;
		$tableNameUserGroup = CDT_SECURE_TABLE_CDTUSERGROUP;

		$sql = "SELECT count(*) as count FROM $tableNameUser U ";
		$sql .= " LEFT JOIN $tableNameUserGroup UG ON(UG.cd_usergroup=U.cd_usergroup) ";
		
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
	 * se obtiene un entity dado el filtro de búsqueda
	 * @param CdtSearchCriteria $oCriteria filtro de búsqueda.
	 * @return CdtUser
	 */
	public static function getCdtUser(CdtSearchCriteria $oCriteria) { 

		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTUSER;
		
		$sql = "SELECT * FROM $tableName ";
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new CdtUserFactory();
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

	/**
	 * se obtiene un user con su grupo dado el filtro de búsqueda
	 * @param CdtSearchCriteria $oCriteria filtro de búsqueda.
	 * @return CdtUser
	 */
	public static function getCdtUserWithUserGroup( CdtSearchCriteria $oCriteria ) { 

		$db = CdtDbManager::getConnection(); 

		$tableNameUser = CDT_SECURE_TABLE_CDTUSER;
		$tableNameUserGroup = CDT_SECURE_TABLE_CDTUSERGROUP;
		
		$sql = "SELECT U.*, UG.cd_usergroup as UG_cd_usergroup, UG.ds_usergroup as UG_ds_usergroup FROM $tableNameUser U ";
		$sql .= " LEFT JOIN $tableNameUserGroup UG ON(UG.cd_usergroup=U.cd_usergroup) ";
		
		$sql .= $oCriteria->buildCriteria();
		$result = $db->sql_query($sql);
		
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			
			$temp = $db->sql_fetchassoc($result);
			$factory = new CdtUserFactory("", "UG");
			$oUser = $factory->build($temp);
			
		}else {$oUser = null;}
		
		$db->sql_freeresult($result);
		return $oUser;
	}

	public static function existUsername( CdtUser $oUser ) {
		$db = CdtDbManager::getConnection(); 

		$tableNameUser = CDT_SECURE_TABLE_CDTUSER;
		
		$ds_username = $oUser->getDs_username();
		$sql = "select count(*) as count FROM $tableNameUser WHERE ds_username ='$ds_username'";
		
		$cd_user = $oUser->getCd_user();
		if(!empty($cd_user))
			$sql .= " AND cd_user <> $cd_user";
		
		
		$result = $db->sql_query ( $sql );
		if(!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());
		
		$next = $db->sql_fetchassoc ( $result );		 
		$count = $next['count'];
		$db->sql_freeresult($result);
		return ($count > 0);
	}
	
	public static function existEmail( CdtUser $oUser ) {
		$db = CdtDbManager::getConnection(); 

		$tableNameUser = CDT_SECURE_TABLE_CDTUSER;
		
		$ds_email = $oUser->getDs_email();
		$sql = "select count(*) as count FROM $tableNameUser WHERE ds_email ='$ds_email'";
		
		$cd_user = $oUser->getCd_user();
		if(!empty($cd_user))
			$sql .= " AND cd_user <> $cd_user";
		
		
		$result = $db->sql_query ( $sql );
		if(!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());
		
		$next = $db->sql_fetchassoc ( $result );		 
		$count = $next['count'];
		$db->sql_freeresult($result);
		return ($count > 0);
	}
} 
?>
