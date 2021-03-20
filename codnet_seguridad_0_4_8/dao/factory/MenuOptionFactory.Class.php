<?php
/**
 * 
 * @author bernardo
 * @since 23-06-2010
 * 
 * Factory para menu option.
 *
 */
class MenuOptionFactory implements ObjectFactory{

	/**
	 * construye un menuoption. 
	 * @param $next
	 * @return unknown_type
	 */
	public function build($next){
		
		if(isset($next ['cd_funcion']) ){
			$factory = new FuncionFactory();
			$oMenuOption = new MenuSecureOption($factory->build( $next ));
		}else{
			$oMenuOption = new MenuOption();
		}
		
		$oMenuOption->setCd_menuoption( $next ['cd_menuoption'] );
		$oMenuOption->setCd_menugroup( $next ['cd_menugroup'] );
		$oMenuOption->setNombre( $next ['nombre'] );
		$oMenuOption->setHref( $next ['href'] );
		$oMenuOption->setCd_funcion( $next ['cd_funcion'] );
		$oMenuOption->setOrden( $next ['orden'] );
		if(array_key_exists('cssclass',$next)){
			$oMenuOption->setCssclass( $next ['cssclass'] );
		}
		
		
		if(array_key_exists('descripcion_panel',$next)){
			$oMenuOption->setDescripcion_panel( $next ['descripcion_panel'] );
		}
		
		return $oMenuOption;
	}
}
?>