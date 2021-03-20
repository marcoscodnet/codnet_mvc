<?php

/**
 * Factory para un user de FB
 *
 *  @author bernardo
 *  @since 16-09-2011
 */
class SocialFBUserFactory implements ObjectFactory {

	public function build($next) {
		 
		$oFBUser = new SocialFBUser();

		//la primera vez, viene como stdClass, después como array

		if( get_class( $next ) == 'stdClass'){
			
			$oFBUser->setId( $next->id );
			$oFBUser->setUsername( $next->name );
			$oFBUser->setEmail( $next->email );
			$oFBUser->setFirst_name( $next->first_name );
			$oFBUser->setLast_name( $next->last_name );
			$oFBUser->setLink( $next->link );
			$oFBUser->setGender( $next->gender );
			$oFBUser->setTimezone($next->timezone );
			$oFBUser->setLocale( $next->locale );
			$oFBUser->setVerified( $next->verified );
			$oFBUser->setUpdated_time( $next->updated_time );
			 
			 
		}else{
			 
			$oFBUser->setId( $next['id'] );
			$oFBUser->setUsername( $next['name'] );
			$oFBUser->setEmail( $next['email'] );
			$oFBUser->setFirst_name( $next['first_name'] );
			$oFBUser->setLast_name( $next['last_name'] );
			$oFBUser->setLink( $next['link'] );
			$oFBUser->setGender( $next['gender'] );
			$oFBUser->setTimezone($next['timezone'] );
			$oFBUser->setLocale( $next['locale'] );
			$oFBUser->setVerified( $next['verified'] );
			$oFBUser->setUpdated_time( $next['updated_time'] );
		}


		$picture  = CDT_SOCIAL_API_FACEBOOK_API_GRAPH_URL . "/" . $oFBUser->getId() ."/" . CDT_SOCIAL_API_FACEBOOK_API_PICTURE;
		
		$oFBUser->setPicture( $picture );
		
		return $oFBUser;
	}

}
?>
