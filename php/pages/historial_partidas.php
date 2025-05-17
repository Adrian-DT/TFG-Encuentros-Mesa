<?php
@session_start();
require_once "../functions/db.php";
require_once "../functions/funciones_usuario.php";
if (!isset($_SESSION["id"])) {
    header("Location: ../pages/login.php?log=necesario");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Partidas | RDM</title>
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
            <h1 class="pt-3 text-light">Historial de Juegos de Mesa</h1>
            <p class="text-light">Aquí encontrarás el historial de las partidas en las que has participado.</p>
        </div>
    </header>
    <main class="container-fluid contcard">
        <!-- Fondo oscuro -->
        <div id="overlay" class="overlay"></div>
        <article class="row px-5 gap-3 justify-content-around">
            <!-- Section -->
            <p id="encontrados" class="text-center mt-2"></p>
            <section class="">
                <div class="container-fluid">
                    <div class="container-fluid d-flex text-center justify-content-center gap-3 pb-5">
                        <form id="dificultadForm" action="">
                            <div class="form-group">
                                <select class="form-select" aria-label="Default select example" id="filtroJuego" name="filtroJuego">
                                    <option value="default" selected>Filtrar por juego</option>
                                    <?php
                                    // Exluyo juegos repetidos en las partidas creadas para mostrar en el option 1 única vez cada juego del que existe registrada alguna partida para ese usuario
                                    $repetidos = [];
                                    $juegos = historial_partidas($_SESSION["id"]);
                                    foreach ($juegos as $juego) {
                                        // Si el id del juego no se encuentra en el array de repetidos, muestro el option y lo añado al array
                                        if (!in_array($juego["id_juego"], $repetidos)) {
                                            $repetidos[] += $juego["id_juego"];
                                            echo "<option value='" . $juego["id_juego"] . "'>" . $juego["nombre_juego"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </form>
                        <form class="d-flex h-25" role="search">
                            <input class="form-control me-2" id="inputCriterio" name="criterio" type="search" placeholder="Buscar criterio" aria-label="Search">
                        </form>
                        <a href="../pages/registro_partidas.php" class="btn btn-dark px-4">Registrar partida</a>
                    </div>
                    <div id="juegos-container"
                        class="row gx-4 gx-lg-5 row-cols-1 row-sm-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center text-center mb-5">
                        <!-- Aquí irán las tarjetas de partidas -->
                        <?php
                        $historial = historial_partidas($_SESSION["id"]);
                        if (!$historial) {
                            echo "<h4>Aún no has participado en ninguna partida, <a href='../pages/partidas_disponibles.php'>empieza ahora!</a></h4>";
                        } else {
                            // Agrupar partidas por juego
                            $partidasPorJuego = [];
                            foreach ($historial as $partida) {
                                $juegoId = $partida['id_juego'];
                                $partidasPorJuego[$juegoId][] = $partida; // Agrupa partidas por id_juego
                            }
                            foreach ($partidasPorJuego as $juegoId => $partidas): ?>
                                <!-- Mostrar card del juego una vez -->
                                <div class='contenido-card card h-100 col mb-5 mx-2' id="<?php echo $juegoId; ?>" style='min-height: 300px;'>
                                    <img class='card-img-top img-fluid'
                                        src='../../img/<?php echo $juegoId; ?>.webp'
                                        alt='<?php echo $partidas[0]["nombre_juego"]; ?>'
                                        loading='lazy' />
                                    <div class='card-body p-4'>
                                        <div class='text-center'>
                                            <h5 class='fw-bolder'><?php echo $partidas[0]["nombre_juego"]; ?></h5>
                                            <p class='mx-auto'><?php echo count($partidas) ?> partidas en total.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mostrar tabla con todas las partidas del juego -->
                                <table class='table table-hover table-sm mx-auto w-100 h-100 mb-5 table-fixed' id="<?php echo $juegoId; ?>" style='max-width: 900px;'>
                                    <thead>
                                        <tr>
                                            <th>Game Master</th>
                                            <th>Ganador</th>
                                            <th>Participantes</th>
                                            <th>Lugar</th>
                                            <th>Fecha de Partida</th>
                                            <th>Comentarios</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($partidas as $partida): ?>
                                            <tr>
                                                <td><?php
                                                    $game_master = game_master($partida["id_creador"]);
                                                    echo $game_master["user_name"] ?></td>
                                                <td>
                                                    <?php
                                                    // Obtengo los objetos tipo fecha para compararlos, si la fecha de la partida ha pasado, te permite indicar el ganador
                                                    $fecha_partida = new DateTime($partida["fecha_partida"]);
                                                    $fecha_actual = new DateTime();
                                                    // Si eres el creador y la partida es anterior a la fecha actual, te permite establecer ganador
                                                    if ($partida["id_creador"] == $_SESSION["id"] && $fecha_partida < $fecha_actual) {
                                                        $participantes = generar_select_participantes($partida["id_partida"]);
                                                        echo "<select class='opcionesGanador' data-partida-id='" . $partida["id_partida"] . "'>";
                                                        echo $partida["ganador"] === NULL
                                                            ? "<option value='default' selected>Selecciona ganador</option>"
                                                            : "<option value=" . htmlspecialchars($partida["ganador"]) . " selected>" . htmlspecialchars($partida["ganador"]) . "</option>";
                                                        foreach ($participantes as $participante) {
                                                            if ($participante["user_name"] != $partida["ganador"]) {
                                                                echo "<option value='" . $participante['user_name'] . "'>" . $participante['user_name'] . "</option>";
                                                            }
                                                        }
                                                        echo "</select>";
                                                    } else {
                                                        echo $partida["ganador"];
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php
                                                    // Función para mostrar los nombres de los participantes de la partida
                                                    $participantes = mostrar_participantes($partida["id_partida"]);
                                                    if ($participantes) echo $participantes;
                                                    ?>
                                                </td>
                                                <td><?php echo $partida["lugar"] ?></td>
                                                <td><?php echo $partida["fecha"]; ?></td>
                                                <td><?php echo $partida["comentarios"]; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                        <?php endforeach;
                        } ?>
                    </div>
                </div>
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
    <script src="../../js/historial_partidas.js"></script>
</body>

</html>