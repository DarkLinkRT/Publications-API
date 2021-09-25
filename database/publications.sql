-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-09-2021 a las 07:04:11
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `publications`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `controller` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `action` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publications`
--

CREATE TABLE `publications` (
  `id` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `title` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `user_id` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `publications`
--

INSERT INTO `publications` (`id`, `title`, `description`, `user_id`, `active`, `deleted`, `created`) VALUES
('614eaa4955949', 'titulo', 'descripcion', 'fba56bd9-b1c2-11eb-ae70-0021ccb8b7e2', 1, 0, '2021-09-24 23:49:13'),
('72623f8a-9835-419c-9811-46ea20546312', 'titulo', 'descripcion', 'fba56bd9-b1c2-11eb-ae70-0021ccb8b7e2', 1, 0, '2021-09-24 23:50:49'),
('c1b10920-8760-4b7d-a1a5-313fe8842032', 'Inicio de publicaciónS', 'Candy jelly beans powder brownie biscuit. Jelly marzipan oat cake cake. Cupcake I love wafer cake. Halvah I love powder jelly I love cheesecake cotton candy tiramisu brownie.', 'fba56bd9-b1c2-11eb-ae70-0021ccb8b7e2', 1, 0, '2021-09-15 12:27:35'),
('e2f24564-9e86-4008-b2a4-487eb677bdaa', 'Contenido', 'descripcion de prueba', 'fba56bd9-b1c2-11eb-ae70-0021ccb8b7e2', 1, 1, '2021-09-16 04:18:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `active`, `deleted`, `created`, `modified`) VALUES
('2d16d379-3a35-4fa2-b6db-6fd74808a3e5', 'Usuario de registro', 'Usuario para agregar publicaciones', 1, 0, '2021-09-14 23:00:59', '2021-09-14 23:36:14'),
('4105f8cb-112d-44a6-8d06-41989dd14a92', 'Administrador', 'Administrador del sistema', 1, 0, '2021-04-30 14:51:20', '2021-05-15 14:09:34'),
('42d9523f-a62e-4f0d-a4af-a821167a0f35', 'Usuario de registro y actualización', 'Usuario para crear publicaciones y actualizarlos', 1, 0, '2021-09-14 23:03:07', '2021-09-14 23:33:08'),
('4ab19130-67fa-418c-9f39-513d1325977b', 'Usuario de acceso', 'Rol de usuario básico', 1, 0, '2021-05-14 14:15:45', '2021-09-14 23:33:35'),
('54a73610-9e57-4714-a448-7f488df29a5a', 'Usuario de consulta', 'Usuario para consultar las publicaciones', 1, 0, '2021-09-14 22:59:49', '2021-09-14 23:33:47'),
('b44e618c-c4a6-47df-8a32-2921ad3f5206', 'Gestor de publicaciones', 'Usuario que podra agregar, editar y eliminar publicaciones', 1, 0, '2021-09-14 23:26:32', '2021-09-14 23:32:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `id` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `role_id` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `permission_id` char(36) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `role_id` char(36) COLLATE utf8_spanish_ci NOT NULL,
  `user` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `last_name` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `mother_last_name` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role_id`, `user`, `password`, `name`, `last_name`, `mother_last_name`, `email`, `active`, `deleted`, `created`, `modified`) VALUES
('374c14b4-9989-47d2-8fa4-da2dad32cb69', '54a73610-9e57-4714-a448-7f488df29a5a', 'mariana', '$2y$10$EJ.QRFNxRxDVXhgAMO47Eeg1e3cKzeI4rSey0KoyEPfqk448PlXN.', 'Mariana', 'Hernandez', 'Sandoval', 'mariana@gmail.com', 1, 0, '2021-09-16 03:14:58', '2021-09-16 03:25:29'),
('4b8d094c-eab6-47c2-a3ee-e90a7e5ecf02', '4ab19130-67fa-418c-9f39-513d1325977b', 'jorge', '$2y$10$ycQFcU/tLkVP3d41v5TVF.xPHLj2CZEa.rn3Gq7dPOcL9OtAppXeu', 'Jorge', 'Itza', 'Gomez', 'jorgeitza023@gmail.com', 1, 0, '2021-05-24 14:58:01', '2021-09-15 23:41:19'),
('559c4399-d692-4834-ada3-7432f4477e76', '2d16d379-3a35-4fa2-b6db-6fd74808a3e5', 'alex', '$2y$10$EJ.QRFNxRxDVXhgAMO47Eeg1e3cKzeI4rSey0KoyEPfqk448PlXN.', 'Alex', 'Shepherd', 'G', 'jorgeitza098@hotmail.com', 1, 0, '2021-09-16 02:36:23', '2021-09-16 03:54:39'),
('e055e238-a0d5-4983-8e05-48c3f665d54e', '42d9523f-a62e-4f0d-a4af-a821167a0f35', 'cheryl', '$2y$10$EJ.QRFNxRxDVXhgAMO47Eeg1e3cKzeI4rSey0KoyEPfqk448PlXN.', 'Cheryl', 'Mason', 'M', 'cheryl@gmail.com', 1, 0, '2021-09-16 03:13:45', '2021-09-16 04:08:22'),
('e27761da-d185-4e05-a12e-605bdd52a9e0', 'b44e618c-c4a6-47df-8a32-2921ad3f5206', 'alessa', '$2y$10$EJ.QRFNxRxDVXhgAMO47Eeg1e3cKzeI4rSey0KoyEPfqk448PlXN.', 'Alessa', 'Gillespie', 'G', 'alessagillespie9y@hotmail.com', 1, 0, '2021-09-16 02:37:37', '2021-09-16 02:37:37'),
('fba56bd9-b1c2-11eb-ae70-0021ccb8b7e2', '4105f8cb-112d-44a6-8d06-41989dd14a92', 'admin', '$2y$10$EJ.QRFNxRxDVXhgAMO47Eeg1e3cKzeI4rSey0KoyEPfqk448PlXN.', 'Jodelle', 'Ferland', 'Micah', 'alessagillespie9y@hotmail.com', 1, 0, '2021-05-10 14:07:37', '2021-09-16 01:45:37');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `co_group_id` (`role_id`),
  ADD KEY `co_permission_id` (`permission_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `co_group_id` (`role_id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `publications`
--
ALTER TABLE `publications`
  ADD CONSTRAINT `publications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD CONSTRAINT `roles_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `roles_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
