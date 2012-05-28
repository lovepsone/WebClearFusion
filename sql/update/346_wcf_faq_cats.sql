

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wcf_faq_cats`
-- ----------------------------
DROP TABLE IF EXISTS `wcf_faq_cats`;
CREATE TABLE `wcf_faq_cats` (
  `faq_cat_id` mediumint(8) unsigned NOT NULL auto_increment,
  `faq_cat_name` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `faq_cat_description` varchar(250) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`faq_cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of fusion_faq_cats
-- ----------------------------
