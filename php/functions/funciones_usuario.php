<?php
@session_start();
require_once "../functions/db.php";
require_once "../functions/PHPMailer.php";
//Función crear usuario
function crearUsuario($user_name, $email, $contraseña, $contraseña_verif) {
    try {
        // Si la contraseña introducida dos veces no es la misma, devolvemos false
        if ($contraseña != $contraseña_verif) return FALSE;
        //Nos conectamos a la base de datos
        $db = conectar();
        $db->beginTransaction();
        // Encriptar la contraseña usando el algoritmo BCRYPT
        $contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);
        // $insert = $db->query("INSERT INTO usuarios (user_name, email, contraseña) VALUES ('$user_name', '$email', '$contraseña_hash')");
        $insert = $db->prepare("INSERT INTO usuarios (user_name, email, contraseña) VALUES (?, ?, ?)");
        $insert->execute(array($user_name, $email, $contraseña_hash));
        if (!$insert) {
            $db->rollBack();
            $db = desconectar();
            return FALSE;
        } else {
            $envio = enviar_correo($email, "nuevo_usuario");
            if (!$envio) {
                $db->rollBack();
                $db = desconectar();
                return FALSE;
            }
            $db->commit();
            login($email, $contraseña);
            $db = desconectar();
            return TRUE;
        }
    } catch (PDOException $e) {
        echo "Error, el usuario no se ha podido crear " . $e->getMessage();
    }
}

// Función para acceder a un usuario
function comprobar_email($email) {
    try {
        //Nos conectamos a la base de datos
        $db = conectar();
        $consultaUsuarios = $db->prepare("SELECT email FROM usuarios WHERE email = ?");
        $consultaUsuarios->execute(array($email));
        $consultaUsuarios = $consultaUsuarios->fetch();
        $db = desconectar();
        if ($consultaUsuarios) return $consultaUsuarios;
            return FALSE;
    } catch (PDOException $e) {
        echo "Error, El usuario no existe: " . $e->getMessage();
    }
}

// Función cambiar contraseña por recuperación de contraseña
function restablecer_contraseña($email, $contraseña, $repetir_contraseña) {
    try {
        // Si la contraseña introducida dos veces no es la misma, devolvemos false
        if ($contraseña != $repetir_contraseña) return FALSE;
        // Encriptar la contraseña usando el algoritmo BCRYPT
        $contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);
        //Nos conectamos a la base de datos
        $db = conectar();
        $query = $db->prepare("UPDATE usuarios
                            SET contraseña = ?
                            WHERE email = ?");
        $resultado = $query->execute(array($contraseña_hash, $email));
        $db = desconectar();
        if ($resultado) return TRUE;
        return FALSE;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//Función login
function login($email, $contraseña) {
    try {
        //Nos conectamos a la base de datos
        $db = conectar();
        $consultaUsuarios = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $consultaUsuarios->execute(array($email));
        $consultaUsuarios = $consultaUsuarios->fetch();
        // Si la contraseña proporcionada no coincide con la hasheada en la BD, devuelvo FALSE
        if (!password_verify($contraseña, $consultaUsuarios["contraseña"])) {
            $db = desconectar();
            return FALSE;
        }
        $_SESSION['id'] = $consultaUsuarios['id'];
        $_SESSION['user_name'] = $consultaUsuarios['user_name'];
        $_SESSION['email'] = $consultaUsuarios['email'];
        $_SESSION["fecha_creacion"] = $consultaUsuarios["creacion"];
        if (!$consultaUsuarios) {
            $db = desconectar();
            return FALSE;
        } else {
            $db = desconectar();
            return TRUE;
        }
    } catch (PDOException $e) {
        echo "Error, El usuario no existe: " . $e->getMessage();
    }
}

//Función baja usuario
function bajaUsuario($id_usuario, $contraseña, $repetir_contraseña) {
    try {
        //Nos conectamos a la base de datos
        $db = conectar();

        $consultaUsuarios = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $consultaUsuarios->execute(array($id_usuario));
        $consultaUsuarios = $consultaUsuarios->fetch();
        // Si la contraseña proporcionada no coincide con la hasheada en la BD, devuelvo FALSE
        if (!password_verify($contraseña, $consultaUsuarios["contraseña"])) {
            $db = desconectar();
            return FALSE;
        }
        // Compruebo que la nueva contraseña esta escrita correctamente en ambos campos
        if ($contraseña !== $repetir_contraseña) {
            $db = desconectar();
            return FALSE;
        }

            $db->beginTransaction();
            $delete = $db->prepare("DELETE FROM usuarios WHERE id = ?");
            $delete->execute(array($id_usuario));
            if (!$delete) {
                $db = desconectar();
                return FALSE;
            } else {
                $envio = enviar_correo($consultaUsuarios["email"], "baja_usuario");
                if (!$envio) {
                    $db->rollBack();
                    $db = desconectar();
                    return FALSE;
                }
                $db->commit();
                $db = desconectar();
                //Vaciamos el array SESSION y accedemos al array
                $_SESSION = array();
                //Destruimos la sesion y el array SESSION
                session_destroy();
                //Destruimos las cookies. El tiempo inferior al actual, siempre hay que poner time -1000 o el tiempo en segundos que se estime
                setcookie(session_name(), 123, time() - 1000);
                return TRUE;
            }
        
    } catch (PDOException $e) {
        echo "Error, al realizar la baja del usuario" . $e->getMessage();
    }
}

// Función para cambiar los datos del usuario
function cambiarDatos($user_name, $email, $id_usuario) {
    try {
        $db = conectar();

        //Modificamos todos los datos con lo que haya en el POST
        $query = $db->prepare("UPDATE usuarios
                            SET user_name = ?, email = ?
                            WHERE id = ?");

        $resultado = $query->execute(array($user_name, $email, $id_usuario));

        if (!$resultado) {
            $db = desconectar();
            return false;
        }

        // Vuelvo a almacenar los nuevos valores en la sesión
        $_SESSION['user_name'] = $user_name;
        $_SESSION['email'] = $email;
        
        $db = desconectar();

        return true;
    } catch (PDOException $e) {

        $db = desconectar();

        return false;
    }
}

// Función para cambiar la contraseña
function cambiarContraseña($id_usuario, $contraseña, $nuevaContraseña, $confirmacionContraseña) {
    try {
        //Nos conectamos a la base de datos
        $db = conectar();
        $consultaUsuarios = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $consultaUsuarios->execute(array($id_usuario));
        $consultaUsuarios = $consultaUsuarios->fetch();
        // Si la contraseña proporcionada no coincide con la hasheada en la BD, devuelvo FALSE
        if (!password_verify($contraseña, $consultaUsuarios["contraseña"])) {
            $db = desconectar();
            return FALSE;
        }
        // Compruebo que la nueva contraseña esta escrita correctamente en ambos campos
        if ($nuevaContraseña !== $confirmacionContraseña) {
            $db = desconectar();
            return FALSE;
        }

        // Hasheamos la nueva contraseña
        $contraseña_hash = password_hash($nuevaContraseña, PASSWORD_BCRYPT);

        //Modificamos la contraseña
        $query = $db->prepare("UPDATE usuarios
                            SET contraseña = ?
                            WHERE id = ?");

        $resultado = $query->execute(array($contraseña_hash, $id_usuario));

        if (!$resultado) {
            $db = desconectar();
            return false;
        }

        $db = desconectar();

        return true;


    } catch (PDOException $e) {
        echo "Error, al realizar el cambio de contraseña " . $e->getMessage();
    }
}

// Función para registrar una partida
function registrarPartida($id_creador, $id_juego, $lugar, $fecha_partida, $comentario)
{
    // Contemplamos que la partida no pueda ser con una fecha anterior a la actual, ya que no podría haberse jugado
    // Pasamos los valores del argumento fecha a objeto DateTime
    $fecha_partidaComp = new DateTime($fecha_partida);
    $fecha_nowComp = new DateTime();
    // Creo un intervalo de tiempo para poder crear una partida para hoy
    $intervalo = new DateInterval('PT1H');
    // Añado el intervalo al tiempo actual
    $fecha_partidaComp->add($intervalo);
    if($fecha_partidaComp < $fecha_nowComp){
        return FALSE;
    }
    // Si los comentarios están vacíos, por defecto almacenamos sin comentarios
    if($comentario == "") $comentario = "Sin comentario.";
    // Insertamos una nueva partida
    try {
        $db = conectar();
        $db->beginTransaction();
        $insert = $db->query("INSERT INTO partidas (id_creador, id_juego, lugar, fecha_partida) VALUES ($id_creador, $id_juego, '$lugar', '$fecha_partida')");
        if (!$insert) {
            $db->rollback();
            $db = desconectar();
            return FALSE;
        }
        // Insertamos al propio creador como participante
        $id_partida = $db->lastInsertId();
        $insert = $db->query("INSERT INTO participaciones (id_partida, id_usuario) VALUES ($id_partida, $id_creador)");
        if (!$insert) {
            $db->rollback();
            $db = desconectar();
            return FALSE;
        }
        // Insertamos los comentarios del creador al crear la partida
        $id_participaciones = $db->lastInsertId();
        $insert = $db->query("INSERT INTO comentario (texto, participacion) VALUES ('$comentario', $id_participaciones)");
        if (!$insert) {
            $db->rollback();
            $db = desconectar();
            return FALSE;
        }
        // Si todo salió bien, confirmamos y desconectamos
        $db->commit();
        $db = desconectar();
        return TRUE;
    } catch (PDOException $e) {
        return "Excepción en la DB" . $e;
        $db->rollback();
        $db = desconectar();
        return FALSE;
    }
}

// TODO NO FUNCIONA, REVISAR
// Función para editar una partida existente
function editarPartida($id_partida, $id_juego, $fecha_partida, $comentarios, $lugar) {
    // Contemplamos que la partida no pueda ser con una fecha posterior a la actual, ya que no podría haberse jugado
    // Pasamos los valores del argumento fecha a objeto DateTime
    $fecha_partidaComp = new DateTime($fecha_partida);
    $fecha_nowComp = new DateTime();
    // Creo un intervalo de tiempo para poder crear una partida para hoy
    $intervalo = new DateInterval('PT1H');
    // Añado el intervalo al tiempo actual
    $fecha_partidaComp->add($intervalo);
    if ($fecha_partidaComp < $fecha_nowComp) {
        return FALSE;
    }
    // Si los comentarios están vacíos, por defecto almacenamos sin comentarios
    if ($comentarios == "") $comentarios = "Sin comentarios.";
    // Insertamos una nueva partida
    try {
        $db = conectar();

        //Modificamos la partida
        $query = $db->prepare("UPDATE partidas AS p
                            JOIN participaciones AS p2 ON p.id = p2.id_partida
                            JOIN comentario AS c ON p2.id = c.participacion
                            SET
                            p.id_juego = ?,
                            p.fecha_partida = ?,
                            c.texto = ?,
                            p.lugar = ?
                            WHERE p.id = ?");

        $resultado = $query->execute(array($id_juego, $fecha_partida, $comentarios, $lugar, $id_partida));
        if (!$resultado) {
            return "Fallo en la sentencia UPDATE";
            $db = desconectar();
            return FALSE;
        } else {
            $db = desconectar();
            return TRUE;
        }
    } catch (PDOException $e) {
        $db = desconectar();
        return $e;
    }
}

// Función para eliminar un registro de partida
function eliminarPartida($id_partida) {
    try {
        $db = conectar();
        $delete = $db->query("DELETE FROM partidas WHERE id = $id_partida");
        if (!$delete) {
            $db = desconectar();
            return FALSE;
        } else {
            $db = desconectar();
            return TRUE;
        }
    } catch (PDOException $e) {
        $db = desconectar();
        return FALSE;
    }
}

// Función para unirse/participar en una partida
function unirse_partida($id_partida, $id_usuario) {
    $db = conectar();
    $insert = $db->query("INSERT INTO participaciones (id_partida, id_usuario) VALUES ($id_partida, $id_usuario)");
    if (!$insert) {
        $db = desconectar();
        return FALSE;
    }
    $db = desconectar();
    return TRUE;
}

// Función para desapuntarse de una partida
function salir_partida($id_partida, $id_usuario) {
    $db = conectar();
    $delete = $db->query("DELETE FROM participaciones WHERE id_partida = $id_partida AND id_usuario = $id_usuario");
    if (!$delete) {
        $db = desconectar();
        return FALSE;
    }
    $db = desconectar();
    return TRUE;
}

// Función para mostrar el mes según su valor
function mesToString($mes) {
    switch ($mes) {
        case "01":
            $mes = "Enero";
            break;
        case "02":
            $mes = "Febrero";
            break;
        case "03":
            $mes = "Marzo";
            break;
        case "04":
            $mes = "Abril";
            break;
        case "05":
            $mes = "Mayo";
            break;
        case "06":
            $mes = "Junio";
            break;
        case "07":
            $mes = "Julio";
            break;
        case "08":
            $mes = "Agosto";
            break;
        case "09":
            $mes = "Septiembre";
            break;
        case "10":
            $mes = "Octubre";
            break;
        case "11":
            $mes = "Noviembre";
            break;
        case "12":
            $mes = "Diciembre";
            break;
        default:
            $mes = "Mes sin registrar";
    }
    return $mes;
}
