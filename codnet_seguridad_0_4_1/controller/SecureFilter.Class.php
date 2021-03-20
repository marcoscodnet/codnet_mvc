<?php

/**
 * Filtro para validar la seguridad.
 * 
 * @author bernardo
 * @since 04-07-2011
 */
class SecureFilter implements ActionFilter{

	public function apply( $ds_action_name, $oAction ){
		$tienePermiso = true;
				
		$oAccionFuncion = $this->getAccionFuncion( $ds_action_name );
		
		if($oAccionFuncion!=null){
			
			if(!SeguridadUtils::isUsuarioLogueado())
				throw new FailureException('login_init','Debe loguearse en el sistema');

			$oUsuario = SeguridadUtils::getUsuarioLogueado();
				
			//chequeamos el permiso para ejecutar la acción.
			$manager = new UsuarioManager();
			$tienePermiso = $manager->tienePermiso ( $oUsuario->getCd_usuario(), $oAccionFuncion->getCd_funcion() );

			if (!$tienePermiso)
				//si no tiene permiso, forward a la página de acceso denegado.
				throw new FailureException('acceso_denegado','No tiene permisos para ejecutar la acción');
		}else{
			
		}	
	}
	
	public function getAccionFuncion( $ds_action_name ){
		$manager = new AccionFuncionManager();
		$criterio = new CriterioBusqueda();
		$criterio->addFiltro( 'ds_accion', $ds_action_name, "=", new FormatValorString() );
		$oAF = $manager->getAccionFuncion( $criterio );		
		return $oAF;
	}
	
}