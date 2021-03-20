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
			
		$oUsuario = $this->getEntidad();
		
		try{
			
			DbManager::begin_tran();
			
			$manager = new UsuarioManager();
			$manager->registrar( $oUsuario );
			$forward = 'registrarse_success';
			
			DbManager::save();
			
		}catch(GenericException $ex){
			DbManager::undo();
			$forward = $this->doForwardException( $ex, 'registrarse_error' );					
		}

		
		
		return $forward;
	}
	
	protected function getEntidad(){
		
		$oUsuario = new Usuario ( );
		
		$oUsuario->setCd_usuario (  FormatUtils::getParamPOST('cd_usuario')  );
		
		$oUsuario->setDs_nomusuario( FormatUtils::getParamPOST('ds_nomusuario') ) ;
		
		$oUsuario->setDs_mail (  FormatUtils::getParamPOST('ds_mail') ) ;
		
		
		$oUsuario->setDs_password (  FormatUtils::getParamPOST('ds_password') ) ;
			
		return $oUsuario;
	}	
	
}