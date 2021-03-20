<?php 

/** 
 * Manager para CdtUser
 *  
 * @author codnet archetype builder
 * @since 26-10-2011
 */ 
class CdtUserManager implements ICdtList{ 


	/**
	 * se recupera un usuario por nombre y password.
	 * @param string $username nombre de usuairo
	 * @param string $password clave del usuario
	 * @return CdtUser
	 */
	public function getUserByUsernamePassword($username, $password){
		
		$oUser = $this->getUserByUsername( $username );
		
		//vemos si coincide la clave ingresada.
		$password = md5 ( $password );
		if( $password != $oUser->getDs_password() )
			throw new GenericException( CDT_SECURE_MSG_INVALID_PASSWORD);
		
		//buscamos las funciones que puede realizar el usuario.
		$oUser->setFunctions ( CdtFunctionDAO::getCdtUserFunctions( $oUser ) ) ;
		
		return $oUser;
	}

	/**
	 * se recupera un usuario por nombre.
	 * @param string $username nombre de usuairo
	 * @return CdtUser
	 */
	public function getUserByUsername( $username ){
				
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('ds_username', $username, '=', new CdtCriteriaFormatStringValue());
		
		$oUser = CdtUserDAO::getCdtUserWithUserGroup( $oCriteria );

		if( $oUser == null )
			throw new GenericException( CDT_SECURE_MSG_INVALID_USER );
			
		return $oUser;
	}

	/**
	 * se recupera un usuario por email.
	 * @param string $ds_email email del usuario
	 * @return CdtUser
	 */
	public function getUserByEmail( $ds_email ){
				
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('ds_email', $ds_email, '=', new CdtCriteriaFormatStringValue());
		
		$oUser = CdtUserDAO::getCdtUserWithUserGroup( $oCriteria );

		if( $oUser == null )
			throw new GenericException( CDT_SECURE_MSG_INVALID_USER );
			
		return $oUser;
	}
	
	/**
	 * se agrega la nueva entity
	 * @param CdtUser $oCdtUser entity a agregar.
	 */
	public function addCdtUser(CdtUser $oCdtUser, $sendEmail=false, $subject="", XTemplate $xtpl=null) {
		 
		//validaciones;
		$this->validateNewUser( $oCdtUser->getDs_username(), $oCdtUser->getDs_email() );
		
		//generamos la clave
		$newPassword =  CdtUtils::textoRadom(8) ;
		$oCdtUser->setDs_password ( md5( $newPassword ) );
		
		//persistir en la bbdd.
		CdtUserDAO::addCdtUser($oCdtUser);
		
		//enviamos el email al nuevo usuario.
		$emailTo = $oCdtUser->getDs_email();
		if( $sendEmail && !empty( $emailTo ) ){
			
			$nameTo = $oCdtUser->getDs_name();
			
			//template
			if( empty( $xtpl)  )
				$xtpl = new XTemplate( CDT_SECURE_TEMPLATE_MAIL_NEW_USER );
			
			//armamos el email.
			$bodyEmail = $this->buildNewUserEmail($oCdtUser, $newPassword, $xtpl );
			
			//subject
			if(empty($subject))
        		$subject = CDT_SECURE_MSG_NEW_USER_MAIL_SUBJECT;
        
        	//enviamos el mail.
			CdtUtils::sendMail($nameTo, $emailTo, $subject, $bodyEmail);
		}
			
		return $newPassword;
	}

	private function buildNewUserEmail( CdtUser $oUser, $newPassword, XTemplate $xtpl ){
    	
        $xtpl->assign('WEB_PATH', WEB_PATH);
        $xtpl->assign('ds_name', $oUser->getDs_name());
    	$xtpl->assign('ds_username', $oUser->getDs_username());
    	$xtpl->assign('ds_password', $newPassword );
    	
        $xtpl->parse('main');
        return $xtpl->text('main');
    }

	/**
	 * se modifica la entity
	 * @param CdtUser $oCdtUser entity a modificar.
	 */
	public function updateCdtUser(CdtUser $oCdtUser) { 
		//TODO validaciones; 
		//persistir en la bbdd.
		CdtUserDAO::updateCdtUser($oCdtUser);
		
	}

	/**
	 * se elimina la entity
	 * @param int identificador de la entity a eliminar.
	 */
	public function deleteCdtUser($id) { 
		
		//se puede eliminar múltiple, así que $id puede ser una colección de ids.
		$ids = explode( ",", $id);
		
		foreach ($ids as $next) {

			$oCdtUser = new CdtUser();
			$oCdtUser->setCd_user($next);
			CdtUserDAO::deleteCdtUser($oCdtUser);
		}
		
	}

	
	/**
	 * se obtiene una colección de entities dado el filtro de búsqueda
	 * @param CdtSearchCriteria $oCriteria filtro de búsqueda.
	 * @return ItemCollection[CdtUser]
	 */
	public function getCdtUsers(CdtSearchCriteria $oCriteria) { 
		return CdtUserDAO::getCdtUsers($oCriteria); 
	}


	/**
	 * se obtiene la cantidad de entities dado el filtro de búsqueda
	 * @param CdtSearchCriteria $oCriteria filtro de búsqueda.
	 * @return int
	 */
	public function getCdtUsersCount(CdtSearchCriteria $oCriteria) { 
		return CdtUserDAO::getCdtUsersCount($oCriteria); 
	}


	/**
	 * se obtiene un entity dado el filtro de búsqueda
	 * @param CdtSearchCriteria $oCriteria filtro de búsqueda.
	 * @return CdtUser
	 */
	public function getCdtUser(CdtSearchCriteria $oCriteria) { 
		return CdtUserDAO::getCdtUser($oCriteria); 
	}
	
	public function getCdtUserWithUserGroup( CdtSearchCriteria $oCriteria ) {
		return CdtUserDAO::getCdtUserWithUserGroup($oCriteria);		
	}

	//	interface ICdtList

	
	/**
	 * (non-PHPdoc)
	 * @see ICdtList::getEntities();
	 */
	public function getEntities( CdtSearchCriteria $oCriteria) { 
		return $this->getCdtUsers($oCriteria); 
	}

	
	/**
	 * (non-PHPdoc)
	 * @see ICdtList::getEntitiesCount();
	 */
	public function getEntitiesCount ( CdtSearchCriteria $oCriteria ) { 
		return $this->getCdtUsersCount($oCriteria); 
	}


	//TODO
	
	
	//se recupera un usuario dado su email.
	//si no existe, se da de alta.
	public function createAndGetUsuario( $ds_nomusuario){
		
		try{
			
			$oUsuario = $this->getUsuarioPorNombre( $ds_nomusuario );
					
		}catch(GenericException $ex){

			//no existe, lo creamos.
			$oUsuario = new Usuario();
			$aux = explode( '@', $ds_nomusuario);
			$oUsuario->setDs_apynom( $aux[0] );
			$oUsuario->setDs_mail( $ds_nomusuario );
			$oUsuario->setDs_password( $ds_nomusuario );
			$oUsuario->setDs_nomusuario( $ds_nomusuario );
			//setear el perfil por default.
			$oPerfil = new Perfil();
			$oPerfil->setCd_perfil( CDT_SEGURIDAD_PERFIL_DEFAULT_ID );
			$oPerfil = PerfilQuery::getPerfilPorId( $oPerfil );
			$oUsuario->setPerfil( $oPerfil );
				
			$this->agregarUsuario( $oUsuario );
			
			$oUsuario = $this->getUsuarioPorNombre( $ds_nomusuario );
		}
		
		return $oUsuario;
	}

	

	public function signup( CdtUser $oUser ){
				
		//chequeamos el captcha.
		//TODO ver cómo mejorarlo.
		
		include("libs/captcha/securimage.php");
		$img = new Securimage();
		$valid = $img->check(CdtUtils::getParamPOST('captcha'));
		if(!$valid)
			throw new CaptchaException();
		
		CdtUtils::log_debug( "signup 1 ");
		
		//creamos la registración
		$oRegistration = new CdtRegistration();
		
		$oRegistration->setDs_username( $oUser->getDs_username() );
		$oRegistration->setDs_password( $oUser->getDs_password() ); 
		$oRegistration->setDs_email( $oUser->getDs_email() );
		
		CdtUtils::log_debug( "signup 2 ");
		
		$oManager = new CdtRegistrationManager();
		$oManager->addCdtRegistration( $oRegistration );
		
				
	}	

	public function activateRegistration( $ds_activationCode ){

		$oRegistrationManager = new CdtRegistrationManager();
		
		//buscamos la registración
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('ds_activationcode', $ds_activationCode, "=", new CdtCriteriaFormatStringValue());
		
		$oRegistration = $oRegistrationManager->getCdtRegistration( $oCriteria ); 
		if($oRegistration==null || $oRegistration->getCd_registration()==0){
			throw new GenericException( CDT_SECURE_MSG_ACTIVATION_CODE_INVALID );			
		}
		
		//vemos si ya expiró
		$dt_expiredTime = $oRegistration->getDt_date();
		$dt_expiredTime= date("Ymd", strtotime("$dt_expiredTime + 30 days"));
		$dt_date = date("Ymd");
		if($dt_expiredTime < $dt_date ){
			throw new GenericException( CDT_SECURE_MSG_ACTIVATION_CODE_EXPIRED );			
		}
		
		$oUser = $oRegistration->createCdtUser();
		
		//setear el usergroup por default.
		$oUserGroupManager = new CdtUserGroupManager();
		$oUserGroup = $oUserGroupManager->getCdtUserGroupById( CDT_SECURE_USERGROUP_DEFAULT_ID );
		
		$oUser->setCdtUserGroup( $oUserGroup );
		
		//persistir el usuario en la bbdd.
		$this->addCdtUser( $oUser );		
		
		//borrar la registración.
		$oRegistrationManager->deleteCdtRegistration( $oRegistration->getCd_registration() );
		
		
		//TODO login del usuario.
		//$this->login( $oUsuario->getDs_nomusuario(), $oUsuario->getDs_password());
		
	}	
	
	/**
	 * se le envía una nueva contraseña a un usuario
	 * @param $ds_user puede ser el email o el username
	 */
	public function sendNewPassword( $ds_user, $subject="" ){
		
		//$ds_user puede ser el email o el username
		try{
			
			$oUser = $this->getUserByUsername( $ds_user );
				
		}catch (GenericException $ex){
			
			//si no existe buscamos por email.
			$oUser = $this->getUserByEmail( $ds_user );
		}
		

		//generamos la nueva clave.
		$newPassword =  CdtUtils::textoRadom(8) ;
		$oUser->setDs_password ( md5( $newPassword ) );
		
		//modificamos el usuario.
		CdtUserDAO::updatePassword( $oUser );
		
		//enviamos el email con la nueva contraseña.
		$to = $oUser->getDs_email();
		$nameTo = $oUser->getDs_name();
		if(!empty($namteTo))
			$nameTo = str_replace(",","", $namteTo);
		else	
			$nameTo = $oUser->getDs_username();
			
		$xtpl = new XTemplate( CDT_SECURE_TEMPLATE_MAIL_FORGOT_PASSWORD );
		$xtpl->assign('name', $nameTo);
		$xtpl->assign('password', $newPassword);
		$xtpl->parse('main');		
		$msg = $xtpl->text('main');
		
        if(empty($subject))
        	$subject = CDT_SECURE_MSG_FORGOT_PASSWORD_MAIL_SUBJECT;
        
		CdtUtils::sendMail($nameTo, $to, $subject, $msg);
		
		
	}

	/**
	 * se modifica la cuenta del usuario
	 * @param CdtUser $oCdtUser entity a modificar.
	 * @param string $ds_new_password nueva clave para el usuario..
	 */
	public function updateCdtUserProfile(CdtUser $oCdtUser, $ds_newPassword=null) { 

		$oOldUser = $this->getUserByUsername( $oCdtUser->getDs_username() );
		
		$oCdtUser->setCd_usergroup( $oOldUser->getCd_usergroup() );
		
		if(!empty($ds_newPassword)){
			
			//chequeamos la clave actual.

			$ds_oldPassword =  $oOldUser->getDs_password() ;
			$ds_password = md5 ( $oCdtUser->getDs_password() );
			$ds_newPassword =  md5( $ds_newPassword ) ;
			
			if( $ds_oldPassword != $ds_password )
				throw new GenericException( CDT_SECURE_MSG_INVALID_PASSWORD );

			$oCdtUser->setDs_password( $ds_newPassword );
			
			//actualizar la clave de usuario.
			CdtUserDAO::updatePassword($oCdtUser);
		}
		
		//persistir en la bbdd.
		CdtUserDAO::updateCdtUser($oCdtUser);
	}
	
	
	/**
	 * se realizan las validaciones para un nuevo usuario
	 * @param $ds_username
	 * @param $ds_email
	 * @throws GenericException
	 */
	protected function validateNewUser( $ds_username, $ds_email ){
		
		//que no exista el nombre de usuario.
		$oUser = new CdtUser();
		$oUser->setDs_username( $ds_username );
		
		if(CdtUserDAO::existUsername( $oUser )){
			CdtUtils::log_debug( "el usuario ya existe");
			throw new GenericException( CDT_SECURE_MSG_CDTUSER_DS_USERNAME_DUPLICATED );
		}
		//que no esté registrado el email para otro usuario.
		$oUser->setDs_email( $ds_email );

		if(CdtUserDAO::existEmail( $oUser ))
			throw new GenericException( CDT_SECURE_MSG_CDTUSER_DS_EMAIL_DUPLICATED );
		
		
	}	

	
} 
?>
