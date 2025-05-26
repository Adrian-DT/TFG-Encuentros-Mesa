<?php
@session_start();
require_once "../functions/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juegos | RDM</title>
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
            <h1 class="pt-3 text-light z-3">Sugerencias de Juegos de Mesa</h1>
            <p class="text-light z-3">Juegos disponibles en nuestra plataforma para registrar las partidas con tus amigos.</p>
        </div>
    </header>
    <main class="container-fluid contcard pb-5 mb-5">
        <div class="row px-3 px-md-5">
            <p id="encontrados" class="text-center mt-2 mb-4"></p>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
                <?php
                // Convertimos el objeto PDO en un array asociativo para poder mezclar el array de manera aleatoria para mostrar un orden diferente cada vez que se muestran
                $juegos = mostrar_juegos()->fetchAll(PDO::FETCH_ASSOC);
                $mas_partidas = juego_mas_partidas();

                // Convertir $mas_partidas en un array asociativo para búsquedas rápidas
                $mas_partidas_ids = [];
                if ($mas_partidas) {
                    $mas_partidas_ids = array_column($mas_partidas, 'id_juego');
                }

                if ($juegos) {
                    // Aleatorizar el orden de los juegos
                    shuffle($juegos);
                    foreach ($juegos as $juego) {
                        // Verificar si el juego actual está en los más jugados
                        $es_mas_jugado = in_array($juego["id"], $mas_partidas_ids);

                        // Generar la card una sola vez por juego
                        echo "<a id='a-juego' class='card col " . ($es_mas_jugado ? 'mas-jugado' : '') . "' href='../pages/partidas_disponibles.php?id_juego=" . $juego["id"] . "'>";
                        echo "<div class='h-100'>";

                        // Mostrar el badge solo si es necesario
                        if ($es_mas_jugado) {
                            echo "<div class='badge'>Más jugado</div>";
                        }

                        // Resto de la card (imagen, título, descripción, etc.)
                        echo "<img src='../../img/" . $juego["id"] . ".webp' 
                class='card-img-top img-fluid' 
                style='height: 300px;' 
                alt='" . $juego["nombre"] . "' 
                loading='lazy'>";

                        echo "<div class='card-body d-flex flex-column'>";
                        echo "<h5 class='card-title fw-bold'>" . $juego["nombre"] . "</h5>";

                        $historial = mostrar_partidas_disponiblesV2();
                        if (!$historial) {
                            echo "<h4>No hay partidas disponibles, <a href='../pages/registro_partidas.php'>añade una ahora!</a></h4>";
                        } else {
                            // Agrupar partidas por juego
                            $partidasPorJuego = [];
                            foreach ($historial as $partida) {
                                $juegoId = $partida['id_juego'];
                                $partidasPorJuego[$juegoId][] = $partida; // Agrupa partidas por id_juego
                            }
                            foreach ($partidasPorJuego as $juegoId => $partidas) {
                                if($juegoId == $juego["id"]) {
                                    echo "<p class='mb-3 partidasCard'><small>" . count($partidas) . " partidas actualmente.</small></p>";
                                }
                            }
                        echo "<p class='card-text flex-grow-1 mb-3 text-start'>" . htmlspecialchars($juego["descripcion"]) . "</p>";
                        echo "<div class='mt-auto'>";
                        echo "<div class='text-muted mb-2'><small>Jugadores: " . $juego["min_jugadores"] . " - " . $juego["max_jugadores"] . "</small></div>";
                        echo "<div class='text-muted mb-2'><small>Duración: " . $juego["duracion"] . "</small></div>";
                        echo "<div class='text-muted'><small>Categoría: " . htmlspecialchars($juego["categoria"]) . "</small></div>";
                        echo "</div></div></div></a>";
                    }
                }
            }
                ?>
            </div>
        </div>
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
</body>

</html>