/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 19.01.2012 14:42:40
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `wcf_admin` VALUES ('1', '1', '1', '1', 'news.gif', 'Новости', 'news.php');
INSERT INTO `wcf_admin` VALUES ('2', '2', '1', '1', 'forums.gif', 'Форум', 'forumedit.php');
INSERT INTO `wcf_admin` VALUES ('3', '3', '1', '1', 'panels.gif', 'Панели', 'reserved');
INSERT INTO `wcf_admin` VALUES ('4', '4', '1', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('5', '1', '1', '2', 'news_cats', 'Категории новостей', 'news_cats.php');
INSERT INTO `wcf_admin` VALUES ('6', '2', '1', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('7', '3', '1', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('8', '4', '1', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('9', '1', '1', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('10', '2', '1', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('11', '3', '1', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('12', '4', '1', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('13', '1', '1', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('14', '2', '1', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('15', '3', '1', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('16', '4', '1', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('17', '1', '2', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('18', '2', '2', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('19', '3', '2', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('20', '4', '2', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('21', '1', '2', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('22', '2', '2', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('23', '3', '2', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('24', '4', '2', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('25', '1', '2', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('26', '2', '2', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('27', '3', '2', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('28', '4', '2', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('29', '1', '2', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('30', '2', '2', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('31', '3', '2', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('32', '4', '2', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('33', '1', '3', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('34', '2', '3', '1', 'site_links.gif', 'Навигация сайта', 'site_links.php');
INSERT INTO `wcf_admin` VALUES ('35', '3', '3', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('36', '4', '3', '1', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('37', '1', '3', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('38', '2', '3', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('39', '3', '3', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('40', '4', '3', '2', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('41', '1', '3', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('42', '2', '3', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('43', '3', '3', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('44', '4', '3', '3', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('45', '1', '3', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('46', '2', '3', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('47', '3', '3', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('48', '4', '3', '4', '', '', 'reserved');
INSERT INTO `wcf_admin` VALUES ('49', '1', '4', '1', 'settings.gif', 'Главные установки', 'settings_main.php');
