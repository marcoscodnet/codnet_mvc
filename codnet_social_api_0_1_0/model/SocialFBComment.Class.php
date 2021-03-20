<?php

/**
 * Representa un commnet de un post de facebook.
 * 
 * @author bernardo
 * @since 22-09-2011
 * 
 */

class SocialFBComment{

	//texto del comentario.
	private $text;
	//usuario que realizó el comentario.
	private $user;
	//id del comentario.
	private $id;
	//fecha del comentario
	private $created_time;
	
	public function SocialFBComment(){
		
		$this->setText( '' );
		$this->setUser( new SocialFBUser() );
		$this->setId( 0 );
		
	}
	
	
	public function getId(){
		return $this->id;
	}
	
	public function setId( $value ){
		$this->id = $value;
	}
	
	public function getText(){
		return $this->text;
	}
	
	public function setText( $value ){
		$this->text = $value;
	}
	
	public function getUser(){
		return $this->user;
	}
	
	public function setUser( SocialUser $value ){
		$this->user = $value;
	}
	

	public function getCreated_time(){
		return $this->created_time;
	}
	
	public function setCreated_time( $value ){
		$this->created_time = $value;
	}
}

?>