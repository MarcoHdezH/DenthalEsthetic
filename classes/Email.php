<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public $nombre;
    public $apellido;
    public $email;
    public $token;

    public function __construct($nombre, $apellido, $email, $token)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        //Credenciales MailTrap
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['MAIL_PORT'];
        $mail->Username = $_ENV['MAIL_USER'];
        $mail->Password = $_ENV['MAIL_PASS'];

        $mail->setFrom('DentalEsthetic@correo.com', 'Dental Esthetic');
        $mail->addAddress($this->email, $this->nombre . ' ' . $this->apellido);
        $mail->Subject = 'Confirmacion de Creacion de Cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        //Conteindo  del Mensaje
        $contenido = '<html>';
        $contenido .= '<p> <strong>Hola' . $this->nombre . ' ' . $this->apellido . '</strong> Has creado una cuenta en Dental Esthetic,
                        Solo debes confirmarla en el sigueinte enlace </p>';
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, favor de ignorar este mensaje</p>";
        $contenido .= "</html>";

        $mail->Body=$contenido;

        $mail->send();
    }

    public function enviarInstrucciones(){
        //Credenciales MailTrap
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = $_ENV['MAIL_USER'];
        $mail->Password = $_ENV['MAIL_PASS'];

        $mail->setFrom('DentalEsthetic@correo.com', 'Dental Esthetic');
        $mail->addAddress($this->email, $this->nombre . ' ' . $this->apellido);
        $mail->Subject = 'Reestablecer Contraseña';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        //Conteindo  del Mensaje
        $contenido = '<html>';
        $contenido .= '<p> <strong>Hola' . $this->nombre . ' ' . $this->apellido . '</strong> Has solicitado un restablecimiento de tu contraseña,
                        Solo debes dar click en el sigueinte enlace </p>';
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/recuperar?token=" . $this->token . "'>Restablecer Contraseña</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, favor de ignorar este mensaje</p>";
        $contenido .= "</html>";

        $mail->Body=$contenido;

        $mail->send();
    }
}
