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
  `tenban` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `socho` smallint(6) DEFAULT NULL,
  `trangthai` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`ban_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `ban` */

insert  into `ban`(`ban_id`,`tenban`,`socho`,`trangthai`) values (1,'Bàn số 1',4,0),(2,'Bàn số 2',6,0),(3,'Bàn số 3',4,0);

/*Table structure for table `cthoadon` */

DROP TABLE IF EXISTS `cthoadon`;

CREATE TABLE `cthoadon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hoadon_id` int(11) DEFAULT NULL,
  `douong_id` int(11) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hoadon_id` (`hoadon_id`),
  KEY `douong_id` (`douong_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `cthoadon` */

insert  into `cthoadon`(`id`,`hoadon_id`,`douong_id`,`soluong`) values (1,2,1,2),(2,3,1,4);

/*Table structure for table `ctphieunhap` */

DROP TABLE IF EXISTS `ctphieunhap`;

CREATE TABLE `ctphieunhap` (
  `ctphieunhap_id` int(11) NOT NULL AUTO_INCREMENT,
  `phieunhap_id` int(11) DEFAULT NULL,
  `hanghoa_id` int(11) DEFAULT NULL,
  `soluongnhap` int(11) DEFAULT NULL,
  `dongia` int(11) DEFAULT NULL,
  PRIMARY KEY (`ctphieunhap_id`),
  KEY `phieunhap_id` (`phieunhap_id`),
  KEY `hanghoa_id` (`hanghoa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ctphieunhap` */

insert  into `ctphieunhap`(`ctphieunhap_id`,`phieunhap_id`,`hanghoa_id`,`soluongnhap`,`dongia`) values (1,2,1,1,10000),(3,3,2,2,20000),(4,3,1,10,10000);

/*Table structure for table `douong` */

DROP TABLE IF EXISTS `douong`;

CREATE TABLE `douong` (
  `douong_id` int(11) NOT NULL AUTO_INCREMENT,
  `douong` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dongia` int(11) DEFAULT NULL,
  PRIMARY KEY (`douong_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `douong` */

insert  into `douong`(`douong_id`,`douong`,`dongia`) values (1,'Cafe đá',25000);

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`description`,`avatar`) values (1,'admin','Quản trị','user2-160x160'),(2,'members','General User',NULL),(3,'manager','Quản lý nhập hàng','user1-128x128'),(4,'seller','Quản lý bán hàng','user3-128x128');

/*Table structure for table `hanghoa` */

DROP TABLE IF EXISTS `hanghoa`;

CREATE TABLE `hanghoa` (
  `hanghoa_id` int(11) NOT NULL AUTO_INCREMENT,
  `tenhanghoa` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dvt` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`hanghoa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `hanghoa` */

insert  into `hanghoa`(`hanghoa_id`,`tenhanghoa`,`dvt`) values (1,'Đường','kg'),(2,'Sữa','lít');

/*Table structure for table `hoadon` */

DROP TABLE IF EXISTS `hoadon`;

CREATE TABLE `hoadon` (
  `hoadon_id` int(11) NOT NULL AUTO_INCREMENT,
  `mahoadon` varchar(255) DEFAULT NULL,
  `ngaylap` datetime DEFAULT NULL,
  `nhanvien_id` int(11) DEFAULT NULL,
  `thanhtien` int(11) DEFAULT NULL,
  `trangthai` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`hoadon_id`),
  KEY `nhanvien_id` (`nhanvien_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `hoadon` */

insert  into `hoadon`(`hoadon_id`,`mahoadon`,`ngaylap`,`nhanvien_id`,`thanhtien`,`trangthai`) values (1,'HD-280617040539','2017-06-28 04:05:39',2,0,1),(2,'HD-280617061800','2017-06-28 06:18:00',2,50000,1),(3,'HD-280617112657','2017-06-28 11:26:57',2,100000,1);

/*Table structure for table `hoadon_ban` */

DROP TABLE IF EXISTS `hoadon_ban`;

CREATE TABLE `hoadon_ban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hoadon_id` int(11) DEFAULT NULL,
  `ban_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hoadon_id` (`hoadon_id`),
  KEY `ban_id` (`ban_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `hoadon_ban` */

insert  into `hoadon_ban`(`id`,`hoadon_id`,`ban_id`) values (1,2,1),(2,2,2),(3,3,1),(4,3,2);

/*Table structure for table `login_attempts` */

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `login_attempts` */

/*Table structure for table `nhacungcap` */

DROP TABLE IF EXISTS `nhacungcap`;

CREATE TABLE `nhacungcap` (
  `nhacungcap_id` int(11) NOT NULL AUTO_INCREMENT,
  `nhacungcap` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sdt` varchar(13) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`nhacungcap_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `nhacungcap` */

insert  into `nhacungcap`(`nhacungcap_id`,`nhacungcap`,`diachi`,`sdt`) values (1,'Vin Mart','Đống Đa, Hà Nội','012472347/');

/*Table structure for table `nhanvien` */

DROP TABLE IF EXISTS `nhanvien`;

CREATE TABLE `nhanvien` (
  `nhanvien_id` int(11) NOT NULL AUTO_INCREMENT,
  `manhanvien` varchar(255) DEFAULT NULL,
  `hoten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaysinh` date DEFAULT NULL,
  `gioitinh` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaylamviec` date DEFAULT NULL,
  PRIMARY KEY (`nhanvien_id`),
  UNIQUE KEY `manhanvien` (`manhanvien`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `nhanvien` */

insert  into `nhanvien`(`nhanvien_id`,`manhanvien`,`hoten`,`ngaysinh`,`gioitinh`,`diachi`,`ngaylamviec`) values (1,'NV01','Hoàng Vũ Lộc','1996-02-27','Nam','Hải Phòng','2017-06-21'),(2,'NV02','Mai thị Ánh Hồng','1996-09-19','Nam','Thanh Hóa','2017-05-23'),(3,'ADM','Admin',NULL,NULL,NULL,NULL);

/*Table structure for table `phieunhap` */

DROP TABLE IF EXISTS `phieunhap`;

CREATE TABLE `phieunhap` (
  `phieunhap_id` int(11) NOT NULL AUTO_INCREMENT,
  `maphieunhap` varchar(255) DEFAULT NULL,
  `ngaynhap` date DEFAULT NULL,
  `nhacungcap_id` int(11) DEFAULT NULL,
  `nhanvien_id` int(11) DEFAULT NULL,
  `tongchi` int(11) DEFAULT NULL,
  PRIMARY KEY (`phieunhap_id`),
  UNIQUE KEY `maphieunhap` (`maphieunhap`),
  KEY `nhacungcap_id` (`nhacungcap_id`),
  KEY `nhanvien_id` (`nhanvien_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `phieunhap` */

insert  into `phieunhap`(`phieunhap_id`,`maphieunhap`,`ngaynhap`,`nhacungcap_id`,`nhanvien_id`,`tongchi`) values (1,'PN01','2017-06-20',NULL,1,NULL),(2,'PN02','2017-06-20',1,1,NULL),(3,'PN04','2017-06-28',1,1,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `nhanvien_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`ip_address`,`username`,`password`,`salt`,`email`,`activation_code`,`forgotten_password_code`,`forgotten_password_time`,`remember_code`,`created_on`,`last_login`,`active`,`nhanvien_id`) values (1,'127.0.0.1','administrator','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,NULL,NULL,1268889823,1498606150,1,3),(6,'::1','nhanhnhat','$2y$08$T7MzqWl2.bmBx5WaVYEgB.Pdul3TKmsHXXUyjzN7CwqL24MAH0Ev.',NULL,'123@gmail.com',NULL,NULL,NULL,NULL,1498588067,1498623836,1,1),(7,'::1','nhanhnhat1','$2y$08$4RKT.LCsmBjZtNqoYvdwde6QeKWt6yJfVkTfq6yp3RVZhiSQZntU2',NULL,'321321@gmail.com',NULL,NULL,NULL,NULL,1498588167,1498623994,1,2);

/*Table structure for table `users_groups` */

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `users_groups` */

insert  into `users_groups`(`id`,`user_id`,`group_id`) values (1,1,1),(2,1,2),(6,6,3),(7,7,4);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
