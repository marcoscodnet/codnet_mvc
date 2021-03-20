<?php

/**
 * Factory para friend de FB 
 *  
 *  @author bernardo 
 *  @since 29-08-2011
 */
class SocialFBPostFactory implements ObjectFactory {

    public function build($next) {
    	
       
        $oFBPost = new SocialFBPost();
        
        //construimos el usuario del post.
        $oUserFactory = new SocialFBUserFactory();
		$oFBPost->setUser( $oUserFactory->build($next['from']) );
		
		
		$oFBPost->setId($next['id']);
		
		//TODO convertir fechas a formato dd/MM/yyyy mm:ss
		$oFBPost->setDatetime( $this->fbDatetime_to_phpDatetime($next['created_time']) );
		$oFBPost->setUpdated_time(  $this->fbDatetime_to_phpDatetime($next['updated_time']) );

		
		if($next['type'] == CDT_SOCIAL_API_FACEBOOK_POST_TYPE_STATUS){

			$text = $next['message'];
			if(empty( $text))
				$text = $next['story']; 
				
		}elseif($next['type'] == CDT_SOCIAL_API_FACEBOOK_POST_TYPE_LINK){
			
			$text = $next['story'];
			if(empty( $text))
				$text = $next['name']; 
			
		
		}elseif($next['type'] == CDT_SOCIAL_API_FACEBOOK_POST_TYPE_VIDEO)
			$text = $next['name'];

		
		elseif($next['type'] == CDT_SOCIAL_API_FACEBOOK_POST_TYPE_PHOTO){
			
			$text = $next['message'];
			if(empty( $text))
				$text = $next['story'];
			if(empty( $text))
				$text = $next['name']; 
			
		}else {
			$text = $next['message'];
		}
			
		$oFBPost->setText( $text );
		
		$oFBPost->setType($next['type']);
		

		//mapeadmos los comentarios.
		/*
		 * 
		  "comments": {
			    "data": [
			      {
			        "id": "100002889521562_118210131618637_106290",
			        "from": {
			          "name": "Bernardo Iribarne",
			          "id": "635427779"
			        },
			        "message": "comentando desde la api a las 16:04",
			        "created_time": "2011-09-22T19:04:35+0000"
			      }
			    ],
			    "count": 1
		  }
		 */
		$comments = $next['comments']['data'];
		
		if(!empty( $comments )){
			
			$items = ResultFactory::arrayToCollection($comments, new SocialFBCommentFactory());
		
			$oFBPost->setComments( $items );
			
		}
		
		
        return $oFBPost;
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
