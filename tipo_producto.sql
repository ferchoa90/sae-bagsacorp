/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.7.36-log : Database - db_bagsacorp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tipoproducto` */

DROP TABLE IF EXISTS `tipoproducto`;

CREATE TABLE `tipoproducto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `cuentainv` varchar(50) DEFAULT NULL,
  `cuentaventas` varchar(50) DEFAULT NULL,
  `cuentaventasdes` varchar(50) DEFAULT NULL,
  `cuentaventasdev` varchar(50) DEFAULT NULL,
  `cuentacostos` varchar(50) DEFAULT NULL,
  `cuentacostosdes` varchar(50) DEFAULT NULL,
  `cuentacostosdev` varchar(50) DEFAULT NULL,
  `cuentasalidainv` varchar(50) DEFAULT NULL,
  `cuentasalidamue` varchar(50) DEFAULT NULL,
  `cuentaentradainv` varchar(50) DEFAULT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  `usuariocreacion` int(11) NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `tipoproducto` */

insert  into `tipoproducto`(`id`,`nombre`,`descripcion`,`cuentainv`,`cuentaventas`,`cuentaventasdes`,`cuentaventasdev`,`cuentacostos`,`cuentacostosdes`,`cuentacostosdev`,`cuentasalidainv`,`cuentasalidamue`,`cuentaentradainv`,`isDeleted`,`usuariocreacion`,`fechacreacion`,`estatus`) values (1,'ND','','','','','','','','','','','',0,1,'2021-12-01 00:00:00','ACTIVO'),(2,'CABOS','','1.1.03.004.002.000001','4.1.01.002.001.','4.1.02.','4.1.03.','5.1.01.002.001.','5.1.02.','5.1.03.','1.1.03.004.002.000001','1.1.03.004.002.000001','1.1.03.004.002.000001',0,1,'2021-12-01 00:00:00','ACTIVO'),(3,'PIOLAS','','1.1.03.004.002.000001','4.1.01.002.001.','4.1.02.','4.1.03.','5.1.01.002.001.','5.1.02.','5.1.03.','1.1.03.004.002.000001','1.1.03.004.002.000001','1.1.03.004.002.000001',0,1,'2021-12-02 00:00:00','ACTIVO'),(5,'SACOS','','1.1.03.002.004.','','','','','','','','','',0,1,'2021-12-03 00:00:00','ACTIVO'),(7,'CINTAS BANANERAS','','1.1.03.004.002.000002','4.1.01.002.002.','4.1.02.','4.1.03.','5.1.01.002.002.','5.1.02.','5.1.03.','1.1.03.004.002.000002','1.1.03.004.002.000002','1.1.03.004.002.000002',0,1,'2021-12-04 00:00:00','ACTIVO'),(9,'MATERIAL PARA PROCESAR (PELLESTS)','','1.1.03.002.011.','4.1.01.002.004.','4.1.02.','4.1.03.','5.1.01.002.004.','5.1.02.','5.1.03.','1.1.03.002.011.','1.1.03.002.011.','1.1.03.002.011.',0,1,'2021-12-05 00:00:00','ACTIVO'),(10,'PIGMENTO','','1.1.03.002.002.','4.1.01.002.007.','4.1.02.','4.1.03.','5.1.01.002.007.','5.1.02.','5.1.03.','1.1.03.002.002.','1.1.03.002.002.','1.1.03.002.002.',0,1,'2021-12-06 00:00:00','ACTIVO'),(11,'MASTERBACH','','','','','','','','','','','',0,1,'2021-12-07 00:00:00','ACTIVO'),(12,'POLIPROPILENO','','1.1.03.002.001.','4.1.01.002.007.','4.1.02.','4.1.03.','5.1.01.002.007.','5.1.02.','5.1.03.','1.1.03.002.001.','1.1.03.002.001.','1.1.03.002.001.',0,1,'2021-12-08 00:00:00','ACTIVO'),(13,'MATERIAL RECICLADO/RECUPERADO','','1.1.03.002.010.','4.1.01.002.007.','4.1.02.','4.1.03.','5.1.01.002.007.','','','1.1.03.002.010.','1.1.03.002.010.','1.1.03.002.010.',0,1,'2021-12-09 00:00:00','ACTIVO'),(14,'FUNDAS PLASTICAS','','1.1.03.004.002.000004','4.1.01.002.004.','4.1.02.','4.1.03.','5.1.01.002.004.','5.1.02.','5.1.03.','1.1.03.004.002.000004','1.1.03.004.002.000004','1.1.03.004.002.000004',0,1,'2021-12-10 00:00:00','ACTIVO'),(15,'PURGAS','','1.1.03.002.003.','','','','5.1.01.001.001.','','','','1.1.03.002.003.','1.1.03.002.003.',0,1,'2021-12-11 00:00:00','ACTIVO'),(16,'ZUNCHOS AGRICOLA','','1.1.03.004.001.000001','4.1.01.001.001.','4.1.02.','4.1.03.','5.1.01.001.001.','5.1.02.','5.1.03.','1.1.03.004.001.000001','1.1.03.004.001.000001','1.1.03.004.001.000001',0,1,'2021-12-12 00:00:00','ACTIVO'),(17,'ACTIVO FIJO: MAQUINARIA Y EQUIPO','','1.1.03.001.','4.2.05.','4.1.02.','4.1.03.','5.1.05.001.','5.1.05.001.','','','','',0,1,'2021-12-13 00:00:00','ACTIVO'),(18,'MATERIAL PREPARADO','','1.1.03.002.009.','','4.1.02.','4.1.03.','5.1.01.002.007.','5.1.02.','5.1.03.','1.1.03.002.009.','1.1.03.002.009.','1.1.03.002.009.',0,1,'2021-12-14 00:00:00','ACTIVO'),(19,'POLIETILENO','','1.1.03.002.005.','4.1.01.002.007.','4.1.02.','4.1.03.','5.1.01.002.007.','5.1.02.','5.1.03.','1.1.03.002.005.','1.1.03.002.005.','1.1.03.002.005.',0,1,'2021-12-15 00:00:00','ACTIVO'),(20,'CINTA STRECH','','1.1.03.003.001.','','','','5.1.01.002.007.','','','1.1.03.003.001.','1.1.03.003.001.','1.1.03.003.001.',0,1,'2021-12-16 00:00:00','ACTIVO'),(21,'VEHICULOS','','1.2.01.008.','4.2.04.','4.1.02.','4.1.03.','5.1.05.001.','5.1.05.001.','','1.2.01.008.','','',0,1,'2021-12-17 00:00:00','ACTIVO'),(22,'GOMA','','1.1.03.004.002.000003','4.1.01.002.003.','4.1.02.','4.1.03.','5.1.01.002.003.','5.1.02.','5.1.03.','1.1.03.004.002.000003','1.1.03.004.002.000003','1.1.03.004.002.000003',0,1,'2021-12-18 00:00:00','ACTIVO'),(23,'PLASTICOS','','1.1.03.004.002.000006','4.1.01.002.006.','4.1.02.','4.1.03.','5.1.01.002.006.','5.1.02.','5.1.03.','1.1.03.004.002.000006','1.1.03.004.002.000006','1.1.03.004.002.000006',0,1,'2021-12-19 00:00:00','ACTIVO'),(24,'CINTA ADHESIVA','','1.1.03.003.002.','','','','5.1.01.002.007.','','','1.1.03.003.002.','1.1.03.003.002.','1.1.03.003.002.',0,1,'2021-12-20 00:00:00','ACTIVO'),(25,'ZUNCHOS MUESTRAS','','1.1.03.004.001.000002','4.1.01.001.002.','4.1.02.','4.1.03.','5.1.01.001.002.','5.1.02.','5.1.03.','1.1.03.004.001.000002','1.1.03.004.001.000002','1.1.03.004.001.000002',0,1,'2021-12-21 00:00:00','ACTIVO'),(26,'ADITIVOS','','1.1.03.002.004.','4.1.01.002.007.','4.1.02.','4.1.03.','5.1.01.002.005.','','','1.1.03.002.004.','1.1.03.002.004.','1.1.03.002.004.',0,1,'2021-12-22 00:00:00','ACTIVO'),(27,'BASURA','','1.1.03.002.012.','4.1.01.002.006.','4.1.02.','4.1.03.','5.1.06.001.','','','1.1.03.002.012.','1.1.03.002.012.','1.1.03.002.012.',0,1,'2021-12-23 00:00:00','ACTIVO'),(28,'CONSTRUCCION/ADECUACION','','','4.2.03.','4.1.02.','4.2.03.','','','','','','',0,1,'2021-12-24 00:00:00','ACTIVO'),(29,'CANUTOS','','1.1.03.003.003.','','','','5.1.01.002.005.','','','1.1.03.003.003.','1.1.03.003.003.','1.1.03.003.003.',0,1,'2021-12-25 00:00:00','ACTIVO'),(30,'ZUNCHOS SEGUNDA CLASE','','1.1.03.004.001.000003','4.1.01.001.003.','4.1.02.','4.1.03.','5.1.01.001.004.','5.1.02.','5.1.03.','1.1.03.004.001.000003','1.1.03.004.001.000003','1.1.03.004.001.000003',0,1,'2021-12-26 00:00:00','ACTIVO'),(31,'CABOS AGRICOLAS','','1.1.03.004.001.000004','4.1.01.001.004.','4.1.02.','4.1.03.','5.1.01.001.005.','5.1.02.','5.1.03.','1.1.03.004.001.000004','1.1.03.004.001.000004','1.1.03.004.001.000004',0,1,'2021-12-27 00:00:00','ACTIVO'),(32,'CABOS DE SEGUNDA CLASE','','1.1.03.004.001.000005','4.1.01.001.005.','4.1.02.','4.1.03.','5.1.01.001.006.','5.1.02.','5.1.03.','1.1.03.004.001.000005','1.1.03.004.001.000005','1.1.03.004.001.000005',0,1,'2021-12-28 00:00:00','ACTIVO');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
