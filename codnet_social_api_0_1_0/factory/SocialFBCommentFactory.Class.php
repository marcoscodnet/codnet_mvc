<?php

/**
 * Factory para comment de FB 
 *  
 *  @author bernardo 
 *  @since 22-09-2011
 */
class SocialFBCommentFactory implements ObjectFactory {

    public function build($next) {
    	
       
        $oFBComment = new SocialFBComment();
        
        $oFriendFactory = new SocialFBFriendFactory();
		$oFBComment->setUser( $oFriendFactory->build($next['from']) );
		
		$oFBComment->setId($next['id']);
		$oFBComment->setCreated_time($next['created_time']);
		$oFBComment->setText($next['message']);
		
        return $oFBComment;
    }

}
?>
