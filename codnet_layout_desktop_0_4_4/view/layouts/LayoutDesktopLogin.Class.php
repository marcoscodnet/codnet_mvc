<?php

/**
 * Representa el layout para el login de CrmMicrojuris
 * 
 * @author Bernardo
 * @since 05-04-2011
 */
class LayoutDesktopLogin extends LayoutDesktop{


	protected function getFooter(){
		$xtpl = new XTemplate (CDT_LAYOUT_DESKTOP_TEMPLATE_FOOTER);
		$xtpl->parse('main');
		return $xtpl->text('main');
	}
	
	protected function parseMenuSuperiorDerecho($xtpl){}
	protected function parseMenuLateral($xtpl, $menuOptions, $menuGroupActivo){}
	protected function parseMenuSolapas($xtpl, $menuGroups, $menuGroupActivo){}

	protected function getXTemplate($menuGroupActivo='', $menuOptions){
		return new XTemplate (CDT_LAYOUT_DESKTOP_TEMPLATE_LOGIN);
	}
	
}
