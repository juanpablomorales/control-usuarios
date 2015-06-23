<?php

class Correo {

    static function enviarServidor($destino, $origen, $mensaje, $asunto) {
        $headers = "From:" . $origen;
        return mail($destino, $asunto, $mensaje, $headers);
    }

    static function enviarGmail($origen, $destino, $asunto, $mensaje, $clave) {
        require 'PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Username = $origen;
        $mail->Password = $clave;
        $mail->Subject = $asunto;
        $mail->MsgHTML($mensaje);
        $mail->IsHTML(true);
        $mail->AddAddress($destino);
        if (!$mail->Send()) {
            return $mail->ErrorInfo;
        }
        return true;
    }

    static function enviarHotmail($origen, $destino, $asunto, $mensaje, $clave) {
        require 'PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail->Host = "smtp.live.com";
        $mail->Port = 25;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Mailer = "smtp";
        $mail->Username = $origen;
        $mail->Password = $clave;
        $mail->Subject = $asunto;
        $mail->MsgHTML($mensaje);
        $mail->IsHTML(true);
        $mail->AddAddress($destino);
        if (!$mail->Send()) {
            return $mail->ErrorInfo;
        }
        return true;
    }

}
