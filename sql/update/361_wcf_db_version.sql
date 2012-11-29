-- ----------------------------
-- Table structure for wcf_db_version
-- ----------------------------
DROP TABLE IF EXISTS `wcf_db_version`;
CREATE TABLE `wcf_db_version` (
`version` varchar(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `wcf_db_version` (`version`) VALUES ('wcf_r361')