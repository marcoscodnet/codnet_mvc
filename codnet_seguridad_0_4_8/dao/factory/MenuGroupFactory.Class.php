<?php
/**
 * 
 * @author bernardo
 * @since 23-06-2010
 * 
 * Factory para menu group.
 *
 */
class MenuGroupFactory implements ObjectFactory{

	/**
	 * construye un menugroup. 
	 * @param $next
	 * @return unknown_type
	 */
	public function build($next){
		$oMenuGroup = new MenuGroup();
		$oMenuGroup->setCd_menugroup( $next ['cd_menugroup'] );
		$oMenuGroup->setNombre( $next ['nombre'] );
		$oMenuGroup->setWidth( $next ['width'] );
		$oMenuGroup->setOrden( $next ['orden'] );
		
		if(array_key_exists('action',$next)){
			$oMenuGroup->setAction( $next ['action'] );
		}

		if(array_key_exists('cssclass',$next)){
			$oMenuGroup->setCssclass( $next ['cssclass'] );
		}
		
		return $oMenuGroup;
	}
}
?>