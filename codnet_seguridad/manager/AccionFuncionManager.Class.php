<?php 

/** 
 * Autogenerated class 
 *  
 *  @author modelBuilder 
 *  @since 04-07-2011 
 */ 
class AccionFuncionManager implements IListar{ 

	public function agregarAccionFuncion(AccionFuncion $oAccionFuncion) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		AccionFuncionDAO::insertarAccionFuncion($oAccionFuncion);
	}


	public function modificarAccionFuncion(AccionFuncion $oAccionFuncion) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		AccionFuncionDAO::modificarAccionFuncion($oAccionFuncion);
	}


	public static function eliminarAccionFuncion($id) { 
		//TODO validaciones; 

		$oAccionFuncion = new AccionFuncion();
		$oAccionFuncion->setCd_accionfuncion($id);
		AccionFuncionDAO::eliminarAccionFuncion($oAccionFuncion);
	}


	public function getAccionFunciones(CriterioBusqueda $criterio) { 
		return AccionFuncionDAO::getAccionFunciones($criterio); 
	}


	public function getCantAccionFunciones(CriterioBusqueda $criterio) { 
		return AccionFuncionDAO::getCantAccionFunciones($criterio); 
	}


	public function getAccionFuncion(CriterioBusqueda $criterio) { 
		return AccionFuncionDAO::getAccionFuncion($criterio); 
	}

	public function getAccionesNavegacion( $text ){
		
		//leventamos las acciones desde la navegación.
		$map = new ActionMapHelper();
		$actions = $map->getActions();
		ksort($actions);
		
		$result = array();
		foreach ($actions as $nombre => $variable) {

			if(strlen($nombre)>=strlen($text)){
 				$strSub = substr($nombre,0,strlen($text));
 				$ok = ( strtolower($strSub)==strtolower($text));
 				if($ok){
 					$item['nombre']=$nombre;
 					$item['clase']=$variable;
 					$result[] = $item;
 				} 			
 			}
		}
		return $result;
	}
	
	//	interface IListar 
	public function getEntidades(CriterioBusqueda $criterio) { 
		return $this->getAccionFunciones($criterio); 
	}


	public function getCantidadEntidades(CriterioBusqueda $criterio) { 
		return $this->getCantAccionFunciones($criterio); 
	}


} 
?>
