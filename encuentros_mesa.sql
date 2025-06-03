-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2025 a las 12:50:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `encuentros_mesa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(3) NOT NULL,
  `texto` varchar(300) NOT NULL,
  `participacion` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `texto`, `participacion`) VALUES
(2, 'Venir con vaselina', 8),
(3, 'Sin comentario.', 9),
(4, 'Sin comentario.', 10),
(5, 'Calle inventada, n7', 11),
(6, 'Traer refrescos', 27),
(7, 'Traer vaselina', 29),
(8, 'Sin comentario.', 41),
(9, 'Te reviento', 42),
(10, 'Sin comentario.', 46),
(12, 'Sin comentario.', 52),
(13, 'Sin comentario.', 55),
(15, 'Sin comentario.', 57),
(16, 'Traer refrescos.', 58),
(17, 'Sin comentario.', 59),
(18, 'Sin comentario.', 62),
(19, 'Sin comentario.', 63),
(20, 'Sin comentario.', 73),
(21, 'Traer refrescos', 74),
(25, 'Sin comentario.', 81),
(26, 'Se accede al local por la puerta lateral', 82),
(27, 'Calle en obras, aparcar en la perpendicular', 83),
(28, 'Traer algo de almuerzo', 84),
(30, 'Sin comentario.', 113),
(31, 'Duración aproximada de 4 horas.', 118),
(32, 'Parking en la calle paralela.', 136),
(33, 'Máximo podemos estar hasta las 20:00', 148),
(34, 'Sin comentario.', 150),
(35, 'Necesario venir disfrazado roleando', 151),
(36, 'Sin comentario.', 152),
(37, 'Sin comentario.', 153),
(38, 'Hay poco aparcamiento por la zona, recomiendo venir en transporte público.', 163),
(39, 'Importante traer tu propia bebida.', 166),
(40, 'Es necesario indicar en la entrada que vienes por los juegos de mesa.', 172),
(41, 'Las consumiciones corren a cargo de cada uno.', 180),
(42, 'Utilizar la entrada sur.', 181),
(43, 'Tener cuidado con la carretera de acceso.', 186),
(44, 'Hay cerca un bar para pedir refrescos, tienen un rape exquisito para comer.', 196),
(46, 'Traer algo para picotear.', 224),
(47, 'Podemos jugar hasta las 20:00', 226),
(48, 'Podemos estar jugando hasta las 20:00', 228),
(49, 'Hay una explanada al final de la calle para aparcar.', 229),
(50, 'Hay una explanada al final de la calle para aparcar.', 232),
(51, 'No aparcar en el lado derecho de la calle por favor.', 234),
(52, 'Traer algo de refrescos.', 238),
(54, 'Venir disfrazados.', 244),
(59, 'Se puede acceder mediante la calle de detrás.', 249),
(60, 'Sin comentario.', 256),
(61, 'Venir 5 minutos antes para poder acceder.', 266),
(62, 'Sin comentario.', 267),
(63, 'Sin comentario.', 269),
(64, 'Local habilitado para juegos de mesa.', 277),
(65, 'Local habilitado para juegos de mesa.', 281),
(66, 'Sin comentario.', 286),
(67, 'Sin comentario.', 298),
(68, 'Traer chuches, estamos en el salón de actos.', 302),
(69, 'Sin comentario.', 307),
(70, 'Sin comentario.', 324),
(71, 'Sin comentario.', 325),
(72, 'Sin comentario.', 330),
(73, 'Sin comentario.', 347),
(74, 'Venir con algun objeto medieval.', 351),
(75, 'Venir con muchas ganas de trolear :P', 355),
(76, 'Sin comentario.', 360),
(79, 'Sin comentario.', 368),
(81, 'Intentar ser puntuales.', 374);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id` int(3) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `min_jugadores` int(3) NOT NULL,
  `max_jugadores` int(3) NOT NULL,
  `duracion` int(11) NOT NULL,
  `edad_recomendada` int(11) NOT NULL,
  `categoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id`, `nombre`, `descripcion`, `min_jugadores`, `max_jugadores`, `duracion`, `edad_recomendada`, `categoria`) VALUES
(1, 'Catan', 'En Catan, los jugadores asumen el rol de colonos en una isla inexplorada. Deben construir asentamientos, ciudades y carreteras mientras comercian recursos como madera, ladrillo, trigo, ovejas y piedra. El objetivo es ser el primero en alcanzar 10 puntos de victoria mediante la construcción estratégi', 3, 4, 60, 10, 'Estrategia'),
(2, 'Carcassonne', 'Carcassonne es un juego de colocación de fichas donde los jugadores construyen un paisaje medieval formado por ciudades, caminos, monasterios y campos. Los jugadores colocan seguidores (\"meeples\") en estas áreas para reclamar puntos al completar ciudades o caminos. La estrategia radica en decidir dó', 2, 5, 45, 8, 'Estrategia'),
(4, 'Ticket to Ride', 'En Ticket to Ride, los jugadores compiten por construir rutas ferroviarias a través de un mapa de ciudades conectadas por trenes. Deben completar rutas asignadas en sus cartas de destino mientras acumulan puntos por construir largas conexiones.', 2, 5, 60, 8, 'Familia'),
(5, 'Dixit', 'Dixit es un juego creativo de asociaciones y deducción basado en ilustraciones evocadoras. Un jugador describe una carta usando una pista ambigua, y los demás intentan adivinar cuál es la carta correcta entre varias opciones. El equilibrio entre pistas demasiado obvias o demasiado crípticas es lo qu', 3, 6, 30, 8, 'Familia'),
(6, 'Codenames', 'Codenames es un juego de palabras y espías donde dos equipos compiten por descifrar claves secretas. Un \"espía maestro\" da pistas de una palabra relacionada con múltiples términos en el tablero, y su equipo debe adivinar correctamente las palabras aliadas sin tocar las del equipo contrario o la pala', 4, 8, 15, 10, 'Party'),
(7, '7 Wonders', '7 Wonders es un juego de civilizaciones antiguas donde los jugadores construyen maravillas y desarrollan tecnologías, ejércitos y comercio. A través de rondas rápidas, los jugadores seleccionan cartas para mejorar sus ciudades mientras compiten por puntos de victoria. La mecánica de selección de car', 3, 7, 30, 10, 'Estrategia'),
(8, 'Splendor', 'Splendor es un juego de gestión de recursos donde los jugadores asumen el rol de comerciantes renacentistas. Deben recolectar gemas para comprar cartas que representan minas, transportes y tiendas, ganando prestigio con nobles visitantes. La clave está en planificar qué recursos adquirir y cómo maxi', 2, 4, 30, 10, 'Estrategia'),
(9, 'Saboteur', 'Saboteur es un juego de cartas estratégico donde enanos excavan túneles en busca de oro. Los jugadores pueden ser mineros, cooperando para encontrar el tesoro, o saboteadores, intentando bloquear el camino. Con roles ocultos, dinámica de equipo y decisiones tácticas, ofrece partidas rápidas.', 3, 12, 30, 10, 'Party'),
(10, 'Risk', 'Risk es un juego estratégico de conquista mundial donde los jugadores controlan territorios en un mapa global. Deben expandir sus ejércitos, atacar a sus oponentes y defenderse de contraataques. Con su combinación de azar y estrategia, Risk ofrece partidas largas y llenas de tensiones geopolíticas.', 2, 6, 120, 10, 'Estrategia'),
(11, 'Monopoly', 'Monopoly es un clásico juego de bienes raíces donde los jugadores compran, venden y negocian propiedades mientras intentan arruinar financieramente a sus oponentes. Con su mecánica basada en la suerte de los dados y las tarjetas de comunidad y fortuna, Monopoly puede ser tanto divertido como frustra', 2, 8, 90, 8, 'Familia'),
(12, 'Cluedo', 'Cluedo es un juego de misterio donde los jugadores deben resolver un asesinato en una mansión. Moviendo sus personajes por las habitaciones, recolectan pistas para determinar quién cometió el crimen, con qué arma y en qué lugar. Es un juego de deducción perfecto para grupos pequeños.', 3, 6, 45, 8, 'Misterio'),
(13, 'Scrabble', 'Scrabble es un juego de palabras donde los jugadores crean palabras en un tablero para ganar puntos. Las letras tienen diferentes valores, y colocarlas en casillas especiales puede multiplicar los puntos. Es un excelente juego para amantes de la lengua y los desafíos mentales.', 2, 4, 60, 10, 'Palabras'),
(14, 'Chess', 'El ajedrez es un juego de estrategia clásico donde dos jugadores compiten con piezas únicas en un tablero de 8x8. Cada pieza tiene movimientos específicos, y el objetivo es dar jaque mate al rey del oponente. Su profundidad estratégica lo convierte en uno de los juegos más icónicos de todos los tiem', 2, 2, 30, 6, 'Estrategia'),
(15, 'Damas', 'Las damas son un juego de estrategia simple donde los jugadores mueven fichas en un tablero para capturar las del oponente. Las reglas son sencillas, pero la estrategia puede ser profunda. Es ideal para jugadores de todas las edades.', 2, 2, 30, 6, 'Estrategia'),
(16, 'Backgammon', 'Backgammon es un juego de dados y estrategia donde los jugadores intentan mover todas sus fichas fuera del tablero antes que su oponente. La suerte de los dados se combina con decisiones estratégicas sobre cómo mover las fichas, lo que lo hace emocionante y desafiante.', 2, 2, 30, 8, 'Estrategia'),
(17, 'Mancala', 'Mancala es un juego de semillas y estrategia donde los jugadores recolectan y distribuyen piedras en hoyos. El objetivo es capturar más semillas que el oponente mediante movimientos estratégicos. Es un juego antiguo con reglas simples pero profundas.', 2, 2, 15, 6, 'Estrategia'),
(18, 'Go', 'Go es un juego abstracto de origen oriental donde los jugadores colocan piedras en un tablero para controlar territorios. A pesar de sus reglas simples, Go es conocido por su complejidad estratégica y su elegancia visual. Es uno de los juegos más antiguos del mundo.', 2, 2, 60, 8, 'Estrategia'),
(19, 'Shogi', 'Shogi es el ajedrez japonés, donde las piezas capturadas pueden ser reintroducidas en el tablero. Esta mecánica única agrega una capa adicional de estrategia y dinamismo al juego. Es ideal para jugadores que buscan un desafío táctico.', 2, 2, 30, 10, 'Estrategia'),
(20, 'Dominion', 'Dominion es un juego de construcción de mazos donde los jugadores comienzan con un mazo básico y adquieren cartas para mejorar su estrategia. La clave está en gestionar tus recursos y adaptarte a las cartas disponibles en cada partida. Es un juego altamente rejugable y estratégico.', 2, 4, 30, 10, 'Estrategia'),
(21, 'Terraforming Mars', 'Terraforming Mars es un juego de gestión de recursos donde los jugadores transforman Marte en un planeta habitable. Deben aumentar la temperatura, el oxígeno y los océanos mientras construyen ciudades y generan ingresos. La combinación de estrategia y temática espacial lo hace fascinante.', 2, 5, 120, 12, 'Estrategia'),
(23, 'Small World', 'Small World es un juego de conquista donde razas fantásticas compiten por el dominio de un mundo pequeño. Cada raza tiene habilidades únicas, y los jugadores deben decidir cuándo retirarse y elegir una nueva raza. La mezcla de estrategia y humor lo hace muy divertido.', 2, 5, 45, 8, 'Estrategia'),
(24, 'Azul', 'Azul es un juego de diseño y estrategia donde los jugadores decoran un palacio real con azulejos portugueses. Deben recolectar azulejos de diferentes colores y colocarlos en patrones específicos para ganar puntos. La estética visual es impresionante.', 2, 4, 35, 8, 'Estrategia'),
(25, 'Kingdomino', 'Kingdomino es un juego de construcción de reinos donde los jugadores expanden su territorio con fichas de dominó. Cada ficha tiene dos tipos de terreno, y los jugadores deben organizarlas para maximizar sus puntos. Es rápido, colorido y fácil de aprender.', 2, 4, 15, 8, 'Familia'),
(27, 'Secret Hitler', 'Secret Hitler es un juego de deducción política ambientado en la Alemania de los años 30. Los jugadores asumen roles ocultos como liberales o fascistas, y deben trabajar para aprobar políticas o descubrir a los traidores. La tensión y el engaño son clave.', 5, 10, 45, 13, 'Party'),
(28, 'Love Letter', 'Love Letter es un juego de deducción y eliminación donde los jugadores intentan entregar su carta al príncipe. Con solo 16 cartas, el juego es rápido y estratégico, ideal para partidas cortas y emocionantes.', 2, 4, 20, 10, 'Party'),
(29, 'Uno', 'Uno es un juego de cartas rápido donde los jugadores coinciden colores o números para quedarse sin cartas. Las cartas especiales como \"Roba 2\" o \"Salta Turno\" agregan emoción y estrategia. Es perfecto para grupos grandes.', 2, 10, 15, 7, 'Familia'),
(30, 'Exploding Kittens', 'Exploding Kittens es un juego absurdo donde los jugadores intentan evitar gatitos explosivos. Con cartas que permiten robar, saltar turnos o forzar a otros jugadores, el juego es caótico y divertido. Ideal para partidas rápidas.', 2, 5, 15, 7, 'Party'),
(33, 'Twilight Imperium', 'Twilight Imperium es un juego épico de estrategia espacial donde las civilizaciones compiten por el control de la galaxia. Con reglas complejas y una duración de varias horas, es ideal para jugadores que buscan una experiencia inmersiva y desafiante.', 3, 6, 240, 14, 'Estrategia'),
(35, 'Mage Knight', 'Mage Knight es un juego de exploración y construcción de mazos ambientado en un mundo de fantasía. Los jugadores asumen el rol de poderosos magos-knight que deben explorar territorios desconocidos y enfrentar enemigos. La profundidad estratégica es impresionante.', 1, 4, 120, 14, 'Estrategia'),
(36, 'Eclipse', 'Eclipse es un juego de estrategia espacial donde las civilizaciones compiten por recursos y tecnología. Con mecánicas de gestión de recursos y combate táctico, el juego ofrece una experiencia rica y desafiante.', 2, 6, 180, 12, 'Estrategia'),
(37, 'Brass: Birmingham', 'Brass: Birmingham es un juego económico donde los jugadores desarrollan industrias en la Inglaterra del siglo XIX. Deben construir fábricas, canales y ferrocarriles mientras compiten por puntos de victoria. La planificación a largo plazo es crucial.', 2, 4, 120, 12, 'Estrategia'),
(38, 'Root', 'Root es un juego asimétrico de conflictos entre facciones en un bosque animado. Cada facción tiene mecánicas únicas, lo que lo hace altamente rejugable y estratégico. Es ideal para jugadores que disfrutan de la innovación.', 2, 4, 60, 10, 'Estrategia'),
(39, 'Wingspan', 'Wingspan es un juego de gestión de recursos donde los jugadores cuidan aves y construyen reservas naturales. Con una mecánica de motorización de acciones y un diseño visual impresionante, el juego es relajante y educativo.', 1, 5, 70, 10, 'Familia'),
(40, 'Coup', 'Coup es un juego de engaño y estrategia donde los jugadores eliminan a sus oponentes mediante roles ocultos. Con solo 15 cartas, el juego es rápido y lleno de tensión. Ideal para partidas cortas.', 2, 6, 15, 12, 'Party'),
(41, 'The Resistance', 'The Resistance es un juego de espías y traiciones donde los jugadores intentan completar misiones secretas. Los espías deben sabotear las misiones sin revelar su identidad, mientras que los leales deben descubrir a los traidores.', 5, 10, 30, 13, 'Party'),
(42, 'Sheriff of Nottingham', 'Sheriff of Nottingham es un juego de negociación y contrabando donde los jugadores intentan pasar mercancías prohibidas al mercado. Deben negociar con el sheriff para evitar inspecciones y maximizar sus ganancias.', 3, 5, 60, 10, 'Negociación'),
(44, 'Takenoko', 'Takenoko es un juego de construcción y gestión donde los jugadores cultivan un jardín para un panda. Deben colocar parcelas de bambú y alimentar al panda mientras cumplen objetivos específicos.', 2, 4, 45, 8, 'Familia'),
(45, 'Sushi Go!', 'Sushi Go! es un juego de cartas rápido donde los jugadores crean combinaciones de sushi para ganar puntos. Con rondas rápidas y mecánicas simples, es ideal para partidas familiares.', 2, 5, 20, 8, 'Familia'),
(47, 'Century: Spice Road', 'Century: Spice Road es un juego de comercio y gestión de recursos donde los jugadores intercambian especias para ganar puntos. Con mecánicas simples pero estratégicas, es ideal para jugadores casuales.', 2, 5, 30, 8, 'Estrategia'),
(48, 'Race for the Galaxy', 'Race for the Galaxy es un juego de construcción de mazos donde los jugadores desarrollan galaxias enteras. Con una combinación de estrategia y azar, el juego ofrece una experiencia rápida y envolvente.', 2, 4, 30, 12, 'Estrategia'),
(49, 'Through the Ages', 'Through the Ages es un juego de civilización donde los jugadores construyen y gestionan imperios históricos. Desde la antigüedad hasta la era moderna, deben tomar decisiones estratégicas para maximizar su progreso.', 2, 4, 120, 12, 'Estrategia'),
(50, 'Power Grid', 'Power Grid es un juego de gestión de recursos donde los jugadores construyen redes eléctricas. Deben comprar plantas de energía, recursos y conexiones mientras compiten por abastecer ciudades. La planificación económica es crucial.', 2, 6, 120, 12, 'Estrategia'),
(51, 'Agricola', 'Agricola es un juego de gestión de granjas donde los jugadores cultivan alimentos y crían animales. Deben equilibrar sus recursos y expandir sus granjas mientras compiten por puntos de victoria.', 1, 5, 120, 12, 'Estrategia'),
(52, 'Puerto Rico', 'Puerto Rico es un juego de economía donde los jugadores construyen plantaciones y comercian bienes. Con mecánicas de roles únicos, cada turno presenta decisiones estratégicas que afectan a todos los jugadores.', 2, 5, 90, 12, 'Estrategia'),
(53, 'Terra Mystica', 'Terra Mystica es un juego de construcción territorial donde las razas compiten por espacio en un mundo mágico. Con mecánicas de conversión de recursos y expansión estratégica, el juego ofrece una experiencia profunda y desafiante.', 2, 5, 120, 12, 'Estrategia'),
(54, '7 Wonders Duel', '7 Wonders Duel es una versión para dos jugadores de 7 Wonders con mecánicas ajustadas. Los jugadores construyen maravillas y desarrollan tecnologías mientras compiten por puntos de victoria.', 2, 2, 30, 10, 'Estrategia'),
(57, 'Ciudadelas', 'Ciudadelas es un juego de estrategia y construcción donde los jugadores desarrollan su ciudad mientras intentan frustrar planes rivales. Combina roles únicos, planificación y gestión de recursos.', 2, 7, 60, 10, 'Estrategia'),
(58, 'King of Tokyo', 'King of Tokyo es un juego de dados y gestión de recursos donde monstruos gigantes compiten por el control de la ciudad. Ataca, gana puntos o sobrevive para ser el último en pie.', 2, 6, 30, 8, 'Estrategia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participaciones`
--

CREATE TABLE `participaciones` (
  `id` int(3) NOT NULL,
  `id_partida` int(3) NOT NULL,
  `id_usuario` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `participaciones`
--

INSERT INTO `participaciones` (`id`, `id_partida`, `id_usuario`) VALUES
(76, 8, 33),
(72, 8, 34),
(45, 8, 36),
(8, 8, 37),
(39, 8, 38),
(112, 8, 44),
(16, 9, 33),
(9, 9, 37),
(47, 9, 38),
(10, 10, 33),
(12, 10, 36),
(53, 10, 37),
(38, 10, 38),
(13, 11, 33),
(11, 11, 36),
(25, 11, 37),
(27, 12, 33),
(30, 12, 37),
(36, 13, 33),
(44, 13, 36),
(29, 13, 37),
(37, 13, 38),
(41, 14, 36),
(43, 14, 38),
(42, 15, 38),
(46, 16, 38),
(54, 18, 33),
(52, 18, 37),
(55, 19, 33),
(61, 19, 37),
(57, 21, 33),
(213, 21, 70),
(58, 22, 33),
(68, 22, 36),
(69, 22, 37),
(64, 22, 38),
(59, 23, 33),
(62, 24, 33),
(70, 24, 34),
(67, 24, 36),
(65, 24, 38),
(114, 24, 44),
(89, 25, 33),
(66, 25, 36),
(120, 25, 37),
(63, 25, 38),
(132, 25, 44),
(79, 26, 33),
(73, 26, 34),
(158, 26, 35),
(86, 26, 36),
(125, 26, 37),
(204, 26, 38),
(117, 26, 44),
(147, 26, 45),
(77, 27, 33),
(74, 27, 34),
(161, 27, 35),
(122, 27, 37),
(116, 27, 44),
(143, 27, 45),
(198, 27, 49),
(216, 27, 70),
(221, 27, 71),
(81, 31, 33),
(128, 31, 36),
(121, 31, 37),
(205, 31, 38),
(134, 31, 44),
(142, 31, 45),
(104, 32, 33),
(90, 32, 34),
(82, 32, 38),
(108, 32, 43),
(111, 33, 33),
(130, 33, 36),
(123, 33, 37),
(83, 33, 38),
(115, 33, 44),
(145, 33, 45),
(110, 34, 33),
(84, 34, 36),
(109, 34, 43),
(212, 34, 70),
(139, 36, 33),
(129, 36, 36),
(126, 36, 37),
(113, 36, 44),
(144, 36, 45),
(137, 37, 33),
(127, 37, 36),
(119, 37, 37),
(118, 37, 38),
(133, 37, 44),
(149, 37, 45),
(138, 38, 33),
(136, 38, 44),
(141, 38, 45),
(154, 39, 33),
(148, 39, 45),
(156, 40, 33),
(157, 40, 35),
(165, 40, 36),
(175, 40, 37),
(150, 40, 45),
(179, 40, 46),
(155, 41, 33),
(160, 41, 35),
(170, 41, 36),
(151, 41, 45),
(197, 41, 49),
(152, 42, 33),
(159, 42, 35),
(167, 42, 36),
(203, 42, 38),
(207, 42, 45),
(215, 42, 70),
(220, 42, 71),
(153, 43, 33),
(169, 43, 36),
(206, 43, 38),
(214, 43, 70),
(163, 44, 35),
(164, 44, 36),
(173, 44, 37),
(178, 44, 46),
(183, 44, 47),
(217, 44, 70),
(166, 45, 36),
(174, 45, 37),
(177, 45, 46),
(182, 45, 47),
(187, 45, 48),
(193, 45, 49),
(172, 46, 37),
(176, 46, 46),
(185, 46, 47),
(190, 46, 48),
(195, 46, 49),
(223, 46, 71),
(202, 47, 38),
(180, 47, 46),
(184, 47, 47),
(189, 47, 48),
(194, 47, 49),
(285, 48, 36),
(201, 48, 38),
(181, 48, 47),
(188, 48, 48),
(192, 48, 49),
(218, 48, 70),
(364, 49, 33),
(209, 49, 45),
(186, 49, 48),
(191, 49, 49),
(222, 49, 71),
(260, 50, 34),
(200, 50, 38),
(208, 50, 45),
(196, 50, 49),
(225, 50, 68),
(219, 50, 70),
(251, 52, 44),
(241, 52, 48),
(235, 52, 56),
(224, 52, 68),
(230, 52, 70),
(227, 52, 71),
(409, 53, 33),
(279, 53, 35),
(236, 53, 56),
(231, 53, 70),
(226, 53, 71),
(424, 54, 33),
(371, 54, 37),
(253, 54, 44),
(272, 54, 46),
(233, 54, 70),
(228, 54, 71),
(259, 55, 34),
(255, 55, 44),
(242, 55, 48),
(263, 55, 49),
(237, 55, 56),
(229, 55, 70),
(257, 56, 44),
(270, 56, 46),
(239, 56, 56),
(232, 56, 70),
(323, 56, 72),
(278, 57, 35),
(250, 57, 44),
(275, 57, 46),
(276, 57, 46),
(240, 57, 48),
(234, 57, 56),
(284, 58, 36),
(252, 58, 44),
(238, 58, 56),
(343, 58, 70),
(410, 60, 33),
(258, 60, 44),
(306, 60, 45),
(273, 60, 46),
(244, 60, 48),
(261, 65, 34),
(254, 65, 44),
(249, 65, 48),
(264, 65, 49),
(262, 66, 34),
(280, 66, 35),
(256, 66, 44),
(265, 66, 49),
(287, 67, 36),
(334, 67, 37),
(268, 67, 46),
(266, 67, 49),
(328, 68, 33),
(288, 68, 36),
(267, 68, 46),
(362, 68, 49),
(407, 69, 33),
(269, 69, 46),
(297, 69, 48),
(342, 69, 70),
(321, 69, 72),
(300, 70, 33),
(277, 70, 35),
(282, 70, 36),
(290, 70, 46),
(293, 70, 47),
(295, 70, 48),
(363, 71, 33),
(281, 71, 35),
(283, 71, 36),
(291, 71, 46),
(296, 71, 48),
(322, 71, 72),
(286, 72, 36),
(289, 72, 46),
(292, 72, 47),
(294, 72, 48),
(299, 73, 33),
(303, 73, 37),
(304, 73, 45),
(298, 73, 48),
(308, 73, 56),
(313, 73, 70),
(335, 73, 71),
(318, 73, 72),
(312, 74, 33),
(302, 74, 37),
(305, 74, 45),
(358, 74, 46),
(317, 74, 48),
(361, 74, 49),
(309, 74, 56),
(346, 74, 68),
(315, 74, 70),
(337, 74, 71),
(320, 74, 72),
(311, 75, 33),
(332, 75, 37),
(307, 75, 45),
(316, 75, 48),
(310, 75, 56),
(314, 75, 70),
(338, 75, 71),
(319, 75, 72),
(329, 76, 33),
(339, 76, 70),
(324, 76, 72),
(326, 77, 33),
(333, 77, 37),
(340, 77, 70),
(325, 77, 72),
(330, 78, 33),
(331, 78, 37),
(341, 78, 70),
(336, 78, 71),
(348, 79, 33),
(347, 79, 37),
(350, 79, 48),
(349, 79, 56),
(351, 80, 33),
(354, 80, 36),
(352, 80, 38),
(353, 80, 72),
(355, 81, 33),
(359, 81, 37),
(357, 81, 46),
(356, 81, 68),
(360, 82, 37),
(368, 85, 37),
(374, 87, 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

CREATE TABLE `partidas` (
  `id` int(3) NOT NULL,
  `ganador` varchar(30) DEFAULT NULL,
  `fecha_partida` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_creador` int(3) NOT NULL,
  `id_juego` int(3) NOT NULL,
  `lugar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partidas`
--

INSERT INTO `partidas` (`id`, `ganador`, `fecha_partida`, `id_creador`, `id_juego`, `lugar`) VALUES
(8, 'Mario', '2025-05-18 17:54:36', 37, 58, 'Casa'),
(9, 'Héctor', '2025-05-08 15:30:00', 37, 10, 'Casa'),
(10, 'Rubén', '2025-05-17 09:52:25', 33, 10, 'Casa'),
(11, 'Rubén', '2025-04-27 14:00:00', 36, 10, 'Local en Toledo'),
(12, 'Héctor', '2025-05-17 10:53:18', 33, 58, 'C/ Inventada, N7'),
(13, 'Mario', '2025-04-30 18:00:00', 37, 57, 'C/ Inventada, N7'),
(14, 'Mario', '2025-05-26 14:28:06', 36, 14, 'Local en Toledo'),
(15, NULL, '2025-04-27 15:15:00', 38, 14, 'C/ Inventada, CHESS2'),
(16, NULL, '2025-04-30 16:45:00', 38, 41, 'C/ Inventada, Ressitance'),
(18, NULL, '2025-05-07 14:15:00', 37, 9, 'C/ Inventada, N7'),
(19, 'Héctor', '2025-05-17 09:52:53', 33, 14, 'Local en Toledo'),
(21, 'Adrian', '2025-05-20 09:27:00', 33, 12, 'Local en Toledo'),
(22, 'Rubén', '2025-05-26 13:43:29', 33, 35, 'Local en Toledo'),
(23, NULL, '2025-05-07 10:00:00', 33, 15, 'Local en Toledo'),
(24, 'pepe', '2025-05-17 09:49:05', 33, 10, 'C/ Inventada, Ressitance'),
(25, 'Rubén', '2025-05-26 13:44:32', 38, 10, 'C/ Inventada, N7'),
(26, 'Adrian', '2025-05-26 13:46:22', 34, 9, 'C/ Inventada, N7'),
(27, 'Feldespato', '2025-05-26 13:46:10', 34, 27, 'C/ Inventada, N7'),
(31, 'Jaime78', '2025-05-18 17:50:07', 33, 27, 'Casa'),
(32, 'Adrian', '2025-05-18 17:51:00', 38, 57, 'C/ Inventada, Ressitance'),
(33, 'Jaime78', '2025-05-18 17:50:56', 38, 58, 'C/ Inventada, Ressitance'),
(34, 'Adrian', '2025-05-19 19:12:09', 36, 57, 'Casa'),
(36, 'Adrian', '2025-05-26 13:42:47', 44, 23, 'Local en Toledo'),
(37, 'Jaime78', '2025-05-26 13:44:27', 38, 10, 'C/ Inventada, Ressitance'),
(38, 'Jaime78', '2025-05-26 13:42:51', 44, 10, 'C/ Inventada, N7'),
(39, 'Adrian', '2025-05-27 14:41:08', 45, 10, 'C/ Inventada, CHESS2'),
(40, 'Clarita', '2025-05-18 17:52:46', 45, 58, 'C/ Inventada, CHESS2'),
(41, NULL, '2025-05-20 16:15:00', 45, 23, 'C/ Inventada, Ressitance'),
(42, NULL, '2025-05-27 15:32:30', 33, 9, 'C/ Inventada, Ressitance'),
(43, 'Crkox', '2025-05-26 13:45:18', 33, 12, 'C/ Inventada, Ressitance'),
(44, 'Clarita', '2025-05-26 14:25:49', 35, 58, 'Calle Alberche, 7'),
(45, NULL, '2025-06-22 17:15:00', 36, 58, 'Calle del Arroyo, 9'),
(46, NULL, '2025-06-02 16:30:00', 37, 58, 'Centro Cultural de Bargas'),
(47, NULL, '2025-07-28 16:30:00', 46, 58, 'Bar Juegos Reunidos'),
(48, NULL, '2025-07-15 17:22:00', 47, 58, 'Centro Cultural \"El Observatorio Sur\"'),
(49, NULL, '2025-06-25 15:22:00', 48, 58, 'Centro Cultura \"Abismo del Gigante\"'),
(50, NULL, '2025-06-16 17:22:00', 49, 58, 'Centro Cultural \"Espinoscuro\"'),
(52, NULL, '2025-06-14 10:00:00', 68, 10, 'C/ Inventada, N7'),
(53, NULL, '2025-06-20 15:50:00', 71, 10, 'Calle Serrania del Valle, N8'),
(54, NULL, '2025-06-12 15:50:00', 71, 58, 'Calle Serrania del Valle, N8'),
(55, NULL, '2025-06-18 15:00:00', 70, 10, 'Avda de Guadarrama, N11'),
(56, NULL, '2025-06-22 16:15:00', 70, 58, 'Avda de Guadarrama, N11'),
(57, NULL, '2025-06-07 17:15:00', 56, 10, 'Calle del Arroyo, 9'),
(58, NULL, '2025-06-21 15:20:00', 56, 58, 'Calle del Arroyo, 9'),
(60, NULL, '2025-06-10 14:25:00', 48, 10, 'Centro Cultura \"Abismo del Gigante\"'),
(65, NULL, '2025-06-26 13:30:00', 48, 1, 'Centro Cultura \"Abismo del Gigante\"'),
(66, NULL, '2025-06-13 16:45:00', 44, 1, 'Calle Extremadura, 12'),
(67, NULL, '2025-06-16 15:45:00', 49, 1, 'Centro Cultural \"Espinoscuro\"'),
(68, NULL, '2025-06-18 15:00:00', 46, 1, 'Calle Alberche, 7'),
(69, NULL, '2025-06-15 16:30:00', 46, 10, 'Calle Alberche, 7'),
(70, NULL, '2025-05-27 16:30:00', 35, 10, 'Calle Extremadura, 23'),
(71, NULL, '2025-05-29 16:30:00', 35, 10, 'Calle Extremadura, 23'),
(72, NULL, '2025-05-26 15:30:00', 36, 1, 'C/ Inventada, Ressitance'),
(73, 'Fedel-Rico', '2025-05-27 14:39:48', 48, 9, 'Centro Cultura \"Abismo del Gigante\"'),
(74, NULL, '2025-05-27 16:00:00', 37, 9, 'Calle de Instituto, 12'),
(75, 'Gabbro', '2025-05-27 14:40:55', 45, 9, 'C/ Inventada, Ressitance'),
(76, NULL, '2025-06-13 16:50:00', 72, 1, 'Calle del Rico, 13'),
(77, 'Héctor', '2025-05-27 13:15:58', 72, 1, 'Calle del Rico, 13'),
(78, 'Crkox', '2025-06-02 13:30:21', 33, 9, 'C/ Inventada, N7'),
(79, 'Gabbro', '2025-05-27 15:09:03', 37, 23, 'C/ Inventada, Ressitance'),
(80, 'Fedel-Rico', '2025-05-29 10:16:03', 33, 23, 'Calle de la Esperanza, 7'),
(81, 'Clarita', '2025-06-02 13:30:16', 33, 9, 'Calle de la Esperanza, 7'),
(82, NULL, '2025-05-27 15:30:00', 37, 9, 'Centro Cultural \"Espinoscuro\"'),
(85, NULL, '2025-05-28 10:55:00', 37, 23, 'Centro Cultural de Bargas'),
(87, NULL, '2025-06-02 16:45:00', 33, 10, 'Calle de la Esperanza, 7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(3) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `contraseña` varchar(150) NOT NULL,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user_name`, `email`, `contraseña`, `creacion`) VALUES
(22, 'pruebaHash', 'hash@email.com', '$2y$10$1pC9A67cN1DXFSgilBgm3OTqYX3gPQk136..IK6rltJkx.JUNl04i', '2025-03-29 20:14:14'),
(23, 'prueba', 'hash2@email.com', '$2y$10$rIPij1NlkAFAkLbbrLVUe.U9iQFCYZC2/EE76miT0yd1iirJP/16O', '2025-03-30 09:31:53'),
(33, 'Adrian', 'adriandt93@gmail.com', '$2y$10$Vs56SIaWKWRicy9RtVtzruU/dCiqa99RLOcsEEPxDi8sSbEOaHWQa', '2025-05-29 10:14:00'),
(34, 'pepe', 'p@email.com', '$2y$10$L6.2EyASQNoP0FXJrMMnbekIIH8zqP7s5Gg4xn5ehJoIzGphKQYNu', '2025-04-19 09:58:51'),
(35, 'roberto', 'rober@email.com', '$2y$10$cLX3XdzGbRNhRm6O2XUxxeuc7WELnPjnHmmx5vAPf56A77GIDbdiC', '2025-04-19 16:39:14'),
(36, 'Rubén', 'ruben@email.com', '$2y$10$YQkxhx1.8afRajrioEMkdOkO2KpMODzO6bZ8mCQ76tArDPg3IvYH.', '2025-04-21 08:47:35'),
(37, 'Héctor', 'hector@email.com', '$2y$10$E3/q6ix8s1dyqkd0NDURgOmNaUDrIWR0IW2oCyTaTdxcALTQGn21q', '2025-05-28 11:03:21'),
(38, 'Mario', 'mario@email.com', '$2y$10$w.0MXgNOVACZpE8oDweQHeGiELM1gEa5cm/yzfqMfQipQJ0xqxCHS', '2025-04-21 09:58:29'),
(43, 'prueba1', 'prueba1@email.com', '$2y$10$L5EMNRXWzN16q0jK/sNu0uMfSp1khJOFkVjPP53QAaOa9thPWMwDu', '2025-05-10 17:41:19'),
(44, 'Alberto', 'alberto@email.com', '$2y$10$e1QYnososrqd7S.9r4B.1eOrRqfGuLPEUKvXEUcNqy8VU2sY9iSmG', '2025-05-11 17:02:09'),
(45, 'Jaime78', 'jaime@email.com', '$2y$10$oof1/IEAgGT219JzIAoyx.hjdBr7ujitETlN5cK5jXRE0udOZBR..', '2025-05-13 16:53:31'),
(46, 'Clarita', 'clara@email.com', '$2y$10$4uodvZl1ukv65OaYW1hOL.jSEb2agdd9xrMJ0/iaaQg.ucRt8G.bm', '2025-05-18 17:19:04'),
(47, 'Riebeck', 'riebeck@email.com', '$2y$10$9d891M/rjoxstSadVuToSeb7/OkHJ4g83Q8v3Kb2x0CiXlvXIfjki', '2025-05-18 17:20:40'),
(48, 'Gabbro', 'gabbro@email.com', '$2y$10$YJrZmVC2h8UZ98yXoW7.Ae2Hippad/LF3szVKLAzk6cPK03.ukPPu', '2025-05-18 17:26:59'),
(49, 'Feldespato', 'feldespato@email.com', '$2y$10$5V.c9ZqGtvdnxJriHrQjge3t4IJfGgUZoJwAlGG3489jQLGIt/pf2', '2025-05-18 17:29:29'),
(56, 'Superrixi9', 'rixi@email.com', '$2y$10$RMuSam18IlmW0jWUIXxCmO1gYBykKow2ItFpaTCy.v5ACictHTWVu', '2025-05-26 13:16:07'),
(68, 'Pastra', 'pastrana@email.com', '$2y$10$0IfDKnGwBDyRaYYk9N7sJ.huS.dGH/dKfyQVyeINWblPzuzqI9FVu', '2025-05-19 20:29:34'),
(70, 'Crkox', 'koxi@email.com', '$2y$10$AOBHUrxE9inJ85C4fzMbg.eopI8/lZ6U7lx45O6UaxygaPjhAMQW2', '2025-05-19 20:30:27'),
(71, 'XavierX', 'xavi@email.com', '$2y$10$iN7gfbG9QdIHeGWV6KFDoefcs1GtmTSFOFy66fAnQceSSLygZU.gW', '2025-05-22 16:10:46'),
(72, 'Fedel-Rico', 'federico@email.com', '$2y$10$jj3eWvd.M3V37E2aJGLC7eeV8Dybo3efrfvRfMrHUuuPWFjFyNqCW', '2025-05-26 14:46:59');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participacion` (`participacion`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `participaciones`
--
ALTER TABLE `participaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partida` (`id_partida`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creador` (`id_creador`,`id_juego`),
  ADD KEY `juego` (`id_juego`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `participaciones`
--
ALTER TABLE `participaciones`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=440;

--
-- AUTO_INCREMENT de la tabla `partidas`
--
ALTER TABLE `partidas`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`participacion`) REFERENCES `participaciones` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `participaciones`
--
ALTER TABLE `participaciones`
  ADD CONSTRAINT `participaciones_ibfk_2` FOREIGN KEY (`id_partida`) REFERENCES `partidas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participaciones_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD CONSTRAINT `partidas_ibfk_2` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id`),
  ADD CONSTRAINT `partidas_ibfk_3` FOREIGN KEY (`id_creador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
