<?php 

/** 
 * Autogenerated class 
 *  
 *  @author modelBuilder 
 *  @since 04-07-2011 
 */ 
class FuncionManager implements IListar{ 

	public function agregarFuncion(Funcion $oFuncion) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		FuncionDAO::insertarFuncion($oFuncion);
	}


	public function modificarFuncion(Funcion $oFuncion) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		FuncionDAO::modificarFuncion($oFuncion);
	}


	public static function eliminarFuncion($id) { 
		//TODO validaciones; 

		$oFuncion = new Funcion();
		$oFuncion->setCd_funcion($id);
		FuncionDAO::eliminarFuncion($oFuncion);
	}


	public function getFunciones(CriterioBusqueda $criterio) { 
		return FuncionDAO::getFunciones($criterio); 
	}


	public function getCantFunciones(CriterioBusqueda $criterio) { 
		return FuncionDAO::getCantFunciones($criterio); 
	}


	public function getFuncion(CriterioBusqueda $criterio) { 
		return FuncionDAO::getFuncion($criterio); 
	}

	//	interface IListar 
	public function getEntidades(CriterioBusqueda $criterio) { 
		return $this->getFunciones($criterio); 
	}


	public function getCantidadEntidades(CriterioBusqueda $criterio) { 
		return $this->getCantFunciones($criterio); 
	}


} 
?>
