<?php 

/** 
 * Manager para CdtMenuOption
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtMenuOptionManager implements ICdtList{ 

	/**
	 * se agrega la nueva entity
	 * @param CdtMenuOption $oCdtMenuOption entity a agregar.
	 */
	public function addCdtMenuOption(CdtMenuOption $oCdtMenuOption) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		CdtMenuOptionDAO::addCdtMenuOption($oCdtMenuOption);
	}


	/**
	 * se modifica la entity
	 * @param CdtMenuOption $oCdtMenuOption entity a modificar.
	 */
	public function updateCdtMenuOption(CdtMenuOption $oCdtMenuOption) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		CdtMenuOptionDAO::updateCdtMenuOption($oCdtMenuOption);
	}


	/**
	 * se elimina la entity
	 * @param int identificador de la entity a eliminar.
	 */
	public  function deleteCdtMenuOption($ids) { 

		//puede venir más de un id.
		$array_ids = explode(",", $ids);
		foreach ($array_ids as $id) {
			$oCdtMenuOption = new CdtMenuOption();
			$oCdtMenuOption->setCd_menuoption($id);
			CdtMenuOptionDAO::deleteCdtMenuOption($oCdtMenuOption);
		}
		
	}

	
	/**
	 * se obtiene una colecciï¿½n de entities dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return ItemCollection[CdtMenuOption]
	 */
	public function getCdtMenuOptions(CdtSearchCriteria $oCriteria) { 
		return CdtMenuOptionDAO::getCdtMenuOptions($oCriteria); 
	}


	/**
	 * se obtiene la cantidad de entities dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return int
	 */
	public function getCdtMenuOptionsCount(CdtSearchCriteria $oCriteria) { 
		return CdtMenuOptionDAO::getCdtMenuOptionsCount($oCriteria); 
	}


	/**
	 * se obtiene un entity dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return CdtMenuOption
	 */
	public function getCdtMenuOption(CdtSearchCriteria $oCriteria) { 
		return CdtMenuOptionDAO::getCdtMenuOption($oCriteria); 
	}

	//	interface ICdtList

	
	/**
	 * (non-PHPdoc)
	 * @see ICdtList::getEntities();
	 */
	public function getEntities( CdtSearchCriteria $oCriteria) { 
		return $this->getCdtMenuOptions($oCriteria); 
	}

	
	/**
	 * (non-PHPdoc)
	 * @see ICdtList::getEntitiesCount();
	 */
	public function getEntitiesCount ( CdtSearchCriteria $oCriteria ) { 
		return $this->getCdtMenuOptionsCount($oCriteria); 
	}


} 
?>
