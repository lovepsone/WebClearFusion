/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 14.03.2012 16:02:37
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_admin
-- ----------------------------
DROP TABLE IF EXISTS `wcf_admin`;
CREATE TABLE `wcf_admin` (
  `admin_id` int(11) unsigned NOT NULL auto_increment,
  `admin_colum` int(11) unsigned NOT NULL default '0',
  `admin_page` int(11) unsigned NOT NULL default '0',
  `admin_string` int(11) unsigned NOT NULL default '0',
  `admin_image` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL default '',
  `admin_title` longtext character set utf8 collate utf8_unicode_ci NOT NULL,
  `admin_link` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL default 'reserved',
  PRIMARY KEY  (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_comments
-- ----------------------------
DROP TABLE IF EXISTS `wcf_comments`;
CREATE TABLE `wcf_comments` (
  `comment_id` int(11) unsigned NOT NULL auto_increment,
  `comment_item_id` int(11) unsigned default '0',
  `comment_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `comment_type` int(2) unsigned default '0',
  `user_id` int(11) unsigned default '1',
  `comment_message` longtext collate utf8_unicode_ci,
  PRIMARY KEY  (`comment_id`),
  UNIQUE KEY `comment_id` (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_forums
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums`;
CREATE TABLE `wcf_forums` (
  `forum_id` int(11) unsigned NOT NULL auto_increment,
  `forum_sections` int(11) unsigned NOT NULL default '0',
  `forum_order` int(11) unsigned NOT NULL default '0',
  `forum_name` longtext collate utf8_unicode_ci,
  `forum_description` longtext collate utf8_unicode_ci,
  `forum_lastpostid` int(11) unsigned NOT NULL default '0',
  `forum_postcount` int(11) unsigned NOT NULL default '0',
  `forum_threadcount` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`forum_id`),
  KEY `forum_postcount` (`forum_postcount`),
  KEY `forum_threadcount` (`forum_threadcount`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_forums_posts
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums_posts`;
CREATE TABLE `wcf_forums_posts` (
  `forum_id` int(11) default NULL,
  `thread_id` int(11) default NULL,
  `post_id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `post_text` longtext collate utf8_unicode_ci,
  `post_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_forums_threads
-- ----------------------------
DROP TABLE IF EXISTS `wcf_forums_threads`;
CREATE TABLE `wcf_forums_threads` (
  `forum_id` int(11) default NULL,
  `thread_id` int(11) unsigned NOT NULL auto_increment,
  `thread_subject` longtext collate utf8_unicode_ci,
  `thread_author` int(11) default NULL,
  `thread_views` int(11) default NULL,
  `thread_lastpostid` int(11) unsigned NOT NULL default '0',
  `thread_lastuser` int(11) unsigned NOT NULL default '0',
  `thread_postcount` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`thread_id`),
  KEY `thread_postcount` (`thread_postcount`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_logs
-- ----------------------------
DROP TABLE IF EXISTS `wcf_logs`;
CREATE TABLE `wcf_logs` (
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `ip` varchar(15) collate utf8_unicode_ci NOT NULL,
  `account` int(11) unsigned NOT NULL,
  `character` int(11) unsigned default NULL,
  `mode` tinyint(3) unsigned NOT NULL,
  `email` varchar(100) collate utf8_unicode_ci default NULL,
  `resultat` longtext collate utf8_unicode_ci,
  `note` longtext collate utf8_unicode_ci,
  `old_data` longtext collate utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_navigation_links
-- ----------------------------
DROP TABLE IF EXISTS `wcf_navigation_links`;
CREATE TABLE `wcf_navigation_links` (
  `link_id` int(11) unsigned NOT NULL auto_increment,
  `link_name` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  `link_url` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `link_visibility` tinyint(3) NOT NULL default '0',
  `link_position` tinyint(1) unsigned NOT NULL default '1',
  `link_order` smallint(2) unsigned NOT NULL default '0',
  PRIMARY KEY  (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_news
-- ----------------------------
DROP TABLE IF EXISTS `wcf_news`;
CREATE TABLE `wcf_news` (
  `news_id` int(11) unsigned NOT NULL auto_increment,
  `news_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `news_author` int(11) unsigned default '1',
  `news_subject` longtext collate utf8_unicode_ci,
  `news_show_cat` int(11) unsigned default '0',
  `news_cat` int(11) unsigned default '1',
  `news_text` longtext collate utf8_unicode_ci,
  `news_text_extended` longtext collate utf8_unicode_ci,
  `news_visibility` int(3) NOT NULL default '0',
  `news_allow_comments` int(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_news_cats
-- ----------------------------
DROP TABLE IF EXISTS `wcf_news_cats`;
CREATE TABLE `wcf_news_cats` (
  `news_cat_id` int(11) unsigned NOT NULL auto_increment,
  `news_cat_name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `news_cat_image` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`news_cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_panels
-- ----------------------------
DROP TABLE IF EXISTS `wcf_panels`;
CREATE TABLE `wcf_panels` (
  `panel_id` mediumint(8) unsigned NOT NULL auto_increment,
  `panel_filename` varchar(200) NOT NULL default '',
  `panel_type` varchar(20) NOT NULL default '',
  `panel_access` tinyint(3) NOT NULL default '-1',
  `panel_side` tinyint(1) unsigned NOT NULL default '1',
  `panel_order` tinyint(11) unsigned NOT NULL default '0',
  `panel_status` tinyint(1) unsigned NOT NULL default '1',
  `panel_display` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`panel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_settings
-- ----------------------------
DROP TABLE IF EXISTS `wcf_settings`;
CREATE TABLE `wcf_settings` (
  `settings_name` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `settings_value` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`settings_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for wcf_users
-- ----------------------------
DROP TABLE IF EXISTS `wcf_users`;
CREATE TABLE `wcf_users` (
  `user_id` int(11) unsigned NOT NULL auto_increment,
  `user_name` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `user_sha_pass_hash` varchar(40) collate utf8_unicode_ci NOT NULL default '',
  `user_gmlevel` tinyint(3) unsigned NOT NULL default '0',
  `user_avatar` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  `user_bonuses` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `idx_user_name` (`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;