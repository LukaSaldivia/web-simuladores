<?php

require_once 'config.php';

abstract class Model {
        protected $db;

        function __construct() {
            $this->db = new PDO('mysql:host='. MYSQL['HOST']  .';dbname='. MYSQL['DB'] .';charset=utf8', MYSQL['USER'], MYSQL['PASS']);
            $this->deploy();
        }

        function deploy() {
          $yV = 'yV';
            // Chequear si hay tablas
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
            if(count($tables)==0) {
                // Si no hay crearlas
                $sql =<<<END
                -- phpMyAdmin SQL Dump
                -- version 5.2.1
                -- https://www.phpmyadmin.net/
                --
                -- Servidor: 127.0.0.1
                -- Tiempo de generación: 16-10-2023 a las 00:01:50
                -- Versión del servidor: 10.4.28-MariaDB
                -- Versión de PHP: 8.2.4

                SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                START TRANSACTION;
                SET time_zone = "+00:00";


                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                /*!40101 SET NAMES utf8mb4 */;

                --
                -- Base de datos: `bdd-simuladores`
                --

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `capitulos`
                --

                CREATE TABLE `capitulos` (
                  `idcap` varchar(255) NOT NULL,
                  `nombrecap` varchar(255) DEFAULT NULL,
                  `descripcion` text DEFAULT NULL,
                  `temporada` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `capitulos`
                --

                INSERT INTO `capitulos` (`idcap`, `nombrecap`, `descripcion`, `temporada`) VALUES
                ('O2lC_oBI7DU', 'Capítulo de prueba', 'Es la historia de una mujer y un hombre, ambos heterosexuales, que una vez de jóvenes se enamoraron', 1),
                ('_6XzJPyAJDI', 'Milo J BZRP Session', 'Una BZRP session del artista Milo J (el M) que adjunta un EP.', 1);

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `cast`
                --

                CREATE TABLE `cast` (
                  `idcast` int(11) NOT NULL,
                  `nombrecast` varchar(255) NOT NULL,
                  `apellido` varchar(255) NOT NULL,
                  `foto` text NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `cast`
                --

                INSERT INTO `cast` (`idcast`, `nombrecast`, `apellido`, `foto`) VALUES
                (1, 'juan', 'nasi', ''),
                (2, 'asneh', 'jalsdfljas', ''),
                (3, 'ajkhsdkhja', 'khasdfkha', '');

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `castxcapitulo`
                --

                CREATE TABLE `castxcapitulo` (
                  `id_cast` int(11) DEFAULT NULL,
                  `id_capituloxcast` varchar(255) DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `temporadas`
                --

                CREATE TABLE `temporadas` (
                  `idtemp` int(255) NOT NULL,
                  `nombretemp` varchar(255) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `temporadas`
                --

                INSERT INTO `temporadas` (`idtemp`, `nombretemp`) VALUES
                (1, 'Temporada 1');

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `usuarios`
                --

                CREATE TABLE `usuarios` (
                  `idusuario` int(11) NOT NULL,
                  `username` varchar(20) NOT NULL,
                  `password` varchar(255) NOT NULL,
                  `admin` tinyint(1) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                --
                -- Volcado de datos para la tabla `usuarios`
                --

                INSERT INTO `usuarios` (`idusuario`, `username`, `password`, `admin`) VALUES
                (3, 'webadmin', '$2y$10$yV/i3g64TdaWC2to1fhRU.0k4XtkRYegNk8E3xrt8wNCj7ZNUHXf6', 0);

                --
                -- Índices para tablas volcadas
                --

                --
                -- Indices de la tabla `capitulos`
                --
                ALTER TABLE `capitulos`
                  ADD PRIMARY KEY (`idcap`),
                  ADD KEY `fk_temporada` (`temporada`);

                --
                -- Indices de la tabla `cast`
                --
                ALTER TABLE `cast`
                  ADD PRIMARY KEY (`idcast`);

                --
                -- Indices de la tabla `castxcapitulo`
                --
                ALTER TABLE `castxcapitulo`
                  ADD KEY `fk_cast` (`id_cast`),
                  ADD KEY `fk_capitulo` (`id_capituloxcast`);

                --
                -- Indices de la tabla `temporadas`
                --
                ALTER TABLE `temporadas`
                  ADD PRIMARY KEY (`idtemp`);

                --
                -- Indices de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                  ADD PRIMARY KEY (`idusuario`);

                --
                -- AUTO_INCREMENT de las tablas volcadas
                --

                --
                -- AUTO_INCREMENT de la tabla `cast`
                --
                ALTER TABLE `cast`
                  MODIFY `idcast` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

                --
                -- AUTO_INCREMENT de la tabla `temporadas`
                --
                ALTER TABLE `temporadas`
                  MODIFY `idtemp` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

                --
                -- AUTO_INCREMENT de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

                --
                -- Restricciones para tablas volcadas
                --

                --
                -- Filtros para la tabla `capitulos`
                --
                ALTER TABLE `capitulos`
                  ADD CONSTRAINT `fk_temporada` FOREIGN KEY (`temporada`) REFERENCES `temporadas` (`idtemp`);

                --
                -- Filtros para la tabla `castxcapitulo`
                --
                ALTER TABLE `castxcapitulo`
                  ADD CONSTRAINT `fk_capitulo` FOREIGN KEY (`id_capituloxcast`) REFERENCES `capitulos` (`idcap`),
                  ADD CONSTRAINT `fk_cast` FOREIGN KEY (`id_cast`) REFERENCES `cast` (`idcast`);
                COMMIT;

                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
                END;
                $this->db->query($sql);
            }
            
        }
    }