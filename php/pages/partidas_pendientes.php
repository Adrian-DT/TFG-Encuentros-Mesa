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
    <title>Partidas Pendientes | RDM</title>
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
            <h1 class="pt-3 text-light">Tus Próximas Partidas</h1>
            <p class="text-light">Aquí encontrarás las próximas partidas que te esperan.</p>
        </div>
        <?php
        // Bloque de código para mostrar un mensaje de notificación en función del tipo de valor de $_GET["partida"]
        if (isset($_GET["partida"])) {
            echo "<div class='notificacion'>
                        <div class='aspa'>x</div>";
            switch ($_GET["partida"]) {
                case "registrada":
                    echo "<p>Partida registrada con éxito.</p>";
                    break;
                case "no_registrada":
                    echo "<p>No pudo registrarse la partida.</p>";
                    break;
                case "editada":
                    echo "<p>Partida editada con éxito.</p>";
                    break;
                case "no_editada":
                    echo "<p>No pudo editarse la partida.</p>";
                    break;
                case "eliminada":
                    echo "<p>Partida eliminada con éxito.</p>";
                    break;
                case "no_eliminada":
                    echo "<p>No pudo eliminarse la partida.</p>";
                    break;
                case "participa":
                    echo "<p>Te has apuntado con éxito a la partida.</p>";
                    break;
                case "no_participa":
                    echo "<p>No es posible apuntarse a la partida.</p>";
                    break;
                case "dejar_participar":
                    echo "<p>Te has salido con éxito de la partida.</p>";
                    break;
                case "no_dejar_participar":
                    echo "<p>No ha sido posible salir de la partida.</p>";
                    break;
            }
            echo "</div>";
        }
        ?>
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
                        <form id="juego" action="">
                            <div class="form-group">
                                <select class="form-select" aria-label="Default select example" id="filtroJuego" name="filtroJuego">
                                    <option value="default" selected>Filtrar por juego</option>
                                    <?php
                                    // Exluyo juegos repetidos en las partidas creadas para mostrar en el option 1 única vez cada juego del que existe registrada alguna partida para ese usuario
                                    $repetidos = [];
                                    $juegos = mostrar_partidas_pendientes($_SESSION["id"]);
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
                        $historial = mostrar_partidas_pendientes($_SESSION["id"]);
                        if (!$historial) {
                            echo "<h4>No hay partidas disponibles, <a href='../pages/registro_partidas.php'>añade una ahora!</a></h4>";
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
                                            <p class='mx-auto'><?php echo count($partidas) ?> partidas disponibles.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mostrar tabla con todas las partidas del juego -->
                                <table class='table table-hover align-middle table-sm mx-auto w-100 h-100 mb-5' id="<?php echo $juegoId; ?>" style='max-width: 900px;'>
                                    <thead>
                                        <tr>
                                            <th>Game Master</th>
                                            <th>Lugar</th>
                                            <th>Fecha de Partida</th>
                                            <th>Comentarios</th>
                                            <th>Jugadores</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($partidas as $partida): ?>
                                            <tr>
                                                <td><?php $game_master = game_master($partida["id_creador"]);
                                                    echo $game_master["user_name"] ?></td>
                                                <td><?php echo $partida["lugar"] ?> </td>
                                                <td><?php echo $partida["fecha_partida"]; ?> </td>
                                                <td><?php echo $partida["comentarios"]; ?> </td>
                                                <?php
                                                // Si no estas logueado muestras las opciones, pero redirijes a login
                                                if (!isset($_SESSION["id"])) {
                                                    echo "<td>" . $partida["num_participantes"] .  "/" . $partida["max_j"] . "</td>
                                                    <td><a class='text-primary' href='../pages/login.php'><i class='bi bi-person-plus'></i></a></td>
                                                    <td></td>";
                                                } else {
                                                    // Compruebo si existe el usuario participando en esa partida
                                                    $existe = user_partida_exist($partida["id_partida"], $_SESSION["id"]);
                                                    // Si la partida no es tuya, te muextra la opción de unirte, si es tuya, la opción de editar o eliminar y si no es tuya y no estás apuntado y esta llena, te muestro "Partida llena" e inhabilito que puedas unirte
                                                    if ($_SESSION["id"] != $partida["id_creador"] && $existe == FALSE && $partida["num_participantes"] < $partida["max_j"]) {
                                                        echo "<td>" . $partida["num_participantes"] .  "/" . $partida["max_j"] . "</td>
                                                    <td><a class='text-primary tooltip-trigger' data-bs-toggle='tooltip' title='¡Únete a la partida!' href='../functions/controlador_formularios.php?participar=" . $partida["id_partida"] . "&pagina=pendiente'><i class='bi bi-person-plus'></i></a></td>
                                                    <td><a class='text-primary tooltip-trigger' data-bs-toggle='tooltip' title='Información de la partida' href='../pages/info_partida.php?info=" . $partida["id_partida"] . "'><i class='bi bi-info-square text-info'></i></a></td>";
                                                    } else if ($_SESSION["id"] != $partida["id_creador"] && $existe == TRUE) {
                                                        echo "<td>" . $partida["num_participantes"] .  "/" . $partida["max_j"] . "</td>
                                                    <td><a class='tooltip-trigger' data-bs-toggle='tooltip' title='¡Ya estás en la partida!'><i class='bi bi-check-square text-success'></i></a></td>
                                                    <td><a class='text-primary tooltip-trigger' data-bs-toggle='tooltip' title='Salir de la partida' href='../functions/controlador_formularios.php?no_participar=" . $partida["id_partida"] . "&pagina=pendiente'><i class='bi bi-arrow-bar-left text-danger'></i></a></td>
                                                    <td><a class='text-primary tooltip-trigger' data-bs-toggle='tooltip' title='Información de la partida' href='../pages/info_partida.php?info=" . $partida["id_partida"] . "'><i class='bi bi-info-square text-info'></i></a></td>";
                                                    } else if ($_SESSION["id"] == $partida["id_creador"]) {
                                                        echo "<td>" . $partida["num_participantes"] .  "/" . $partida["max_j"] . "</td>  
                                                    <td><a class='text-primary tooltip-trigger' data-bs-toggle='tooltip' title='Editar partida' href='../pages/editar_partida.php?id_partida=" . $partida['id_partida'] . "'><i class='bi bi-pencil-square'></i></a></td>
                                                    <td><a class='text-danger tooltip-trigger' data-bs-toggle='tooltip' title='Eliminar partida' href='../functions/controlador_formularios.php?eliminar=" . $partida['id_partida'] . "&user=" . $_SESSION["id"] . "&pagina=pendiente'><i class='bi bi-trash3'></i></a></td>
                                                    <td><a class='text-primary tooltip-trigger' data-bs-toggle='tooltip' title='Información de la partida' href='../pages/info_partida.php?info=" . $partida["id_partida"] . "'><i class='bi bi-info-square text-info'></i></a></td>";
                                                    } else if ($partida["num_participantes"] == $partida["max_j"]) {
                                                        echo " <td>" . $partida["num_participantes"] .  "/" . $partida["max_j"] . "</td>  
                                                    <td class='text-success'>Partida llena</td>";
                                                    }
                                                }
                                                ?>
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
    <script src="../../js/notificaciones.js"></script>
</body>

</html>