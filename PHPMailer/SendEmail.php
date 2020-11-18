<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

class SendEmail {

    public static function newEmail($email, $newPass) {
        $mail = new PHPMailer();
        try {
            // Configuracion del servidor
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                             // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                     // Enable SMTP authentication
            $mail->Username = 'AuxiliarDAW2@gmail.com';                      // SMTP username
            $mail->Password = 'Chubaca20';                              // SMTP password
            $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 465;                                          // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            //Datos
            $mail->setFrom('AuxiliarDAW2@gmail.com');
            $mail->addAddress($email);                                  // Add a recipient
            // Contenido
            $mail->isHTML(true);                                        // Set email format to HTML
            $mail->Subject = 'Contraseña modificada: ';
            $mail->Body = 'Gracias por confiar en nosotros, tu nueva contraseña es: '  . $newPass;
            $mail->AltBody = 'Gracias por confiar en nosotros, tu nueva contraseña es: '  . $newPass;

            $mail->send();
            echo 'Mensaje enviado correctamente';
        } catch (Exception $e) {
            echo "Error al enviar un mensaje: {$mail->ErrorInfo}";
        }
    }

}
