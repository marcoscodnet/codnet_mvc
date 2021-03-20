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
	 * @param $user usuario de la red social
	 * @return array of SocialFriend
	 */
	function getFriends( SocialUser $user );
	
	
	/**
	 * Retorna los posts de un amigo.
	 * @param $user usuario de la red social
	 * @param $cd_friend identificador del amigo
	 * @param $type tipo de post de la red social
	 * @param $dt_date_from fecha desde (si se paso blanco no se considera)
	 * @param $dt_date_to fecha hasta (si se paso blanco no se considera)
	 * @param $page número de página para paginación  (si se paso blanco no se considera la paginación)
	 * @param $page_rowcount cantidad de posts por página  (si se paso blanco no se considera la paginación)
	 * @return array of SocialPost
	 */
	function getFriendPosts( SocialUser $user, $cd_friend, $type, $dt_date_from='', $dt_date_to='', $page=1, $page_rowcount=null );
	
	/**
	 * Retorna los posts de todos los amigos, ordenado por los
	 * más recientes primero.
	 * @param $user usuario de la red social
	 * @param $type tipo de post de la red social
	 * @param $dt_date_from fecha desde (si se paso blanco no se considera)
	 * @param $dt_date_to fecha hasta (si se paso blanco no se considera)
	 * @param $page número de página para paginación  (si se paso blanco no se considera la paginación)
	 * @param $page_rowcount cantidad de posts por página  (si se paso blanco no se considera la paginación)
	 * @return array of SocialFriend
	 */
	function getPosts( SocialUser $user, $type=null, $dt_date_from='', $dt_date_to='', $page=1, $page_rowcount=null );

	/**
	 * El usuario comenta un post.
	 * @param $user usuario de la red social que realiza el comentario
	 * @param SocialPost $socialPost post a comentar
	 * @param string $comment comentario para el post
	 * @return true -> success, false -> error
	 */
	function comment( SocialUser $user, SocialPost $socialPost, $comment );
	
	/**
	 * El usuario realiza un post.
	 * @param $user usuario de la red social que realiza el post
	 * @param SocialPost $socialPost post a realizar
	 * @return true -> success, false -> error
	 */
	function post( SocialUser $user, SocialPost $socialPost );
	
	
	/**
	 * El usuario realiza un "like" de un post.
	 * (Por ahora existe en facebook)
	 * @param $user usuario de la red social
	 * @param SocialPost $socialPost post a marcar como "like"
	 * @return true -> success, false -> error
	 */
	function like( SocialUser $user, SocialPost $socialPost );
	
	/**
	 * El usuario realiza un forward del post.
	 * (sería el retweet de twitter y el share de FB)
	 * @param $user usuario de la red social que realiza el forward
	 * @param SocialPost $socialPost post a reenviar
	 * @return true -> success, false -> error
	 */
	function forward( SocialUser $user, SocialPost $socialPost );
	
	
	
	/**
	 * El usuario realiza un post privado.
	 * @param $user usuario de la red social que realiza el post
	 * @param SocialPost $socialPost post a realizar
	 * @return true -> success, false -> error
	 */
	function privatePost( SocialUser $user, SocialPost $socialPost, SocialFriend $oFriend );
	
}

?>