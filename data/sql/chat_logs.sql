SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;
-- ----------------------------
--  Table structure for `chat_logs`
-- ----------------------------
DROP TABLE IF EXISTS `chat_logs`;
CREATE TABLE `chat_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user1` varchar(16) DEFAULT NULL,
  `user2` varchar(16) DEFAULT NULL,
  `log` text DEFAULT NULL,
  `last_date` datetime DEFAULT NULL
  PRIMARY KEY (`id`),
  KEY `user1` (`user1`) BTREE,
  KEY `user2` (`user2`) BTREE,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `user_data`
-- ----------------------------
BEGIN;
INSERT INTO `chat_logs` VALUES ()
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;