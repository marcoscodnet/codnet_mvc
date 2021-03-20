<?php 

/**
 * Acción para loguearse en el sistema.
 * 
 * @author bernardo
 * @since 16-03-2010
 * 
 */
class CdtLoginAction extends CdtAction{

	/**
	 * (non-PHPdoc)
	 * @see CdtAction::execute();
	 */
	public function execute(){
		
		
		$username =  CdtUtils::getParamPOST('username') ;
		
		$password = CdtUtils::getParamPOST('password') ; 
		
		try{

			$manager = new CdtUserManager();
			$oUser = $manager->getUserByUsernamePassword($username,$password);
			
			//lo dejamos en sesión.
			CdtSecureUtils::login( $oUser );
			
			//tomamos del get o del post.
			$backTo = CdtUtils::getParam('backTo', CdtUtils::getParamPOST('backTo','') );
		
			if(!empty($backTo)){
				$forward = null;
				CdtDbManager::close();
				header("Location:". $backTo);
				exit();
			}

			$forward = 'login_success';
			
		}catch(GenericException $ex){
			
			CdtDbManager::undo();
			$forward = $this->doForwardException( $ex, 'login_error');
		}
		
		return $forward;
	}
	
	
}