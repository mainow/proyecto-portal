-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2022 a las 20:32:13
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_portal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `profile_img` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `born_date` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `entry_date` varchar(255) NOT NULL,
  `id_key` int(11) NOT NULL,
  `active` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`profile_img`, `first_name`, `last_name`, `id`, `pwd`, `born_date`, `email`, `category`, `entry_date`, `id_key`, `active`) VALUES
('', 'admin', 'admin', 1112223, '$2y$10$uzy/zbL2GzK.8e/BSDxHK.yimg9cn/8uvuelLsmRQY9/aa/qBHPhG', '', '', '', '', 10, 0),
('11-profile-img.png', 'Yanina Godoy', 'Vargas', 654334, '$2y$10$j0tBPhc8I0xLL/PgVnS32OKuB8zfPf2aAgpUKu.ccdJ1X8PfhczaS', '2022-01-01', 'mauri@gmail.com', '41', '2022-01-01', 11, 0),
('12-profile-img.png', 'Roberto', 'Yuran', 2022342, '$2y$10$mMOObMWjm1AsQIWiOTc5Au0tLD6761iPOG4NMCIVSUZANeXLxqePO', '2022-01-01', 'robe@gmail.com', '40', '2022-01-01', 12, 0),
('13-profile-img.png', 'Rupa', 'Repa', 2002821, '$2y$10$5EodNvDRAVqqCwuEKwBkPeYJ5MuaG7sqAsmOU6A8HIHsgF4ZUHU4q', '2022-01-01', 'rupa@gmail.com', '40', '2022-01-01', 13, 1),
('14-profile-img.png', 'Ramona', 'Prota', 2122112, '$2y$10$BpXDbKeWm/6VlXssGm.vDOUGt761wjPEqbm5.3YliDpMcmVSK9ol6', '2022-01-01', 'lua@gmail.com', '40', '2022-01-01', 14, 1),
('15-profile-img.png', 'Juana', 'Yamiaa', 3452233, '$2y$10$KUuo7sTYMrzWIYxmq5L9muusk/Cg1VYLtCBcFCyfWeA8LsOsw7of.', '2022-01-01', 'jua@gmail.com', '41', '2022-01-01', 15, 0),
('16-profile-img.png', 'Robert', 'Duriman', 312312, '$2y$10$zWEa8iKy01vW5tbnG2rf5OjSOTG3ebOGK6lLzQjnw2y/lbTDp4fIS', '2022-01-01', 'eeo@gmail.com', '40', '2022-01-01', 16, 1),
('17-profile-img.png', 'Dieuigto', 'Wwawa', 1231211, '$2y$10$QZT5NeGsUhtChysAejE0vuy5tDSDtSEQIqt4QtcFYk/IMZjCSscze', '2022-01-01', 'diwe@gmail.com', '42', '2022-01-01', 17, 1),
('18-profile-img.png', 'Luan', 'Mereles', 1221122, '$2y$10$lC3wfa03jFKpWXrJS8LIbu8QEa0Ap3f/8WtuUFrC1C32sSiY.owL.', '2022-01-01', 'luan@gmail.com', '40', '2022-01-01', 18, 1),
('19-profile-img.png', 'Miwel', 'Nanawe', 3321121, '$2y$10$uJW6nrxYnbncv4BBlE48uOvyK5XVQ/jMASEtABjV.y8a1d5FbbVF6', '2022-01-01', 'haha@gmail.com', '40', '2022-01-01', 19, 1),
('20-profile-img.png', 'Juanita', 'Suprale', 6652115, '$2y$10$V7o4pGEvcU8MUZLGEl385.NVLXyq84ZqyDiQXhp1E6wdD/AOzXCnO', '2022-01-01', 'juan@gmail.com', '42', '2022-01-01', 20, 1),
('21-profile-img.png', 'Jay', 'Weller', 3321120, '$2y$10$ZC8w8DHoxWm01pNhY4jBXO./kT41GSs0.WMmFD.qm5BEvO4F9KzGC', '2022-01-01', 'as@gmail.com', '40', '2022-01-01', 21, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_key`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
