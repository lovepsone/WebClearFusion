/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 31.01.2012 14:56:02
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for wcf_acp_panels
-- ----------------------------
DROP TABLE IF EXISTS `wcf_acp_panels`;
CREATE TABLE `wcf_acp_panels` (
  `panel_id` mediumint(8) unsigned NOT NULL auto_increment,
  `panel_filename` varchar(200) NOT NULL default '',
  `panel_type` varchar(20) NOT NULL default '',
  `panel_access` tinyint(3) NOT NULL default '-1',
  `panel_side` tinyint(1) unsigned NOT NULL default '1',
  `panel_order` tinyint(11) unsigned NOT NULL default '0',
  `panel_status` tinyint(1) unsigned NOT NULL default '1',
  `panel_display` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`panel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
-- Table structure for wcf_chr_classes
-- ----------------------------
DROP TABLE IF EXISTS `wcf_chr_classes`;
CREATE TABLE `wcf_chr_classes` (
  `id` int(10) unsigned NOT NULL,
  `unk_1` int(10) unsigned NOT NULL,
  `power_type` int(10) unsigned NOT NULL,
  `unk_3` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `female_name` text NOT NULL,
  `neutral_name` text NOT NULL,
  `internal_name` text NOT NULL,
  `spell_family` int(10) unsigned NOT NULL,
  `unk_9` int(10) unsigned NOT NULL,
  `cinematic_id` int(10) unsigned NOT NULL,
  `expansion` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wcf_chr_races
-- ----------------------------
DROP TABLE IF EXISTS `wcf_chr_races`;
CREATE TABLE `wcf_chr_races` (
  `id` int(10) unsigned NOT NULL,
  `unk_1` int(10) unsigned NOT NULL,
  `facton_id` int(10) unsigned NOT NULL,
  `unk_4` int(10) unsigned NOT NULL,
  `model_m` int(10) unsigned NOT NULL,
  `model_f` int(10) unsigned NOT NULL,
  `short_name` text NOT NULL,
  `unk_8` int(10) unsigned NOT NULL,
  `unk_9` int(10) unsigned NOT NULL,
  `unk_10` int(10) unsigned NOT NULL,
  `unk_11` int(10) unsigned NOT NULL,
  `internal_name` text NOT NULL,
  `cinematic_id` int(10) unsigned NOT NULL,
  `team` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `female_name` text NOT NULL,
  `neutral_name` text NOT NULL,
  `unk_18` text NOT NULL,
  `unk_19` text NOT NULL,
  `unk_20` text NOT NULL,
  `expansion` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
-- Table structure for wcf_creature_family
-- ----------------------------
DROP TABLE IF EXISTS `wcf_creature_family`;
CREATE TABLE `wcf_creature_family` (
  `id` int(10) unsigned NOT NULL,
  `minScale` float NOT NULL,
  `minScaleLevel` int(10) unsigned NOT NULL,
  `maxScale` float NOT NULL,
  `maxScaleLevel` int(10) unsigned NOT NULL,
  `skill_line_1` int(10) unsigned NOT NULL,
  `skill_line_2` int(10) unsigned NOT NULL,
  `pet_food_mask` int(10) unsigned NOT NULL,
  `pet_talent_type` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `name` text NOT NULL,
  `icon` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `user_online` tinyint(3) unsigned NOT NULL default '0',
  `user_avatar` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `idx_user_name` (`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_acp_panels` VALUES ('1', 'navigation_panel_acp', 'file', '0', '1', '1', '1', '0');
INSERT INTO `wcf_acp_panels` VALUES ('2', 'user_or_server_panel_acp', 'file', '0', '4', '2', '1', '0');
INSERT INTO `wcf_admin` VALUES ('1', '1', '1', '1', 'news.gif', 'Новости', 'news.php');
INSERT INTO `wcf_admin` VALUES ('2', '2', '1', '1', 'forums.gif', 'Форум', 'forumedit.php');
INSERT INTO `wcf_admin` VALUES ('3', '3', '1', '1', 'panels.gif', 'Панели', 'panels.php');
INSERT INTO `wcf_admin` VALUES ('4', '4', '1', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('5', '5', '1', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('6', '1', '1', '2', 'news_cats', 'Категории новостей', 'news_cats.php');
INSERT INTO `wcf_admin` VALUES ('7', '2', '1', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('8', '3', '1', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('9', '4', '1', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('10', '5', '1', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('11', '1', '1', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('12', '2', '1', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('13', '3', '1', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('14', '4', '1', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('15', '5', '1', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('16', '1', '1', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('17', '2', '1', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('18', '3', '1', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('19', '4', '1', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('20', '5', '2', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('21', '1', '2', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('22', '2', '2', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('23', '3', '2', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('24', '4', '2', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('25', '5', '2', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('26', '1', '2', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('27', '2', '2', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('28', '3', '2', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('29', '4', '2', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('30', '5', '2', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('31', '1', '2', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('32', '2', '2', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('33', '3', '2', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('34', '4', '2', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('35', '5', '2', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('36', '1', '2', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('37', '2', '2', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('38', '3', '2', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('39', '4', '2', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('40', '5', '2', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('41', '1', '3', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('42', '2', '3', '1', 'site_links.gif', 'Навигация сайта', 'site_links.php');
INSERT INTO `wcf_admin` VALUES ('43', '3', '3', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('44', '4', '3', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('45', '5', '3', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('46', '1', '3', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('47', '2', '3', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('48', '3', '3', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('49', '4', '3', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('50', '5', '3', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('51', '1', '3', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('52', '2', '3', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('53', '3', '3', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('54', '4', '3', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('55', '5', '3', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('56', '1', '3', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('57', '2', '3', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('58', '3', '3', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('59', '4', '3', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('60', '5', '3', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('61', '1', '4', '1', 'settings.gif', 'Главные установки', 'settings_main.php');
INSERT INTO `wcf_admin` VALUES ('62', '2', '4', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('63', '3', '4', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('64', '4', '4', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('65', '5', '4', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('66', '1', '4', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('67', '2', '4', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('68', '3', '4', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('69', '4', '4', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('70', '5', '4', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('71', '1', '4', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('72', '2', '4', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('73', '3', '4', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('74', '4', '4', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('75', '5', '4', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('76', '1', '4', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('77', '2', '4', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('78', '3', '4', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('79', '4', '4', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('80', '5', '4', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('81', '1', '5', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('82', '2', '5', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('83', '3', '5', '1', 'panels.gif', 'Панели АСР', 'acp_panels.php');
INSERT INTO `wcf_admin` VALUES ('84', '4', '5', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('85', '5', '5', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('86', '1', '5', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('87', '2', '5', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('88', '3', '5', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('89', '4', '5', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('90', '5', '5', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('91', '1', '5', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('92', '2', '5', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('93', '3', '5', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('94', '4', '5', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('95', '5', '5', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('96', '1', '5', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('97', '2', '5', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('98', '3', '5', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('99', '4', '5', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('100', '5', '5', '4', '', '', 'reserved');
INSERT INTO `wcf_chr_classes` VALUES ('1', '0', '1', '1', 'Воин', '', 'Воин', 'WARRIOR', '4', '50', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('2', '0', '0', '1', 'Паладин', '', 'Паладин', 'PALADIN', '10', '58', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('3', '1', '0', '1', 'Охотник', 'Охотница', 'Охотник', 'HUNTER', '9', '22', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('4', '1', '3', '1', 'Разбойник', 'Разбойница', 'Разбойник', 'ROGUE', '8', '2', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('5', '0', '0', '1', 'Жрец', 'Жрица', 'Жрец', 'PRIEST', '6', '2', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('6', '9', '6', '1', 'Рыцарь смерти', '', 'Рыцарь смерти', 'DEATHKNIGHT', '15', '122', '165', '2');
INSERT INTO `wcf_chr_classes` VALUES ('7', '1', '0', '1', 'Шаман', 'Шаманка', 'Шаман', 'SHAMAN', '11', '26', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('8', '0', '0', '1', 'Маг', '', 'Маг', 'MAGE', '3', '2', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('9', '0', '0', '240', 'Чернокнижник', 'Чернокнижница', 'Чернокнижник', 'WARLOCK', '5', '6', '0', '0');
INSERT INTO `wcf_chr_classes` VALUES ('11', '0', '0', '1', 'Друид', '', 'Друид', 'DRUID', '7', '10', '0', '0');
INSERT INTO `wcf_chr_races` VALUES ('1', '12', '1', '4140', '49', '50', 'Hu', '7', '7', '15007', '1096', 'Human', '81', '0', 'Человек', '', 'Человек', 'NORMAL', 'PIERCINGS', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('2', '12', '2', '4141', '51', '52', 'Or', '1', '7', '15007', '1096', 'Orc', '21', '1', 'Орк', '', 'Орк', 'NORMAL', 'PIERCINGS', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('3', '12', '3', '4147', '53', '54', 'Dw', '7', '7', '15007', '1090', 'Dwarf', '41', '0', 'Дворф', '', 'Дворф', 'NORMAL', 'PIERCINGS', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('4', '4', '4', '4145', '55', '56', 'Ni', '7', '7', '15007', '1096', 'NightElf', '61', '0', 'Ночной эльф', 'Ночная эльфийка', 'Ночной эльф', 'NORMAL', 'MARKINGS', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('5', '12', '5', '4142', '57', '58', 'Sc', '1', '7', '15007', '1096', 'Scourge', '2', '1', 'Нежить', 'Нежить', '', 'FEATURES', 'FEATURES', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('6', '14', '6', '4143', '59', '60', 'Ta', '1', '7', '15007', '1096', 'Tauren', '141', '1', 'Таурен', '', 'Таурен', 'NORMAL', 'HAIR', 'HORNS', '0');
INSERT INTO `wcf_chr_races` VALUES ('7', '12', '115', '4146', '1563', '1564', 'Gn', '7', '7', '15007', '1096', 'Gnome', '101', '0', 'Гном', '', 'Гном', 'NORMAL', 'EARRINGS', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('8', '14', '116', '4144', '1478', '1479', 'Tr', '1', '7', '15007', '1096', 'Troll', '121', '1', 'Тролль', '', 'Тролль', 'TUSKS', 'TUSKS', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('9', '1', '1', '0', '6894', '6895', 'Go', '7', '7', '15007', '1096', 'Goblin', '0', '2', 'Гоблин', '', 'Гоблин', 'NORMAL', 'NONE', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('10', '12', '1610', '4142', '15476', '15475', 'Be', '1', '7', '15007', '1096', 'BloodElf', '162', '1', 'Эльф крови', 'Эльфийка крови', 'Эльф крови', 'NORMAL', 'EARRINGS', 'NORMAL', '1');
INSERT INTO `wcf_chr_races` VALUES ('11', '14', '1629', '4140', '16125', '16126', 'Dr', '7', '7', '15007', '1096', 'Draenei', '163', '0', 'Дреней', '', 'Дреней', 'NORMAL', 'HORNS', 'NORMAL', '1');
INSERT INTO `wcf_chr_races` VALUES ('12', '5', '1', '0', '16981', '16980', 'Fo', '7', '7', '15007', '1096', 'FelOrc', '0', '2', 'Орк Скверны', '', 'Орк Скверны', 'NORMAL', 'NORMAL', 'NORMAL', '0');
INSERT INTO `wcf_chr_races` VALUES ('13', '1', '1', '0', '17402', '17403', 'Na', '7', '7', '15007', '1096', 'Naga_', '0', '2', 'Нага', 'Нага', 'Наг', 'Normal', 'Normal', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('14', '5', '1', '0', '17576', '17577', 'Br', '7', '7', '15007', '1096', 'Broken', '0', '2', 'Падший', 'Падшая', 'Падший', 'Normal', 'Normal', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('15', '1', '1', '0', '17578', '17579', 'Sk', '7', '7', '15007', '1096', 'Skeleton', '0', '2', 'Скелет', '', 'Скелет', 'Normal', 'Normal', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('16', '9', '1', '0', '21685', '21686', 'Vr', '7', '7', '15007', '1096', 'Vrykul', '0', '2', 'Врайкул', '', 'Врайкул', 'Normal', 'Normal', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('17', '1', '1', '0', '21780', '21781', 'Tu', '7', '7', '15007', '1096', 'Tuskarr', '0', '2', 'Клыкарр', '', 'Клыкарр', 'Normal', 'Normal', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('18', '15', '1', '0', '21963', '21964', 'Ft', '7', '7', '15007', '1096', 'ForestTroll', '0', '2', 'Лесной тролль', '', 'Лесной тролль', 'TUSKS', 'TUSKS', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('19', '5', '1', '0', '26316', '26317', 'Wt', '7', '7', '15007', '1096', 'Taunka', '0', '2', 'Таунка', 'Таунка', 'Таунка', 'Normal', 'Normal', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('20', '5', '1', '0', '26871', '26872', 'NS', '7', '7', '15007', '1096', 'NorthrendSkeleton', '0', '2', 'Нордскольский скелет', '', 'Нордскольский скелет', 'Normal', 'Normal', 'Normal', '0');
INSERT INTO `wcf_chr_races` VALUES ('21', '5', '1', '0', '26873', '26874', 'It', '7', '7', '15007', '1096', 'IceTroll', '0', '2', 'Ледяной тролль', '', 'Ледяной тролль', 'Normal', 'Normal', 'Normal', '0');
INSERT INTO `wcf_comments` VALUES ('1', '1', '2012-01-17 18:08:28', '1', '5', '<p><span style=\\\"text-decoration: line-through;\\\"><span style=\\\"text-decoration: underline;\\\"><em><strong>Проверка работаспособности!</strong></em></span></span></p>');
INSERT INTO `wcf_creature_family` VALUES ('1', '0.7', '1', '1', '60', '208', '270', '1', '0', '23', 'Волк', 'Ability_Hunter_Pet_Wolf');
INSERT INTO `wcf_creature_family` VALUES ('2', '0.7', '1', '1.1', '60', '209', '270', '3', '0', '5', 'Кошка', 'Ability_Hunter_Pet_Cat');
INSERT INTO `wcf_creature_family` VALUES ('3', '0.4', '1', '0.6', '60', '203', '270', '1', '2', '17', 'Паук', 'Ability_Hunter_Pet_Spider');
INSERT INTO `wcf_creature_family` VALUES ('4', '0.6', '1', '1', '60', '210', '270', '63', '1', '1', 'Медведь', 'Ability_Hunter_Pet_Bear');
INSERT INTO `wcf_creature_family` VALUES ('5', '0.6', '1', '1', '60', '211', '270', '63', '1', '3', 'Вепрь', 'Ability_Hunter_Pet_Boar');
INSERT INTO `wcf_creature_family` VALUES ('6', '0.4', '1', '0.6', '60', '212', '270', '3', '1', '7', 'Кроколиск', 'Ability_Hunter_Pet_Crocolisk');
INSERT INTO `wcf_creature_family` VALUES ('7', '0.5', '1', '0.9', '60', '213', '270', '3', '0', '4', 'Падальщик', 'Ability_Hunter_Pet_Vulture');
INSERT INTO `wcf_creature_family` VALUES ('8', '0.7', '1', '1.4', '60', '214', '270', '58', '1', '6', 'Краб', 'Ability_Hunter_Pet_Crab');
INSERT INTO `wcf_creature_family` VALUES ('9', '0.7', '1', '1', '60', '215', '270', '56', '1', '9', 'Горилла', 'Ability_Hunter_Pet_Gorilla');
INSERT INTO `wcf_creature_family` VALUES ('11', '0.5', '1', '0.8', '60', '217', '270', '1', '0', '13', 'Ящер', 'Ability_Hunter_Pet_Raptor');
INSERT INTO `wcf_creature_family` VALUES ('12', '0.5', '1', '0.8', '60', '218', '270', '60', '0', '19', 'Долгоног', 'Ability_Hunter_Pet_TallStrider');
INSERT INTO `wcf_creature_family` VALUES ('15', '0.7', '1', '0.7', '60', '189', '0', '0', '-1', '-1', 'Охотник Скверны', '');
INSERT INTO `wcf_creature_family` VALUES ('16', '0.8', '1', '0.8', '60', '204', '0', '0', '-1', '-1', 'Демон Бездны', '');
INSERT INTO `wcf_creature_family` VALUES ('17', '1', '1', '1', '60', '205', '0', '0', '-1', '-1', 'Суккуб', '');
INSERT INTO `wcf_creature_family` VALUES ('19', '1', '1', '1', '60', '207', '0', '0', '-1', '-1', 'Стражник ужаса', '');
INSERT INTO `wcf_creature_family` VALUES ('20', '0.7', '1', '1', '60', '236', '270', '1', '1', '15', 'Скорпид', 'Ability_Hunter_Pet_Scorpid');
INSERT INTO `wcf_creature_family` VALUES ('21', '0.5', '1', '0.72', '60', '251', '270', '58', '1', '21', 'Черепаха', 'Ability_Hunter_Pet_Turtle');
INSERT INTO `wcf_creature_family` VALUES ('23', '0.5', '1', '0.5', '60', '188', '0', '0', '-1', '-1', 'Бес', '');
INSERT INTO `wcf_creature_family` VALUES ('24', '0.4', '1', '0.63', '60', '653', '270', '49', '2', '0', 'Летучая мышь', 'Ability_Hunter_Pet_Bat');
INSERT INTO `wcf_creature_family` VALUES ('25', '0.7', '1', '0.9', '60', '654', '270', '1', '0', '10', 'Гиена', 'Ability_Hunter_Pet_Hyena');
INSERT INTO `wcf_creature_family` VALUES ('26', '0.5', '1', '0.8', '60', '655', '270', '3', '2', '2', 'Сова', 'Ability_Hunter_Pet_Owl');
INSERT INTO `wcf_creature_family` VALUES ('27', '0.5', '1', '0.7', '60', '656', '270', '14', '2', '22', 'Крылатый змей', 'Ability_Hunter_Pet_WindSerpent');
INSERT INTO `wcf_creature_family` VALUES ('28', '0', '0', '0', '0', '758', '0', '0', '-1', '-1', 'Управление', '');
INSERT INTO `wcf_creature_family` VALUES ('29', '0.9', '1', '0.9', '60', '761', '0', '0', '-1', '-1', 'Страж Скверны', '');
INSERT INTO `wcf_creature_family` VALUES ('30', '0.35', '1', '0.65', '60', '763', '270', '35', '2', '8', 'Дракондор', 'Ability_Hunter_Pet_DragonHawk');
INSERT INTO `wcf_creature_family` VALUES ('31', '0.65', '1', '0.9', '60', '767', '270', '1', '2', '14', 'Опустошитель', 'Ability_Hunter_Pet_Ravager');
INSERT INTO `wcf_creature_family` VALUES ('32', '0.45', '1', '0.6', '60', '766', '270', '34', '1', '21', 'Прыгуана', 'Ability_Hunter_Pet_WarpStalker');
INSERT INTO `wcf_creature_family` VALUES ('33', '0.6', '1', '0.9', '60', '765', '270', '60', '2', '18', 'Спороскат', 'Ability_Hunter_Pet_Sporebat');
INSERT INTO `wcf_creature_family` VALUES ('34', '0.35', '1', '0.55', '60', '764', '270', '17', '2', '12', 'Скат Пустоты', 'Ability_Hunter_Pet_NetherRay');
INSERT INTO `wcf_creature_family` VALUES ('35', '0.6', '1', '0.8', '60', '768', '270', '1', '2', '16', 'Змей', 'Spell_Nature_GuardianWard');
INSERT INTO `wcf_creature_family` VALUES ('37', '0.35', '1', '0.65', '60', '775', '270', '60', '0', '11', 'Мотылек', 'Ability_Hunter_Pet_Moth');
INSERT INTO `wcf_creature_family` VALUES ('38', '0.5', '1', '0.63', '60', '780', '270', '1', '2', '24', 'Химера', 'Ability_Hunter_Pet_Chimera');
INSERT INTO `wcf_creature_family` VALUES ('39', '0.3', '1', '0.5', '60', '781', '270', '1', '0', '25', 'Дьявозавр', 'Ability_Hunter_Pet_Devilsaur');
INSERT INTO `wcf_creature_family` VALUES ('40', '1', '1', '1', '80', '782', '0', '0', '-1', '26', 'Вурдалак', 'Ability_Creature_Cursed_05');
INSERT INTO `wcf_creature_family` VALUES ('41', '0.7', '1', '1', '60', '783', '270', '17', '2', '63', 'Силитид', 'Ability_Hunter_Pet_Silithid');
INSERT INTO `wcf_creature_family` VALUES ('42', '0.7', '1', '1', '60', '784', '270', '28', '1', '62', 'Червь', 'Ability_Hunter_Pet_Worm');
INSERT INTO `wcf_creature_family` VALUES ('43', '0.35', '1', '0.56', '60', '786', '270', '60', '1', '61', 'Люторог', 'Ability_Hunter_Pet_Rhino');
INSERT INTO `wcf_creature_family` VALUES ('44', '0.4', '1', '0.6', '60', '785', '270', '60', '0', '60', 'Оса', 'Ability_Hunter_Pet_Wasp');
INSERT INTO `wcf_creature_family` VALUES ('45', '0.3', '1', '0.5', '60', '787', '270', '1', '0', '59', 'Гончая Недр', 'Ability_Hunter_Pet_CoreHound');
INSERT INTO `wcf_creature_family` VALUES ('46', '0.7', '1', '1.1', '60', '788', '270', '3', '0', '58', 'Дух зверя', 'Ability_Druid_PrimalPrecision');
INSERT INTO `wcf_forums` VALUES ('1', '0', '1', 'Информация о сервере', null, '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('2', '0', '2', 'Мир Warcraft', null, '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('3', '0', '3', 'Жалобы', null, '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('4', '0', '4', 'Разное', null, '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('5', '1', '1', 'Информация от администрации', 'Обновления, изменения, события, новости.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('6', '1', '2', 'Мастерская', 'Делимся своими идеями, решениями. Обсуждаем, создаем что-то свое. В общем \"Игродельня\".', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('7', '1', '3', 'Конкурсы форума', 'Проведение массовых мероприятий на территории форума. ', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('8', '1', '4', 'Техническая поддержка', 'Раздел технической поддержки игроков.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('9', '2', '1', 'Классы', 'Обсуждение, описание, предпочтения, возможности, харрактеристики.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('10', '2', '2', 'Профессии', 'Обсуждение, описание, предпочтения, возможности, плюсы и минусы.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('11', '2', '3', 'Квесты', 'Помощь по квестам в World of Warcraft', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('12', '2', '4', 'Достижения', 'Обсуждение, описание, помощь.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('13', '2', '5', 'PVE: подземелья', 'Раздел для победителей драконов. Здесь делятся советами по прохождению инстансов, приводятся тактики сражения с боссами и публикуются новости об успехах гильдий.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('14', '2', '6', 'PVP: арены и поля боя, слава', 'Раздел для гладиаторов и маршалов. Здесь обсуждается PvP во всех его проявлениях и все связанные с ним нюансы: очки чести, аренный рейтинг, PvP сеты и титулы и т.д.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('15', '2', '7', 'Аддоны и Макросы', 'Скачиваем и заказываем', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('16', '3', '1', 'Жалобы', 'Нарушения правил GM/игроками. Обсуждение и критика.', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('17', '3', '2', 'Жалобы на действия модераторов.', 'Обжалование действий модераторов. ', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('18', '4', '1', 'ОффТопик', 'Разговоры на любую тему', '0', '0', '0');
INSERT INTO `wcf_forums` VALUES ('19', '4', '2', 'Форум Гильдий', 'Здесь можно обсудить гильдии, и получить персональные разделы.', '0', '0', '0');
INSERT INTO `wcf_logs` VALUES ('2012-01-22 21:20:39', '192.168.12.100', '5', '0', '1', 'lovepsone@mail.ru', '', 'LOVEPSONE', '');
INSERT INTO `wcf_navigation_links` VALUES ('1', 'Общее пространство', '---', '-1', '1', '1');
INSERT INTO `wcf_navigation_links` VALUES ('2', 'Главная', 'index.php', '-1', '1', '2');
INSERT INTO `wcf_navigation_links` VALUES ('3', 'Форум', 'forum/index.php', '-1', '1', '3');
INSERT INTO `wcf_navigation_links` VALUES ('4', 'Онлайн', 'online.php', '-1', '1', '4');
INSERT INTO `wcf_navigation_links` VALUES ('31', 'Выйти из АСР', 'setuser.php', '0', '3', '1');
INSERT INTO `wcf_navigation_links` VALUES ('32', 'Услуги', '---', '0', '3', '2');
INSERT INTO `wcf_navigation_links` VALUES ('33', 'Платные', 'index.php', '0', '3', '3');
INSERT INTO `wcf_navigation_links` VALUES ('34', 'Бесплатные', 'index.php', '0', '3', '4');
INSERT INTO `wcf_news` VALUES ('1', '2012-01-26 15:51:10', '5', 'От разработчика', '1', '1', '<p>wcf успешно установлен и готов к использованию!</p>', '<p>wcf успешно установлен и готов к использованию!</p>', '-1', '1');
INSERT INTO `wcf_news` VALUES ('4', '2012-01-26 15:39:43', '5', 'Десятка умерших аддонов', '1', '1', '<p>Не секрет что Близзард любят заимствовать иде у различного вида проектов. Получается это у них отменно, именно поэтому треть их бюджета уходит на судебные разбирательства. Но вот о внутреннем заимствовании мало кто задумывается. А именно заимствование аддонов, которые пользователи создают за бесплатно и продвигают в массы. Ну а Blizzard берут идею и подгребают под себя с выходом очередного патча.</p>\r\n<p><br /> <strong>Десяток аддонов, пострадавших от инициативы Blizzard:<br /> </strong><br /> <strong><span><strong><strong>QuestHelper</strong></strong></span> </strong>- Самый популярный аддон для The Burning Crusade, и Начальных версий Wrath of the Lich King, но после патча 3.3, про него многие забыли, ибо Blizzard придумали свой \\\\\\\"Квест хелпер\\\\\\\", который понравился многим намного больше аддона. По большей части потому, что он не требовал так много ресурсов от вашей машины...</p>', '<p>Не секрет что Близзард любят заимствовать иде у различного вида проектов. Получается это у них отменно, именно поэтому треть их бюджета уходит на судебные разбирательства. Но вот о внутреннем заимствовании мало кто задумывается. А именно заимствование аддонов, которые пользователи создают за бесплатно и продвигают в массы. Ну а Blizzard берут идею и подгребают под себя с выходом очередного патча. <br /> <strong>Десяток аддонов, пострадавших от инициативы Blizzard:<br /> </strong><br /> <strong>QuestHelper </strong>- Самый популярный аддон для The Burning Crusade, и Начальных версий Wrath of the Lich King, но после патча 3.3, про него многие забыли, ибо Blizzard придумали свой \\\\\\\"Квест хелпер\\\\\\\", который понравился многим намного больше аддона. По большей части потому, что он не требовал так много ресурсов от вашей машины.<br /> <br /> <br /> <strong>Cartographer</strong> - В былое время был популярен не менее чем QuestHelper, ибо с ним вместе они работали на славу и помогали проходить квесты не одному поколению Воверов, но после патча 3.0 Блззард кардинально изменили систему определения локаций, поэтому разработчик прекратил дальнейшую модификацию этого аддона.<br /> <br /> <strong><span>Outfitter </span></strong>- Не каждый мог себе позволить носить при себе сразу два сета, для PVE и PVP, но те кто мог использовали Outfitter для быстрой смены экипировки. И вот начиная с патча 3.1.2, Близзард решили сделать свой Outfitter и назвали его \\\\\\\"Управление экипировкой\\\\\\\".<br /> <br /> <strong><span>FloTotemBar</span></strong> - Излюбленный аддон для шаманов ровно до патча 3.x, точно не помню в каком именно патче разработчики игры решили позаимствовать идею отдельных панелей для тотемов. Теперь использовать Тотем бар будут наверно только те, кому не нравиться стандартный интерфейс.<br /> <br /> <strong><span>VuhDo</span></strong> - Изменял интерфейс рейд-иконок. и позволял лечащим классам чувствовать себя увереннее.<br /> <br /> <strong><strong><span>Grid </span></strong></strong>- Так же как и VuhDo аддон был полностью перенесен в интерфейс игры разработчиками, начиная с патча 4.0.1. Поэтому в Катаклизме у этих двух аддонов перспективы на существование нету.<br /> <br /> Group Calendar - Аддон прижился далеко не во всех гильдиях, ибо заставить всех установить его было не легкой задачей. Теперь в этом нет необходимости, так как календарь появился по умолчанию.<br /> <br /> AVR - Помогал организовать рейды, в плане управления толпой. Некоторые рейды без этого аддона были бы просто большим бестолковым пати. Но до катаклизма аддон не дожил ибо Близы официально его запретили, а в катаклизме сделали свою, более простую и красивую версию данного аддона.<br /> <br /> EquipCompare - Как сравнить шмотку надетую на вас, с той что в инвентаре или магазине? Ну естественно надо нажать кнопку Shift, но ранее такой опции в игре не было, и для этого был придуман EquipCompare. После выхода WotLK про аддон забыли, но его по прежнему разрабатывают.<br /> <br /> Buff Timers - Отличная модификация иконок Бафов, времен Пылающего Легиона. Аддон добавлял таймеры возле картинок бафов или дебафов, что позволяло узнать когда он спадет. Удивительно как Близард сразу не додумались такое интегрировать в интерфейс? Теперь в этом аддоне нет нужды, по понятным всем причинам.<br /> <br /> Не смотря на то, что в свое время Близард даже пытались запретить донат за аддоны, которые созданы сторонними разработчиками для улучшения игры, и делают ее интереснее. В сети все ровно появляются все новые и новые модификации, и как бы Близард не бесилась по этому поводу, прогресс не остановить, как и тот факт что весь прогресс будет в итоге присвоен \\\\\\\"Конторой\\\\\\\".</p>', '-1', '0');
INSERT INTO `wcf_news_cats` VALUES ('1', 'Новости', 'news.gif');
INSERT INTO `wcf_news_cats` VALUES ('2', 'Ошибки', 'bugs.gif');
INSERT INTO `wcf_news_cats` VALUES ('3', 'Игры', 'games.gif');
INSERT INTO `wcf_news_cats` VALUES ('4', 'Интернет', 'network.gif');
INSERT INTO `wcf_news_cats` VALUES ('5', 'Загрузки', 'downloads.gif');
INSERT INTO `wcf_news_cats` VALUES ('6', 'БСД', 'bsd.gif');
INSERT INTO `wcf_news_cats` VALUES ('7', 'Графика', 'graphics.gif');
INSERT INTO `wcf_news_cats` VALUES ('8', 'Аппаратные средства', 'hardware.gif');
INSERT INTO `wcf_news_cats` VALUES ('9', 'Журнал', 'journal.gif');
INSERT INTO `wcf_news_cats` VALUES ('10', 'Linux', 'linux.gif');
INSERT INTO `wcf_news_cats` VALUES ('11', 'Мас', 'mac.gif');
INSERT INTO `wcf_news_cats` VALUES ('12', 'Пользователи', 'members.gif');
INSERT INTO `wcf_news_cats` VALUES ('13', 'Моды', 'mods.gif');
INSERT INTO `wcf_news_cats` VALUES ('14', 'Видео', 'movies.gif');
INSERT INTO `wcf_news_cats` VALUES ('15', 'Музыка', 'music.gif');
INSERT INTO `wcf_news_cats` VALUES ('16', 'Безопасность', 'security.gif');
INSERT INTO `wcf_news_cats` VALUES ('17', 'Программы', 'software.gif');
INSERT INTO `wcf_news_cats` VALUES ('18', 'Схемы Скины', 'themes.gif');
INSERT INTO `wcf_news_cats` VALUES ('19', 'Web Clear Fusion', 'web-clear-fusion.gif');
INSERT INTO `wcf_news_cats` VALUES ('20', 'Виндовс', 'windows.gif');
INSERT INTO `wcf_panels` VALUES ('1', 'navigation_panel', 'file', '-1', '1', '1', '1', '0');
INSERT INTO `wcf_panels` VALUES ('2', 'user_info_panel', 'file', '-1', '4', '1', '1', '0');
INSERT INTO `wcf_panels` VALUES ('3', 'welcome_message_panel', 'file', '-1', '2', '1', '1', '0');
INSERT INTO `wcf_settings` VALUES ('servername', 'Name WoW Server');
INSERT INTO `wcf_settings` VALUES ('serverurl', '/');
INSERT INTO `wcf_settings` VALUES ('serverbanner', 'images/banners.png');
INSERT INTO `wcf_settings` VALUES ('serverintro', '<div style=\\\'text-align:center\\\'>Добро пожаловать на сайт!<br>Наш set realmlist WoW Server</div>');
INSERT INTO `wcf_settings` VALUES ('opening_page', 'news.php');
INSERT INTO `wcf_settings` VALUES ('lang', 'russian');
INSERT INTO `wcf_settings` VALUES ('theme', 'default');
INSERT INTO `wcf_settings` VALUES ('exclude_left', '');
INSERT INTO `wcf_settings` VALUES ('exclude_right', '');
INSERT INTO `wcf_settings` VALUES ('exclude_upper', '');
INSERT INTO `wcf_settings` VALUES ('exclude_lower', '');
INSERT INTO `wcf_settings` VALUES ('Kcaptcha_enable_auth', '0');
INSERT INTO `wcf_settings` VALUES ('page_forum_threads', '10');
INSERT INTO `wcf_settings` VALUES ('page_forum_posts', '10');
INSERT INTO `wcf_settings` VALUES ('pass_remember', 'on');
INSERT INTO `wcf_settings` VALUES ('registration_ip_limit', '0');
INSERT INTO `wcf_settings` VALUES ('page_news', '5');
INSERT INTO `wcf_settings` VALUES ('page_online', '30');
INSERT INTO `wcf_settings` VALUES ('license_agreement', 'Регистрация учётной записи для игры в WoW на нашем сервере. Внимательно, правильно заполните все поля этой формы. Особое внимание обращаем на правильность ввода E-mailа, т.к. многие операции с учётными записями и персонажами требуют подтверждения по электронной почте. Имя учётной записи и пароль не должны совпадать.<hr>Большая просьба не регистрировать учётные записи, содержащие русские буквы, а то вы не сможете правильно подключиться к серверу.<hr> Удачной вам игры. Спасибо за внимание.<br>');
INSERT INTO `wcf_settings` VALUES ('permit_registration', '1');
INSERT INTO `wcf_users` VALUES ('1', 'ADMINISTRATOR', '0', '');
INSERT INTO `wcf_users` VALUES ('2', 'GAMEMASTER', '0', '');
INSERT INTO `wcf_users` VALUES ('3', 'MODERATOR', '0', '');
INSERT INTO `wcf_users` VALUES ('4', 'PLAYER', '0', '');
INSERT INTO `wcf_users` VALUES ('5', 'LOVEPSONE', '1', '');
