<?php
    //Función para generar la cabecera
    //Tanto esta como la función generarMenu() tienen en cuenta si el usuario está logueado y cuál es su rol
    function generarCabecera(){
        echo "
        <div class='logo'>
            <a href='../paginas/index.php' class='sinFondo'><img src='../../img/logo.png'></a>
            <h1>La Tienda Media</h1>
        </div>
        <ul id='enlaces-top'>";
        if(isset($_SESSION["id"])){
            echo "<li class='sinFondo'>" . $_SESSION["nombre_usuario"] . "</li>";
            echo "<li class='sinFondo'>Saldo: ". $_SESSION["saldo"] . "</li>";
            echo "<li><a href='../paginas/carrito.php'>Carrito</a></li>";
            echo "<li><a href='../paginas/micuenta.php'>Mi cuenta</a></li>";
            echo "<li><a href='../functions/logout.php'>Salir</a></li>";
        } else {
            echo "<li><a href='../paginas/login.php'>Entrar</a></li>";
            echo "<li><a href='../paginas/registro.php'>Registrarse</a></li>";
        }

        echo "</ul>";
    }