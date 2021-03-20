<?php

/**
 * Representa un amigo de una red social.
 * 
 * @author bernardo
 * @since 29-08-2011
 * 
 */

class SocialFriend extends SocialUser{

	private $name;
	private $id;
	private $picture;
	
	public function getName(){
		return $this->name;
	}
	
	public function getPicture(){
		return $this->picture;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setName( $value ){
		$this->name = $value;
	}
	
	public function setId( $value ){
		$this->id = $value;
	}
	
	public function setPicture( $value ){
		$this->picture = $value;
	}


}

?>