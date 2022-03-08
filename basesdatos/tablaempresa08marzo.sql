/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.1.25-MariaDB : Database - dbbagsacorp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `ruc` varchar(13) NOT NULL,
  `ambiente` int(1) NOT NULL DEFAULT '1',
  `serie` varchar(7) NOT NULL DEFAULT '001-001',
  `fechacreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuariocreacion` int(11) NOT NULL DEFAULT '1',
  `estatus` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`ruc`),
  KEY `id` (`id`),
  KEY `usuariocreacion` (`usuariocreacion`),
  CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`usuariocreacion`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `empresa` */

insert  into `empresa`(`id`,`nombre`,`descripcion`,`ruc`,`ambiente`,`serie`,`fechacreacion`,`usuariocreacion`,`estatus`) values 
(1,'BASACORP','','0925548679001',1,'001-001','2019-09-23 11:05:31',1,'ACTIVO'),
(2,'MARIO AGUILAR','','0930178462001',1,'001-001','2022-03-07 19:08:44',1,'ACTIVO');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
