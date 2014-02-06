-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2013 a las 16:54:05
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sic_bd`
--
CREATE DATABASE IF NOT EXISTS `sic_bd` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `sic_bd`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afijo`
--

CREATE TABLE IF NOT EXISTS `afijo` (
  `codigo` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `fechaCompra` date NOT NULL,
  `vidaEco` int(11) NOT NULL,
  `localizacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `valorRecuperacion` decimal(10,2) NOT NULL,
  `observaciones` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `aniosVida` int(11) NOT NULL,
  `depreciacion` decimal(10,2) NOT NULL,
  `VL` decimal(10,0) NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `afijo`
--

INSERT INTO `afijo` (`codigo`, `descripcion`, `costo`, `fechaCompra`, `vidaEco`, `localizacion`, `valorRecuperacion`, `observaciones`, `aniosVida`, `depreciacion`, `VL`, `estado`) VALUES
(1, 'computadora', '500.00', '2013-11-27', 2, 'Administracion', '100.00', 'ninguna', 0, '200.00', '0', 'sin depreciar'),
(2, 'escritorio', '200.00', '2013-11-27', 5, 'Administracion', '0.00', 'para una persona', 0, '40.00', '0', 'sin depreciar'),
(3, 'sierra', '3000.00', '2013-11-27', 5, 'Produccion', '200.00', '20'' diametro', 0, '560.00', '0', 'sin depreciar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogodecuentas`
--

CREATE TABLE IF NOT EXISTS `catalogodecuentas` (
  `CodCuenta` int(10) NOT NULL,
  `NombreCuenta` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `TipoCuenta` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `tipo2` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`CodCuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `catalogodecuentas`
--

INSERT INTO `catalogodecuentas` (`CodCuenta`, `NombreCuenta`, `TipoCuenta`, `tipo2`) VALUES
(121201, 'terrenos', 'Deudora', 'Activo'),
(121202, 'edificios e instalaciones', 'Deudora', 'Activo'),
(121203, 'maquinaria y equipo de taller', 'Deudora', 'Activo'),
(1111106, 'IVA credito fiscal', 'Deudora', 'Activo'),
(2212103, 'RPP ISSS', 'Acreedora', 'Pasivo'),
(2212105, 'anticipos de clientes', 'Acreedora', 'Pasivo'),
(2212106, 'IVA debito fiscal', 'Acreedora', 'Pasivo'),
(2222201, 'prestamos con garantia', 'Acreedora', 'Pasivo'),
(2222202, 'prestamos sin garantia', 'Acreedora', 'Pasivo'),
(2232301, 'provision para obligaciones laborales', 'Acreedora', 'Pasivo'),
(3313101, 'capital', 'Acreedora', 'Capital'),
(3313103, 'utilidad del ejercicio', 'Acreedora', 'Capital'),
(3323201, 'deficit del presente ejercicio', 'Deudora', 'Capital'),
(4414101, 'costo de materia prima', 'Deudora', 'Resultado'),
(4414102, 'costo de mano de obra directa', 'Deudora', 'Resultado'),
(4414103, 'Costos indirectos de fabricacion', 'Deudora', 'Resultado'),
(4424201, 'costos de ventas', 'Deudora', 'Resultado'),
(4424202, 'gastos de administracion', 'Deudora', 'Resultado'),
(4424203, 'gastos de venta', 'Deudora', 'Resultado'),
(4424205, 'perdida en venta activi fijo', 'Deudora', 'Resultado'),
(5515101, 'venta', 'Acreedora', 'Resultado'),
(5515102, 'ganancia en venta activo fijo', 'Deudora', 'Resultado'),
(6616101, 'perdida y ganancia', 'Acreedora', 'Resultado'),
(7717101, 'cuenta de orden (deudora)', 'Deudora', 'Resultado'),
(7727201, 'cuenta de orden por contra (acreedora)', 'Acreedora', 'Resultado'),
(12120802, 'DA de maquinaria y equipo de taller', 'Deudora', 'Resultado'),
(12120803, 'DA de mobiliaria y equipo', 'Deudora', 'Resultado'),
(12131301, 'gastos pagados por anticipado', 'Deudora', 'Activo'),
(111110101, 'caja general', 'Deudora', 'Activo'),
(111110102, 'caja chica', 'Deudora', 'Activo'),
(111110201, 'banco cuenta corriente', 'Deudora', 'Activo'),
(111110202, 'banco cuenta de ahorro', 'Deudora', 'Activo'),
(111110301, 'documentos por cobrar', 'Deudora', 'Activo'),
(111110701, 'Inv de producto terminado', 'Deudora', 'Activo'),
(111110702, 'Inv de producto en proceso', 'Deudora', 'Activo'),
(111110703, 'Inv de materia prima', 'Deudora', 'Activo'),
(111110704, 'Inv de materiales y suministros', 'Deudora', 'Activo'),
(111110901, 'seguros', 'Deudora', 'Activo'),
(111110902, 'alquileres', 'Deudora', 'Activo'),
(111110903, 'honorarios', 'Deudora', 'Activo'),
(111110904, 'GAnt papeleria y utiles', 'Deudora', 'Activo'),
(111110905, 'GAnt publicidad y propaganda', 'Deudora', 'Activo'),
(221210201, 'documentos por pagar', 'Acreedora', 'Pasivo'),
(221210202, 'cuentas por pagar a proveedores', 'Acreedora', 'Pasivo'),
(221210302, 'RPP impuestos s/Renta', 'Acreedora', 'Pasivo'),
(221210304, ' RPP AFP', 'Acreedora', 'Pasivo'),
(221210401, 'IPP sobre renta', 'Acreedora', 'Pasivo'),
(221210402, 'IPP sobre patrimonio', 'Acreedora', 'Pasivo'),
(221210403, 'IPP municipales', 'Acreedora', 'Pasivo'),
(442420401, 'gstos finacieros intereses', 'Deudora', 'Resultado'),
(442420402, 'gastos financieros comisiones bancarias', 'Deudora', 'Resultado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `idEmpleado` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cargo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `anios` int(11) NOT NULL,
  `salarioNominal` decimal(10,2) NOT NULL,
  `aguinaldo` decimal(10,2) NOT NULL,
  `vacaciones` decimal(10,2) NOT NULL,
  `isss` decimal(10,2) NOT NULL,
  `afp` decimal(10,2) NOT NULL,
  `salarioreal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios`
--

CREATE TABLE IF NOT EXISTS `inventarios` (
  `codigoinventario` int(5) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioUnitario` decimal(10,2) NOT NULL,
  `montoInventario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `librodiario`
--

CREATE TABLE IF NOT EXISTS `librodiario` (
  `NumeroTransaccion` int(10) NOT NULL,
  `CodigoCuenta` int(10) NOT NULL,
  `CargoLibroDiario` decimal(10,2) NOT NULL,
  `AbonoLibroDiario` decimal(10,2) NOT NULL,
  `FechaLibroDiario` date NOT NULL,
  PRIMARY KEY (`NumeroTransaccion`,`CodigoCuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `librodiario`
--

INSERT INTO `librodiario` (`NumeroTransaccion`, `CodigoCuenta`, `CargoLibroDiario`, `AbonoLibroDiario`, `FechaLibroDiario`) VALUES
(1, 121203, '2000.00', '0.00', '2013-11-25'),
(1, 111110102, '0.00', '2000.00', '2013-11-25'),
(2, 121203, '3000.00', '0.00', '2013-11-25'),
(2, 111110101, '0.00', '3000.00', '2013-11-25'),
(3, 121201, '50.00', '0.00', '2013-11-25'),
(3, 4424202, '0.00', '50.00', '2013-11-25'),
(4, 121201, '76.00', '0.00', '2013-11-25'),
(4, 2222202, '0.00', '76.00', '2013-11-25'),
(5, 2212105, '10.00', '0.00', '2013-11-25'),
(5, 4414101, '0.00', '10.00', '2013-11-25'),
(6, 2222201, '12.00', '0.00', '2013-11-25'),
(6, 3323201, '0.00', '12.00', '2013-11-25'),
(7, 2212105, '12.00', '0.00', '2013-11-25'),
(7, 2212106, '0.00', '12.00', '2013-11-25'),
(8, 4414103, '12.00', '0.00', '2013-11-25'),
(9, 4414101, '12.00', '0.00', '2013-11-25'),
(9, 221210401, '0.00', '12.00', '2013-11-25'),
(10, 3313101, '0.00', '67.00', '2013-11-25'),
(10, 4414102, '67.00', '0.00', '2013-11-25'),
(11, 1111106, '6.00', '0.00', '2013-11-25'),
(11, 2222202, '0.00', '6.00', '2013-11-25'),
(12, 3313103, '0.00', '12.00', '2013-11-25'),
(12, 4414102, '12.00', '0.00', '2013-11-25'),
(13, 2212105, '12.00', '0.00', '2013-11-25'),
(13, 2232301, '0.00', '12.00', '2013-11-25'),
(14, 2232301, '12.00', '0.00', '2013-11-25'),
(14, 4414102, '0.00', '12.00', '2013-11-25'),
(15, 1111106, '13.00', '0.00', '2013-11-25'),
(15, 4424203, '0.00', '13.00', '2013-11-25'),
(16, 4414102, '0.00', '345.00', '2013-11-25'),
(16, 4414103, '345.00', '0.00', '2013-11-25'),
(17, 2212105, '0.00', '999999.00', '2013-11-25'),
(17, 4424201, '999999.00', '0.00', '2013-11-25'),
(18, 4414101, '888888.00', '0.00', '2013-11-25'),
(18, 111110101, '0.00', '888888.00', '2013-11-25'),
(19, 2222201, '0.00', '111111.00', '2013-11-25'),
(19, 111110101, '111111.00', '0.00', '2013-11-25'),
(20, 4414103, '55555.00', '0.00', '2013-11-25'),
(20, 111110101, '0.00', '55555.00', '2013-11-25'),
(21, 2212106, '20.00', '0.00', '2013-11-25'),
(21, 4414101, '0.00', '20.00', '2013-11-25'),
(22, 1111106, '12.00', '0.00', '2013-11-25'),
(22, 4424201, '0.00', '12.00', '2013-11-25'),
(23, 111110101, '0.00', '8000.00', '2013-11-25'),
(23, 111110703, '8000.00', '0.00', '2013-11-25'),
(24, 121203, '56.00', '0.00', '2013-11-27'),
(24, 4414101, '0.00', '56.00', '2013-11-27'),
(25, 123, '5.00', '0.00', '2013-11-27'),
(25, 1234, '0.00', '5.00', '2013-11-27'),
(26, 121202, '60.00', '0.00', '2013-11-28'),
(26, 121203, '0.00', '10.00', '2013-11-28'),
(26, 2212105, '0.00', '50.00', '2013-11-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libromayor`
--

CREATE TABLE IF NOT EXISTS `libromayor` (
  `CodigoLibroMayor` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CodigoCuenta` int(10) NOT NULL,
  `CargoLibroMayor` decimal(10,2) NOT NULL,
  `AbonoLibroMayor` decimal(10,2) NOT NULL,
  `SaldoLibroMayor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`CodigoLibroMayor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=114 ;

--
-- Volcado de datos para la tabla `libromayor`
--

INSERT INTO `libromayor` (`CodigoLibroMayor`, `CodigoCuenta`, `CargoLibroMayor`, `AbonoLibroMayor`, `SaldoLibroMayor`) VALUES
(55, 1212010, '0.00', '0.00', '0.00'),
(56, 121202, '60.00', '0.00', '60.00'),
(57, 121203, '56.00', '10.00', '46.00'),
(58, 1111106, '12.00', '0.00', '12.00'),
(59, 2212103, '0.00', '0.00', '0.00'),
(60, 2212105, '0.00', '50.00', '50.00'),
(61, 2212106, '20.00', '0.00', '-20.00'),
(62, 2222201, '0.00', '0.00', '0.00'),
(63, 2222202, '0.00', '0.00', '0.00'),
(64, 2232301, '0.00', '0.00', '0.00'),
(65, 3313101, '0.00', '0.00', '0.00'),
(66, 3313103, '0.00', '0.00', '0.00'),
(67, 3323201, '0.00', '0.00', '0.00'),
(68, 4414101, '0.00', '56.00', '-56.00'),
(69, 4414102, '0.00', '0.00', '0.00'),
(70, 4414103, '0.00', '0.00', '0.00'),
(71, 4424201, '0.00', '12.00', '-12.00'),
(72, 4424202, '0.00', '0.00', '0.00'),
(73, 4424203, '0.00', '0.00', '0.00'),
(74, 4424205, '0.00', '0.00', '0.00'),
(75, 5515101, '0.00', '0.00', '0.00'),
(76, 5515102, '0.00', '0.00', '0.00'),
(77, 6616101, '0.00', '0.00', '0.00'),
(78, 7717101, '0.00', '0.00', '0.00'),
(79, 7727201, '0.00', '0.00', '0.00'),
(80, 12120801, '0.00', '0.00', '0.00'),
(81, 12120802, '0.00', '0.00', '0.00'),
(82, 12120803, '0.00', '0.00', '0.00'),
(83, 12131301, '0.00', '0.00', '0.00'),
(84, 77777777, '0.00', '0.00', '0.00'),
(85, 111110101, '0.00', '8000.00', '-8000.00'),
(86, 111110102, '0.00', '0.00', '0.00'),
(87, 111110201, '0.00', '0.00', '0.00'),
(88, 111110202, '0.00', '0.00', '0.00'),
(89, 111110301, '0.00', '0.00', '0.00'),
(90, 111110701, '0.00', '0.00', '0.00'),
(91, 111110702, '0.00', '0.00', '0.00'),
(92, 111110703, '8000.00', '0.00', '8000.00'),
(93, 111110704, '0.00', '0.00', '0.00'),
(94, 111110901, '0.00', '0.00', '0.00'),
(95, 111110902, '0.00', '0.00', '0.00'),
(96, 111110903, '0.00', '0.00', '0.00'),
(97, 111110904, '0.00', '0.00', '0.00'),
(98, 111110905, '0.00', '0.00', '0.00'),
(99, 221210201, '0.00', '0.00', '0.00'),
(100, 221210202, '0.00', '0.00', '0.00'),
(101, 221210302, '0.00', '0.00', '0.00'),
(102, 221210304, '0.00', '0.00', '0.00'),
(103, 221210401, '0.00', '0.00', '0.00'),
(104, 221210402, '0.00', '0.00', '0.00'),
(105, 221210403, '0.00', '0.00', '0.00'),
(106, 442420401, '0.00', '0.00', '0.00'),
(107, 442420402, '0.00', '0.00', '0.00'),
(108, 99999, '200.00', '0.00', '25.00'),
(113, 121201, '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinariayequipo`
--

CREATE TABLE IF NOT EXISTS `maquinariayequipo` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `fechaCompra` date NOT NULL,
  `vidaEconomica` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `observaciones` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `deplineaRecta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE IF NOT EXISTS `ordenes` (
  `numOrden` int(11) NOT NULL AUTO_INCREMENT,
  `fechaOrden` date NOT NULL,
  `Cliente` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `producto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cantProducto` int(11) NOT NULL,
  `MontoMP` decimal(10,2) NOT NULL,
  `MontoMObra` decimal(10,2) NOT NULL,
  `MontoGIF` decimal(10,2) NOT NULL,
  `totalCostoProduccion` decimal(10,2) NOT NULL,
  `Estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`numOrden`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`numOrden`, `fechaOrden`, `Cliente`, `producto`, `cantProducto`, `MontoMP`, `MontoMObra`, `MontoGIF`, `totalCostoProduccion`, `Estado`) VALUES
(1, '2013-11-25', 'Fulano', 'Silla', 2, '200.00', '500.00', '35.00', '735.00', 'En Proceso'),
(2, '2013-11-25', 'perencejo', 'Mesa', 3, '200.00', '400.00', '35.00', '735.00', 'En Proceso'),
(3, '2013-11-25', 'perencejo', 'Banquito', 3, '250.00', '900.00', '35.00', '735.00', 'En Proceso'),
(4, '2013-11-25', 'otro', 'bancote', 6, '400.00', '200.00', '25.00', '625.00', 'En Proceso'),
(5, '2013-11-25', 'Tomas', 'comedor', 2, '400.00', '200.00', '25.00', '625.00', 'En Proceso'),
(6, '0000-00-00', 'fulano', 'Comedor', 6, '8.00', '9.00', '2.00', '19.00', 'En proceso'),
(7, '2013-11-27', 'Tommy', 'Puerta', 6, '6.00', '4.00', '3.00', '13.00', 'En proceso'),
(8, '2013-11-27', 'boby', 'Silla', 8, '4.00', '5.00', '7.00', '16.00', 'En proceso'),
(9, '2013-11-27', 'boby', 'Silla', 7, '6.00', '8.00', '9.00', '23.00', 'En proceso'),
(10, '2013-11-27', 'boby', 'Silla', 7, '6.00', '8.00', '9.00', '23.00', 'En proceso'),
(11, '2013-11-27', 'boby', 'Silla', 3, '6.00', '8.00', '9.00', '23.00', 'En proceso');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
