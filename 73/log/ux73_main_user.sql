/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : ux73

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-09-13 08:50:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ux73_main_user`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_main_user`;
CREATE TABLE `ux73_main_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_uid` int(11) DEFAULT '0' COMMENT '用户唯一编号',
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ux73_main_user
-- ----------------------------
