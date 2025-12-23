-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2025 a las 10:48:03
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
-- Base de datos: `lpg_08_26-6`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bandas`
--

CREATE TABLE `bandas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `integrantes` varchar(256) DEFAULT NULL,
  `pais` varchar(256) NOT NULL,
  `anio_de_formacion` year(4) NOT NULL,
  `imagen_banda` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bandas`
--

INSERT INTO `bandas` (`id`, `nombre`, `integrantes`, `pais`, `anio_de_formacion`, `imagen_banda`) VALUES
(1, 'Red Hot Chili Peppers', 'John Frusciante, Flea, Anthony Kiedies y Chad Smith', 'Estados Unidos, California', '1983', '1750915058.webp'),
(2, 'Foo Fighters', 'Dave Grohl, Nate Mendel, Pat Smear, Chris Shinflett, Rami Jaffee', 'Seattle, Whashington, Estados Unidos', '1994', '1750905528.webp'),
(3, 'Michael Jackson', '', 'Indiana, Estados Unidos', '1964', '1750905537.webp'),
(4, 'Miles Davis', '', 'Alton, Estados Unidos', '1944', '1750905547.webp'),
(5, 'Funkadelic', 'George Clinton, Michael Payne, Michael Hampton, Lige Curry, Bennie Cowan, Greg Thomas, Shaunna Hall, Traford Clinton, Benzel Cowan y Garrett Shider.', 'Nueva Jersey, Estados Unidos', '1968', '1750914472.webp'),
(6, 'Acdc', 'Brian Johnson, Angus Young, Malcolm Young, Cliff Williams y Phil Rudd.', 'Sidney, Australia ', '1973', '1750905557.webp'),
(45, 'asd', '', 'asd', '2000', '1766013662.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `importe` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `cantidad_descuento` tinyint(4) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `finalizacion` date NOT NULL,
  `evento` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` (`id`, `cantidad_descuento`, `fecha_inicio`, `finalizacion`, `evento`) VALUES
(1, 20, '2025-06-19', '2025-07-16', 'Otoño 25'),
(2, 10, '2025-06-19', '2025-06-30', 'Otoño 10'),
(3, 50, '2025-06-13', '2025-07-21', 'Semana de la música 50'),
(17, 80, '2025-07-14', '2025-07-18', 'Vacaciones de Invierno 80');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discos`
--

CREATE TABLE `discos` (
  `id` int(10) UNSIGNED NOT NULL,
  `banda_id` int(10) UNSIGNED NOT NULL,
  `descuento_id` int(10) UNSIGNED DEFAULT NULL,
  `titulo` varchar(256) NOT NULL,
  `cantidad_canciones` tinyint(4) NOT NULL,
  `duracion` time NOT NULL,
  `anio_de_lanzamiento` year(4) NOT NULL,
  `imagen_portada` varchar(256) NOT NULL,
  `imagen_vinilo` varchar(256) NOT NULL,
  `condicion` char(5) NOT NULL,
  `estado` varchar(256) NOT NULL,
  `rating` varchar(256) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `stock` tinyint(11) NOT NULL,
  `unidades` int(11) NOT NULL,
  `destacado` tinyint(4) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `discos`
--

INSERT INTO `discos` (`id`, `banda_id`, `descuento_id`, `titulo`, `cantidad_canciones`, `duracion`, `anio_de_lanzamiento`, `imagen_portada`, `imagen_vinilo`, `condicion`, `estado`, `rating`, `precio`, `stock`, `unidades`, `destacado`, `descripcion`) VALUES
(1, 3, NULL, 'Bad', 10, '00:48:34', '1987', 'bad_portada.webp', 'vinilo_default.webp', 'nuevo', 'Excelente', '3.70 / 5.0', 125519.99, 1, 3, 1, 'Bad es el séptimo álbum de estudio de Michael Jackson, lanzado el 31 de agosto de 1987. Producido por Quincy Jones y Michael Jackson, combina géneros como pop, R&B, funk y rock.'),
(2, 3, 1, 'Thriller', 9, '00:42:16', '1982', 'thriller_portada.webp', 'vinilo_default.webp', 'nuevo', 'Detalles Estéticos', '4.02 / 5.0', 142229.99, 1, 7, 0, 'Thriller es el sexto álbum de estudio de Michael Jackson, lanzado el 29 de noviembre de 1982. Producido por Quincy Jones, combina géneros como disco, rock, funk y pop.'),
(3, 3, NULL, 'HIStory', 30, '02:28:00', '1995', 'history_portada.webp', 'vinilo_default.webp', 'nuevo', 'Excelente', '3.44 / 5.0', 215019.99, 1, 3, 0, 'HIStory: Past, Present and Future, Book I es el noveno álbum de estudio de Michael Jackson, lanzado en 1995. Este álbum es una obra personal y potente que aborda temas como la paranoia, la injusticia y las acusaciones que enfrentó en ese momento.'),
(4, 4, 2, 'Kind of blue', 5, '00:45:44', '1959', 'kind_portada.webp', 'vinilo_default.webp', 'usado', 'Detalles Estéticos', '4.24 / 5.0', 112599.99, 1, 8, 0, 'Kind of Blue (1959) de Miles Davis es considerado una obra maestra del jazz y uno de los discos más influyentes de la historia de la música. Grabado en solo dos sesiones, introdujo el jazz modal, un enfoque innovador que prioriza la improvisación sobre estructuras armónicas simples.'),
(5, 4, NULL, 'In a silent way', 2, '00:38:08', '1969', 'silent_portada.webp', 'vinilo_default.webp', 'usado', 'Buena Condición', '4.23 / 5.0', 89999.99, 1, 5, 0, 'In A Silent Way es un álbum de jazz fusión lanzado en 1969, que marca un punto de inflexión en la carrera de Davis hacia sonidos más eléctricos. Este disco es conocido por su innovadora mezcla de jazz y rock, así como por su enfoque minimalista y experimental, que influyó profundamente en el género.'),
(6, 4, 3, 'Bitches Brew', 6, '01:45:00', '1970', 'bitches_portada.webp', 'vinilo_default.webp', 'usado', 'Regular', '4.19 / 5.0', 129999.99, 1, 7, 1, 'Bitches Brew es un álbum revolucionario de Miles Davis, lanzado en 1970, que fusiona jazz y rock. Grabado en improvisaciones intensas, el disco es conocido por su estructura experimental y su uso extensivo de instrumentos eléctricos, marcando el nacimiento del jazz-rock.\r\n'),
(7, 5, NULL, 'Funkadelic', 4, '00:47:24', '1970', 'funkadelic_portada.webp', 'vinilo_default.webp', 'nuevo', 'Excelente', '3.97 / 5.0', 75999.99, 1, 6, 0, 'Funkadelic es el álbum debut de la banda homónima, lanzado en 1970. Este disco marca un punto de inflexión en la fusión de rock psicodélico, soul y funk, influenciado por bandas como Jimi Hendrix y Sly Stone.\r\n'),
(8, 5, NULL, 'Maggot Brain', 10, '00:36:13', '1971', '1750914702.webp', 'vinilo_default.webp', 'nuevo', 'Excelente', '3.99 / 5.0', 185999.99, 1, 2, 0, 'Maggot Brain es el tercer álbum de estudio de Funkadelic, lanzado en 1971. Un clásico del funk psicodélico que fusiona géneros como el soul, rock y blues. Destaca por un solo de guitarra de 10 minutos, conocido por su intensidad emocional y técnica virtuosa.\r\n'),
(9, 5, 2, 'One Nation Under A Groove', 8, '00:41:27', '1978', 'nation_portada.webp', 'vinilo_default.webp', 'usado', 'Excelente', '3.86 / 5.0', 232145.99, 1, 8, 0, 'Este álbum fue el más exitoso comercialmente de la banda, alcanzando el número 1 en las listas de R&B/Hip-Hop de Billboard y siendo certificado platino en EE.UU. Combina elementos de funk, rock progresivo y soul, destacándose por su energía y ritmo contagioso.\r\n'),
(10, 1, 2, 'Stadium Arcadium', 14, '00:02:02', '2006', 'stadium-arcadium_portada.webp', 'vinilo_default.webp', 'nuevo', 'Excelente', '3.75 / 5.0', 247999.99, 1, 7, 1, 'Este álbum fue un éxito tanto comercial como crítico, debutando en el número 1 del Billboard 200 y ganando múltiples premios Grammy. Combina una ambiciosa mezcla de funk, rock alternativo y psicodelia, mostrando a la banda en su punto más melódico y expansivo. Con una producción pulida y variedad estilística, se destaca por su riqueza sonora y la química consolidada entre sus integrantes.\r\n'),
(11, 1, NULL, 'Californication (DE)', 18, '00:01:07', '1999', 'californication_portada.webp', 'vinilo_default.webp', 'nuevo', 'Excelente', '4.0 / 5.0', 99999.99, 1, 6, 0, 'Este álbum marcó el regreso de John Frusciante a la banda y revitalizó su sonido, alcanzando el número 3 en el Billboard 200 y siendo certificado multiplatino en varios países. Combina rock alternativo, funk y elementos melódicos con letras introspectivas y cinematográficas. Se destaca por su atmósfera más sobria y emocional, reflejando una etapa de madurez artística en la historia del grupo.\r\n'),
(12, 1, NULL, 'Unlimited Love', 17, '00:01:13', '2022', 'unlimited-love_portada.webp', 'vinilo_default.webp', 'nuevo', 'Excelente', '3.55 / 5.0', 86999.99, 1, 3, 0, 'Este álbum significó el esperado regreso de John Frusciante tras más de una década, y debutó en el número 1 en varios países, incluyendo EE.UU. y el Reino Unido. Combina el funk característico de la banda con un enfoque más melódico y reflexivo, destacándose por su producción cuidada y su equilibrio entre energía y sensibilidad emocional.\r\n'),
(13, 6, NULL, 'Back in Black', 10, '00:42:00', '1980', 'back-in-black_portada.webp', 'vinilo_default.webp', 'nuevo', 'Excelente', '4.15 / 5.0', 111999.99, 1, 9, 0, 'Este álbum marcó el regreso triunfal de AC/DC tras la muerte de su vocalista Bon Scott, con Brian Johnson tomando el relevo. Fue un éxito rotundo a nivel mundial, convirtiéndose en uno de los discos más vendidos de todos los tiempos. Combina riffs potentes, letras directas y una producción impecable, consolidando el sonido crudo y electrizante de la banda.\r\n'),
(14, 6, NULL, 'Highway to Hell', 10, '00:41:00', '1979', 'highway-to-hell_portada.webp', 'vinilo_default.webp', 'usado', 'Muy Bueno', '4.20 / 5.0', 149999.99, 1, 8, 0, 'Este álbum fue el último que contó con la voz de Bon Scott y catapultó a AC/DC al estrellato internacional. Alcanzó altas posiciones en las listas globales y es considerado un clásico del hard rock. Con una producción más pulida y canciones emblemáticas, combina actitud rebelde, riffs icónicos y una energía arrolladora.\r\n'),
(15, 6, NULL, 'The Razors Edge', 12, '00:46:00', '1990', 'the-razors-edge_portada.webp', 'vinilo_default.webp', 'usado', 'Excelente', '3.6 / 5.0', 110199.99, 1, 8, 0, 'Este álbum marcó el resurgimiento comercial de AC/DC en los años 90, impulsado por el éxito masivo del sencillo “Thunderstruck”. Alcanzó los primeros puestos en varias listas internacionales y fue certificado multi-platino. Con un sonido más moderno pero fiel a sus raíces, destaca por su potencia, riffs contundentes y una producción más pulida.\r\n'),
(16, 2, NULL, 'The Colour and the Shape', 13, '00:01:02', '1997', 'the-colour-and-the-shape_portada.webp', 'vinilo_default.webp', 'usado', 'Muy Bueno', '3.75 / 5.0', 109999.99, 1, 7, 0, 'Este álbum consolidó a Foo Fighters como una de las bandas más importantes del rock alternativo de los 90. Alcanzó gran éxito comercial y de crítica, con sencillos como “Everlong” y “My Hero”. Mezcla intensidad emocional con potentes guitarras y una producción cuidada, destacándose por su dinamismo y profundidad lírica.\r\n'),
(17, 2, NULL, 'Wasting Light', 11, '00:47:00', '2011', 'wasting-light_portada.webp', 'vinilo_default.webp', 'nuevo', 'Excelente', '4.15 / 5.0', 123399.99, 1, 5, 0, 'Este álbum de Foo Fighters marcó un regreso a un sonido más crudo y directo, grabado completamente en analógico. Fue muy aclamado por la crítica y logró gran éxito comercial, con sencillos como “Rope” y “Walk”. Su enfoque en la energía del garage rock y el grunge de los 90, junto con una producción más orgánica, lo convirtió en uno de los discos más destacados de la banda.\r\n'),
(18, 2, 3, 'Concrete and Gold', 11, '00:48:00', '2017', '1750914693.webp', 'vinilo_default.webp', 'nuevo', 'Excelente', '3.95 / 5.0', 89999.99, 1, 3, 0, 'Este álbum de Foo Fighters combina su característico rock con influencias más eclécticas, incorporando elementos de música electrónica, pop y hasta orquestaciones. Producido por Greg Kurstin, conocido por su trabajo con artistas como Adele, Concrete and Gold es un álbum expansivo que fusiona su estilo habitual con una producción más pulida y accesible. Sencillos como The Sky Is a Neighborhood y Run destacan por su energía y complejidad sonora, llevando la banda a nuevos horizontes musicales.'),
(59, 45, NULL, '1995', 127, '22:22:22', '1995', '1766013723.webp', 'vinilo_default.webp', 'nuevo', 'Excelente', '2.00 / 5.00', 1995.00, 1, 1995, 0, '1995'),
(61, 45, NULL, 'test', 12, '04:52:43', '1995', '1766044407.webp', 'vinilo_default.webp', 'nuevo', 'Excelente', '4.00 / 5.00', 12.99, 1, 1995, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discos_x_generos`
--

CREATE TABLE `discos_x_generos` (
  `id` int(10) UNSIGNED NOT NULL,
  `discos_id` int(10) UNSIGNED NOT NULL,
  `generos_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `discos_x_generos`
--

INSERT INTO `discos_x_generos` (`id`, `discos_id`, `generos_id`) VALUES
(10, 3, 2),
(11, 3, 4),
(12, 3, 3),
(13, 3, 1),
(14, 4, 4),
(15, 4, 13),
(16, 4, 12),
(19, 5, 16),
(20, 5, 17),
(21, 6, 17),
(22, 6, 16),
(23, 6, 9),
(24, 7, 3),
(25, 7, 7),
(26, 7, 9),
(27, 7, 12),
(30, 9, 13),
(31, 9, 3),
(32, 9, 7),
(58, 13, 1),
(59, 13, 8),
(60, 14, 1),
(61, 14, 8),
(64, 16, 1),
(65, 16, 5),
(66, 16, 8),
(67, 16, 10),
(68, 16, 11),
(87, 12, 1),
(89, 8, 3),
(95, 17, 1),
(193, 18, 1),
(194, 18, 8),
(195, 18, 9),
(196, 18, 16),
(269, 10, 1),
(270, 10, 3),
(271, 10, 5),
(272, 10, 6),
(273, 10, 7),
(274, 10, 9),
(275, 11, 1),
(276, 11, 3),
(277, 11, 7),
(278, 11, 9),
(288, 1, 1),
(306, 2, 1),
(307, 2, 2),
(308, 2, 3),
(309, 2, 4),
(310, 2, 12),
(313, 15, 1),
(314, 15, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_genero` varchar(256) NOT NULL,
  `historia` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `nombre_genero`, `historia`) VALUES
(1, 'Rock', 'El rock surgió a mediados del siglo XX en Estados Unidos, como una fusión entre géneros como el blues, el country y el rhythm and blues. Con el tiempo, se convirtió en una expresión cultural poderosa, especialmente durante los años 60 y 70, cuando bandas como The Beatles, The Rolling Stones y Led Zeppelin marcaron una revolución musical y social. El género fue evolucionando con distintas corrientes como el punk, el hard rock y el grunge, reflejando siempre los cambios generacionales. Más que un estilo musical, el rock ha sido una voz de rebeldía, identidad y transformación cultural a lo largo de las décadas.'),
(2, 'Pop', 'El pop, abreviatura de “popular”, nació en la década de 1950 como una evolución de la música popular accesible y comercialmente orientada, influenciada por el rock and roll, el rhythm and blues y la música vocal. A diferencia del rock, el pop buscaba melodías pegadizas, estribillos repetitivos y una producción más pulida. Con artistas como The Beatles, Michael Jackson y Madonna, el género fue ganando fuerza global, adaptándose constantemente a nuevas tecnologías y estilos. Hoy en día, el pop sigue siendo uno de los géneros más influyentes, mezclándose con electrónica, hip hop y otros estilos contemporáneos para mantenerse vigente y dominante en las listas de éxitos.'),
(3, 'Funk', 'El funk surgió en la década de 1960 en Estados Unidos como un estilo musical que combina elementos del soul, el jazz y el rhythm and blues, con un énfasis especial en el ritmo y el groove. Caracterizado por líneas de bajo potentes, ritmos sincopados y secciones de metales vibrantes, el funk se convirtió en una expresión vibrante y enérgica de la cultura afroamericana. Artistas como James Brown, Sly and the Family Stone y Parliament-Funkadelic fueron pioneros en popularizar este género. El funk influyó profundamente en otros estilos como el hip hop, el disco y el pop, y sigue siendo una base fundamental para muchos músicos contemporáneos que buscan ritmos bailables y contagiosos.'),
(4, 'Blues', 'El blues es un género musical que nació a finales del siglo XIX y principios del XX en el sur de Estados Unidos, especialmente en comunidades afroamericanas. Surgió como una expresión emocional que reflejaba las dificultades, el sufrimiento y la esperanza de la vida cotidiana, combinando raíces africanas con influencias de la música folclórica y espiritual. Caracterizado por su estructura de doce compases y un patrón melódico distintivo, el blues fue la base para el desarrollo de muchos otros géneros, como el jazz, el rock and roll y el rhythm and blues. Artistas icónicos como B.B. King, Muddy Waters y Robert Johnson llevaron el blues a la fama mundial, convirtiéndolo en un pilar fundamental de la música popular.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(5, 'Rock alternativo', 'El rock alternativo surgió en la década de 1980 como una respuesta a las corrientes comerciales del rock tradicional y el pop dominante en la radio. Nacido en la escena underground, este género abarca una gran variedad de estilos y sonidos que comparten un enfoque más experimental, introspectivo y a menudo más crudo. Bandas como R.E.M., The Pixies y Sonic Youth fueron pioneras en popularizar el rock alternativo, abriendo el camino para su explosión comercial en los años 90 con grupos como Nirvana, Radiohead y Pearl Jam. Este género se caracterizó por letras profundas, guitarras distorsionadas y un espíritu independiente que desafió las normas de la industria musical, consolidándose como una voz importante para las nuevas generaciones.'),
(6, 'Pop Rock', 'El pop rock es un género musical que combina la melodía pegadiza y accesible del pop con la energía y los instrumentos del rock. Surgió en la década de 1960 cuando artistas y bandas comenzaron a mezclar elementos de ambos estilos para crear canciones que fueran tanto comerciales como con un toque de rebeldía y ritmo. Bandas como The Beatles y The Rolling Stones fueron fundamentales en popularizar este estilo, que ha evolucionado con el tiempo incorporando influencias de distintos subgéneros. El pop rock ha logrado mantenerse vigente gracias a su equilibrio entre letras fáciles de recordar, melodías atractivas y arreglos musicales enérgicos, convirtiéndose en uno de los estilos más populares y duraderos en la historia de la música moderna.'),
(7, 'Funk Rock', 'El funk rock es un género que fusiona la energía rítmica y sincopada del funk con la potencia y actitud del rock. Surgió a finales de los años 60 y se popularizó en los 70 y 80 con bandas como Red Hot Chili Peppers, Living Colour y Prince, que combinaron grooves contagiosos, líneas de bajo prominentes y riffs de guitarra eléctricos. Este estilo se caracteriza por su ritmo pegajoso y su énfasis en la improvisación y la expresión musical, integrando elementos del funk, el rock y, a veces, el punk y el hip hop. El funk rock ha influido en muchos otros géneros y sigue siendo una fuente de inspiración para músicos que buscan un sonido dinámico y bailable con la fuerza del rock.'),
(8, 'Hard Rock', 'El hard rock surgió a finales de los años 60 como una evolución más intensa y poderosa del rock clásico, caracterizado por guitarras eléctricas distorsionadas, ritmos contundentes y voces potentes. Bandas como Led Zeppelin, Deep Purple y The Who fueron pioneras en este estilo, que combinaba la agresividad del blues rock con una energía más cruda y explosiva. El hard rock se convirtió en un símbolo de la rebeldía juvenil y tuvo un gran impacto en la cultura musical de las décadas siguientes, dando paso a subgéneros como el heavy metal. Su influencia perdura hasta hoy, siendo la base para muchos grupos contemporáneos que buscan un sonido fuerte y enérgico.'),
(9, 'Rock Psicodélico', 'El rock psicodélico surgió a mediados de los años 60 como parte del movimiento contracultural que buscaba experimentar con nuevos sonidos y estados de conciencia, influenciado por el uso de drogas psicodélicas como el LSD. Este género se caracteriza por sus largas improvisaciones, efectos sonoros innovadores, letras surrealistas y una atmósfera experimental que busca reflejar experiencias sensoriales intensas. Bandas como The Doors, Pink Floyd, Jefferson Airplane y The Jimi Hendrix Experience fueron pioneras en desarrollar este estilo, que mezclaba el rock con el blues, el folk y la música electrónica. El rock psicodélico tuvo una gran influencia en la música posterior, abriendo camino para géneros como el rock progresivo y el rock alternativo.'),
(10, 'Post-grunge', 'El post-grunge surgió a mediados y finales de los años 90 como una evolución del grunge, buscando mantener la esencia del sonido áspero y emocional, pero con una producción más pulida y orientada al mercado masivo. Este género conservó las guitarras distorsionadas y las letras introspectivas del grunge, pero añadió melodías más accesibles y estructuras de canción más convencionales. Bandas como Foo Fighters, Creed y Nickelback fueron algunas de las más representativas del post-grunge, logrando gran éxito comercial durante finales de los 90 y principios de los 2000. Aunque criticado por algunos puristas, el post-grunge consolidó un estilo que llevó la influencia del grunge a una audiencia más amplia y diversa.'),
(11, 'Grunge', 'El grunge surgió a finales de los años 80 y principios de los 90 en Seattle, Estados Unidos, como una mezcla de punk rock y heavy metal con un sonido crudo, distorsionado y emocionalmente intenso. Este género se caracterizó por sus letras introspectivas y a menudo oscuras, que expresaban sentimientos de alienación, frustración y descontento social. Bandas como Nirvana, Pearl Jam, Soundgarden y Alice in Chains fueron las principales exponentes del grunge, que rápidamente ganó popularidad y definió la música alternativa de la década. El grunge no solo impactó la música, sino también la moda y la cultura juvenil, convirtiéndose en un símbolo de la generación X.'),
(12, 'Soul', 'El soul es un género musical que surgió en Estados Unidos durante la década de 1950 y 1960, combinando elementos del gospel, el rhythm and blues y el jazz. Se caracteriza por su fuerte emotividad, voces apasionadas y letras que a menudo expresan sentimientos profundos y experiencias personales. El soul tuvo un papel fundamental en la historia de la música popular, influyendo en muchos otros géneros como el funk, el R&B moderno y el pop. Artistas legendarios como Aretha Franklin, Otis Redding y James Brown ayudaron a definir y popularizar este estilo, que sigue siendo una fuente de inspiración para músicos y oyentes en todo el mundo.'),
(13, 'Bebop', 'El bebop es un estilo de jazz que surgió a principios de la década de 1940 como una reacción al jazz más comercial y orientado al baile de la época. Se caracteriza por tempos rápidos, improvisaciones complejas, armonías sofisticadas y ritmos irregulares. A diferencia del swing, el bebop pone un fuerte énfasis en la virtuosidad técnica y la creatividad individual de los músicos. Pioneros como Charlie Parker, Dizzy Gillespie y Thelonious Monk fueron fundamentales en el desarrollo del bebop, que sentó las bases para muchos estilos modernos del jazz. Este género transformó el jazz en una forma de arte más intelectual y expresiva.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(14, 'New Wave', 'New wave es un término global para varios estilos pop rock de fines de la década de 1970 y mediados de la década de 1980, además de ser un estilo musical con vínculos con el punk y ciertos géneros del rock de los años 1970.​'),
(16, 'Jazz Fusión', 'El jazz fusión es un género musical que surgió a finales de la década de 1960 en Estados Unidos, combinando elementos del jazz con otros estilos como el rock, el funk, el rhythm and blues y la música clásica. Esta fusión se caracteriza por la incorporación de instrumentos eléctricos, ritmos más marcados y la experimentación con nuevas texturas sonoras.'),
(17, 'Jazz', 'El jazz es un género musical que nació a finales del siglo XIX y principios del XX en las comunidades afroamericanas de Nueva Orleans. Se desarrolló a partir de la fusión de diversas tradiciones musicales, como el blues, el ragtime, la música de banda militar y la música europea, entre otras.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_x_compra`
--

CREATE TABLE `items_x_compra` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `compra_id` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(256) NOT NULL,
  `usuario` varchar(256) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `nombre_completo` varchar(256) NOT NULL,
  `contrasenia` varchar(256) NOT NULL,
  `rol` enum('Admin','Superadmin','Usuario','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `usuario`, `nombre_completo`, `contrasenia`, `rol`) VALUES
(1, 'gustavo.gamero@davinci.edu.ar', 'gustavo94', 'Gustavo Gamero', '$2y$10$LpauUyBJsyJYdIrkJSHy6e6Gzen0VvEH5tkcb5HjYIvEI0/6/Pyuq', 'Superadmin'),
(5, 'email_de@ejemplo', 'Coraline', 'Coraline Coraline', '$2y$10$O6FEbm0j12lsmaXvJCN7guWkQ2c9uOtOBCapTNZQbxEhOz3gt3SU2', 'Usuario'),
(6, 'facundo.gamero@davinci.edu.ar', 'FAQundo', 'Facundo Gamero', '$2y$10$4ZEOYTQ/b0Yh87ZFWtXYl.Na1Y26W6ghjlW1vYMXFekpfgMbI3Ove', 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vistas`
--

CREATE TABLE `vistas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `titulo` varchar(256) NOT NULL,
  `activa` tinyint(4) NOT NULL,
  `restringida` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vistas`
--

INSERT INTO `vistas` (`id`, `nombre`, `titulo`, `activa`, `restringida`) VALUES
(1, 'home', 'Bienvenidos', 1, 0),
(2, 'catalogo', 'Nuestro catálogo', 1, 0),
(3, 'contacto', 'Contacto', 1, 0),
(4, 'catalogo_banda', 'Catálogo de la banda', 1, 0),
(5, 'detalle_producto', 'Detalles del disco', 1, 0),
(6, 'catalogo_fecha', 'Filtrado por fecha', 1, 0),
(7, 'catalogo_condicion', 'Filtrado por condición', 1, 0),
(8, 'integrantes', 'Integrantes del parcial', 1, 0),
(9, 'adm_bandas', 'Administrador de bandas', 1, 2),
(10, 'adm_descuentos', 'Administrador de descuentos', 1, 2),
(11, 'adm_generos', 'Administrador de géneros', 1, 2),
(12, 'agregar_banda', 'Agregar banda', 1, 2),
(13, 'agregar_descuento', 'Agregar descuento', 1, 2),
(14, 'agregar_genero', 'Agregar género', 1, 2),
(15, 'editar_banda', 'Editar banda', 1, 2),
(16, 'editar_descuento', 'Editar descuento', 1, 2),
(17, 'editar_genero', 'Editar género', 1, 2),
(18, 'eliminar_banda', 'Eliminar banda', 1, 2),
(19, 'eliminar_descuento', 'Eliminar descuento', 1, 2),
(20, 'eliminar_genero', 'Eliminar género', 1, 2),
(21, 'adm_discos', 'Administración de discos', 1, 2),
(22, 'agregar_disco', 'Agregar disco', 1, 2),
(23, 'editar_disco', 'Edición de disco', 1, 2),
(24, 'eliminar_disco', 'Eliminación de disco', 1, 2),
(25, 'adm_home', 'administrador', 1, 2),
(26, 'login', 'Iniciar sesión', 1, 0),
(28, 'respuesta_form', 'Respuesta a Consulta', 1, 0),
(29, 'errores', 'Errores', 1, 2),
(30, 'carrito', 'Carrito', 1, 0),
(31, 'finalizar_pago', 'Finalizar pago', 1, 1),
(32, 'panel_usuario', 'Panel de Usuario', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bandas`
--
ALTER TABLE `bandas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `discos`
--
ALTER TABLE `discos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banda_id` (`banda_id`),
  ADD KEY `descuentops_id` (`descuento_id`);

--
-- Indices de la tabla `discos_x_generos`
--
ALTER TABLE `discos_x_generos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discos_id` (`discos_id`),
  ADD KEY `generos_id` (`generos_id`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `items_x_compra`
--
ALTER TABLE `items_x_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `compra_id` (`compra_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vistas`
--
ALTER TABLE `vistas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bandas`
--
ALTER TABLE `bandas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `discos`
--
ALTER TABLE `discos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `discos_x_generos`
--
ALTER TABLE `discos_x_generos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `items_x_compra`
--
ALTER TABLE `items_x_compra`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vistas`
--
ALTER TABLE `vistas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `discos`
--
ALTER TABLE `discos`
  ADD CONSTRAINT `discos_ibfk_1` FOREIGN KEY (`banda_id`) REFERENCES `bandas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `discos_ibfk_3` FOREIGN KEY (`descuento_id`) REFERENCES `descuentos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `discos_x_generos`
--
ALTER TABLE `discos_x_generos`
  ADD CONSTRAINT `discos_x_generos_ibfk_1` FOREIGN KEY (`generos_id`) REFERENCES `generos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `discos_x_generos_ibfk_2` FOREIGN KEY (`discos_id`) REFERENCES `discos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `items_x_compra`
--
ALTER TABLE `items_x_compra`
  ADD CONSTRAINT `items_x_compra_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `discos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `items_x_compra_ibfk_2` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
