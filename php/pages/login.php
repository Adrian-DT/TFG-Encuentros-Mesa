<?php
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | RDM</title>
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
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid mt-3 pt-5 pb-2 contHeader">
            <h1 class="pt-3 text-light">Registros de Mesa</h1>
            <p class="text-light">Inicia sesión para disfrutar de todas las ventajas que te ofrecemos.</p>
        </div>
        <?php
        // Bloque de código para aplicar el mensaje de error en función de los $_GET que nos hayan redirigido
        if (isset($_GET["partida"]) || isset($_GET["log"])) {
            echo "<div class='notificacion'>
                        <div class='aspa'>x</div>";
            echo "<p>Es necesario iniciar sesión.</p>";
            echo "</div>";
        }
        if (isset($_GET["login"])) {
            echo "<div class='notificacion'>
                        <div class='aspa'>x</div>";
            echo "<p>" . $_GET["login"] . "</p>";
            echo "</div>";
        }
        ?>
    </header>
    <main class="mt-2 py-5 d-flex flex-column text-center justify-content-center">
        <h1 class="text-center py-2">Inicio de Sesión</h1>
        <div class="container d-flex text-center justify-content-center">
            <form action="../functions/controlador_formularios.php" method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control form-control-sm" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" class="form-control form-control-sm" id="contraseña" name="contraseña">
                </div>
                <button type="submit" class="btn btn-success my-4" name="login">Iniciar Sesión</button>
            </form>
        </div>
        <p>----------- O -----------</p>
        <a href="../pages/registro.php">
            <p>Crear una cuenta</p>
        </a>
        <a href="../pages/recuperar_contraseña.php">
            <p>¿Has olvidado tu contraseña?</p>
        </a>
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