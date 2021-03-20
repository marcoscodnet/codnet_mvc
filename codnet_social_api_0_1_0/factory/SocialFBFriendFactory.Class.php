<?php

/**
 * Factory para friend de FB 
 *  
 *  @author bernardo 
 *  @since 29-08-2011
 */
class SocialFBFriendFactory extends GenericFactory {

    public function build($next) {
    	
        $this->setClassName('SocialFBFriend');
        $oFBFriend = parent::build($next);

        return $oFBFriend;
    }

}
?>
