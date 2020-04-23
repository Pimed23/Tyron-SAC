<?php

$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$mensaje = $_POST["mensaje"];
$body = "Nombre: " . $nombre . "<br>Correo: " . $correo . "<br>Telefono: " . $telefono . "<br>Mensaje: " . $mensaje;

$ruta="documents/".$_FILES['archivo']['name'];
move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'b.pimed@gmail.com';                     // SMTP username
    $mail->Password   = 'Rognar23';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('b.pimed@gmail.com', $nombre);
    $mail->addAddress('b.pimed@gmail.com');     // Add a recipient

    // Attachments
    $mail->addAttachment($ruta);         // Add attachments
/*
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
*/
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Solicitud empleo';
    $mail->Body    = $body;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->Charset = 'UTF-8';
    $mail->send();
        echo '<script>
            alert("El mensaje se envio correctamente");
            window.history.go(-1);        
            </script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
