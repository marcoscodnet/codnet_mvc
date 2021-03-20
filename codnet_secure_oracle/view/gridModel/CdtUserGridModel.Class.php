<?php 

/** 
 * GridModel para CdtUser
 *  
 * @author codnet archetype builder
 * @since 29-12-2011
 */ 
class CdtUserGridModel extends GridModel{

	
	public function CdtUserGridModel( ){

		parent::__construct();
		$this->initModel();
		
	}
	
	protected function initModel(){
		
		
		$this->buildModel( "cd_user", CDT_SECURE_LBL_CDTUSER_CD_USER,  15 );
		
		$this->buildModel( "ds_username", CDT_SECURE_LBL_CDTUSER_DS_USERNAME,  20 );
		
		$this->buildModel( "ds_name", CDT_SECURE_LBL_CDTUSER_DS_NAME,  50 );
		
		$this->buildModel( "ds_email", CDT_SECURE_LBL_CDTUSER_DS_EMAIL,  70 );
		
		$this->buildModel( "ds_usergroup", CDT_SECURE_LBL_CDTUSER_CD_USERGROUP,  40, "UG.ds_usergroup" );
		
		$this->buildModel( "ds_phone", CDT_SECURE_LBL_CDTUSER_DS_PHONE,  30 );
		
		$this->buildModel( "ds_address", CDT_SECURE_LBL_CDTUSER_DS_ADDRESS,  60 );
		
				
		//acciones sobre la lista
		$this->buildAction( "add_cdtuser_init", "add_cdtuser_init", CDT_SECURE_MSG_CDTUSER_TITLE_ADD, "image", "add" );

	}
	
		
	/**
	 * (non-PHPdoc)
	 * @see GridModel::getTitle();
	 */
	function getTitle(){
		return CDT_SECURE_MSG_CDTUSER_TITLE_LIST;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see GridModel::getEntityManager();
	 */
	public function getEntityManager(){
		return new CdtUserManager();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see GridModel::getRowActionsModel( $item );
	 */
	public function getRowActionsModel( $item ){
		
		return $this->getDefaultRowActions( $item, "cdtuser", CDT_SECURE_LBL_CDTUSER, true, true, true, true);
		
	}

	
	/**
	 * (non-PHPdoc)
	 * @see GridModel::getMsgConfirmDelete( $item );
	 */
	protected function getMsgConfirmDelete( $item ){
		
		if(!empty($item)){
			$xtpl = new XTemplate(CDT_SECURE_TEMPLATE_CDTUSER_DELETE);
	        $xtpl->assign('cd_user', $item->getCd_user() );
	        $xtpl->assign('question', CDT_SECURE_MSG_CONFIRM_DELETE_QUESTION );
	        $xtpl->assign('title_confirm', CDT_SECURE_MSG_CONFIRM_DELETE_TITLE );
	        $xtpl->assign('lbl_code', CDT_SECURE_LBL_CDTUSER_CD_USER );
	        $xtpl->parse('main');
	        $text = addslashes($xtpl->text('main'));
			return CdtFormatUtils::quitarEnters($text);
		}else{
			return parent::getMsgConfirmDelete( $item );
		}
        
	}
}
?>
