<?php
@session_start();
require_once "../functions/funciones_usuario.php";
//Verificamos que los datos han sido enviados por POST para asegurarnos que la función se ejecutará una vez el formulario haya sido enviado.
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["registro"])) {
    $registro = crearUsuario($_POST['user_name'], $_POST['email'], $_POST['contraseña'], $_POST["contraseña_verif"]);
    if ($registro) {
        header("Location: ../pages/index.php?registro=correcto");
    } else {
        header("Location: ../pages/registro.php?error=registro");
    }
}

//Verificamos que los datos han sido enviados por POST para asegurarnos que la función se ejecutará una vez el formulario haya sido enviado.
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["login"])) {
    $registro = login($_POST['email'], $_POST['contraseña']);
    if ($registro) {
        header("Location: ../pages/index.php?registro=correcto");
    } else {
        header("Location: ../pages/login.php?error=registro");
    }
}

// Control para acceder mediante el formulario de recuperación de contraseña
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["recuperar_contraseña"])) {
    // Comprobamos que el email existe en la base de datos
    $comprobar_email = comprobar_email($_POST["email"]);
    if (!$comprobar_email || $_POST["email"] != $comprobar_email["email"]) {
        // Si el email no existe, redirigimos con el mensaje correspondiente
        header("Location: ../pages/recuperar_contraseña.php?email=no_existe&email_user=" . urlencode($_POST["email"]) . "");
        exit; // Importante: detenemos la ejecución del script
    }

    $recuperar_contraseña = enviar_correo($_POST['email'], "recuperar_contraseña");
    if ($recuperar_contraseña) {
        header("Location: ../pages/recuperar_contraseña.php?email=enviado");
    } else {
        header("Location: ../pages/recuperar_contraseña.php?email=no_enviado");
    }
}

// Establecer nueva contraseña en caso de acceder mediante la recuperación de contraseña
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["cambiar_contraseña"])) {

    $cambiar_contraseña = restablecer_contraseña($_POST['email'], $_POST["contraseña"], $_POST["repetir_contraseña"]);
    if ($cambiar_contraseña) {
        header("Location: ../pages/cambiar_contrasena.php?contraseña=cambiada");
    } else {
        header("Location: ../pages/cambiar_contrasena.php?contraseña=no_cambiada");
    }
}

//Comprobación para el envío de correo mediante el formulario de contacto
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["contacto"])) {
    $contacto = enviar_correo($_POST['email'], "contacto", $_POST['nombre'], $_POST["telefono"], $_POST["comentarios"]);
    if ($contacto) {
        header("Location: ../pages/formulario_contacto.php?contacto=correcto");
    } else {
        header("Location: ../pages/formulario_contacto.php?contacto=error");
    }
}

//Verificamos que los datos han sido enviados por POST para asegurarnos que la función se ejecutará una vez el formulario haya sido enviado.
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["registro_partida"])) {
    $registro_partida = registrarPartida($_SESSION["id"], $_POST['id_juego'], $_POST["lugar"], $_POST['fecha_partida'], $_POST['comentarios']);
    if ($registro_partida) {
        header("Location: ../pages/partidas_disponibles.php?partida=registrada");
    } else {
        header("Location: ../pages/registro_partidas.php?partida=no_registrada");
    }
}

// Control para editar una partida registrada
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["editar_partida"])) {
    $editar_partida = editarPartida($_POST["id_partida"], $_POST['id_juego'], $_POST['fecha_partida'], $_POST['comentarios']);
    var_dump($editar_partida);
    if ($editar_partida) {
        header("Location: ../pages/partidas_disponibles.php?partida=editada");
    } else {
        header("Location: ../pages/partidas_disponibles.php?partida=no_editada");
    }
}

// Eliminamos un registro de partida y redirigimos con get para comprobar su ejecucción correctamente
if (isset($_GET["eliminar"]) && isset($_SESSION["id"]) && $_SESSION["id"] == $_GET["user"]) {
    $result = eliminarPartida($_GET["eliminar"]);
    if ($result) {
        header("Location: ../pages/partidas_disponibles.php?partida=eliminada");
    } else {
        header("Location: ../pages/partidas_disponibles.php?partida=no_eliminada");
    }
}

// Control del cambio de datos de un usuario mediante el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["modificar_datos"])) {
    $cambiar_datos = cambiarDatos($_POST["user_name"], $_POST["email"], $_SESSION["id"]);
    if ($cambiar_datos) {
        header("Location: ../pages/micuenta.php?modificacion=exito");
    } else {
        header("Location: ../pages/micuenta.php?modificacion=error");
    }
}

// Control del cambio de contraseña de un usuario mediante el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["modificar_contraseña"])) {
    $cambiar_contraseña = cambiarContraseña($_SESSION["id"], $_POST["contraseña"], $_POST["nueva_contraseña"], $_POST["confirmacion_nueva_contraseña"]);
    if ($cambiar_contraseña) {
        header("Location: ../pages/micuenta.php?modificacion=exito");
    } else {
        header("Location: ../pages/micuenta.php?modificacion=error");
    }
}

// Control para eliminar la cuenta del usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["eliminar_cuenta"])) {
    $cambiar_contraseña = bajaUsuario($_SESSION["id"], $_POST["contraseña_eliminar_cuenta"], $_POST["repetir_contraseña_eliminar_cuenta"]);
    if ($cambiar_contraseña) {
        header("Location: ../pages/index.php?cuenta_eliminada=exito");
    } else {
        header("Location: ../pages/micuenta.php?cuenta_eliminada=error");
    }
}

// Control para unirse a una partida o participar en ella
if (isset($_GET["participar"]) && isset($_SESSION["id"])) {
    $unirse_partida = unirse_partida($_GET["participar"], $_SESSION["id"]);
    if ($unirse_partida) {
        header("Location: ../pages/partidas_disponibles.php?partida=participa");
    } else {
        header("Location: ../pages/partidas_disponibles.php?partida=no_participa");
    }
}

// Control para salirse de una partida
if (isset($_GET["no_participar"]) && isset($_SESSION["id"])) {
    $salir_partida = salir_partida($_GET["no_participar"], $_SESSION["id"]);
    if ($salir_partida) {
        header("Location: ../pages/partidas_disponibles.php?partida=dejar_participar");
    } else {
        header("Location: ../pages/partidas_disponibles.php?partida=no_dejar_participar");
    }
}