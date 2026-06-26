-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2026 a las 21:40:04
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

--
-- Volcado de datos para la tabla `detalle_encuesta`
--

INSERT INTO `detalle_encuesta` (`id_detalle`, `id_encuesta`, `id_pregunta`, `valor`, `fecha_registro`) VALUES
(1, 1, 76, 'Sí', '2026-06-24 09:54:51'),
(2, 1, 77, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(3, 1, 78, 'M', '2026-06-24 09:54:51'),
(4, 1, 79, '-1', '2026-06-24 09:54:51'),
(5, 1, 80, 'Asexual', '2026-06-24 09:54:51'),
(6, 1, 81, 'Hombre Cis', '2026-06-24 09:54:51'),
(7, 1, 82, 'Atlántida', '2026-06-24 09:54:51'),
(8, 1, 83, 'Pos-Grado', '2026-06-24 09:54:51'),
(9, 1, 84, 'Sí', '2026-06-24 09:54:51'),
(10, 1, 85, 'Formal', '2026-06-24 09:54:51'),
(11, 1, 86, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(12, 1, 87, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(13, 1, 88, 'Sí', '2026-06-24 09:54:51'),
(14, 1, 89, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(15, 1, 90, 'Acoso sexual|Bullying', '2026-06-24 09:54:51'),
(16, 1, 91, 'Sí', '2026-06-24 09:54:51'),
(17, 1, 92, 'Regular / Parcial', '2026-06-24 09:54:51'),
(18, 1, 93, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(19, 1, 94, 'Sí', '2026-06-24 09:54:51'),
(20, 1, 95, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(21, 1, 96, 'Sí', '2026-06-24 09:54:51'),
(22, 1, 97, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(23, 1, 98, '4', '2026-06-24 09:54:51'),
(24, 1, 99, 'Sí', '2026-06-24 09:54:51'),
(25, 1, 100, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(26, 1, 101, 'No', '2026-06-24 09:54:51'),
(27, 1, 102, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(28, 1, 103, 'Sí', '2026-06-24 09:54:51'),
(29, 1, 104, 'Sí', '2026-06-24 09:54:51'),
(30, 1, 105, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(31, 1, 106, 'No', '2026-06-24 09:54:51'),
(32, 1, 107, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(33, 1, 108, 'Sí', '2026-06-24 09:54:51'),
(34, 1, 109, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(35, 1, 110, 'Sí', '2026-06-24 09:54:51'),
(36, 1, 111, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(37, 1, 112, 'Sí', '2026-06-24 09:54:51'),
(38, 1, 113, 'Sí', '2026-06-24 09:54:51'),
(39, 1, 114, 'Sí', '2026-06-24 09:54:51'),
(40, 1, 115, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(41, 1, 116, 'Sí', '2026-06-24 09:54:51'),
(42, 1, 117, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(43, 1, 118, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(44, 1, 119, 'Sí', '2026-06-24 09:54:51'),
(45, 1, 120, '3', '2026-06-24 09:54:51'),
(46, 1, 121, 'Sí', '2026-06-24 09:54:51'),
(47, 1, 122, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(48, 1, 123, '4', '2026-06-24 09:54:51'),
(49, 1, 124, 'Sí', '2026-06-24 09:54:51'),
(50, 1, 125, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(51, 1, 126, 'No', '2026-06-24 09:54:51'),
(52, 1, 127, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(53, 1, 133, 'SI', '2026-06-24 09:54:51'),
(54, 1, 134, 'Si', '2026-06-24 09:54:51'),
(55, 1, 135, 'Si', '2026-06-24 09:54:51'),
(56, 1, 136, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-24 09:54:51'),
(57, 1, 137, 'Si', '2026-06-24 09:54:51'),
(58, 2, 76, 'No', '2026-06-25 11:12:40'),
(59, 2, 77, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(60, 2, 78, 'M', '2026-06-25 11:12:40'),
(61, 2, 79, '54', '2026-06-25 11:12:40'),
(62, 2, 80, 'Asexual', '2026-06-25 11:12:40'),
(63, 2, 81, 'Hombre trans', '2026-06-25 11:12:40'),
(64, 2, 82, 'Colón', '2026-06-25 11:12:40'),
(65, 2, 83, 'Primaria', '2026-06-25 11:12:40'),
(66, 2, 84, 'No', '2026-06-25 11:12:40'),
(67, 2, 85, 'Formal', '2026-06-25 11:12:40'),
(68, 2, 86, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(69, 2, 87, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(70, 2, 88, 'No', '2026-06-25 11:12:40'),
(71, 2, 89, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(72, 2, 90, 'NA', '2026-06-25 11:12:40'),
(73, 2, 91, 'Sí', '2026-06-25 11:12:40'),
(74, 2, 92, 'Regular / Parcial', '2026-06-25 11:12:40'),
(75, 2, 93, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(76, 2, 94, 'No', '2026-06-25 11:12:40'),
(77, 2, 95, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(78, 2, 96, 'Tal vez', '2026-06-25 11:12:40'),
(79, 2, 97, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(80, 2, 98, '4', '2026-06-25 11:12:40'),
(81, 2, 99, 'Sí', '2026-06-25 11:12:40'),
(82, 2, 100, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(83, 2, 101, 'Sí', '2026-06-25 11:12:40'),
(84, 2, 102, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(85, 2, 103, 'No', '2026-06-25 11:12:40'),
(86, 2, 104, 'Sí', '2026-06-25 11:12:40'),
(87, 2, 105, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(88, 2, 106, 'Sí', '2026-06-25 11:12:40'),
(89, 2, 107, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(90, 2, 108, 'Sí', '2026-06-25 11:12:40'),
(91, 2, 109, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(92, 2, 110, 'Sí', '2026-06-25 11:12:40'),
(93, 2, 111, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(94, 2, 112, 'No', '2026-06-25 11:12:40'),
(95, 2, 113, 'Sí', '2026-06-25 11:12:40'),
(96, 2, 114, 'Sí', '2026-06-25 11:12:40'),
(97, 2, 115, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(98, 2, 116, 'Sí', '2026-06-25 11:12:40'),
(99, 2, 117, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(100, 2, 118, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(101, 2, 119, 'Sí', '2026-06-25 11:12:40'),
(102, 2, 120, '5', '2026-06-25 11:12:40'),
(103, 2, 121, 'Sí', '2026-06-25 11:12:40'),
(104, 2, 122, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(105, 2, 123, '5', '2026-06-25 11:12:40'),
(106, 2, 124, 'Sí', '2026-06-25 11:12:40'),
(107, 2, 125, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(108, 2, 126, 'Sí', '2026-06-25 11:12:40'),
(109, 2, 127, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(110, 2, 133, 'SI', '2026-06-25 11:12:40'),
(111, 2, 134, 'Si', '2026-06-25 11:12:40'),
(112, 2, 135, 'Si', '2026-06-25 11:12:40'),
(113, 2, 136, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-25 11:12:40'),
(114, 2, 137, 'Si', '2026-06-25 11:12:40'),
(115, 3, 76, 'Sí', '2026-06-26 11:40:21'),
(116, 3, 77, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(117, 3, 78, 'M', '2026-06-26 11:40:21'),
(118, 3, 79, '25', '2026-06-26 11:40:21'),
(119, 3, 80, 'Heterosexual', '2026-06-26 11:40:21'),
(120, 3, 81, 'Hombre trans', '2026-06-26 11:40:21'),
(121, 3, 82, 'Francisco Morazán', '2026-06-26 11:40:21'),
(122, 3, 83, 'Secudaria', '2026-06-26 11:40:21'),
(123, 3, 84, 'No', '2026-06-26 11:40:21'),
(124, 3, 85, 'Formal', '2026-06-26 11:40:21'),
(125, 3, 86, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(126, 3, 87, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(127, 3, 88, 'Sí', '2026-06-26 11:40:21'),
(128, 3, 89, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(129, 3, 90, 'Bullying|Comentarios LGTBIfóbicos', '2026-06-26 11:40:21'),
(130, 3, 91, 'No', '2026-06-26 11:40:21'),
(131, 3, 92, 'NR', '2026-06-26 11:40:21'),
(132, 3, 93, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(133, 3, 94, 'No', '2026-06-26 11:40:21'),
(134, 3, 95, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(135, 3, 96, 'No', '2026-06-26 11:40:21'),
(136, 3, 97, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(137, 3, 98, '2', '2026-06-26 11:40:21'),
(138, 3, 99, 'Sí', '2026-06-26 11:40:21'),
(139, 3, 100, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(140, 3, 101, 'Sí', '2026-06-26 11:40:21'),
(141, 3, 102, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(142, 3, 103, 'No', '2026-06-26 11:40:21'),
(143, 3, 104, 'Sí', '2026-06-26 11:40:21'),
(144, 3, 105, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(145, 3, 106, 'Sí', '2026-06-26 11:40:21'),
(146, 3, 107, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(147, 3, 108, 'Sí', '2026-06-26 11:40:21'),
(148, 3, 109, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(149, 3, 110, 'Sí', '2026-06-26 11:40:21'),
(150, 3, 111, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(151, 3, 112, 'No', '2026-06-26 11:40:21'),
(152, 3, 113, 'Sí', '2026-06-26 11:40:21'),
(153, 3, 114, 'Sí', '2026-06-26 11:40:21'),
(154, 3, 115, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(155, 3, 116, 'Sí', '2026-06-26 11:40:21'),
(156, 3, 117, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(157, 3, 118, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(158, 3, 119, 'Sí', '2026-06-26 11:40:21'),
(159, 3, 120, '3', '2026-06-26 11:40:21'),
(160, 3, 121, 'Sí', '2026-06-26 11:40:21'),
(161, 3, 122, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(162, 3, 123, '2', '2026-06-26 11:40:21'),
(163, 3, 124, 'Sí', '2026-06-26 11:40:21'),
(164, 3, 125, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(165, 3, 126, 'Sí', '2026-06-26 11:40:21'),
(166, 3, 127, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(167, 3, 133, 'Sí', '2026-06-26 11:40:21'),
(168, 3, 134, 'Si', '2026-06-26 11:40:21'),
(169, 3, 135, 'Si', '2026-06-26 11:40:21'),
(170, 3, 136, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 11:40:21'),
(171, 3, 137, 'Si', '2026-06-26 11:40:21'),
(172, 4, 76, 'Sí', '2026-06-26 13:05:53'),
(173, 4, 77, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(174, 4, 78, 'M', '2026-06-26 13:05:53'),
(175, 4, 79, '-1', '2026-06-26 13:05:53'),
(176, 4, 80, 'Bisexual', '2026-06-26 13:05:53'),
(177, 4, 81, 'No binario', '2026-06-26 13:05:53'),
(178, 4, 82, 'Cortés', '2026-06-26 13:05:53'),
(179, 4, 83, 'Superior (universitaria)', '2026-06-26 13:05:53'),
(180, 4, 84, 'Sí', '2026-06-26 13:05:53'),
(181, 4, 85, 'Formal', '2026-06-26 13:05:53'),
(182, 4, 86, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(183, 4, 87, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(184, 4, 88, 'Sí', '2026-06-26 13:05:53'),
(185, 4, 89, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(186, 4, 90, 'Exclusión', '2026-06-26 13:05:53'),
(187, 4, 91, 'Sí', '2026-06-26 13:05:53'),
(188, 4, 92, 'En proceso', '2026-06-26 13:05:53'),
(189, 4, 93, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(190, 4, 94, 'No', '2026-06-26 13:05:53'),
(191, 4, 95, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(192, 4, 96, 'Sí', '2026-06-26 13:05:53'),
(193, 4, 97, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(194, 4, 98, '4', '2026-06-26 13:05:53'),
(195, 4, 99, 'Sí', '2026-06-26 13:05:53'),
(196, 4, 100, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(197, 4, 101, 'No', '2026-06-26 13:05:53'),
(198, 4, 102, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(199, 4, 103, 'No', '2026-06-26 13:05:53'),
(200, 4, 104, 'No', '2026-06-26 13:05:53'),
(201, 4, 105, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(202, 4, 106, 'Sí', '2026-06-26 13:05:53'),
(203, 4, 107, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(204, 4, 108, 'Sí', '2026-06-26 13:05:53'),
(205, 4, 109, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(206, 4, 110, 'No', '2026-06-26 13:05:53'),
(207, 4, 111, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(208, 4, 112, 'Sí', '2026-06-26 13:05:53'),
(209, 4, 113, 'No', '2026-06-26 13:05:53'),
(210, 4, 114, 'No', '2026-06-26 13:05:53'),
(211, 4, 115, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(212, 4, 116, 'Sí', '2026-06-26 13:05:53'),
(213, 4, 117, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(214, 4, 118, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(215, 4, 119, 'Sí', '2026-06-26 13:05:53'),
(216, 4, 120, '3', '2026-06-26 13:05:53'),
(217, 4, 121, 'Sí', '2026-06-26 13:05:53'),
(218, 4, 122, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(219, 4, 123, '4', '2026-06-26 13:05:53'),
(220, 4, 124, 'Sí', '2026-06-26 13:05:53'),
(221, 4, 125, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(222, 4, 126, 'Sí', '2026-06-26 13:05:53'),
(223, 4, 127, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(224, 4, 133, 'Sí', '2026-06-26 13:05:53'),
(225, 4, 134, 'Si', '2026-06-26 13:05:53'),
(226, 4, 135, 'Si', '2026-06-26 13:05:53'),
(227, 4, 136, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:05:53'),
(228, 4, 137, 'Si', '2026-06-26 13:05:53'),
(229, 5, 76, 'Sí', '2026-06-26 13:24:18'),
(230, 5, 77, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(231, 5, 78, 'M', '2026-06-26 13:24:18'),
(232, 5, 79, '62', '2026-06-26 13:24:18'),
(233, 5, 80, 'Gay', '2026-06-26 13:24:18'),
(234, 5, 81, 'Mujer trans', '2026-06-26 13:24:18'),
(235, 5, 82, 'Gracias a Dios', '2026-06-26 13:24:18'),
(236, 5, 83, 'Pos-Grado', '2026-06-26 13:24:18'),
(237, 5, 84, 'No', '2026-06-26 13:24:18'),
(238, 5, 85, 'Formal', '2026-06-26 13:24:18'),
(239, 5, 86, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(240, 5, 87, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(241, 5, 88, 'Sí', '2026-06-26 13:24:18'),
(242, 5, 89, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(243, 5, 90, 'Acoso sexual', '2026-06-26 13:24:18'),
(244, 5, 91, 'Sí', '2026-06-26 13:24:18'),
(245, 5, 92, 'Ninguna respuesta', '2026-06-26 13:24:18'),
(246, 5, 93, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(247, 5, 94, 'No', '2026-06-26 13:24:18'),
(248, 5, 95, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(249, 5, 96, 'Sí', '2026-06-26 13:24:18'),
(250, 5, 97, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(251, 5, 98, '2', '2026-06-26 13:24:18'),
(252, 5, 99, 'Sí', '2026-06-26 13:24:18'),
(253, 5, 100, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(254, 5, 101, 'Sí', '2026-06-26 13:24:18'),
(255, 5, 102, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(256, 5, 103, 'Sí', '2026-06-26 13:24:18'),
(257, 5, 104, 'No', '2026-06-26 13:24:18'),
(258, 5, 105, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(259, 5, 106, 'Sí', '2026-06-26 13:24:18'),
(260, 5, 107, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(261, 5, 108, 'Sí', '2026-06-26 13:24:18'),
(262, 5, 109, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(263, 5, 110, 'Sí', '2026-06-26 13:24:18'),
(264, 5, 111, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(265, 5, 112, 'No', '2026-06-26 13:24:18'),
(266, 5, 113, 'No', '2026-06-26 13:24:18'),
(267, 5, 114, 'Sí', '2026-06-26 13:24:18'),
(268, 5, 115, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(269, 5, 139, 'NO', '2026-06-26 13:24:18'),
(270, 5, 116, 'Sí', '2026-06-26 13:24:18'),
(271, 5, 117, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(272, 5, 118, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(273, 5, 119, 'Sí', '2026-06-26 13:24:18'),
(274, 5, 120, '3', '2026-06-26 13:24:18'),
(275, 5, 121, 'Sí', '2026-06-26 13:24:18'),
(276, 5, 122, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(277, 5, 123, '4', '2026-06-26 13:24:18'),
(278, 5, 124, 'No', '2026-06-26 13:24:18'),
(279, 5, 125, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(280, 5, 126, 'Sí', '2026-06-26 13:24:18'),
(281, 5, 127, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(282, 5, 133, 'Sí', '2026-06-26 13:24:18'),
(283, 5, 134, 'Sí', '2026-06-26 13:24:18'),
(284, 5, 135, 'Sí', '2026-06-26 13:24:18'),
(285, 5, 136, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:24:18'),
(286, 5, 137, 'No', '2026-06-26 13:24:18'),
(287, 5, 141, '3', '2026-06-26 13:24:18'),
(288, 6, 76, 'Sí', '2026-06-26 13:31:45'),
(289, 6, 77, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(290, 6, 78, 'M', '2026-06-26 13:31:45'),
(291, 6, 79, '24', '2026-06-26 13:31:45'),
(292, 6, 80, 'Lesbiana', '2026-06-26 13:31:45'),
(293, 6, 81, 'No binario', '2026-06-26 13:31:45'),
(294, 6, 82, 'Gracias a Dios', '2026-06-26 13:31:45'),
(295, 6, 83, 'Pos-Grado', '2026-06-26 13:31:45'),
(296, 6, 84, 'Sí', '2026-06-26 13:31:45'),
(297, 6, 85, 'Formal', '2026-06-26 13:31:45'),
(298, 6, 86, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(299, 6, 87, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(300, 6, 88, 'Sí', '2026-06-26 13:31:45'),
(301, 6, 89, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(302, 6, 90, 'Otros', '2026-06-26 13:31:45'),
(303, 6, 91, 'Sí', '2026-06-26 13:31:45'),
(304, 6, 92, 'Resolución favorable', '2026-06-26 13:31:45'),
(305, 6, 93, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(306, 6, 94, 'Sí', '2026-06-26 13:31:45'),
(307, 6, 95, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(308, 6, 96, 'Sí', '2026-06-26 13:31:45'),
(309, 6, 97, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(310, 6, 98, '2', '2026-06-26 13:31:45'),
(311, 6, 99, 'Sí', '2026-06-26 13:31:45'),
(312, 6, 100, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(313, 6, 101, 'No', '2026-06-26 13:31:45'),
(314, 6, 102, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(315, 6, 103, 'No', '2026-06-26 13:31:45'),
(316, 6, 104, 'Sí', '2026-06-26 13:31:45'),
(317, 6, 105, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(318, 6, 106, 'No', '2026-06-26 13:31:45'),
(319, 6, 107, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(320, 6, 108, 'No', '2026-06-26 13:31:45'),
(321, 6, 109, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(322, 6, 110, 'No', '2026-06-26 13:31:45'),
(323, 6, 111, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(324, 6, 112, 'Sí', '2026-06-26 13:31:45'),
(325, 6, 113, 'No', '2026-06-26 13:31:45'),
(326, 6, 114, 'Sí', '2026-06-26 13:31:45'),
(327, 6, 115, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(328, 6, 139, 'Sí', '2026-06-26 13:31:45'),
(329, 6, 140, 'Sí', '2026-06-26 13:31:45'),
(330, 6, 116, 'No', '2026-06-26 13:31:45'),
(331, 6, 117, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(332, 6, 118, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(333, 6, 119, 'Sí', '2026-06-26 13:31:45'),
(334, 6, 120, '3', '2026-06-26 13:31:45'),
(335, 6, 121, 'Sí', '2026-06-26 13:31:45'),
(336, 6, 122, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(337, 6, 123, '5', '2026-06-26 13:31:45'),
(338, 6, 124, 'Sí', '2026-06-26 13:31:45'),
(339, 6, 125, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(340, 6, 126, 'Sí', '2026-06-26 13:31:45'),
(341, 6, 127, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(342, 6, 133, 'Sí', '2026-06-26 13:31:45'),
(343, 6, 134, 'No', '2026-06-26 13:31:45'),
(344, 6, 135, 'Sí', '2026-06-26 13:31:45'),
(345, 6, 136, 'NO APLICA / NO SABE / NO QUIERE RESPONDER', '2026-06-26 13:31:45'),
(346, 6, 137, 'No', '2026-06-26 13:31:45'),
(347, 6, 141, '5', '2026-06-26 13:31:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimensiones`
--

CREATE TABLE `dimensiones` (
  `id_dimension` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `peso` decimal(8,4) NOT NULL,
  `orden` int(11) NOT NULL,
  `activa` tinyint(1) DEFAULT 1,
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encabezado_encuesta`
--

CREATE TABLE `encabezado_encuesta` (
  `id_encuesta` bigint(20) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_organizacion` int(11) NOT NULL,
  `fecha_encuesta` datetime NOT NULL DEFAULT current_timestamp(),
  `anio` int(11) NOT NULL,
  `estado` varchar(20) DEFAULT 'COMPLETA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `encabezado_encuesta`
--

INSERT INTO `encabezado_encuesta` (`id_encuesta`, `id_periodo`, `id_usuario`, `id_organizacion`, `fecha_encuesta`, `anio`, `estado`) VALUES
(1, 1, 11, 1, '2026-06-24 09:54:51', 2026, 'COMPLETA'),
(2, 1, 11, 1, '2026-06-25 11:12:40', 2026, 'COMPLETA'),
(3, 1, 11, 1, '2026-06-26 11:40:21', 2026, 'COMPLETA'),
(4, 1, 11, 1, '2026-06-26 13:05:53', 2026, 'COMPLETA'),
(5, 1, 11, 1, '2026-06-26 13:24:18', 2026, 'COMPLETA'),
(6, 1, 11, 1, '2026-06-26 13:31:45', 2026, 'COMPLETA');

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
-- Estructura de tabla para la tabla `indicadores`
--

CREATE TABLE `indicadores` (
  `id_indicador` int(11) NOT NULL,
  `id_dimension` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `archivo` varchar(120) NOT NULL,
  `formula` text DEFAULT NULL,
  `peso` decimal(8,4) NOT NULL,
  `orden` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicador_pregunta`
--

CREATE TABLE `indicador_pregunta` (
  `id_indicador` int(11) NOT NULL,
  `id_pregunta` bigint(20) NOT NULL,
  `variable` varchar(100) NOT NULL,
  `tipo_variable` enum('NUMERADOR','DENOMINADOR','FILTRO','APOYO') DEFAULT 'APOYO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(233, 98, '2', 'Poco Aceptada', 3),
(234, 133, 'Sí', 'Si', 1),
(235, 134, 'Sí', 'Si', 1),
(236, 135, 'Sí', 'Si', 1),
(237, 137, 'Sí', 'Si', 1),
(238, 141, '1', 'Muy malo', 5),
(239, 141, '2', 'Malo', 4),
(240, 141, '3', 'Regular', 3),
(241, 141, '4', 'Bueno', 2),
(242, 141, '5', 'Muy bueno', 1),
(243, 139, 'Sí', 'Sí', 1),
(244, 139, 'NO', 'No', 2),
(246, 140, 'Sí', 'Sí', 1),
(247, 140, 'NO', 'No', 2),
(248, 140, 'NS', 'No sabe', 3),
(249, 133, 'No', 'No', 2),
(250, 133, 'NS', 'No Sabe', 3),
(251, 133, 'NR', 'No quiere responder', 4),
(252, 133, 'NA', 'No aplica', 5),
(253, 141, 'NS', 'No sabe', 100),
(254, 141, 'NR', 'No quiere responder', 101),
(255, 141, 'NA', 'No aplica', 102),
(256, 139, 'NS', 'No sabe', 3),
(257, 139, 'NR', 'No quiere responder', 4),
(258, 139, 'NA', 'No aplica', 5),
(259, 140, 'NR', 'No quiere responder', 101),
(260, 140, 'NA', 'No aplica', 102),
(261, 134, 'No', 'No', 2),
(262, 134, 'NS', 'No sabe', 3),
(263, 134, 'NR', 'No quiere responder', 4),
(264, 134, 'NA', 'No aplica', 5),
(265, 135, 'No', 'No', 2),
(266, 135, 'NS', 'No sabe', 3),
(267, 135, 'NR', 'No quiere responder', 4),
(268, 135, 'NA', 'No aplica', 5),
(269, 137, 'No', 'No', 2),
(270, 137, 'NS', 'No sabe', 3),
(271, 137, 'NR', 'No quiere responder', 4),
(272, 137, 'NA', 'No aplica', 5);

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
-- Estructura de tabla para la tabla `periodos_encuesta`
--

CREATE TABLE `periodos_encuesta` (
  `id_periodo` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `observaciones` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `anio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodos_encuesta`
--

INSERT INTO `periodos_encuesta` (`id_periodo`, `nombre`, `fecha_inicio`, `fecha_fin`, `activo`, `observaciones`, `fecha_creacion`, `anio`) VALUES
(1, 'Indice del año 2026', '2026-05-07', '2026-07-30', 1, '', '2026-06-24 15:11:18', 2026);

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
(137, 41, '¿La migración o desplazamiento mejoró sus condiciones de vida y seguridad?', 'likert', 1, 5, 1, 'MIGRACION'),
(139, 37, 'Durante los últimos 12 meses, ¿necesitó atención médica?', 'select', 1, 999, 1, NULL),
(140, 37, '¿Pudo recibir la atención médica que necesitaba?', 'select', 1, 1000, 1, NULL),
(141, 42, 'En general, ¿cómo evalúa su bienestar personal actualmente?', 'select', 1, 1001, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado_calculo`
--

CREATE TABLE `resultado_calculo` (
  `id_resultado` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `fecha_calculo` datetime DEFAULT current_timestamp(),
  `total_encuestas` int(11) NOT NULL,
  `indice` decimal(10,4) DEFAULT NULL,
  `estado` enum('PRELIMINAR','OFICIAL') DEFAULT 'PRELIMINAR',
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(40, 1, 'Resumen', 10),
(41, 1, 'Migración y Desplazamiento Forzado', 8),
(42, 1, 'Bienestar Social', 9);

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
(11, 'admin@somoscdc.org', 'admin@somoscdc.org', 'Administrador', 'General', '$2a$12$KpWe.zPDK7UuxhJNfmLX/eY8AlKkt5yqXhN3aiSDaizcxBWEIg7RS', 5, '2026-06-26 09:52:54', 1, '2026-06-23 19:08:00', NULL, 1, '32949365', NULL),
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
-- Indices de la tabla `dimensiones`
--
ALTER TABLE `dimensiones`
  ADD PRIMARY KEY (`id_dimension`);

--
-- Indices de la tabla `encabezado_encuesta`
--
ALTER TABLE `encabezado_encuesta`
  ADD PRIMARY KEY (`id_encuesta`),
  ADD KEY `id_periodo` (`id_periodo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_organizacion` (`id_organizacion`);

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
-- Indices de la tabla `indicadores`
--
ALTER TABLE `indicadores`
  ADD PRIMARY KEY (`id_indicador`),
  ADD KEY `fk_indicador_dimension` (`id_dimension`);

--
-- Indices de la tabla `indicador_pregunta`
--
ALTER TABLE `indicador_pregunta`
  ADD PRIMARY KEY (`id_indicador`,`id_pregunta`),
  ADD KEY `fk_ip_pregunta` (`id_pregunta`);

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
-- Indices de la tabla `periodos_encuesta`
--
ALTER TABLE `periodos_encuesta`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `idx_pregunta_seccion` (`id_seccion`);

--
-- Indices de la tabla `resultado_calculo`
--
ALTER TABLE `resultado_calculo`
  ADD PRIMARY KEY (`id_resultado`),
  ADD KEY `fk_resultado_periodo` (`id_periodo`);

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
  MODIFY `id_detalle` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=348;

--
-- AUTO_INCREMENT de la tabla `dimensiones`
--
ALTER TABLE `dimensiones`
  MODIFY `id_dimension` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encabezado_encuesta`
--
ALTER TABLE `encabezado_encuesta`
  MODIFY `id_encuesta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT de la tabla `indicadores`
--
ALTER TABLE `indicadores`
  MODIFY `id_indicador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `opciones_pregunta`
--
ALTER TABLE `opciones_pregunta`
  MODIFY `id_opcion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT de la tabla `organizaciones`
--
ALTER TABLE `organizaciones`
  MODIFY `id_organizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `periodos_encuesta`
--
ALTER TABLE `periodos_encuesta`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id_pregunta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de la tabla `resultado_calculo`
--
ALTER TABLE `resultado_calculo`
  MODIFY `id_resultado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
  ADD CONSTRAINT `encabezado_encuesta_ibfk_1` FOREIGN KEY (`id_periodo`) REFERENCES `periodos_encuesta` (`id_periodo`),
  ADD CONSTRAINT `encabezado_encuesta_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `encabezado_encuesta_ibfk_3` FOREIGN KEY (`id_organizacion`) REFERENCES `organizaciones` (`id_organizacion`);

--
-- Filtros para la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD CONSTRAINT `encuestas_ibfk_1` FOREIGN KEY (`id_formulario`) REFERENCES `formularios` (`id_formulario`),
  ADD CONSTRAINT `encuestas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `indicadores`
--
ALTER TABLE `indicadores`
  ADD CONSTRAINT `fk_indicador_dimension` FOREIGN KEY (`id_dimension`) REFERENCES `dimensiones` (`id_dimension`);

--
-- Filtros para la tabla `indicador_pregunta`
--
ALTER TABLE `indicador_pregunta`
  ADD CONSTRAINT `fk_ip_indicador` FOREIGN KEY (`id_indicador`) REFERENCES `indicadores` (`id_indicador`),
  ADD CONSTRAINT `fk_ip_pregunta` FOREIGN KEY (`id_pregunta`) REFERENCES `preguntas` (`id_pregunta`);

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
-- Filtros para la tabla `resultado_calculo`
--
ALTER TABLE `resultado_calculo`
  ADD CONSTRAINT `fk_resultado_periodo` FOREIGN KEY (`id_periodo`) REFERENCES `periodos_encuesta` (`id_periodo`);

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
