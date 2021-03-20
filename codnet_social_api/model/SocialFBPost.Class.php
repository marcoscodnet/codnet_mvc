<?php

/**
 * Representa un post de facebook.
 * 
 * @author bernardo
 * @since 29-08-2011
 * 
 */

class SocialFBPost extends SocialPost{

	//fecha de actualización del post (time)
	private $updated_time;
	
	public function SocialFBPost(){
		
		parent::__construct();
		
		$this->setComments( new ItemCollection() );
		$this->setUpdated_time('');
		
	}
	
	public function getUpdated_time(){
		return $this->updated_time;
	}
	
	public function setUpdated_time( $value ){
		$this->updated_time = $value;
	}

}

?>