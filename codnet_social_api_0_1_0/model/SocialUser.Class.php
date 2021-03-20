<?php

/**
 * Representa un usuario de una red social.
 * 
 * @author bernardo
 * @since 29-08-2011
 * 
 */

class SocialUser{

	private $cd_code;
	private $ds_name;
	
	public function SocialUser($code=0, $name=''){
		$this->setCd_code( $code );
		$this->setDs_name( $name );
	}
	
	public function getCd_code(){
		return $this->cd_code;
	}
	
	public function setCd_code( $value ){
		$this->cd_code = $value;
	}
	
	public function getDs_name(){
		return $this->ds_name;
	}
	
	public function setDs_name( $value ){
		$this->ds_name= $value;
	}

}

?>