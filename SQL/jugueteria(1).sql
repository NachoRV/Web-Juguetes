-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 28-04-2017 a las 11:03:00
-- Versión del servidor: 5.6.33
-- Versión de PHP: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jugueteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juguete`
--

CREATE TABLE `juguete` (
  `id_juguete` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `tematica` varchar(100) DEFAULT NULL,
  `edad_minima` int(11) DEFAULT NULL,
  `imagen` varchar(200) NOT NULL,
  `tienda` varchar(50) NOT NULL,
  `oferta` int(11) NOT NULL DEFAULT '0',
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `juguete`
--

INSERT INTO `juguete` (`id_juguete`, `nombre`, `tematica`, `edad_minima`, `imagen`, `tienda`, `oferta`, `precio`) VALUES
(1, 'Coche Electrico ', 'motor', 20, 'catalogo/cocheelectrico.jpg', '4', 1, 0),
(3, 'Cubo Rubik', 'lógica', 10, 'catalogo/CuborubikR.png', '5', 0, 5),
(4, 'Miki', 'peluches', 4, 'catalogo/miki.jpg', '6', 1, 0),
(5, 'Tren Madra', 'madera', 1, 'catalogo/trenmadera.jpg', '4', 1, 0),
(6, 'Hombre Araña', 'muñecos', 1, 'catalogo/HombreArana.jpg', '4', 1, 23),
(7, 'Capitan America', 'muñecos', 1, 'catalogo/capitanAmerica.jpg', '4', 0, 18),
(16, 'Lego Star Wars', 'lego', 12, 'catalogo/lego.jpg', '21', 0, 25),
(20, 'Barbi', 'Muñecos', 6, 'catalogo/barbie.jpg', '18', 1, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE `oferta` (
  `id_oferta` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `descuento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`id_oferta`, `fecha_inicio`, `fecha_fin`, `id_producto`, `id_tienda`, `descuento`) VALUES
(2, '2017-04-02', '2017-05-05', 1, 4, 10),
(3, '2017-04-25', '2017-04-30', 3, 5, 5),
(4, '2017-03-01', '2017-03-31', 4, 6, 1),
(9, '2017-04-25', '2017-04-29', 6, 4, 4),
(11, '0000-00-00', '2017-04-30', 20, 18, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `id_tienda` int(11) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`id_tienda`, `ubicacion`, `direccion`) VALUES
(4, 'Madrid', 'C/ Tritón'),
(5, 'Valencia', 'C/ Ponzano '),
(6, 'Murcia', 'Av Siglo XXI'),
(18, 'Madrid', 'Paseo de la castellana'),
(21, 'Barcelona', 'Av Diagonal 1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `juguete`
--
ALTER TABLE `juguete`
  ADD PRIMARY KEY (`id_juguete`);

--
-- Indices de la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`id_oferta`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`id_tienda`),
  ADD UNIQUE KEY `id_tienda` (`id_tienda`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `juguete`
--
ALTER TABLE `juguete`
  MODIFY `id_juguete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
  MODIFY `id_oferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `tienda`
--
ALTER TABLE `tienda`
  MODIFY `id_tienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
