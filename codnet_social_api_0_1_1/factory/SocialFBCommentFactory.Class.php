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
        
        $oUserFactory = new SocialFBUserFactory();
		$oFBComment->setUser( $oUserFactory->build($next['from']) );
		
		$oFBComment->setId($next['id']);
		$oFBComment->setDatetime($next['created_time']);
		$oFBComment->setText($next['message']);
		
        return $oFBComment;
    }

}
?>
