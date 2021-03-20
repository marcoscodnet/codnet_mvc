<?php

/**
 * Factory para un user de TW 
 *  
 *  @author bernardo 
 *  @since 16-09-2011
 */
class SocialTWUserFactory extends GenericFactory {

    public function build($next) {
    	
        $this->setClassName('SocialTWUser');
        $oTWUser = parent::build($next);

        return $oTWUser;
    }

}

?>
