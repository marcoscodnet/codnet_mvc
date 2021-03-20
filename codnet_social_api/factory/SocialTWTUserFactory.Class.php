<?php

/**
 * Factory para un user de Twitter 
 *  
 *  @author bernardo 
 *  @since 16-09-2011
 */
class SocialTWTUserFactory implements ObjectFactory{

    public function build($next) {
    	
    	$oUser = new SocialTWTUser();
    	
        $oUser->setId($next->id);
		$oUser->setName($next->name);
		$oUser->setPicture($next->profile_image_url); 
        $oUser->setUsername($next->screen_name); 
        
        if ($next->stringify_ids) {
        	$oUser->setId( $next->stringify_ids );
        }

        return $oUser;
    }

}

?>
