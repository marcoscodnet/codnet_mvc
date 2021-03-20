<?php

/**
 * Representa un usuario de facebook.
 * 
 * @author bernardo
 * @since 29-08-2011
 * 
 */

class SocialFBUser extends SocialUser{

	private $token;

	/*

	["id"]=> string(9) "635427779" 
	["name"]=> string(17) "Bernardo Iribarne" 
	
	
	["first_name"]=> string(8) "Bernardo" 
	["last_name"]=> string(8) "Iribarne" 
	["link"]=> string(48) "http://www.facebook.com/profile.php?id=635427779" 
	["gender"]=> string(4) "male" 
	["email"]=> string(28) "bernardoiribarne@hotmail.com" 
	["timezone"]=> int(-3) 
	["locale"]=> string(5) "es_LA" 
	["verified"]=> bool(true) 
	["updated_time"]=> string(24) "2011-04-12T14:26:16+0000" 
	 * 
	 * */

	private $id;
	private $first_name;
	private $last_name;
	private $link;
	private $gender;
	private $email;
	private $timezone;
	private $locale;
	private $verified;
	private $updated_time;
	
	
	public function setId( $value ){
		$this->id = $value;	
	}
	
	public function getId(){
		return $this->id;	
	}
	
	public function setFirst_name( $value ){
		$this->first_name = $value;	
	}
	
	public function getFirst_name(){
		return $this->first_name;	
	}
	
	public function setLast_name( $value ){
		$this->last_name = $value;	
	}
	
	public function getLast_name(){
		return $this->last_name;	
	}
	
	public function setLink( $value ){
		$this->link = $value;	
	}
	
	public function getLink(){
		return $this->link;	
	}
	
	public function setEmail( $value ){
		$this->email = $value;	
	}
	
	public function getEmail(){
		return $this->email;	
	}
	
	public function setGender( $value ){
		$this->gender = $value;	
	}
	
	public function getGender(){
		return $this->gender;	
	}	
	
	public function setLocale( $value ){
		$this->locale = $value;	
	}
	
	public function getLocale(){
		return $this->locale;	
	}
	
	public function setTimezone( $value ){
		$this->timezone = $value;	
	}
	
	public function getTimezone(){
		return $this->timezone;	
	}
	
	public function setVerified( $value ){
		$this->verified = $value;	
	}
	
	public function getVerified(){
		return $this->verified;	
	}
	
	public function setUpdated_time( $value ){
		$this->updated_time= $value;	
	}
	
	public function getUpdated_time(){
		return $this->updated_time;	
	}
		
	public function getToken(){
		return $this->token;
	}

	public function setToken( $value ){
		$this->token = $value;		
	}
}

?>