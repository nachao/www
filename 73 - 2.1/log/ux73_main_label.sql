/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : ux73

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-09-13 08:54:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ux73_main_label`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_main_label`;
CREATE TABLE `ux73_main_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lid` int(11) DEFAULT '0' COMMENT '标签唯一编号',
  `time_create` int(11) DEFAULT '0' COMMENT '创建时间',
  `time_active` int(11) DEFAULT '0' COMMENT '最近使用时间',
  `text_name` varchar(100) DEFAULT '' COMMENT '名称',
  `status_open` int(1) DEFAULT '1' COMMENT '状态：0=关闭；1=开启',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ux73_main_label
-- ----------------------------
INSERT INTO `ux73_main_label` VALUES ('56', '2147483647', '1431538805', '0', '最后的香格里拉（上）', '1');
INSERT INTO `ux73_main_label` VALUES ('57', '2147483647', '1431538806', '0', '城市、远方和故乡', '1');
INSERT INTO `ux73_main_label` VALUES ('58', '2147483647', '1431538807', '0', '旅行，让生命从容', '1');
INSERT INTO `ux73_main_label` VALUES ('59', '2147483647', '1431538812', '0', '徒搭去圣地（上）', '1');
INSERT INTO `ux73_main_label` VALUES ('60', '2147483647', '1431538814', '0', '1', '1431538824');
INSERT INTO `ux73_main_label` VALUES ('61', '2147483647', '1431538816', '0', '1', '1431538840');
INSERT INTO `ux73_main_label` VALUES ('62', '2147483647', '1431538819', '0', '1', '1431538847');
INSERT INTO `ux73_main_label` VALUES ('63', '2147483647', '1431538831', '0', '1', '1431538836');
INSERT INTO `ux73_main_label` VALUES ('64', '2147483647', '1431538838', '0', '1', '1431538857');
INSERT INTO `ux73_main_label` VALUES ('65', '2147483647', '1431538844', '0', '徒搭去圣地 - （下）', '1');
INSERT INTO `ux73_main_label` VALUES ('66', '2147483647', '1431538849', '0', '转山转水只为你', '1');
INSERT INTO `ux73_main_label` VALUES ('67', '2147483647', '1431538859', '0', '朝圣，梅里', '1432192038');
INSERT INTO `ux73_main_label` VALUES ('68', '2147483647', '1432192044', '0', '最后的香格里拉 （下）', '1');
