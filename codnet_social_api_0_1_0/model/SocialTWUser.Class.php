<?php

/**
 * Representa un usuario de twitter.
 *
 * @author bernardo
 * @since 29-08-2011
 *
 */

class SocialTWUser extends SocialUser{

	private $token;

	private $descripcion;
	private $profile_image_url;
	private $screen_name;
	private $oauth_token_secret;
	private $oauth_token;


	private $id;
	private $name;

	private $link;
	private $gender;
	private $email;
	private $timezone;
	private $locale;
	private $verified;
	private $updated_time;

	public function getDescripcion(){
		return $this->descripcion;
	}

	public function getProfile_image_url(){
		return $this->profile_image_url;
	}

	public function getOauth_token_secret(){
		return $this->oauth_token_secret;
	}

	public function getOauth_token(){
		return $this->oauth_token;
	}

	public function getScreen_name(){
		return $this->screen_name;
	}

	public function setOauth_token_secret( $value ){
		$this->oauth_token_secret = $value;
	}

	public function setOauth_token( $value ){
		$this->oauth_token = $value;
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

	public function setId( $value ){
		$this->id = $value;
	}

	public function getId(){
		return $this->id;
	}

	public function setName( $value ){
		$this->name = $value;
	}

	public function getName(){
		return $this->name;
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