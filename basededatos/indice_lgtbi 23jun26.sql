-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2026 a las 22:13:40
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
-- Base de datos: `indice_lgtbi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id_auditoria` bigint(20) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `accion` varchar(200) NOT NULL,
  `tabla_afectada` varchar(100) DEFAULT NULL,
  `registro_id` bigint(20) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `nombre`) VALUES
(1, 'Atlántida'),
(2, 'Colón'),
(3, 'Comayagua'),
(4, 'Copán'),
(5, 'Cortés'),
(6, 'Choluteca'),
(7, 'El Paraíso'),
(8, 'Francisco Morazán'),
(9, 'Gracias a Dios'),
(10, 'Intibucá'),
(11, 'Islas de la Bahía'),
(12, 'La Paz'),
(13, 'Lempira'),
(14, 'Ocotepeque'),
(15, 'Olancho'),
(16, 'Santa Bárbara'),
(17, 'Valle'),
(18, 'Yoro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_encuesta`
--

CREATE TABLE `detalle_encuesta` (
  `id_detalle` bigint(20) NOT NULL,
  `id_encuesta` bigint(20) NOT NULL,
  `id_pregunta` bigint(20) NOT NULL,
  `valor` longtext DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encabezado_encuesta`
--

CREATE TABLE `encabezado_encuesta` (
  `id_encuesta` bigint(20) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_organizacion` int(11) NOT NULL,
  `anio` smallint(6) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `estado` enum('BORRADOR','FINALIZADA','ANULADA') DEFAULT 'FINALIZADA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `id_encuesta` bigint(20) NOT NULL,
  `codigo` varchar(30) DEFAULT NULL,
  `id_formulario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'BORRADOR',
  `departamento` varchar(100) DEFAULT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formularios`
--

CREATE TABLE `formularios` (
  `id_formulario` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `version` varchar(20) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `formularios`
--

INSERT INTO `formularios` (`id_formulario`, `nombre`, `descripcion`, `version`, `activo`, `fecha_creacion`) VALUES
(1, 'Encuesta Índice de Inclusión LGTBI+', 'Instrumento de recolección de datos', '1.0', 1, '2026-06-19 14:22:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id_municipio` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones_pregunta`
--

CREATE TABLE `opciones_pregunta` (
  `id_opcion` bigint(20) NOT NULL,
  `id_pregunta` bigint(20) NOT NULL,
  `valor` varchar(100) DEFAULT NULL,
  `etiqueta` varchar(255) DEFAULT NULL,
  `orden` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `opciones_pregunta`
--

INSERT INTO `opciones_pregunta` (`id_opcion`, `id_pregunta`, `valor`, `etiqueta`, `orden`) VALUES
(14, 78, 'M', 'Masculino', 1),
(15, 78, 'F', 'Femenino', 2),
(16, 78, 'I', 'Intersexual', 3),
(17, 78, 'NS', 'No sabe', 4),
(18, 78, 'NR', 'No quiere responder', 5),
(19, 78, 'NA', 'No aplica', 6),
(20, 76, 'Sí', 'Sí', 1),
(21, 76, 'No', 'No', 2),
(22, 80, 'Asexual', 'Asexual', 1),
(23, 80, 'Bisexual', 'Bisexual', 2),
(24, 80, 'Gay', 'Gay', 3),
(25, 80, 'Heterosexual', 'Heterosexual', 4),
(26, 80, 'Lesbiana', 'Lesbiana', 5),
(27, 80, 'Otro', 'Otro', 6),
(28, 80, 'Pansexual', 'Pansexual', 7),
(29, 81, 'Hombre Cis', 'Hombre Cis', 1),
(30, 81, 'Hombre trans', 'Hombre trans', 2),
(31, 81, 'Mujer Cis', 'Mujer Cis', 3),
(32, 81, 'Mujer trans', 'Mujer trans', 4),
(33, 81, 'No binario', 'No binario', 5),
(34, 81, 'Otro', 'Otro', 6),
(35, 81, 'Queer', 'Queer', 7),
(36, 81, 'Se desconoce', 'Se desconoce', 8),
(37, 82, 'Atlántida', 'Atlántida', 1),
(38, 82, 'Choluteca', 'Choluteca', 2),
(39, 82, 'Colón', 'Colón', 3),
(40, 82, 'Comayagua', 'Comayagua', 4),
(41, 82, 'Copán', 'Copán', 5),
(42, 82, 'Cortés', 'Cortés', 6),
(43, 82, 'El Paraíso', 'El Paraíso', 7),
(44, 82, 'Francisco Morazán', 'Francisco Morazán', 8),
(45, 82, 'Gracias a Dios', 'Gracias a Dios', 9),
(46, 82, 'Intibucá', 'Intibucá', 10),
(47, 82, 'Islas de la Bahía', 'Islas de la Bahía', 11),
(48, 82, 'La Paz', 'La Paz', 12),
(49, 82, 'Lempira', 'Lempira', 13),
(50, 82, 'Ocotepeque', 'Ocotepeque', 14),
(51, 82, 'Olancho', 'Olancho', 15),
(52, 82, 'Santa Bárbara', 'Santa Bárbara', 16),
(53, 82, 'Valle', 'Valle', 17),
(54, 82, 'Yoro', 'Yoro', 18),
(55, 99, 'Sí', 'Sí', 1),
(56, 99, 'No', 'No', 2),
(57, 83, 'Pos-Grado', 'Pos-Grado', 1),
(58, 83, 'Primaria', 'Primaria', 2),
(59, 83, 'Secudaria', 'Secudaria', 3),
(60, 83, 'Superior (universitaria)', 'Superior (universitaria)', 4),
(61, 84, 'Sí', 'Sí', 1),
(62, 84, 'No', 'No', 2),
(63, 85, 'Formal', 'Formal', 1),
(64, 85, 'Ambos', 'Ambos', 2),
(65, 85, 'No Formal', 'No Formal', 3),
(66, 88, 'Sí', 'Sí', 1),
(67, 88, 'No', 'No', 2),
(68, 90, 'Acoso sexual', 'Acoso sexual', 1),
(69, 90, 'Bullying', 'Bullying', 2),
(70, 90, 'Comentarios LGTBIfóbicos', 'Comentarios LGTBIfóbicos', 3),
(71, 90, 'Discriminación', 'Discriminación', 4),
(72, 90, 'Exclusión', 'Exclusión', 5),
(73, 90, 'Irrespeto a la identidad de género', 'Irrespeto a la identidad de género', 6),
(74, 90, 'Otros', 'Otros', 7),
(75, 90, 'Violencia física', 'Violencia física', 8),
(76, 91, 'Sí', 'Sí', 1),
(77, 91, 'No', 'No', 2),
(78, 92, 'Acuerdo o conciliación', 'Acuerdo o conciliación', 1),
(79, 92, 'Denuncia sin resultado', 'Denuncia sin resultado', 2),
(80, 92, 'Denuncia validada', 'Denuncia validada', 3),
(81, 92, 'En proceso', 'En proceso', 4),
(82, 92, 'Medidas de protección', 'Medidas de protección', 5),
(83, 92, 'Ninguna respuesta', 'Ninguna respuesta', 6),
(84, 92, 'Regular / Parcial', 'Regular / Parcial', 7),
(85, 92, 'Resolución favorable', 'Resolución favorable', 8),
(86, 92, 'Sin seguimiento institucional', 'Sin seguimiento institucional', 9),
(87, 94, 'Sí', 'Sí', 1),
(88, 94, 'No', 'No', 2),
(89, 96, 'Sí', 'Sí', 1),
(90, 96, 'No', 'No', 2),
(91, 96, 'Tal vez', 'Tal vez', 3),
(92, 98, '3', 'Moderadamente Aceptada', 5),
(93, 98, '4', 'Muy Aceptada', 2),
(94, 98, '5', 'Totalmente Aceptada', 1),
(97, 101, 'Sí', 'Sí', 1),
(98, 101, 'No', 'No', 2),
(99, 103, 'Sí', 'Sí', 1),
(100, 103, 'No', 'No', 2),
(101, 104, 'Sí', 'Sí', 1),
(102, 104, 'No', 'No', 2),
(103, 106, 'Sí', 'Sí', 1),
(104, 106, 'No', 'No', 2),
(105, 108, 'Sí', 'Sí', 1),
(106, 108, 'No', 'No', 2),
(107, 110, 'Sí', 'Sí', 1),
(108, 110, 'No', 'No', 2),
(109, 112, 'Sí', 'Sí', 1),
(110, 112, 'No', 'No', 2),
(111, 112, 'Prefiero no decirlo', 'Prefiero no decirlo', 3),
(112, 113, 'Sí', 'Sí', 1),
(113, 113, 'No', 'No', 2),
(114, 113, 'No sé qué es atención médica reproductiva', 'No sé qué es atención médica reproductiva', 3),
(115, 114, 'Sí', 'Sí', 1),
(116, 114, 'No', 'No', 2),
(117, 116, 'Sí', 'Sí', 1),
(118, 116, 'No', 'No', 2),
(119, 119, 'Sí', 'Sí', 1),
(120, 119, 'No', 'No', 2),
(121, 120, '3', 'Regular', 3),
(122, 120, '2', 'Mala', 4),
(123, 120, '4', 'Buena', 2),
(124, 121, 'Sí', 'Sí', 1),
(125, 121, 'No', 'No', 2),
(126, 123, '2', 'Poco', 4),
(127, 123, '1', 'Nada', 5),
(128, 123, '3', 'Regular', 3),
(129, 123, '4', 'Mucha', 2),
(130, 124, 'Sí', 'Sí', 1),
(131, 124, 'No', 'No', 2),
(132, 124, 'Prefiero no decirlo', 'Prefiero no decirlo', 3),
(133, 126, 'Sí', 'Sí', 1),
(134, 126, 'No', 'No', 2),
(135, 80, 'NS', 'No sabe', 100),
(136, 81, 'NS', 'No sabe', 100),
(137, 82, 'NS', 'No sabe', 100),
(138, 99, 'NS', 'No sabe', 100),
(139, 83, 'NS', 'No sabe', 100),
(140, 84, 'NS', 'No sabe', 100),
(141, 85, 'NS', 'No sabe', 100),
(142, 88, 'NS', 'No sabe', 100),
(143, 90, 'NS', 'No sabe', 100),
(144, 91, 'NS', 'No sabe', 100),
(145, 92, 'NS', 'No sabe', 100),
(146, 94, 'NS', 'No sabe', 100),
(147, 96, 'NS', 'No sabe', 100),
(148, 98, 'NS', 'No sabe', 100),
(149, 101, 'NS', 'No sabe', 100),
(150, 103, 'NS', 'No sabe', 100),
(151, 104, 'NS', 'No sabe', 100),
(152, 106, 'NS', 'No sabe', 100),
(153, 108, 'NS', 'No sabe', 100),
(154, 110, 'NS', 'No sabe', 100),
(155, 112, 'NS', 'No sabe', 100),
(156, 113, 'NS', 'No sabe', 100),
(157, 114, 'NS', 'No sabe', 100),
(158, 116, 'NS', 'No sabe', 100),
(159, 119, 'NS', 'No sabe', 100),
(160, 120, 'NS', 'No sabe', 100),
(161, 121, 'NS', 'No sabe', 100),
(162, 123, 'NS', 'No sabe', 100),
(163, 124, 'NS', 'No sabe', 100),
(164, 126, 'NS', 'No sabe', 100),
(165, 80, 'NR', 'No quiere responder', 101),
(166, 81, 'NR', 'No quiere responder', 101),
(167, 82, 'NR', 'No quiere responder', 101),
(168, 99, 'NR', 'No quiere responder', 101),
(169, 83, 'NR', 'No quiere responder', 101),
(170, 84, 'NR', 'No quiere responder', 101),
(171, 85, 'NR', 'No quiere responder', 101),
(172, 88, 'NR', 'No quiere responder', 101),
(173, 90, 'NR', 'No quiere responder', 101),
(174, 91, 'NR', 'No quiere responder', 101),
(175, 92, 'NR', 'No quiere responder', 101),
(176, 94, 'NR', 'No quiere responder', 101),
(177, 96, 'NR', 'No quiere responder', 101),
(178, 98, 'NR', 'No quiere responder', 101),
(179, 101, 'NR', 'No quiere responder', 101),
(180, 103, 'NR', 'No quiere responder', 101),
(181, 104, 'NR', 'No quiere responder', 101),
(182, 106, 'NR', 'No quiere responder', 101),
(183, 108, 'NR', 'No quiere responder', 101),
(184, 110, 'NR', 'No quiere responder', 101),
(185, 112, 'NR', 'No quiere responder', 101),
(186, 113, 'NR', 'No quiere responder', 101),
(187, 114, 'NR', 'No quiere responder', 101),
(188, 116, 'NR', 'No quiere responder', 101),
(189, 119, 'NR', 'No quiere responder', 101),
(190, 120, 'NR', 'No quiere responder', 101),
(191, 121, 'NR', 'No quiere responder', 101),
(192, 123, 'NR', 'No quiere responder', 101),
(193, 124, 'NR', 'No quiere responder', 101),
(194, 126, 'NR', 'No quiere responder', 101),
(195, 80, 'NA', 'No aplica', 102),
(196, 81, 'NA', 'No aplica', 102),
(197, 82, 'NA', 'No aplica', 102),
(198, 99, 'NA', 'No aplica', 102),
(199, 83, 'NA', 'No aplica', 102),
(200, 84, 'NA', 'No aplica', 102),
(201, 85, 'NA', 'No aplica', 102),
(202, 88, 'NA', 'No aplica', 102),
(203, 90, 'NA', 'No aplica', 102),
(204, 91, 'NA', 'No aplica', 102),
(205, 92, 'NA', 'No aplica', 102),
(206, 94, 'NA', 'No aplica', 102),
(207, 96, 'NA', 'No aplica', 102),
(208, 98, 'NA', 'No aplica', 102),
(209, 101, 'NA', 'No aplica', 102),
(210, 103, 'NA', 'No aplica', 102),
(211, 104, 'NA', 'No aplica', 102),
(212, 106, 'NA', 'No aplica', 102),
(213, 108, 'NA', 'No aplica', 102),
(214, 110, 'NA', 'No aplica', 102),
(215, 112, 'NA', 'No aplica', 102),
(216, 113, 'NA', 'No aplica', 102),
(217, 114, 'NA', 'No aplica', 102),
(218, 116, 'NA', 'No aplica', 102),
(219, 119, 'NA', 'No aplica', 102),
(220, 120, 'NA', 'No aplica', 102),
(221, 121, 'NA', 'No aplica', 102),
(222, 123, 'NA', 'No aplica', 102),
(223, 124, 'NA', 'No aplica', 102),
(224, 126, 'NA', 'No aplica', 102),
(225, 123, '5', 'Totalmente', 1),
(226, 120, '5', 'Muy Buena', 1),
(227, 120, '1', 'Muy Mala', 5),
(232, 98, '1', 'Nada Aceptada', 4),
(233, 98, '2', 'Poco Aceptada', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organizaciones`
--

CREATE TABLE `organizaciones` (
  `id_organizacion` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `direccion` varchar(500) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `contacto` varchar(200) DEFAULT NULL,
  `activa` tinyint(1) DEFAULT 1,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `organizaciones`
--

INSERT INTO `organizaciones` (`id_organizacion`, `nombre`, `departamento`, `municipio`, `direccion`, `telefono`, `correo`, `contacto`, `activa`, `fecha_registro`) VALUES
(1, 'Organizacion de prueba', 'Cortés', 'Tegucigalpa', 'colonia alameda nacional', '32949365', 'jalf2001@hotmail.com', NULL, 1, '2026-06-23 10:12:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id_pregunta` bigint(20) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `obligatoria` tinyint(1) DEFAULT 1,
  `orden` int(11) NOT NULL,
  `activa` tinyint(1) DEFAULT 1,
  `catalogo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id_pregunta`, `id_seccion`, `pregunta`, `tipo`, `obligatoria`, `orden`, `activa`, `catalogo`) VALUES
(76, 33, '¿Pertenece a alguna Organización?', 'select', 1, 1, 1, NULL),
(77, 33, 'Nombre de la Organización a la que pertenece', 'text', 1, 2, 1, NULL),
(78, 33, '¿Cuál es su sexo biológico?', 'select', 1, 3, 1, NULL),
(79, 33, 'Edad: Rango de edad de la persona', 'number', 1, 4, 1, NULL),
(80, 33, 'Según su orientación sexual usted se considera:', 'select', 1, 5, 1, NULL),
(81, 33, 'Según su identidad de género, usted se considera:', 'select', 1, 6, 1, NULL),
(82, 33, '¿En qué departamento vive actualmente?', 'select', 1, 7, 1, NULL),
(83, 34, '¿Cuál fue el último nivel de educación formal que completó?', 'select', 1, 8, 1, NULL),
(84, 34, '¿Se encuentra estudiando actualmente?', 'select', 1, 9, 1, NULL),
(85, 34, '¿Estudia en el sistema de educación formal o educación no formal?', 'select', 1, 10, 1, NULL),
(86, 34, '¿Qué grado de estudio formal se encuentra cursando actualmente?', 'textarea', 1, 11, 1, NULL),
(87, 34, '¿Mencione la disciplina, profesión u oficio que está estudiando?', 'textarea', 1, 12, 1, NULL),
(88, 34, '¿Ha enfrentado acoso, discriminación o violencia en el sistema educativo formal?', 'select', 1, 13, 1, NULL),
(89, 34, '¿Qué tipo de acoso, discriminación o violencia ha enfrentado en el sistema educativo?', 'textarea', 1, 14, 1, NULL),
(90, 34, 'El acoso, discriminación o violencia ha sido por parte de:', 'checkbox', 1, 15, 1, NULL),
(91, 34, '¿Tuvo la oportunidad de denunciar el acoso o discriminación vivido?', 'select', 1, 16, 1, NULL),
(92, 34, '¿Cuál fue el resultado de su denuncia?', 'select', 1, 17, 1, NULL),
(93, 34, '¿Por qué no lo hizo?', 'textarea', 1, 18, 1, NULL),
(94, 35, '¿Votó en las últimas elecciones primarias o generales?', 'select', 1, 19, 1, NULL),
(95, 35, '¿Por qué no votó?', 'textarea', 1, 20, 1, NULL),
(96, 35, '¿Va a votar en las próximas elecciones?', 'select', 1, 21, 1, NULL),
(97, 35, '¿Por qué sí o por qué no?', 'textarea', 1, 22, 1, NULL),
(98, 35, 'Como persona LGTBIQ+ ¿se siente aceptada por la sociedad hondureña?', 'select', 1, 23, 1, NULL),
(99, 36, '¿Cuenta actualmente con un trabajo?', 'select', 1, 24, 1, NULL),
(100, 36, '¿Cuál es su trabajo?', 'textarea', 1, 25, 1, NULL),
(101, 36, '¿Ha sufrido discriminación en el empleo?', 'select', 1, 26, 1, NULL),
(102, 36, '¿Qué tipo de discriminación ha sufrido en el empleo?', 'textarea', 1, 27, 1, NULL),
(103, 36, '¿Se encuentra usted en situación de pobreza?', 'select', 1, 28, 1, NULL),
(104, 36, '¿Es usted dueño/a de alguna empresa?', 'select', 1, 29, 1, NULL),
(105, 36, '¿Qué actividad económica realiza su empresa?', 'textarea', 1, 30, 1, NULL),
(106, 37, '¿Ha enfrentado violencia o discriminación en razón de su orientación sexual, identidad o expresión de género en el sistema de salud hondureño?', 'select', 1, 31, 1, NULL),
(107, 37, '¿Qué tipo de violencia o discriminación ha enfrentado en el sistema de salud?', 'textarea', 1, 32, 1, NULL),
(108, 37, '¿Cuenta con una fuente específica de atención médica permanente?', 'select', 1, 33, 1, NULL),
(109, 37, '¿Cuál es esa fuente de atención médica permanente?', 'textarea', 1, 34, 1, NULL),
(110, 37, 'En caso que usted tenga útero ¿Se ha realizado estudios para detectar cáncer en el cuello uterino?', 'select', 1, 35, 1, NULL),
(111, 37, '¿Cuál fue la razón por la que se realizó este estudio?', 'textarea', 1, 36, 1, NULL),
(112, 37, '¿Es usted una persona con VIH?', 'select', 1, 37, 1, NULL),
(113, 37, '¿Ha recibido atención médica reproductiva en el sistema de salud pública?', 'select', 1, 38, 1, NULL),
(114, 37, '¿Esta atención tuvo en cuenta su orientación sexual e identidad de género?', 'select', 1, 39, 1, NULL),
(115, 37, '¿Por qué no?', 'textarea', 1, 40, 1, NULL),
(116, 38, '¿Ha asistido a recibir atención psicológica en los últimos 12 meses?', 'select', 1, 41, 1, NULL),
(117, 38, '¿Dónde recibió esa atención?', 'textarea', 1, 42, 1, NULL),
(118, 38, '¿Por qué no ha recibido esta asistencia?', 'textarea', 1, 43, 1, NULL),
(119, 38, '¿Ha padecido algún cuadro de depresión en los últimos 12 meses?', 'select', 1, 44, 1, NULL),
(120, 38, 'En general ¿Cómo se encuentra su salud?', 'select', 1, 45, 1, NULL),
(121, 39, '¿Ha sido víctima de violencia basada en su orientación sexual, identidad o expresión de género en los últimos 12 meses?', 'select', 1, 46, 1, NULL),
(122, 39, '¿Qué tipo de violencia ha enfrentado?', 'textarea', 1, 47, 1, NULL),
(123, 39, '¿Qué tanto confía en que el sistema judicial hondureño ante la violencia que viven las personas LGTBIQ+?', 'likert', 1, 48, 1, NULL),
(124, 39, '¿Ha sido detenido/a en alguna ocasión por las fuerzas de seguridad?', 'select', 1, 49, 1, NULL),
(125, 39, '¿Cuál fue la causa de dicha detención?', 'textarea', 1, 50, 1, NULL),
(126, 39, 'Durante su detención ¿Fue víctima de discriminación o violencia?', 'select', 1, 51, 1, NULL),
(127, 39, '¿Qué tipo de violencia o discriminación sufrió durante su detención?', 'textarea', 1, 52, 1, NULL),
(133, 41, '¿Ha tenido que cambiar de lugar de residencia dentro de Honduras debido a discriminación, violencia o amenazas relacionadas con su orientación sexual, identidad o expresión de género?', 'select', 1, 1, 1, 'MIGRACION'),
(134, 41, '¿Ha migrado fuera de Honduras debido a discriminación, violencia o amenazas relacionadas con su orientación sexual, identidad o expresión de género?', 'select', 1, 2, 1, 'MIGRACION'),
(135, 41, '¿Ha considerado migrar o abandonar su lugar de residencia por motivos relacionados con su orientación sexual, identidad o expresión de género?', 'select', 1, 3, 1, 'MIGRACION'),
(136, 41, '¿Cuál fue la principal razón para considerar o realizar esta migración o desplazamiento?', 'textarea', 1, 4, 1, 'MIGRACION'),
(137, 41, '¿La migración o desplazamiento mejoró sus condiciones de vida y seguridad?', 'likert', 1, 5, 1, 'MIGRACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`, `descripcion`, `activo`, `fecha_creacion`) VALUES
(5, 'Administrador General', 'Administración completa del sistema, organizaciones, usuarios, encuestas, indicadores y reportes.', 1, '2026-06-23 19:04:46'),
(6, 'Administrador Organización', 'Administra usuarios y encuestas de su organización.', 1, '2026-06-23 19:04:46'),
(7, 'Encuestador', 'Captura y registra encuestas.', 1, '2026-06-23 19:04:46'),
(8, 'Consulta', 'Acceso únicamente a reportes y resultados.', 1, '2026-06-23 19:04:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id_seccion` int(11) NOT NULL,
  `id_formulario` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id_seccion`, `id_formulario`, `nombre`, `orden`) VALUES
(33, 1, 'Datos Generales', 1),
(34, 1, 'Educación', 2),
(35, 1, 'Participación Ciudadana', 3),
(36, 1, 'Empleo y Economía', 4),
(37, 1, 'Salud', 5),
(38, 1, 'Salud Mental', 6),
(39, 1, 'Violencia y Justicia', 7),
(40, 1, 'Resumen', 9),
(41, 1, 'Migración y Desplazamiento Forzado', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `id_sesion` bigint(20) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `navegador` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `nombres` varchar(150) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `ultimo_acceso` datetime DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  `id_organizacion` int(11) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `correo`, `nombres`, `apellidos`, `password_hash`, `id_rol`, `ultimo_acceso`, `activo`, `fecha_creacion`, `creado_por`, `id_organizacion`, `telefono`, `cargo`) VALUES
(11, 'admin@somoscdc.org', 'admin@somoscdc.org', 'Administrador', 'General', '$2y$10$qgVZm7jwFhcrTsY/KZIrvuQd43WOP98xae1QVw3lHa3rKd3gD7Nkm', 5, '2026-06-23 13:29:52', 1, '2026-06-23 19:08:00', NULL, 1, '32949365', NULL),
(12, 'adminorg@somoscdc.org', 'adminorg@somoscdc.org', 'Administrador', 'Organización', '$2y$10$LF.UZUNV4DYgMun9gr59b.LGzM48EW/Ztj/jrr5SmRed4Az0lZfWe', 6, NULL, 1, '2026-06-23 19:08:00', NULL, 1, '00000000', NULL),
(13, 'jalf2001@hotmail.com', 'jalf2001@hotmail.com', 'Jorge', 'Lopez', '$2y$10$/ZUwKODMjWLGF7si6oxXnOnGIaQkFHv1wJW0IgDDLQvWBdWJDRNWe', 7, NULL, 0, '2026-06-23 19:44:16', NULL, 1, '32949365', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_formulario`
--

CREATE TABLE `usuario_formulario` (
  `id_usuario_formulario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_formulario` int(11) NOT NULL,
  `fecha_asignacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id_auditoria`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `detalle_encuesta`
--
ALTER TABLE `detalle_encuesta`
  ADD PRIMARY KEY (`id_detalle`);

--
-- Indices de la tabla `encabezado_encuesta`
--
ALTER TABLE `encabezado_encuesta`
  ADD PRIMARY KEY (`id_encuesta`),
  ADD KEY `fk_encuesta_usuario` (`id_usuario`),
  ADD KEY `fk_encuesta_organizacion` (`id_organizacion`);

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`id_encuesta`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `id_formulario` (`id_formulario`),
  ADD KEY `idx_encuesta_usuario` (`id_usuario`);

--
-- Indices de la tabla `formularios`
--
ALTER TABLE `formularios`
  ADD PRIMARY KEY (`id_formulario`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Indices de la tabla `opciones_pregunta`
--
ALTER TABLE `opciones_pregunta`
  ADD PRIMARY KEY (`id_opcion`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `organizaciones`
--
ALTER TABLE `organizaciones`
  ADD PRIMARY KEY (`id_organizacion`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `idx_pregunta_seccion` (`id_seccion`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id_seccion`),
  ADD KEY `id_formulario` (`id_formulario`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id_sesion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `correo_2` (`correo`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `creado_por` (`creado_por`),
  ADD KEY `fk_usuario_organizacion` (`id_organizacion`);

--
-- Indices de la tabla `usuario_formulario`
--
ALTER TABLE `usuario_formulario`
  ADD PRIMARY KEY (`id_usuario_formulario`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`,`id_formulario`),
  ADD KEY `id_formulario` (`id_formulario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id_auditoria` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `detalle_encuesta`
--
ALTER TABLE `detalle_encuesta`
  MODIFY `id_detalle` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encabezado_encuesta`
--
ALTER TABLE `encabezado_encuesta`
  MODIFY `id_encuesta` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `id_encuesta` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formularios`
--
ALTER TABLE `formularios`
  MODIFY `id_formulario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `opciones_pregunta`
--
ALTER TABLE `opciones_pregunta`
  MODIFY `id_opcion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT de la tabla `organizaciones`
--
ALTER TABLE `organizaciones`
  MODIFY `id_organizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id_pregunta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id_sesion` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario_formulario`
--
ALTER TABLE `usuario_formulario`
  MODIFY `id_usuario_formulario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `encabezado_encuesta`
--
ALTER TABLE `encabezado_encuesta`
  ADD CONSTRAINT `fk_encuesta_organizacion` FOREIGN KEY (`id_organizacion`) REFERENCES `organizaciones` (`id_organizacion`),
  ADD CONSTRAINT `fk_encuesta_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD CONSTRAINT `encuestas_ibfk_1` FOREIGN KEY (`id_formulario`) REFERENCES `formularios` (`id_formulario`),
  ADD CONSTRAINT `encuestas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`);

--
-- Filtros para la tabla `opciones_pregunta`
--
ALTER TABLE `opciones_pregunta`
  ADD CONSTRAINT `opciones_pregunta_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `preguntas` (`id_pregunta`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`);

--
-- Filtros para la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD CONSTRAINT `secciones_ibfk_1` FOREIGN KEY (`id_formulario`) REFERENCES `formularios` (`id_formulario`);

--
-- Filtros para la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `sesiones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_organizacion` FOREIGN KEY (`id_organizacion`) REFERENCES `organizaciones` (`id_organizacion`),
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `usuario_formulario`
--
ALTER TABLE `usuario_formulario`
  ADD CONSTRAINT `usuario_formulario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `usuario_formulario_ibfk_2` FOREIGN KEY (`id_formulario`) REFERENCES `formularios` (`id_formulario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
