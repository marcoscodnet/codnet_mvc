<?php 

/**
 * Acción para registrarse en el sistema.
 * 
 * @author bernardo
 * @since 09-05-2011
 * 
 */
class RegistrarseAction extends Action{

	/**
	 * se registra el usuario en el sistema (login).
	 * @return forward.
	 */
	public function execute(){
		
			
		//se conecta a la base de datos.
		
		$oUsuario = $this->getEntidad();
		
		try{
			
			DbManager::connect();
			DbManager::begin_tran();
			
			$manager = new UsuarioManager();
			$manager->registrar( $oUsuario );
			$forward = 'registrarse_success';
			
			DbManager::save();
			DbManager::close();		
			
		}catch(GenericException $ex){
			DbManager::undo();
			DbManager::close();
			$forward = $this->doForwardException( $ex, 'registrarse_error' );					
		}

		
		
		return $forward;
	}
	
	protected function getEntidad(){
		$oUsuario = new Usuario ( );
		
		if (isset ( $_POST ['cd_usuario'] ))
			$oUsuario->setCd_usuario (  FormatUtils::getParamPOST('cd_usuario')  );
		
		if (isset ( $_POST ['apynom'] ))
			$oUsuario->setDs_apynom ( FormatUtils::getParamPOST('apynom') ) ;
		
		if (isset ( $_POST ['mail'] )){
			$oUsuario->setDs_mail (  FormatUtils::getParamPOST('mail') ) ;
			$oUsuario->setDs_nomusuario (  FormatUtils::getParamPOST('mail') ) ;
		}
		
		if (isset ( $_POST ['pass'] ))
			$oUsuario->setDs_password (  FormatUtils::getParamPOST('pass') ) ;
			
		if (isset ( $_POST ['pais'] ))
			$oUsuario->setCd_pais ( FormatUtils::getParamPOST('pais') ) ;

		if (isset ( $_POST ['telefono'] ))
			$oUsuario->setDs_telefono (  FormatUtils::getParamPOST('telefono') ) ;

		if (isset ( $_POST ['domicilio'] ))
			$oUsuario->setDs_domicilio(  FormatUtils::getParamPOST('domicilio') ) ;
			
		return $oUsuario;
	}	
	
}