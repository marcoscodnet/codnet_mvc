<?php

/**
 * Factory para un user de FB 
 *  
 *  @author bernardo 
 *  @since 16-09-2011
 */
class SocialFBUserFactory extends GenericFactory {

    public function build($next) {
    	
        $this->setClassName('SocialFBUser');
        $oFBUser = parent::build($next);

        return $oFBUser;
    }

}
?>
