SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;
-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(16) DEFAULT NULL,
  `name` varchar(16) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile` text DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `last_date` datetime DEFALUT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `password` (`password`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('testid1', 'テスト1', 'testpass1', NULL, '2015-03-30 00:00:00', '2015-03-30 00:00:00');
INSERT INTO `users` VALUES ('testid2', 'テスト2', 'testpass2', NULL, '2015-03-30 00:00:00', '2015-03-30 00:00:00');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;