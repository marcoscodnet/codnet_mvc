<?php

/**
 * Representa un seguido de twitter.
 * 
 * @author bernardo
 * @since 29-08-2011
 * 
 */

class SocialTWFriend extends SocialFriend{
	
	private $descripcion;
	private $profile_image_url;
	private $screen_name;
	
	public function getDescripcion(){
		return $this->descripcion;
	}
	
	public function getProfile_image_url(){
		return $this->profile_image_url;
	}
	
	public function getScreen_name(){
		return $this->screen_name;
	}
	
	public function setDescripcion( $value ){
		$this->descripcion = $value;
	}
	
	public function setScreen_name( $value ){
		$this->screen_name = $value;
	}
	
	public function setProfile_image_url( $value ){
		$this->profile_image_url = $value;
	}


}

?>