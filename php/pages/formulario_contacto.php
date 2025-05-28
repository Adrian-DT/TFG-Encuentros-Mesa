<?php
@session_start();
require_once "../functions/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto | RDM</title>
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
                    <ul class="navbar-nav d-flex w-100 justify-content-evenly">
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
            <h1 class="pt-3 text-light">Registros de Mesa</h1>
            <p class="text-light">Contacta con nosotros sobre cualquier tipo de sugerencia o incidencia con la aplicación.</p>
        </div>
    </header>
    <main class="mt-2">
        <h1 class="text-center py-2">Formulario de Contacto</h1>
        <div class="container-fluid d-flex text-center justify-content-center">
            <form action="../functions/controlador_formularios.php" method="POST" class="container w-75 mx-auto pb-5">
                <div class="row g-2 justify-content-center">
                    <!-- Campo Nombre -->
                    <div class="col-md-3 col-12">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba su nombre" required>
                    </div>

                    <!-- Campo Teléfono -->
                    <div class="col-md-3 col-12">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <div class="input-group">
                            <span class="input-group-text">+34</span>
                            <input type="text" class="form-control" name="telefono" placeholder="Escriba su teléfono" required>
                        </div>
                    </div>
                </div>
                <div class="row g-2 justify-content-center">
                    <!-- Campo Email -->
                    <div class="col-md-6 col-12">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" placeholder="example@example.com" aria-label="Email" name="email" required>
                    </div>
                </div>

                <div class="row g-2 justify-content-center">
                    <!-- Campo Mensaje -->
                    <div class="col-md-6 col-12">
                        <label for="comentarios" class="form-label">Mensaje:</label>
                        <textarea class="form-control" rows="5" id="comentarios" name="comentarios" placeholder="Deje aquí su comentario..." required></textarea>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <!-- Botón de Envío -->
                    <div class="col-md-6 col-12 mt-2">
                        <button type="submit" class="btn btn-success" name="contacto">Enviar</button>
                    </div>
                </div>
            </form>
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