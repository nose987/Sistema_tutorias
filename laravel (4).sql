-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql:3306
-- Tiempo de generación: 31-10-2025 a las 05:25:02
-- Versión del servidor: 8.0.32
-- Versión de PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `pk_actividad` int NOT NULL,
  `fk_tipo_actividad` int DEFAULT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estatus` enum('Pendiente','Realizada') COLLATE utf8mb4_unicode_ci DEFAULT 'Pendiente',
  `asistencia` int DEFAULT NULL COMMENT 'Cantidad de asistentes a la actividad'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`pk_actividad`, `fk_tipo_actividad`, `nombre`, `fecha`, `estatus`, `asistencia`) VALUES
(1, 1, 'reunion epicarda', '2025-10-29', 'Pendiente', 9999),
(2, 1, 'nosealgo', '2025-10-31', 'Realizada', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `pk_alumno` int NOT NULL,
  `fk_grupo` int DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_paterno` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carrera` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_materno` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_padre` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `padre_edad` int DEFAULT NULL,
  `padre_profesion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_madre` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `madre_edad` int DEFAULT NULL,
  `madre_profesion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hermanos_info` text COLLATE utf8mb4_unicode_ci COMMENT 'Para guardar edad y ocupación',
  `tiene_hijos` tinyint(1) DEFAULT '0' COMMENT '0=No, 1=Si',
  `trabaja` tinyint(1) DEFAULT '0' COMMENT '0=No, 1=Si',
  `recibe_apoyo_familiar` tinyint(1) DEFAULT '0' COMMENT '0=No, 1=Si',
  `tiene_beca` tinyint(1) DEFAULT '0' COMMENT '0=No, 1=Si',
  `tipo_beca` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Especificación de la beca',
  `contacto_emergencia_nombre` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Contacto en caso de Emergencia',
  `contacto_emergencia_telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Teléfono de emergencia',
  `contacto_emergencia_celular` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Celular de emergencia',
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `estatus` enum('Activo','Baja') COLLATE utf8mb4_unicode_ci DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`pk_alumno`, `fk_grupo`, `nombre`, `apellido_paterno`, `carrera`, `apellido_materno`, `fecha_nacimiento`, `telefono`, `celular`, `nombre_padre`, `padre_edad`, `padre_profesion`, `nombre_madre`, `madre_edad`, `madre_profesion`, `hermanos_info`, `tiene_hijos`, `trabaja`, `recibe_apoyo_familiar`, `tiene_beca`, `tipo_beca`, `contacto_emergencia_nombre`, `contacto_emergencia_telefono`, `contacto_emergencia_celular`, `direccion`, `estatus`) VALUES
(1, 2, 'Ut enim quasi vero i', 'Ullam nobis dolore c', 'Ingeniería industrial', 'Laborum modi consequ', '2023-05-15', '+1 (751) 238-6461', '+1 (502) 123-9984', 'Quos ut nostrum beat', 75, 'At quia quasi sint d', 'Vel consequatur Quo', 3, 'Corporis nisi commod', 'Velit vitae asperior', 0, 1, 0, 0, 'Nam architecto accus', 'Id et deserunt magni', '+1 (578) 721-3423', '+1 (972) 545-3703', 'Dolorem blanditiis e', 'Activo'),
(2, 1, 'Laborum et sunt quia', 'Eum veniam voluptat', 'Mecatrónica', 'Explicabo Veniam c', '2025-06-25', '+1 (409) 136-8657', '+1 (589) 541-8341', 'Et earum nulla minus', 68, 'Quasi ut incidunt a', 'Qui labore ducimus', 15, 'Incidunt eiusmod es', 'Unde nemo expedita n', 0, 0, 0, 1, 'Sit illo velit et v', 'Voluptas in autem fu', '+1 (836) 585-4424', '+1 (529) 465-2147', 'Occaecat quis illum', 'Activo'),
(3, 1, 'Jesús', 'Manjarrez', 'Desarrollo y gestión de software', 'Híjar', '2004-03-08', '6941088240', '6941088240', 'Armando', 70, 'Agricultor', 'Teresa', 50, 'Ama de casa', 'Ana, biomédica 26 años', 0, 0, 1, 1, 'Jovenes escribiendo el futuro', 'Teresa de Jesus Hijar Lopez', '6941088240', '6941088240', 'Rafael Buelna 47\r\nPablo de Villavicencio', 'Activo'),
(4, 2, 'Magna ullam consequa', 'Voluptatum repudiand', 'Redes digitales', 'Fugit ut quam culpa', '1989-07-16', '+1 (179) 654-1944', '+1 (984) 934-7736', 'Fugit ut non nesciu', 69, 'Est sunt Nam expedi', 'Esse quo culpa eu s', 31, 'Voluptatem est cons', 'Recusandae Laborum', 1, 1, 0, 1, 'Minima in provident', 'Laboris eaque et nul', '+1 (679) 507-6094', '+1 (148) 271-9092', 'Molestias earum sint', 'Activo'),
(11, 2, 'Blanditiis excepturi', 'Sed et optio ipsa', 'Mecatrónica', 'Aut dignissimos eius', '1978-08-24', '+1 (984) 628-6344', '+1 (633) 412-4484', 'Nihil consequatur co', 89, 'Laboriosam magna of', 'Itaque in veniam ni', 20, 'Perspiciatis ut et', 'Earum qui occaecat v', 0, 1, 0, 0, 'Soluta voluptate exp', 'Temporibus sunt lab', '+1 (345) 643-7737', '+1 (881) 258-2416', 'Voluptatem aspernatu', 'Activo'),
(12, 1, 'Amet autem numquam', 'Dignissimos commodi', 'Desarrollo y gestión de software', 'Earum quisquam eius', '2016-04-09', '+1 (312) 726-5611', '+1 (974) 892-8731', 'Ut hic duis eum quis', 62, 'Nisi sint facere es', 'Beatae odit qui aliq', 61, 'Libero quia nulla en', 'Itaque incidunt est', 0, 1, 0, 0, 'At voluptatem Aut e', 'Et aspernatur et aut', '+1 (382) 111-8235', '+1 (819) 776-1813', 'Vel iusto minus opti', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_estadia`
--

CREATE TABLE `alumno_estadia` (
  `pk_alumno_estadia` int NOT NULL,
  `fk_alumno` int DEFAULT NULL,
  `fk_empresa` int DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `estatus` enum('En curso','Finalizada') COLLATE utf8mb4_unicode_ci DEFAULT 'En curso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedentes_escolares`
--

CREATE TABLE `antecedentes_escolares` (
  `pk_antecedentes_escolares` int NOT NULL,
  `fk_alumno` int DEFAULT NULL,
  `institucion_preparatoria` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Institución en la que cursó Preparatoria',
  `ciclo_preparatoria` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Ciclo de preparatoria',
  `estudio_universidad_anterior` tinyint(1) DEFAULT '0' COMMENT '0=No, 1=Sí',
  `universidad_anterior_y_carrera_anterior` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `universidad_anterior_tiempo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '¿Hace cuánto tiempo?',
  `universidad_anterior_motivo_salida` text COLLATE utf8mb4_unicode_ci COMMENT 'Motivo por el que ya no siguió estudiando ahí',
  `rendimiento_cuatris_anteriores` text COLLATE utf8mb4_unicode_ci COMMENT '¿Cómo te ha ido en los cuatrimestres anteriores?',
  `perdio_cuatrimestre` tinyint(1) DEFAULT '0' COMMENT '¿Has perdido algún cuatrimestre?',
  `perdio_cuatrimestre_causa` text COLLATE utf8mb4_unicode_ci COMMENT 'Causa de la pérdida y materia',
  `rendimiento_cuatri_actual` text COLLATE utf8mb4_unicode_ci COMMENT '¿Cómo te va este cuatrimestre?',
  `necesita_apoyo_extra` text COLLATE utf8mb4_unicode_ci COMMENT '¿Has necesitado apoyo extra en alguna clase?',
  `atribucion_aprobacion` enum('esfuerzo','suerte','habilidad') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Cuando apruebas...',
  `atribucion_suspension` enum('falta_esfuerzo','mala_suerte','dificultad') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Cuando suspendes...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `antecedentes_escolares`
--

INSERT INTO `antecedentes_escolares` (`pk_antecedentes_escolares`, `fk_alumno`, `institucion_preparatoria`, `ciclo_preparatoria`, `estudio_universidad_anterior`, `universidad_anterior_y_carrera_anterior`, `universidad_anterior_tiempo`, `universidad_anterior_motivo_salida`, `rendimiento_cuatris_anteriores`, `perdio_cuatrimestre`, `perdio_cuatrimestre_causa`, `rendimiento_cuatri_actual`, `necesita_apoyo_extra`, `atribucion_aprobacion`, `atribucion_suspension`) VALUES
(1, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(2, 2, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(3, 3, 'Conalep 121', '2019-2022', 0, 'Ninguna', 'Nunca', 'nomas', 'bien', 0, 'no', 'bien', 'no', 'esfuerzo', 'falta_esfuerzo'),
(4, 4, NULL, NULL, 1, 'UPSIN y Turismo', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(5, 11, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(6, 12, 'Et omnis doloremque', 'Pariatur Itaque har', 1, NULL, 'Quibusdam anim aliqu', 'Facere consectetur q', 'Ipsum odio possimus', 0, 'Velit nihil delectus', 'Ipsum voluptates vel', 'Consequuntur sit is', 'suerte', 'mala_suerte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bajas`
--

CREATE TABLE `bajas` (
  `pk_bajas` int NOT NULL,
  `fk_alumno` int DEFAULT NULL,
  `fk_motivo_baja` int DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estatus` enum('Activa','Cerrada') COLLATE utf8mb4_unicode_ci DEFAULT 'Activa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_58a529729abdfedf1f6a0f17c1ebdaf4', 'i:1;', 1761625669),
('laravel_cache_58a529729abdfedf1f6a0f17c1ebdaf4:timer', 'i:1761625669;', 1761625669),
('laravel_cache_fortify.2fa_codes.264de6ed558a0584ee5f5759bab89356', 'i:58718268;', 1761548113),
('laravel_cache_fortify.2fa_codes.a8a07bd2dea0a9bf05739ccfa226dab8', 'i:58715144;', 1761454396),
('laravel_cache_fortify.2fa_codes.cc75aee8a1163f7675814b917c1373c3', 'i:58720853;', 1761625669),
('laravel_cache_fortify.2fa_codes.f14424aee0db3b418b820f92fe16334b', 'i:58710954;', 1761328682);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canalizacion`
--

CREATE TABLE `canalizacion` (
  `pk_canalizacion` int NOT NULL,
  `fk_alumno` int DEFAULT NULL,
  `fk_motivo_canalizacion` int DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `estatus` enum('Activa','Cerrada') COLLATE utf8mb4_unicode_ci DEFAULT 'Activa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `canalizacion`
--

INSERT INTO `canalizacion` (`pk_canalizacion`, `fk_alumno`, `fk_motivo_canalizacion`, `fecha_inicio`, `fecha_final`, `estatus`) VALUES
(2, 3, 2, '2025-10-28', NULL, 'Activa'),
(3, 1, 2, '2025-10-28', NULL, 'Activa'),
(4, 3, 1, '2025-10-28', NULL, 'Activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canalizacion_seguimiento`
--

CREATE TABLE `canalizacion_seguimiento` (
  `pk_canalizacion_seguimiento` int NOT NULL,
  `fk_formato_canalizacion` int NOT NULL,
  `fecha_seguimiento` date DEFAULT NULL COMMENT 'Fecha de seguimiento (Página 2)',
  `modalidad_seguimiento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Modalidad (Página 2)',
  `responsable_atencion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Responsable(s) de la Atención',
  `diagnostico_otorgado` text COLLATE utf8mb4_unicode_ci COMMENT 'Diagnóstico otorgado',
  `seguimiento_tutorias` text COLLATE utf8mb4_unicode_ci COMMENT 'Seguimiento de TUTORÍAS',
  `seguimiento_medico` text COLLATE utf8mb4_unicode_ci COMMENT 'Seguimiento de MÉDICO',
  `seguimiento_psicologo` text COLLATE utf8mb4_unicode_ci COMMENT 'Seguimiento de PSICÓLOGO',
  `seguimiento_trabajo_social` text COLLATE utf8mb4_unicode_ci COMMENT 'Seguimiento de TRABAJO SOCIAL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `pk_empresa` int NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `estatus` enum('Activa','Inactiva') COLLATE utf8mb4_unicode_ci DEFAULT 'Activa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`pk_empresa`, `nombre`, `tel`, `correo`, `direccion`, `estatus`) VALUES
(2, 'noseee', '0000000000', 'apojspod@gmail.com', 'aoidpiansd', 'Activa'),
(3, 'ejjeje', '0000000000', 'aposjdaeepoajepepeep@gmail.com', 'apisdpaapdapos', 'Activa'),
(4, 'aaaaaaaaaaaaaaa', '0000000000', 'ansinposn@gmail.com', 'maposdaspdasd', 'Activa'),
(5, 'esooooo', '0000000000', 'oansoapdpofpofp@gmail.com', 'aoijdpajspajd', 'Activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formato_canalizacion`
--

CREATE TABLE `formato_canalizacion` (
  `pk_formato_canalizacion` int NOT NULL,
  `fk_alumno` int DEFAULT NULL,
  `fecha_canalizacion` date DEFAULT NULL,
  `tutor_nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nombre del Tutor(a)',
  `carrera` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Carrera del alumno',
  `motivo_reprobacion` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_constantes_faltas` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_no_participa` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_no_entrega_actividades` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_dificultad_asignatura` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_inasistencia_distancia` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_inasistencia_transporte` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_inasistencia_enfermedad` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_inasistencia_familiar` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_inasistencia_personal` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_salud_dolor_cabeza` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_salud_dolor_estomago` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_salud_dolor_muscular` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_salud_respiratorios` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_salud_vertigo` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_salud_vomito` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_adiccion_ojos_rojos` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_adiccion_somnolencia` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_adiccion_aliento_alcoholico` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_comportamiento_agresivo` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_comportamiento_indisciplina` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_comportamiento_desafiante` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_comportamiento_irrespetuoso` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_comportamiento_desinteres` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_estres_frustracion` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_estres_desmotivacion` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_estres_cansancio` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_estres_hiperactividad` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_estres_ansiedad` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_socioeconomico_matrimonio` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_socioeconomico_embarazo` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_socioeconomico_no_desea_estudiar` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_socioeconomico_decidio_trabajar` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_socioeconomico_horario_laboral` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_socioeconomico_pago_mensualidades` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_socioeconomico_transporte` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_socioeconomico_manutencion` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_faltas_ebrio` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_faltas_drogado` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_faltas_vandalismo` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_faltas_porta_armas_drogas` tinyint(1) NOT NULL DEFAULT '0',
  `motivo_otros` text COLLATE utf8mb4_unicode_ci COMMENT 'Otros (especifique)',
  `observaciones_tutor` text COLLATE utf8mb4_unicode_ci COMMENT 'OBSERVACIONES POR TUTOR',
  `acciones_tutor` text COLLATE utf8mb4_unicode_ci COMMENT 'ACCIONES APLICADAS POR EL TUTOR',
  `estatus` enum('Pendiente','Completado') COLLATE utf8mb4_unicode_ci DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `pk_grupo` int NOT NULL,
  `nombre_grupo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci DEFAULT 'Activo',
  `cuatrimestre` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`pk_grupo`, `nombre_grupo`, `estatus`, `cuatrimestre`) VALUES
(1, 'A', 'Activo', '1'),
(2, 'B', 'Activo', '1'),
(3, 'C', 'Activo', '1'),
(4, 'D', 'Activo', '1'),
(5, 'E', 'Activo', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_del_alumno`
--

CREATE TABLE `historial_del_alumno` (
  `pk_historial_del_alumno` int NOT NULL,
  `fk_alumno` int DEFAULT NULL,
  `fk_historial_medico` int DEFAULT NULL,
  `estatus` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_medico`
--

CREATE TABLE `historial_medico` (
  `pk_historial_medico` int NOT NULL,
  `fk_alumno` int DEFAULT NULL,
  `check_alergia` tinyint(1) DEFAULT '0',
  `alergias` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Campo para "Especifica" de Alergia',
  `check_asma` tinyint(1) DEFAULT '0',
  `asma_especifica` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Especifica para Asma',
  `check_cancer` tinyint(1) DEFAULT '0',
  `cancer_especifica` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Especifica para Cáncer',
  `check_diabetes` tinyint(1) DEFAULT '0',
  `diabetes_especifica` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Especifica para Diabetes',
  `check_epilepsia` tinyint(1) DEFAULT '0',
  `epilepsia_especifica` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Especifica para Epilepsia',
  `check_gripa_tos_frecuente` tinyint(1) DEFAULT '0' COMMENT 'Gripa o tos más de 3 veces al año',
  `gripa_tos_especifica` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Especifica para Gripa/Tos Frecuente',
  `check_leucemia` tinyint(1) DEFAULT '0',
  `leucemia_especifica` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Especifica para Leucemia',
  `check_bulimia` tinyint(1) DEFAULT '0',
  `bulimia_especifica` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Especifica para Bulimia',
  `check_crisis_ansiedad` tinyint(1) DEFAULT '0',
  `crisis_ansiedad_especifica` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Especifica para Crisis de Ansiedad',
  `check_migrana` tinyint(1) DEFAULT '0',
  `migrana_especifica` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Especifica para Migraña',
  `check_anorexia` tinyint(1) DEFAULT '0',
  `anorexia_especifica` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Especifica para Anorexia',
  `check_afeccion_corazon` tinyint(1) DEFAULT '0',
  `afeccion_corazon_especifica` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Especifica para Afección Corazón',
  `check_depresion` tinyint(1) DEFAULT '0',
  `depresion_especifica` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Especifica para Depresión',
  `check_otro_salud` text COLLATE utf8mb4_unicode_ci COMMENT 'Para el campo ñ) Otro',
  `otro_salud_especifica` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Campo general para "Especifica"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historial_medico`
--

INSERT INTO `historial_medico` (`pk_historial_medico`, `fk_alumno`, `check_alergia`, `alergias`, `check_asma`, `asma_especifica`, `check_cancer`, `cancer_especifica`, `check_diabetes`, `diabetes_especifica`, `check_epilepsia`, `epilepsia_especifica`, `check_gripa_tos_frecuente`, `gripa_tos_especifica`, `check_leucemia`, `leucemia_especifica`, `check_bulimia`, `bulimia_especifica`, `check_crisis_ansiedad`, `crisis_ansiedad_especifica`, `check_migrana`, `migrana_especifica`, `check_anorexia`, `anorexia_especifica`, `check_afeccion_corazon`, `afeccion_corazon_especifica`, `check_depresion`, `depresion_especifica`, `check_otro_salud`, `otro_salud_especifica`) VALUES
(1, 1, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '0', NULL),
(2, 2, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '0', NULL),
(3, 3, 1, 'A las nueces', 0, 'nada', 0, 'nada', 0, 'nada', 0, 'nada', 1, 'cada tanto me da gripa', 0, 'nada', 0, 'nada', 0, 'nada', 0, 'nada', 0, 'nada', 0, 'nada', 0, 'nada', '0', 'nada'),
(4, 4, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '0', NULL),
(11, 11, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '0', NULL),
(12, 12, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, '0', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion_extra`
--

CREATE TABLE `informacion_extra` (
  `pk_informacion_extra` int NOT NULL,
  `fk_alumno` int DEFAULT NULL,
  `datos_adicionales` text COLLATE utf8mb4_unicode_ci COMMENT 'Respuesta a la sección 7'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `informacion_extra`
--

INSERT INTO `informacion_extra` (`pk_informacion_extra`, `fk_alumno`, `datos_adicionales`) VALUES
(1, 1, NULL),
(2, 2, NULL),
(3, 3, 'nada'),
(4, 4, NULL),
(5, 11, NULL),
(6, 12, 'Exercitationem id e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_10_24_045725_create_actividad_table', 0),
(2, '2025_10_24_045725_create_alumno_table', 0),
(3, '2025_10_24_045725_create_alumno_estadia_table', 0),
(4, '2025_10_24_045725_create_antecedentes_escolares_table', 0),
(5, '2025_10_24_045725_create_bajas_table', 0),
(6, '2025_10_24_045725_create_canalizacion_table', 0),
(7, '2025_10_24_045725_create_canalizacion_seguimiento_table', 0),
(8, '2025_10_24_045725_create_empresa_table', 0),
(9, '2025_10_24_045725_create_formato_canalizacion_table', 0),
(10, '2025_10_24_045725_create_grupo_table', 0),
(11, '2025_10_24_045725_create_historial_del_alumno_table', 0),
(12, '2025_10_24_045725_create_historial_medico_table', 0),
(13, '2025_10_24_045725_create_informacion_extra_table', 0),
(14, '2025_10_24_045725_create_motivo_baja_table', 0),
(15, '2025_10_24_045725_create_motivo_canalizacion_table', 0),
(16, '2025_10_24_045725_create_observacion_table', 0),
(17, '2025_10_24_045725_create_personalidad_table', 0),
(18, '2025_10_24_045725_create_potencial_aprendizaje_table', 0),
(19, '2025_10_24_045725_create_sociabilidad_table', 0),
(20, '2025_10_24_045725_create_tipo_actividad_table', 0),
(21, '2025_10_24_045728_add_foreign_keys_to_actividad_table', 0),
(22, '2025_10_24_045728_add_foreign_keys_to_alumno_table', 0),
(23, '2025_10_24_045728_add_foreign_keys_to_alumno_estadia_table', 0),
(24, '2025_10_24_045728_add_foreign_keys_to_antecedentes_escolares_table', 0),
(25, '2025_10_24_045728_add_foreign_keys_to_bajas_table', 0),
(26, '2025_10_24_045728_add_foreign_keys_to_canalizacion_table', 0),
(27, '2025_10_24_045728_add_foreign_keys_to_canalizacion_seguimiento_table', 0),
(28, '2025_10_24_045728_add_foreign_keys_to_formato_canalizacion_table', 0),
(29, '2025_10_24_045728_add_foreign_keys_to_historial_del_alumno_table', 0),
(30, '2025_10_24_045728_add_foreign_keys_to_historial_medico_table', 0),
(31, '2025_10_24_045728_add_foreign_keys_to_informacion_extra_table', 0),
(32, '2025_10_24_045728_add_foreign_keys_to_observacion_table', 0),
(33, '2025_10_24_045728_add_foreign_keys_to_personalidad_table', 0),
(34, '2025_10_24_045728_add_foreign_keys_to_potencial_aprendizaje_table', 0),
(35, '2025_10_24_045728_add_foreign_keys_to_sociabilidad_table', 0),
(36, '0001_01_01_000000_create_users_table', 1),
(37, '0001_01_01_000001_create_cache_table', 1),
(38, '0001_01_01_000002_create_jobs_table', 1),
(39, '2025_09_02_075243_add_two_factor_columns_to_users_table', 1),
(40, '2025_10_27_071038_create_settings_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo_baja`
--

CREATE TABLE `motivo_baja` (
  `pk_motivo_baja` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo_canalizacion`
--

CREATE TABLE `motivo_canalizacion` (
  `pk_motivo_canalizacion` int NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `motivo_canalizacion`
--

INSERT INTO `motivo_canalizacion` (`pk_motivo_canalizacion`, `nombre`, `descripcion`) VALUES
(1, 'Apoyo Académico', NULL),
(2, 'Dolores de tórax', 'cuando aslkfjwqvlknqouiv434nv498u32j');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observacion`
--

CREATE TABLE `observacion` (
  `pk_observacion` int NOT NULL,
  `fk_alumno` int DEFAULT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones_estadia`
--

CREATE TABLE `opciones_estadia` (
  `pk_opcion_estadia` int NOT NULL,
  `fk_alumno` int NOT NULL,
  `fk_empresa` int NOT NULL,
  `opcion_numero` tinyint NOT NULL COMMENT 'Para guardar si es la opción 1, 2 o 3',
  `estatus` enum('Pendiente','Contactado','No Contactado','Aceptado','Rechazado') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pendiente',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `opciones_estadia`
--

INSERT INTO `opciones_estadia` (`pk_opcion_estadia`, `fk_alumno`, `fk_empresa`, `opcion_numero`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'Pendiente', '2025-10-27 16:53:33', '2025-10-27 16:53:33'),
(2, 1, 4, 2, 'Pendiente', '2025-10-27 16:53:33', '2025-10-27 16:53:33'),
(3, 1, 5, 3, 'Pendiente', '2025-10-27 16:53:33', '2025-10-27 16:53:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('ct2xmh@gmail.com', '$2y$12$.yspjNtJt7aRW7UngG1OUubG.bO4C.yvqG.aZNfIpZcGmBhb.Pkwy', '2025-10-28 04:44:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personalidad`
--

CREATE TABLE `personalidad` (
  `pk_personalidad` int NOT NULL,
  `fk_alumno` int DEFAULT NULL,
  `autodescripcion` text COLLATE utf8mb4_unicode_ci COMMENT '¿Cómo te describirías a ti mismo/a?',
  `como_lo_ven_demas` text COLLATE utf8mb4_unicode_ci COMMENT '¿Cómo crees que te ven los demás?',
  `gusta_mas_de_si` text COLLATE utf8mb4_unicode_ci COMMENT '¿Qué es lo que más te gusta de ti?',
  `gusta_menos_de_si` text COLLATE utf8mb4_unicode_ci COMMENT '¿Y lo que menos te gusta de ti?',
  `contento_ser_fisico` tinyint(1) DEFAULT NULL COMMENT '¿Estás contento/a con tu forma de ser y con tu físico?',
  `cambiaria_algo_ser_fisico` text COLLATE utf8mb4_unicode_ci COMMENT '¿Cambiarias algo de tu forma de ser o de tu físico?'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personalidad`
--

INSERT INTO `personalidad` (`pk_personalidad`, `fk_alumno`, `autodescripcion`, `como_lo_ven_demas`, `gusta_mas_de_si`, `gusta_menos_de_si`, `contento_ser_fisico`, `cambiaria_algo_ser_fisico`) VALUES
(1, 1, NULL, NULL, NULL, NULL, 0, NULL),
(2, 2, NULL, NULL, NULL, NULL, 0, NULL),
(3, 3, 'nada', 'nada', 'nada', 'nada', 1, 'nada'),
(4, 4, NULL, NULL, NULL, NULL, 0, NULL),
(5, 11, NULL, NULL, NULL, NULL, 0, NULL),
(6, 12, 'Minim ratione ullam', 'Amet non in volupta', 'Magna proident tota', 'Dolorem voluptatibus', 1, 'A et quasi laborum q');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `potencial_aprendizaje`
--

CREATE TABLE `potencial_aprendizaje` (
  `pk_potencial_aprendizaje` int NOT NULL,
  `fk_alumno` int DEFAULT NULL,
  `aspectos_propician_y_dificultan_aprendizaje` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Aspectos que propician y dificultan tu aprendizaje',
  `razones_para_estudiar` text COLLATE utf8mb4_unicode_ci COMMENT '¿Cuáles son tus razones para estudiar?',
  `clima_clase_permite_aprender` tinyint(1) DEFAULT NULL COMMENT '¿Crees que en tu clase hay un clima que permite aprender?',
  `clima_clase_especifica` text COLLATE utf8mb4_unicode_ci COMMENT 'Especifica sobre el clima de clase',
  `contento_profesores_general` tinyint(1) DEFAULT NULL COMMENT '¿Estas contento/a con tus profesores en general?',
  `opinion_familia_estudios` text COLLATE utf8mb4_unicode_ci COMMENT '¿Qué piensan en tu casa de que estés estudiando?',
  `apoyo_padres_estudiar` tinyint(1) DEFAULT NULL COMMENT '¿Tus padres te apoyan para seguir estudiando?',
  `actividad_paraescolar_cual` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '¿Asistes a alguna actividad paraescolar?	¿Cuál?'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `potencial_aprendizaje`
--

INSERT INTO `potencial_aprendizaje` (`pk_potencial_aprendizaje`, `fk_alumno`, `aspectos_propician_y_dificultan_aprendizaje`, `razones_para_estudiar`, `clima_clase_permite_aprender`, `clima_clase_especifica`, `contento_profesores_general`, `opinion_familia_estudios`, `apoyo_padres_estudiar`, `actividad_paraescolar_cual`) VALUES
(1, 1, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(2, 2, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(3, 3, 'algo', 'ninguna', 0, 'pus nomas', 1, 'chido', 1, 'ninguna'),
(4, 4, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(5, 11, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(6, 12, 'Quod ea quis amet d', 'Voluptate aliqua Es', 1, 'Dolor reprehenderit', 0, 'Nobis enim in quae v', 1, 'Molestiae officia er');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cY7yrKBVmaulUe0iUpUVB6NqyuTmooEuSWaHT64L', 1, '172.19.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaDVGZkZDcno1eDR3dHY5NXhaOUtXZGV2bWNVNFYweDNlVjAxZnJINyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9sb2NhbGhvc3QvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1761888287),
('Th14pANhjXQDy9oMH3lIrBkyIMkco3WFbagUyqM7', 1, '172.19.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUWJhQzN4T2xnYzFiVTdvTXB4WE1Tdm52U3RrZGs2YjBJRFFzd0NaZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3QvY2FuYWxpemFjaW9uZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1761680878);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'alumnos_esperados', '19', '2025-10-27 07:13:52', '2025-10-28 19:47:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sociabilidad`
--

CREATE TABLE `sociabilidad` (
  `pk_sociabilidad` int NOT NULL,
  `fk_alumno` int DEFAULT NULL,
  `relacion_padres` text COLLATE utf8mb4_unicode_ci COMMENT '¿Qué tal te llevas con tus padres?',
  `relacion_hermanos` text COLLATE utf8mb4_unicode_ci COMMENT '¿Y con tus hermanos?',
  `gusta_tiempo_familia` tinyint(1) DEFAULT NULL COMMENT '¿Te gusta pasar tiempo con la familia?',
  `agusto_en_casa` tinyint(1) DEFAULT NULL COMMENT '¿Te sientes a gusto en casa?',
  `comprendido_familia` tinyint(1) DEFAULT NULL COMMENT '¿Te sientes comprendido por tus padres y hermanos?',
  `tiene_buenos_amigos` tinyint(1) DEFAULT NULL COMMENT '¿Tienes buenos amigos?',
  `confia_amigos_detalle` text COLLATE utf8mb4_unicode_ci COMMENT '¿Confías en ellos? ¿Qué es lo que te hace confiar o no?',
  `preferencia_tiempo_libre` enum('amigos','solo') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '¿Pasas más tiempo con ellos o prefieres pasar más tiempo sólo?',
  `preocupacion_amigos` text COLLATE utf8mb4_unicode_ci COMMENT '¿Qué es lo que más te preocupa de tu relación con los amigos?',
  `agusto_companeros_clase` tinyint(1) DEFAULT NULL COMMENT '¿Te encuentras a gusto con tus compañeros de clase?',
  `integrado_clase_porque` text COLLATE utf8mb4_unicode_ci COMMENT '¿Crees que estas integrado/a? ¿Por qué?',
  `normas_clase_respetan_detalle` text COLLATE utf8mb4_unicode_ci COMMENT '¿Crees que se conocen y respetan las normas? Especifica',
  `enemistad_clase_motivo` text COLLATE utf8mb4_unicode_ci COMMENT '¿Hay alguien con quien te lleves mal? ¿Cuál crees que sea el motivo?'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sociabilidad`
--

INSERT INTO `sociabilidad` (`pk_sociabilidad`, `fk_alumno`, `relacion_padres`, `relacion_hermanos`, `gusta_tiempo_familia`, `agusto_en_casa`, `comprendido_familia`, `tiene_buenos_amigos`, `confia_amigos_detalle`, `preferencia_tiempo_libre`, `preocupacion_amigos`, `agusto_companeros_clase`, `integrado_clase_porque`, `normas_clase_respetan_detalle`, `enemistad_clase_motivo`) VALUES
(1, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(2, 2, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(3, 3, 'bien', 'bien', 1, 1, 1, 1, 'son chidoris', 'solo', 'nada', 1, 'si nomas', 'no', 'no'),
(4, 4, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(5, 11, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(6, 12, 'Commodi molestias es', 'Voluptatem Unde fac', 0, 0, 1, 0, 'Cum consequat Conse', 'solo', 'Molestiae sit sit', 1, 'Ducimus magnam sint', 'Dolor et consectetur', 'Quidem qui non ipsum');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_actividad`
--

CREATE TABLE `tipo_actividad` (
  `pk_tipo_actividad` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_actividad`
--

INSERT INTO `tipo_actividad` (`pk_tipo_actividad`, `nombre`) VALUES
(1, 'algo'),
(2, 'cosa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jesús Manjarrez', 'ct2xmh@gmail.com', NULL, '$2y$12$9SCr5LpbRW3tcxRwKmuEueMxJefXRWzp8s4AXfx0AlII3dWZJA3sS', NULL, NULL, NULL, NULL, '2025-10-24 04:59:08', '2025-10-28 04:28:08'),
(2, 'Jesús Manjarrez', 'tutor@universidad.edu', NULL, '$2y$12$/k7SFv6UYMaL0080GraRxOe4jSkN8CcxrS2QOcU9AV5bf7TNdAb3u', NULL, NULL, NULL, NULL, '2025-10-27 02:53:22', '2025-10-27 02:53:22'),
(3, 'Test User', 'test@example.com', '2025-10-27 06:10:00', '$2y$12$9DVdkiMKUw4DNwA47MvkieIoJa2dCTsKqXx.yReFeLUj59iMmbUh.', 'lIAPgnOgET', 'v4hBw44iOp', '2025-10-27 06:10:00', '5XVpCghRdd', '2025-10-27 06:10:01', '2025-10-27 06:10:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`pk_actividad`),
  ADD KEY `fk_tipo_actividad` (`fk_tipo_actividad`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`pk_alumno`),
  ADD KEY `fk_grupo` (`fk_grupo`);

--
-- Indices de la tabla `alumno_estadia`
--
ALTER TABLE `alumno_estadia`
  ADD PRIMARY KEY (`pk_alumno_estadia`),
  ADD KEY `fk_alumno` (`fk_alumno`),
  ADD KEY `fk_empresa_estadia` (`fk_empresa`);

--
-- Indices de la tabla `antecedentes_escolares`
--
ALTER TABLE `antecedentes_escolares`
  ADD PRIMARY KEY (`pk_antecedentes_escolares`),
  ADD KEY `fk_alumno` (`fk_alumno`);

--
-- Indices de la tabla `bajas`
--
ALTER TABLE `bajas`
  ADD PRIMARY KEY (`pk_bajas`),
  ADD KEY `fk_alumno` (`fk_alumno`),
  ADD KEY `fk_motivo_baja` (`fk_motivo_baja`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `canalizacion`
--
ALTER TABLE `canalizacion`
  ADD PRIMARY KEY (`pk_canalizacion`),
  ADD KEY `fk_alumno` (`fk_alumno`),
  ADD KEY `fk_motivo` (`fk_motivo_canalizacion`);

--
-- Indices de la tabla `canalizacion_seguimiento`
--
ALTER TABLE `canalizacion_seguimiento`
  ADD PRIMARY KEY (`pk_canalizacion_seguimiento`),
  ADD KEY `seguimiento_to_canalizacion_fk` (`fk_formato_canalizacion`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`pk_empresa`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `formato_canalizacion`
--
ALTER TABLE `formato_canalizacion`
  ADD PRIMARY KEY (`pk_formato_canalizacion`),
  ADD KEY `fk_alumno` (`fk_alumno`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`pk_grupo`);

--
-- Indices de la tabla `historial_del_alumno`
--
ALTER TABLE `historial_del_alumno`
  ADD PRIMARY KEY (`pk_historial_del_alumno`),
  ADD KEY `fk_alumno` (`fk_alumno`),
  ADD KEY `fk_historial_medico` (`fk_historial_medico`);

--
-- Indices de la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  ADD PRIMARY KEY (`pk_historial_medico`),
  ADD KEY `fk_alumno` (`fk_alumno`);

--
-- Indices de la tabla `informacion_extra`
--
ALTER TABLE `informacion_extra`
  ADD PRIMARY KEY (`pk_informacion_extra`),
  ADD KEY `fk_alumno` (`fk_alumno`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `motivo_baja`
--
ALTER TABLE `motivo_baja`
  ADD PRIMARY KEY (`pk_motivo_baja`);

--
-- Indices de la tabla `motivo_canalizacion`
--
ALTER TABLE `motivo_canalizacion`
  ADD PRIMARY KEY (`pk_motivo_canalizacion`);

--
-- Indices de la tabla `observacion`
--
ALTER TABLE `observacion`
  ADD PRIMARY KEY (`pk_observacion`),
  ADD KEY `fk_alumno` (`fk_alumno`);

--
-- Indices de la tabla `opciones_estadia`
--
ALTER TABLE `opciones_estadia`
  ADD PRIMARY KEY (`pk_opcion_estadia`),
  ADD KEY `opciones_estadia_fk_alumno_idx` (`fk_alumno`),
  ADD KEY `opciones_estadia_fk_empresa_idx` (`fk_empresa`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personalidad`
--
ALTER TABLE `personalidad`
  ADD PRIMARY KEY (`pk_personalidad`),
  ADD KEY `fk_alumno` (`fk_alumno`);

--
-- Indices de la tabla `potencial_aprendizaje`
--
ALTER TABLE `potencial_aprendizaje`
  ADD PRIMARY KEY (`pk_potencial_aprendizaje`),
  ADD KEY `fk_alumno` (`fk_alumno`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indices de la tabla `sociabilidad`
--
ALTER TABLE `sociabilidad`
  ADD PRIMARY KEY (`pk_sociabilidad`),
  ADD KEY `fk_alumno` (`fk_alumno`);

--
-- Indices de la tabla `tipo_actividad`
--
ALTER TABLE `tipo_actividad`
  ADD PRIMARY KEY (`pk_tipo_actividad`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `pk_actividad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `pk_alumno` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `alumno_estadia`
--
ALTER TABLE `alumno_estadia`
  MODIFY `pk_alumno_estadia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `antecedentes_escolares`
--
ALTER TABLE `antecedentes_escolares`
  MODIFY `pk_antecedentes_escolares` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `bajas`
--
ALTER TABLE `bajas`
  MODIFY `pk_bajas` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `canalizacion`
--
ALTER TABLE `canalizacion`
  MODIFY `pk_canalizacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `canalizacion_seguimiento`
--
ALTER TABLE `canalizacion_seguimiento`
  MODIFY `pk_canalizacion_seguimiento` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `pk_empresa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formato_canalizacion`
--
ALTER TABLE `formato_canalizacion`
  MODIFY `pk_formato_canalizacion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `pk_grupo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `historial_del_alumno`
--
ALTER TABLE `historial_del_alumno`
  MODIFY `pk_historial_del_alumno` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  MODIFY `pk_historial_medico` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `informacion_extra`
--
ALTER TABLE `informacion_extra`
  MODIFY `pk_informacion_extra` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `motivo_baja`
--
ALTER TABLE `motivo_baja`
  MODIFY `pk_motivo_baja` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `motivo_canalizacion`
--
ALTER TABLE `motivo_canalizacion`
  MODIFY `pk_motivo_canalizacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `observacion`
--
ALTER TABLE `observacion`
  MODIFY `pk_observacion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `opciones_estadia`
--
ALTER TABLE `opciones_estadia`
  MODIFY `pk_opcion_estadia` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `personalidad`
--
ALTER TABLE `personalidad`
  MODIFY `pk_personalidad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `potencial_aprendizaje`
--
ALTER TABLE `potencial_aprendizaje`
  MODIFY `pk_potencial_aprendizaje` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sociabilidad`
--
ALTER TABLE `sociabilidad`
  MODIFY `pk_sociabilidad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_actividad`
--
ALTER TABLE `tipo_actividad`
  MODIFY `pk_tipo_actividad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_2` FOREIGN KEY (`fk_tipo_actividad`) REFERENCES `tipo_actividad` (`pk_tipo_actividad`);

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`fk_grupo`) REFERENCES `grupo` (`pk_grupo`);

--
-- Filtros para la tabla `alumno_estadia`
--
ALTER TABLE `alumno_estadia`
  ADD CONSTRAINT `alumno_estadia_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`),
  ADD CONSTRAINT `fk_empresa_estadia` FOREIGN KEY (`fk_empresa`) REFERENCES `empresa` (`pk_empresa`);

--
-- Filtros para la tabla `antecedentes_escolares`
--
ALTER TABLE `antecedentes_escolares`
  ADD CONSTRAINT `antecedentes_escolares_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`);

--
-- Filtros para la tabla `bajas`
--
ALTER TABLE `bajas`
  ADD CONSTRAINT `bajas_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`),
  ADD CONSTRAINT `fk_motivo_baja` FOREIGN KEY (`fk_motivo_baja`) REFERENCES `motivo_baja` (`pk_motivo_baja`);

--
-- Filtros para la tabla `canalizacion`
--
ALTER TABLE `canalizacion`
  ADD CONSTRAINT `canalizacion_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`),
  ADD CONSTRAINT `fk_motivo` FOREIGN KEY (`fk_motivo_canalizacion`) REFERENCES `motivo_canalizacion` (`pk_motivo_canalizacion`);

--
-- Filtros para la tabla `canalizacion_seguimiento`
--
ALTER TABLE `canalizacion_seguimiento`
  ADD CONSTRAINT `seguimiento_to_canalizacion_fk` FOREIGN KEY (`fk_formato_canalizacion`) REFERENCES `formato_canalizacion` (`pk_formato_canalizacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `formato_canalizacion`
--
ALTER TABLE `formato_canalizacion`
  ADD CONSTRAINT `formato_canalizacion_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`);

--
-- Filtros para la tabla `historial_del_alumno`
--
ALTER TABLE `historial_del_alumno`
  ADD CONSTRAINT `historial_del_alumno_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`),
  ADD CONSTRAINT `historial_del_alumno_ibfk_2` FOREIGN KEY (`fk_historial_medico`) REFERENCES `historial_medico` (`pk_historial_medico`);

--
-- Filtros para la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  ADD CONSTRAINT `historial_medico_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`);

--
-- Filtros para la tabla `informacion_extra`
--
ALTER TABLE `informacion_extra`
  ADD CONSTRAINT `informacion_extra_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`);

--
-- Filtros para la tabla `observacion`
--
ALTER TABLE `observacion`
  ADD CONSTRAINT `observacion_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`);

--
-- Filtros para la tabla `personalidad`
--
ALTER TABLE `personalidad`
  ADD CONSTRAINT `personalidad_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`);

--
-- Filtros para la tabla `potencial_aprendizaje`
--
ALTER TABLE `potencial_aprendizaje`
  ADD CONSTRAINT `potencial_aprendizaje_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`);

--
-- Filtros para la tabla `sociabilidad`
--
ALTER TABLE `sociabilidad`
  ADD CONSTRAINT `sociabilidad_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
