<?php 

/** 
 * DAO para CdtUserGroupFunction 
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtUserGroupFunctionDAO { 

	/**
	 * se persiste la nueva entity
	 * @param CdtUserGroupFunction $oCdtUserGroupFunction entity a persistir.
	 */
	public static function addCdtUserGroupFunction(CdtUserGroupFunction $oCdtUserGroupFunction) { 
		$db = CdtDbManager::getConnection(); 

		
		
		$cd_usergroup =  CdtFormatUtils::ifEmpty( $oCdtUserGroupFunction->getCd_usergroup(), 'null' );
		
		$cd_function =  CdtFormatUtils::ifEmpty( $oCdtUserGroupFunction->getCd_function(), 'null' );
		
		
		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		
		$sql = "INSERT INTO $tableName (cd_usergroup, cd_function) VALUES($cd_usergroup, $cd_function)"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		//seteamos el nuevo id.
		$cd = $db->sql_nextid();
        $oCdtUserGroupFunction->setCd_usergroup_function( $cd );
	}


	/**
	 * se modifica la entity
	 * @param CdtUserGroupFunction $oCdtUserGroupFunction entity a modificar.
	 */
	public static function updateCdtUserGroupFunction(CdtUserGroupFunction $oCdtUserGroupFunction) { 
		$db = CdtDbManager::getConnection(); 

		
		
		$cd_usergroup_function = CdtFormatUtils::ifEmpty( $oCdtUserGroupFunction->getCd_usergroup_function(), 'null' );
		
		$cd_usergroup = CdtFormatUtils::ifEmpty( $oCdtUserGroupFunction->getCd_usergroup(), 'null' );
		
		$cd_function = CdtFormatUtils::ifEmpty( $oCdtUserGroupFunction->getCd_function(), 'null' );
		
		

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		
		$sql = "UPDATE $tableName SET cd_usergroup = $cd_usergroup, cd_function = $cd_function WHERE cd_usergroup_function = $cd_usergroup_function "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se elimina la entity
	 * @param CdtUserGroupFunction $oCdtUserGroupFunction entity a eliminar.
	 */
	public static function deleteCdtUserGroupFunction(CdtUserGroupFunction $oCdtUserGroupFunction) { 
		$db = CdtDbManager::getConnection(); 

		$cd_usergroup_function = $oCdtUserGroupFunction->getCd_usergroup_function();

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		
		$sql = "DELETE FROM $tableName WHERE cd_usergroup_function = $cd_usergroup_function "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se obtiene una colecci�n de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return ItemCollection[CdtUserGroupFunction]
	 */
	public static function getCdtUserGroupFunctions(CdtSearchCriteria $oCriteria) { 
		
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;
		$tableNameUserGroup = CDT_SECURE_TABLE_CDTUSERGROUP;
		
		$sql = "SELECT UGF.* ";
		$sql .= ", UG.cd_usergroup as UG_cd_usergroup, UG.ds_usergroup as UG_ds_usergroup ";
		$sql .= ", F.cd_function as F_cd_function, F.ds_function as F_ds_function ";
		$sql .= " FROM $tableName UGF ";
		$sql .= " LEFT JOIN $tableNameUserGroup UG ON(UG.cd_usergroup=UGF.cd_usergroup) ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.cd_function=UGF.cd_function) ";
		
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = CdtResultFactory::toCollection($db, $result, new CdtUserGroupFunctionFactory("UG", "F"));
		$db->sql_freeresult($result);
		return $items;
	}

	
	/**
	 * se obtiene la cantidad de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return int
	 */
	public static function getCdtUserGroupFunctionsCount(CdtSearchCriteria $oCriteria) { 
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		
		 
		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;
		$tableNameUserGroup = CDT_SECURE_TABLE_CDTUSERGROUP;
		
		$sql = "SELECT count(*) as count FROM $tableName UGF ";
		$sql .= " LEFT JOIN $tableNameUserGroup UG ON(UG.cd_usergroup=UGF.cd_usergroup) ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.cd_function=UGF.cd_function) ";
		
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
	 * @return CdtUserGroupFunction
	 */
	public static function getCdtUserGroupFunction(CdtSearchCriteria $oCriteria) { 

		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;
		$tableNameUserGroup = CDT_SECURE_TABLE_CDTUSERGROUP;
		
		$sql = "SELECT UGF.* ";
		$sql .= ", UG.cd_usergroup as UG_cd_usergroup, UG.ds_usergroup as UG_ds_usergroup ";
		$sql .= ", F.cd_function as F_cd_function, F.ds_function as F_ds_function ";
		$sql .= " FROM $tableName UGF ";
		$sql .= " LEFT JOIN $tableNameUserGroup UG ON(UG.cd_usergroup=UGF.cd_usergroup) ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.cd_function=UGF.cd_function) ";
				 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new CdtUserGroupFunctionFactory("UG","F");
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

	public static function deleteCdtUserGroupFunctions(CdtUserGroup $oCdtUserGroup) { 
		$db = CdtDbManager::getConnection(); 

		$cd_usergroup = $oCdtUserGroup->getCd_usergroup();

		$tableName = CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION;
		
		$sql = "DELETE FROM $tableName WHERE cd_usergroup = $cd_usergroup "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}
	
} 
?>
