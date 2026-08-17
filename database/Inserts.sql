-- =========================================================
-- Datos de prueba: Donaciones y Solicitudes
-- Base de datos: techdonaciones
-- Generado: 17 de agosto de 2026
-- =========================================================

USE `techdonaciones`;

-- ---------------------------------------------------------
-- Donaciones de prueba (30 registros, Mar - Ago 2026)
-- ---------------------------------------------------------
INSERT INTO `donaciones`
    (`nombreDonador`, `correoDonador`, `telefonoDonador`, `tipoDonador`, `detalleDonador`,
     `idTipoEquipo`, `marca`, `modelo`, `estadoEquipo`, `cantidadEquipos`,
     `descripcionAdicional`, `estado`, `comentarioAdministrador`, `fechaRegistro`, `fechaRevision`, `idAdministrador`)
VALUES
    -- Marzo 2026 (3)
    ('Carlos Mendoza', 'carlos.mendoza@gmail.com', '8888-1234', 'Persona Fisica', NULL,
     1, 'Lenovo', 'ThinkPad X1 Carbon', 'Bueno', 1,
     'Laptop usada en buen estado, funciona perfectamente', 'Completada', 'Equipo recibido en buen estado.', '2026-03-05 09:15:00', '2026-03-10 14:30:00', 1),

    ('Empresa TechCR S.A.', 'donaciones@techcr.co', '2222-5678', 'Empresa', 'Depto. de TI',
     2, 'HP', 'ProDesk 400 G7', 'Bueno', 5,
     '5 escritorios de oficina central, actualizados a Windows 11', 'Completada', 'Equipos verificados y clasificados.', '2026-03-12 11:00:00', '2026-03-18 10:00:00', 1),

    ('María José Vargas', 'mj.vargas@hotmail.com', '8777-3456', 'Persona Fisica', NULL,
     3, 'Samsung', 'S24F350', 'Regular', 2,
     'Monitores con pequeña mancha en la esquina inferior derecha', 'Aceptada', NULL, '2026-03-22 16:45:00', NULL, NULL),

    -- Abril 2026 (4)
    ('Roberto Jiménez', 'rjimenez@outlook.com', '8666-7890', 'Persona Fisica', NULL,
     4, 'Logitech', 'K120', 'Nuevo', 10,
     'Teclados nuevos sin usar, sobrantes de inventario', 'Completada', 'Producto nuevo, excelente condición.', '2026-04-02 08:30:00', '2026-04-05 09:00:00', 1),

    ('Fundación Educar', 'contacto@fundareducar.org', '2255-4321', 'Empresa', 'Proyecto de Donación',
     1, 'Dell', 'Latitude 5420', 'Bueno', 8,
     'Laptops decomisadas por el Ministerio de Educación', 'Aceptada', 'Donación autorizada por el comité.', '2026-04-10 14:20:00', '2026-04-15 11:00:00', 1),

    ('Andrea Solís', 'andrea.solis@gmail.com', '8555-2345', 'Persona Fisica', NULL,
     5, 'Logitech', 'M185', 'Bueno', 4,
     'Mouses inalámbricos funcionales', 'Rechazada', 'No se aceptan mice inalámbricos por política de compatibilidad.', '2026-04-18 10:00:00', '2026-04-20 16:30:00', 1),

    ('Pedro Alvarado', 'palvarado@empresa.co', '8444-6789', 'Persona Fisica', NULL,
     6, 'Apple', 'iPad Air 2', 'Malo', 1,
     'Tablet con pantalla agrietada pero enciende', 'Pendiente', NULL, '2026-04-28 13:00:00', NULL, NULL),

    -- Mayo 2026 (5)
    ('Banco Nacional CR', 'responsabilidad.social@bn.cr', '2211-9876', 'Empresa', 'Gerencia de RRSS',
     2, 'Lenovo', 'V530', 'Bueno', 12,
     '12 equipos de escritorio con monitor incluido', 'Completada', 'Equipos procesados y distribuidos.', '2026-05-03 09:00:00', '2026-05-08 15:00:00', 1),

    ('Laura Fonseca', 'laura.fonseca@yahoo.com', '8333-1111', 'Persona Fisica', NULL,
     7, 'Epson', 'L210', 'Regular', 1,
     'Impresora multifunción, funciona pero consume mucha tinta', 'Aceptada', NULL, '2026-05-09 11:30:00', '2026-05-12 14:00:00', 1),

    ('Universidad Estatal', 'donaciones@ue.ac.cr', '2277-2222', 'Empresa', 'Vicerrectoría Académica',
     1, 'HP', 'EliteBook 840 G5', 'Bueno', 15,
     'Laptops de laboratorio de computación, ciclo 2024-2025', 'Completada', 'Lote completo verificado.', '2026-05-15 08:00:00', '2026-05-20 10:30:00', 1),

    ('José Rivera', 'jose.rivera@gmail.com', '8222-3333', 'Persona Fisica', NULL,
     8, 'Dell', 'PowerEdge T30', 'Bueno', 1,
     'Servidor pequeño sin disco duro, solo carcasa y fuente', 'Rechazada', 'Servidor sin componentes mínimos para funcionamiento.', '2026-05-20 15:45:00', '2026-05-22 09:00:00', 1),

    ('Carmen Rojas', 'carmen.rojas@hotmail.com', '8111-4444', 'Persona Fisica', NULL,
     9, 'Epson', 'EB-W52', 'Regular', 1,
     'Proyector con lámpora al 40% de vida útil', 'Pendiente', NULL, '2026-05-25 10:15:00', NULL, NULL),

    ('Constructora Horizonte', 'ti@horizonte.co.cr', '2233-5555', 'Empresa', 'Área de Sistemas',
     3, 'LG', '24MP48HQ', 'Bueno', 6,
     'Monitores 24 pulgados Full HD', 'Aceptada', 'Monitores en excelente estado.', '2026-05-28 14:00:00', '2026-06-01 09:00:00', 1),

    -- Junio 2026 (5)
    ('Felipe Arias', 'farias@outlook.com', '8000-6666', 'Persona Fisica', NULL,
     10, 'Samsung', 'Galaxy Tab A', 'Bueno', 2,
     'Tablets para niños en escuela rural', 'Completada', 'Tablets funcionales, se entregarán a escuela.', '2026-06-02 09:30:00', '2026-06-07 11:00:00', 1),

    ('Ministerio de Educación', 'donaciones@mep.go.cr', '2222-7777', 'Empresa', 'Dirección de Tecnología',
     1, 'Acer', 'TravelMate P215', 'Bueno', 20,
     'Laptops del programa «Una Laptop por Niño» ciclo anterior', 'Completada', 'Gran lote recibido y procesado.', '2026-06-08 08:00:00', '2026-06-12 14:00:00', 1),

    ('Isabela Montero', 'isabela.m@gmail.com', '8999-8888', 'Persona Fisica', NULL,
     4, 'Microsoft', 'Wireless Keyboard 850', 'Nuevo', 3,
     'Teclados inalámbricos nuevos en caja', 'Pendiente', NULL, '2026-06-15 16:20:00', NULL, NULL),

    ('Cooperativa COOPEADEA', 'info@coopeadea.co.cr', '2466-1234', 'Empresa', 'Gerencia General',
     2, 'HP', 'Compaq Pro 6300', 'Regular', 4,
     'Equipos de oficina con 5 años de uso', 'Aceptada', 'Aprobados para reacondicionamiento.', '2026-06-20 10:00:00', '2026-06-25 13:00:00', 1),

    ('Daniel Campos', 'dcampos@correo.co', '8888-9999', 'Persona Fisica', NULL,
     11, 'Otro', 'Sin marca identificable', 'Malo', 1,
     'Equipo desconocido, posiblemente parte de servidor', 'Rechazada', 'Equipo sin identificación ni funcionalidad.', '2026-06-28 11:45:00', '2026-06-30 09:00:00', 1),

    -- Julio 2026 (5)
    ('Hospital San Rafael', 'compras@hsr.go.cr', '2256-8888', 'Empresa', 'Depto. de Equipamiento',
     3, 'Dell', 'P2419H', 'Bueno', 3,
     'Monitores de estaciones de trabajo migradas', 'Completada', 'Monitores verificados, buen estado.', '2026-07-01 09:00:00', '2026-07-05 10:00:00', 1),

    ('Gabriela Espinoza', 'gabi.espinoza@gmail.com', '8777-1234', 'Persona Fisica', NULL,
     6, 'Samsung', 'Galaxy Tab S6 Lite', 'Bueno', 1,
     'Tablet con estuche y cargador, poco uso', 'Pendiente', NULL, '2026-07-08 14:30:00', NULL, NULL),

    ('Iglesia Vida Nueva', 'vidanueva@iglesia.cr', '2444-5678', 'Persona Fisica', NULL,
     1, 'Acer', 'Aspire 5', 'Regular', 3,
     'Laptops donadas por feligreses, 3 funcionales y 1 con falla', 'Aceptada', 'Se aceptan 3 de 4, la con falla fue rechazada.', '2026-07-15 11:00:00', '2026-07-18 15:00:00', 1),

    ('Red de Bibliotecas', 'contacto@redbibliotecas.org', '2211-3344', 'Empresa', 'Coordinación Central',
     7, 'Brother', 'DCP-T220', 'Bueno', 5,
     'Impresoras multifunción con tinta original', 'Completada', 'Equipos en buen estado, tinta incluida.', '2026-07-22 08:30:00', '2026-07-26 12:00:00', 1),

    ('Sandra Pereira', 'spereira@live.com', '8666-2222', 'Persona Fisica', NULL,
     5, 'HP', 'Wireless Mouse', 'Nuevo', 2,
     'Mouses nuevos en paquete', 'Pendiente', NULL, '2026-07-29 16:00:00', NULL, NULL),

    -- Agosto 2026 (8)
    ('Farmacia Fischel', 'responsabilidad@fischel.co.cr', '2220-4444', 'Empresa', 'Depto. de Logística',
     2, 'Lenovo', 'ThinkCentre M920t', 'Bueno', 6,
     'Escritorios de sedes centrales renovados', 'Pendiente', NULL, '2026-08-01 09:00:00', NULL, NULL),

    ('Mauricio León', 'mauricio.leon@gmail.com', '8555-6666', 'Persona Fisica', NULL,
     1, 'Dell', 'Inspiron 15 3000', 'Regular', 1,
     'Laptop con batería degradada, funciona con cargador', 'Pendiente', NULL, '2026-08-03 11:30:00', NULL, NULL),

    ('Escuela Monseñor Sanabria', 'direccion@emsanabria.ed.cr', '2478-1111', 'Persona Fisica', NULL,
     3, 'Acer', 'V227Q', 'Bueno', 4,
     'Monitores de laboratorio de informática', 'Aceptada', 'Monitores aptos para uso escolar.', '2026-08-05 10:00:00', '2026-08-08 14:00:00', 1),

    ('KFC Costa Rica', 'donaciones@kfc.co.cr', '2288-7777', 'Empresa', 'Recursos Humanos',
     4, 'Logitech', 'MK270', 'Nuevo', 15,
     'Set teclado + mouse inalámbricos, nuevos sobrantes', 'Pendiente', NULL, '2026-08-08 13:00:00', NULL, NULL),

    ('Tatiana Vargas', 'tati.vargas@yahoo.com', '8444-8888', 'Persona Fisica', NULL,
     10, 'Huawei', 'MediaPad T3', 'Regular', 1,
     'Tablet con carcasa rota pero pantalla intacta', 'Pendiente', NULL, '2026-08-10 09:45:00', NULL, NULL),

    ('Grupo DISA', 'ti@disa.co.cr', '2233-9999', 'Empresa', 'Infraestructura TI',
     8, 'HPE', 'ProLiant ML30', 'Bueno', 2,
     'Servidores de oficina descontinuados, funcionales', 'Pendiente', NULL, '2026-08-12 08:00:00', NULL, NULL),

    ('Luis Fernando Quesada', 'lfquesada@outlook.com', '8333-5555', 'Persona Fisica', NULL,
     9, 'Epson', 'EB-W51', 'Bueno', 1,
     'Proyector con bajo uso, less de 500 horas', 'Pendiente', NULL, '2026-08-14 15:00:00', NULL, NULL),

    ('Coca-Cola FEMSA', 'sostenibilidad@femsa.co.cr', '2255-6666', 'Empresa', 'Depto. de Sostenibilidad',
     1, 'HP', 'ProBook 450 G8', 'Bueno', 10,
     'Laptops de oficinas corporativas en ciclo de renovación', 'Pendiente', NULL, '2026-08-16 10:30:00', NULL, NULL);

-- ---------------------------------------------------------
-- Solicitudes de prueba (20 registros, Mar - Ago 2026)
-- ---------------------------------------------------------
INSERT INTO `solicitudes`
    (`nombreSolicitante`, `correoSolicitante`, `telefonoSolicitante`,
     `nombreOrganizacion`, `idTipoOrganizacion`, `idTipoEquipo`,
     `cantidadEquipos`, `motivoSolicitud`, `estado`,
     `comentarioAdministrador`, `fechaRegistro`, `fechaRevision`, `idAdministrador`)
VALUES
    -- Marzo 2026 (3)
    ('Ana Lucía Méndez', 'ana.mendez@escuela15.ed.cr', '2478-1234',
     'Escuela República de Italia', 1, 1,
     10, 'Necesitamos 10 laptops para el laboratorio de informática que atiende a 200 alumnos de primaria. Actualmente solo contamos con 3 equipos obsoletos.',
     'Completada', 'Solicitud aprobada. Equipos entregados el 20/03.', '2026-03-03 08:00:00', '2026-03-08 10:00:00', 1),

    ('Carlos Ramírez', 'cramirez@colegiosol.ed.cr', '2222-5678',
     'Colegio Sol Naciente', 2, 3,
     5, 'Requerimos 5 monitores para las estaciones de la biblioteca del colegio. Los actuales presentan parpadeo constante.',
     'Aceptada', NULL, '2026-03-15 14:30:00', '2026-03-20 09:00:00', 1),

    ('María Elena Rojas', 'merojas@fundacionpaz.org', '8888-3456',
     'Fundación Paz y Bien', 4, 2,
     8, 'Buscamos 8 computadoras de escritorio para equipar el centro de capacitación digital que atiende a adultos mayores del cantón de Tibás.',
     'Pendiente', NULL, '2026-03-25 11:00:00', NULL, NULL),

    -- Abril 2026 (3)
    ('Roberto Cascante', 'rcascante@universidad.cr', '2277-8901',
     'Universidad Técnica Nacional', 3, 1,
     20, 'Solicitamos 20 laptops para el programa de becas estudiantiles del semestre 2026-I. Los estudiantes no cuentan con recursos para adquirir equipo propio.',
     'Aceptada', NULL, '2026-04-05 09:00:00', '2026-04-10 14:00:00', 1),

    ('Patricia Mora', 'pmora@asociaciondelnorte.org', '2466-7890',
     'Asociación de Desarrollo del Norte', 5, 4,
     30, 'Necesitamos 30 teclados para el centro de capacitación que estamos habilitando para comunidades rurales.',
     'Pendiente', NULL, '2026-04-18 10:30:00', NULL, NULL),

    ('Francisco Solano', 'fsolano@comunidaddespino.cr', '8777-4567',
     'Comunidad de Desarrollo Espino', 6, 5,
     15, 'Solicitamos 15 mice para las computadoras del aula de informática comunitaria. Actualmente hay 10 computadoras sin periféricos.',
     'Rechazada', 'No contamos con mice en inventario en este momento. Se sugiere reactivar en el próximo ciclo de donaciones.', '2026-04-22 15:00:00', '2026-04-25 11:00:00', 1),

    -- Mayo 2026 (4)
    ('Gabriela Chaves', 'gchaves@emprendedorescr.com', '8666-2345',
     'Red de Emprendedores del Valle', 7, 1,
     5, 'Como emprendedores necesitamos 5 laptops para nuestro programa de capacitación tecnológica para jóvenes en situación de vulnerabilidad.',
     'Aceptada', NULL, '2026-05-02 08:30:00', '2026-05-06 10:00:00', 1),

    ('Municipalidad de Goicoechea', 'tecnologia@munic.go.cr', '2234-5678',
     'Municipalidad de Goicoechea', 8, 2,
     12, 'Requerimos 12 computadoras de escritorio para reemplazar los equipos del SINART que presentan fallas crónicas.',
     'Completada', 'Equipos entregados el 18/05. Funcionando correctamente.', '2026-05-10 09:00:00', '2026-05-18 14:00:00', 1),

    ('Iglesia Monte Sión', 'montesion@iglesia.cr', '2455-6789',
     'Iglesia Monte Sión', 9, 7,
     3, 'Necesitamos 3 impresoras para administrar la documentación del programa social que atiende a 150 familias.',
     'Pendiente', NULL, '2026-05-20 13:00:00', NULL, NULL),

    ('Diana Montero', 'dmontero@colegiosanpedro.ed.cr', '2211-3456',
     'Colegio San Pedro Apóstol', 2, 6,
     5, 'Solicitamos 5 tablets para el programa de educación inclusiva del colegio, destinadas a alumnos con necesidades educativas especiales.',
     'Aceptada', NULL, '2026-05-28 10:00:00', '2026-06-02 09:00:00', 1),

    -- Junio 2026 (3)
    ('Fundación Maestría', 'contacto@fundacionmaestria.org', '2288-7890',
     'Fundación Maestría Educativa', 4, 1,
     15, 'Requerimos 15 laptops para el programa de alfabetización digital en zonas rurales de Limón y Puntarenas.',
     'Completada', 'Equipos distribuidos exitosamente.', '2026-06-05 08:00:00', '2026-06-12 11:00:00', 1),

    ('Eduardo Umaña', 'eumana@escuelaelena.ed.cr', '2477-8901',
     'Escuela Elena Quirós', 1, 3,
     8, 'Necesitamos 8 monitores para el centro de computo. Los actuales tienen más de 10 años de uso.',
     'Rechazada', 'No hay monitores disponibles en inventario actual. Se programará para el próximo lote.', '2026-06-18 14:00:00', '2026-06-22 09:30:00', 1),

    ('Liga Deportiva Alajuelita', 'ldalajuelita@deporte.cr', '8555-1234',
     'Liga Deportiva Alajuelita', 5, 2,
     4, 'Solicitamos 4 computadoras para digitalizar los registros deportivos de más de 500 atletas.',
     'Pendiente', NULL, '2026-06-25 11:30:00', NULL, NULL),

    -- Julio 2026 (4)
    ('Claudia Arce', 'carce@universidadveritas.ac.cr', '2255-4321',
     'Universidad Veritas', 3, 1,
     25, 'Programa de Responsabilidad Social: 25 laptops para estudiantes de arquitectura de escasos recursos.',
     'Aceptada', NULL, '2026-07-02 09:00:00', '2026-07-07 14:00:00', 1),

    ('Asociación de Dueños de Montecillos', 'adm@montecillos.org', '2466-5678',
     'Asociación Montecillos', 5, 9,
     2, 'Necesitamos 2 proyectores para las asambleas comunitarias y talleres de capacitación.',
     'Pendiente', NULL, '2026-07-10 10:00:00', NULL, NULL),

    ('Centro de Ancianos Hogar Paz', 'direccion@hogarpaz.org', '2277-6789',
     'Centro de Ancianos Hogar Paz', 4, 2,
     3, 'Buscamos 3 computadoras para que los residentes puedan comunicarse con sus familiares por videollamada.',
     'Completada', 'Equipos entregados e instalados.', '2026-07-18 08:30:00', '2026-07-23 10:00:00', 1),

    ('Programa CR Futuro', 'info@crfuturo.org', '2288-8901',
     'Programa CR Futuro', 4, 1,
     12, 'Solicitamos 12 laptops para el programa de capacitación en programación para jóvenes de 15-25 años.',
     'Pendiente', NULL, '2026-07-28 15:00:00', NULL, NULL),

    -- Agosto 2026 (3)
    ('Escuela Rural Los Angeles', 'director@losangeles.ed.cr', '2499-1234',
     'Escuela Rural Los Ángeles', 1, 1,
     8, 'Escuela rural con 80 alumnos sin acceso a tecnología. Necesitamos urgentemente 8 laptops para implementar el currículo digital.',
     'Pendiente', NULL, '2026-08-02 08:00:00', NULL, NULL),

    ('COOPENAE', 'sostenibilidad@coopenae.fi.cr', '2211-2345',
     'Cooperativa COOPENAE', 10, 2,
     10, 'Donación solidaria: 10 escritorios de nuestra sede central que fueron renovados.',
     'Pendiente', NULL, '2026-08-10 09:00:00', NULL, NULL),

    ('Red Nacional de Bibliotecas', 'proyectos@rednacionalbib.cr', '2233-3456',
     'Red Nacional de Bibliotecas Públicas', 8, 7,
     20, 'Solicitamos 20 impresoras para las 20 bibliotecas públicas participantes del programa «Tecnología para Todos».',
     'Pendiente', NULL, '2026-08-15 11:00:00', NULL, NULL);
