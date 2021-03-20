<?php

/**
 * API para interactuar con Facebook.
 *
 *
 * @author bernardo
 * @since 29-08-2011
 *
 */


class FacebookAPI implements ISocialAPI{

	/**
	 * se obtiene la cuenta de usuario dado el token de acceso.
	 * @param string $token
	 * @return SocialFBUser $oSocialUser usuario de FB. 
	 */
	public function getUser( $token) {
		
		$graph_url = "https://graph.facebook.com/me?access_token=$token";

		$user = json_decode(CdtUtils::curlGET( $graph_url ));

		//construimos el usuario.
		$oFactory = new SocialFBUserFactory();
		$oSocialFBUser = $oFactory->build( $user );
		
		//le asignamos el token.
		$oSocialFBUser->setToken( $token );
		
		return $oSocialFBUser;
	        
	}
		
	/**
	 * se obtiene los permisos necesarios para
	 * utilizar la api desde nuestra aplicación.
	 * @param string $urlNext url de retorno (respuesta desde FB)
	 * @return SocialFBUser $oSocialUser usuario con los permisos otorgados por FB. 
	 */
	public function getPermissions( $urlNext ) {

		/*
		 * Esta función nos llevará a loguearnos y autorizar permisos a la página
		 * de Facebook.
		 * 
		 * La idea es que invoquemos esta función 2 veces:
		 * 
		 * 1) Para ir a la página de facebook
		 * 2) Cuando viene la respuesta de facebook, volver a invocarla para obtener
		 * la información que nos devuelve facebook.
		 * 
		 */ 
		
		
		if(isset($_REQUEST["code"]))
			$code = $_REQUEST["code"];

		//Primera invocación, nos lleva al login de facebook.
		if(empty($code)) {
			
			$_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
				
			$dialog_url = "http://www.facebook.com/dialog/oauth?".
			"client_id=". CDT_SOCIAL_API_FACEBOOK_APP_ID . 
			"&scope=". CDT_SOCIAL_API_FACEBOOK_APP_SCOPE.
			"&redirect_uri=" . urlencode($urlNext) .
			"&state=" . $_SESSION['state'];
			
			header("Location: " .$dialog_url );
			die();
		}
		
		//Segunda invocación, a partir de la respuesta de facebook, se obtiene
		//el token de acceso y la información de la cuenta del usuario		
		if($_REQUEST['state'] == $_SESSION['state']) {

			//se obtiene el token de acceso.
			$token_url = "https://graph.facebook.com/oauth/access_token?" .
			"client_id=" . CDT_SOCIAL_API_FACEBOOK_APP_ID . 
			"&redirect_uri=" . urlencode($urlNext) . 
			"&client_secret=" . CDT_SOCIAL_API_FACEBOOK_APP_SECRET_ID . 
			"&code=" . $code;
			
			$response = CdtUtils::curlGET( $token_url );
			$params = null;
			parse_str($response, $params);
			$token = $params['access_token'];

			//obtenemos la cuenta fb del usuario y la retornamos
			return $this->getUser( $token ); 
			
		}
		else {
			echo("The state does not match. You may be a victim of CSRF.");
			//TODO log.
			die();
		}
		
		
	}


	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::getFriends()
	 */
	function getFriends( SocialUser $oUser ){

		$url  = CDT_SOCIAL_API_FACEBOOK_API_GRAPH_URL . "/" . $oUser->getId() ."/" . CDT_SOCIAL_API_FACEBOOK_API_FRIENDS;
		$url .= "?access_token=" . $oUser->getToken() ."&fields=name,id,picture";
			
		$texto = CdtUtils::curlGET( $url );
		$data = json_decode($texto, true) ;

		$friends = $data['data'];

		$items = ResultFactory::arrayToCollection($friends, new SocialFBUserFactory());
		return $items;
	}




	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::getFriendPosts()
	 */
	function getFriendPosts( SocialUser $oUser, SocialUser $oUserFriend, $params=null ){

	}

	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::getPosts()
	 */
	function getPosts( SocialUser $oUser, $params=null ){
		
		$url  = CDT_SOCIAL_API_FACEBOOK_API_GRAPH_URL . "/" . $oUser->getId() ."/" . CDT_SOCIAL_API_FACEBOOK_API_HOME;
		$url .= "?access_token=" . $oUser->getToken();
		
		$texto = CdtUtils::curlGET( $url );
		$data = json_decode($texto, true) ;

		$posts = $data['data'];

		$items = ResultFactory::arrayToCollection($posts, new SocialFBPostFactory());
		
		
		return $items;
	}
	
	
	/**
	 * 
	 * se obtienen los mensajes inbox del usuario
	 * @param SocialUser $oUser usuario de la red social
	 * @param array $params 
	 */
	function getInbox( SocialUser $oUser, $params=null ){
		
		$url  = CDT_SOCIAL_API_FACEBOOK_API_GRAPH_URL . "/" . $oUser->getId() ."/" . CDT_SOCIAL_API_FACEBOOK_API_INBOX;
		$url .= "?access_token=" . $oUser->getToken();
			
		$texto = CdtUtils::curlGET( $url );	
		$data = json_decode($texto, true) ;

		$posts = $data['data'];    	
        
        $items = ResultFactory::arrayToCollection($posts, new SocialFBPostFactory());
        return $items;		
	}

	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::comment()
	 */
	function comment( SocialUser $oUser, SocialPost $oSocialPost, $comment ){

		$url  = CDT_SOCIAL_API_FACEBOOK_API_GRAPH_URL . "/" . $oSocialPost->getId() ."/" . CDT_SOCIAL_API_FACEBOOK_API_COMMENTS;

		$params = array('access_token'=>$oUser->getToken(), 'message'=>$comment );

		$comment = CdtUtils::curlPOST( $url, $params );
		
		return $comment;
	}

	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::post()
	 */
	function post( SocialUser $oUser, SocialPost $oSocialPost ){

		$url  = CDT_SOCIAL_API_FACEBOOK_API_GRAPH_URL . "/" . $oUser->getId() ."/" . CDT_SOCIAL_API_FACEBOOK_API_FEED;

		/*
		 * posibles parámetros
		 * message, picture, link, name, caption, description, source.
		 */
		
		
		$params = array('access_token'=>$oUser->getToken(), 'message'=> $oSocialPost->getText() );
		
		return CdtUtils::curlPOST( $url, $params );
	}


	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::like()
	 */
	function like( SocialUser $oUser, SocialPost $oSocialPost ){
		
		$url  = CDT_SOCIAL_API_FACEBOOK_API_GRAPH_URL . "/" . $oSocialPost->getId() ."/" . CDT_SOCIAL_API_FACEBOOK_API_LIKES;

		$params = array('access_token'=>$oUser->getToken());

		return  CdtUtils::curlPOST( $url, $params );
		
	}

	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::forward()
	 */
	function forward( SocialUser $oUser, SocialPost $oSocialPost ){
		//sería el share.
		return "TO DO";
	}
	
	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::privatePost()
	 */
	function privatePost( SocialUser $oUser, SocialPost $oSocialPost, SocialUser $oUserFriend ){


		$url  = CDT_SOCIAL_API_FACEBOOK_API_GRAPH_URL . "/" . $oUser->getId() ."/" . CDT_SOCIAL_API_FACEBOOK_API_FEED;
		
		$privacy = array( 'value' => 'CUSTOM',
						  'friends' => 'SOME_FRIENDS',
						  'allow' => $oUserFriend->getId(),
						  'deny' => '');
		
		$params = array('access_token'=> $oUser->getToken(),
						'privacy'=> json_encode($privacy),
						'message'=> $oSocialPost->getText() );
		
		return  CdtUtils::curlPOST( $url, $params );
	
	
	}

}

?>