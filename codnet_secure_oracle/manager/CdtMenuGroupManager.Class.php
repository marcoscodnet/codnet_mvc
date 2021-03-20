<?php 

/** 
 * Manager para CdtMenuGroup
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtMenuGroupManager implements ICdtList{ 

	/**
	 * se agrega la nueva entity
	 * @param CdtMenuGroup $oCdtMenuGroup entity a agregar.
	 */
	public function addCdtMenuGroup(CdtMenuGroup $oCdtMenuGroup) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		CdtMenuGroupDAO::addCdtMenuGroup($oCdtMenuGroup);
	}


	/**
	 * se modifica la entity
	 * @param CdtMenuGroup $oCdtMenuGroup entity a modificar.
	 */
	public function updateCdtMenuGroup(CdtMenuGroup $oCdtMenuGroup) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		CdtMenuGroupDAO::updateCdtMenuGroup($oCdtMenuGroup);
	}


	/**
	 * se elimina la entity
	 * @param int identificador de la entity a eliminar.
	 */
	public function deleteCdtMenuGroup($id) { 

		//se puede eliminar múltiple, así que $id puede ser una colección de ids.
		$ids = explode( ",", $id);
		
		foreach ($ids as $next) {

			$this->validateOnDelete( $next );
			$oCdtMenuGroup = new CdtMenuGroup();
			$oCdtMenuGroup->setCd_menugroup($next);
			CdtMenuGroupDAO::deleteCdtMenuGroup($oCdtMenuGroup);
		}
		
	}

	private function validateOnDelete( $id ){
		
		//validamos que no tenga menuoptions.
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter( "MO.cd_menugroup", $id, "=" );
		$oManager = new CdtMenuOptionManager();
		$count = $oManager->getEntitiesCount( $oCriteria );
		if( $count > 0)
			throw new GenericException( CDT_SECURE_MSG_EXCEPTION_CANNOT_DELETE_ITEMS_RELATED );
			
	}
	
	/**
	 * se obtiene una colecciï¿½n de entities dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return ItemCollection[CdtMenuGroup]
	 */
	public function getCdtMenuGroups(CdtSearchCriteria $oCriteria) { 
		return CdtMenuGroupDAO::getCdtMenuGroups($oCriteria); 
	}


	/**
	 * se obtiene la cantidad de entities dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return int
	 */
	public function getCdtMenuGroupsCount(CdtSearchCriteria $oCriteria) { 
		return CdtMenuGroupDAO::getCdtMenuGroupsCount($oCriteria); 
	}


	/**
	 * se obtiene un entity dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return CdtMenuGroup
	 */
	public function getCdtMenuGroup(CdtSearchCriteria $oCriteria) { 
		return CdtMenuGroupDAO::getCdtMenuGroup($oCriteria); 
	}

	/**
	 * se obtiene una colecciï¿½n de entities dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return ItemCollection[CdtMenuGroup]
	 */
	public function getCdtMenuGroupsWithOptions(CdtSearchCriteria $oCriteria) { 
		$groups = CdtMenuGroupDAO::getCdtMenuGroups($oCriteria);

		$oManager = new CdtMenuOptionManager();
		
		foreach ($groups as $oMenuGroup) {
			
			$oCriteria = new CdtSearchCriteria();
			$oCriteria->addFilter( "MO.cd_menugroup", $oMenuGroup->getCd_menugroup(), "=" );
			$oCriteria->addOrder("nu_order");
			$options = $oManager->getCdtMenuOptions( $oCriteria );
			$oMenuGroup->setOptions( $options );
			
		}
		
		
		return $groups;
	}
	
	//	interface ICdtList

	
	/**
	 * (non-PHPdoc)
	 * @see ICdtList::getEntities();
	 */
	public function getEntities( CdtSearchCriteria $oCriteria) { 
		return $this->getCdtMenuGroups($oCriteria); 
	}

	
	/**
	 * (non-PHPdoc)
	 * @see ICdtList::getEntitiesCount();
	 */
	public function getEntitiesCount ( CdtSearchCriteria $oCriteria ) { 
		return $this->getCdtMenuGroupsCount($oCriteria); 
	}


} 
?>
