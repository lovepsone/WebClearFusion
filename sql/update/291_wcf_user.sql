-- ----------------------------
-- Table structure for wcf_user
-- ----------------------------
ALTER TABLE `wcf_users` ADD COLUMN `user_bonuses` int(11) unsigned NOT NULL default '0' AFTER `user_avatar`;