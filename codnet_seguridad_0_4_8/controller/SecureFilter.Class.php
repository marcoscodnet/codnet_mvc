<?php

/**
 * Filtro para validar la seguridad.
 * 
 * @author bernardo
 * @since 04-07-2011
 */
class SecureFilter implements ActionFilter{

	public function apply( $ds_action_name, $oAction){
		
		$tienePermiso = true;

		$oAccionFuncion = $this->getAccionFuncion( $ds_action_name );
		
		if($oAccionFuncion!=null){
			
			if(!SeguridadUtils::isUsuarioLogueado())
				$this->loginRequerido();

			$oUsuario = SeguridadUtils::getUsuarioLogueado();
				
			//chequeamos el permiso para ejecutar la acción.
			$manager = new UsuarioManager();
			$tienePermiso = $manager->tienePermiso ( $oUsuario->getCd_usuario(), $oAccionFuncion->getCd_funcion() );

			if (!$tienePermiso)
				//si no tiene permiso, forward a la página de acceso denegado.
				throw new FailureException( $this->getAccionSinPermisos() , CDT_SEGURIDAD_MSG_USUARIO_SIN_PERMISOS);
		}else{
				
		}	
	}
	
	protected function loginRequerido(){ 
		
		$_GET['backTo'] = $_SERVER['REQUEST_URI'];
		
		//$_GET ['msg'] = 'Debe loguearse en el sistema';
		//$_GET ['code'] = 1;
		throw new FailureException( $this->getAccionLogin(), CDT_SEGURIDAD_MSG_DEBE_LOGUEARSE );
						
	}	
		
	public function getAccionFuncion( $ds_action_name ){
		$manager = new AccionFuncionManager();
		$criterio = new CriterioBusqueda();
		$criterio->addFiltro( 'ds_accion', $ds_action_name, "=", new FormatValorString() );
		$oAF = $manager->getAccionFuncion( $criterio );

		return $oAF;
	}
	
	protected function getAccionLogin(){
		return CDT_SEGURIDAD_LOGIN_INIT_ACTION;
	}
	
	protected function getAccionSinPermisos(){
		return CDT_SEGURIDAD_ACCESO_DENEGADO_ACTION;
	}
	
}