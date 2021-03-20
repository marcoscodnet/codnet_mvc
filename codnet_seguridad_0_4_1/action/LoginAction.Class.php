<?php 

/**
 * Acción para loguearse en el sistema.
 * 
 * @author bernardo
 * @since 16-03-2010
 * 
 */
class LoginAction extends Action{

	/**
	 * se registra el usuario en el sistema (login).
	 * @return forward.
	 */
	public function execute(){
		if (isset ( $_POST ['usuario'] ))
			$nomusuario = InputFilter::urlEncode( FormatUtils::getParamPOST('usuario') );
		 else
			$nomusuario = '';
		
		if (isset ( $_POST ['pass'] ))
			$password = InputFilter::urlEncode( FormatUtils::getParamPOST('pass')) ; 
		else
			$password = '';
		
		try{
			DbManager::connect();
			$manager = new UsuarioManager();
			$manager->login($nomusuario,$password);
			
			
			$forward = 'login_success';
			//se cierra la conexión.
			DbManager::close();		
		}catch(GenericException $ex){
			
			DbManager::undo();
			DbManager::close();
			$forward = $this->doForwardException( $ex, 'login_error');
		}
		
		return $forward;
	}
	
	
}