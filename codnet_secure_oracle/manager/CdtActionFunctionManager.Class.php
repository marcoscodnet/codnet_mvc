<?php 

/** 
 * Manager para CdtActionFunction
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtActionFunctionManager implements ICdtList{ 

	/**
	 * se agrega la nueva entity
	 * @param CdtActionFunction $oCdtActionFunction entity a agregar.
	 */
	public function addCdtActionFunction(CdtActionFunction $oCdtActionFunction) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		CdtActionFunctionDAO::addCdtActionFunction($oCdtActionFunction);
	}


	/**
	 * se modifica la entity
	 * @param CdtActionFunction $oCdtActionFunction entity a modificar.
	 */
	public function updateCdtActionFunction(CdtActionFunction $oCdtActionFunction) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		CdtActionFunctionDAO::updateCdtActionFunction($oCdtActionFunction);
	}


	/**
	 * se elimina la entity
	 * @param int identificador de la entity a eliminar.
	 */
	public function deleteCdtActionFunction($id) { 

		$ids = explode( ",", $id);
		
		foreach ($ids as $next) {

			$oCdtActionFunction = new CdtActionFunction();
			$oCdtActionFunction->setCd_actionfunction($next);
			CdtActionFunctionDAO::deleteCdtActionFunction($oCdtActionFunction);
			
		}		
		
		
	}

	
	/**
	 * se obtiene una colecci�n de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return ItemCollection[CdtActionFunction]
	 */
	public function getCdtActionFunctions(CdtSearchCriteria $oCriteria) { 
		return CdtActionFunctionDAO::getCdtActionFunctions($oCriteria); 
	}


	/**
	 * se obtiene la cantidad de entities dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return int
	 */
	public function getCdtActionFunctionsCount(CdtSearchCriteria $oCriteria) { 
		return CdtActionFunctionDAO::getCdtActionFunctionsCount($oCriteria); 
	}


	/**
	 * se obtiene un entity dado el filtro de b�squeda
	 * @param CdtSearchCriteria $oCriteria filtro de b�squeda.
	 * @return CdtActionFunction
	 */
	public function getCdtActionFunction(CdtSearchCriteria $oCriteria) { 
		return CdtActionFunctionDAO::getCdtActionFunction($oCriteria); 
	}

	//	interface ICdtList

	
	/**
	 * (non-PHPdoc)
	 * @see ICdtList::getEntities();
	 */
	public function getEntities( CdtSearchCriteria $oCriteria) { 
		return $this->getCdtActionFunctions($oCriteria); 
	}

	
	/**
	 * (non-PHPdoc)
	 * @see ICdtList::getEntitiesCount();
	 */
	public function getEntitiesCount ( CdtSearchCriteria $oCriteria ) { 
		return $this->getCdtActionFunctionsCount($oCriteria); 
	}


} 
?>
