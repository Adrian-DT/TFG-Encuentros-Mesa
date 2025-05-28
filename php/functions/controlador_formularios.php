<?php
@session_start();
require_once "../functions/funciones_usuario.php";

// Este script gestiona el control de todos los formularios y las redirecciones mediante $_GET


//Caso del formulario de registro.
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["registro"])) {
    $registro = crearUsuario($_POST['user_name'], $_POST['email'], $_POST['contraseña'], $_POST["contraseña_verif"]);
    // En caso correcto, rediriguimos al index, en caso contrario, mostramos el error que retorna la función mediante $_GET
    if ($registro === true) {
        header("Location: ../pages/index.php?registro=correcto");
    } else {
        header("Location: ../pages/registro.php?error=" . $registro);
    }
}

//Caso del formulario de login.
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["login"])) {
    $login = login($_POST['email'], $_POST['contraseña']);
    // En caso correcto, redirigimos a index, en caso contrario, mostramos el error que retorna la función mediante $_GET
    if ($login === true) {
        header("Location: ../pages/index.php?login=correcto");
    } else {
        header("Location: ../pages/login.php?login=" . $login);
    }
}

// Caso del formulario de recuperación de contraseña
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

// Caso del formulario de cambiar contraseña.
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["cambiar_contraseña"])) {
    $cambiar_contraseña = restablecer_contraseña($_POST['email'], $_POST["contraseña"], $_POST["repetir_contraseña"]);
    // Redireccion en función de si sucedió correctamente o no.
    if ($cambiar_contraseña) {
        header("Location: ../pages/cambiar_contrasena.php?contraseña=cambiada");
    } else {
        header("Location: ../pages/cambiar_contrasena.php?contraseña=no_cambiada");
    }
}

//Caso para el formulario de contacto.
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["contacto"])) {
    $contacto = enviar_correo($_POST['email'], "contacto", $_POST['nombre'], $_POST["telefono"], $_POST["comentarios"]);
    // Redireccion en función de si sucedió correctamente o no.
    if ($contacto) {
        header("Location: ../pages/formulario_contacto.php?contacto=correcto");
    } else {
        header("Location: ../pages/formulario_contacto.php?contacto=error");
    }
}

//Caso para el formulario de registrar una partida.
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["registro_partida"])) {
    $registro_partida = registrarPartida($_SESSION["id"], $_POST['id_juego'], $_POST["lugar"], $_POST['fecha_partida'], $_POST['comentarios']);
    // Redireccion en función de si sucedió correctamente o no.
    if ($registro_partida) {
        header("Location: ../pages/partidas_disponibles.php?partida=registrada");
    } else {
        header("Location: ../pages/registro_partidas.php?partida=no_registrada");
    }
}

// Caso para el formulario de editar partida.
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["editar_partida"])) {
    $editar_partida = editarPartida($_POST["id_partida"], $_POST['id_juego'], $_POST['fecha_partida'], $_POST['comentarios'], $_POST["lugar"]);
    // Redireccion en función de si sucedió correctamente o no.
    if ($editar_partida) {
        header("Location: ../pages/partidas_disponibles.php?partida=editada");
    } else {
        header("Location: ../pages/partidas_disponibles.php?partida=no_editada");
    }
}

// Caso para el formulario de eliminar partida.
if (isset($_GET["eliminar"]) && isset($_SESSION["id"]) && $_SESSION["id"] == $_GET["user"]) {
    $result = eliminarPartida($_GET["eliminar"]);
    // Redireccion en función de si sucedió correctamente o no.
    if ($result) {
        header("Location: ../pages/partidas_disponibles.php?partida=eliminada");
    } else {
        header("Location: ../pages/partidas_disponibles.php?partida=no_eliminada");
    }
}

// Caso para el formulario de cambiar datos de la cuenta.
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["modificar_datos"])) {
    $cambiar_datos = cambiarDatos($_POST["user_name"], $_SESSION["id"]);
    // Redireccion en función de si sucedió correctamente o no.
    if ($cambiar_datos) {
        header("Location: ../pages/micuenta.php?cuenta=datos_modificados");
    } else {
        header("Location: ../pages/micuenta.php?cuenta=datos_no_modificados");
    }
}

// Caso para el formulario de cambiar contraseña.
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["modificar_contraseña"])) {
    $cambiar_contraseña = cambiarContraseña($_SESSION["id"], $_POST["contraseña"], $_POST["nueva_contraseña"], $_POST["confirmacion_nueva_contraseña"]);
    // Redireccion en función de si sucedió correctamente o no.
    if ($cambiar_contraseña) {
        header("Location: ../pages/micuenta.php?cuenta=contraseña_modificada");
    } else {
        header("Location: ../pages/micuenta.php?cuenta=contraseña_no_modificada");
    }
}

// Caso para el formulario de eliminar usuario.
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["eliminar_cuenta"])) {
    $baja = bajaUsuario($_SESSION["id"], $_POST["contraseña_eliminar_cuenta"], $_POST["repetir_contraseña_eliminar_cuenta"]);
    // Redireccion en función de si sucedió correctamente o no.
    if ($baja) {
        header("Location: ../pages/index.php?cuenta=eliminada");
    } else {
        header("Location: ../pages/micuenta.php?cuenta=no_eliminada");
    }
}

// Caso para unirse a una partida o participar en ella mediante $_GET
if (isset($_GET["participar"]) && isset($_SESSION["id"])) {
    $unirse_partida = unirse_partida($_GET["participar"], $_SESSION["id"]);
    if ($unirse_partida) {
        header("Location: ../pages/partidas_disponibles.php?partida=participa");
    } else {
        header("Location: ../pages/partidas_disponibles.php?partida=no_participa");
    }
}

// Caso para salirse de una partida mediante $_GET
if (isset($_GET["no_participar"]) && isset($_SESSION["id"])) {
    $salir_partida = salir_partida($_GET["no_participar"], $_SESSION["id"]);
    // Redireccion en función de si sucedió correctamente o no.
    // Se contempla si se ha realizado la acción desde partidas_pendientes.php o partidas_disponibles.php para redirigir desde donde se hizo
    if ($salir_partida) {
        if (isset($_GET["pagina"]) && $_GET["pagina"] == "pendiente") {
            header("Location: ../pages/partidas_pendientes.php?partida=dejar_participar");
        } else {
            header("Location: ../pages/partidas_disponibles.php?partida=dejar_participar");
        }
    } else {
        if (isset($_GET["pagina"]) && $_GET["pagina"] == "pendiente") {
            header("Location: ../pages/partidas_pendientes.php?partida=no_dejar_participar");
        } else {
            header("Location: ../pages/partidas_disponibles.php?partida=no_dejar_participar");
        }
    }
}