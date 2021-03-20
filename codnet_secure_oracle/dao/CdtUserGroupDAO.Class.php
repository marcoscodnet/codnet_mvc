<?php 

/** 
 * DAO para CdtUserGroup 
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtUserGroupDAO { 

	/**
	 * se persiste la nueva entity
	 * @param CdtUserGroup $oCdtUserGroup entity a persistir.
	 */
	public static function addCdtUserGroup(CdtUserGroup $oCdtUserGroup) { 
		$db = CdtDbManager::getConnection(); 

		
		$ds_usergroup = $oCdtUserGroup->getDs_usergroup();
		
		
		
		$tableName = CDT_SECURE_TABLE_CDTUSERGROUP;
		
		$sql = "INSERT INTO $tableName (ds_usergroup) VALUES('$ds_usergroup')"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		//seteamos el nuevo id.
		$cd = $db->sql_nextid();
        $oCdtUserGroup->setCd_usergroup( $cd );
	}


	/**
	 * se modifica la entity
	 * @param CdtUserGroup $oCdtUserGroup entity a modificar.
	 */
	public static function updateCdtUserGroup(CdtUserGroup $oCdtUserGroup) { 
		$db = CdtDbManager::getConnection(); 

		
		$ds_usergroup = $oCdtUserGroup->getDs_usergroup();
		
		
		$cd_usergroup = CdtFormatUtils::ifEmpty( $oCdtUserGroup->getCd_usergroup(), 'null' );
		
		

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUP;
		
		$sql = "UPDATE $tableName SET ds_usergroup = '$ds_usergroup' WHERE cd_usergroup = $cd_usergroup "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se elimina la entity
	 * @param CdtUserGroup $oCdtUserGroup entity a eliminar.
	 */
	public static function deleteCdtUserGroup(CdtUserGroup $oCdtUserGroup) { 
		$db = CdtDbManager::getConnection(); 

		$cd_usergroup = $oCdtUserGroup->getCd_usergroup();

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUP;
		
		$sql = "DELETE FROM $tableName WHERE cd_usergroup = $cd_usergroup "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se obtiene una colecci�n de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return ItemCollection[CdtUserGroup]
	 */
	public static function getCdtUserGroups(CdtSearchCriteria $oCriteria) { 
		
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUP;

		$sql = "SELECT * FROM $tableName ";
		
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = CdtResultFactory::toCollection($db, $result, new CdtUserGroupFactory());
		$db->sql_freeresult($result);
		return $items;
	}

	
	/**
	 * se obtiene la cantidad de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return int
	 */
	public static function getCdtUserGroupsCount(CdtSearchCriteria $oCriteria) { 
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUP;
		
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
	 * @return CdtUserGroup
	 */
	public static function getCdtUserGroup(CdtSearchCriteria $oCriteria) { 

		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUP;
		
		$sql = "SELECT * FROM $tableName ";
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new CdtUserGroupFactory();
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

} 
?>
