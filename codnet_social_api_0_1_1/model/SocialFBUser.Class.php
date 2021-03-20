<?php

/**
 * Representa un usuario de facebook.
 * 
 * @author bernardo
 * @since 29-08-2011
 * 
 */

class SocialFBUser extends SocialUser{


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
	 
	 * */

	//nombre del usuario.
	private $first_name;
	//apellido del usuario.
	private $last_name;
	//link en fb.
	private $link;
	//sexo del usuario.
	private $gender;
	//email del usuario
	private $email;
	//timezone
	private $timezone;
	//locale
	private $locale;
	//si esta verificado
	private $verified;
	//fecha de ultima actualizacion.
	private $updated_time;
	//token de acceso.
	private $token;
	

	public function getFirst_name()
	{
	    return $this->first_name;
	}

	public function setFirst_name($first_name)
	{
	    $this->first_name = $first_name;
	}

	public function getLast_name()
	{
	    return $this->last_name;
	}

	public function setLast_name($last_name)
	{
	    $this->last_name = $last_name;
	}

	public function getLink()
	{
	    return $this->link;
	}

	public function setLink($link)
	{
	    $this->link = $link;
	}

	public function getGender()
	{
	    return $this->gender;
	}

	public function setGender($gender)
	{
	    $this->gender = $gender;
	}

	public function getEmail()
	{
	    return $this->email;
	}

	public function setEmail($email)
	{
	    $this->email = $email;
	}

	public function getTimezone()
	{
	    return $this->timezone;
	}

	public function setTimezone($timezone)
	{
	    $this->timezone = $timezone;
	}

	public function getLocale()
	{
	    return $this->locale;
	}

	public function setLocale($locale)
	{
	    $this->locale = $locale;
	}

	public function getVerified()
	{
	    return $this->verified;
	}

	public function setVerified($verified)
	{
	    $this->verified = $verified;
	}

	public function getUpdated_time()
	{
	    return $this->updated_time;
	}

	public function setUpdated_time($updated_time)
	{
	    $this->updated_time = $updated_time;
	}

	public function getToken()
	{
	    return $this->token;
	}

	public function setToken($token)
	{
	    $this->token = $token;
	}
}

?>