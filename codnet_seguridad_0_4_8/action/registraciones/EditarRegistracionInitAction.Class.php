<?php 

/**
 * Acción para inicializar el contexto para editar
 * un registracion.
 * 
 * @author modelBuilder
 * @since 13-07-2011
 * 
 */
abstract class EditarRegistracionInitAction  extends EditarInitAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getXTemplate()
	 */
	protected function getXTemplate(){
		return new XTemplate (CDT_SEGURIDAD_TEMPLATE_EDITAR_REGISTRACION );		
	}

	
	protected function getEntidad(){
		
		//se construye el registracion a modificar.
		$oRegistracion = new Registracion ( );
	
				
		$oRegistracion->setCd_registracion ( FormatUtils::getParamPOST('cd_registracion') );	
				
		$oRegistracion->setDs_codigoactivacion ( FormatUtils::getParamPOST('ds_codigoactivacion') );	
				
		$oRegistracion->setDt_fecha ( FormatUtils::getParamPOST('dt_fecha') );	
				
		$oRegistracion->setDs_nomusuario ( FormatUtils::getParamPOST('ds_nomusuario') );	
				
		$oRegistracion->setDs_apynom ( FormatUtils::getParamPOST('ds_apynom') );	
				
		$oRegistracion->setDs_mail ( FormatUtils::getParamPOST('ds_mail') );	
				
		$oRegistracion->setDs_password ( FormatUtils::getParamPOST('ds_password') );	
				
		$oRegistracion->setCd_pais ( FormatUtils::getParamPOST('cd_pais') );	
				
		$oRegistracion->setDs_telefono ( FormatUtils::getParamPOST('ds_telefono') );	
				
		$oRegistracion->setDs_domicilio ( FormatUtils::getParamPOST('ds_domicilio') );	
		
		
		return $oRegistracion;
	}	
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#parseEntidad($entidad, $xtpl)
	 */
	protected function parseEntidad($entidad, XTemplate $xtpl){
		$oRegistracion = FormatUtils::ifEmpty($entidad, new Registracion());

				
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
				
		$xtpl->assign ( 'ds_telefono', stripslashes ( $oRegistracion->getDs_telefono () ) );
		$xtpl->assign ( 'ds_telefono_label', CDT_SEGURIDAD_REGISTRACION_DS_TELEFONO );
				
		$xtpl->assign ( 'ds_domicilio', stripslashes ( $oRegistracion->getDs_domicilio () ) );
		$xtpl->assign ( 'ds_domicilio_label', CDT_SEGURIDAD_REGISTRACION_DS_DOMICILIO );
		
		
		
		$xtpl->assign ( 'cd_pais_label', CDT_SEGURIDAD_REGISTRACION_CD_PAIS );
		$selected =  $oRegistracion->getCd_pais();
		$this->parsePais($selected, $xtpl );
		
		

	}

	
	protected function parsePais($selected, XTemplate $xtpl ){
	
		$manager = new PaisManager();
		$criterio = new CriterioBusqueda();
		$paises = $manager->getPaises( $criterio );
		
		foreach($paises as $key => $oPais) {
		
			$xtpl->assign ( 'ds_pais', $oPais->getDs_pais() );
			$xtpl->assign ( 'cd_pais', FormatUtils::selected($oPais->getCd_pais(), $selected ) );
			
			$xtpl->parse ( 'main.paises_option' );
		}	
	}
	

}
