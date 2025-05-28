<?php
// Script para hacer logout
//Nos unimos a la sesión
    session_start();
//Vaciamos el array SESSION y accedemos al array
    $_SESSION = array(); 
//Destruimos la sesion y el array SESSION
    session_destroy();
//Destruimos las cookies. El tiempo inferior al actual, siempre hay que poner time -1000 o el tiempo en segundos que se estime
    setcookie(session_name(),123,time()-1000); 
//Redirigimos a la página de login
    header("Location: ../pages/index.php?sesion=logout");
