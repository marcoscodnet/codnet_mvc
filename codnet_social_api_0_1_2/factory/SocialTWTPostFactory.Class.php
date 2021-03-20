<?php

/**
 * Factory para un post de twitter. 
 *  
 *  @author bernardo 
 *  @since 29-08-2011
 */
class SocialTWTPostFactory implements ObjectFactory {

    public function build($next) {
    	
        $oTWPost = new SocialTWTPost();
        
        $oUserFactory = new SocialTWTUserFactory();
		$oTWPost->setUser( $oUserFactory->build($next->user) );
		
		$oTWPost->setId($next->id_str);
		$oTWPost->setDatetime($this->twtDatetime_to_phpDatetime($next->created_at) );
		$oTWPost->setText($next->text); 
		
		
        return $oTWPost;
    }

    public function twtDatetime_to_phpDatetime($twt_datetime){
		//viene Wed Sep 28 18:11:15 +0000 2011
		//$datetime = substr($twt_datetime, 0, strlen($twt_datetime)-2) . ":" . substr($twt_datetime, strlen($twt_datetime)-2, strlen($twt_datetime)); 
		//si agrego ":" queda formato iso8601 => 2011-09-27T13:14:21+00:00
		$time = strtotime( $twt_datetime );
		//return date( 'D M j G:i:s O Y', $time );
		//return date( 'Y-m-d G:i:s O', $time );
		return $time;
    }    
}
?>
