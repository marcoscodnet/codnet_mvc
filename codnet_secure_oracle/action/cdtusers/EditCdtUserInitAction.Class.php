<?php 

/**
 * Acci�n para inicializar el contexto para editar CdtUser.
 * 
 * @author codnet archetype builder
 * @since 29-12-2011
 * 
 */
abstract class EditCdtUserInitAction  extends CdtEditInitAction{

	/**
	 * (non-PHPdoc)
	 * @see CdtEditInitAction::getXTemplate();
	 */
	protected function getXTemplate(){
		return new XTemplate ( CDT_SECURE_TEMPLATE_CDTUSER_EDIT );		
	}

	
	/**
	 * (non-PHPdoc)
	 * @see CdtEditInitAction::getEntity();
	 */
	protected function getEntity(){
		
		//se construye el CdtUser a modificar.
		$oCdtUser = new CdtUser ( );
	
		$oCdtUser->setCd_user ( CdtUtils::getParamPOST('cd_user') );	
				
		$oCdtUser->setDs_username ( CdtUtils::getParamPOST('ds_username') );	
				
		$oCdtUser->setDs_name ( CdtUtils::getParamPOST('ds_name') );	
				
		$oCdtUser->setDs_email ( CdtUtils::getParamPOST('ds_email') );	
				
		$oCdtUser->setDs_password ( CdtUtils::getParamPOST('ds_password') );	
				
		$oCdtUser->setCd_usergroup ( CdtUtils::getParamPOST('cd_usergroup') );	
				
		$oCdtUser->setDs_phone ( CdtUtils::getParamPOST('ds_phone') );	
				
		$oCdtUser->setDs_address ( CdtUtils::getParamPOST('ds_address') );	
		
		
		return $oCdtUser;
	}	
	
	/**
	 * (non-PHPdoc)
	 * @see CdtEditInitAction::parseEntity();
	 */
	protected function parseEntity($entity, XTemplate $xtpl){
		
		$oCdtUser = CdtFormatUtils::ifEmpty($entity, new CdtUser());

		//parseamos la entity
		
				
		$xtpl->assign ( 'ds_name', stripslashes ( $oCdtUser->getDs_name () ) );
		$xtpl->assign ( 'ds_name_label', CDT_SECURE_LBL_CDTUSER_DS_NAME );
				
		$xtpl->assign ( 'ds_email', stripslashes ( $oCdtUser->getDs_email () ) );
		$xtpl->assign ( 'ds_email_label', CDT_SECURE_LBL_CDTUSER_DS_EMAIL );
				
		$xtpl->assign ( 'ds_phone', stripslashes ( $oCdtUser->getDs_phone () ) );
		$xtpl->assign ( 'ds_phone_label', CDT_SECURE_LBL_CDTUSER_DS_PHONE );
				
		$xtpl->assign ( 'ds_address', stripslashes ( $oCdtUser->getDs_address () ) );
		$xtpl->assign ( 'ds_address_label', CDT_SECURE_LBL_CDTUSER_DS_ADDRESS );
		
		
				
		$xtpl->assign ( 'cd_user', stripslashes ( $oCdtUser->getCd_user () ) );
		$xtpl->assign ( 'cd_user_label', CDT_SECURE_LBL_CDTUSER_CD_USER );
		$xtpl->assign ( 'cd_user_required', '*' );
		$xtpl->assign ( 'cd_user_required_msg', CDT_SECURE_MSG_CDTUSER_CD_USER_REQUIRED );
				
		$xtpl->assign ( 'ds_username', stripslashes ( $oCdtUser->getDs_username () ) );
		$xtpl->assign ( 'ds_username_label', CDT_SECURE_LBL_CDTUSER_DS_USERNAME );
		$xtpl->assign ( 'ds_username_required', '*' );
		$xtpl->assign ( 'ds_username_required_msg', CDT_SECURE_MSG_CDTUSER_DS_USERNAME_REQUIRED );
		
		
		//parseamos las relaciones de la entity
		
		$xtpl->assign ( 'cd_usergroup_label', CDT_SECURE_LBL_CDTUSER_CD_USERGROUP );
		$xtpl->assign ( 'cd_usergroup_required', '*' );
		$selected =  $oCdtUser->getCdtUserGroup();
		
		
		$this->parseCdtUserGroup($selected, $xtpl);
				
		
		
		//parseamos el action submit.
		$xtpl->assign('submit',  $this->getSubmitAction() );
		
		$xtpl->assign ( 'lbl_save', CDT_SECURE_LBL_SAVE);
		$xtpl->assign ( 'lbl_cancel', CDT_SECURE_LBL_CANCEL);
		$xtpl->assign ( 'msg_required_fields', CDT_SECURE_MSG_REQUIRED_FIELDS);
		
	}

	
	/**
	 * retorna el action para el submit.
	 * @return string
	 */
	protected abstract function getSubmitAction();
	
	
	protected function parseCdtUserGroup($selected, XTemplate $xtpl ){
	
		$oFindObject = CdtSecureComponentsFactory::getFindObjectCdtUserGroup( $selected, 'cd_usergroup', true,  CDT_SECURE_MSG_CDTUSER_CD_USERGROUP_REQUIRED  );

		$xtpl->assign('CdtUserGroup_find', $oFindObject->show() );
	}
	

}
