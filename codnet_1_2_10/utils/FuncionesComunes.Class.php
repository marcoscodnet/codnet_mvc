<?php

class FuncionesComunes {
    /*     * ******************************************************
     * 	Convierte una fecha con formato "20/06/2008
     *   al formato con el que se almacena en la BD 20080620
     * ******************************************************* */

    static function fechaPHPaMysql($fechaPHP) {
        $fechaPHP = str_replace("-", "/", $fechaPHP);
        $nuevaFecha = explode("/", $fechaPHP);
        //invierto los campos
        $fechaMySql [0] = $nuevaFecha [2];
        $fechaMySql [1] = $nuevaFecha [1];
        $fechaMySql [2] = $nuevaFecha [0];
        $fechaMySql = implode("", $fechaMySql);
        return ($fechaMySql);
    }

    //Entrada: $fechaPHP en formato mm-dd-yy
    //Salida: $fechaPHP en formato yyyymmdd
    static function fechaPHPmmddyyaMysql($fechaPHP) {
        $fechaPHP = str_replace("-", "/", $fechaPHP);
        $nuevaFecha = explode("/", $fechaPHP);
        //invierto los campos
        $fechaMySql [0] = $nuevaFecha [2]; //anio
        $fechaMySql [1] = $nuevaFecha [0]; // mes
        $fechaMySql [2] = $nuevaFecha [1]; // dia

        $fechaMySql = implode("", $fechaMySql);
        return ($fechaMySql);
    }

     //Entrada: $fechaPHP en formato yy-mm-dd
    //Salida: $fechaPHP en formato yyyymmdd
    static function fechaPHPyymmddaMysql($fechaPHP) {
        $fechaPHP = str_replace("/", "-", $fechaPHP);
        $nuevaFecha = explode("-", $fechaPHP);
        $fechaMySql = implode("", $nuevaFecha);
        return ($fechaMySql);
    }

    //Entrada: $fechaMysql en formato yyyymmdd
    //Salida: $fechaPHP en formato mm-dd-yy
    static function fechaMysqlammddyyPHP($fechaMysql) {
        //20080618 yyyymmdd
        $arrayFecha [0] = substr($fechaMysql, 4, 2);
        $arrayFecha [1] = substr($fechaMysql, - 2);
        $arrayFecha [2] = substr($fechaMysql, 0, 4);
        $fechaPHP = implode("-", $arrayFecha);
        return $fechaPHP;
    }

    //Entrada: $fechaMysql en formato yyyymmdd
    //Salida: $fechaPHP en formato yy-mm-dd
    static function fechaMysqlayymmddPHP($fechaMysql) {
        //20080618 yyyymmdd
        $arrayFecha [0] = substr($fechaMysql, 0, 4);
        $arrayFecha [1] = substr($fechaMysql, 4, 2);
        $arrayFecha [2] = substr($fechaMysql, - 2);
        
        $fechaPHP = implode("-", $arrayFecha);
        return $fechaPHP;
    }

    static function fechaMysqlaPHP($fechaMysql) {
        //20080618
        $arrayFecha [0] = substr($fechaMysql, - 2);
        $arrayFecha [1] = substr($fechaMysql, 4, 2);
        $arrayFecha [2] = substr($fechaMysql, 0, 4);
        $fechaPHP = implode("/", $arrayFecha);
        return $fechaPHP;
    }

    static function fechaStringToDateFormatYmd($fechaMysql) {
        //20080618
        $arrayFecha [2] = substr($fechaMysql, - 2);
        $arrayFecha [1] = substr($fechaMysql, 4, 2);
        $arrayFecha [0] = substr($fechaMysql, 0, 4);
        $fechaDateFormat = implode("-", $arrayFecha);
        return $fechaDateFormat;
    }

    static function fechaHoraMysqlaPHP($fechaMysql) {
        //20080618
        $arrayFecha [0] = substr($fechaMysql, 6, 2);
        $arrayFecha [1] = substr($fechaMysql, 4, 2);
        $arrayFecha [2] = substr($fechaMysql, 0, 4);
        $fechaPHP = implode("/", $arrayFecha);
        $arrayHora [0] = substr($fechaMysql, 8, 2);
        $arrayHora [1] = substr($fechaMysql, 10, 2);
        $arrayHora [2] = substr($fechaMysql, -2);
        $horaPHP = implode(":", $arrayHora);
        return $fechaPHP . ' ' . $horaPHP;
    }

    static function redondear($valor) {
        $float_redondeado = round($valor * 100) / 100;
        return $float_redondeado;
    }

    static function _log($str, $_Log) {
        $dt = date('Y-m-d H:i:s');
        fputs($_Log, $dt . " --> " . $str . "\n");
    }

    static function existObjectComparator($array, $i, $comparator) {
        foreach ($array as $item) {
            if ($comparator->equals($item, $i)) {
                return true;
            }
        }
        return false;
    }

    static function getObjectComparator($array, $i, $comparator) {
        foreach ($array as $item) {
            if ($comparator->equals($item, $i)) {
                return $item;
            }
        }
        return false;
    }

    static function getMesDeNumero($numero) {
        $meses = array('01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '1' => 'Enero',
            '2' => 'Febrero',
            '3' => 'Marzo',
            '4' => 'Abril',
            '5' => 'Mayo',
            '6' => 'Junio',
            '7' => 'Julio',
            '8' => 'Agosto',
            '9' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre');
        return $meses[$numero];
    }

    static function textoRadom($length = 8) {
        $string = "";
        $possible = "0123456789bcdfghjkmnpqrstvwxyz";
        $i = 0;
        while ($i < $length) {
            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            $string .= $char;
            $i++;
        }
        return $string;
    }

    public static function enviarMailPop($nombre_destinatario, $to, $subject, $msg) {


        require_once(APP_PATH . "mailer/class.phpmailer.php");
        require_once(APP_PATH . "mailer/class.smtp.php");


        //para que no de la salida del mailer.
        ob_start();

        $mail = new PHPMailer();

        $mail->From = CDT_POP_MAIL_FROM;
        $mail->FromName = CDT_POP_MAIL_FROM_NAME;
        $mail->Host = CDT_POP_MAIL_HOST;
        $mail->Mailer = CDT_POP_MAIL_MAILER;
        $mail->Username = CDT_POP_MAIL_USERNAME;
        $mail->Password = CDT_POP_MAIL_PASSWORD;
        $mail->SMTPAuth = true;
        $mail->Subject = $subject;

        $body = $msg;

        $mail->Body = $body;
        $mail->AltBody = $body;

        $mail->AddAddress($to, $nombre_destinatario);

        if (!$mail->Send())
            throw new GenericException("Ocurrió un error en el envío del mail a $nombre_destinatario <$to>");

        // Clear all addresses and attachments for next loop
        $mail->ClearAddresses();
        $mail->ClearAttachments();

        //para que no de la salida del mailer.
        ob_end_clean();
    }

    public static function enviarMail($nombre_destinatario, $to, $subject, $msg) {

        if (CDT_MAIL_ENVIO_POP)
            FuncionesComunes::enviarMailPop($nombre_destinatario, $to, $subject, $msg);
        else {

            //para que no de la salida del mailer.
            ob_start();

            $to2 = $nombre_destinatario . " <" . $to . ">";
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: " . CDT_POP_MAIL_FROM;

            if (!mail($to2, $subject, $msg, $headers))
                throw new GenericException("OOOcurrió un error en el envío del mail a $to2");

            //para que no de la salida del mailer.
            ob_end_clean();
        }
    }

    public static function getFechaHoraActual() {

        $f = date('YmdHis');
        return $f;
    }

    public static function getFechaActual() {
        $f = date('Ymd');
        return $f;
    }

}
?>