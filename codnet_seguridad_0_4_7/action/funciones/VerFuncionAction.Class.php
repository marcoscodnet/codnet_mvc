<?php 

/**
 * Acción para visualizar un funcion.
 *  
 * @author modelBuilder
 * @since 07-07-2011
 * 
 */
class VerFuncionAction extends OutputAction{

	/**
	 * consulta un funcion.
	 */
	protected function getContenido(){
			
		$xtpl = $this->getXTemplate ();
		
		if (isset ( $_GET ['id'] )) {
			$cd_funcion = FormatUtils::getParam('id');
			
			
			try{
				$id = FormatUtils::getParam('id');			
			
				$criterio = new CriterioBusqueda();
				$criterio->addFiltro('cd_funcion', $id, '=');
			
				$manager = new FuncionManager();
				$oFuncion = $manager->getFuncion( $criterio );
				
			}catch(GenericException $ex){
				$oFuncion = new Funcion();
				//TODO ver si se muestra un mensaje de error.
			}			

			//se muestra el funcion.
			$this->parseEntidad( $xtpl, $oFuncion );
			
			
		}
		
		$xtpl->assign ( 'titulo', 'Detalle de Funcion' );
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
	}

	protected function getTitulo(){
		return "Ver Funcion";
	}

	public function getXTemplate(){ 
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_VER_FUNCION );
	}
	
	public function parseEntidad($xtpl, $oFuncion){ 

				
		$xtpl->assign ( 'cd_funcion', stripslashes ( $oFuncion->getCd_funcion () ) );
		$xtpl->assign ( 'cd_funcion_label', CDT_SEGURIDAD_FUNCION_CD_FUNCION );
				
		$xtpl->assign ( 'ds_funcion', stripslashes ( $oFuncion->getDs_funcion () ) );
		$xtpl->assign ( 'ds_funcion_label', CDT_SEGURIDAD_FUNCION_DS_FUNCION );
		
		
	}
}
