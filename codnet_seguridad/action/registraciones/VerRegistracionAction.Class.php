<?php 

/**
 * Acción para visualizar un registracion.
 *  
 * @author modelBuilder
 * @since 13-07-2011
 * 
 */
class VerRegistracionAction extends OutputAction{

	/**
	 * consulta un registracion.
	 */
	protected function getContenido(){
			
		$xtpl = $this->getXTemplate ();
		
		if (isset ( $_GET ['id'] )) {
			$cd_registracion = FormatUtils::getParam('id');
			
			
			try{
				$id = FormatUtils::getParam('id');			
			
				$criterio = new CriterioBusqueda();
				$criterio->addFiltro('cd_registracion', $id, '=');
			
				$manager = new RegistracionManager();
				$oRegistracion = $manager->getRegistracion( $criterio );
				
			}catch(GenericException $ex){
				$oRegistracion = new Registracion();
				//TODO ver si se muestra un mensaje de error.
			}			

			//se muestra el registracion.
			$this->parseEntidad( $xtpl, $oRegistracion );
			
			
		}
		
		$xtpl->assign ( 'titulo', 'Detalle de Registracion' );
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
	}

	protected function getTitulo(){
		return "Ver Registracion";
	}

	public function getXTemplate(){ 
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_VER_REGISTRACION );
	}
	
	public function parseEntidad($xtpl, $oRegistracion){ 

				
		$xtpl->assign ( 'cd_registracion', stripslashes ( $oRegistracion->getCd_registracion () ) );
		$xtpl->assign ( 'cd_registracion_label', CDT_SEGURIDAD_REGISTRACION_CD_REGISTRACION );
				
		$xtpl->assign ( 'ds_codigoactivacion', stripslashes ( $oRegistracion->getDs_codigoactivacion () ) );
		$xtpl->assign ( 'ds_codigoactivacion_label', CDT_SEGURIDAD_REGISTRACION_DS_CODIGOACTIVACION );
				
		$xtpl->assign ( 'dt_fecha', stripslashes ( $oRegistracion->getDt_fecha () ) );
		$xtpl->assign ( 'dt_fecha_label', CDT_SEGURIDAD_REGISTRACION_DT_FECHA );
				
		$xtpl->assign ( 'ds_nomusuario', stripslashes ( $oRegistracion->getDs_nomusuario () ) );
		$xtpl->assign ( 'ds_nomusuario_label', CDT_SEGURIDAD_REGISTRACION_DS_NOMUSUARIO );
				
		$xtpl->assign ( 'ds_apynom', stripslashes ( $oRegistracion->getDs_apynom () ) );
		$xtpl->assign ( 'ds_apynom_label', CDT_SEGURIDAD_REGISTRACION_DS_APYNOM );
				
		$xtpl->assign ( 'ds_mail', stripslashes ( $oRegistracion->getDs_mail () ) );
		$xtpl->assign ( 'ds_mail_label', CDT_SEGURIDAD_REGISTRACION_DS_MAIL );
				
		$xtpl->assign ( 'ds_password', stripslashes ( $oRegistracion->getDs_password () ) );
		$xtpl->assign ( 'ds_password_label', CDT_SEGURIDAD_REGISTRACION_DS_PASSWORD );
				
		$xtpl->assign ( 'cd_pais', stripslashes ( $oRegistracion->getCd_pais () ) );
		$xtpl->assign ( 'cd_pais_label', CDT_SEGURIDAD_REGISTRACION_CD_PAIS );
				
		$xtpl->assign ( 'ds_telefono', stripslashes ( $oRegistracion->getDs_telefono () ) );
		$xtpl->assign ( 'ds_telefono_label', CDT_SEGURIDAD_REGISTRACION_DS_TELEFONO );
				
		$xtpl->assign ( 'ds_domicilio', stripslashes ( $oRegistracion->getDs_domicilio () ) );
		$xtpl->assign ( 'ds_domicilio_label', CDT_SEGURIDAD_REGISTRACION_DS_DOMICILIO );
		
		
	}
}
