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
  `status` int(11) NOT NULL,
  `date_created` text NOT NULL,
  `full_names` text NOT NULL,
  `message` int(11) DEFAULT NULL COMMENT 'If 0 not send if 1 send',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Table structure for table `sp_history` */

DROP TABLE IF EXISTS `sp_history`;

CREATE TABLE `sp_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `last_login` varchar(30) NOT NULL,
  `ip_address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `sp_policies` */

DROP TABLE IF EXISTS `sp_policies`;

CREATE TABLE `sp_policies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `policy` text NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date_created` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
