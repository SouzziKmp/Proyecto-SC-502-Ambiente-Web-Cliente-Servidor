

CREATE DATABASE IF NOT EXISTS prestamos_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE prestamos_db;




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

CREATE TABLE Usuarios (
    id_usuarios  INT          NOT NULL AUTO_INCREMENT,
    nombre       VARCHAR(50)  NOT NULL,
    cedula       VARCHAR(20)  NOT NULL UNIQUE,
    email        VARCHAR(50)  NOT NULL UNIQUE,
    telefono     VARCHAR(50),
    tipo_usuario VARCHAR(20)  NOT NULL,  -- 'alumno' | 'profesor'
    estado       VARCHAR(50)  NOT NULL DEFAULT 'activo',
    PRIMARY KEY (id_usuarios)
);

CREATE TABLE Categoria (
    id_categoria INT         NOT NULL AUTO_INCREMENT,
    nombre       VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_categoria)
);


-- EQUIPOS / INVENTARIO


CREATE TABLE Equipos_Inventario (
    id_equipo         INT          NOT NULL AUTO_INCREMENT,
    codigo_inventario VARCHAR(50)  NOT NULL UNIQUE,
    nombre            VARCHAR(50)  NOT NULL,
    marca             VARCHAR(50),
    marcamodelo       VARCHAR(50),
    id_categoria      INT          NOT NULL,
    estado            VARCHAR(50)  NOT NULL DEFAULT 'disponible',
    PRIMARY KEY (id_equipo),
    CONSTRAINT fk_equipo_categoria FOREIGN KEY (id_categoria)
        REFERENCES Categoria (id_categoria)
);


-- PRÉSTAMOS


CREATE TABLE Prestamos (
    id_prestamo    INT          NOT NULL AUTO_INCREMENT,
    id_usuario     INT          NOT NULL,
    fecha_prestamo DATE         NOT NULL,
    fecha_devo_esti DATE        NOT NULL,
    fecha_devo_real DATE,
    estado         VARCHAR(50)  NOT NULL DEFAULT 'activo',
    PRIMARY KEY (id_prestamo),
    CONSTRAINT fk_prestamo_usuario FOREIGN KEY (id_usuario)
        REFERENCES Usuarios (id_usuarios)
);

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


-- REPORTES


CREATE TABLE Reportes (
    id_reporte   INT          NOT NULL AUTO_INCREMENT,
    tipo_reporte VARCHAR(25)  NOT NULL,
    descripcion  VARCHAR(25),
    prioridad    VARCHAR(25),
    fecha        DATE         NOT NULL,
    id_equipo    INT          NOT NULL,
    id_usuarios  INT          NOT NULL,
    id_admin     INT          NOT NULL,
    PRIMARY KEY (id_reporte),
    CONSTRAINT fk_reporte_equipo    FOREIGN KEY (id_equipo)   REFERENCES Equipos_Inventario (id_equipo),
    CONSTRAINT fk_reporte_usuario   FOREIGN KEY (id_usuarios) REFERENCES Usuarios (id_usuarios),
    CONSTRAINT fk_reporte_admin     FOREIGN KEY (id_admin)    REFERENCES Administrador (id_admin)
);


-- HISTORIAL DE EQUIPOS


CREATE TABLE Historial_Equipos (
    id_historial INT          NOT NULL AUTO_INCREMENT,
    id_equipo    INT          NOT NULL,
    fecha        DATE         NOT NULL,
    descripcion  VARCHAR(100),
    PRIMARY KEY (id_historial),
    CONSTRAINT fk_historial_equipo FOREIGN KEY (id_equipo)
        REFERENCES Equipos_Inventario (id_equipo)
);



-- INSERTS DE PRUEBA


-- Administradores
INSERT INTO Administrador (nombre, email, password, rol, estado) VALUES
('Steven Campos',  'scampos@ufide.ac.c',  'admin123', 'superadmin', 'activo'),
('Pablo Barquero',   'pbarquero@ufide.ac.c',  'pass456',  'admin',      'activo'),
('Sol Cuadra',  'scuadra@ufide.ac.c',   'pass789',  'admin',      'inactivo');

-- Usuarios (Alumnos y Profesores)
INSERT INTO Usuarios (nombre, cedula, email, telefono, tipo_usuario, estado) VALUES
('Ana Jiménez',    '1-1234-5678', 'ajimenez@ufide.ac.c',  '8800-1111', 'alumno',   'activo'),
('Pedro Solano',   '2-2345-6789', 'psolano@ufide.ac.c',   '8800-2222', 'alumno',   'activo'),
('María Torres',   '3-3456-7890', 'mtorres@ufide.ac.c',   '8800-3333', 'alumno',   'activo'),
('Prof. Díaz',     '4-4567-8901', 'rdiaz@ufide.ac.c',            '8800-4444', 'profesor', 'activo'),
('Prof. Arias',    '5-5678-9012', 'carias@ufide.ac.cr',           '8800-5555', 'profesor', 'activo');

-- Categorías
INSERT INTO Categoria (nombre) VALUES
('Laptop'),
('Tablet'),
('Proyector'),
('Cámara'),
('Cables y Adaptadores');

-- Equipos / Inventario
INSERT INTO Equipos_Inventario (codigo_inventario, nombre, marca, marcamodelo, id_categoria, estado) VALUES
('EQ-001', 'Laptop HP Pavilion',    'HP',     'Pavilion 15',    1, 'disponible'),
('EQ-002', 'Laptop Dell Inspiron',  'Dell',   'Inspiron 14',    1, 'prestado'),
('EQ-003', 'Tablet Samsung',        'Samsung','Galaxy Tab A8',  2, 'disponible'),
('EQ-004', 'Proyector Epson',       'Epson',  'EB-X51',         3, 'disponible'),
('EQ-005', 'Cámara Canon',          'Canon',  'EOS Rebel T7',   4, 'prestado'),
('EQ-006', 'Adaptador HDMI-USB C',  'Anker',  'A83460A1',       5, 'disponible');

-- Préstamos
INSERT INTO Prestamos (id_usuario, fecha_prestamo, fecha_devo_esti, fecha_devo_real, estado) VALUES
(1, '2025-04-01', '2025-04-05', '2025-04-04', 'devuelto'),
(2, '2025-04-10', '2025-04-14', NULL,          'activo'),
(4, '2025-04-12', '2025-04-13', '2025-04-13', 'devuelto'),
(3, '2025-04-15', '2025-04-17', NULL,          'activo');

-- Detalle de Préstamos
INSERT INTO Detalle_Prestamo (id_prestamo, id_equipo) VALUES
(1, 1),   -- préstamo 1 → Laptop HP
(2, 2),   -- préstamo 2 → Laptop Dell
(2, 6),   -- préstamo 2 → Adaptador
(3, 4),   -- préstamo 3 → Proyector
(4, 5);   -- préstamo 4 → Cámara Canon

-- Reportes
INSERT INTO Reportes (tipo_reporte, descripcion, prioridad, fecha, id_equipo, id_usuarios, id_admin) VALUES
('daño',       'Pantalla rayada',     'alta',  '2025-04-05', 1, 1, 1),
('extravío',   'Cargador faltante',   'media', '2025-04-14', 2, 2, 2),
('mantenimiento','Revisión general',  'baja',  '2025-04-13', 4, 4, 1);

-- Historial de Equipos
INSERT INTO Historial_Equipos (id_equipo, fecha, descripcion) VALUES
(1, '2025-04-05', 'Devuelto con pantalla rayada. Se envía a revisión.'),
(1, '2025-04-08', 'Pantalla reparada. Equipo disponible nuevamente.'),
(2, '2025-04-10', 'Préstamo activo - estudiante Pedro Solano.'),
(4, '2025-04-13', 'Usado en clase magistral. Devuelto en buen estado.'),
(5, '2025-04-15', 'Préstamo activo - estudiante María Torres.');



