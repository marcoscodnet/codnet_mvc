<?php

/**
 * Representa un usuario de una red social.
 * 
 * @author bernardo
 * @since 29-08-2011
 * 
 */

class SocialUser{

	//identificador del usuario.
	private $id;
	//nombre de usuario
	private $username;
	//imagen asociada al usuario.
	private $picture;
	
	public function SocialUser($id=0, $username='', $picture=''){
		
		$this->setId( $id );
		$this->setUsername( $username );
		$this->setPicture( $picture );
		
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setId( $value ){
		$this->id = $value;
	}
	
	public function getUsername(){
		return $this->username;
	}
	
	public function setUsername( $value ){
		$this->username= $value;
	}
	
	public function getPicture(){
		return $this->picture;
	}
	
	public function setPicture( $value ){
		$this->picture = $value;
	}

}

?>