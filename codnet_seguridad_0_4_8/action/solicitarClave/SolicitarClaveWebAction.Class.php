<?php 

/**
 * Acción para solicitar una nueva clave.
 * 
 * @author bernardo
 * @since 12-09-2011
 * 
 */
class SolicitarClaveWebAction extends Action{

	/**
	 * se genera una nueva clave para un usuario.
	 * @return forward.
	 */
	public function execute(){
		
		$ds_email = FormatUtils::getParamPOST('ds_email');
		
		
		try{
			
			$manager = new UsuarioManager();
			$manager->solicitarClave( $ds_email );
			
			$forward = 'solicitar_clave_web_success';
			
		}catch(GenericException $ex){
			DbManager::undo();
			$forward = $this->doForwardException( $ex, 'solicitar_clave_web_error' );			
		}
		
		
		return $forward;
	}
	
}