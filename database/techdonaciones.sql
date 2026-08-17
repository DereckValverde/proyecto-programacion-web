-- =========================================================
-- Base de datos: techdonaciones
-- Proyecto: ConectiTicos
-- Generado: 17 de agosto de 2026
-- =========================================================

CREATE DATABASE IF NOT EXISTS `techdonaciones`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE `techdonaciones`;

-- ---------------------------------------------------------
-- Tabla: administradores
-- ---------------------------------------------------------
CREATE TABLE `administradores` (
  `idAdministrador` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fechaCreacion` datetime DEFAULT current_timestamp(),
  `ultimoAcceso` datetime DEFAULT NULL,
  PRIMARY KEY (`idAdministrador`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Admin: dereck@admin.com / Admin123*
INSERT INTO `administradores` (`nombre`, `correo`, `contrasena`)
VALUES ('Dereck Valverde', 'dereck@admin.com', '$2y$10$8K1p/a0dL1LXMIgoEDFrPOClU3bXiVqHJBGP0Hf.zQJQ4V4p1k4We');

-- ---------------------------------------------------------
-- Tabla: tipos_equipo
-- ---------------------------------------------------------
CREATE TABLE `tipos_equipo` (
  `idTipoEquipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `co2Estimado` decimal(8,2) NOT NULL,
  PRIMARY KEY (`idTipoEquipo`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tipos_equipo` (`nombre`, `co2Estimado`) VALUES
('Laptop', 300.00),
('Computadora de escritorio', 400.00),
('Monitor', 150.00),
('Teclado', 10.00),
('Mouse', 5.00),
('Tablet', 200.00),
('Impresora', 80.00),
('Servidor', 1000.00),
('Proyector', 120.00),
('Teléfono celular', 70.00),
('Otro', 0.00);

-- ---------------------------------------------------------
-- Tabla: tipos_organizacion
-- ---------------------------------------------------------
CREATE TABLE `tipos_organizacion` (
  `idTipoOrganizacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`idTipoOrganizacion`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tipos_organizacion` (`nombre`) VALUES
('Escuela'),
('Colegio'),
('Universidad'),
('Fundación'),
('Asociación'),
('Comunidad'),
('Emprendimiento'),
('Gobierno'),
('Iglesia'),
('Otra');

-- ---------------------------------------------------------
-- Tabla: donaciones
-- ---------------------------------------------------------
CREATE TABLE `donaciones` (
  `idDonacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombreDonador` varchar(100) NOT NULL,
  `correoDonador` varchar(100) NOT NULL,
  `telefonoDonador` varchar(20) DEFAULT NULL,
  `tipoDonador` enum('Persona Fisica','Empresa') DEFAULT 'Persona Fisica',
  `detalleDonador` varchar(150) DEFAULT NULL,
  `idTipoEquipo` int(11) NOT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `estadoEquipo` enum('Nuevo','Bueno','Regular','Malo') NOT NULL,
  `cantidadEquipos` int(11) NOT NULL,
  `descripcionAdicional` text DEFAULT NULL,
  `estado` enum('Pendiente','Aceptada','Rechazada','Completada') DEFAULT 'Pendiente',
  `comentarioAdministrador` text DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT current_timestamp(),
  `fechaRevision` datetime DEFAULT NULL,
  `idAdministrador` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDonacion`),
  KEY `fk_donacion_tipoEquipo` (`idTipoEquipo`),
  KEY `fk_donacion_admin` (`idAdministrador`),
  CONSTRAINT `fk_donacion_tipoEquipo` FOREIGN KEY (`idTipoEquipo`) REFERENCES `tipos_equipo` (`idTipoEquipo`),
  CONSTRAINT `fk_donacion_admin` FOREIGN KEY (`idAdministrador`) REFERENCES `administradores` (`idAdministrador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ---------------------------------------------------------
-- Tabla: solicitudes
-- ---------------------------------------------------------
CREATE TABLE `solicitudes` (
  `idSolicitud` int(11) NOT NULL AUTO_INCREMENT,
  `nombreSolicitante` varchar(100) NOT NULL,
  `correoSolicitante` varchar(100) NOT NULL,
  `telefonoSolicitante` varchar(20) DEFAULT NULL,
  `nombreOrganizacion` varchar(100) NOT NULL,
  `idTipoOrganizacion` int(11) NOT NULL,
  `idTipoEquipo` int(11) NOT NULL,
  `cantidadEquipos` int(11) NOT NULL,
  `motivoSolicitud` text NOT NULL,
  `estado` enum('Pendiente','Aceptada','Rechazada','Completada') DEFAULT 'Pendiente',
  `comentarioAdministrador` text DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT current_timestamp(),
  `fechaRevision` datetime DEFAULT NULL,
  `idAdministrador` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSolicitud`),
  KEY `fk_solicitud_tipoOrganizacion` (`idTipoOrganizacion`),
  KEY `fk_solicitud_tipoEquipo` (`idTipoEquipo`),
  KEY `fk_solicitud_admin` (`idAdministrador`),
  CONSTRAINT `fk_solicitud_tipoEquipo` FOREIGN KEY (`idTipoEquipo`) REFERENCES `tipos_equipo` (`idTipoEquipo`),
  CONSTRAINT `fk_solicitud_tipoOrganizacion` FOREIGN KEY (`idTipoOrganizacion`) REFERENCES `tipos_organizacion` (`idTipoOrganizacion`),
  CONSTRAINT `fk_solicitud_admin` FOREIGN KEY (`idAdministrador`) REFERENCES `administradores` (`idAdministrador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ---------------------------------------------------------
-- Tabla: contacto
-- ---------------------------------------------------------
CREATE TABLE `contacto` (
  `idContacto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `asunto` varchar(100) NOT NULL,
  `mensaje` longtext NOT NULL,
  `fechaEnvio` datetime DEFAULT current_timestamp(),
  `leido` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`idContacto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ---------------------------------------------------------
-- Tabla: auditoria
-- ---------------------------------------------------------
CREATE TABLE `auditoria` (
  `idLog` int(11) NOT NULL AUTO_INCREMENT,
  `idAdministrador` int(11) DEFAULT NULL,
  `tipo` enum('Registro','Modificacion','Eliminacion','InicioSesion','Error') NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`idLog`),
  KEY `fk_auditoria_admin` (`idAdministrador`),
  CONSTRAINT `fk_auditoria_admin` FOREIGN KEY (`idAdministrador`) REFERENCES `administradores` (`idAdministrador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
