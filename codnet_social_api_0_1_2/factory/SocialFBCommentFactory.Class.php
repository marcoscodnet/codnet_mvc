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
		
		$oFBComment->setDatetime( $this->fbDatetime_to_phpDatetime($next['created_time']) );
		$oFBComment->setText($next['message']);
		
        return $oFBComment;
    }

	public function fbDatetime_to_phpDatetime($fb_datetime){
		//viene 2011-09-27T13:14:21+0000
		$datetime = substr($fb_datetime, 0, strlen($fb_datetime)-2) . ":" . substr($fb_datetime, strlen($fb_datetime)-2, strlen($fb_datetime)); 
		//si agrego ":" queda formato iso8601 => 2011-09-27T13:14:21+00:00
		$time = strtotime( $datetime );
		//return date( 'c', $time );
		//return date( 'Y-m-d G:i:s O', $time );
		return $time;
    }
}
?>
