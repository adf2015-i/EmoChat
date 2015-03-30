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
  `create_date` varchar(30) DEFAULT NULL,
  `last_date` varchar(30),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `password` (`password`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` (user_id, name, password, create_date) VALUES ('testid1', '太郎', 'testpass1', NOW());
INSERT INTO `users` (user_id, name, password, create_date) VALUES ('testid2', '花子', 'testpass2', NOW());
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;