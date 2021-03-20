<?php

/**
 * IPN Handler.
 *
 * @author bernardo
 * @since 10/08/2011
 */
class PaypalIPNHandler{


	/**
	 */
	public function process( &$_Log ){

		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';

		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}

		// post back to PayPal system to validate
		$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen ('ssl://' . CDT_PAGOS_GATEWAY_PAYPAL_URL, 443, $errno, $errstr, 30);

		if (!$fp) 
			//FuncionesComunes::_log("HTTP ERROR ", $_Log);
			throw new GenericException("HTTP ERROR");

		fputs ($fp, $header . $req);
		while (!feof($fp)) {
			$res = fgets ($fp, 1024);
			if (strcmp ($res, CDT_PAGOS_GATEWAY_PAYPAL_IPN_VERIFIED ) == 0) {
				
				FuncionesComunes::_log("ipn validation: " . CDT_PAGOS_GATEWAY_PAYPAL_IPN_VERIFIED, $_Log);
				
				
				foreach ($_POST as $key => $val) {
					$keyarray[$key] = $val;
					FuncionesComunes::_log($key.'= '.$val,$_Log);
				}

				
			}
			else if (strcmp ($res, CDT_PAGOS_GATEWAY_PAYPAL_IPN_INVALID ) == 0) {
				// log for manual investigation
				//FuncionesComunes::_log("ipn validation: " . CDT_PAGOS_GATEWAY_PAYPAL_IPN_INVALID, $_Log);
				fclose ($fp);
				throw new IPNInvalidException("ipn validation: " . CDT_PAGOS_GATEWAY_PAYPAL_IPN_INVALID);
			}
		}
		fclose ($fp);
		

		return $keyarray;
	}



}

?>