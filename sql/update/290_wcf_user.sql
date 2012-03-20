-- ----------------------------
-- Table structure for wcf_user
-- ----------------------------
ALTER TABLE `wcf_users` ADD COLUMN `user_sha_pass_hash` varchar(40) NOT NULL default '' AFTER `user_name`;
ALTER TABLE `wcf_users` ADD COLUMN `user_gmlevel` tinyint(3) unsigned NOT NULL default '0' AFTER `user_sha_pass_hash`;