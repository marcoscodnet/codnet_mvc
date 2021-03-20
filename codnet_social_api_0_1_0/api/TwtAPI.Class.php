<?php

/**
 * API para interactuar con Twitter.
 * 
 * 
 * @author bernardo
 * @since 29-08-2011
 *  
 */


/*
 * PARA TENER EN CUENTA:
 * códigos de respuesta de la api de twitter.
 *
    * 200 OK: Success!
    * 304 Not Modified: There was no new data to return.
    * 400 Bad Request: The request was invalid. An accompanying error message will explain why. This is the status code will be returned during rate limiting.
    * 401 Unauthorized: Authentication credentials were missing or incorrect.
    * 403 Forbidden: The request is understood, but it has been refused. An accompanying error message will explain why. This code is used when requests are being denied due to update limits.
    * 404 Not Found: The URI requested is invalid or the resource requested, such as a user, does not exists.
    * 406 Not Acceptable: Returned by the Search API when an invalid format is specified in the request.
    * 420 Enhance Your Calm: Returned by the Search and Trends API when you are being rate limited.
    * 500 Internal Server Error: Something is broken. Please post to the group so the Twitter team can investigate.
    * 502 Bad Gateway: Twitter is down or being upgraded.
    * 503 Service Unavailable: The Twitter servers are up, but overloaded with requests. Try again later.

 */
class TwtAPI implements ISocialAPI{
	
	
	public function getUser( $oauthToken, $oauthTokenSecret) {
		
		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_APP_ID, CDT_SOCIAL_API_TWITTER_APP_SECRET_ID);
		
		$twAPI ->setToken( $oauthToken, $oauthTokenSecret );
		
		$userTW = $twAPI->get_accountVerify_credentials();
		
		//construimos el usuario.
		$oFactory = new SocialTWUserFactory();
		$oSocialTWUser = $oFactory->build( $userTW );
		
		$oSocialTWUser->setToken( $token->oauth_token );
        $oSocialTWUser->setOauth_token( $token->oauth_token );
        $oSocialTWUser->setOauth_token_secret( $token->oauth_token_secret );
	        
		return $oSocialTWUser;
	}
	
	
	public function getPermissions( $urlNext ) {

		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_APP_ID, CDT_SOCIAL_API_TWITTER_APP_SECRET_ID);
		
		if (isset($_GET['oauth_token'])){
	        //Viene de twitter

			$twAPI->setToken($_GET['oauth_token']);
	        $token = $twAPI->getAccessToken();

	        $oSocialTWUser = $this->getUser( $token->oauth_token, $token->oauth_token_secret );
	        	      
			//le asignamos el token.
			$oSocialTWUser->setToken( $_GET['oauth_token'] );
			
	        $oSocialTWUser->setOauth_token($token->oauth_token);
	        $oSocialTWUser->setOauth_token_secret($token->oauth_token_secret);
	        //$oSocialTWUser->setScreen_name($value);
	        
			return $oSocialTWUser; 
	        
	    } else {
	    	header('Location: '.$twAPI->getAuthorizationUrl());
	       
	    }
			
		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::getFriends()
	 */
	function getFriends( SocialUser $user ){
		
		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_APP_ID, CDT_SOCIAL_API_TWITTER_APP_SECRET_ID, $user->getOauth_token() , $user->getOauth_token_secret());
		
		$userTW = $twAPI->get_accountVerify_credentials();

		$id = $user->getCd_code();
		if(empty ($id) )
			$id = $user->getScreen_name();
		
		$friends = $twAPI->get("/statuses/friends/$id.json");
		
		$friends = json_decode( $friends->responseText );
		
		/*
		if(!empty($friends->ids)){
			
			$items = new ItemCollection();
			
			foreach ($friends->ids as $id) {

				
			}
			
			//$items = ResultFactory::arrayToCollection($friends, new SocialTWFriendFactory());

			
		}*/
		
		if( !empty($friends) )
			$items = ResultFactory::arrayToCollection($friends, new SocialTWFriendFactory());
		else
			$items = new ItemCollection();

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
		
		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_APP_ID, CDT_SOCIAL_API_TWITTER_APP_SECRET_ID, $user->getOauth_token() , $user->getOauth_token_secret());
		
		$userTW = $twAPI->get_accountVerify_credentials();

		$hometimeline= $twAPI->get_statusesHome_timeline();
		
		$posts = json_decode( $hometimeline->responseText );
		
		$items = ResultFactory::arrayToCollection($posts, new SocialTWPostFactory());		

		return $items;
	}

	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::comment()
	 */
	function comment( SocialUser $user, SocialPost $socialPost, $comment ){
		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::post()
	 */
	function post( SocialUser $user, SocialPost $socialPost ){
		
		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_APP_ID, CDT_SOCIAL_API_TWITTER_APP_SECRET_ID, $user->getOauth_token() , $user->getOauth_token_secret());
		
		$userTW = $twAPI->get_accountVerify_credentials();
		
		$post = $twAPI->post('/statuses/update.json', array('status' => $socialPost->getText()));

		//TODO ver si salió todo ok, leer el status de la llamada.
		
		$post = json_decode( $post->responseText );
		
		$oPostFactory = new SocialTWPostFactory();
		return $oPostFactory->build( $post );
		
	}
	
	
	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::like()
	 */
	function like( SocialUser $user, SocialPost $socialPost ){
		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::forward()
	 */
	function forward( SocialUser $user, SocialPost $socialPost ){
		
		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_APP_ID, CDT_SOCIAL_API_TWITTER_APP_SECRET_ID, $user->getOauth_token() , $user->getOauth_token_secret());
		
		$userTW = $twAPI->get_accountVerify_credentials();
		
		$postid = $socialPost->getId();
		
		$post = $twAPI->post("/statuses/retweet/" . $postid . ".json" );
		
		$post = json_decode( $post->responseText );
		
		$oPostFactory = new SocialTWPostFactory();
		return $oPostFactory->build( $post );
	}	
	
	/**
	 * (non-PHPdoc)
	 * @see api/ISocialAPI::privatePost()
	 */
	function privatePost( SocialUser $user, SocialPost $socialPost, SocialFriend $oFriend ){

		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_APP_ID, CDT_SOCIAL_API_TWITTER_APP_SECRET_ID, $user->getOauth_token() , $user->getOauth_token_secret());
		
		$userTW = $twAPI->get_accountVerify_credentials();
		
		$post = $twAPI->post('/direct_messages/new.format', array('user_id' => $oFriend->getCd_code()));

		//TODO ver si salió todo ok, leer el status de la llamada.
		
		$post = json_decode( $post->responseText );
		
		$oPostFactory = new SocialTWPostFactory();
		return $oPostFactory->build( $post );
	}
	
	
	/**
	 * mentions on twitter.
	 */
	function getMentions(  SocialUser $user, $type=null, $dt_date_from='', $dt_date_to='', $page=1, $page_rowcount=null  ){
		
		$twAPI = new TwitterAPI(CDT_SOCIAL_API_TWITTER_APP_ID, CDT_SOCIAL_API_TWITTER_APP_SECRET_ID, $user->getOauth_token() , $user->getOauth_token_secret());
		
		$mentions = $twAPI->get('/statuses/mentions.json', array('include_entities' => true));

		$mentions = json_decode( $mentions->responseText );
		
		if(!empty($mentions))
			$items = ResultFactory::arrayToCollection($mentions, new SocialTWPostFactory());		
		else
			$items = new ItemCollection();
		return $items;
		
	}
	

	
}

?>