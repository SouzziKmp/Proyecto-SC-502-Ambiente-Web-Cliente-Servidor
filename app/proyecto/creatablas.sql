-- 1. LIMPIEZA INICIAL
DROP DATABASE IF EXISTS prestamos_db;
CREATE DATABASE prestamos_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE prestamos_db;

-- 2. TABLA ADMINISTRADOR (Para el Login)
CREATE TABLE Administrador (
    id_admin       INT          NOT NULL AUTO_INCREMENT,
    nombre         VARCHAR(50)  NOT NULL,
    email          VARCHAR(50)  NOT NULL UNIQUE,
    password       VARCHAR(50)  NOT NULL,
    rol            VARCHAR(25)  NOT NULL,
    estado         VARCHAR(25)  NOT NULL DEFAULT 'activo',
    fecha_creacion DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_admin)
);

-- 3. TABLA USUARIOS (Alumnos/Profesores)
CREATE TABLE Usuarios (
    id_usuarios  INT          NOT NULL AUTO_INCREMENT,
    nombre       VARCHAR(50)  NOT NULL,
    cedula       VARCHAR(20)  NOT NULL UNIQUE,
    email        VARCHAR(50)  NOT NULL UNIQUE,
    telefono     VARCHAR(50),
    tipo_usuario VARCHAR(20)  NOT NULL, -- 'alumno' | 'profesor'
    estado       VARCHAR(50)  NOT NULL DEFAULT 'activo',
    PRIMARY KEY (id_usuarios)
);

-- 4. TABLA CATEGORÍA
CREATE TABLE Categoria (
    id_categoria INT          NOT NULL AUTO_INCREMENT,
    nombre       VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_categoria)
);

-- 5. TABLA EQUIPOS / INVENTARIO
CREATE TABLE Equipos_Inventario (
    id_equipo         INT          NOT NULL AUTO_INCREMENT,
    codigo_inventario VARCHAR(50)  NOT NULL UNIQUE,
    nombre            VARCHAR(50)  NOT NULL,
    marca             VARCHAR(50),
    marcamodelo       VARCHAR(50),
    numero_serie      VARCHAR(50),
    id_categoria      INT          NOT NULL,
    estado            VARCHAR(50)  NOT NULL DEFAULT 'disponible',
    PRIMARY KEY (id_equipo),
    CONSTRAINT fk_equipo_categoria FOREIGN KEY (id_categoria) 
        REFERENCES Categoria (id_categoria)
);

-- 6. TABLA PRÉSTAMOS (Cabecera)
CREATE TABLE Prestamos (
    id_prestamo     INT          NOT NULL AUTO_INCREMENT,
    id_usuario      INT          NOT NULL,
    fecha_prestamo  DATE         NOT NULL,
    fecha_devo_esti DATE         NOT NULL,
    fecha_devo_real DATE,
    estado          VARCHAR(50)  NOT NULL DEFAULT 'activo', -- 'activo' | 'devuelto'
    PRIMARY KEY (id_prestamo),
    CONSTRAINT fk_prestamo_usuario FOREIGN KEY (id_usuario) 
        REFERENCES Usuarios (id_usuarios)
);

-- 7. TABLA DETALLE_PRESTAMO (Relación Préstamo-Equipo)
CREATE TABLE Detalle_Prestamo (
    id_detalle  INT NOT NULL AUTO_INCREMENT,
    id_prestamo INT NOT NULL,
    id_equipo   INT NOT NULL,
    PRIMARY KEY (id_detalle),
    CONSTRAINT fk_detalle_prestamo FOREIGN KEY (id_prestamo) 
        REFERENCES Prestamos (id_prestamo),
    CONSTRAINT fk_detalle_equipo FOREIGN KEY (id_equipo) 
        REFERENCES Equipos_Inventario (id_equipo)
);

-- 8. TABLA REPORTES (Daños o mantenimientos)
CREATE TABLE Reportes (
    id_reporte   INT          NOT NULL AUTO_INCREMENT,
    tipo_reporte VARCHAR(25)  NOT NULL,
    descripcion  VARCHAR(100),
    prioridad    VARCHAR(25),
    fecha        DATE         NOT NULL,
    id_equipo    INT          NOT NULL,
    id_usuarios  INT          NOT NULL,
    id_admin     INT          NOT NULL,
    PRIMARY KEY (id_reporte),
    CONSTRAINT fk_reporte_equipo     FOREIGN KEY (id_equipo)   REFERENCES Equipos_Inventario (id_equipo),
    CONSTRAINT fk_reporte_usuario    FOREIGN KEY (id_usuarios) REFERENCES Usuarios (id_usuarios),
    CONSTRAINT fk_reporte_admin      FOREIGN KEY (id_admin)    REFERENCES Administrador (id_admin)
);

-- 9. TABLA HISTORIAL_EQUIPOS
CREATE TABLE Historial_Equipos (
    id_historial INT          NOT NULL AUTO_INCREMENT,
    id_equipo    INT          NOT NULL,
    fecha        DATE         NOT NULL,
    descripcion  VARCHAR(100),
    PRIMARY KEY (id_historial),
    CONSTRAINT fk_historial_equipo FOREIGN KEY (id_equipo) 
        REFERENCES Equipos_Inventario (id_equipo)
);

-- ==========================================
-- INSERTS INICIALES (DATOS BASE)
-- ==========================================

-- Administradores (Login: scampos@ufide.ac.c / admin123)
INSERT INTO Administrador (nombre, email, password, rol, estado) VALUES
('Steven Campos',  'scampos@ufide.ac.c',  'admin123', 'superadmin', 'activo'),
('Pablo Barquero', 'pbarquero@ufide.ac.c', 'pass456',  'admin',      'activo');

-- Usuarios de prueba
INSERT INTO Usuarios (nombre, cedula, email, telefono, tipo_usuario, estado) VALUES
('Ana Jiménez',  '1-1234-5678', 'ajimenez@ufide.ac.cr', '8800-1111', 'alumno',   'activo'),
('Pedro Solano', '2-2345-6789', 'psolano@ufide.ac.cr',  '8800-2222', 'alumno',   'activo'),
('Prof. Díaz',   '4-4567-8901', 'rdiaz@ufide.ac.cr',    '8800-4444', 'profesor', 'activo');

-- Categorías
INSERT INTO Categoria (nombre) VALUES 
('Laptop'), ('Tablet'), ('Proyector'), ('Cámara'), ('Accesorios');

-- Equipos (Todos DISPONIBLES para iniciar el Dashboard en 0)
INSERT INTO Equipos_Inventario (codigo_inventario, nombre, marca, marcamodelo, numero_serie, id_categoria, estado) VALUES
('EQ-001', 'Laptop HP Pavilion',    'HP',      'Pavilion 15',  'SN-HP001', 1, 'disponible'),
('EQ-002', 'Laptop Dell Inspiron',  'Dell',    'Inspiron 14',  'SN-DL002', 1, 'disponible'),
('EQ-003', 'Tablet Samsung',        'Samsung', 'Galaxy Tab A8', 'SN-SM003', 2, 'disponible'),
('EQ-004', 'Proyector Epson',       'Epson',   'EB-X51',        'SN-EP004', 3, 'disponible'),
('EQ-005', 'Cámara Canon',          'Canon',   'EOS Rebel T7',  'SN-CN005', 4, 'disponible');