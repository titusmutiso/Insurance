/*
SQLyog Professional v12.09 (64 bit)
MySQL - 5.7.14 : Database - xpatagencies
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`xpatagencies` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `xpatagencies`;

/*Table structure for table `premiums` */

DROP TABLE IF EXISTS `premiums`;

CREATE TABLE `premiums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `total_premium` int(11) DEFAULT NULL,
  `paid_premium` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `date_paid` varchar(30) DEFAULT NULL,
  `balance_date` varchar(30) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0-not paid, 1- Balance, 2- cleared',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `premiums` */

insert  into `premiums`(`id`,`customer_id`,`total_premium`,`paid_premium`,`balance`,`date_paid`,`balance_date`,`status`) values (1,39,12000,12000,0,'04017-2017','2017-04-30 14:35:12',2),(2,40,18000,18000,0,'04-03-2017','2017-04-30 14:34:19',2),(3,41,200000,100000,100000,'04-10-2017','05-04-2017',1);

/*Table structure for table `sp_clients` */

DROP TABLE IF EXISTS `sp_clients`;

CREATE TABLE `sp_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_names` varchar(100) NOT NULL,
  `middle_name` text NOT NULL,
  `last_name` text NOT NULL,
  `renewal_date` varchar(30) NOT NULL,
  `client_desc` text NOT NULL,
  `clients_email` varchar(100) NOT NULL,
  `clients_phone` varchar(30) NOT NULL,
  `postal_code` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `logo` text NOT NULL,
  `status` varchar(5) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `sp_clients` */

insert  into `sp_clients`(`id`,`client_names`,`middle_name`,`last_name`,`renewal_date`,`client_desc`,`clients_email`,`clients_phone`,`postal_code`,`address`,`logo`,`status`,`date_created`) values (4,'Spark World','','titus','2017-04-20','Web Design','kamba.nation@gmail.com','+254718020630','00100','90000','uploads/customers/Spark-1.jpg','1','2017-02-11 06:19:37'),(5,'Titus','K','Nation','2017-05-20','Yes','sparkworldke@gmail.com','0771296246','00100','90000','uploads/customers/Titus-1.jpg','1','2017-03-01 23:49:19');

/*Table structure for table `sp_customers` */

DROP TABLE IF EXISTS `sp_customers`;

CREATE TABLE `sp_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_number` varchar(10) NOT NULL,
  `first_name` text NOT NULL,
  `middle_name` text NOT NULL,
  `last_name` text NOT NULL,
  `commencement_date` text NOT NULL,
  `renewal_date` text NOT NULL,
  `phone_no` text NOT NULL,
  `email_add` text NOT NULL,
  `company` text NOT NULL,
  `cover` int(11) NOT NULL,
  `premium` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` text NOT NULL,
  `full_names` text NOT NULL,
  `message` int(11) DEFAULT NULL COMMENT 'If 0 not send if 1 send',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

/*Data for the table `sp_customers` */

insert  into `sp_customers`(`id`,`cust_number`,`first_name`,`middle_name`,`last_name`,`commencement_date`,`renewal_date`,`phone_no`,`email_add`,`company`,`cover`,`premium`,`status`,`date_created`,`full_names`,`message`) values (1,'CUS-0001','','','','2015-11-23','2016-11-24','+254723932434','','CIC',1,0,1,'2017-04-30 00:04:51','cellpro communications',0),(2,'CUS-0002','','','','2015-06-11','2016-05-11','+254726405405','','CIC',1,0,1,'2017-04-30 00:05:54','Possible limited',0),(3,'CUS-0003','','','','2015-11-24','2016-11-25','+254723932434','','CIC',1,0,1,'2017-04-30 00:07:40','Cellpro communications ',0),(4,'CUS-0004','','','','2015-03-12','2015-02-12','+254790509763','','CIC',1,0,1,'2017-04-30 00:10:07','Harun Kamau/LEAH MUTERU NYAWIRA',0),(5,'CUS-0005','','','','2015-04-12','2016-12-03','+254723932434','0','CIC',1,0,1,'2017-04-30 00:10:07','Cellpro communications ',0),(6,'CUS-0006','','','','2015-12-15','2016-12-14','+254723932434','0','CIC',1,0,1,'2017-04-30 00:10:07','Cellpro communications ',0),(7,'CUS-0007','','','','2016-07-01','2016-01-06','+254725693748','0','K.ALLIANCE',1,0,1,'2017-04-30 00:10:07','Geo map ',0),(8,'CUS-0008','','','','2015-11-24','2016-11-23','+254718771633','0','K.ALLIANCE',1,0,1,'2017-04-30 00:10:07','Kennedy Otieno',0),(9,'CUS-0009','','','','2016-01-25','2017-01-24','+254723932434','0','CIC',1,0,1,'2017-04-30 00:10:07','Cellpro communications ',0),(10,'CUS-0010','','','','','','+254','0','',1,0,1,'2017-04-30 00:10:07','Cellpro communications ',0),(11,'CUS-0011','','','','','','+254720565328','0','',1,0,1,'2017-04-30 00:10:07','Mark Mogere',0),(12,'CUS-0012','','','','2016-02-16','2017-02-15','+254724988889','0','K.ALLIANCE',1,0,1,'2017-04-30 00:10:07','Joshua Maima Mutie',0),(13,'CUS-0013','','','','2016-02-28','2017-02-27','+254726969411','0','K.ALLIANCE',1,0,1,'2017-04-30 00:10:07','Martha Shighadi',0),(14,'CUS-0014','','','','2016-01-03','2017-02-28','+254722484356','0','K.ALLIANCE',1,0,1,'2017-04-30 00:10:07','Joseph Mwaniki',0),(15,'CUS-0015','','','','','','+254','0','CANCELLED STILL HAS DEBT OF 45000',1,0,1,'2017-04-30 00:10:07 ','OLLREGGY INVESTMENT',0),(16,'CUS-0016','','','','2016-05-18','2017-05-17','+254723932332','','K.ALLIANCE',1,0,1,'2017-04-30 09:07:48','Julius Wambugu',0),(17,'CUS-0017','','','','2016-03-19','2017-03-18','+254720805912','0','CIC',1,0,1,'2017-04-30 00:10:07','Margaret Wangui',0),(18,'CUS-0018','','','','2016-05-16','2017-05-15','+254723875721','0','CIC',1,0,1,'2017-04-30 00:10:07','Danson Mabruki',0),(19,'CUS-0019','','','','2016-03-02','2017-03-01','+254723875721','0','AMACO',1,0,1,'2017-04-30 00:10:07','Danson Mabruki',0),(20,'CUS-0020','','','','2016-04-02','2017-04-01','+254722424659','0','K.ALLIANCE',1,0,1,'2017-04-30 00:10:07','Maria SHIGHADI',0),(21,'CUS-0021','','','','2015-05-03','2017-05-02','+254723932332','0','CIC',1,0,1,'2017-04-30 00:10:07','VOI WOMEN COP SOCIETY',0),(22,'CUS-0022','','','','2016-03-16','2017-03-15','+254','0','CIC',1,0,1,'2017-04-30 00:10:07','Cellpro communications ',0),(23,'CUS-0023','','','','2016-03-16','2017-03-15','+254','0','CIC',1,0,1,'2017-04-30 00:10:07','Cellpro communications ',0),(24,'CUS-0024','','','','','','+254728818101','0','',1,0,1,'2017-04-30 00:10:07','Simon Wambugu',0),(25,'CUS-0025','','','','2016-07-22','2017-07-21','+254721408898','0','BRITAM',1,0,1,'2017-04-30 00:10:07','RUTH MUENI MUMO',0),(26,'CUS-0026','','','','2017-01-30','2017-03-16','+254723932332','0','CIC',1,0,1,'2017-04-30 00:10:07','Cellpro communications',0),(27,'CUS-0027','','','','2016-11-14','2017-05-15','+254721408898','0','CYTONN',1,0,1,'2017-04-30 00:10:07','RUTH MUMO',0),(28,'CUS-0028','','','','2016-11-24','2017-11-24','+254713925935','0','OCCIDENTAL',1,0,1,'2017-04-30 00:10:07','WESLEY KOECH',0),(29,'CUS-0029','','','','2017-01-21','2018-01-20','+254704219900','0','KENYAN ALLIANCE',1,0,1,'2017-04-30 00:10:07','KEVIN /FLORENCE WAMBUGU',0),(30,'CUS-0030','','','','2017-02-14','2017-02-13','+254723932332','0','CIC',1,0,1,'2017-04-30 00:10:07','Cellpro communications',0),(31,'CUS-0031','','','','2017-02-13','2018-02-12','+254726969411','0','KENYAN ALLIANCE',1,0,1,'2017-04-30 00:10:07','Martha Shighadi',0),(32,'CUS-0032','','','','2017-02-28','2018-02-28','+254722484356','0','keNYAN ALLIANCE',1,0,1,'2017-04-30 00:10:07','Mwaniki Kimani',0),(33,'CUS-0033','','','','2017-01-16','2018-01-15','+254705555445','0','kenYAN ALLIANCE',1,0,1,'2017-04-30 00:10:07','Harun Kamau',0),(34,'CUS-0034','','','','2018-12-09','2018-12-09','+254729221165','0','KENYAN ALLIANCE',1,0,1,'2017-04-30 00:10:07','Boniface ',0),(35,'CUS-0035','','','','2018-01-13','2018-01-13','+254728624148','0','kenYAN ALLIANCE',1,0,1,'2017-04-30 00:10:07','Faizal Habib bank',0),(36,'CUS-0036','','','','2017-01-27','2018-01-26','+254720565328','0','Cannon',1,0,1,'2017-04-30 00:10:07','Mark Mogere',0),(37,'CUS-0037','','','','2017-01-26','2018-01-25','+254721408898','0','KENYAN ALLIANCE',1,0,1,'2017-04-30 00:10:07','David Mumo',0),(38,'CUS-0038','','','','2017-01-27','2018-01-26','+254721408898','0','KENYAN ALLIANCE',1,0,1,'2017-04-30 00:10:07','',0),(39,'CUS-0039','Titus','KA','Nation','01-03-4','2017-05-04','+254718020630','kamba.nation@gmail.com','CIC',1,10000,1,'2017-05-01 11:26:17','Titus  Nation',0),(40,'CUS-0040','Mueni','','Kaleli','2017-03-04','2017-05-03','+254780023023','','JUBILEE',1,10000,1,'2017-04-30 11:22:04','Mueni  Kaleli',0),(41,'CUS-0041','Moddy','','Mutiso','2017-04-04','2017-06-05','+254771296246','','CIC',1,200000,1,'2017-04-30 17:43:01','Moddy  Mutiso',0);

/*Table structure for table `sp_history` */

DROP TABLE IF EXISTS `sp_history`;

CREATE TABLE `sp_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `last_login` varchar(30) NOT NULL,
  `ip_address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `sp_history` */

/*Table structure for table `sp_message` */

DROP TABLE IF EXISTS `sp_message`;

CREATE TABLE `sp_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(20) DEFAULT NULL,
  `message_body` text,
  `date_send` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `sp_message` */

insert  into `sp_message`(`id`,`customer_id`,`message_body`,`date_send`) values (1,'','I Fell','2017-05-01 10:32:03'),(2,'','I Fell','2017-05-01 10:32:03'),(3,'41','KALI','2017-05-01 10:33:25'),(4,'40','KALI','2017-05-01 10:33:25'),(5,'41','KALI','2017-05-01 10:33:25'),(6,'40','KALI','2017-05-01 10:33:25'),(7,'','Ka','2017-05-01 10:34:25'),(8,'','Ka','2017-05-01 10:34:25'),(9,'32','Loking','2017-05-01 10:35:31'),(10,'31','Loking','2017-05-01 10:35:31'),(11,'32','Loking','2017-05-01 10:35:31'),(12,'31','Loking','2017-05-01 10:35:31'),(13,'','Ngelani','2017-05-01 10:36:29'),(14,'','Ngelani','2017-05-01 10:36:29'),(15,'41','Karnga','2017-05-01 10:37:51'),(16,'40','Karnga','2017-05-01 10:37:51'),(17,'41','Karnga','2017-05-01 10:37:51'),(18,'40','Karnga','2017-05-01 10:37:51'),(19,'41','KLLLLL','2017-05-01 10:38:39'),(20,'40','KLLLLL','2017-05-01 10:38:39'),(21,'41','Mutua','2017-05-01 10:43:48'),(22,'40','Mutua','2017-05-01 10:43:48'),(23,'39','Mutua','2017-05-01 10:43:48'),(24,'41','Custom SMS for Insurance Try ','2017-05-01 10:45:46'),(25,'40','Custom SMS for Insurance Try ','2017-05-01 10:45:46'),(26,'39','Custom SMS for Insurance Try ','2017-05-01 10:45:46'),(27,'40','Happy Birthday ','2017-05-01 10:56:01'),(28,'40','Airtel Line','2017-05-01 10:57:15'),(29,'40','Airtel Line & Safaricom Line - Happy Bday','2017-05-01 10:59:39'),(30,'39','Airtel Line & Safaricom Line - Happy Bday','2017-05-01 10:59:39'),(31,'40','Multiple CUSTOM SMS','2017-05-01 11:02:48'),(32,'39','Multiple CUSTOM SMS','2017-05-01 11:02:48'),(33,'40','Multiple CUSTOM SMS','2017-05-01 11:03:31'),(34,'39','Multiple CUSTOM SMS','2017-05-01 11:03:31'),(35,'40','Multiple CUSTOM SMS','2017-05-01 11:03:31'),(36,'39','Multiple CUSTOM SMS','2017-05-01 11:03:31'),(37,'40','Multiple SMS Insurance','2017-05-01 11:04:18'),(38,'39','Multiple SMS Insurance','2017-05-01 11:04:18'),(39,'40','Multiple SMS Insurance','2017-05-01 11:04:18'),(40,'39','Multiple SMS Insurance','2017-05-01 11:04:18');

/*Table structure for table `sp_policies` */

DROP TABLE IF EXISTS `sp_policies`;

CREATE TABLE `sp_policies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `policy` text NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date_created` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

/*Data for the table `sp_policies` */

insert  into `sp_policies`(`id`,`policy`,`customer_id`,`date_created`) values (1,'KBT 099D',1,'0'),(2,'KBA 833Q',1,'0'),(3,'ZC 4576',1,'0'),(4,'KBU 844M',2,'0'),(5,'KAU 268D',3,'0'),(6,'KCF 213T',4,'0'),(7,'KAV 133W',6,'0'),(8,'KBE 587M',7,'0'),(9,'KCF 100C',8,'0'),(10,'KCG 992F',9,'0'),(11,'KBH 956C',10,'0'),(12,'KBZ 557Y',10,'0'),(13,'KBP 492X',11,'0'),(14,'DP',12,'0'),(15,'KCB 592V',13,'0'),(16,'KBT 005U',14,'0'),(17,'KBU 174L',14,'0'),(18,'ZD 9320',15,'0'),(19,'KCC 198M',16,'0'),(20,'KBY 650E',17,'0'),(21,'DP',18,'0'),(22,'KCF 712L',19,'0'),(23,'KBD 372F',20,'0'),(24,'FIRE',21,'0'),(25,'KBK 101W',22,'0'),(26,'ZE 7154',23,'0'),(27,'ZC 1494',23,'0'),(28,'ZD 1643',23,'0'),(29,'KBX 424K',24,'0'),(30,'KCD 564K',25,'0'),(31,'KCK 949P',26,'0'),(32,'CMS',27,'0'),(33,'KBT 16H',28,'0'),(34,'KCJ 584Q',29,'0'),(35,'EXGKA',30,'0'),(36,'KCB 592V',31,'0'),(37,'KBU174L',32,'0'),(38,'KCF 213T',33,'0'),(39,'KBD 722A',34,'0'),(40,'Mcycle',35,'0'),(41,'KBP 492X',36,'0'),(42,'KBE 225Y',37,'0'),(43,'KAU 009',39,'2017-04-30 11:18:16'),(44,'',39,'2017-04-30 11:18:16'),(45,'',39,'2017-04-30 11:18:16'),(46,'KAC 899D',40,'2017-04-30 11:22:04'),(47,'',40,'2017-04-30 11:22:04'),(48,'',40,'2017-04-30 11:22:04');

/*Table structure for table `sp_products` */

DROP TABLE IF EXISTS `sp_products`;

CREATE TABLE `sp_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `brand` text NOT NULL,
  `serial_number` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `sp_products` */

/*Table structure for table `sp_settings` */

DROP TABLE IF EXISTS `sp_settings`;

CREATE TABLE `sp_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) NOT NULL,
  `site_logo` text NOT NULL,
  `site_title` varchar(100) NOT NULL,
  `site_desc` text NOT NULL,
  `site_phone_number` varchar(30) NOT NULL,
  `site_email` varchar(40) NOT NULL,
  `site_address` text NOT NULL,
  `site_url` varchar(40) NOT NULL,
  `facebook_acc` text NOT NULL,
  `twitter_acc` text NOT NULL,
  `gplus_acc` text NOT NULL,
  `linkedin` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `date_modified` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `sp_settings` */

insert  into `sp_settings`(`id`,`site_name`,`site_logo`,`site_title`,`site_desc`,`site_phone_number`,`site_email`,`site_address`,`site_url`,`facebook_acc`,`twitter_acc`,`gplus_acc`,`linkedin`,`instagram`,`date_modified`) values (1,'Xpat Agencies','uploads/banner.jpg','Xpat Agencies','&lt;p&gt;We provide insurance Solution&lt;/p&gt;','+23177694841','info@xpatagencies.co.ke','Salama Hse,\r\nNairobi Kenya','http://www.allpro.com','','','','','',''),(2,'','','','','','','','','','','','','','');

/*Table structure for table `sp_users` */

DROP TABLE IF EXISTS `sp_users`;

CREATE TABLE `sp_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email_add` varchar(100) NOT NULL,
  `phone_no` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(100) NOT NULL,
  `user_desc` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_created` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `sp_users` */

insert  into `sp_users`(`id`,`username`,`first_name`,`last_name`,`email_add`,`phone_no`,`password`,`role`,`user_desc`,`status`,`date_created`) values (1,'Titus.Mutiso','Titus','Mutiso','kamba.nation@gmail.com','0718020630','6c99ec0c0c52528e4fc2d7c3db10236b','1','very productive','1','2017-02-11 07:01:48'),(7,'hannah.malla','Hannah','Malla','xpatagencies@gmail.com','0711119733','45687f00b68e93cfea5a3bcb9dfa3096','1','Super Admin','1','2017-03-01 20:22:13');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
