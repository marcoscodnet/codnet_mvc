<?php

class FuncionesComunes
{

	/********************************************************
	 *	Convierte una fecha con formato "20/06/2008
	 *   al formato con el que se almacena en la BD 20080620
	 *********************************************************/
	static function fechaPHPaMysql($fechaPHP)
	{
		$fechaPHP = str_replace("-", "/", $fechaPHP);
		$nuevaFecha = explode ( "/", $fechaPHP );
		//invierto los campos
		$fechaMySql [0] = $nuevaFecha [2];
		$fechaMySql [1] = $nuevaFecha [1];
		$fechaMySql [2] = $nuevaFecha [0];
		$fechaMySql = implode ( "", $fechaMySql );
		return ($fechaMySql);
	}

	static function fechaMysqlaPHP($fechaMysql)
	{
		//20080618
		$arrayFecha [0] = substr ( $fechaMysql, - 2 );
		$arrayFecha [1] = substr ( $fechaMysql, 4, 2 );
		$arrayFecha [2] = substr ( $fechaMysql, 0, 4 );
		$fechaPHP = implode ( "/", $arrayFecha );
		return $fechaPHP;
	}
	
	static function fechaHoraMysqlaPHP($fechaMysql) {
		//20080618
		$arrayFecha [0] = substr ( $fechaMysql,6,2 );
		$arrayFecha [1] = substr ( $fechaMysql, 4, 2 );
		$arrayFecha [2] = substr ( $fechaMysql, 0,4 );
		$fechaPHP = implode ( "/", $arrayFecha );
		$arrayHora [0] = substr ( $fechaMysql,8,2 );
		$arrayHora [1] = substr ( $fechaMysql,10,2 );
		$arrayHora [2] = substr ( $fechaMysql,-2 );
		$horaPHP = implode ( ":", $arrayHora );
		return $fechaPHP.' '.$horaPHP;
	}	

	static function redondear($valor)
	{
		$float_redondeado = round ( $valor * 100 ) / 100;
		return $float_redondeado;
	}

	static function _log($str, $_Log) {
		$dt = date('Y-m-d H:i:s');
		fputs($_Log, $dt." --> ".$str."\n");
	}

	static function existObjectComparator($array, $i, $comparator){
		foreach ($array as $item){
			if ($comparator->equals($item,$i)) {
				return true;
			}
		}
		return false;
	}

	static function getObjectComparator($array, $i, $comparator){
		foreach ($array as $item){
			if ($comparator->equals($item,$i)) {
				return $item;
			}
		}
		return false;
	}

	static function getMesDeNumero($numero){
		$meses = array('01'=>'Enero',
					  '02'=>'Febrero',
					  '03'=>'Marzo',
					  '04'=>'Abril',
					  '05'=>'Mayo',
					  '06'=>'Junio',
					  '07'=>'Julio',
					  '08'=>'Agosto',
					  '09'=>'Septiembre',
					  '1'=>'Enero',
					  '2'=>'Febrero',
					  '3'=>'Marzo',
					  '4'=>'Abril',
					  '5'=>'Mayo',
					  '6'=>'Junio',
					  '7'=>'Julio',
					  '8'=>'Agosto',
					  '9'=>'Septiembre',
					  '10'=>'Octubre',
					  '11'=>'Noviembre',
					  '12'=>'Diciembre');
		return $meses[$numero];
	}
	
	static function textoRadom($length = 8){
	  $string = "";
	  $possible = "0123456789bcdfghjkmnpqrstvwxyz";
	  $i = 0;
	  while ($i < $length) {
	    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
	    $string .= $char;
	    $i++;
	  }
	  return $string;
	}
	
	public static function enviarMailPop($nombre_destinatario, $to, $subject, $msg){
		
		
		require(APP_PATH . "mailer/class.phpmailer.php");
		require(APP_PATH . "mailer/class.smtp.php");
		

		//para que no de la salida del mailer.
		ob_start();
		
		$mail = new PHPMailer();
		
		$mail->From     = UGC_MAIL_FROM;
		$mail->FromName = UGC_MAIL_FROM_NAME;
		$mail->Host     = UGC_MAIL_HOST;
		$mail->Mailer   = UGC_MAIL_MAILER;
		$mail->Username	= UGC_MAIL_USERNAME;
		$mail->Password	= UGC_MAIL_PASSWORD;
		$mail->SMTPAuth	= true;
		$mail->Subject = $subject;
		
	    $body  =  $msg;
	
	    $mail->Body    = $body;
	    $mail->AltBody = $body;
	    
	    $mail->AddAddress($to, $nombre_destinario);
	
	    if(!$mail->Send())
	        throw new GenericException("Ocurrió un error en el envío del mail a $nombre_destinario <$to>");
	
	    // Clear all addresses and attachments for next loop
	    $mail->ClearAddresses();
	    $mail->ClearAttachments();

	    //para que no de la salida del mailer.
	    ob_end_clean();
		
	}	
	
	public static function enviarMail($nombre_destinatario, $to, $subject, $msg){
		
		//para que no de la salida del mailer.
		ob_start();
		
		$to2 = $nombre_destinatario." <".$to.">";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: ".UGC_MAIL_FROM;
		
		if (!mail($to2,$subject,$msg,$headers))
			throw new GenericException("Ocurrió un error en el envío del mail a $to2");

		//para que no de la salida del mailer.
	    ob_end_clean();
		
	}	
}
?>