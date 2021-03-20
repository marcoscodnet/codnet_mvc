<?php

/**
 * Factory para friend de TW 
 *  
 *  @author bernardo 
 *  @since 29-08-2011
 */
class SocialTWFriendFactory implements ObjectFactory {

    public function build($next) {
    	
    	$oTWFriend = new SocialTWFriend();
        $oTWFriend->setId($next->id);
		$oTWFriend->setName($next->name);
		$oTWFriend->setProfile_image_url($next->profile_image_url); 
        $oTWFriend->setScreen_name($next->screen_name); 
        
        if ($next->stringify_ids) {
        	$oTWFriend->setId( $next->stringify_ids );
        }
        
        return $oTWFriend;
    }

}
?>
