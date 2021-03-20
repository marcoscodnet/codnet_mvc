<?php

/**
 * Representa un post de facebook.
 * 
 * @author bernardo
 * @since 29-08-2011
 * 
 */

class SocialFBPost extends SocialPost{


	private $comments;
	private $created_time;
	private $updated_time;
	
	public function SocialPost(){
		
		$this->setType( 0);
		$this->setText( '' );
		$this->setUser( new SocialFBFriend() );
		$this->setComments( array() );
		$this->setId( '' );
		$this->setCreated_time('');
		$this->setUpdated_time('');
		
	}
	

	public function getCreated_time(){
		return $this->created_time;
	}
	
	public function setCreated_time( $value ){
		$this->created_time = $value;
	}
	
	public function getUpdated_time(){
		return $this->updated_time;
	}
	
	public function setUpdated_time( $value ){
		$this->updated_time = $value;
	}

	public function setComments( $value ){
		$this->comments = $value;
	}
	
	public function getComments(){
		return $this->comments;
	}

}

?>