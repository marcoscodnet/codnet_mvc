<?php

/**
 * Representa un usuario de twitter.
 *
 * @author bernardo
 * @since 29-08-2011
 *
 */

class SocialTWTUser extends SocialUser{

	//nombre del usuario.
	private $name;
	//token secret de autoriazción.
	private $oauth_token_secret;
	//token de autorización.
	private $oauth_token;
	

	public function getOauth_token_secret(){
	    return $this->oauth_token_secret;
	}

	public function setOauth_token_secret($oauth_token_secret){
	    $this->oauth_token_secret = $oauth_token_secret;
	}

	public function getOauth_token(){
	    return $this->oauth_token;
	}

	public function setOauth_token($oauth_token){
	    $this->oauth_token = $oauth_token;
	}


	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}
}

?>