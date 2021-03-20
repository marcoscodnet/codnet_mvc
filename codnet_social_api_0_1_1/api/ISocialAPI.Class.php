<?php

/**
 * interface para desarrollar las APIs de
 * cada red social.
 * 
 * 
 * @author bernardo
 * @since 29-08-2011
 *  
 */

interface ISocialAPI{

	
	/**
	 * Retorna los contactos/amigos de la red social.
	 * @param SocialUser $user usuario de la red social
	 * @throws SocialAPIException
	 * @return array of SocialFriend
	 */
	function getFriends( SocialUser $user );
	
	
	/**
	 * Retorna los posts de un amigo.
	 * @param SocialUser $oUser usuario de la red social
	 * @param SocialUser $oUserFriend amigo de la red social 
	 * @param array $params arreglo destinado a parámetros útiles para la paginación (dependerán de cada red social)
	 * @throws SocialAPIException
	 * @return array of SocialPost
	 */
	function getFriendPosts( SocialUser $oUser, SocialUser $oUserFriend, $params=null );
	
	/**
	 * Retorna los posts de todos los amigos, ordenado por los
	 * más recientes primero.
	 * @param SocialUser $oUser usuario de la red social
	 * @param array $params arreglo destinado a parámetros útiles para la paginación (dependerán de cada red social)
	 * @throws SocialAPIException
	 * @return array of SocialFriend
	 */
	function getPosts( SocialUser $oUser, $params=null );

	/**
	 * El usuario comenta un post.
	 * @param SocialUser $oUser usuario de la red social que realiza el comentario
	 * @param SocialPost $oSocialPost post a comentar
	 * @param string $comment comentario para el post
	 * @throws SocialAPIException
	 */
	function comment( SocialUser $oUser, SocialPost $oSocialPost, $comment );
	
	/**
	 * El usuario realiza un post.
	 * @param SocialUser $oUser usuario de la red social que realiza el post
	 * @param SocialPost $oSocialPost post a realizar
	 * @throws SocialAPIException
	 */
	function post( SocialUser $oUser, SocialPost $oSocialPost );
	
	
	/**
	 * El usuario realiza un "like" de un post.
	 * (Por ahora existe en facebook)
	 * @param SocialUser $oUser usuario de la red social
	 * @param SocialPost $oSocialPost post a marcar como "like"
	 * @throws SocialAPIException
	 */
	function like( SocialUser $oUser, SocialPost $oSocialPost );
	
	/**
	 * El usuario realiza un forward del post.
	 * (sería el retweet de twitter y el share de FB)
	 * @param SocialUser $oUser usuario de la red social que realiza el forward
	 * @param SocialPost $oSocialPost post a reenviar
	 * @throws SocialAPIException
	 */
	function forward( SocialUser $oUser, SocialPost $oSocialPost );
	
	
	
	/**
	 * El usuario realiza un post privado.
	 * @param SocialUser $oUser usuario de la red social que realiza el post
	 * @param SocialPost $oSocialPost post a realizar
	 * @param SocialUser $oUserFriend amigo al cual se le envía el post privado.
	 * @throws SocialAPIException
	 */
	function privatePost( SocialUser $oUser, SocialPost $oSocialPost, SocialUser $oUserFriend );
	
}

?>