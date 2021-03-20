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
        $oFriendFactory = new SocialFBFriendFactory();
		$oFBPost->setUser( $oFriendFactory->build($next['from']) );
		$oFBPost->setId($next['id']);
		$oFBPost->setCreated_time($next['created_time']);
		$oFBPost->setUpdated_time($next['updated_time']);

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

}
?>
