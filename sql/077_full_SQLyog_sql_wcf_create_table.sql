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
  `forum_id` mediumint(8) unsigned NOT NULL auto_increment,
  `forum_sections` mediumint(8) unsigned NOT NULL default '0',
  `forum_name` longtext,
  `forum_description` longtext,
  `forum_postcount` mediumint(8) unsigned NOT NULL default '0',
  `forum_threadcount` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`forum_id`),
  KEY `forum_postcount` (`forum_postcount`),
  KEY `forum_threadcount` (`forum_threadcount`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `wcf_forums` */

insert  into `wcf_forums`(`forum_id`,`forum_sections`,`forum_name`,`forum_description`,`forum_postcount`,`forum_threadcount`) values (1,0,'Информация о сервере',NULL,0,0),(2,1,'Информация от администрации','Обновления, изменения, события, новости.',2,2),(3,0,'Мир Warcraft',NULL,0,0),(4,3,'Аддоны и Макросы\r\n','Скачиваем и заказываем',1,1),(5,1,'Мастерская','Делимся своими идеями, решениями. Обсуждаем, создаем что-то свое.',1,1);

/*Table structure for table `wcf_forums_posts` */

DROP TABLE IF EXISTS `wcf_forums_posts`;

CREATE TABLE `wcf_forums_posts` (
  `forum_id` int(11) default NULL,
  `thread_id` int(11) default NULL,
  `post_id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `post_text` longtext,
  `post_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `wcf_forums_posts` */

insert  into `wcf_forums_posts`(`forum_id`,`thread_id`,`post_id`,`user_id`,`post_text`,`post_date`) values (2,1,1,1,'Проверка работоспособности форума!!!','2010-05-28 21:04:49'),(2,2,2,4,'Проверка работоспособности форума!!!','2011-10-27 12:40:08'),(5,3,3,1,'Проверка работоспособности форума!!!','2011-10-27 12:39:40'),(4,4,4,1,'Проверка работоспособности форума!!!','2011-10-27 12:39:44');

/*Table structure for table `wcf_forums_threads` */

DROP TABLE IF EXISTS `wcf_forums_threads`;

CREATE TABLE `wcf_forums_threads` (
  `forum_id` int(11) default NULL,
  `thread_id` int(11) unsigned NOT NULL auto_increment,
  `thread_subject` longtext,
  `thread_author` int(11) default NULL,
  `thread_lastpostid` int(11) unsigned NOT NULL default '0',
  `thread_lastuser` int(11) unsigned NOT NULL default '0',
  `thread_postcount` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`thread_id`),
  KEY `thread_postcount` (`thread_postcount`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `wcf_forums_threads` */

insert  into `wcf_forums_threads`(`forum_id`,`thread_id`,`thread_subject`,`thread_author`,`thread_lastpostid`,`thread_lastuser`,`thread_postcount`) values (2,1,'Сообщение от администрации',1,1,1,1),(2,2,'Тестовый форум',4,2,4,1),(5,3,'Сообщение от администрации',1,3,1,1),(4,4,'Сообщение от администрации',1,4,1,1);

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

insert  into `wcf_news`(`id`,`date`,`title`,`text`,`cat`) values (1,'2011-10-22 13:50:00','От разработчика.','WCF успешно установлен.',0);

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

/*Table structure for table `wcf_users` */

DROP TABLE IF EXISTS `wcf_users`;

CREATE TABLE `wcf_users` (
  `user_id` int(11) unsigned NOT NULL auto_increment,
  `user_name` varchar(32) NOT NULL default '',
  `user_online` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `idx_user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `wcf_users` */

insert  into `wcf_users`(`user_id`,`user_name`,`user_online`) values (1,'ADMINISTRATOR',0),(2,'GAMEMASTER',0),(3,'MODERATOR',0),(4,'PLAYER',0),(5,'LOVEPSONE',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
