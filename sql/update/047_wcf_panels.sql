DROP TABLE IF EXISTS `wcf_panels`;
CREATE TABLE `wcf_panels` (
  `panel_id` mediumint(8) unsigned NOT NULL auto_increment,
  `panel_name` varchar(200) NOT NULL default '',
  `panel_url` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL default '',
  `panel_position` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`panel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `wcf_panels` VALUES ('1', 'main form', 'panels/main_form/main_form.php', '0');
INSERT INTO `wcf_panels` VALUES ('2', 'navigation panel', 'panels/navigation_panel/navigation_panel.php', '1');
INSERT INTO `wcf_panels` VALUES ('3', 'user info panel', 'panels/user_info_panel/user_info_panel.php', '2');
