-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2023 a las 05:51:52
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `siste_reportes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_usuarios`
--

CREATE TABLE `admin_usuarios` (
  `Id` mediumint(9) NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Contrasena` varchar(100) NOT NULL,
  `Rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admin_usuarios`
--

INSERT INTO `admin_usuarios` (`Id`, `Usuario`, `Contrasena`, `Rol`) VALUES
(1, 'Admin', '1234', 'Super'),
(2, 'Erick', '1234', 'Tecnico'),
(3, 'prestamos', '1234', 'Prestamos'),
(4, 'rol2', '1234', 'Impresoras'),
(5, 'rol3', '1234', 'Tecnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

CREATE TABLE `catalogo` (
  `Producto` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `catalogo`
--

INSERT INTO `catalogo` (`Producto`) VALUES
('Laptop'),
('Tablet'),
('Proyector'),
('Smart Phone'),
('Escáner  de documentos'),
('Impresora'),
('Disco Duro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `contrasena` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`id`, `username`, `contrasena`) VALUES
(1, 'erick', '6886badb36b23129002bbbae0d9432d0'),
(2, 'admin', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencias`
--

CREATE TABLE `dependencias` (
  `nombre` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dependencias`
--

INSERT INTO `dependencias` (`nombre`) VALUES
('REGIDORES'),
('PRESIDENCIA MUNICIPAL'),
('DIRECCION DE COMUNICACION SOCIAL'),
('DIRECCION DE PARTICIPACIÓN CIUDADANA'),
('PARTICIPACION CIUDADANA'),
('PROYECTOS ESTRATEGICOS'),
('JUZGADO CIVICO'),
('PROCURADURIA DE PROTECCION PARA NIÑAS, NIÑOS Y ADOLESCENTES'),
('OFICINA DE RESILIENCIA'),
(' SECRETARIA DEL AYUNTAMIENTO'),
('DIRECCION DEL REGISTRO CIVIL'),
('DIRECCIÓN DE ABASTO Y COMERCIALIZACIÓN'),
('OFICIALIA MAYOR'),
('DIRECCION DE SISTEMAS'),
('DIRECCION DE RECURSOS HUMANOS'),
('DIRECCION DE RECURSOS MATERIALES Y CONTROL PATRIMONIAL'),
('DIRECCIÓN DE SERVICIOS GENERALES Y EVENTOS ESPECIALES'),
('DIRECCION DE TALLER MECANICO'),
('TESORERIA'),
('DIRECCION DE INGRESOS'),
('DIRECCION DE EGRESOS Y CONTABILIDAD'),
('DIRECCION DE INSPECCION Y LICENCIAS'),
('DIRECCION DE CATASTRO'),
('DIRECCION GENERAL DE ASUNTOS JURIDICOS'),
('DIRECCIÓN GENERAL DE SERVICIOS PUBLICOS'),
('DIRECCION DE LIMPIA Y SANIDAD'),
('DIRECCIÓN DE PARQUES, JARDINES Y ÁREAS VERDES'),
('DIRECCION DE ALUMBRADO PUBLICO'),
('DIRECCIÓN GENERAL DE DESARROLLO URBANO Y MEDIO AMBIENTE'),
('DIRECCIÓN DE DESARROLLO URBANO'),
('DIRECCION DE ECOLOGIA Y MEDIO AMBIENTE'),
('CONTRALORIA MUNICIPAL'),
('POLICÍA MUNICIPAL DE COLIMA'),
('DIRECCION DE SEGURIDAD PUBLICA Y POLICIA VIAL'),
('DIRECCION DE AREA ADMINISTRATIVA'),
('DIRECCIÓN GENERAL DE DESARROLLO ECONÓMICO, SOCIAL Y HUMANO'),
('DIRECCION DE FOMENTO ECONÓMICO Y MEJORA REGULATORIA'),
('DIRECCIÓN DE DESARROLLO RURAL Y SOCIAL'),
('DIRECCION DE FOMENTO DEPORTIVO'),
('DIRECCIÓN GENERAL ADJUNTA DE EDUCACIÓN, CULTURA Y RECREACIÓN'),
('DIRECCION GENERAL DE OBRAS PUBLICAS'),
('DIRECCION DE CONSTRUCCION'),
('DIRECCION DE MANTENIMIENTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impresoras`
--

CREATE TABLE `impresoras` (
  `ReporteImpresora_id` int(11) NOT NULL,
  `Nombre_Reportante` varchar(150) DEFAULT NULL,
  `Area` varchar(50) DEFAULT NULL,
  `NumeroImpresora` varchar(50) DEFAULT NULL,
  `Fecha_Hora` date DEFAULT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL,
  `Detalle_Pendiente` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `impresoras`
--

INSERT INTO `impresoras` (`ReporteImpresora_id`, `Nombre_Reportante`, `Area`, `NumeroImpresora`, `Fecha_Hora`, `Descripcion`, `Estado`, `Detalle_Pendiente`) VALUES
(3, 'asdasd', 'asdasd', 'asdasd', '2023-11-24', 'aaaa', 0, 'aaaa'),
(5, 'Erick Ortega', 'Depencia test', '123123', '2023-11-15', 'Se atoro papel', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo_equipos`
--

CREATE TABLE `prestamo_equipos` (
  `Prestamo_id` int(11) NOT NULL,
  `Dependencia` varchar(150) DEFAULT NULL,
  `Receptor` varchar(500) DEFAULT NULL,
  `FechaYHora` date DEFAULT NULL,
  `Catalogo` varchar(200) NOT NULL,
  `RequierePersonal` tinyint(1) DEFAULT NULL,
  `FechaDevolucion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamo_equipos`
--

INSERT INTO `prestamo_equipos` (`Prestamo_id`, `Dependencia`, `Receptor`, `FechaYHora`, `Catalogo`, `RequierePersonal`, `FechaDevolucion`) VALUES
(8, 'test', 'erick2', '2023-11-08', 'laptop', 1, '2023-11-24'),
(9, 'aaaa', 'asdasdasd', '2023-11-03', 'asdasdasd', 0, '2023-11-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicoyredes`
--

CREATE TABLE `tecnicoyredes` (
  `ReporteTecnicoID` int(11) NOT NULL,
  `AreaReporte` varchar(150) DEFAULT NULL,
  `NombreReportante` varchar(200) DEFAULT NULL,
  `QueReporta` varchar(500) DEFAULT NULL,
  `Categoria` varchar(200) DEFAULT NULL,
  `Estatus` tinyint(1) DEFAULT NULL,
  `Observaciones` varchar(500) DEFAULT NULL,
  `Otros` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tecnicoyredes`
--

INSERT INTO `tecnicoyredes` (`ReporteTecnicoID`, `AreaReporte`, `NombreReportante`, `QueReporta`, `Categoria`, `Estatus`, `Observaciones`, `Otros`) VALUES
(3, 'Redes', 'Erick Ortega Chacón ', 'asdasd', 'Software', 0, 'adasd2', 'asdasd2'),
(4, 'Sistemas', 'Erick Ortega Chacón ', 'Computadora fallando de pantalla', 'Hardware', 1, 'sin observaciones', ''),
(5, 'sdasd', 'asdasd', NULL, NULL, 1, 'sin observaciones', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin_usuarios`
--
ALTER TABLE `admin_usuarios`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `impresoras`
--
ALTER TABLE `impresoras`
  ADD PRIMARY KEY (`ReporteImpresora_id`);

--
-- Indices de la tabla `prestamo_equipos`
--
ALTER TABLE `prestamo_equipos`
  ADD PRIMARY KEY (`Prestamo_id`);

--
-- Indices de la tabla `tecnicoyredes`
--
ALTER TABLE `tecnicoyredes`
  ADD PRIMARY KEY (`ReporteTecnicoID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin_usuarios`
--
ALTER TABLE `admin_usuarios`
  MODIFY `Id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `impresoras`
--
ALTER TABLE `impresoras`
  MODIFY `ReporteImpresora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `prestamo_equipos`
--
ALTER TABLE `prestamo_equipos`
  MODIFY `Prestamo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tecnicoyredes`
--
ALTER TABLE `tecnicoyredes`
  MODIFY `ReporteTecnicoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
