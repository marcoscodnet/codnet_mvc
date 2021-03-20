<?php

/**
 * IPN Handler.
 *
 * @author     Torleif Berger
 * @link       http://www.geekality.net/?p=1420
 * @copyright  © 2011 www.geekality.net
 *
 * @link https://cms.paypal.com/cms_content/US/en_US/files/developer/IPNGuide.pdf
 * @link http://curl.haxx.se/docs/caextract.html
 */
class PaypalPDTHandler{

	const charset = 'utf-8';


	public function process( &$_Log ){

		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-synch';

		$tx_token =FormatUtils::getParam(CDT_PAGOS_GATEWAY_PAYPAL_PDT_TX_TOKEN);
		$auth_token = CDT_PAGOS_GATEWAY_PAYPAL_PDT_IDENTITY_TOKEN;
		$req .= "&tx=$tx_token&at=$auth_token";

		// post back to PayPal system to validate
		$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen ( CDT_PAGOS_GATEWAY_PAYPAL_URL, 80, $errno, $errstr, 30);
		// If possible, securely post back to paypal using HTTPS
		// Your PHP server will need to be SSL enabled
		// $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

		if (!$fp) 
			// HTTP ERROR
			throw new GenericException("HTTP ERROR");
			//FuncionesComunes::_log("HTTP ERROR ", $_Log);
		fputs ($fp, $header . $req);
		// read the body data
		$res = '';
		$headerdone = false;
		while (!feof($fp)) {
			$line = fgets ($fp, 1024);
			if (strcmp($line, "\r\n") == 0) {
				// read the header
				$headerdone = true;
			}
			else if ($headerdone)
			{
				// header has been read. now read the contents
				$res .= $line;
			}
		}

		// parse the data
		$lines = explode("\n", $res);
		$keyarray = array();
		if (strcmp ($lines[0], CDT_PAGOS_GATEWAY_PAYPAL_PDT_SUCCESS) == 0) {
			
			FuncionesComunes::_log("tx validation: " . CDT_PAGOS_GATEWAY_PAYPAL_PDT_SUCCESS, $_Log);
			
			for ($i=1; $i<count($lines);$i++){
				list($key,$val) = explode("=", $lines[$i]);
				$keyarray[urldecode($key)] = urldecode($val);
				
				FuncionesComunes::_log(urldecode($key).'= '.urldecode($val),$_Log);
			}
			
				
		}
		else if (strcmp ($lines[0], CDT_PAGOS_GATEWAY_PAYPAL_PDT_FAIL ) == 0) {
			// log for manual investigation
			//FuncionesComunes::_log("tx token validation: " . CDT_PAGOS_GATEWAY_PAYPAL_PDT_FAIL, $_Log);
			fclose ($fp);
			throw new PDTFailException("tx token validation: " . CDT_PAGOS_GATEWAY_PAYPAL_PDT_FAIL );
		}


		fclose ($fp);
		return $keyarray;
	}
}

?>