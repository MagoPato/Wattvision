-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2024 a las 22:57:28
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
-- Base de datos: `wattvision`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos`
--

CREATE TABLE `dispositivos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `costo_estimado` decimal(16,2) DEFAULT NULL,
  `estatus` tinyint(2) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `dispositivos`
--

INSERT INTO `dispositivos` (`id`, `usuario_id`, `nombre`, `costo_estimado`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dispositivo 1', 250.00, 1, '2024-11-05 18:38:32', '2024-11-06 19:56:24'),
(2, 1, 'Dispositivo 2', 500.00, 1, '2024-11-05 18:38:45', '2024-11-06 18:43:56'),
(3, 1, 'Dispositivo 3', 50.00, 1, '2024-11-05 18:39:02', '2024-11-05 18:39:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas_dispositivos`
--

CREATE TABLE `entradas_dispositivos` (
  `id` int(11) NOT NULL,
  `dispositivo_id` int(11) DEFAULT NULL,
  `entrada` varchar(200) DEFAULT NULL,
  `estatus` tinyint(2) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `numero_entradas` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `entradas_dispositivos`
--

INSERT INTO `entradas_dispositivos` (`id`, `dispositivo_id`, `entrada`, `estatus`, `created_at`, `updated_at`, `numero_entradas`) VALUES
(1, 1, 'Entrada 1', 1, '2024-11-05 18:39:25', '2024-11-06 18:02:58', 1),
(2, 1, 'Entrada 2', 1, '2024-11-05 18:39:51', '2024-11-06 18:03:03', 2),
(3, 1, 'Entrada 3', 1, '2024-11-05 18:39:57', '2024-11-06 18:03:06', 3),
(4, 1, 'Entrada 4', 1, '2024-11-05 18:40:04', '2024-11-06 18:03:11', 4),
(5, 1, 'Entrada 5', 1, '2024-11-05 18:40:10', '2024-11-06 18:03:14', 5),
(6, 2, 'Entrada 1', 1, '2024-11-05 18:40:23', '2024-11-06 18:03:19', 1),
(7, 2, 'Entrada 2', 1, '2024-11-05 18:40:32', '2024-11-06 18:03:29', 2),
(8, 2, 'Entrada 3', 1, '2024-11-05 18:40:46', '2024-11-06 18:03:34', 3),
(9, 2, 'Entrada 4', 1, '2024-11-05 18:40:57', '2024-11-06 18:03:37', 4),
(10, 3, 'Entrada 1', 1, '2024-11-05 18:41:05', '2024-11-06 18:03:42', 1),
(11, 3, 'Entrada 2', 1, '2024-11-05 18:41:15', '2024-11-06 18:03:48', 2),
(12, 3, 'Entrada 3', 1, '2024-11-05 18:41:21', '2024-11-06 18:03:51', 3),
(13, 3, 'Entrada 4', 1, '2024-11-05 18:41:28', '2024-11-06 18:03:54', 4),
(14, 3, 'Entrada 5', 1, '2024-11-05 18:41:33', '2024-11-06 18:03:56', 5),
(15, 3, 'Entrada 6', 1, '2024-11-05 18:41:38', '2024-11-06 18:03:59', 6),
(16, 3, 'Entrada 7', 1, '2024-11-05 18:41:48', '2024-11-06 18:04:02', 7),
(17, 3, 'Entrada 8', 1, '2024-11-05 18:41:53', '2024-11-06 18:04:07', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_consumo`
--

CREATE TABLE `estados_consumo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `consumo` decimal(16,2) DEFAULT NULL,
  `costo` decimal(16,2) DEFAULT NULL,
  `mes_id` int(11) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  `estatus` tinyint(2) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estados_consumo`
--

INSERT INTO `estados_consumo` (`id`, `usuario_id`, `consumo`, `costo`, `mes_id`, `anio`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 1, 240.00, 180.00, 1, 2019, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(2, 1, 270.00, 202.50, 2, 2019, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(3, 1, 290.00, 217.50, 3, 2019, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(4, 1, 360.00, 270.00, 4, 2019, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(5, 1, 490.00, 367.50, 5, 2019, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(6, 1, 620.00, 465.00, 6, 2019, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(7, 1, 910.00, 682.50, 7, 2019, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(8, 1, 1060.00, 795.00, 8, 2019, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(9, 1, 740.00, 555.00, 9, 2019, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(10, 1, 440.00, 330.00, 10, 2019, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(11, 1, 290.00, 217.50, 11, 2019, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(12, 1, 130.00, 97.50, 12, 2019, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(13, 1, 250.00, 187.50, 1, 2020, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(14, 1, 280.00, 210.00, 2, 2020, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(15, 1, 300.00, 225.00, 3, 2020, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(16, 1, 370.00, 277.50, 4, 2020, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(17, 1, 500.00, 375.00, 5, 2020, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(18, 1, 630.00, 472.50, 6, 2020, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(19, 1, 930.00, 697.50, 7, 2020, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(20, 1, 1080.00, 810.00, 8, 2020, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(21, 1, 750.00, 562.50, 9, 2020, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(22, 1, 450.00, 337.50, 10, 2020, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(23, 1, 300.00, 225.00, 11, 2020, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(24, 1, 140.00, 105.00, 12, 2020, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(25, 1, 268.00, 201.00, 1, 2021, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(26, 1, 300.00, 225.00, 2, 2021, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(27, 1, 320.00, 240.00, 3, 2021, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(28, 1, 373.00, 279.75, 4, 2021, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(29, 1, 523.00, 392.25, 5, 2021, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(30, 1, 654.00, 490.50, 6, 2021, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(31, 1, 966.00, 724.50, 7, 2021, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(32, 1, 1094.00, 820.50, 8, 2021, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(33, 1, 768.00, 576.00, 9, 2021, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(34, 1, 467.00, 350.25, 10, 2021, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(35, 1, 311.00, 233.25, 11, 2021, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(36, 1, 150.00, 112.50, 12, 2021, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(37, 1, 210.00, 157.50, 1, 2022, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(38, 1, 285.00, 213.75, 2, 2022, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(39, 1, 390.00, 292.50, 3, 2022, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(40, 1, 423.00, 317.25, 4, 2022, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(41, 1, 600.00, 450.00, 5, 2022, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(42, 1, 750.00, 562.50, 6, 2022, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(43, 1, 1001.00, 750.75, 7, 2022, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(44, 1, 1568.00, 1176.00, 8, 2022, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(45, 1, 1145.00, 858.75, 9, 2022, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(46, 1, 750.00, 562.50, 10, 2022, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(47, 1, 433.00, 324.75, 11, 2022, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(48, 1, 178.00, 133.50, 12, 2022, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(49, 1, 190.00, 142.50, 1, 2023, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(50, 1, 287.00, 215.25, 2, 2023, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(51, 1, 401.00, 300.75, 3, 2023, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(52, 1, 467.00, 350.25, 4, 2023, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(53, 1, 590.00, 442.50, 5, 2023, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(54, 1, 699.00, 524.25, 6, 2023, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(55, 1, 896.00, 672.00, 7, 2023, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(56, 1, 1218.00, 913.50, 8, 2023, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(57, 1, 989.00, 741.75, 9, 2023, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(58, 1, 704.00, 528.00, 10, 2023, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(59, 1, 456.00, 342.00, 11, 2023, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(60, 1, 100.00, 75.00, 12, 2023, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(61, 1, 205.00, 153.75, 1, 2024, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(62, 1, 314.00, 235.50, 2, 2024, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(63, 1, 386.00, 289.50, 3, 2024, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20'),
(64, 1, 459.00, 344.25, 4, 2024, 1, '2024-11-05 18:37:20', '2024-11-05 18:37:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `meses`
--

CREATE TABLE `meses` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `abreviado` varchar(50) DEFAULT NULL,
  `estatus` tinyint(2) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `meses`
--

INSERT INTO `meses` (`id`, `nombre`, `abreviado`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Enero', 'Ene', 1, '2024-11-05 18:15:33', '2024-11-05 18:15:53'),
(2, 'Febrero', 'Feb', 1, '2024-11-05 18:16:05', '2024-11-05 18:16:05'),
(3, 'Marzo', 'Mar', 1, '2024-11-05 18:16:33', '2024-11-05 18:16:33'),
(4, 'Abril', 'Abr', 1, '2024-11-05 18:16:40', '2024-11-05 18:17:41'),
(5, 'Mayo', 'May', 1, '2024-11-05 18:16:46', '2024-11-05 18:17:39'),
(6, 'Junio', 'Jun', 1, '2024-11-05 18:16:52', '2024-11-05 18:17:46'),
(7, 'Julio', 'Jul', 1, '2024-11-05 18:17:06', '2024-11-05 18:17:53'),
(8, 'Agosto', 'Ago', 1, '2024-11-05 18:17:12', '2024-11-05 18:17:58'),
(9, 'Septiembre', 'Sep', 1, '2024-11-05 18:17:19', '2024-11-05 18:18:05'),
(10, 'Octubre', 'Oct', 1, '2024-11-05 18:17:24', '2024-11-05 18:18:10'),
(11, 'Noviembre', 'Nov', 1, '2024-11-05 18:17:35', '2024-11-05 18:18:14'),
(12, 'Diciembre', 'Dic', 1, '2024-11-05 18:18:24', '2024-11-05 18:18:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `estatus` tinyint(2) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `email`, `password`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Pato', 'pato@gmail.com', '25f9e794323b453885f5181f1b624d0b', 1, '2024-11-05 18:21:20', '2024-11-05 18:21:20'),
(4, 'miel', 'miel@gmail.com', 'c61e180d2265ab9d10c89e49a5c1e5d6', 1, '2024-11-05 23:02:19', '2024-11-05 23:02:19'),
(5, 'pato1', 'pato1@gamil.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2024-11-06 18:06:02', '2024-11-06 18:06:02'),
(6, 'jesus', 'jesus@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2024-11-06 18:28:25', '2024-11-06 18:28:25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entradas_dispositivos`
--
ALTER TABLE `entradas_dispositivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados_consumo`
--
ALTER TABLE `estados_consumo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `meses`
--
ALTER TABLE `meses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `entradas_dispositivos`
--
ALTER TABLE `entradas_dispositivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `estados_consumo`
--
ALTER TABLE `estados_consumo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `meses`
--
ALTER TABLE `meses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
