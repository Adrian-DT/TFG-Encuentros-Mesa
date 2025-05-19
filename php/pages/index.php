<?php
@session_start();
require_once "../functions/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | RDM</title>
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
        <?php
        if (isset($_GET["cuenta"]) && $_GET["cuenta"] == "eliminada") {
            echo "<div class='notificacion'>
                        <div class='aspa'>x</div>";
            echo "<p>Cuenta eliminada correctamente.</p>";
            echo "</div>";
        }
        if (isset($_GET["registro"]) && $_GET["registro"] == "correcto") {
            echo "<div class='notificacion'>
                        <div class='aspa'>x</div>";
            echo "<p>Te has registrado correctamente.</p>";
            echo "</div>";
        }
        ?>
    </header>
    <main id="index-main" class="container-fluid pb-5">
        <!-- Primera sección -->
        <article class="row px-3 px-md-5 mt-5 mb-4 art-index">
            <section class="col-12 col-md-6 order-2 order-md-1 mt-4 mt-md-0">
                <h4 class="mb-3">Conoce a otros jugadores, descubre nuevos juegos</h4>
                <p class="mb-4">Bienvenido a Registros de Mesa, tu lugar de encuentro con otros jugadores de juegos de mesa con los que compartir aficciones. Forma parte de una comunidad en constante crecimiento, apúntate a partidas de otros usuarios, crea las tuyas propias y disfruta de partidas memorables.</p>
                <a href="../pages/registro.php" class="btn btn-dark px-4">Comenzar</a>
            </section>
            <section class="col-12 col-md-6 order-1 order-md-2 mb-4 mb-md-0">
                <video class="w-100 rounded-3 shadow" style="height: 300px; object-fit: cover;" autoplay muted loop>
                    <source src="../../video/monopoly.mp4" type="video/mp4">
                </video>
            </section>
        </article>

        <!-- Segunda sección -->
        <article class="row px-3 px-md-5 my-5 art-index">
            <section class="col-12 col-md-6 mb-4 mb-md-0">
                <video class="w-100 rounded-3 shadow" style="height: 300px; object-fit: cover;" autoplay muted loop>
                    <source src="../../video/juego-mesa.mp4" type="video/mp4">
                </video>
            </section>
            <section class="col-12 col-md-6 mt-4 mt-md-0">
                <h4 class="mb-3">Organiza una partida</h4>
                <p class="mb-4">¿Tienes un juego al que es dificil quitarle el polvo? Seguramente haya gente en la comunidad dispuesta a ayudarte a hacerlo. Crea una partida de tu juego favorito, indica el día, el lugar y añade comentarios con la hora o información relevante para la realización de la partida. ¡Ya solo queda esperar que la gente se apunte y llegue el momento!</p>
            </section>
        </article>

        <!-- Tercera sección -->
        <article class="row px-3 px-md-5 mt-5 mb-4 art-index">
            <section class="col-12 col-md-6 order-2 order-md-1 mt-4 mt-md-0">
                <h4 class="mb-3">Consulta los juegos sugeridos</h4>
                <p class="mb-4">Accede a la sección de juegos y observa la cantidad de opciones disponibles para registrar tus partidas. ¡Siempre puedes sugerirnos añadir alguno que eches en falta desde el <a href="../pages/formulario_contacto.php">formulario de contacto</a> ! No esperes más, ¡descubre la cantidad de opciones disponibles para ti!</p>
                <a href="../pages/juegos.php" class="btn btn-dark px-4">Ver Juegos</a>
            </section>
            <section class="col-12 col-md-6 order-1 order-md-2 mb-4 mb-md-0">
                <video class="w-100 rounded-3 shadow" style="height: 300px; object-fit: cover;" autoplay muted loop>
                    <source src="../../video/apalabrados.mp4" type="video/mp4">
                </video>
            </section>
        </article>
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
    <script src="../../js/notificaciones.js"></script>
</body>

</html>