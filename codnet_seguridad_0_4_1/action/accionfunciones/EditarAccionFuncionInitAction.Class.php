<?php 

/**
 * AcciÃ³n para inicializar el contexto para editar
 * un AccionFuncion.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
abstract class EditarAccionFuncionInitAction  extends EditarInitAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getXTemplate()
	 */
	protected function getXTemplate(){
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_EDITAR_ACCIONFUNCION );		
	}

	
	protected function getEntidad(){
		
		//se construye el AccionFuncion a modificar.
		$oAccionFuncion = new AccionFuncion ( );
	
				
		$oAccionFuncion->setCd_accionfuncion ( FormatUtils::getParamPOST('cd_accionfuncion') );	
				
		$oAccionFuncion->setCd_funcion ( FormatUtils::getParamPOST('cd_funcion') );	
				
		$oAccionFuncion->setDs_accion ( FormatUtils::getParamPOST('ds_accion') );	
		
		
		return $oAccionFuncion;
	}	
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#parseEntidad($entidad, $xtpl)
	 */
	protected function parseEntidad($entidad, XTemplate $xtpl){
		$oAccionFuncion = FormatUtils::ifEmpty($entidad, new AccionFuncion());

				
		$xtpl->assign ( 'cd_accionfuncion', stripslashes ( $oAccionFuncion->getCd_accionfuncion () ) );
		$xtpl->assign ( 'cd_accionfuncion_label', CDT_SEGURIDAD_ACCIONFUNCION_CD_ACCIONFUNCION );
				
		$xtpl->assign ( 'ds_accion_label', CDT_SEGURIDAD_ACCIONFUNCION_DS_ACCION );
		$selected =  $oAccionFuncion->getDs_accion();
		$this->parseAccion($selected, $xtpl );
		
		
		$xtpl->assign ( 'cd_funcion_label', CDT_SEGURIDAD_ACCIONFUNCION_CD_FUNCION );
		$selected =  $oAccionFuncion->getCd_funcion();
		$this->parseFuncion($selected, $xtpl );
		
		

	}

	
	protected function parseFuncion($selected, XTemplate $xtpl ){
	
		$manager = new FuncionManager();
		$criterio = new CriterioBusqueda();
		$criterio->addOrden("ds_funcion");
		$funciones = $manager->getFunciones( $criterio );
		
		foreach($funciones as $key => $oFuncion) {
		
			$xtpl->assign ( 'ds_funcion', $oFuncion->getDs_funcion() );
			$xtpl->assign ( 'cd_funcion', FormatUtils::selected($oFuncion->getCd_funcion(), $selected ) );
			
			$xtpl->parse ( 'main.funciones_option' );
		}	
	}
	

	
	protected function parseAccion($selected, XTemplate $xtpl ){
	
		//leventamos las acciones desde la navegación.
		$map = new ActionMapHelper();
		$actions = $map->getActions();
		ksort($actions);
		
		//quitar las que ya están mapeadas a alguna función.
		$manager = new AccionFuncionManager();
		$criterio = new CriterioBusqueda();
		$criterio->addOrden('ds_accion');
		$accionFunciones = $manager->getAccionFunciones( $criterio );
		
		foreach ($actions as $nombre => $variable) {
			
			if(!$this->existe( $accionFunciones, $nombre )){
				$xtpl->assign ( 'ds_accion', $nombre );
				$xtpl->assign ( 'cd_accion',  FormatUtils::selected($nombre, $selected ) );
				
				$xtpl->parse ( 'main.acciones_option' );
			}
		}
	
	}
	
	private function existe($accionFunciones, $nombre){
		foreach ($accionFunciones as $oAccionFuncion) {
			if($oAccionFuncion->getDs_accion()==$nombre)
				return true;
		}
		return false;
	}
	
}
