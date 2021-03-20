<?php 

/**
 * 
 * @author bernardo
 * @since 16-03-2010
 * 
 */
class PageNotFoundAction extends SecureAction{

	/**
	 * @return forward.
	 */
	public function executeImpl(){
		
		$xtpl = new XTemplate ( CDT_MVC_TEMPLATE_PAGE_NOT_FOUND );
		
		parent::cargarMenu($xtpl, 'menu', 'main.menu');
		
		$xtpl->assign ('titulo', 'Page Not Found');
		$xtpl->assign ( 'WEB_PATH', WEB_PATH );
		$xtpl->parse ( 'main' );
		$xtpl->out ( 'main' );
		
		$forward = null;
		return $forward;
	}
	
	public function getFuncion(){
		return null;
	}
}