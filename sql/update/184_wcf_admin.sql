/*
MySQL Data Transfer
Source Host: localhost
Source Database: wcf
Target Host: localhost
Target Database: wcf
Date: 30.01.2012 19:42:10
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
-- Records 
-- ----------------------------
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
