<?php 

/** 
 * Autogenerated class 
 *  
 *  @author modelBuilder 
 *  @since 13-07-2011
 */ 
class RegistracionFactory extends GenericFactory{ 

	public function build($next) { 
		$this->setClassName('Registracion');
		$oRegistracion = parent::build($next);
		
		 //TODO foreign keys 
		 
		return $oRegistracion;
	}
} 
?>