<?php
//TODO Pendiente de configurar
//Necesitamos hacer uso de PHPMailer y requerimos del autoload.php
use PHPMailer\PHPMailer\PHPMailer;

require "../../vendor/autoload.php";
function enviar_correo($email, $envio = "contacto", $nombre = "", $telefono = "", $comentario = "")
{
    //Instanciamos un objeto de la clase PHPMailer
    $mail = new PHPMailer();
    $mail->isSMTP();
    //Introduciendo el SMPTDebug en 0, no canta los errores
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    // Correo desde el que se va a enviar
    $mail->Username = "tienda.mediadaw2@gmail.com";
    // Aqui se introduce la contraseña que proporciona la cuenta de Google que te genera en la configuración de la cuenta de Google
    $mail->Password = "ulkk hgog tbjd qomv";
    //El primer argumento es el correo desde el que se envia, el segundo argumento es opcional, correspondería al nombre que le aparece al que lo recibe, en caso de no poner nada, aparece el correo
    $mail->setFrom("tienda.mediadaw2@gmail.com", "Tienda Media");
    switch ($envio) {
        case "nuevo_usuario":
            $mail->Subject = "Nuevo usuario";
            $mail->msgHTML("Bienvenido " . $nombre . " a Registro de Juegos! Te has registrado correctamente, a partir de ahora formas parte de la plataforma para registrar sus partidas de juegos de mesa.<br><br><br><br>No conteste este mensaje, correo generado y enviado automaticamente.");
            break;
        case "baja_usuario":
            $mail->Subject = "Baja confirmada";
            $mail->msgHTML("Hemos recibido su peticion de baja y le informamos que ha sido realizada con exito.<br>Esperamos que vuelva pronto!<br><br>Gracias por confiar en Registros de Juegos!<br><br><br><br>No conteste este mensaje, correo generado y enviado automaticamente.");
            break;
        // Caso para el formulario de contacto en caso de que un usuario quiera ponerse en contacto con nosotros
        case "contacto":
            $mail->Subject = "Mensaje de contacto de usuario";
            $mail->msgHTML("Mensaje de contacto.<br><br>
                Datos de usuario:<br>
                Nombre: " . $nombre . "<br>
                Email: " . $email . "<br>
                Teléfono: " . $telefono . "<br>
                Mensaje del usuario: " . $comentario . "<br><br>
                Conteste lo antes posible al usuario.");
            $mail->addAddress("tienda.mediadaw2@gmail.com");
            $resul = $mail->send();
            if (!$resul) {
                return FALSE;
            } else {
                return TRUE;
            }
            break;
        case "recuperar_contraseña":
            $mail->Subject = "Recuperacion de contrasena";
            $mail->msgHTML("Recuperacion de contrasena para la cuenta " . $email . ".<br><br>
                Si usted no ha solicitado la recuperación de contrasena, no haga caso a este mensaje.<br><br>
                Acceda al siguiente enlace y establezca su nueva contrasena.<br>
                <a href='http://localhost:3000/php/pages/cambiar_contrasena.php'><p>Click aqui para cambiar su contrasena.</p></a><br><br>
                Muchas gracias por confiar en Registros de Mesa<br><br>
                Difrute de la aplicación.");
                // Almaceno en una variable de sesión el email para poder hacer referencia a él al cambiar de contraseña
                $_SESSION["email_cambio_contraseña"] = $email;
            break;
        default:
            // Enviar correo de error
            $mail->Subject = "Algo salio mal";
            $mail->msgHTML("Lo sentimos, algo salio mal.<br><br><br><br>No conteste este mensaje, correo generado y enviado automaticamente.");
            break;
    }
    //Recibe dos argumentos, el segundo es opcional, el primero es al correo de destino, el segundo es el nombre que tendrá para ti en la agenda
    $mail->addAddress($email);
    $resul = $mail->send();
    if (!$resul) {
        return FALSE;
    } else {
        return TRUE;
    }
}
