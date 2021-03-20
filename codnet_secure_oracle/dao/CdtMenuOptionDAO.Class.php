<?php 

/** 
 * DAO para CdtMenuOption 
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtMenuOptionDAO { 

	/**
	 * se persiste la nueva entity
	 * @param CdtMenuOption $oCdtMenuOption entity a persistir.
	 */
	public static function addCdtMenuOption(CdtMenuOption $oCdtMenuOption) { 
		$db = CdtDbManager::getConnection(); 

		
		$ds_name = $oCdtMenuOption->getDs_name();
		
		$ds_href = $oCdtMenuOption->getDs_href();
		
		$ds_cssclass = $oCdtMenuOption->getDs_cssclass();
		
		$ds_description = $oCdtMenuOption->getDs_description();
		
		
		$cd_function =  CdtFormatUtils::ifEmpty( $oCdtMenuOption->getCd_function(), 'null' );
		
		$nu_order =  CdtFormatUtils::ifEmpty( $oCdtMenuOption->getNu_order(), 'null' );
		
		$cd_menugroup =  CdtFormatUtils::ifEmpty( $oCdtMenuOption->getCd_menugroup(), 'null' );
		
		
		$tableName = CDT_SECURE_TABLE_CDTMENUOPTION;
		
		$sql = "INSERT INTO $tableName (ds_name, ds_href, cd_function, nu_order, cd_menugroup, ds_cssclass, ds_description) VALUES('$ds_name', '$ds_href', $cd_function, $nu_order, $cd_menugroup, '$ds_cssclass', '$ds_description')"; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		//seteamos el nuevo id.
		$cd = $db->sql_nextid();
        $oCdtMenuOption->setCd_menuoption( $cd );
	}


	/**
	 * se modifica la entity
	 * @param CdtMenuOption $oCdtMenuOption entity a modificar.
	 */
	public static function updateCdtMenuOption(CdtMenuOption $oCdtMenuOption) { 
		$db = CdtDbManager::getConnection(); 

		
		$ds_name = $oCdtMenuOption->getDs_name();
		
		$ds_href = $oCdtMenuOption->getDs_href();
		
		$ds_cssclass = $oCdtMenuOption->getDs_cssclass();
		
		$ds_description = $oCdtMenuOption->getDs_description();
		
		
		$cd_menuoption = CdtFormatUtils::ifEmpty( $oCdtMenuOption->getCd_menuoption(), 'null' );
		
		$cd_function = CdtFormatUtils::ifEmpty( $oCdtMenuOption->getCd_function(), 'null' );
		
		$nu_order = CdtFormatUtils::ifEmpty( $oCdtMenuOption->getNu_order(), 'null' );
		
		$cd_menugroup = CdtFormatUtils::ifEmpty( $oCdtMenuOption->getCd_menugroup(), 'null' );
		
		$tableName = CDT_SECURE_TABLE_CDTMENUOPTION;
		
		$sql = "UPDATE $tableName SET ds_name = '$ds_name', ds_href = '$ds_href', cd_function = $cd_function, nu_order = $nu_order, cd_menugroup = $cd_menugroup, ds_cssclass = '$ds_cssclass', ds_description = '$ds_description' WHERE cd_menuoption = $cd_menuoption "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se elimina la entity
	 * @param CdtMenuOption $oCdtMenuOption entity a eliminar.
	 */
	public static function deleteCdtMenuOption(CdtMenuOption $oCdtMenuOption) { 
		$db = CdtDbManager::getConnection(); 

		$cd_menuoption = $oCdtMenuOption->getCd_menuoption();

		$tableName = CDT_SECURE_TABLE_CDTMENUOPTION;
		
		$sql = "DELETE FROM $tableName WHERE cd_menuoption = $cd_menuoption "; 

		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

	}

	/**
	 * se obtiene una colecci�n de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return ItemCollection[CdtMenuOption]
	 */
	public static function getCdtMenuOptions(CdtSearchCriteria $oCriteria) { 
		
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTMENUOPTION;
		$tableNameMenuGroup = CDT_SECURE_TABLE_CDTMENUGROUP;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;

		$sql  = "SELECT MO.* ";
		$sql .= ", MG.cd_menugroup as MG_cd_menugroup, MG.ds_name as MG_ds_name ";
		$sql .= ", F.cd_function as F_cd_function, F.ds_function as F_ds_function ";
		$sql .= " FROM $tableName MO ";
		/*$sql .= " LEFT JOIN $tableNameMenuGroup MG ON(MG.cd_menugroup=MO.cd_menugroup) ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.cd_function=MO.cd_function) ";*/
		
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		$items = CdtResultFactory::toCollection($db, $result, new CdtMenuOptionFactory("", "MG", "F"));
		$db->sql_freeresult($result);
		return $items;
	}

	
	/**
	 * se obtiene la cantidad de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return int
	 */
	public static function getCdtMenuOptionsCount(CdtSearchCriteria $oCriteria) { 
		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTMENUOPTION;
		$tableNameMenuGroup = CDT_SECURE_TABLE_CDTMENUGROUP;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;
		
		$sql = "SELECT count(*) as count  FROM $tableName MO";
		$sql .= " LEFT JOIN $tableNameMenuGroup MG ON(MG.cd_menugroup=MO.cd_menugroup) ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.cd_function=MO.cd_function) ";
		
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
	 * @return CdtMenuOption
	 */
	public static function getCdtMenuOption(CdtSearchCriteria $oCriteria) { 

		$db = CdtDbManager::getConnection(); 

		$tableName = CDT_SECURE_TABLE_CDTMENUOPTION;
		$tableNameMenuGroup = CDT_SECURE_TABLE_CDTMENUGROUP;
		$tableNameFunction = CDT_SECURE_TABLE_CDTFUNCTION;
		
		$sql  = "SELECT MO.* ";
		$sql .= ", MG.cd_menugroup as MG_cd_menugroup, MG.ds_name as MG_ds_name ";
		$sql .= ", F.cd_function as F_cd_function, F.ds_function as F_ds_function ";
		$sql .= " FROM $tableName MO ";
		$sql .= " LEFT JOIN $tableNameMenuGroup MG ON(MG.cd_menugroup=MO.cd_menugroup) ";
		$sql .= " LEFT JOIN $tableNameFunction F ON(F.cd_function=MO.cd_function) ";
				
		 
		$sql .= $oCriteria->buildCriteria();
		
		$result = $db->sql_query($sql);
		if (!$result)//hubo un error en la bbdd.
			throw new DBException($db->sql_error());

		if ($db->sql_numrows() > 0) {
			$temp = $db->sql_fetchassoc($result);
			$factory = new CdtMenuOptionFactory("", "MG","F");
			$obj = $factory->build($temp);
		}
		$db->sql_freeresult($result);
		return $obj;
	}

} 
?>
