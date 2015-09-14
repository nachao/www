/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : ux73

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-09-14 17:38:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ux73_log_label`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_log_label`;
CREATE TABLE `ux73_log_label` (
  `id_lid` int(11) DEFAULT '0' COMMENT '标签唯一编号',
  `id_uid` int(11) DEFAULT '0' COMMENT '用户唯一编号',
  `id_cid` int(11) DEFAULT '0' COMMENT '内容唯一编号',
  `time_use` int(11) DEFAULT '0' COMMENT '使用时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ux73_log_label
-- ----------------------------
INSERT INTO `ux73_log_label` VALUES ('1', '2', '1', '1442223235');
INSERT INTO `ux73_log_label` VALUES ('2', '2', '1', '1442223235');
INSERT INTO `ux73_log_label` VALUES ('3', '2', '1', '1442223236');
INSERT INTO `ux73_log_label` VALUES ('4', '2', '1', '1442223236');
INSERT INTO `ux73_log_label` VALUES ('5', '2', '1', '1442223236');

-- ----------------------------
-- Table structure for `ux73_main_content`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_main_content`;
CREATE TABLE `ux73_main_content` (
  `id_cid` int(11) NOT NULL AUTO_INCREMENT COMMENT '内容唯一编号',
  `id_uid` int(11) DEFAULT '0' COMMENT '用户唯一编号',
  `id_tid` int(11) DEFAULT '0' COMMENT '标题唯一编号',
  `id_cid_special` varchar(100) DEFAULT NULL,
  `main_text` text CHARACTER SET gbk COMMENT '文本内容',
  `main_input` text COMMENT '链接、图片、视频、音乐各种地址链接',
  `number_zan` int(11) DEFAULT '0' COMMENT '点赞总量',
  `number_sum` int(11) DEFAULT '0' COMMENT '收入积分总量',
  `number_see` int(11) DEFAULT '0' COMMENT '查看总次数',
  `number_consume` int(11) DEFAULT '0' COMMENT '发布所消耗的金额（单位：分）',
  `time_base` int(11) DEFAULT '0' COMMENT '发布时间',
  `time_revise` int(11) DEFAULT '0' COMMENT '最近一次修改时间',
  `status_verify` int(1) DEFAULT '0' COMMENT '状态；0=正常、2=关闭、1=被查',
  `status_type` int(1) DEFAULT '0' COMMENT '0=文本；1=图片；2=视频；3=音乐；4=链接',
  `status_effects` int(1) DEFAULT '0' COMMENT '标示：1=顶（作者）、2=推荐（题主）',
  `title_shareglod` int(11) DEFAULT '0' COMMENT '分享金赞助金额',
  PRIMARY KEY (`id_cid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ux73_main_content
-- ----------------------------
INSERT INTO `ux73_main_content` VALUES ('1', '2', '0', null, 'aaaaaaaaaaaaa', '', '0', '0', '0', '0', '1442223235', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `ux73_main_label`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_main_label`;
CREATE TABLE `ux73_main_label` (
  `id_lid` int(11) NOT NULL AUTO_INCREMENT COMMENT '标签唯一编号',
  `id_uid` int(11) DEFAULT '0' COMMENT '创建者用户唯一编号',
  `time_create` int(11) DEFAULT '0' COMMENT '创建时间',
  `time_active` int(11) DEFAULT '0' COMMENT '最近使用时间',
  `text_name` varchar(100) DEFAULT '' COMMENT '名称',
  `status_open` int(1) DEFAULT '1' COMMENT '状态：0=关闭；1=开启',
  PRIMARY KEY (`id_lid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ux73_main_label
-- ----------------------------
INSERT INTO `ux73_main_label` VALUES ('1', '2', '1442223235', '1442223235', 'a', '1');
INSERT INTO `ux73_main_label` VALUES ('2', '2', '1442223235', '1442223235', 'b', '1');
INSERT INTO `ux73_main_label` VALUES ('3', '2', '1442223235', '1442223235', 'v', '1');
INSERT INTO `ux73_main_label` VALUES ('4', '2', '1442223236', '1442223236', 'e', '1');
INSERT INTO `ux73_main_label` VALUES ('5', '2', '1442223236', '1442223236', 'd', '1');

-- ----------------------------
-- Table structure for `ux73_main_user`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_main_user`;
CREATE TABLE `ux73_main_user` (
  `id_uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户唯一编号',
  `id_invited` int(11) DEFAULT '0' COMMENT '邀请者唯一编号',
  `text_account` varchar(100) DEFAULT '' COMMENT '用户名称',
  `text_nick` varchar(100) DEFAULT '' COMMENT '昵称',
  `text_pwd` varchar(100) DEFAULT '' COMMENT '密码',
  `text_icon` varchar(100) DEFAULT '' COMMENT '头像',
  `text_email` varchar(100) DEFAULT '' COMMENT '邮箱',
  `text_describe` varchar(100) DEFAULT '' COMMENT '个人描述',
  `text_register_ip` varchar(100) DEFAULT '' COMMENT '注册ip',
  `time_lastdate` int(11) DEFAULT '0' COMMENT '最近登陆时间',
  `time_lastact` int(11) DEFAULT '0' COMMENT '最新发布时间',
  `time_lastskip` int(11) DEFAULT '0' COMMENT '最近一次跳转时间',
  `time_register` int(11) DEFAULT '0' COMMENT '注册时间',
  `time_message` int(11) DEFAULT '0' COMMENT '最近一次进入 自己的留言界面时间',
  `number_sum` int(11) DEFAULT '0' COMMENT '余额',
  `number_issue` int(11) DEFAULT '0' COMMENT '发布量',
  `number_comments` int(11) DEFAULT '0' COMMENT '收到点赞量',
  `number_entrys` int(11) DEFAULT '0' COMMENT '登录次数',
  `status_visitor` int(1) DEFAULT '1' COMMENT '0=游客，1=会员',
  `status_vip` int(1) DEFAULT '0' COMMENT '是否为会员 1=是、0=不是',
  PRIMARY KEY (`id_uid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ux73_main_user
-- ----------------------------
INSERT INTO `ux73_main_user` VALUES ('1', '0', 'zz', '', '0cc175b9c0f1b6a831c399e269772661', '', '', '', '::1', '1442147673', '0', '1442147673', '1442147673', '0', '0', '0', '0', '0', '1', '0');
INSERT INTO `ux73_main_user` VALUES ('2', '0', 'a', '', '0cc175b9c0f1b6a831c399e269772661', '', '', '', '', '1442222490', '0', '1442150116', '1442150116', '0', '0', '0', '0', '0', '1', '0');
INSERT INTO `ux73_main_user` VALUES ('3', '0', 'q', '', '7694f4a66316e53c8cdd9d9954bd611d', '', '', '', '', '1442211700', '0', '1442211700', '1442211700', '0', '0', '0', '0', '0', '1', '0');

-- ----------------------------
-- Table structure for `ux73_main_zan`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_main_zan`;
CREATE TABLE `ux73_main_zan` (
  `id_cid` int(11) DEFAULT '0' COMMENT '内容唯一编号',
  `id_uid` int(11) DEFAULT '0' COMMENT '用户唯一编号',
  `time_zan` int(11) DEFAULT '0' COMMENT '点赞时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ux73_main_zan
-- ----------------------------
INSERT INTO `ux73_main_zan` VALUES ('123', '123', '123');
INSERT INTO `ux73_main_zan` VALUES ('11', '3', '1442212775');
INSERT INTO `ux73_main_zan` VALUES ('10', '3', '1442213569');
INSERT INTO `ux73_main_zan` VALUES ('8', '3', '1442213577');
INSERT INTO `ux73_main_zan` VALUES ('5', '2', '1442222494');
INSERT INTO `ux73_main_zan` VALUES ('4', '2', '1442222495');
