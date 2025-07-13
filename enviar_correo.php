<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/autoload.php';

function enviarCorreoConfirmacion($destinatario, $nombre, $token) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'escuelacrud@gmail.com';
        $mail->Password   = 'ngim ehda yidu xzea';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('escuelacrud@gmail.com', 'Sistema Escolar');
        $mail->addAddress($destinatario, $nombre);

        $mail->isHTML(true);
        $mail->Subject = 'Confirma tu cuenta';

        $link = "http://localhost/proyecto_crud/controllers/confirmar.php?token=$token";

        $mail->Body = "
        <div style='
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            background-color: #f9f9f9;
        '>
            <h2 style='color: #0d6efd;'>Hola $nombre,</h2>
            <p>Gracias por registrarte. Por favor haz clic en el botón de abajo para confirmar tu cuenta:</p>
            <a href='$link' style='
                display: inline-block;
                padding: 10px 20px;
                background-color: #0d6efd;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            '>Confirmar cuenta</a>
            <p style='margin-top: 20px; font-size: 0.9em;'>
                Si no solicitaste esta cuenta, puedes ignorar este mensaje.
            </p>
        </div>
        ";

        $mail->AltBody = "Hola $nombre,\n\nGracias por registrarte. Confirma tu cuenta en este enlace:\n$link\n\nSi no solicitaste esta cuenta, puedes ignorar este mensaje.";

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}
