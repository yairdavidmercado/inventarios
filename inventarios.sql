-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2020 a las 19:19:36
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventarios`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`inventory`@`%` PROCEDURE `actualizar_bodegas` (IN `id1` INT(4), IN `nombre1` VARCHAR(255), IN `state1` INT(1), IN `user_id1` VARCHAR(4))  BEGIN
UPDATE bodegas 
SET nombre = nombre1, 
state = state1, 
user_id = user_id1
WHERE id = id1; 
SELECT id1;
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `actualizar_categorias` (IN `id1` INT(4), IN `nombre1` VARCHAR(255), IN `user_id1` VARCHAR(4), IN `state1` INT(1))  BEGIN
UPDATE categorias 
SET nombre = nombre1,
user_id = user_id1, 
state = state1
WHERE id = id1; 
SELECT id1;
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `actualizar_clientes` (IN `id1` INT(4), IN `identificacion1` VARCHAR(12), IN `nombre1` VARCHAR(255), IN `alias1` VARCHAR(255), IN `direccion1` VARCHAR(255), IN `telefono1` VARCHAR(50), IN `email1` VARCHAR(50), IN `user_id1` VARCHAR(4), IN `state1` INT(1))  BEGIN
UPDATE clientes 
SET identificacion = identificacion1, 
nombre = nombre1,
alias = alias1, 
direccion = direccion1, 
telefono = telefono1, 
email = email1, 
user_id = user_id1, 
state = state1
WHERE id = id1; 
SELECT id1;
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `actualizar_compras` (IN `id1` INT(4), IN `id_proveedor1` INT(5), IN `fecha_compra1` VARCHAR(255), IN `n_factura1` VARCHAR(50), IN `id_producto1` INT(5), IN `vl_costo1` NUMERIC(20,2), IN `iva1` VARCHAR(10), IN `vl_venta1` NUMERIC(20,2), IN `cantidad1` INT(5), IN `bodega1` INT(5), IN `user_id1` INT(5), IN `state1` INT(1))  BEGIN
UPDATE compras 
SET id_proveedor = id_proveedor1,
fecha_compra = fecha_compra1,
n_factura = n_factura1,
id_producto = id_producto1,
vl_costo = vl_costo1,
iva = iva1,
vl_venta = vl_venta1,
cantidad = cantidad1,
bodega = bodega1,
user_id = user_id1,
state = state1
WHERE id = id1; 
SELECT id1;
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `actualizar_productos` (IN `id1` INT(4), IN `nombre1` VARCHAR(255), IN `vl_costo1` DECIMAL(20,2), IN `vl_venta1` DECIMAL(20,2), IN `iva1` VARCHAR(10), IN `id_categoria1` INT(5), IN `id_proveedor1` INT(5), IN `user_id1` INT(5), IN `perfil1` INT(2), IN `state1` INT(1))  BEGIN
UPDATE productos 
SET nombre = nombre1,
vl_costo = vl_costo1,
vl_venta = vl_venta1,
iva = iva1,
id_categoria = id_categoria1,
id_proveedor = id_proveedor1,
user_id = user_id1,
perfil = perfil1,
state = state1
WHERE id = id1; 
SELECT id1;
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `actualizar_proveedor` (IN `id1` INT(4), IN `nit1` VARCHAR(12), IN `nombre1` VARCHAR(255), IN `direccion1` VARCHAR(255), IN `telefono1` VARCHAR(50), IN `email1` VARCHAR(50), IN `user_id1` VARCHAR(4), IN `state1` INT(1))  BEGIN
UPDATE proveedors 
SET nit = nit1, 
nombre = nombre1, 
direccion = direccion1, 
telefono = telefono1, 
email = email1, 
user_id = user_id1, 
state = state1
WHERE id = id1; 
SELECT id1;
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `actualizar_users` (IN `id1` INT(4), IN `nombre1` VARCHAR(255), IN `email1` VARCHAR(50), IN `telefono1` VARCHAR(50), IN `password1` VARCHAR(50), IN `perfil1` VARCHAR(255), IN `state1` INT(1), IN `user_id1` VARCHAR(4))  BEGIN
UPDATE users 
SET nombre = nombre1, 
email = email1, 
telefono = telefono1, 
password = MD5(password1), 
perfil = perfil1, 
state = state1, 
user_id = user_id1
WHERE id = id1; 
SELECT id1;
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `eliminar_detalle_factura` (IN `id1` INT(6), IN `user_id1` INT(6))  BEGIN
DELETE FROM detalle_factura WHERE id = id1 AND user_id = user_id1 AND state = 0 AND id_factura = 0;
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `eliminar_detalle_pedido` (IN `id1` INT(6), IN `user_id1` INT(6))  BEGIN
DELETE FROM detalle_pedido WHERE id = id1 AND user_id = user_id1 AND state = 0 AND id_orden_pedidos = 0;
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `guardar_abonos` (IN `id_factura1` VARCHAR(6), IN `vl_abono1` DECIMAL(20,2), IN `user_id1` INT(4), IN `state1` INT(1))  BEGIN
insert into abonos (id_factura,
vl_abono,
user_id,
state) values(id_factura1,
vl_abono1,
user_id1,
state1);
SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `guardar_bodegas` (IN `nombre1` VARCHAR(255), IN `state1` INT(1), IN `user_id1` VARCHAR(4))  BEGIN
insert into bodegas(nombre, state, user_id) values(nombre1,state1, user_id1);
SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `guardar_categorias` (IN `nombre1` VARCHAR(255), IN `user_id1` VARCHAR(6), IN `state1` INT(1))  BEGIN
insert into categorias (nombre, user_id, state) values(nombre1, user_id1, state1);
SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `guardar_clientes` (IN `identificacion1` VARCHAR(12), IN `nombre1` VARCHAR(255), IN `alias1` VARCHAR(255), IN `direccion1` VARCHAR(255), IN `telefono1` VARCHAR(50), IN `email1` VARCHAR(50), IN `user_id1` VARCHAR(4), IN `state1` INT(1))  BEGIN
insert into clientes (identificacion, nombre, alias, direccion, telefono, email, user_id, state) values(identificacion1, nombre1, alias1, direccion1, telefono1, email1, user_id1, state1);
SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `guardar_compras` (IN `id_proveedor1` INT(5), IN `fecha1` VARCHAR(255), IN `n_factura1` VARCHAR(50), IN `id_producto1` INT(5), IN `vl_costo1` NUMERIC(20,2), IN `iva1` VARCHAR(10), IN `vl_venta1` NUMERIC(20,2), IN `cantidad1` INT(5), IN `bodega1` INT(5), IN `user_id1` INT(5), IN `state1` INT(1))  BEGIN
insert into compras (`id_proveedor`,
`fecha`,
`n_factura`,
`id_producto`,
`vl_costo`,
`iva`,
`vl_venta`,
`cantidad`,
`bodega`,
`user_id`,
`state`) values(`id_proveedor1`,
`fecha1`,
`n_factura1`,
`id_producto1`,
`vl_costo1`,
`iva1`,
`vl_venta1`,
`cantidad1`,
`bodega1`,
`user_id1`,
`state1`);
SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `guardar_egresos` (IN `tipo_egreso1` INT(6), IN `vl_egreso1` NUMERIC(20,2), IN `ubicacion1` VARCHAR(50), IN `bodega1` INT(6), IN `descripcion1` VARCHAR(500), IN `user_id1` INT(5), IN `state1` INT(1))  BEGIN
insert into egresos (tipo_egreso,
vl_egreso,
ubicacion,
bodega,
descripcion,
user_id,
state) values(tipo_egreso1,
vl_egreso1,
ubicacion1,
bodega1,
descripcion1,
user_id1,
state1);
SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `guardar_existencias` (IN `id_producto1` VARCHAR(255), IN `cantidad1` NUMERIC(20), IN `bodega1` INT(6), IN `user_id1` INT(6), IN `state1` INT(1))  BEGIN
insert into existencias (id_producto,
cantidad,
bodega,
user_id,
state) values(id_producto1,
cantidad1,
bodega1,
user_id1,
state1);
SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `guardar_facturas` (IN `id_productos1` VARCHAR(250), IN `id_cliente1` INT(6), IN `iva_factu1` DECIMAL(20,0), IN `subtotal_factu1` DECIMAL(20,0), IN `valor_factu1` DECIMAL(50,0), IN `bodega1` INT(6), IN `cuotas1` INT(6), IN `tipo_venta1` VARCHAR(50), IN `fecha_venta1` VARCHAR(50), IN `user_id1` INT(6), IN `state1` INT(1))  BEGIN
insert into facturas (id_cliente, iva_factu, subtotal_factu, valor_factu, bodega, cuotas, tipo_venta, fecha_venta, user_id, state) values(id_cliente1, iva_factu1, subtotal_factu1, valor_factu1, bodega1, cuotas1, tipo_venta1, fecha_venta1, user_id1, state1);
IF LAST_INSERT_ID() IS NOT NULL then
UPDATE detalle_factura SET state = 1, id_factura = LAST_INSERT_ID() WHERE id IN(
SELECT id FROM (SELECT* from detalle_factura ) AS x WHERE user_id = user_id1 AND state = 0);
SELECT LAST_INSERT_ID();
END IF;
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `guardar_orden_pedidos` (IN `id_productos1` VARCHAR(250), IN `id_cliente1` INT(6), IN `iva_factu1` DECIMAL(20,0), IN `subtotal_factu1` DECIMAL(20,0), IN `valor_factu1` DECIMAL(50,0), IN `bodega1` INT(6), IN `cuotas1` INT(6), IN `tipo_venta1` VARCHAR(50), IN `fecha_venta1` VARCHAR(50), IN `user_id1` INT(6), IN `state1` INT(1))  BEGIN
insert into orden_pedidos (id_cliente, iva_factu, subtotal_factu, valor_factu, bodega, cuotas, tipo_venta, fecha_venta, user_id, state) values(id_cliente1, iva_factu1, subtotal_factu1, valor_factu1, bodega1, cuotas1, tipo_venta1, fecha_venta1, user_id1, state1);
IF LAST_INSERT_ID() IS NOT NULL then
UPDATE detalle_pedido SET state = 1, id_orden_pedidos = LAST_INSERT_ID() WHERE id IN(
SELECT id FROM (SELECT* from detalle_pedido ) AS x WHERE user_id = user_id1 AND state = 0);
SELECT LAST_INSERT_ID();
END IF;
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `guardar_productos` (IN `nombre1` VARCHAR(255), IN `vl_costo1` NUMERIC(20,2), IN `vl_venta1` NUMERIC(20,2), IN `iva1` VARCHAR(10), IN `id_categoria1` INT(5), IN `id_proveedor1` INT(5), IN `user_id1` INT(5), IN `perfil1` INT(2), IN `state1` INT(1))  BEGIN
insert into productos (nombre,
vl_costo,
vl_venta,
iva,
id_categoria,
id_proveedor,
user_id,
perfil,
state) values(nombre1,
vl_costo1,
vl_venta1,
iva1,
id_categoria1,
id_proveedor1,
user_id1,
perfil1,
state1);
SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `guardar_proveedor` (IN `nit1` VARCHAR(12), IN `nombre1` VARCHAR(255), IN `direccion1` VARCHAR(255), IN `telefono1` VARCHAR(50), IN `email1` VARCHAR(50), IN `user_id1` VARCHAR(4), IN `state1` INT(1))  BEGIN
insert into proveedors (nit, nombre, direccion, telefono, email, user_id, state) values(nit1, nombre1, direccion1, telefono1, email1, user_id1, state1);
SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `guardar_users` (IN `nombre1` VARCHAR(255), IN `email1` VARCHAR(50), IN `telefono1` VARCHAR(50), IN `password1` VARCHAR(50), IN `perfil1` VARCHAR(255), IN `state1` INT(1), IN `user_id1` VARCHAR(4))  BEGIN
insert into users(nombre, email, telefono, password, perfil, state, user_id) values(nombre1, email1, telefono1, MD5(password1), perfil1 , state1, user_id1);
SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `sel_detalle_factura` ()  BEGIN
 SELECT * FROM detalle_factura WHERE state = 1;
END$$

CREATE DEFINER=`inventory`@`%` PROCEDURE `sel_detalle_pedido` ()  BEGIN
 SELECT * FROM detalle_pedido WHERE state = 1;
END$$

--
-- Funciones
--
CREATE DEFINER=`inventory`@`%` FUNCTION `actualizar_despachado` (`orden1` INT(6)) RETURNS INT(11) BEGIN
UPDATE orden_pedidos set confirmar = 1 WHERE id = orden1 and state = 1;
RETURN 1;
END$$

CREATE DEFINER=`inventory`@`%` FUNCTION `despachar` (`orden1` INT(6), `tipo_venta1` VARCHAR(255), `bodega1` INT(6), `user_id1` INT(6)) RETURNS INT(6) BEGIN
	declare ID int;
	if not exists (SELECT * FROM detalle_pedido WHERE id_orden_pedidos = orden1 AND state = 1 AND cantidad > IF((select sum(existencias.cantidad) FROM existencias WHERE existencias.id_producto = detalle_pedido.id_producto AND existencias.bodega = bodega1 ) IS NULL, 0 ,(select sum(existencias.cantidad) FROM existencias WHERE existencias.id_producto = detalle_pedido.id_producto AND existencias.bodega = bodega1 )-(IF ((SELECT SUM(detalle_factura.cantidad) FROM detalle_factura WHERE detalle_factura.id_producto = detalle_pedido.id_producto AND detalle_factura.state = 1 AND detalle_factura.bodega = bodega1) IS NULL, 0, (SELECT SUM(detalle_factura.cantidad) FROM detalle_factura WHERE detalle_factura.id_producto = detalle_pedido.id_producto AND detalle_factura.state = 1 AND detalle_factura.bodega = bodega1))))) then
		INSERT INTO facturas ( id_cliente, iva_factu, subtotal_factu, valor_factu, bodega, cuotas, tipo_venta, user_id, state )
		SELECT id_cliente, iva_factu, subtotal_factu, valor_factu, bodega1, cuotas, tipo_venta1, user_id1, state 
		FROM    orden_pedidos
		WHERE   orden_pedidos.id = orden1;
		SET ID = LAST_INSERT_ID();
		INSERT INTO detalle_factura ( id_producto, vl_venta, cantidad, id_factura , bodega, user_id, state)
		SELECT id_producto, vl_venta, cantidad, ID ,bodega1 , user_id, state 
		FROM  detalle_pedido
		WHERE detalle_pedido.id_orden_pedidos = orden1;
        
		RETURN actualizar_despachado(orden1);
    else
		RETURN 0;
    END if;
END$$

CREATE DEFINER=`inventory`@`%` FUNCTION `eliminar_facturas` (`id_factura1` INT(6), `tipo_venta1` VARCHAR(50), `bodega1` INT(6)) RETURNS INT(6) BEGIN
 DECLARE flag bool DEFAULT false;
  SELECT EXISTS(SELECT id FROM facturas WHERE id = id_factura1 AND tipo_venta = tipo_venta1 AND state = 1) INTO flag;
  IF (flag) THEN 
  UPDATE facturas SET state = 0 WHERE id = id_factura1 AND tipo_venta = tipo_venta1 AND bodega = bodega1;
  DELETE FROM detalle_factura WHERE id_factura = id_factura1 AND bodega = bodega1;
  RETURN 1;
  ELSE 
  return 0;
  END IF;
END$$

CREATE DEFINER=`inventory`@`%` FUNCTION `eliminar_orden_pedidos` (`id_orden_pedidos1` INT(6), `tipo_venta1` VARCHAR(50), `bodega1` INT(6)) RETURNS INT(6) BEGIN
 DECLARE flag bool DEFAULT false;
  SELECT EXISTS(SELECT id FROM orden_pedidos WHERE id = id_orden_pedidos1 AND tipo_venta = tipo_venta1 AND state = 1) INTO flag;
  IF (flag) THEN 
  UPDATE orden_pedidos SET state = 0 WHERE id = id_orden_pedidos1 AND tipo_venta = tipo_venta1 AND bodega = bodega1;
  DELETE FROM detalle_pedido WHERE id_orden_pedidos = id_orden_pedidos1 AND bodega = bodega1;
  RETURN 1;
  ELSE 
  return 0;
  END IF;
END$$

CREATE DEFINER=`inventory`@`%` FUNCTION `guardar_detalle_factura` (`id_producto1` INT(6), `vl_venta1` DECIMAL(20,0), `cantidad1` DECIMAL(20,0), `id_factura1` INT(6), `bodega1` INT(6), `user_id1` INT(6), `state1` TINYINT(1)) RETURNS INT(6) BEGIN
  DECLARE id int;
  IF NOT EXISTS (SELECT id_producto FROM detalle_factura WHERE id_producto = id_producto1 AND user_id = user_id1 AND state = 0) THEN 
  insert into detalle_factura(id_producto, vl_venta, cantidad, id_factura, bodega, user_id, state) values(id_producto1, vl_venta1, cantidad1, id_factura1, bodega1, user_id1, state1);
  RETURN 1;
  ELSE 
  return 0;
  END IF;
END$$

CREATE DEFINER=`inventory`@`%` FUNCTION `guardar_detalle_pedido` (`id_producto1` INT(6), `vl_venta1` DECIMAL(20,0), `cantidad1` DECIMAL(20,0), `id_orden_pedidos1` INT(6), `bodega1` INT(6), `user_id1` INT(6), `state1` TINYINT(1)) RETURNS INT(6) BEGIN
  DECLARE id int;
  IF NOT EXISTS (SELECT id_producto FROM detalle_pedido WHERE id_producto = id_producto1 AND user_id = user_id1 AND state = 0) THEN 
  insert into detalle_pedido(id_producto, vl_venta, cantidad, id_orden_pedidos, bodega, user_id, state) values(id_producto1, vl_venta1, cantidad1, id_orden_pedidos1, bodega1, user_id1, state1);
  RETURN 1;
  ELSE 
  return 0;
  END IF;
END$$

CREATE DEFINER=`inventory`@`%` FUNCTION `validar_despacho` (`orden1` INT(6), `bodega1` INT(6)) RETURNS INT(6) BEGIN
	declare ID int;
	if not exists (SELECT * FROM detalle_pedido WHERE id_orden_pedidos = orden1 AND state = 1 AND cantidad > IF((select sum(existencias.cantidad) FROM existencias WHERE existencias.id_producto = detalle_pedido.id_producto AND existencias.bodega = bodega1 ) IS NULL, 0 ,(select sum(existencias.cantidad) FROM existencias WHERE existencias.id_producto = detalle_pedido.id_producto AND existencias.bodega = bodega1 )-(IF ((SELECT SUM(detalle_factura.cantidad) FROM detalle_factura WHERE detalle_factura.id_producto = detalle_pedido.id_producto AND detalle_factura.state = 1 AND detalle_factura.bodega = bodega1) IS NULL, 0, (SELECT SUM(detalle_factura.cantidad) FROM detalle_factura WHERE detalle_factura.id_producto = detalle_pedido.id_producto AND detalle_factura.state = 1 AND detalle_factura.bodega = bodega1))))) then
		RETURN 1;
    else
		RETURN 0;
    END if;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos`
--

CREATE TABLE `abonos` (
  `id` int(6) UNSIGNED NOT NULL,
  `id_factura` varchar(255) NOT NULL,
  `vl_abono` decimal(20,0) DEFAULT NULL,
  `user_id` varchar(4) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `abonos`
--

INSERT INTO `abonos` (`id`, `id_factura`, `vl_abono`, `user_id`, `state`, `reg_date`) VALUES
(5, '2', '12000', '1', 1, '2020-01-12 05:07:35'),
(6, '2', '28000', '1', 1, '2020-01-12 05:08:40'),
(7, '2', '200000', '1', 1, '2020-01-21 15:24:48'),
(8, '5', '20000', '1', 1, '2020-02-01 22:44:25'),
(9, '6', '200000', '2', 1, '2020-02-02 16:22:57'),
(11, '7', '20000', '2', 1, '2020-02-02 21:29:47'),
(12, '6', '5000', '2', 1, '2020-02-08 15:13:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodegas`
--

CREATE TABLE `bodegas` (
  `id` int(6) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bodegas`
--

INSERT INTO `bodegas` (`id`, `nombre`, `state`, `user_id`, `reg_date`) VALUES
(1, 'BODEGA PRINCIPAL', 1, 1, '2020-02-07 13:42:21'),
(2, 'BODEGA AYAPEL', 0, 1, '2020-02-07 13:42:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(6) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `user_id` varchar(4) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `user_id`, `state`, `reg_date`) VALUES
(1, 'NIÃ‘AS', '2', 1, '2020-02-07 18:10:30'),
(2, 'DAMAS', '2', 1, '2020-02-07 18:15:05'),
(3, 'CABALLEROS', '2', 1, '2020-02-07 18:15:13'),
(4, 'ANCIANOS', '2', 1, '2020-02-07 18:15:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(6) UNSIGNED NOT NULL,
  `identificacion` varchar(12) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `user_id` varchar(4) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `identificacion`, `nombre`, `alias`, `direccion`, `telefono`, `email`, `user_id`, `state`, `reg_date`) VALUES
(1, '1067902', 'Jair David Mercado', 'El Paraiso', 'Cll', '3013525820', 'yairda@gmaill.com', '2', 1, '2020-02-14 16:19:19'),
(2, '105677678', 'Jorge villalobos', 'La Constancia', 'mz r lt  9 ', '54634', 'jorgevillalobos@gmail.com', '2', 1, '2020-02-14 16:18:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(6) UNSIGNED NOT NULL,
  `id_proveedor` int(6) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `n_factura` varchar(100) DEFAULT NULL,
  `id_producto` int(6) DEFAULT NULL,
  `vl_costo` decimal(20,2) DEFAULT NULL,
  `iva` varchar(5) DEFAULT NULL,
  `vl_venta` decimal(20,2) DEFAULT NULL,
  `cantidad` int(6) DEFAULT NULL,
  `bodega` int(6) DEFAULT NULL,
  `user_id` int(5) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `id_proveedor`, `fecha`, `n_factura`, `id_producto`, `vl_costo`, `iva`, `vl_venta`, `cantidad`, `bodega`, `user_id`, `state`, `reg_date`) VALUES
(1, 1, '2020-02-21 05:00:00', '90000', 3, '10000.00', '0', '70000.00', 12, 1, 2, 1, '2020-02-22 02:16:21'),
(2, 1, '2020-02-21 05:00:00', '0009', 2, '100000.00', '19', '15000.00', 12, 1, 2, 1, '2020-02-22 02:20:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id` int(6) UNSIGNED NOT NULL,
  `id_producto` int(6) NOT NULL,
  `vl_venta` decimal(20,0) DEFAULT NULL,
  `cantidad` decimal(20,0) DEFAULT NULL,
  `id_factura` int(6) DEFAULT NULL,
  `bodega` int(6) DEFAULT NULL,
  `user_id` int(5) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`id`, `id_producto`, `vl_venta`, `cantidad`, `id_factura`, `bodega`, `user_id`, `state`, `reg_date`) VALUES
(1, 3, '70000', '5', 1, 1, 2, 1, '2020-02-21 02:42:38'),
(2, 1, '20000', '5', 1, 1, 2, 1, '2020-02-21 02:42:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id` int(6) UNSIGNED NOT NULL,
  `id_producto` int(6) NOT NULL,
  `vl_venta` decimal(20,0) DEFAULT NULL,
  `cantidad` decimal(20,0) DEFAULT NULL,
  `id_orden_pedidos` int(6) DEFAULT NULL,
  `bodega` int(6) DEFAULT NULL,
  `user_id` int(5) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id`, `id_producto`, `vl_venta`, `cantidad`, `id_orden_pedidos`, `bodega`, `user_id`, `state`, `reg_date`) VALUES
(1, 3, '70000', '5', 1, 1, 2, 1, '2020-02-20 23:58:47'),
(2, 1, '20000', '5', 1, 1, 2, 1, '2020-02-20 23:58:47'),
(3, 3, '70000', '100', 2, 1, 2, 1, '2020-02-21 15:21:38'),
(4, 3, '70000', '2', 3, 1, 2, 1, '2020-02-21 15:25:25'),
(5, 1, '20000', '3', 3, 1, 2, 1, '2020-02-21 15:25:25'),
(6, 2, '15000', '50', 3, 1, 2, 1, '2020-02-21 15:25:25'),
(7, 2, '15000', '2', 4, 1, 2, 1, '2020-02-21 15:26:16'),
(8, 1, '20000', '5', 4, 1, 2, 1, '2020-02-21 15:26:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE `egresos` (
  `id` int(6) UNSIGNED NOT NULL,
  `id_producto` int(6) NOT NULL,
  `tipo_egreso` int(6) NOT NULL,
  `vl_egreso` decimal(20,0) DEFAULT NULL,
  `ubicacion` varchar(50) DEFAULT NULL,
  `bodega` int(6) DEFAULT NULL,
  `descripcion` varchar(500) NOT NULL,
  `user_id` varchar(4) DEFAULT NULL,
  `delete_by` varchar(4) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `egresos`
--

INSERT INTO `egresos` (`id`, `id_producto`, `tipo_egreso`, `vl_egreso`, `ubicacion`, `bodega`, `descripcion`, `user_id`, `delete_by`, `state`, `reg_date`) VALUES
(21, 0, 5, '450000', 'efectivo', 1, 'xxxxxxxxxxxxxxxx', '1', '1', 0, '2020-02-02 15:50:15'),
(22, 0, 4, '50000', 'credito', 1, 'xxxxxxxxxxxx', '1', '2', 0, '2020-02-21 16:01:15'),
(23, 0, 5, '23000', 'efectivo', 1, 'xxxxxx', '1', '1', 0, '2020-02-02 15:50:15'),
(24, 0, 1, '30000', 'credito', 1, 'xxxxxxxxxxxx', '1', '2', 0, '2020-02-21 16:01:11'),
(25, 0, 1, '30000', 'credito', 1, 'xxxxxxxxxxxx', '1', '2', 0, '2020-02-21 16:01:09'),
(26, 0, 6, '50000', 'credito', 1, 'xxxxxxxxxxxxx', '1', '2', 0, '2020-02-21 16:01:07'),
(27, 0, 1, '40000', 'credito', 1, 'asdadsdad', '1', '1', 0, '2020-02-02 15:50:15'),
(28, 0, 6, '30000', 'credito', 1, 'xxxxxx', '1', '1', 0, '2020-02-02 15:50:15'),
(29, 0, 5, '1000', 'efectivo', 1, 'SADASDASDA', '2', '2', 0, '2020-02-21 16:01:05'),
(30, 0, 5, '1000', 'credito', 1, 'XXXXX', '2', '2', 0, '2020-02-21 16:01:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `existencias`
--

CREATE TABLE `existencias` (
  `id` int(6) UNSIGNED NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` decimal(20,0) DEFAULT NULL,
  `bodega` int(6) DEFAULT NULL,
  `user_id` int(4) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `existencias`
--

INSERT INTO `existencias` (`id`, `id_producto`, `cantidad`, `bodega`, `user_id`, `state`, `reg_date`) VALUES
(1, 1, '34', 1, 1, 1, '2020-02-01 04:33:32'),
(2, 1, '11', 1, 1, 1, '2020-02-01 04:33:12'),
(3, 3, '3', 1, 2, 1, '2020-02-01 04:33:12'),
(4, 1, '4', 1, 2, 1, '2020-02-01 04:33:12'),
(5, 1, '4', 1, 2, 1, '2020-02-01 04:33:12'),
(6, 1, '2', 1, 2, 1, '2020-02-01 04:33:12'),
(7, 1, '2', 1, 2, 1, '2020-02-01 04:39:13'),
(8, 1, '5', 2, 2, 1, '2020-02-01 04:39:43'),
(9, 1, '2', 2, 2, 1, '2020-02-01 05:17:38'),
(10, 1, '1', 2, 2, 1, '2020-02-01 05:18:46'),
(11, 1, '1', 1, 2, 1, '2020-02-01 05:18:55'),
(12, 3, '3', 2, 2, 1, '2020-02-02 16:28:03'),
(13, 3, '30', 1, 2, 1, '2020-02-20 22:38:12'),
(14, 2, '21', 1, 2, 1, '2020-02-20 22:38:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(6) UNSIGNED NOT NULL,
  `id_cliente` decimal(20,0) DEFAULT NULL,
  `iva_factu` decimal(20,2) DEFAULT NULL,
  `subtotal_factu` decimal(20,2) DEFAULT NULL,
  `valor_factu` decimal(50,2) DEFAULT NULL,
  `bodega` int(6) DEFAULT NULL,
  `cuotas` int(6) DEFAULT NULL,
  `tipo_venta` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_venta` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(5) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `id_cliente`, `iva_factu`, `subtotal_factu`, `valor_factu`, `bodega`, `cuotas`, `tipo_venta`, `fecha_venta`, `user_id`, `state`, `reg_date`) VALUES
(1, '1', '0.00', '450000.00', '450000.00', 1, 0, 'efectivo', '2020-02-21 02:42:38', 2, 1, '2020-02-21 02:42:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_pedidos`
--

CREATE TABLE `orden_pedidos` (
  `id` int(6) UNSIGNED NOT NULL,
  `id_cliente` decimal(20,0) DEFAULT NULL,
  `iva_factu` decimal(20,2) DEFAULT NULL,
  `subtotal_factu` decimal(20,2) DEFAULT NULL,
  `valor_factu` decimal(50,2) DEFAULT NULL,
  `bodega` int(6) DEFAULT NULL,
  `cuotas` int(6) DEFAULT NULL,
  `tipo_venta` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmar` tinyint(4) DEFAULT 0,
  `fecha_venta` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(5) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `orden_pedidos`
--

INSERT INTO `orden_pedidos` (`id`, `id_cliente`, `iva_factu`, `subtotal_factu`, `valor_factu`, `bodega`, `cuotas`, `tipo_venta`, `confirmar`, `fecha_venta`, `user_id`, `state`, `reg_date`) VALUES
(1, '1', '0.00', '450000.00', '450000.00', 1, 0, 'pedido', 1, '2020-02-21 02:42:38', 2, 1, '2020-02-21 02:42:38'),
(2, '0', '0.00', '7000000.00', '7000000.00', 1, 0, 'pedido', 0, '2020-02-21 05:00:00', 2, 1, '2020-02-21 15:21:38'),
(3, '1', '0.00', '950000.00', '950000.00', 1, 0, 'pedido', 0, '2020-02-21 05:00:00', 2, 1, '2020-02-21 15:25:25'),
(4, '1', '0.00', '130000.00', '130000.00', 1, 0, 'pedido', 0, '2020-02-21 05:00:00', 2, 1, '2020-02-21 15:26:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(6) UNSIGNED NOT NULL,
  `id_modulo` int(6) NOT NULL,
  `perfil` int(6) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `user_id` int(6) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `id_modulo`, `perfil`, `tipo`, `user_id`, `state`, `reg_date`) VALUES
(1, 1, 1, 'bodegas', 1, 1, '2020-02-01 14:11:54'),
(2, 2, 1, 'bodegas', 1, 1, '2020-02-01 14:11:54'),
(3, 2, 2, 'bodegas', 1, 1, '2020-02-01 14:33:03'),
(4, 1, 3, 'bodegas', 1, 1, '2020-02-01 21:33:46'),
(5, 1, 1, 'productos', 1, 1, '2020-02-06 15:40:12'),
(7, 1, 1, 'orden_pedido', 1, 1, '2020-02-06 15:56:36'),
(8, 1, 1, 'ver_orden_pedido', 1, 1, '2020-02-07 13:45:04'),
(9, 1, 1, 'cajas', 1, 1, '2020-02-07 14:35:59'),
(10, 1, 1, 'clientes', 1, 1, '2020-02-07 14:35:59'),
(11, 1, 1, 'cuentasxcobrar', 1, 1, '2020-02-07 14:37:37'),
(12, 1, 1, 'egresos', 1, 1, '2020-02-07 14:37:37'),
(13, 1, 1, 'proveedores', 1, 1, '2020-02-07 14:37:37'),
(14, 1, 1, 'usuarios', 1, 1, '2020-02-07 14:37:37'),
(15, 1, 1, 'ventas', 1, 1, '2020-02-07 14:37:37'),
(16, 1, 1, 'categorias', 1, 1, '2020-02-07 17:55:18'),
(17, 1, 1, 'compra_proveedor', 1, 1, '2020-02-21 17:54:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(6) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `vl_costo` decimal(20,2) DEFAULT NULL,
  `vl_venta` decimal(20,2) DEFAULT NULL,
  `iva` varchar(5) DEFAULT NULL,
  `id_categoria` int(4) DEFAULT NULL,
  `id_proveedor` int(4) DEFAULT NULL,
  `user_id` int(5) DEFAULT NULL,
  `perfil` int(2) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `vl_costo`, `vl_venta`, `iva`, `id_categoria`, `id_proveedor`, `user_id`, `perfil`, `state`, `reg_date`) VALUES
(1, 'CAMISA TALLA M', '10000.00', '20000.00', '0', 4, 1, 1, 2, 1, '2020-01-11 22:02:11'),
(2, 'CAMISETAS TIPO POLO TALLA M ', '5000.00', '15000.00', '0', 4, 1, 2, 2, 1, '2020-02-01 05:51:47'),
(3, 'JEANS PARA HOMBRES DESTROYERS', '30000.00', '70000.00', '0', 2, 1, 2, 2, 1, '2020-02-01 05:55:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedors`
--

CREATE TABLE `proveedors` (
  `id` int(6) UNSIGNED NOT NULL,
  `nit` varchar(12) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `user_id` varchar(4) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedors`
--

INSERT INTO `proveedors` (`id`, `nit`, `nombre`, `direccion`, `telefono`, `email`, `user_id`, `state`, `reg_date`) VALUES
(1, '90034332', 'ROPA DE MARCA SAS', 'CLL', '7845332', 'ropamarca@gmail.com', '1', 1, '2020-01-11 22:00:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restringir_permisos`
--

CREATE TABLE `restringir_permisos` (
  `id` int(6) UNSIGNED NOT NULL,
  `id_permiso` int(6) NOT NULL,
  `id_usuario` int(6) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_egresos`
--

CREATE TABLE `tipo_egresos` (
  `id` int(6) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `user_id` varchar(4) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_egresos`
--

INSERT INTO `tipo_egresos` (`id`, `nombre`, `user_id`, `state`, `reg_date`) VALUES
(1, 'Arriendo', '1', 1, '2020-01-15 04:35:49'),
(2, 'Pago empleados', '1', 1, '2020-01-15 04:36:04'),
(3, 'Pago servicios', '1', 1, '2020-01-15 04:36:39'),
(4, 'Prestamo a empleados', '1', 1, '2020-01-15 04:36:39'),
(5, 'Ahorro', '1', 1, '2020-01-15 04:36:39'),
(6, 'Otros gastos', '1', 1, '2020-01-15 04:37:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `perfil` int(2) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `email`, `telefono`, `password`, `perfil`, `state`, `user_id`, `reg_date`) VALUES
(1, 'Katherin Benitez', 'katherin@gmail.com', '6765756', '202cb962ac59075b964b07152d234b70', 2, 1, 1, '2020-02-01 21:27:14'),
(2, 'Jair David Mercado', 'yairdavidmercado@gmail.com', '7834312', '202cb962ac59075b964b07152d234b70', 1, 1, 1, '2020-01-12 05:01:50');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `existencias`
--
ALTER TABLE `existencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orden_pedidos`
--
ALTER TABLE `orden_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedors`
--
ALTER TABLE `proveedors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `restringir_permisos`
--
ALTER TABLE `restringir_permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_egresos`
--
ALTER TABLE `tipo_egresos`
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
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `existencias`
--
ALTER TABLE `existencias`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `orden_pedidos`
--
ALTER TABLE `orden_pedidos`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedors`
--
ALTER TABLE `proveedors`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `restringir_permisos`
--
ALTER TABLE `restringir_permisos`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_egresos`
--
ALTER TABLE `tipo_egresos`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
