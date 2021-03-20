<?php

/**
 * API para interactuar con Twitter.
 * 
 * 
 * @author bernardo
 * @since 29-08-2011
 *  
 */


class TwtAPI implements ISocialAPI{
	
	/**
	 * se obtiene la cuenta de usuario dado el token de acceso.
	 * @param string $oauthToken
	 * @param string $oauthTokenSecret
	 * @return SocialTWTUser $oSocialUser usuario de FB. 
	 */
	public function getUser( $oauthToken, $oauthTokenSecret) {
		
		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_CONSUMER_KEY, CDT_SOCIAL_API_TWITTER_CONSUMER_SECRET);
		
		$twAPI ->setToken( $oauthToken, $oauthTokenSecret );
		
		$userTW = $twAPI->get_accountVerify_credentials();
		
		//construimos el usuario.
		$oFactory = new SocialTWTUserFactory();
		$oSocialTWUser = $oFactory->build( $userTW );
		
		$oSocialTWUser->setOauth_token( $token->oauth_token );
        $oSocialTWUser->setOauth_token_secret( $token->oauth_token_secret );
	        
		return $oSocialTWUser;
	}
	
		
	/**
	 * se obtiene los permisos necesarios para
	 * utilizar la api desde nuestra aplicación.
	 * @param string $urlNext url de retorno (respuesta desde Twitter)
	 * @return SocialTWTUser $oSocialUser usuario con los permisos otorgados por Twitter. 
	 */	
	public function getPermissions( $urlNext ) {

		/*
		 * Esta función nos llevará a loguearnos y autorizar permisos a la página
		 * de Twitter.
		 * 
		 * La idea es que invoquemos esta función 2 veces:
		 * 
		 * 1) Para ir a la página de twitter
		 * 2) Cuando viene la respuesta de twitter, volver a invocarla para obtener
		 * la información que nos devuelve twitter.
		 * 
		 */ 
				
		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_CONSUMER_KEY, CDT_SOCIAL_API_TWITTER_CONSUMER_SECRET);
		
		//con este if sabemos si es la primera invocación o la segunda, ya que
		//twitter nos responde con el oauth_token por request.		
		
		if (isset($_GET['oauth_token'])){
			
	        //Segunda invocación, respuesta de twitter

			//obtenemos el token.
			$twAPI->setToken($_GET['oauth_token']);
	        $token = $twAPI->getAccessToken();

	        //obtenemos la cuenta de twitter.
	        $oSocialTWUser = $this->getUser( $token->oauth_token, $token->oauth_token_secret );
	        	      
			//le asignamos el token.
			$oSocialTWUser->setOauth_token($token->oauth_token);
	        $oSocialTWUser->setOauth_token_secret($token->oauth_token_secret);
	        
			return $oSocialTWUser; 
	        
	    } else {
	    	
	    	//Primera invocación, vamos a la página de twitter.
	    	$params = array ('oauth_callback' => $urlNext ); 
	    	header('Location: '.$twAPI->getAuthorizeUrl(null, $params) );
	    	die();
	       
	    }
			
		
	}
	
	
	function getFriend( $id ){
		
		//https://api.twitter.com/1/users/lookup.json?screen_name=twitterapi&include_entities=true
		//https://api.twitter.com/1/users/lookup.json?user_id=783214&include_entities=true
		
		
	}
	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::getFriends()
	 */
	function getFriends( SocialUser $oUser ){
		
		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_CONSUMER_KEY, CDT_SOCIAL_API_TWITTER_CONSUMER_SECRET, $oUser->getOauth_token() , $oUser->getOauth_token_secret());
		
		try{
			
			//TODO ver si es necesario este paso.
			$userTW = $twAPI->get_accountVerify_credentials();
			
			//twitter requiere el id o el username para obtener los friends.
			$id = $oUser->getId();
			if( empty($id) )
				$id = $oUser->getUsername();
			
			$friends = $twAPI->get("/statuses/friends/$id.json");
			
			$friends = json_decode( $friends->responseText );
			
			if( !empty($friends) )
				$items = ResultFactory::arrayToCollection($friends, new SocialTWTUserFactory());
			else
				$items = new ItemCollection();
			
		}catch(TwitterException $te){

			$items = new ItemCollection();
			CdtUtils::log_error("Error leyendo friends de twitter: " .  $te->getCode() . " - " . $te->getMessage() );
		}
		

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
		
		/*  PARA TENER EN CUENTA.
		 * 
		 * count (optional): 
		 * Specifies the number of records to retrieve. Must be less than or equal to 200.
		 * 
		 *  since_id (optional):  
		 *  Returns results with an ID greater than (that is, more recent than) the specified ID. 
		 *  There are limits to the number of Tweets which can be accessed through the API. 
		 *  If the limit of Tweets has occured since the since_id, the since_id will be forced 
		 *  to the oldest ID available.
		 *  Example Values: 12345
		 *  
		 *  max_id (optional):
		 *  Returns results with an ID less than (that is, older than) or equal to the specified ID.
		 *  
		 */
		
		try{
			
			//si está el parámetro "since_id", vamos a buscar todos los posts más recientes a since_id
			//la validación de que no esté el parámetro count es por si se está manejando la paginación desde afuera.
			if($params!=null && array_key_exists('since_id',$params) && !array_key_exists('count',$params)){
				
				$count = 20;
				$since_id = $params['since_id'];
				$posts = $this->getPostsPaginated( $oUser, $params, $count, $since_id );
				
				//nos fijamos si hay más.
				$posts_count = $posts->size();
				
				CdtUtils::log_debug("TWT API: posts count-> $posts_count");
				
				if($posts_count > 0 ){
					
					$first_post_id = $posts->getObjectByIndex( $posts_count-1 )->getId();
					
					while( ($first_post_id > $since_id) && ($posts_count == $count )){ 
						
						$more_posts = $this->getPostsPaginated( $oUser, $params, $count, $since_id, $first_post_id );
						$posts_count = $more_posts->size();
						CdtUtils::log_debug("TWT API: posts count-> $posts_count");
				
						if($posts_count > 0 )
							$first_post_id = $more_posts->getObjectByIndex( $posts_count-1 )->getId();
							
						$more_posts->addAll( $posts );
						
						$posts = $more_posts;
					}	
				}
				
				
				
				
			}else{
	
				$posts = $this->getPostsPaginated( $oUser, $params );
				
			}
		}catch(TwitterException $te){

				$posts = new ItemCollection();
				CdtUtils::log_error("Error leyendo posts de twitter: " .  $te->getCode() . " - " . $te->getMessage() );
		}
				
		return $posts;
	}

	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::comment()
	 */
	function comment( SocialUser $oUser, SocialPost $oSocialPost, $comment ){
		
		$postid = $oSocialPost->getId();
		
		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_CONSUMER_KEY, CDT_SOCIAL_API_TWITTER_CONSUMER_SECRET, $oUser->getOauth_token() , $oUser->getOauth_token_secret());
		
		$userTW = $twAPI->get_accountVerify_credentials();
		
		$post = $twAPI->post('/statuses/update.json', array('status' => $comment, "in_reply_to_status_id" => $postid));
		
		$post = json_decode( $post->responseText );
		
		$oPostFactory = new SocialTWTPostFactory();
		return $oPostFactory->build( $post );
		
		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::post()
	 */
	function post( SocialUser $oUser, SocialPost $oSocialPost ){
		
		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_CONSUMER_KEY, CDT_SOCIAL_API_TWITTER_CONSUMER_SECRET, $oUser->getOauth_token() , $oUser->getOauth_token_secret());
		
		$userTW = $twAPI->get_accountVerify_credentials();
		
		$post = $twAPI->post('/statuses/update.json', array('status' => $oSocialPost->getText()));

		//TODO ver si salió todo ok, leer el status de la llamada.
		
		$post = json_decode( $post->responseText );
		
		$oPostFactory = new SocialTWTPostFactory();
		return $oPostFactory->build( $post );
		
	}
	
	
	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::like()
	 */
	function like( SocialUser $user, SocialPost $socialPost ){
		
		throw new SocialAPIException("Functionality not defined on Twitter", -1);
		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::forward()
	 */
	function forward( SocialUser $oUser, SocialPost $oSocialPost ){
		
		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_CONSUMER_KEY, CDT_SOCIAL_API_TWITTER_CONSUMER_SECRET, $oUser->getOauth_token() , $oUser->getOauth_token_secret());
		
		$userTW = $twAPI->get_accountVerify_credentials();
		
		$postid = $oSocialPost->getId();
		
		$post = $twAPI->post("/statuses/retweet/" . $postid . ".json" );
		
		//TODO ver si salió todo ok, leer el status de la llamada.
		
		$post = json_decode( $post->responseText );
		
		$oPostFactory = new SocialTWTPostFactory();
		return $oPostFactory->build( $post );
	}	
	
	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::privatePost()
	 */
	function privatePost( SocialUser $oUser, SocialPost $oSocialPost, SocialUser $oUserFriend ){

		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_CONSUMER_KEY, CDT_SOCIAL_API_TWITTER_CONSUMER_SECRET, $oUser->getOauth_token() , $oUser->getOauth_token_secret());
		
		$userTW = $twAPI->get_accountVerify_credentials();
		
		$post = $twAPI->post('/direct_messages/new.format', array('user_id' => $oUserFriend->getId(), 'text' => $oSocialPost->getText()) );

		//TODO ver si salió todo ok, leer el status de la llamada.
		
		$post = json_decode( $post->responseText );
		
		$oPostFactory = new SocialTWTPostFactory();
		return $oPostFactory->build( $post );
	}
	
	
	/**
	 * mentions del usuario en twitter
	 * @param SocialUser $oUser usuario de twitter
	 * @param array $params
	 */
	function getMentions(  SocialUser $oUser, $params = null  ){
		
		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_CONSUMER_KEY, CDT_SOCIAL_API_TWITTER_CONSUMER_SECRET, $oUser->getOauth_token() , $oUser->getOauth_token_secret());
		
		$mentions = $twAPI->get('/statuses/mentions.json', array('include_entities' => true));

		//TODO ver si salió todo ok, leer el status de la llamada.
		
		$mentions = json_decode( $mentions->responseText );
		
		if(!empty($mentions))
			$items = ResultFactory::arrayToCollection($mentions, new SocialTWTPostFactory());		
		else
			$items = new ItemCollection();
		return $items;
		
	}
	

	/**
	 * dado el código de error de twitter, nos da el mensaje descriptivo.
	 * @param int $code código de error de twitter.
	 */
	public function getErrorMessage( $code ){
		$message = "";
		switch ($code) {
			case 200: $message = "OK: Success!";break;
			case 304: $message = "Not Modified: There was no new data to return.";break;
			case 400: $message = "Bad Request: The request was invalid. An accompanying error message will explain why. This is the status code will be returned during rate limiting.";break;
			case 401: $message = "Unauthorized: Authentication credentials were missing or incorrect.";break;
			case 403: $message = "Forbidden: The request is understood, but it has been refused. An accompanying error message will explain why. This code is used when requests are being denied due to update limits.";break;
			case 404: $message = "Not Found: The URI requested is invalid or the resource requested, such as a user, does not exists.";break;
			case 406: $message = "Not Acceptable: Returned by the Search API when an invalid format is specified in the request.";break;
			case 420: $message = "Enhance Your Calm: Returned by the Search and Trends API when you are being rate limited.";break;
			case 500: $message = "Internal Server Error: Something is broken. Please post to the group so the Twitter team can investigate.";break;
			case 502: $message = "Bad Gateway: Twitter is down or being upgraded.";break;
			case 503: $message = "Service Unavailable: The Twitter servers are up, but overloaded with requests. Try again later.";break;
			default:  $message = "Code not found.";break;
			
		}
		return $message;		
	}
	
	/**
	 * obtenemos los posts paginados.
	 * @param SocialUser $oUser
	 * @param unknown_type $params
	 * @param unknown_type $count
	 * @param unknown_type $since
	 * @param unknown_type $max
	 */
	private function getPostsPaginated( SocialUser $oUser, $params, $count=null, $since=null, $max=null ){
		
		CdtUtils::log_debug("TWT API: getPostsPaginated( $count, $since, $max)");
		
		if( !empty($count ))
			$params['count'] = $count;
		if( !empty($since ))			
			$params['since_id'] = $since;
		if( !empty($max ))
			$params['max_id'] = $max;
		
		
		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_CONSUMER_KEY, CDT_SOCIAL_API_TWITTER_CONSUMER_SECRET, $oUser->getOauth_token() , $oUser->getOauth_token_secret());
		
		$userTW = $twAPI->get_accountVerify_credentials();

		$hometimeline= $twAPI->get_statusesHome_timeline( $params );
		
		//$hometimeline = $twAPI->get('/statuses/hometimeline.json', $params));
		
		//TODO ver si salió todo ok, leer el status de la llamada.
		
		$posts = json_decode( $hometimeline->responseText );
		$items = ResultFactory::arrayToCollection($posts, new SocialTWTPostFactory());
		return $items;
	}
	
}

?>