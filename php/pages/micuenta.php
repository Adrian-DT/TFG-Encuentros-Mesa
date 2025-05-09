<?php
@session_start();
require_once "../functions/db.php";
if (!isset($_SESSION["id"])) {
    header("Location: ../pages/login.php?log=necesario");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta | RDM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/custom.css">
</head>

<body>
    <header class="text-center">
        <nav class="navbar navbar-dark navbar-expand-lg bg-black fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand text-light" href="../pages/index.php"><i class="bi bi-dice-6-fill me-2"></i>RDM</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active text-light" aria-current="page" href="../pages/index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="../pages/juegos.php">Juegos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="../pages/partidas_disponibles.php">Partidas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="../pages/formulario_contacto.php">Contacto</a>
                        </li>
                        <?php
                        if (isset($_SESSION["id"])) {
                            // Mostramos la cantidad de partidas disponibles en las que estamos apuntados
                            $partidas_pendientes = contar_partidas_usuario_vigentes($_SESSION["id"]);
                            echo "
                                <li class='nav-item'>
                                    <a class='nav-link text-light' href='../pages/registro_partidas.php'>Registrar partida</a>
                                </li>
                                <li class='nav-item dropdown'>
                                    <a class='nav-link dropdown-toggle text-light' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                        " . ucfirst($_SESSION["user_name"]) . "
                                    </a>
                                    <ul class='dropdown-menu'> ";
                            if ($partidas_pendientes > 0) echo "<li class='nav-item'>
                                    <a class='dropdown-item' href='../pages/partidas_pendientes.php'>Partidas Pendientes</a>
                                </li>";
                            echo "<li><a class='dropdown-item' href='../pages/historial_partidas.php'>Historial</a></li>
                                        <li><a class='dropdown-item' href='../pages/micuenta.php'>Ajustes</a></li>
                                        <li><a class='dropdown-item' href='../functions/logout.php'>Cerrar sesión</a></li>
                                    </ul>
                                </li>";
                            // Mostramos la cantidad de partidas disponibles en las que estamos apuntados
                            // $partidas_pendientes = contar_partidas_usuario_vigentes($_SESSION["id"]);
                            if ($partidas_pendientes > 0) {
                                echo "<li class='nav-item'>
                                    <a class='nav-link text-light' href='../pages/partidas_pendientes.php'>" . $partidas_pendientes . " partidas pendientes.</a>
                                </li>";
                            }
                        } else {
                            echo "
                                <li class='nav-item dropdown'>
                                    <a class='nav-link dropdown-toggle text-light' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                        Entrar
                                    </a>
                                    <ul class='dropdown-menu'>
                                        <li><a class='dropdown-item' href='../pages/login.php'>Iniciar Sesión</a></li>
                                        <li><a class='dropdown-item' href='../pages/registro.php'>Registrarse</a></li>
                                    </ul>
                                </li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid mt-3 pt-5 pb-2 contHeader">
            <div>
                <h1 class="pt-3 text-light">Registros de Mesa</h1>
                <p class="text-light">Registra las partidas con tus amigos.</p>
            </div>
        </div>
    </header>
    <main class="container-fluid">
        <section class="align-items-start mx-0 p-5">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Datos personales
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body container d-flex text-center justify-content-center">
                            <form action="../functions/controlador_formularios.php" method="POST" id="modificar_datos" class="d-flex flex-column gap-2 p-3 align-items-center">
                                <div class="d-flex gap-3">
                                    <div class="form-group d-flex flex-column">
                                        <label for="user_name">User name</label>
                                        <input type="text" name="user_name" value="<?php echo $_SESSION["user_name"] ?>" disabled>
                                    </div>
                                    <div class="form-group d-flex flex-column">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" value="<?php echo $_SESSION["email"] ?>" disabled>
                                    </div>
                                    <div class="form-group d-flex flex-column">
                                        <label for="fecha_creacion">Antigüedad de la cuenta</label>
                                        <input type="text" name="fecha_creacion" value="<?php echo $_SESSION["fecha_creacion"] ?>" disabled>
                                    </div>
                                </div>
                                <input type="submit" id="btnHabilitarDatos" class="btn btn-warning" name="modificar_datos" style="width: 200px;" value="Modificar datos">
                            </form>
                        </div>

                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Cambiar contraseña
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="accordion-body container d-flex text-center justify-content-center">
                                <form action="../functions/controlador_formularios.php" method="POST" id="cambiar_contraseña" class="d-flex flex-column gap-2 p-3 align-items-center">
                                    <div class="d-flex gap-3">
                                        <div class="form-group d-flex flex-column">
                                            <label for="contraseña">Inserte su contraseña</label>
                                            <input type="password" name="contraseña" required>
                                        </div>
                                        <div class="form-group d-flex flex-column">
                                            <label for="nueva_contraseña">Nueva contraseña</label>
                                            <input type="password" name="nueva_contraseña" required>
                                        </div>
                                        <div class="form-group d-flex flex-column">
                                            <label for="confirmacion_nueva_contraseña">Repetir nueva contraseña</label>
                                            <input type="password" name="confirmacion_nueva_contraseña" required>
                                        </div>
                                    </div>
                                    <button type="submit" id="btnModificarContraseña" class="btn btn-warning" name="modificar_contraseña" style="width: 200px;">Modificar contraseña</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Eliminar cuenta
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Va a eliminar su cuenta de manera definitiva, no podrá recuperar su información, antes de realizar esta acción, debe conocer que será irreversible. ¿Desea eliminar su cuenta?</div>
                        <form action="../functions/controlador_formularios.php" class="d-flex flex-column text-center gap-2 p-3 align-items-center" id="eliminar_cuenta" method="POST">
                            <div class="form-group d-flex flex-column">
                                <label for="contraseña_eliminar_cuenta">Introduce tu contraseña</label>
                                <input type="password" name="contraseña_eliminar_cuenta" required>
                                <label for="repetir_contraseña">Repite tu contraseña</label>
                                <input type="password" name="repetir_contraseña_eliminar_cuenta" required>
                            </div>
                            <button type="submit" id="btnEliminarCuenta" class="btn btn-danger" name="eliminar_cuenta" style="width: 200px;">Eliminar cuenta</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="bg-dark mb-0 mt-3 fixed-bottom">
        <ul class="d-flex justify-content-between text-light gap-4 mb-0">
            <li class="list-group-item py-3">© Adrián Delgado Tuñón.</li>
            <div class="d-flex gap-3 me-3">
                <li class="list-group-item py-3"><a class="list-group-item" href="https://www.linkedin.com/in/adriandt/"><i class="bi bi-linkedin"></i></a></li>
                <li class="list-group-item py-3"><a class="list-group-item" href="https://github.com/Adrian-DT"><i class="bi bi-github"></i></a></li>
                <li class="list-group-item py-3"><a class="list-group-item" href="mailto:adriandt_work@outlook.com"><i class="bi bi-envelope"></i></a></li>
            </div>
        </ul>
    </footer>
    <script src="../../js/micuenta.js"></script>
</body>

</html>