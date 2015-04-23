/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : ux73

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-04-18 00:21:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ux73_special`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_special`;
CREATE TABLE `ux73_special` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(11) NOT NULL,
  `name` varchar(100) CHARACTER SET gbk NOT NULL,
  `depict` text CHARACTER SET gbk NOT NULL COMMENT '描述',
  `number` int(11) NOT NULL COMMENT '持有数量',
  `welfare` int(11) NOT NULL COMMENT '福利',
  `gain` varchar(500) CHARACTER SET gbk NOT NULL COMMENT '获取条件',
  `purchase` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ux73_special
-- ----------------------------
INSERT INTO `ux73_special` VALUES ('2', 'vip', '特殊用户', '①、享受：发布底价为 0.03元；<br />\r\n②、发布冷却减短为：10 秒 ；<br />\r\n③、特殊显示用户；<br />\r\n④、有效时间七天；<br />', '0', '1', '购买', '300');
INSERT INTO `ux73_special` VALUES ('3', 'new', '新手', '余额低于 0.10 元的用户都可以领取 此徽章，并领取 0.10 元的日福利。<br />\r\n当用户余额大于 0.10 元的时候，则不可再领取此福利。', '0', '10', '免费', null);
INSERT INTO `ux73_special` VALUES ('4', 'one', '财富榜第一名', '排行榜每天的 0 点刷新记录。<br />\n①、每天 0 点后您可以领取相应的丰富福利；<br />\n②、特殊奖励；', '0', '999', '自动发放', null);
INSERT INTO `ux73_special` VALUES ('5', 'niu', '分享者', '邀请 3为好友可以获得此奖励。<br />在《个人设置》里可以找到邀请地址。', '0', '99', '自动发放', null);
INSERT INTO `ux73_special` VALUES ('6', 'ceshi', '内测会员', 'Welfare is looking for grass root most loved resource sharing platform, looking for some fun, welfare will be nice, fresh information collected to share to everyone. <br /><br />\r\nAt the same time, we also hope that the grass root people can put you cherish the welfare to share out, everybody happy is really...', '0', '73', '自动发放', null);
INSERT INTO `ux73_special` VALUES ('7', 'two', '财富榜第二名', '排行榜每天的 0 点刷新记录。<br />\n①、每天 0 点后您可以领取相应的丰富福利；<br />\n②、特殊奖励；', '0', '888', '自动发放', null);
INSERT INTO `ux73_special` VALUES ('10', 'three', '财富榜第三名', '排行榜每天的 0 点刷新记录。<br />\r\n①、每天 0 点后您可以领取相应的丰富福利；<br />\r\n②、特殊奖励；', '0', '777', '自动发放', null);
INSERT INTO `ux73_special` VALUES ('9', 'friend', '芳芳的朋友', '资助。', '0', '73', '免费', null);
