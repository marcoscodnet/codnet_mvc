<?php

/**
 * Representa un commnet de un post de facebook.
 * 
 * @author bernardo
 * @since 22-09-2011
 * 
 */

class SocialFBComment{

	//id del comentario.
	private $id;
	//texto del comentario.
	private $text;
	//usuario que realizó el comentario.
	private $oUser;
	//fecha del comentario (time)
	private $datetime;
	
	public function SocialFBComment(){
		
		$this->setText( '' );
		$this->setUser( new SocialFBUser() );
		$this->setId( 0 );
		$this->setDatetime( '' );
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
		return $this->oUser;
	}
	
	public function setUser( SocialUser $value ){
		$this->oUser = $value;
	}
	

	public function getDatetime(){
		return $this->datetime;
	}
	
	public function setDatetime( $value ){
		$this->datetime = $value;
	}
}

?>