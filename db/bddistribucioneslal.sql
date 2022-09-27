-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-08-2022 a las 05:28:12
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bddistribucioneslal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `codigo` int(11) NOT NULL,
  `nombre` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`codigo`, `nombre`) VALUES
(1, 'Verduras'),
(2, 'Frutas'),
(3, 'Bebidas'),
(4, 'Lacteos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `codigo` int(11) NOT NULL,
  `ruc` char(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `direccion` varchar(40) NOT NULL,
  `celular` char(9) NOT NULL,
  `correo` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`codigo`, `ruc`, `nombre`, `direccion`, `celular`, `correo`) VALUES
(1, '92726253731', 'Casa Andina', 'Los portales #242', '927353632', 'casaandina@gmail.com'),
(2, '92873537731', 'Baldoria', 'Los Girasoles #345', '927933632', 'baldoria@gmail.com'),
(3, '94726352770', 'Bar & Loche', 'Los Incas #533', '957153605', 'baryloche@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `codigoCom` char(18) NOT NULL,
  `fechaEmisión` char(18) DEFAULT NULL,
  `codigoPro` char(18) DEFAULT NULL,
  `codigoUsu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompra`
--

CREATE TABLE `detallecompra` (
  `codigo` int(11) NOT NULL,
  `codigoCom` char(18) NOT NULL,
  `codigoSol` char(18) DEFAULT NULL,
  `cantidad` char(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `numeroPed` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `descripcion` varchar(20) DEFAULT NULL,
  `codigoPre` int(11) NOT NULL,
  `codigoUni` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`numeroPed`, `cantidad`, `descripcion`, `codigoPre`, `codigoUni`) VALUES
(3, 14, '', 1, 1),
(4, 20, '', 1, 1),
(4, 60, '', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesolicitud`
--

CREATE TABLE `detallesolicitud` (
  `codigo` int(11) NOT NULL,
  `codigoSol` char(18) NOT NULL,
  `cantidadSolicitada` char(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `numero` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` enum('Pendiente','Confirmado','Preparado','En camino','Entregado','Rechazado','Anulado') NOT NULL DEFAULT 'Pendiente',
  `pagado` tinyint(1) NOT NULL DEFAULT 0,
  `direccionEnt` varchar(40) NOT NULL,
  `codigoCli` int(11) NOT NULL,
  `fechaEnt` date NOT NULL,
  `referenciaEnt` varchar(40) DEFAULT NULL,
  `telefonoEnt` char(9) NOT NULL,
  `codigoUsu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`numero`, `fecha`, `estado`, `pagado`, `direccionEnt`, `codigoCli`, `fechaEnt`, `referenciaEnt`, `telefonoEnt`, `codigoUsu`) VALUES
(3, '2022-08-30 15:36:17', 'Confirmado', 0, 'sdaads', 1, '2022-08-30', 'qeqw', '132123123', 1),
(4, '2022-08-30 15:39:07', 'Pendiente', 0, 'Av jorge chavez 200', 1, '2022-08-30', 'hospital almanzor', '922556656', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `codigo` int(11) NOT NULL,
  `codigoProd` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `precio` double NOT NULL,
  `cantidad` double NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT 1,
  `codigoUnidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`codigo`, `codigoProd`, `descripcion`, `precio`, `cantidad`, `disponible`, `codigoUnidad`) VALUES
(1, 1, 'Flakee', 2.5, 70, 1, 1),
(2, 2, 'Pulpa Blanca', 3, 85, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codigo` int(11) NOT NULL,
  `codigoCat` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codigo`, `codigoCat`, `nombre`, `disponible`) VALUES
(1, 1, 'Zanahoria', 1),
(2, 2, 'Durazno', 1),
(3, 2, 'Tomate', 1),
(4, 1, 'Papa', 1),
(5, 2, 'Manzana', 1),
(6, 2, 'Pera', 1),
(7, 1, 'Berengena', 1),
(8, 1, 'Cebolla', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `codigoPro` char(18) NOT NULL,
  `nombre` char(18) DEFAULT NULL,
  `telefono` char(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolusuario`
--

CREATE TABLE `rolusuario` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rolusuario`
--

INSERT INTO `rolusuario` (`codigo`, `nombre`) VALUES
(1, 'Cliente'),
(2, 'Gerente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `codigoSol` char(18) NOT NULL,
  `fechaEmision` char(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `codigo` int(11) NOT NULL,
  `dni` char(8) NOT NULL,
  `apellidoPat` varchar(30) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidoMat` varchar(30) NOT NULL,
  `vigente` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`codigo`, `dni`, `apellidoPat`, `nombres`, `apellidoMat`, `vigente`) VALUES
(1, '78635372', 'Lopez', 'Juan', 'Rioja', 1);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE `unidad` (
  `codigo` int(11) NOT NULL,
  `codigoUni` int(11) DEFAULT NULL,
  `nombre` varchar(20) NOT NULL,
  `equivalencia` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`codigo`, `codigoUni`, `nombre`, `equivalencia`) VALUES
(1, NULL, 'kg', 'ato'),
(2, NULL, 'kg', 'ato');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codigo` int(11) NOT NULL,
  `login` char(8) NOT NULL,
  `contraseña` varchar(500) NOT NULL,
  `vigente` tinyint(1) NOT NULL DEFAULT 1,
  `codigoCli` int(11) DEFAULT NULL,
  `codigoRolUsu` int(11) NOT NULL,
  `codigoTra` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codigo`, `login`, `contraseña`, `vigente`, `codigoCli`, `codigoRolUsu`, `codigoTra`) VALUES
(1, '78635372', '3a824154b16ed7dab899bf000b80eeee', 1, NULL, 2, 1);
INSERT INTO `usuario` (`codigo`, `login`, `contraseña`, `vigente`, `codigoCli`, `codigoRolUsu`, `codigoTra`) VALUES
(2, '71430125', 'd94d81a75c0e8c0aef4e46a08206426b', 1, 2, 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`codigoCom`),
  ADD KEY `R_72` (`codigoPro`),
  ADD KEY `R_79` (`codigoUsu`);

--
-- Indices de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD PRIMARY KEY (`codigo`,`codigoCom`),
  ADD KEY `R_74` (`codigoCom`),
  ADD KEY `R_75` (`codigoSol`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`numeroPed`,`codigoPre`),
  ADD KEY `R_56` (`codigoPre`),
  ADD KEY `R_57` (`codigoUni`);

--
-- Indices de la tabla `detallesolicitud`
--
ALTER TABLE `detallesolicitud`
  ADD PRIMARY KEY (`codigo`,`codigoSol`),
  ADD KEY `R_70` (`codigoSol`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `R_4` (`codigoCli`),
  ADD KEY `R_64` (`codigoUsu`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `R_48` (`codigoProd`),
  ADD KEY `R_77` (`codigoUnidad`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `R_43` (`codigoCat`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`codigoPro`);

--
-- Indices de la tabla `rolusuario`
--
ALTER TABLE `rolusuario`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`codigoSol`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `R_60` (`codigoUni`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `R_62` (`codigoTra`),
  ADD KEY `R_63` (`codigoCli`),
  ADD KEY `R_66` (`codigoRolUsu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `rolusuario`
--
ALTER TABLE `rolusuario`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `unidad`
--
ALTER TABLE `unidad`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `R_72` FOREIGN KEY (`codigoPro`) REFERENCES `proveedor` (`codigoPro`),
  ADD CONSTRAINT `R_79` FOREIGN KEY (`codigoUsu`) REFERENCES `usuario` (`codigo`);

--
-- Filtros para la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD CONSTRAINT `R_73` FOREIGN KEY (`codigo`) REFERENCES `presentacion` (`codigo`),
  ADD CONSTRAINT `R_74` FOREIGN KEY (`codigoCom`) REFERENCES `compra` (`codigoCom`),
  ADD CONSTRAINT `R_75` FOREIGN KEY (`codigoSol`) REFERENCES `solicitud` (`codigoSol`);

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `R_5` FOREIGN KEY (`numeroPed`) REFERENCES `pedido` (`numero`),
  ADD CONSTRAINT `R_56` FOREIGN KEY (`codigoPre`) REFERENCES `presentacion` (`codigo`),
  ADD CONSTRAINT `R_57` FOREIGN KEY (`codigoUni`) REFERENCES `unidad` (`codigo`);

--
-- Filtros para la tabla `detallesolicitud`
--
ALTER TABLE `detallesolicitud`
  ADD CONSTRAINT `R_69` FOREIGN KEY (`codigo`) REFERENCES `presentacion` (`codigo`),
  ADD CONSTRAINT `R_70` FOREIGN KEY (`codigoSol`) REFERENCES `solicitud` (`codigoSol`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `R_4` FOREIGN KEY (`codigoCli`) REFERENCES `cliente` (`codigo`),
  ADD CONSTRAINT `R_64` FOREIGN KEY (`codigoUsu`) REFERENCES `usuario` (`codigo`);

--
-- Filtros para la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD CONSTRAINT `R_48` FOREIGN KEY (`codigoProd`) REFERENCES `producto` (`codigo`),
  ADD CONSTRAINT `R_77` FOREIGN KEY (`codigoUnidad`) REFERENCES `unidad` (`codigo`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `R_43` FOREIGN KEY (`codigoCat`) REFERENCES `categoria` (`codigo`);

--
-- Filtros para la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD CONSTRAINT `R_60` FOREIGN KEY (`codigoUni`) REFERENCES `unidad` (`codigo`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `R_62` FOREIGN KEY (`codigoTra`) REFERENCES `trabajador` (`codigo`),
  ADD CONSTRAINT `R_63` FOREIGN KEY (`codigoCli`) REFERENCES `cliente` (`codigo`),
  ADD CONSTRAINT `R_66` FOREIGN KEY (`codigoRolUsu`) REFERENCES `rolusuario` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
