/*M!999999\- enable the sandbox mode */ 
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;
DROP TABLE IF EXISTS `actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `actividad` (
  `pk_actividad` int NOT NULL AUTO_INCREMENT,
  `fk_tipo_actividad` int DEFAULT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estatus` enum('Pendiente','Realizada') COLLATE utf8mb4_unicode_ci DEFAULT 'Pendiente',
  `asistencia` int DEFAULT NULL COMMENT 'Cantidad de asistentes a la actividad',
  PRIMARY KEY (`pk_actividad`),
  KEY `fk_tipo_actividad` (`fk_tipo_actividad`),
  CONSTRAINT `actividad_ibfk_2` FOREIGN KEY (`fk_tipo_actividad`) REFERENCES `tipo_actividad` (`pk_tipo_actividad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumno` (
  `pk_alumno` int NOT NULL AUTO_INCREMENT,
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
  `estatus` enum('Activo','Baja') COLLATE utf8mb4_unicode_ci DEFAULT 'Activo',
  PRIMARY KEY (`pk_alumno`),
  KEY `fk_grupo` (`fk_grupo`),
  CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`fk_grupo`) REFERENCES `grupo` (`pk_grupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `alumno_estadia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumno_estadia` (
  `pk_alumno_estadia` int NOT NULL AUTO_INCREMENT,
  `fk_alumno` int DEFAULT NULL,
  `fk_empresa` int DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `estatus` enum('En curso','Finalizada') COLLATE utf8mb4_unicode_ci DEFAULT 'En curso',
  PRIMARY KEY (`pk_alumno_estadia`),
  KEY `fk_alumno` (`fk_alumno`),
  KEY `fk_empresa_estadia` (`fk_empresa`),
  CONSTRAINT `alumno_estadia_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`),
  CONSTRAINT `fk_empresa_estadia` FOREIGN KEY (`fk_empresa`) REFERENCES `empresa` (`pk_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `antecedentes_escolares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `antecedentes_escolares` (
  `pk_antecedentes_escolares` int NOT NULL AUTO_INCREMENT,
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
  `atribucion_suspension` enum('falta_esfuerzo','mala_suerte','dificultad') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Cuando suspendes...',
  PRIMARY KEY (`pk_antecedentes_escolares`),
  KEY `fk_alumno` (`fk_alumno`),
  CONSTRAINT `antecedentes_escolares_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bajas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `bajas` (
  `pk_bajas` int NOT NULL AUTO_INCREMENT,
  `fk_alumno` int DEFAULT NULL,
  `fk_motivo_baja` int DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estatus` enum('Activa','Cerrada') COLLATE utf8mb4_unicode_ci DEFAULT 'Activa',
  PRIMARY KEY (`pk_bajas`),
  KEY `fk_alumno` (`fk_alumno`),
  KEY `fk_motivo_baja` (`fk_motivo_baja`),
  CONSTRAINT `bajas_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`),
  CONSTRAINT `fk_motivo_baja` FOREIGN KEY (`fk_motivo_baja`) REFERENCES `motivo_baja` (`pk_motivo_baja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `canalizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `canalizacion` (
  `pk_canalizacion` int NOT NULL AUTO_INCREMENT,
  `fk_alumno` int DEFAULT NULL,
  `fk_motivo_canalizacion` int DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `estatus` enum('Activa','Cerrada') COLLATE utf8mb4_unicode_ci DEFAULT 'Activa',
  PRIMARY KEY (`pk_canalizacion`),
  KEY `fk_alumno` (`fk_alumno`),
  KEY `fk_motivo` (`fk_motivo_canalizacion`),
  CONSTRAINT `canalizacion_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`),
  CONSTRAINT `fk_motivo` FOREIGN KEY (`fk_motivo_canalizacion`) REFERENCES `motivo_canalizacion` (`pk_motivo_canalizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `canalizacion_seguimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `canalizacion_seguimiento` (
  `pk_canalizacion_seguimiento` int NOT NULL AUTO_INCREMENT,
  `fk_formato_canalizacion` int NOT NULL,
  `fecha_seguimiento` date DEFAULT NULL COMMENT 'Fecha de seguimiento (Página 2)',
  `modalidad_seguimiento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Modalidad (Página 2)',
  `responsable_atencion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Responsable(s) de la Atención',
  `diagnostico_otorgado` text COLLATE utf8mb4_unicode_ci COMMENT 'Diagnóstico otorgado',
  `seguimiento_tutorias` text COLLATE utf8mb4_unicode_ci COMMENT 'Seguimiento de TUTORÍAS',
  `seguimiento_medico` text COLLATE utf8mb4_unicode_ci COMMENT 'Seguimiento de MÉDICO',
  `seguimiento_psicologo` text COLLATE utf8mb4_unicode_ci COMMENT 'Seguimiento de PSICÓLOGO',
  `seguimiento_trabajo_social` text COLLATE utf8mb4_unicode_ci COMMENT 'Seguimiento de TRABAJO SOCIAL',
  PRIMARY KEY (`pk_canalizacion_seguimiento`),
  KEY `seguimiento_to_canalizacion_fk` (`fk_formato_canalizacion`),
  CONSTRAINT `seguimiento_to_canalizacion_fk` FOREIGN KEY (`fk_formato_canalizacion`) REFERENCES `formato_canalizacion` (`pk_formato_canalizacion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresa` (
  `pk_empresa` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `estatus` enum('Activa','Inactiva') COLLATE utf8mb4_unicode_ci DEFAULT 'Activa',
  PRIMARY KEY (`pk_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `formato_canalizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `formato_canalizacion` (
  `pk_formato_canalizacion` int NOT NULL AUTO_INCREMENT,
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
  `estatus` enum('Pendiente','Completado') COLLATE utf8mb4_unicode_ci DEFAULT 'Pendiente',
  PRIMARY KEY (`pk_formato_canalizacion`),
  KEY `fk_alumno` (`fk_alumno`),
  CONSTRAINT `formato_canalizacion_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupo` (
  `pk_grupo` int NOT NULL AUTO_INCREMENT,
  `nombre_grupo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci DEFAULT 'Activo',
  `cuatrimestre` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`pk_grupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `historial_del_alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial_del_alumno` (
  `pk_historial_del_alumno` int NOT NULL AUTO_INCREMENT,
  `fk_alumno` int DEFAULT NULL,
  `fk_historial_medico` int DEFAULT NULL,
  `estatus` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci DEFAULT 'Activo',
  PRIMARY KEY (`pk_historial_del_alumno`),
  KEY `fk_alumno` (`fk_alumno`),
  KEY `fk_historial_medico` (`fk_historial_medico`),
  CONSTRAINT `historial_del_alumno_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`),
  CONSTRAINT `historial_del_alumno_ibfk_2` FOREIGN KEY (`fk_historial_medico`) REFERENCES `historial_medico` (`pk_historial_medico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `historial_medico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial_medico` (
  `pk_historial_medico` int NOT NULL AUTO_INCREMENT,
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
  `otro_salud_especifica` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Campo general para "Especifica"',
  PRIMARY KEY (`pk_historial_medico`),
  KEY `fk_alumno` (`fk_alumno`),
  CONSTRAINT `historial_medico_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `informacion_extra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `informacion_extra` (
  `pk_informacion_extra` int NOT NULL AUTO_INCREMENT,
  `fk_alumno` int DEFAULT NULL,
  `datos_adicionales` text COLLATE utf8mb4_unicode_ci COMMENT 'Respuesta a la sección 7',
  PRIMARY KEY (`pk_informacion_extra`),
  KEY `fk_alumno` (`fk_alumno`),
  CONSTRAINT `informacion_extra_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
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
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `motivo_baja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `motivo_baja` (
  `pk_motivo_baja` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`pk_motivo_baja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `motivo_canalizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `motivo_canalizacion` (
  `pk_motivo_canalizacion` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`pk_motivo_canalizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `observacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `observacion` (
  `pk_observacion` int NOT NULL AUTO_INCREMENT,
  `fk_alumno` int DEFAULT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`pk_observacion`),
  KEY `fk_alumno` (`fk_alumno`),
  CONSTRAINT `observacion_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `opciones_estadia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `opciones_estadia` (
  `pk_opcion_estadia` int NOT NULL AUTO_INCREMENT,
  `fk_alumno` int NOT NULL,
  `fk_empresa` int NOT NULL,
  `opcion_numero` tinyint NOT NULL COMMENT 'Para guardar si es la opción 1, 2 o 3',
  `estatus` enum('Pendiente','Contactado','No Contactado','Aceptado','Rechazado') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pendiente',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pk_opcion_estadia`),
  KEY `opciones_estadia_fk_alumno_idx` (`fk_alumno`),
  KEY `opciones_estadia_fk_empresa_idx` (`fk_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personalidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `personalidad` (
  `pk_personalidad` int NOT NULL AUTO_INCREMENT,
  `fk_alumno` int DEFAULT NULL,
  `autodescripcion` text COLLATE utf8mb4_unicode_ci COMMENT '¿Cómo te describirías a ti mismo/a?',
  `como_lo_ven_demas` text COLLATE utf8mb4_unicode_ci COMMENT '¿Cómo crees que te ven los demás?',
  `gusta_mas_de_si` text COLLATE utf8mb4_unicode_ci COMMENT '¿Qué es lo que más te gusta de ti?',
  `gusta_menos_de_si` text COLLATE utf8mb4_unicode_ci COMMENT '¿Y lo que menos te gusta de ti?',
  `contento_ser_fisico` tinyint(1) DEFAULT NULL COMMENT '¿Estás contento/a con tu forma de ser y con tu físico?',
  `cambiaria_algo_ser_fisico` text COLLATE utf8mb4_unicode_ci COMMENT '¿Cambiarias algo de tu forma de ser o de tu físico?',
  PRIMARY KEY (`pk_personalidad`),
  KEY `fk_alumno` (`fk_alumno`),
  CONSTRAINT `personalidad_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `potencial_aprendizaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `potencial_aprendizaje` (
  `pk_potencial_aprendizaje` int NOT NULL AUTO_INCREMENT,
  `fk_alumno` int DEFAULT NULL,
  `aspectos_propician_y_dificultan_aprendizaje` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'Aspectos que propician y dificultan tu aprendizaje',
  `razones_para_estudiar` text COLLATE utf8mb4_unicode_ci COMMENT '¿Cuáles son tus razones para estudiar?',
  `clima_clase_permite_aprender` tinyint(1) DEFAULT NULL COMMENT '¿Crees que en tu clase hay un clima que permite aprender?',
  `clima_clase_especifica` text COLLATE utf8mb4_unicode_ci COMMENT 'Especifica sobre el clima de clase',
  `contento_profesores_general` tinyint(1) DEFAULT NULL COMMENT '¿Estas contento/a con tus profesores en general?',
  `opinion_familia_estudios` text COLLATE utf8mb4_unicode_ci COMMENT '¿Qué piensan en tu casa de que estés estudiando?',
  `apoyo_padres_estudiar` tinyint(1) DEFAULT NULL COMMENT '¿Tus padres te apoyan para seguir estudiando?',
  `actividad_paraescolar_cual` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '¿Asistes a alguna actividad paraescolar?	¿Cuál?',
  PRIMARY KEY (`pk_potencial_aprendizaje`),
  KEY `fk_alumno` (`fk_alumno`),
  CONSTRAINT `potencial_aprendizaje_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sociabilidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sociabilidad` (
  `pk_sociabilidad` int NOT NULL AUTO_INCREMENT,
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
  `enemistad_clase_motivo` text COLLATE utf8mb4_unicode_ci COMMENT '¿Hay alguien con quien te lleves mal? ¿Cuál crees que sea el motivo?',
  PRIMARY KEY (`pk_sociabilidad`),
  KEY `fk_alumno` (`fk_alumno`),
  CONSTRAINT `sociabilidad_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`pk_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tipo_actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_actividad` (
  `pk_tipo_actividad` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`pk_tipo_actividad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

/*M!999999\- enable the sandbox mode */ 
set autocommit=0;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'2025_10_24_045725_create_actividad_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'2025_10_24_045725_create_alumno_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'2025_10_24_045725_create_alumno_estadia_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2025_10_24_045725_create_antecedentes_escolares_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5,'2025_10_24_045725_create_bajas_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6,'2025_10_24_045725_create_canalizacion_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7,'2025_10_24_045725_create_canalizacion_seguimiento_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8,'2025_10_24_045725_create_empresa_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9,'2025_10_24_045725_create_formato_canalizacion_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10,'2025_10_24_045725_create_grupo_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11,'2025_10_24_045725_create_historial_del_alumno_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12,'2025_10_24_045725_create_historial_medico_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13,'2025_10_24_045725_create_informacion_extra_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14,'2025_10_24_045725_create_motivo_baja_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15,'2025_10_24_045725_create_motivo_canalizacion_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (16,'2025_10_24_045725_create_observacion_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (17,'2025_10_24_045725_create_personalidad_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (18,'2025_10_24_045725_create_potencial_aprendizaje_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19,'2025_10_24_045725_create_sociabilidad_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (20,'2025_10_24_045725_create_tipo_actividad_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (21,'2025_10_24_045728_add_foreign_keys_to_actividad_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (22,'2025_10_24_045728_add_foreign_keys_to_alumno_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (23,'2025_10_24_045728_add_foreign_keys_to_alumno_estadia_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (24,'2025_10_24_045728_add_foreign_keys_to_antecedentes_escolares_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (25,'2025_10_24_045728_add_foreign_keys_to_bajas_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (26,'2025_10_24_045728_add_foreign_keys_to_canalizacion_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (27,'2025_10_24_045728_add_foreign_keys_to_canalizacion_seguimiento_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (28,'2025_10_24_045728_add_foreign_keys_to_formato_canalizacion_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (29,'2025_10_24_045728_add_foreign_keys_to_historial_del_alumno_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (30,'2025_10_24_045728_add_foreign_keys_to_historial_medico_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (31,'2025_10_24_045728_add_foreign_keys_to_informacion_extra_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (32,'2025_10_24_045728_add_foreign_keys_to_observacion_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (33,'2025_10_24_045728_add_foreign_keys_to_personalidad_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (34,'2025_10_24_045728_add_foreign_keys_to_potencial_aprendizaje_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (35,'2025_10_24_045728_add_foreign_keys_to_sociabilidad_table',0);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (36,'0001_01_01_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (37,'0001_01_01_000001_create_cache_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (38,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (39,'2025_09_02_075243_add_two_factor_columns_to_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (40,'2025_10_27_071038_create_settings_table',2);
commit;
