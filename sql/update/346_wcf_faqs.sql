
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wcf_faqs`
-- ----------------------------
DROP TABLE IF EXISTS `wcf_faqs`;
CREATE TABLE `wcf_faqs` (
  `faq_id` mediumint(8) unsigned NOT NULL auto_increment,
  `faq_cat_id` mediumint(8) unsigned NOT NULL default '0',
  `faq_question` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `faq_answer` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`faq_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
