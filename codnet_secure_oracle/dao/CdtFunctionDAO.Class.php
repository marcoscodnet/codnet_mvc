<?php 

/** 
 * DAO para CdtFunction 
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtFunctionDAO { 

	/**
	 * se persiste la nueva entity
	 * @param CdtFunction $oCdtFunction entity a persistir.
	 */
	public static function addCdtFunction(CdtFunction $oCdtFunction) { 
		$db = CdtDbManager::getConnection(); 

		
		$ds_function = $oCdtFunction->getDs_function();
		
		
		
		$tableName = CDT_SECURE_TABLE_CDTFUNCTION;
		
		$sql = "INSERT INTO $tableName (ds_function) VALUES('$ds_function')"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		//seteamos el nuevo id.
		$cd = $db->sql_nextid();
        $oCdtFunction->setCd_function( $cd );
	}


	/**
	 * se modifica la entity
	 * @param CdtFunction $oCdtFunction entity a modificar.
	 */
	public static function updateCdtFunction(CdtFunction $oCdtFunction) { 
		$db = CdtDbManager::getConnection(); 

		
		$ds_function = $oCdtFunction->getDs_function();
		
		
		$cd_function = CdtFormatUtils::ifEmpty( $oCdtFunction->getCd_function(), 'null' );
		
		

		$tableName = CDT_SECURE_TABLE_CDTFUNCTION;
		
		$sql = "UPDATE $tableName SET ds_function = '$ds_function' WHERE cd_function = $cd_function "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se elimina la entity
	 * @param CdtFunction $oCdtFunction entity a eliminar.
	 */
	public static function deleteCdtFunction(CdtFunction $oCdtFunction) { 
		$db = CdtDbManager::getConnection(); 

		$cd_function = $oCdtFunction->getCd_function();

		$tableName = CDT_SECURE_TABLE_CDTFUNCTION;
		
		$sql = "DELETE FROM $tableName WHERE cd_function = $cd_function "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se obtiene una colecci�n de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return ItemCollection[CdtFunction]
	 */
	public static function getCdtFunctions(CdtSearchCriteria $oCriteria) { 
		
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTFUNCTION;

		$sql = "SELECT * FROM $tableName ";
		//TODO left joins
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = CdtResultFactory::toCollection($db, $result, new CdtFunctionFactory());
		$db->sql_freeresult($result);
		return $items;
	}

	
	/**
	 * se obtiene la cantidad de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return int
	 */
	public static function getCdtFunctionsCount(CdtSearchCriteria $oCriteria) { 
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTFUNCTION;
		
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
	 * @return CdtFunction
	 */
	public static function getCdtFunction(CdtSearchCriteria $oCriteria) { 

		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTFUNCTION;
		
		$sql = "SELECT * FROM $tableName ";
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new CdtFunctionFactory();
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

	/**
	 * funciones asociadas al grupo del usuario.
	 * @param CdtUser $oUser
	 * @return ItemCollecion[CdtFunction]
	 */
	public static function getCdtUserFunctions(CdtUser $oUser) {
		
		$db = CdtDbManager::getConnection();
		
		$cd_user = $oUser->getCd_user();
		
		$sql = "SELECT F.* FROM ".  CDT_SECURE_TABLE_CDTUSER . " U"; 
		$sql .= " LEFT JOIN ".  CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION . " PF ON PF.cd_usergroup=U.cd_usergroup"; 
		$sql .= " LEFT JOIN ".  CDT_SECURE_TABLE_CDTFUNCTION . " F ON F.cd_function=PF.cd_function ";
		$sql .= " WHERE U.cd_user = $cd_user";
		
		$result = $db->sql_query ( $sql );
		
		if(!$result)//hubo un error en la bbdd.
			throw new DBException();
		
		$functions = CdtResultFactory::toCollection($db,$result,new CdtFunctionFactory());	
		$db->sql_freeresult($result);		
		return ($functions);
	}

	/**
	 * funciones asociadas al grupo de usuario.
	 * @param CdtUser $oUser
	 * @return ItemCollecion[CdtFunction]
	 */
	public static function getCdtUserGroupFunctions(CdtUserGroup $oUserGroup) {
		
		$db = CdtDbManager::getConnection();
		
		$cd_usergroup = $oUserGroup->getCd_usergroup();
		
		$sql = "SELECT F.* FROM ".  CDT_SECURE_TABLE_CDTUSERGROUPFUNCTION . " UGF, "; 
		$sql .= CDT_SECURE_TABLE_CDTFUNCTION . " F  ";
		$sql .= " WHERE UGF.cd_usergroup = $cd_usergroup AND F.cd_function=UGF.cd_function ";
		
		$result = $db->sql_query ( $sql );
		
		if(!$result)//hubo un error en la bbdd.
			throw new DBException();
		
		$functions = CdtResultFactory::toCollection($db,$result,new CdtFunctionFactory());	
		$db->sql_freeresult($result);		
		return ($functions);
	}		
} 
?>
