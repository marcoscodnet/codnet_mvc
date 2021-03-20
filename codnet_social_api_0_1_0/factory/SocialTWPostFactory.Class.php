<?php

/**
 * Factory para friend de FB 
 *  
 *  @author bernardo 
 *  @since 29-08-2011
 */
class SocialTWPostFactory implements ObjectFactory {

    public function build($next) {
    	
       
        $oTWPost = new SocialTWPost();
        
        $oFriendFactory = new SocialTWFriendFactory();
		$oTWPost->setUser( $oFriendFactory->build($next->user) );
		$oTWPost->setId($next->id_str);
		$oTWPost->setCreated_time($next->created_at);
		$oTWPost->setText($next->text); 
		
		/*$oSocialUser = new SocialFriend();
		$oSocialUser->setId($next->user->id);
		$oSocialUser->setName($next->user->name);
		$oSocialUser->setPicture($next->user->profile_image_url);
		$oTWPost->setUser($oSocialUser);*/
		/*$oFBPost->setUpdated_time($next['updated_time']);

		if($next['type'] == CDT_SOCIAL_API_FACEBOOK_POST_TYPE_STATUS)
			$oFBPost->setText($next['message']);
			
		elseif($next['type'] == CDT_SOCIAL_API_FACEBOOK_POST_TYPE_LINK){
			
			$text = $next['name'];
			if(empty( $text))
				$text = $next['story']; 
			$oFBPost->setText( $text );
		}
			
		elseif($next['type'] == CDT_SOCIAL_API_FACEBOOK_POST_TYPE_VIDEO)
			$oFBPost->setText($next['name']);

		elseif($next['type'] == CDT_SOCIAL_API_FACEBOOK_POST_TYPE_PHOTO){
			$text = $next['message'];
			if(empty( $text))
				$text = $next['name'];
			if(empty( $text))
				$text = $next['story']; 
			$oFBPost->setText( $text );
		}
			
			
			
		$oFBPost->setType($next['type']);*/
		
		
		
		
        return $oTWPost;
    }

}
?>
