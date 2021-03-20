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

	public function getPermissions( $urlNext ) {

		$code = $_REQUEST["code"];

		
		if(empty($code)) {
			
			$_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
				
			$dialog_url = "http://www.facebook.com/dialog/oauth?".
			"client_id=". CDT_SOCIAL_API_FACEBOOK_APP_ID . 
			"&scope=". CDT_SOCIAL_API_FACEBOOK_APP_SCOPE.
			"&redirect_uri=" . urlencode($urlNext) .
			"&state=" . $_SESSION['state'];
			
			header("Location: " .$dialog_url );
			die();
			//echo("<script> top.location.href='" . $dialog_url . "'</script>");
		}
		
		if($_REQUEST['state'] == $_SESSION['state']) {

			
			$token_url = "https://graph.facebook.com/oauth/access_token?" .
			"client_id=" . CDT_SOCIAL_API_FACEBOOK_APP_ID . 
			"&redirect_uri=" . urlencode($urlNext) . 
			"&client_secret=" . CDT_SOCIAL_API_FACEBOOK_APP_SECRET_ID . 
			"&code=" . $code;
			
			$response = CdtUtils::curlGET( $token_url );
			//$response = file_get_contents($token_url);
			
			$params = null;
			parse_str($response, $params);

			$graph_url = "https://graph.facebook.com/me?access_token=". $params['access_token'];

			//$user = json_decode(file_get_contents($graph_url));
			$user = json_decode(CdtUtils::curlGET( $graph_url ));
			
			//construimos el usuario.
			$oFactory = new SocialFBUserFactory();
			$oSocialFBUser = $oFactory->build( $user );
			
			//le asignamos el token.
			$oSocialFBUser->setToken( $params['access_token'] );
			
			return $oSocialFBUser; 
			
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
	function getFriends( SocialUser $user ){

		$url  = CDT_SOCIAL_API_FACEBOOK_API_GRAPH_URL . "/" . $user->getCd_code() ."/" . CDT_SOCIAL_API_FACEBOOK_API_FRIENDS;
		$url .= "?access_token=" . $user->getToken()."&fields=name,id,picture";
			
		$texto = CdtUtils::curlGET( $url );
		$data = json_decode($texto, true) ;


		$friends = $data['data'];

		$items = ResultFactory::arrayToCollection($friends, new SocialFBFriendFactory());
		return $items;
	}




	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::getFriendPosts()
	 */
	function getFriendPosts( SocialUser $user, $cd_friend, $type, $dt_date_from='', $dt_date_to='', $page=1, $page_rowcount=null ){

	}

	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::getPosts()
	 */
	function getPosts( SocialUser $user, $type=null, $dt_date_from='', $dt_date_to='', $page=1, $page_rowcount=null ){
		$url  = CDT_SOCIAL_API_FACEBOOK_API_GRAPH_URL . "/" . $user->getCd_code() ."/" . CDT_SOCIAL_API_FACEBOOK_API_HOME;
		$url .= "?access_token=" . $user->getToken();
		
		$texto = CdtUtils::curlGET( $url );
		$data = json_decode($texto, true) ;

		$posts = $data['data'];

		$items = ResultFactory::arrayToCollection($posts, new SocialFBPostFactory());
		
		
		return $items;
	}
	
	
	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::getInbox()
	 */
	function getInbox( SocialUser $user, $type=null, $dt_date_from='', $dt_date_to='', $page=1, $page_rowcount=null ){
		$url  = CDT_SOCIAL_API_FACEBOOK_API_GRAPH_URL . "/" . $user->getCd_code() ."/" . CDT_SOCIAL_API_FACEBOOK_API_INBOX;
		$url .= "?access_token=" . $user->getToken();
		
		
			
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
	function comment( SocialUser $user, SocialPost $socialPost, $comment ){

		$url  = CDT_SOCIAL_API_FACEBOOK_API_GRAPH_URL . "/" . $socialPost->getId() ."/" . CDT_SOCIAL_API_FACEBOOK_API_COMMENTS;

		$params = array('access_token'=>$user->getToken(), 'message'=>$comment );

		$id_comment = CdtUtils::curlPOST( $url, $params );
		
		return $id_comment;
	}

	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::post()
	 */
	function post( SocialUser $user, SocialPost $socialPost ){

		$url  = CDT_SOCIAL_API_FACEBOOK_API_GRAPH_URL . "/" . $user->getCd_code() ."/" . CDT_SOCIAL_API_FACEBOOK_API_FEED;

		/*
		 * posibles parámetros
		 * message, picture, link, name, caption, description, source.
		 */
		
		
		$params = array('access_token'=>$user->getToken(), 'message'=> $socialPost->getText() );
		
		return CdtUtils::curlPOST( $url, $params );
	}


	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::like()
	 */
	function like( SocialUser $user, SocialPost $socialPost ){
		
		$url  = CDT_SOCIAL_API_FACEBOOK_API_GRAPH_URL . "/" . $socialPost->getId() ."/" . CDT_SOCIAL_API_FACEBOOK_API_LIKES;

		$params = array('access_token'=>$user->getToken());

		return  CdtUtils::curlPOST( $url, $params );
		
	}

	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::forward()
	 */
	function forward( SocialUser $user, SocialPost $socialPost ){
		//sería el share.
		return "TO DO";
	}
	
	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::privatePost()
	 */
	function privatePost( SocialUser $user, SocialPost $socialPost, SocialFriend $oFriend ){


		$url  = CDT_SOCIAL_API_FACEBOOK_API_GRAPH_URL . "/" . $user->getCd_code() ."/" . CDT_SOCIAL_API_FACEBOOK_API_FEED;
		
		$privacy = array( 'value' => 'CUSTOM',
						  'friends' => 'SOME_FRIENDS',
						  'allow' => $oFriend->getCd_code(),
						  'deny' => '');
		
		$params = array('access_token'=> $user->getToken(),
						'privacy'=> json_encode($privacy),
						'message'=> $socialPost->getText() );
		
		return  CdtUtils::curlPOST( $url, $params );
	
	
	}

}

?>