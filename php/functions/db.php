<?php
//Función de conexión a la BBDD
function conectar()
{
    try {
        //TODO RECORDAR HABILITAR EL SILENCIADOR DE ERRORES
        return new PDO("mysql:dbname=encuentros_mesa;host=127.0.0.1", "root", "", /*[PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT]*/);
    } catch (PDOException $e) {
        echo "Error con la base de datos: " . $e->getMessage();
    }
}

//Función para desconectar
function desconectar()
{
    return null;
}

//Función para mostrar los juegos
function mostrar_juegos()
{
    try {
        $db = conectar();
        // Realizamos una consulta que devolverla los juegos
        $result = $db->query("SELECT * FROM juegos");
        //Cerramos la base de datos
        $db = desconectar();
        //Devolvemos el resultado de la consulta
        return $result;
    } catch (PDOException $e) {
        //En caso de haber algun tipo de error en la db, muestro el error
        echo "Error con la base de datos: " . $e->getMessage();
    }
}
//Función para mostrar categorías de los juegos
function mostrar_categorias()
{
    try {
        $db = conectar();
        // Realizamos una consulta que devolverla las categorías existentes
        $result = $db->query("SELECT DISTINCT categoria FROM juegos");
        //Utilizamos fetchAll argumentando por parámetro que devuelva la primera columna
        $result = $result->fetchAll(PDO::FETCH_COLUMN, 0);
        //Cerramos la base de datos
        $db = desconectar();
        //Devolvemos el resultado de la consulta
        return $result;
    } catch (PDOException $e) {
        //En caso de haber algun tipo de error en la db, muestro el error
        echo "Error con la base de datos: " . $e->getMessage();
    }
}

//Función para mostrar historial de partidas disponibles, superiores o igual a la fecha actual
function mostrar_partidas_disponibles()
{
    try {
        $db = conectar();
        // Realizamos una consulta que devolverla los juegos, contemplamos la ordenación descendiente para visualizar primero las nuevas insercciones
        $result = $db->query("SELECT 
                                    a.id AS id_partida, 
                                    a.id_creador AS id_creador, 
                                    u.user_name AS participantes,
                                    a.ganador,
                                    a.id_juego,
                                    a.lugar,
                                    DATE_FORMAT(a.fecha_partida,'%d/%m/%Y') AS fecha_partida,
                                    e.texto AS comentarios,
                                    b.nombre AS nombre_juego,
                                    b.max_jugadores AS max_j,
                                    b.min_jugadores AS min_j
                                FROM partidas AS a
                                JOIN juegos AS b ON a.id_juego = b.id
                                JOIN participaciones AS d ON a.id = d.id_partida 
                                JOIN usuarios AS u ON d.id_usuario = u.id  
                                JOIN comentario AS e ON d.id = e.participacion 
                                WHERE a.fecha_partida >= NOW()
                                ORDER BY a.id DESC;");
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        //Cerramos la base de datos
        $db = desconectar();
        if ($result) {
            //Devolvemos el resultado de la consulta
            return $result;
        }
        return FALSE;
    } catch (PDOException $e) {
        //En caso de haber algun tipo de error en la db, muestro el error
        echo "Error con la base de datos: " . $e->getMessage();
    }
}

// Funcion version V2 para mostrar partidas, contando el número de participantes y agrupando comentarios
function mostrar_partidas_disponiblesV2()
{
    try {
        $db = conectar();
        // Realizamos una consulta que devolverla los juegos, contemplamos la ordenación descendiente para visualizar primero las nuevas insercciones
        $result = $db->query("SELECT 
                                a.id AS id_partida, 
                                a.id_creador,
                                u.user_name AS participantes,
                                a.ganador,
                                a.id_juego,
                                a.lugar,
                                DATE_FORMAT(a.fecha_partida,'%d/%m/%Y') AS fecha_partida,
                                GROUP_CONCAT(e.texto SEPARATOR ' | ') AS comentarios, -- Agrupa comentarios
                                b.nombre AS nombre_juego,
                                b.max_jugadores AS max_j,
                                b.min_jugadores AS min_j,
                                COUNT(DISTINCT u.id) AS num_participantes
                            FROM partidas AS a
                            JOIN juegos AS b ON a.id_juego = b.id
                            JOIN participaciones AS d ON a.id = d.id_partida 
                            JOIN usuarios AS u ON d.id_usuario = u.id  
                            LEFT JOIN comentario AS e ON d.id = e.participacion -- Usamos LEFT JOIN para no perder participaciones sin comentarios
                            WHERE a.fecha_partida >= CURDATE() -- Con CURDATE solo hacemos referencia a la fecha y no a la hora
                            GROUP BY a.id
                            ORDER BY a.fecha_partida ASC;");
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        //Cerramos la base de datos
        $db = desconectar();
        if ($result) {
            //Devolvemos el resultado de la consulta
            return $result;
        }
        return FALSE;
    } catch (PDOException $e) {
        //En caso de haber algun tipo de error en la db, muestro el error
        echo "Error con la base de datos: " . $e->getMessage();
    }
}


// Funcion para mostrar las partidas pendientes de un usuario
function mostrar_partidas_pendientes($id_usuario)
{
    try {
        $db = conectar();
        // Realizamos una consulta que devolverla los juegos, contemplamos la ordenación descendiente para visualizar primero las nuevas insercciones
        $result = $db->query("SELECT 
                                a.id AS id_partida, 
                                a.id_creador,
                                u.user_name AS participantes,
                                a.ganador,
                                a.id_juego,
                                a.lugar,
                                DATE_FORMAT(a.fecha_partida,'%d/%m/%Y') AS fecha_partida,
                                GROUP_CONCAT(e.texto SEPARATOR ' | ') AS comentarios, -- Agrupa comentarios
                                b.nombre AS nombre_juego,
                                b.max_jugadores AS max_j,
                                b.min_jugadores AS min_j,
                                COUNT(DISTINCT u.id) AS num_participantes
                            FROM partidas AS a
                            JOIN juegos AS b ON a.id_juego = b.id
                            JOIN participaciones AS d ON a.id = d.id_partida 
                            JOIN usuarios AS u ON d.id_usuario = u.id  
                            LEFT JOIN comentario AS e ON d.id = e.participacion -- Usamos LEFT JOIN para no perder participaciones sin comentarios
                            WHERE a.fecha_partida >= CURDATE() -- Con CURDATE solo hacemos referencia a la fecha actual y no a la hora
                            AND EXISTS (
                                SELECT 1
                                FROM participaciones AS d2
                                WHERE d2.id_partida = a.id
                                AND d2.id_usuario = $id_usuario
                            )
                            GROUP BY a.id
                            ORDER BY a.fecha_partida ASC;");
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        //Cerramos la base de datos
        $db = desconectar();
        if ($result) {
            //Devolvemos el resultado de la consulta
            return $result;
        }
        return FALSE;
    } catch (PDOException $e) {
        //En caso de haber algun tipo de error en la db, muestro el error
        echo "Error con la base de datos: " . $e->getMessage();
    }
}

//Función para mostrar historial de partidas
function mostrar_partidas($id_creador)
{
    try {
        $db = conectar();
        // Realizamos una consulta que devolverla los juegos, contemplamos la ordenación descendiente para visualizar primero las nuevas insercciones
        $result = $db->query("SELECT 
                                    a.id AS id_partida, 
                                    a.id_creador AS id_creador, 
                                    u.user_name AS participantes,
                                    a.lugar, 
                                    a.ganador, 
                                    a.id_juego, 
                                    DATE_FORMAT(a.fecha_partida,'%d/%m/%Y') AS fecha_partida, 
                                    e.texto AS comentarios, 
                                    b.nombre AS nombre_juego
                                FROM partidas AS a
                                JOIN juegos AS b ON a.id_juego = b.id
                                JOIN participaciones AS d ON a.id = d.id_partida 
                                JOIN usuarios AS u ON d.id_usuario = u.id  
                                JOIN comentario AS e ON d.id = e.participacion 
                                WHERE a.id_creador = $id_creador
                                ORDER BY a.id DESC;");
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        //Cerramos la base de datos
        $db = desconectar();
        if ($result) {
            //Devolvemos el resultado de la consulta
            return $result;
        }
        return FALSE;
    } catch (PDOException $e) {
        //En caso de haber algun tipo de error en la db, muestro el error
        echo "Error con la base de datos: " . $e->getMessage();
    }
}

// Función para mostrar la info de una partida
function mostrar_info_partida($id_partida)
{
    try {
        $db = conectar();
        // Realizamos una consulta que devolverla los juegos, contemplamos la ordenación descendiente para visualizar primero las nuevas insercciones
        $result = $db->query("SELECT 
                                    a.id AS id_partida, 
                                    a.id_creador AS id_creador, 
                                    u.user_name AS participantes,
                                    a.lugar, 
                                    a.ganador, 
                                    a.id_juego, 
                                    DATE_FORMAT(a.fecha_partida,'%d/%m/%Y') AS fecha_partida, 
                                    e.texto AS comentarios, 
                                    b.nombre AS nombre_juego
                                FROM partidas AS a
                                JOIN juegos AS b ON a.id_juego = b.id
                                JOIN participaciones AS d ON a.id = d.id_partida 
                                JOIN usuarios AS u ON d.id_usuario = u.id  
                                JOIN comentario AS e ON d.id = e.participacion 
                                WHERE id_partida = $id_partida;");
        $result = $result->fetch(PDO::FETCH_ASSOC);

        //Cerramos la base de datos
        $db = desconectar();
        if ($result) {
            //Devolvemos el resultado de la consulta
            return $result;
        }
        return FALSE;
    } catch (PDOException $e) {
        //En caso de haber algun tipo de error en la db, muestro el error
        echo "Error con la base de datos: " . $e->getMessage();
    }
}

// Función para mostrar el hsitorial de partidas de un usuario en las que participa
function historial_partidas($id_usuario) {
    try {
        $db = conectar();

        $result = $db->query("SELECT 
                                a.id AS id_partida, 
                                a.id_creador,
                                u.user_name,
                                a.ganador,
                                a.id_juego,
                                a.lugar,
                                a.fecha_partida,
                                DATE_FORMAT(a.fecha_partida,'%d/%m/%Y') AS fecha,
                                GROUP_CONCAT(e.texto SEPARATOR ' | ') AS comentarios,
                                b.nombre AS nombre_juego,
                                b.max_jugadores AS max_j,
                                b.min_jugadores AS min_j,
                                COUNT(DISTINCT u.id) AS num_participantes
                            FROM partidas AS a
                            JOIN juegos AS b ON a.id_juego = b.id
                            JOIN participaciones AS d ON a.id = d.id_partida 
                            JOIN usuarios AS u ON d.id_usuario = u.id  
                            LEFT JOIN comentario AS e ON d.id = e.participacion
                            WHERE a.fecha_partida <= NOW()
                            AND EXISTS (
                                SELECT 1
                                FROM participaciones AS d2
                                WHERE d2.id_partida = a.id
                                AND d2.id_usuario = $id_usuario
                            )
                            GROUP BY a.id
                            HAVING num_participantes >= b.min_jugadores
                            ORDER BY a.id DESC;");
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $db = desconectar();
        if(!$result) return FALSE;
        return $result;
    } catch(PDOException $e) {
        //En caso de haber algun tipo de error en la db, muestro el error
        echo "Error con la base de datos: " . $e->getMessage();
    }
}

// Función para mostrar los participantes de una partida
function mostrar_participantes($id_partida)
{
    // Conectar a la base de datos
    $db = conectar();

    // Preparar consulta SQL con GROUP_CONCAT para concatenar los nombres separados por comas
    $stmt = $db->prepare("
        SELECT GROUP_CONCAT(u.user_name SEPARATOR ', ') AS participantes
        FROM participaciones AS p
        JOIN usuarios AS u ON p.id_usuario = u.id
        WHERE p.id_partida = :id_partida
    ");

    // Ejecutar consulta con parámetro seguro
    $stmt->execute([':id_partida' => $id_partida]);

    // Obtener resultado (un solo registro)
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    // Devolver lista de participantes o mensaje por defecto en caso de no haber
    return $resultado['participantes'] ?? 'Sin participantes';
}

// Función para generar los select de los participantes
function generar_select_participantes($id_partida)
{
    $db = conectar(); // Conexión a la base de datos

    // Consulta para obtener participantes de la partida
    $stmt = $db->prepare("
        SELECT u.id, u.user_name 
        FROM participaciones AS p
        JOIN usuarios AS u ON p.id_usuario = u.id
        WHERE p.id_partida = :id_partida
    ");
    $stmt->execute([':id_partida' => $id_partida]);
    $participantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$participantes) return FALSE;
    return $participantes;
}


function contar_partidas_disponibles_totales()
{
    try {
        // Conectar a la base de datos
        $db = conectar();

        // Consulta: Contar partidas con fecha >= hoy
        $stmt = $db->prepare("
            SELECT COUNT(*) AS total 
            FROM partidas
            WHERE fecha_partida >= NOW()
        ");

        // Ejecutar consulta
        $stmt->execute();

        // Obtener resultado
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$resultado['total'];
    } catch (PDOException $e) {
        // Manejar errores (opcional: registrar el error)
        error_log("Error al contar partidas: " . $e->getMessage());
        return 0;
    }
}
// Función para contar partidas disponibles totales de un usuario
function contar_partidas_disponibles_totales_usuario($id_usuario)
{
    try {
        // Conectar a la base de datos
        $db = conectar();

        // Consulta: Contar partidas con fecha >= hoy
        $stmt = $db->prepare("
            SELECT COUNT(*) AS total 
            FROM partidas AS a
            JOIN participaciones AS d ON a.id = d.id_partida
            WHERE fecha_partida >= NOW()
            AND d.id_usuario = $id_usuario
        ");

        // Ejecutar consulta
        $stmt->execute();

        // Obtener resultado
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$resultado['total'];
    } catch (PDOException $e) {
        // Manejar errores (opcional: registrar el error)
        error_log("Error al contar partidas: " . $e->getMessage());
        return 0;
    }
}

// Función para obtener los juegos que más partidas tienen de los usuarios
function juego_mas_partidas()
{
    try {
        $db = conectar();
        // Realizamos una consulta que devolverla los juegos con más partidas, agrupadas por el id_juego y ordenadas por la cantidad de partidas en orden descendete, devolvemos las 7 primeras
        $result = $db->query("SELECT id_juego, COUNT(*) AS total_partidas
                                FROM partidas
                                GROUP BY id_juego
                                ORDER BY total_partidas DESC
                                LIMIT 7");
        $result = $result->fetchAll(PDO::FETCH_ASSOC);

        //Cerramos la base de datos
        $db = desconectar();
        if ($result) {
            //Devolvemos el resultado de la consulta
            return $result;
        }
        return FALSE;
    } catch (PDOException $e) {
        //En caso de haber algun tipo de error en la db, muestro el error
        echo "Error con la base de datos: " . $e->getMessage();
    }
}

// Función para comprobar si existe un usuario en una partida
function user_partida_exist($id_partida, $id_usuario) {
    $db = conectar();
    $existe = $db->query("SELECT EXISTS(
                                SELECT 1 
                                FROM participaciones 
                                WHERE id_usuario = $id_usuario 
                                AND id_partida = $id_partida
                            ) AS existe;");
    // Obtener el resultado (true/false)
    $resultado = $existe->fetch(PDO::FETCH_ASSOC);
    $existe = $resultado['existe'] ?? false;

        $db = desconectar();
        return $existe;
}

// Función para mostrar al Game Master
function game_master($id_creador) {
    try {
        $db = conectar();
        // Realizamos una consulta que devolverla el user_name del Game Master
        $result = $db->query("SELECT user_name 
                                FROM usuarios 
                                WHERE id = $id_creador;");
        $result = $result->fetch(PDO::FETCH_ASSOC);
        //Cerramos la base de datos
        $db = desconectar();
        if ($result) {
            //Devolvemos el resultado de la consulta
            return $result;
        }
        return FALSE;
    } catch (PDOException $e) {
        //En caso de haber algun tipo de error en la db, muestro el error
        echo "Error con la base de datos: " . $e->getMessage();
    }
}

// Función para comprobar las partidas vigentes de un usuario
function contar_partidas_usuario_vigentes($id_usuario)
{
    try {
        // Conectar a la base de datos
        $db = conectar();

        // Consulta: Contar participaciones en partidas vigentes
        $result = $db->prepare("
            SELECT COUNT(*) AS total 
            FROM participaciones 
            JOIN partidas ON participaciones.id_partida = partidas.id
            WHERE participaciones.id_usuario = ? 
            AND partidas.fecha_partida >= NOW()
        ");

        // Ejecutar con parámetros seguros
        $result->execute(array($id_usuario));

        // Obtener resultado
        $resultado = $result->fetch(PDO::FETCH_ASSOC);
        // Devuelvo el contenido de total
        return $resultado["total"];
    } catch (PDOException $e) {
        // Registrar error y devolver 0
        error_log("Error al contar partidas: " . $e->getMessage());
        return $e;
    }
}
