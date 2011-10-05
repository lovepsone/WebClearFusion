/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 05.10.2011 19:04:23
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_forums
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums`;
CREATE TABLE `wcf_forums` (
  `forum_id` int(11) unsigned NOT NULL auto_increment,
  `forum_name` longtext,
  `forum_description` longtext,
  PRIMARY KEY  (`forum_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_forums_replies
-- ----------------------------
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

-- ----------------------------
-- Table structure for wcf_forums_threads
-- ----------------------------
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

-- ----------------------------
-- Table structure for wcf_login_failed
-- ----------------------------
DROP TABLE IF EXISTS `wcf_login_failed`;
CREATE TABLE `wcf_login_failed` (
  `ip` varchar(15) NOT NULL default '127.0.0.1',
  `login_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_logs
-- ----------------------------
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

-- ----------------------------
-- Table structure for wcf_news
-- ----------------------------
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

-- ----------------------------
-- Table structure for wcf_panels
-- ----------------------------
DROP TABLE IF EXISTS `wcf_panels`;
CREATE TABLE `wcf_panels` (
  `panel_id` mediumint(8) unsigned NOT NULL auto_increment,
  `panel_name` varchar(200) NOT NULL default '',
  `panel_url` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL default '',
  `panel_position` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`panel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_news` VALUES ('1', '2011-09-11 15:56:25', 'От разработчика', 'WCF успешно установлен.', '0');
INSERT INTO `wcf_panels` VALUES ('1', 'main form', 'panels/main_form/main_form.php', '0');
INSERT INTO `wcf_panels` VALUES ('2', 'navigation panel', 'panels/navigation_panel/navigation_panel.php', '1');
INSERT INTO `wcf_panels` VALUES ('3', 'user info panel', 'panels/user_info_panel/user_info_panel.php', '2');
