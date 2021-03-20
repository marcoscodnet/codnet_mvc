<?php 

/** 
 * Manager para CdtRegistration
 *  
 * @author codnet archetype builder
 * @since 09-11-2011
 */ 
class CdtRegistrationManager implements ICdtList{ 

	/**
	 * se agrega la nueva entity
	 * @param CdtRegistration $oCdtRegistration entity a agregar.
	 */
	public function addCdtRegistration(CdtRegistration $oCdtRegistration) { 

		//validaciones;
		$this->validateRegistration( $oCdtRegistration );
		
		//generamos un código de activación y asignamos la fecha.
		$ds_activationCode=md5(uniqid(rand()));
		$dt_date = date('Ymd');

		$oCdtRegistration->setDs_activationcode( $ds_activationCode );
		$oCdtRegistration->setDt_date( $dt_date );
		//persistir en la bbdd.
		CdtRegistrationDAO::addCdtRegistration($oCdtRegistration);
		
		//envío del email al futuro usuario con el código de activación.
		$subject = CDT_SECURE_MSG_REGISTRATION_EMAIL_SUBJECT;
		$nameTo = $oCdtRegistration->getDs_username();
		$to = $oCdtRegistration->getDs_email();
		
		$activationLink = WEB_PATH . CDT_SECURE_ACTIVATE_REGISTRATION_ACTION . '&activationcode=' . $ds_activationCode;
		
		$xtpl = new XTemplate( CDT_SECURE_TEMPLATE_ACTIVATE_REGISTRATION_EMAIL );
		$xtpl->parse('main');
		$msg = $xtpl->text('main');
		$params[] = $nameTo;
		$params[] = $activationLink;
        $msg = CdtFormatUtils::formatMessage($msg, $params);
		
        
        CdtUtils::sendMail( $nameTo, $to, $subject, $msg );
        
		
	}

	/**
	 * se realizan las validaciones para una nueva registración
	 * @param CdtRegistration $oCdtRegistration registración a validar.
	 * @throws GenericException
	 */
	protected function validateRegistration( CdtRegistration $oCdtRegistration ){
		
		//que no exista el nombre de usuario.
		$oUser = new CdtUser();
		$oUser->setDs_username( $oCdtRegistration->getDs_username() );
		
		if(CdtUserDAO::existUsername( $oUser )){
			CdtUtils::log_debug( "el usuario ya existe");
			throw new GenericException( CDT_SECURE_MSG_REGISTRATION_USERNAME_DUPLICATED );
		}
		//que no esté registrado el email para otro usuario.
		$oUser->setDs_email( $oCdtRegistration->getDs_email() );

		if(CdtUserDAO::existEmail( $oUser ))
			throw new GenericException( CDT_SECURE_MSG_REGISTRATION_EMAIL_DUPLICATED );
		
		
		//que tampoco exista una registación pendiente para el nombre de usuario.
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('ds_username', $oCdtRegistration->getDs_username(), "=", new CdtCriteriaFormatStringValue());
		$duplicated = $this->getCdtRegistration( $oCriteria );
		if($duplicated!=null && $duplicated->getCd_registration()!=0){
			throw new GenericException( CDT_SECURE_MSG_REGISTRATION_USERNAME_DUPLICATED );
		}
		
		//que tampoco exista una registación pendiente para el email.
		$oCriteria = new CdtSearchCriteria();
		$oCriteria->addFilter('ds_email', $oCdtRegistration->getDs_email(), "=", new CdtCriteriaFormatStringValue());
		$duplicated = $this->getCdtRegistration( $oCriteria );
		if($duplicated!=null && $duplicated->getCd_registration()!=0){
			throw new GenericException( CDT_SECURE_MSG_REGISTRATION_EMAIL_DUPLICATED );
		}
		
	}
	
	/**
	 * se modifica la entity
	 * @param CdtRegistration $oCdtRegistration entity a modificar.
	 */
	public function updateCdtRegistration(CdtRegistration $oCdtRegistration) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		CdtRegistrationDAO::updateCdtRegistration($oCdtRegistration);
	}


	/**
	 * se elimina la entity
	 * @param int identificador de la entity a eliminar.
	 */
	public static function deleteCdtRegistration($id) { 
		//TODO validaciones; 

		$oCdtRegistration = new CdtRegistration();
		$oCdtRegistration->setCd_registration($id);
		CdtRegistrationDAO::deleteCdtRegistration($oCdtRegistration);
	}

	
	/**
	 * se obtiene una colecciï¿½n de entities dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return ItemCollection[CdtRegistration]
	 */
	public function getCdtRegistrations(CdtSearchCriteria $oCriteria) { 
		return CdtRegistrationDAO::getCdtRegistrations($oCriteria); 
	}


	/**
	 * se obtiene la cantidad de entities dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return int
	 */
	public function getCdtRegistrationsCount(CdtSearchCriteria $oCriteria) { 
		return CdtRegistrationDAO::getCdtRegistrationsCount($oCriteria); 
	}


	/**
	 * se obtiene un entity dado el filtro de bï¿½squeda
	 * @param CdtSearchCriteria $oCriteria filtro de bï¿½squeda.
	 * @return CdtRegistration
	 */
	public function getCdtRegistration(CdtSearchCriteria $oCriteria) { 
		return CdtRegistrationDAO::getCdtRegistration($oCriteria); 
	}

	//	interface ICdtList

	
	/**
	 * (non-PHPdoc)
	 * @see ICdtList::getEntities();
	 */
	public function getEntities( CdtSearchCriteria $oCriteria) { 
		return $this->getCdtRegistrations($oCriteria); 
	}

	
	/**
	 * (non-PHPdoc)
	 * @see ICdtList::getEntitiesCount();
	 */
	public function getEntitiesCount ( CdtSearchCriteria $oCriteria ) { 
		return $this->getCdtRegistrationsCount($oCriteria); 
	}


} 
?>
