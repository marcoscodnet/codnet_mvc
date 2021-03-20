<?php 

/** 
 * Manager para CdtUserGroupFunction
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtUserGroupFunctionManager implements ICdtList{ 

	/**
	 * se agrega la nueva entity
	 * @param CdtUserGroupFunction $oCdtUserGroupFunction entity a agregar.
	 */
	public function addCdtUserGroupFunction(CdtUserGroupFunction $oCdtUserGroupFunction) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		CdtUserGroupFunctionDAO::addCdtUserGroupFunction($oCdtUserGroupFunction);
	}


	/**
	 * se modifica la entity
	 * @param CdtUserGroupFunction $oCdtUserGroupFunction entity a modificar.
	 */
	public function updateCdtUserGroupFunction(CdtUserGroupFunction $oCdtUserGroupFunction) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		CdtUserGroupFunctionDAO::updateCdtUserGroupFunction($oCdtUserGroupFunction);
	}


	/**
	 * se elimina la entity
	 * @param int identificador de la entity a eliminar.
	 */
	public function deleteCdtUserGroupFunction($id) { 
	
		//se puede eliminar múltiple, así que $id puede ser una colección de ids.
		$ids = explode( ",", $id);
		
		foreach ($ids as $next) {

			$oCdtUserGroupFunction = new CdtUserGroupFunction();
			$oCdtUserGroupFunction->setCd_usergroup_function($next);
			CdtUserGroupFunctionDAO::deleteCdtUserGroupFunction($oCdtUserGroupFunction);
		} 

		
	}

	
	/**
	 * se obtiene una colecciï¿½n de entities dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return ItemCollection[CdtUserGroupFunction]
	 */
	public function getCdtUserGroupFunctions(CdtSearchCriteria $oCriteria) { 
		return CdtUserGroupFunctionDAO::getCdtUserGroupFunctions($oCriteria); 
	}


	/**
	 * se obtiene la cantidad de entities dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return int
	 */
	public function getCdtUserGroupFunctionsCount(CdtSearchCriteria $oCriteria) { 
		return CdtUserGroupFunctionDAO::getCdtUserGroupFunctionsCount($oCriteria); 
	}


	/**
	 * se obtiene un entity dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return CdtUserGroupFunction
	 */
	public function getCdtUserGroupFunction(CdtSearchCriteria $oCriteria) { 
		return CdtUserGroupFunctionDAO::getCdtUserGroupFunction($oCriteria); 
	}

	//	interface ICdtList

	
	/**
	 * (non-PHPdoc)
	 * @see ICdtList::getEntities();
	 */
	public function getEntities( CdtSearchCriteria $oCriteria) { 
		return $this->getCdtUserGroupFunctions($oCriteria); 
	}

	
	/**
	 * (non-PHPdoc)
	 * @see ICdtList::getEntitiesCount();
	 */
	public function getEntitiesCount ( CdtSearchCriteria $oCriteria ) { 
		return $this->getCdtUserGroupFunctionsCount($oCriteria); 
	}


	public function assignCdtUserGroupFunctions(CdtUserGroup $oUserGroup, $functions ){
		
		//eliminamos las funciones que tenía asignadas.
		CdtUserGroupFunctionDAO::deleteCdtUserGroupFunctions( $oUserGroup );
		
		//agregamos las nuevas.
		if( !empty($functions) ){
			foreach ($functions as $id) {
				
				$oCdtUserGroupFunction = new CdtUserGroupFunction();
				$oCdtUserGroupFunction->setCdtUserGroup( $oUserGroup );
				$oCdtUserGroupFunction->setCd_function( $id );
				
				CdtUserGroupFunctionDAO::addCdtUserGroupFunction( $oCdtUserGroupFunction );
			}
		}
	}
} 
?>
