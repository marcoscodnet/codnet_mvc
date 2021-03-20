<?php

class CdtUtils{

	public static function curlGET( $url ) {
		// Create a curl handle
		$ch = curl_init( $url );
		
		curl_setopt($ch, CURLOPT_URL, $url);
		//curl_setopt($ch, CURLOPT_GET,true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		
		//curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1");
		curl_setopt($ch, CURLOPT_HEADER, false);
		//curl_setopt($ch, CURLOPT_COOKIEFILE,$this->cookie);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Language: es-es,en"));
		//curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_TIMEOUT, 160);
		curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);


		// Execute
		$response = curl_exec($ch);

		// Check if any error occured
		if(curl_errno($ch))
			throw new GenericException( curl_error($ch) );

		// Close handle
		curl_close($ch);

		return $response;
	}

	public static function curlPOST( $url, $params ) {
		// Create a curl handle
		$ch = curl_init( $url );
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		
		/*curl_setopt($ch, CURLOPT_HEADER, false);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept-Language: es-es,en"));*/
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		/*curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_TIMEOUT, 160);
		curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);*/


		// Execute
		$response = curl_exec($ch);

		// Check if any error occured
		if(curl_errno($ch))
			throw new GenericException( curl_error($ch) );

		// Close handle
		curl_close($ch);

		return $response;
	}
	
	public static function log_message($msg){
		
		if( CDT_MESSAGES_LOG){
			$nombreFile=date('Ymd') . '_cdt_messages';
			$dt = date('Y-m-d H:i:s');
		    
			$_Log = fopen(APP_PATH."logs/".$nombreFile.".log", "a+") or die("Operation Failed!");
			
			fputs($_Log, $dt . " --> " . $msg . "\n");
			
			fclose($_Log);
		}
			
	}
	
	public static function log_debug($msg){

		if( CDT_DEBUG_LOG ){
			$nombreFile=date('Ymd') . '_cdt_debug';
			$dt = date('Y-m-d H:i:s');
		    
			$_Log = fopen(APP_PATH."logs/".$nombreFile.".log", "a+") or die("Operation Failed!");
			
			fputs($_Log, $dt . " --> " . $msg . "\n");
			
			fclose($_Log);			
		}
		
			
	}
	public static function log_error($msg){
		
		if( CDT_ERROR_LOG ){
			$nombreFile=date('Ymd') . '_cdt_errors';
			$dt = date('Y-m-d H:i:s');
		    
			$_Log = fopen(APP_PATH."logs/".$nombreFile.".log", "a+") or die("Operation Failed!");
			
			fputs($_Log, $dt . " --> " . $msg . "\n");
			
			fclose($_Log);
		}
			
	}	
	
}