/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.0.51b-community-nt-log : Database - wcf
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`wcf` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `wcf`;

/*Table structure for table `wcf_forums` */

DROP TABLE IF EXISTS `wcf_forums`;

CREATE TABLE `wcf_forums` (
  `forum_id` int(11) unsigned NOT NULL auto_increment,
  `forum_name` longtext,
  `forum_description` longtext,
  PRIMARY KEY  (`forum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `wcf_forums` */

/*Table structure for table `wcf_forums_replies` */

DROP TABLE IF EXISTS `wcf_forums_replies`;

CREATE TABLE `wcf_forums_replies` (
  `forum_id` int(11) default NULL,
  `thread_id` int(11) default NULL,
  `replies_id` int(11) unsigned NOT NULL auto_increment,
  `replies_name` longtext,
  `replies_text` longtext,
  `thread_postedby` longtext,
  `thread_whenposted` int(11) default NULL,
  PRIMARY KEY  (`replies_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `wcf_forums_replies` */

/*Table structure for table `wcf_forums_threads` */

DROP TABLE IF EXISTS `wcf_forums_threads`;

CREATE TABLE `wcf_forums_threads` (
  `forum_id` int(11) default NULL,
  `thread_id` int(11) unsigned NOT NULL auto_increment,
  `thread_name` longtext,
  `thread_text` longtext,
  `thread_postedby` longtext,
  `thread_whenposted` int(11) default NULL,
  PRIMARY KEY  (`thread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `wcf_forums_threads` */

/*Table structure for table `wcf_login_failed` */

DROP TABLE IF EXISTS `wcf_login_failed`;

CREATE TABLE `wcf_login_failed` (
  `ip` varchar(15) NOT NULL default '127.0.0.1',
  `login_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `wcf_login_failed` */

/*Table structure for table `wcf_logs` */

DROP TABLE IF EXISTS `wcf_logs`;

CREATE TABLE `wcf_logs` (
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `ip` varchar(15) NOT NULL,
  `account` int(11) unsigned NOT NULL,
  `character` int(11) unsigned default NULL,
  `mode` tinyint(3) unsigned NOT NULL,
  `email` varchar(100) default NULL,
  `resultat` longtext,
  `note` longtext,
  `old_data` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `wcf_logs` */

/*Table structure for table `wcf_news` */

DROP TABLE IF EXISTS `wcf_news`;

CREATE TABLE `wcf_news` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `title` longtext,
  `text` longtext,
  `cat` tinyint(3) unsigned default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `wcf_news` */

insert  into `wcf_news`(`id`,`date`,`title`,`text`,`cat`) values (1,'2011-09-11 15:56:25','От разработчика','WCF успешно установлен.',0);

/*Table structure for table `wcf_panels` */

DROP TABLE IF EXISTS `wcf_panels`;

CREATE TABLE `wcf_panels` (
  `panel_id` mediumint(8) unsigned NOT NULL auto_increment,
  `panel_name` varchar(200) NOT NULL default '',
  `panel_url` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL default '',
  `panel_position` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`panel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `wcf_panels` */

insert  into `wcf_panels`(`panel_id`,`panel_name`,`panel_url`,`panel_position`) values (1,'main form','panels/main_form/main_form.php',0),(2,'navigation panel','panels/navigation_panel/navigation_panel.php',1),(3,'user info panel','panels/user_info_panel/user_info_panel.php',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
