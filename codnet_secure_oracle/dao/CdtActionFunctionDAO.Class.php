<?php 

/** 
 * DAO para CdtActionFunction 
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtActionFunctionDAO { 

	/**
	 * se persiste la nueva entity
	 * @param CdtActionFunction $oCdtActionFunction entity a persistir.
	 */
	public static function addCdtActionFunction(CdtActionFunction $oCdtActionFunction) { 
		$db = CdtDbManager::getConnection(); 

		
		$ds_action = $oCdtActionFunction->getDs_action();
		
		
		$cd_function =  CdtFormatUtils::ifEmpty( $oCdtActionFunction->getCd_function(), 'null' );
		
		
		$tableName = CDT_SECURE_TABLE_CDTACTIONFUNCTION;
		
		$sql = "INSERT INTO $tableName (cd_function, ds_action) VALUES($cd_function, '$ds_action')"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		//seteamos el nuevo id.
		$cd = $db->sql_nextid();
        $oCdtActionFunction->setCd_actionfunction( $cd );
	}


	/**
	 * se modifica la entity
	 * @param CdtActionFunction $oCdtActionFunction entity a modificar.
	 */
	public static function updateCdtActionFunction(CdtActionFunction $oCdtActionFunction) { 
		$db = CdtDbManager::getConnection(); 

		
		$ds_action = $oCdtActionFunction->getDs_action();
		
		
		$cd_actionfunction = CdtFormatUtils::ifEmpty( $oCdtActionFunction->getCd_actionfunction(), 'null' );
		
		$cd_function = CdtFormatUtils::ifEmpty( $oCdtActionFunction->getCd_function(), 'null' );
		
		

		$tableName = CDT_SECURE_TABLE_CDTACTIONFUNCTION;
		
		$sql = "UPDATE $tableName SET cd_function = $cd_function, ds_action = '$ds_action' WHERE cd_actionfunction = $cd_actionfunction "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se elimina la entity
	 * @param CdtActionFunction $oCdtActionFunction entity a eliminar.
	 */
	public static function deleteCdtActionFunction(CdtActionFunction $oCdtActionFunction) { 
		$db = CdtDbManager::getConnection(); 

		$cd_actionfunction = $oCdtActionFunction->getCd_actionfunction();

		$tableName = CDT_SECURE_TABLE_CDTACTIONFUNCTION;
		
		$sql = "DELETE FROM $tableName WHERE cd_actionfunction = $cd_actionfunction "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se obtiene una colecci�n de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return ItemCollection[CdtActionFunction]
	 */
	public static function getCdtActionFunctions(CdtSearchCriteria $oCriteria) { 
		
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTACTIONFUNCTION;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;

		$sql = "SELECT AF.* ";
		$sql .= ", F.cd_function as F_cd_function, F.ds_function as F_ds_function ";
		$sql .= " FROM $tableName AF ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.cd_function=AF.cd_function) ";
		
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = CdtResultFactory::toCollection($db, $result, new CdtActionFunctionFactory("F"));
		$db->sql_freeresult($result);
		return $items;
	}

	
	/**
	 * se obtiene la cantidad de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return int
	 */
	public static function getCdtActionFunctionsCount(CdtSearchCriteria $oCriteria) { 
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTACTIONFUNCTION;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;
		
		$sql = "SELECT count(*) as count "; 
		$sql .= " FROM $tableName AF ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.cd_function=AF.cd_function) ";
		
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
	 * @return CdtActionFunction
	 */
	public static function getCdtActionFunction(CdtSearchCriteria $oCriteria) { 

		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTACTIONFUNCTION;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;
		
		$sql = "SELECT AF.* ";
		$sql .= ", F.cd_function as F_cd_function, F.ds_function as F_ds_function ";
		$sql .= " FROM $tableName AF, $tableNameFunction F ";
		//$sql .= " LEFT JOIN $tableNameFunction F ON(F.cd_function=AF.cd_function) ";
		$oCriteria->addFilter('F.cd_function', 'AF.cd_function(+)', '=');
		
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new CdtActionFunctionFactory("F");
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

} 
?>
