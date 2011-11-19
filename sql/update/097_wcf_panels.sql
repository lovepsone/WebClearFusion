DROP TABLE IF EXISTS `wcf_panels`;
CREATE TABLE `wcf_panels` (
  `panel_id` mediumint(8) unsigned NOT NULL auto_increment,
  `panel_filename` varchar(200) NOT NULL default '',
  `panel_position` tinyint(1) unsigned NOT NULL default '1',
  `panel_status` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`panel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `wcf_panels` VALUES ('1', 'main_form', '0', '1');
INSERT INTO `wcf_panels` VALUES ('2', 'navigation_panel', '1', '1');
INSERT INTO `wcf_panels` VALUES ('3', 'user info panel', '2', '1');
