<?php 

/**
 * Acción para visualizar un accionFuncion.
 *  
 * @author modelBuilder
 * @since 07-07-2011
 * 
 */
class VerAccionFuncionAction extends OutputAction{

	/**
	 * consulta un accionFuncion.
	 */
	protected function getContenido(){
			
		$xtpl = $this->getXTemplate ();
		
		if (isset ( $_GET ['id'] )) {
			$cd_accionFuncion = FormatUtils::getParam('id');
			
			
			try{
				$id = FormatUtils::getParam('id');			
			
				$criterio = new CriterioBusqueda();
				$criterio->addFiltro('cd_accionfuncion', $id, '=');
			
				$manager = new AccionFuncionManager();
				$oAccionFuncion = $manager->getAccionFuncion( $criterio );
				
			}catch(GenericException $ex){
				$oAccionFuncion = new AccionFuncion();
				//TODO ver si se muestra un mensaje de error.
			}			

			//se muestra el accionFuncion.
			$this->parseEntidad( $xtpl, $oAccionFuncion );
			
			
		}
		
		$xtpl->assign ( 'titulo', 'Detalle de AccionFuncion' );
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
	}

	protected function getTitulo(){
		return "Ver AccionFuncion";
	}

	public function getXTemplate(){ 
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_VER_ACCIONFUNCION );
	}
	
	public function parseEntidad($xtpl, $oAccionFuncion){ 

				
		$xtpl->assign ( 'cd_accionfuncion', stripslashes ( $oAccionFuncion->getCd_accionfuncion () ) );
		$xtpl->assign ( 'cd_accionfuncion_label', CDT_SEGURIDAD_ACCIONFUNCION_CD_ACCIONFUNCION );
				
		$xtpl->assign ( 'cd_funcion', stripslashes ( $oAccionFuncion->getCd_funcion () ) );
		$xtpl->assign ( 'cd_funcion_label', CDT_SEGURIDAD_ACCIONFUNCION_CD_FUNCION );
				
		$xtpl->assign ( 'ds_accion', stripslashes ( $oAccionFuncion->getDs_accion () ) );
		$xtpl->assign ( 'ds_accion_label', CDT_SEGURIDAD_ACCIONFUNCION_DS_ACCION );
		
		
	}
}
