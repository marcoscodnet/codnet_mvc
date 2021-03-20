<?php 

/** 
 * Manager para CdtUserGroup
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtUserGroupManager implements ICdtList{ 

	/**
	 * se agrega la nueva entity
	 * @param CdtUserGroup $oCdtUserGroup entity a agregar.
	 */
	public function addCdtUserGroup(CdtUserGroup $oCdtUserGroup) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		CdtUserGroupDAO::addCdtUserGroup($oCdtUserGroup);
	}


	/**
	 * se modifica la entity
	 * @param CdtUserGroup $oCdtUserGroup entity a modificar.
	 */
	public function updateCdtUserGroup(CdtUserGroup $oCdtUserGroup) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		CdtUserGroupDAO::updateCdtUserGroup($oCdtUserGroup);
	}


	/**
	 * se elimina la entity
	 * @param int identificador de la entity a eliminar.
	 */
	public function deleteCdtUserGroup($id) { 

		//se puede eliminar múltiple, así que $id puede ser una colección de ids.
		$ids = explode( ",", $id);
		
		foreach ($ids as $next) {

			//validaciones para el delete.
			$this->validateOnDelete( $next );
			
			//eliminamos las relaciones con las funciones
			$oCdtUserGroup = new CdtUserGroup();
			$oCdtUserGroup->setCd_usergroup( $next );
			CdtUserGroupFunctionDAO::deleteCdtUserGroupFunctions( $oCdtUserGroup );
			
			//eliminamos el usergroup.
			$oCdtUserGroup = new CdtUserGroup();
			$oCdtUserGroup->setCd_usergroup($next);
			CdtUserGroupDAO::deleteCdtUserGroup($oCdtUserGroup);
		}
		
		
	}

	private function validateOnDelete( $id ){
		
		//validamos que no tenga users asociados.
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter( "UG.cd_usergroup", $id, "=" );
		$oManager = new CdtUserManager();
		$count = $oManager->getCdtUsersCount( $oCriteria );
		if( $count > 0)
			throw new GenericException( CDT_SECURE_MSG_EXCEPTION_CANNOT_DELETE_ITEMS_RELATED );
					
	}
	
	/**
	 * se obtiene una colecciï¿½n de entities dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return ItemCollection[CdtUserGroup]
	 */
	public function getCdtUserGroups(CdtSearchCriteria $oCriteria) { 
		return CdtUserGroupDAO::getCdtUserGroups($oCriteria); 
	}


	/**
	 * se obtiene la cantidad de entities dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return int
	 */
	public function getCdtUserGroupsCount(CdtSearchCriteria $oCriteria) { 
		return CdtUserGroupDAO::getCdtUserGroupsCount($oCriteria); 
	}


	/**
	 * se obtiene un entity dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return CdtUserGroup
	 */
	public function getCdtUserGroup(CdtSearchCriteria $oCriteria) { 
		return CdtUserGroupDAO::getCdtUserGroup($oCriteria); 
	}

	/**
	 * se obtiene un entity dado el id
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return CdtUserGroup
	 */
	public function getCdtUserGroupById( $code ) {
		
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('cd_usergroup', $code, "=", new CdtCriteriaFormatValue());
		
		return CdtUserGroupDAO::getCdtUserGroup($oCriteria); 
	}
	
	//	interface ICdtList

	
	/**
	 * (non-PHPdoc)
	 * @see ICdtList::getEntities();
	 */
	public function getEntities( CdtSearchCriteria $oCriteria) { 
		return $this->getCdtUserGroups($oCriteria); 
	}

	
	/**
	 * (non-PHPdoc)
	 * @see ICdtList::getEntitiesCount();
	 */
	public function getEntitiesCount ( CdtSearchCriteria $oCriteria ) { 
		return $this->getCdtUserGroupsCount($oCriteria); 
	}


} 
?>
