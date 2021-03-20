<?php

/**
 * Representa un post de una red social.
 * 
 * @author bernardo
 * @since 29-08-2011
 * 
 */

abstract class SocialPost{

	//id del post.
	private $id;
	//tipo de post.
	private $type;
	//texto asociado al post.
	private $text;
	//usuario que realizó el post.
	private $oUser;
	//usuario al cual se le realizó el post.
	//(puede que no tenga, es para post directos, mensajes privados.)
	private $oUserTo;
	//fecha del post (time).
	private $datetime;
	
	
	public function SocialPost(){
		
		$this->setId( 0 );
		$this->setType( 0 );
		$this->setText( '' );
		$this->setUser( new SocialUser() );
		$this->setDatetime( '' );
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setId( $value ){
		$this->id = $value;
	}

	
	public function getType(){
		return $this->type;
	}
	
		
	public function setType($value){
		$this->type = $value;
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
	
	public function getUserTo(){
		return $this->oUserTo;
	}
	
	public function setUserTo( SocialUser $value ){
		$this->oUserTo = $value;
	}
	
	public function getDatetime(){
		return $this->datetime;
	}
	
	public function setDatetime( $value ){
		$this->datetime = $value;
	}
	
}

?>