/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.5-10.1.21-MariaDB : Database - qlcafe
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`qlcafe` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `qlcafe`;

/*Table structure for table `ban` */

DROP TABLE IF EXISTS `ban`;

CREATE TABLE `ban` (
  `ban_id` int(11) NOT NULL AUTO_INCREMENT,
  `tenban` int(3) DEFAULT NULL,
  `socho` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ban_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `ban` */

insert  into `ban`(`ban_id`,`tenban`,`socho`) values (1,1,5),(2,2,4),(3,3,4);

/*Table structure for table `cthoadon` */

DROP TABLE IF EXISTS `cthoadon`;

CREATE TABLE `cthoadon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hoadon_id` int(11) DEFAULT NULL,
  `douong_id` int(11) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cthoadon` */

/*Table structure for table `ctphieunhap` */

DROP TABLE IF EXISTS `ctphieunhap`;

CREATE TABLE `ctphieunhap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phieunhap_id` int(11) DEFAULT NULL,
  `hanghoa_id` int(11) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `thanhtien` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ctphieunhap` */

/*Table structure for table `douong` */

DROP TABLE IF EXISTS `douong`;

CREATE TABLE `douong` (
  `douong_id` int(11) NOT NULL AUTO_INCREMENT,
  `douong` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dongia` int(11) DEFAULT NULL,
  PRIMARY KEY (`douong_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `douong` */

insert  into `douong`(`douong_id`,`douong`,`dongia`) values (2,'DU1',25000),(3,'DU2',30000);

/*Table structure for table `hanghoa` */

DROP TABLE IF EXISTS `hanghoa`;

CREATE TABLE `hanghoa` (
  `hanghoa_id` int(11) NOT NULL AUTO_INCREMENT,
  `tenhanghoa` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvt` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`hanghoa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `hanghoa` */

insert  into `hanghoa`(`hanghoa_id`,`tenhanghoa`,`dvt`) values (1,'MH1','kg'),(2,'MH2','chiếc'),(3,'MH3','chiếc');

/*Table structure for table `hoadon` */

DROP TABLE IF EXISTS `hoadon`;

CREATE TABLE `hoadon` (
  `hoadon_id` int(11) NOT NULL AUTO_INCREMENT,
  `ngaylap` date DEFAULT NULL,
  `nhanvien_id` int(11) DEFAULT NULL,
  `ban_id` int(11) DEFAULT NULL,
  `thanhtien` int(11) DEFAULT NULL,
  PRIMARY KEY (`hoadon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `hoadon` */

/*Table structure for table `nhacungcap` */

DROP TABLE IF EXISTS `nhacungcap`;

CREATE TABLE `nhacungcap` (
  `nhacungcap_id` int(11) NOT NULL AUTO_INCREMENT,
  `nhacungcap` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sdt` varchar(13) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`nhacungcap_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `nhacungcap` */

insert  into `nhacungcap`(`nhacungcap_id`,`nhacungcap`,`diachi`,`sdt`) values (1,'NCC1','Dia chi 1','Sdt 1'),(2,'NCC2','Dia chi 2','Sdt 2');

/*Table structure for table `nhanvien` */

DROP TABLE IF EXISTS `nhanvien`;

CREATE TABLE `nhanvien` (
  `nhanvien_id` int(11) NOT NULL AUTO_INCREMENT,
  `hoten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaysinh` date DEFAULT NULL,
  `gioitinh` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaylamviec` date DEFAULT NULL,
  PRIMARY KEY (`nhanvien_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `nhanvien` */

/*Table structure for table `phieunhap` */

DROP TABLE IF EXISTS `phieunhap`;

CREATE TABLE `phieunhap` (
  `phieunhap_id` int(11) NOT NULL AUTO_INCREMENT,
  `ngaynhap` date DEFAULT NULL,
  `nhacungcap_id` int(11) DEFAULT NULL,
  `nhanvien_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`phieunhap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `phieunhap` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
