-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2021 a las 04:57:48
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nostraweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `correoElectronico` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`correoElectronico`) VALUES
('admin@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `IdProducto` int(11) NOT NULL,
  `correoElectronico` varchar(30) NOT NULL,
  `cantidad` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`IdProducto`, `correoElectronico`, `cantidad`) VALUES
(2, 'usuario@gmail.com', 2),
(5, 'usuario@gmail.com', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `IdCat` int(11) NOT NULL,
  `nombreCat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IdCat`, `nombreCat`) VALUES
(1, 'Electrodomesticos'),
(2, 'Deporte'),
(3, 'Tecnologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `IdCompra` int(11) NOT NULL,
  `correoElectronico` varchar(30) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` enum('cancelado','esperando pago','en camino','finalizada') DEFAULT NULL,
  `fechaentrega` date DEFAULT NULL,
  `direccionentrega` varchar(40) DEFAULT NULL,
  `preciofinal` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`IdCompra`, `correoElectronico`, `fecha`, `estado`, `fechaentrega`, `direccionentrega`, `preciofinal`) VALUES
(1, 'usuario@gmail.com', '2021-10-27 23:22:23', 'finalizada', NULL, NULL, 84000),
(2, 'usuario@gmail.com', '2021-10-27 23:22:53', 'esperando pago', '2021-11-03', 'Joaquin Suarez 2847', 46150);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraproductos`
--

CREATE TABLE `compraproductos` (
  `IdCompra` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compraproductos`
--

INSERT INTO `compraproductos` (`IdCompra`, `IdProducto`, `cantidad`, `precio`) VALUES
(1, 1, 3, 60000),
(1, 3, 3, 24000),
(2, 4, 2, 1000),
(2, 8, 1, 45000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `efectuapago`
--

CREATE TABLE `efectuapago` (
  `IdCompra` int(11) NOT NULL,
  `IdTarjeta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `efectuapago`
--

INSERT INTO `efectuapago` (`IdCompra`, `IdTarjeta`) VALUES
(1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `correoElectronico` varchar(30) NOT NULL,
  `nombreEmpresa` varchar(16) NOT NULL,
  `RUT` varchar(12) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `IdTarjeta` int(11) DEFAULT NULL,
  `estado` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`correoElectronico`, `nombreEmpresa`, `RUT`, `contrasena`, `IdTarjeta`, `estado`) VALUES
('empresa2@gmail.com', 'Empresa 2', '215496546546', '3bec913e31e82a74fdf3950a48a45fbc8de915d3c7d98f294adc3afd5ffe151ec947e6147a7e0f171c01de5cee558a62bea4da0daf944fee9eac98d49ad62043', 2, '1'),
('nostraweb@gmail.com', 'NostraWeb', '216548654821', '2ac24ce1fb3b5b3a6c5286bcd0e5991bb66e09f5bfd264fbd883bd94153bf7bcac439bc93e2deb54310601ff29ebe9ff79b4fc76b1b0f0dc818c1633f12c6b79', 1, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `IdProducto` int(11) NOT NULL,
  `correoElectronico` varchar(30) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`IdProducto`, `correoElectronico`, `fecha`) VALUES
(1, 'admin@gmail.com', '2021-10-27 23:21:58'),
(1, 'usuario@gmail.com', '2021-10-27 23:22:10'),
(2, 'admin@gmail.com', '2021-10-27 23:42:19'),
(2, 'usuario@gmail.com', '2021-10-27 23:23:17'),
(3, 'usuario@gmail.com', '2021-10-27 23:09:34'),
(4, 'usuario@gmail.com', '2021-10-27 23:22:37'),
(5, 'usuario@gmail.com', '2021-10-27 23:48:12'),
(6, 'usuario@gmail.com', '2021-10-27 23:09:04'),
(8, 'usuario@gmail.com', '2021-10-27 23:37:15'),
(13, 'usuario@gmail.com', '2021-10-27 23:09:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagacon`
--

CREATE TABLE `pagacon` (
  `correoElectronico` varchar(30) NOT NULL,
  `IdTarjeta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pagacon`
--

INSERT INTO `pagacon` (`correoElectronico`, `IdTarjeta`) VALUES
('admin@gmail.com    ', 7),
('admin@gmail.com    ', 8),
('usuario@gmail.com    ', 5),
('usuario@gmail.com    ', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pickupcenter`
--

CREATE TABLE `pickupcenter` (
  `IdPickUp` int(11) NOT NULL,
  `direccion` varchar(40) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pickupcenter`
--

INSERT INTO `pickupcenter` (`IdPickUp`, `direccion`, `nombre`, `estado`) VALUES
(1, '18 de julio 4132', 'Casa Central 2', '1'),
(2, 'Boulevard Artigas 4489 esq Suarez', 'Casa Lateral', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `IdProducto` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `precio` int(9) NOT NULL,
  `descripcion` text NOT NULL,
  `uso` enum('nuevo','usado') DEFAULT 'nuevo',
  `stock` int(11) NOT NULL,
  `correoElectronico` varchar(30) NOT NULL,
  `estado` enum('1','0') NOT NULL DEFAULT '1',
  `IdCat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `nombre`, `precio`, `descripcion`, `uso`, `stock`, `correoElectronico`, `estado`, `IdCat`) VALUES
(1, 'Heladera James', 20000, 'Heladera james 5 modos de frio\r\nEn seco\r\nDuracion prolongada y garantia por 10 meses', 'nuevo', 5, 'nostraweb@gmail.com', '1', 1),
(2, 'Microondas samsung', 7000, 'Microondas 5 modos de calor\r\n', 'usado', 2, 'nostraweb@gmail.com', '1', 1),
(3, 'Calefon James', 8000, 'Calefon james 60lts\r\n15 minutos maximo tiempo', 'nuevo', 7, 'nostraweb@gmail.com', '1', 1),
(4, 'Pelota BASQUETBALL', 500, 'Pelota basquetball gran rebote y agarre', 'nuevo', 23, 'nostraweb@gmail.com', '1', 2),
(5, 'Mancuernas 15KG', 600, 'Mancuernas ideales para grandes y largas sesiones\r\nEvitan Lesiones', 'nuevo', 30, 'nostraweb@gmail.com', '1', 2),
(6, 'Bolsa de Boxeo', 2000, 'Bolsa de boxeo con guantes de regalo,\r\nPESO: 18 KG\r\nGuantes: talle 10', 'usado', 2, 'nostraweb@gmail.com', '1', 2),
(7, 'Laptop Acer I5 8GB RAM 1TB', 30000, 'Laptop acer de gama alta\r\nMemoria Ram:8GB\r\nProcesador:Intel core i5', 'nuevo', 9, 'nostraweb@gmail.com', '1', 3),
(8, 'iPhone 13 128GB Camara 120MP', 45000, 'Nuevo producto de Apple iPhone 13 Pro max\r\nA prueba de agua y camara frontal de 48MP', 'nuevo', 14, 'nostraweb@gmail.com', '1', 3),
(9, 'Auriculares Razer Kraken', 7000, 'Auriculares razer kraken tecnologia 7.1 Surround', 'nuevo', 23, 'nostraweb@gmail.com', '1', 3),
(10, 'Caminadora', 7000, 'Caminadora con mas de 20 velocidades\r\n', 'nuevo', 9, 'empresa2@gmail.com', '1', 2),
(11, 'Pelota de Volleyball', 500, 'Pelota con alto rozamiento y rebote', 'nuevo', 40, 'empresa2@gmail.com', '1', 2),
(12, 'Raqueta tennis', 2500, 'Liviana \r\nPeso: 1kg', 'nuevo', 5, 'empresa2@gmail.com', '1', 2),
(13, 'Aspiradora', 7000, 'Aspiradora max 30000', 'usado', 2, 'empresa2@gmail.com', '1', 1),
(14, 'Licuadora Napo', 1200, 'Licuadora para realizar los mas ricos batidos', 'nuevo', 18, 'empresa2@gmail.com', '1', 1),
(15, 'Cocina a gas', 8000, 'Cocina con encendido electrico', 'nuevo', 15, 'empresa2@gmail.com', '1', 1),
(16, 'Auriculares Apple AirPods', 5500, 'Auriculares con bloothoot 5.0\r\nVelocidad de carga: 30 min', 'nuevo', 14, 'empresa2@gmail.com', '1', 3),
(17, 'Xiaomi RedMi 9', 5000, 'Celular de gama alta con mucho almacenamiento para todas las aplicaciones necesarias', 'nuevo', 8, 'empresa2@gmail.com', '1', 3),
(18, 'Mouse logitech g203', 1200, 'Mouse con sensor de alta frecuencia 16000hz', 'nuevo', 15, 'empresa2@gmail.com', '1', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puederetiraren`
--

CREATE TABLE `puederetiraren` (
  `IdCompra` int(11) NOT NULL,
  `IdPickUp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puederetiraren`
--

INSERT INTO `puederetiraren` (`IdCompra`, `IdPickUp`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta`
--

CREATE TABLE `tarjeta` (
  `numeroTarjeta` varchar(16) NOT NULL,
  `codigo` int(3) NOT NULL,
  `NombreDueno` varchar(16) NOT NULL,
  `ApellidoDueno` varchar(16) NOT NULL,
  `IdTarjeta` int(11) NOT NULL,
  `vencimiento` date NOT NULL,
  `estado` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tarjeta`
--

INSERT INTO `tarjeta` (`numeroTarjeta`, `codigo`, `NombreDueno`, `ApellidoDueno`, `IdTarjeta`, `vencimiento`, `estado`) VALUES
('9879798798744345', 987, 'Leonardo', 'Pesce', 1, '2021-12-25', '1'),
('1234567891234567', 458, 'Joaquin', 'Gonzales', 2, '2021-12-25', '1'),
('1234567891234567', 789, 'Manuel', 'Pesce', 5, '2021-11-27', '1'),
('9849484984984984', 485, 'Leonardo', 'Avellaneda', 6, '2021-12-31', '1'),
('9879798798744567', 158, 'Pedrito ', 'Gonzales', 7, '2021-12-31', '1'),
('9879798798744567', 148, 'Santiago', 'Scabino', 8, '2022-01-01', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `correoElectronico` varchar(30) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `nombre` varchar(16) NOT NULL,
  `apellido` varchar(16) NOT NULL,
  `direccion` varchar(40) NOT NULL,
  `calidadCliente` enum('1','2','3','4','5') DEFAULT '1',
  `celular` int(9) UNSIGNED ZEROFILL DEFAULT NULL,
  `estado` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`correoElectronico`, `contrasena`, `nombre`, `apellido`, `direccion`, `calidadCliente`, `celular`, `estado`) VALUES
('admin@gmail.com', 'a3c1998eb85a2b117dc256db15e7dcda160f258bb639dc67e40a77ca6269893d991673b488fca01c5311cdbe1820e8a6150a2ef469287b394b524c1b42451a7b', 'Administrador', 'Sanchez', 'Enrique Martinez 1195', '1', 191606990, '1'),
('usuario@gmail.com', '62d636ee84cca37afa5fef9122816d68252132ca2cdb2deae3d559f383c074b72636a4f728b57a2ba179600e600de5706ad63f0b69bdc4fdce6b9758aeba5245', 'Usuario', 'Gonzales', 'Joaquin Suarez 2847', '1', 092454875, '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`correoElectronico`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`IdProducto`,`correoElectronico`),
  ADD KEY `correoElectronico` (`correoElectronico`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IdCat`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`IdCompra`),
  ADD KEY `correoElectronico` (`correoElectronico`);

--
-- Indices de la tabla `compraproductos`
--
ALTER TABLE `compraproductos`
  ADD PRIMARY KEY (`IdCompra`,`IdProducto`),
  ADD KEY `IdProducto` (`IdProducto`);

--
-- Indices de la tabla `efectuapago`
--
ALTER TABLE `efectuapago`
  ADD PRIMARY KEY (`IdCompra`),
  ADD KEY `IdTarjeta` (`IdTarjeta`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`correoElectronico`),
  ADD KEY `IdTarjeta` (`IdTarjeta`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`IdProducto`,`correoElectronico`),
  ADD KEY `correoElectronico` (`correoElectronico`);

--
-- Indices de la tabla `pagacon`
--
ALTER TABLE `pagacon`
  ADD PRIMARY KEY (`IdTarjeta`),
  ADD KEY `correoElectronico` (`correoElectronico`);

--
-- Indices de la tabla `pickupcenter`
--
ALTER TABLE `pickupcenter`
  ADD PRIMARY KEY (`IdPickUp`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IdProducto`),
  ADD KEY `correoElectronico` (`correoElectronico`),
  ADD KEY `producto_ibfk_3` (`IdCat`);

--
-- Indices de la tabla `puederetiraren`
--
ALTER TABLE `puederetiraren`
  ADD PRIMARY KEY (`IdCompra`),
  ADD KEY `IdPickUp` (`IdPickUp`);

--
-- Indices de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD PRIMARY KEY (`IdTarjeta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`correoElectronico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IdCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `IdCompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pickupcenter`
--
ALTER TABLE `pickupcenter`
  MODIFY `IdPickUp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  MODIFY `IdTarjeta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`correoElectronico`) REFERENCES `usuario` (`correoElectronico`);

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`correoElectronico`) REFERENCES `usuario` (`correoElectronico`);

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`correoElectronico`) REFERENCES `usuario` (`correoElectronico`);

--
-- Filtros para la tabla `compraproductos`
--
ALTER TABLE `compraproductos`
  ADD CONSTRAINT `compraproductos_ibfk_1` FOREIGN KEY (`IdCompra`) REFERENCES `compra` (`IdCompra`),
  ADD CONSTRAINT `compraproductos_ibfk_2` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`);

--
-- Filtros para la tabla `efectuapago`
--
ALTER TABLE `efectuapago`
  ADD CONSTRAINT `efectuapago_ibfk_2` FOREIGN KEY (`IdCompra`) REFERENCES `compra` (`IdCompra`),
  ADD CONSTRAINT `efectuapago_ibfk_3` FOREIGN KEY (`IdTarjeta`) REFERENCES `tarjeta` (`IdTarjeta`);

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`IdTarjeta`) REFERENCES `tarjeta` (`IdTarjeta`);

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`),
  ADD CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`correoElectronico`) REFERENCES `usuario` (`correoElectronico`);

--
-- Filtros para la tabla `pagacon`
--
ALTER TABLE `pagacon`
  ADD CONSTRAINT `pagacon_ibfk_2` FOREIGN KEY (`correoElectronico`) REFERENCES `usuario` (`correoElectronico`),
  ADD CONSTRAINT `pagacon_ibfk_3` FOREIGN KEY (`IdTarjeta`) REFERENCES `tarjeta` (`IdTarjeta`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`correoElectronico`) REFERENCES `empresa` (`correoElectronico`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`IdCat`) REFERENCES `categoria` (`IdCat`);

--
-- Filtros para la tabla `puederetiraren`
--
ALTER TABLE `puederetiraren`
  ADD CONSTRAINT `puederetiraren_ibfk_1` FOREIGN KEY (`IdPickUp`) REFERENCES `pickupcenter` (`IdPickUp`),
  ADD CONSTRAINT `puederetiraren_ibfk_2` FOREIGN KEY (`IdCompra`) REFERENCES `compra` (`IdCompra`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
