/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : ux73

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-05-26 13:46:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ux73_logs_purchase`
-- ----------------------------
DROP TABLE IF EXISTS `ux73_logs_purchase`;
CREATE TABLE `ux73_logs_purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) DEFAULT NULL COMMENT '购买时间',
  `in_uid` bigint(20) DEFAULT '0' COMMENT '收入账户',
  `out_uid` bigint(30) DEFAULT '0' COMMENT '支出用户',
  `source` varchar(10) DEFAULT '-' COMMENT '来源：cid、tid、sid',
  `source_id` bigint(30) DEFAULT NULL COMMENT '来源id',
  `types` tinyint(1) DEFAULT '0' COMMENT '1=收入、0=支出',
  `sum` int(11) DEFAULT '0' COMMENT '金额（单位：分）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8 COMMENT='用户收入和支出记录表';

-- ----------------------------
-- Records of ux73_logs_purchase
-- ----------------------------
INSERT INTO `ux73_logs_purchase` VALUES ('1', '1427855867', '0', '141427781015', 'cid', '291427792047', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('2', '1427855872', '0', '141427781015', 'cid', '291427775324', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('3', '1427855902', '0', '141427781015', 'cid', '291427772416', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('4', '1427855910', '0', '141427781015', 'cid', '271427707464', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('5', '1427856727', '0', '141427781015', 'cid', '321427775635', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('6', '1427856791', '0', '81427794933', 'cid', '321427775635', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('7', '1427856847', '0', '81427794933', 'cid', '321427775646', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('8', '1427856850', '0', '81427794933', 'cid', '321427775958', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('9', '1427856856', '0', '81427794933', 'cid', '321427775977', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('10', '1427856856', '0', '81427794933', 'cid', '321427775966', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('11', '1427856858', '0', '81427794933', 'cid', '321427775658', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('12', '1427856998', '0', '81427794933', 'cid', '341427791096', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('13', '1427858637', '0', '81427794933', 'cid', '108', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('14', '1427858656', '0', '81427794933', 'cid', '291427792047', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('15', '1427858694', '0', '81427794933', 'cid', '341427791723', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('16', '1427869462', '0', '81427794933', 'cid', '291427775324', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('17', '1427869469', '0', '81427794933', 'cid', '291427772914', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('18', '1427869472', '0', '81427794933', 'cid', '291427772416', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('19', '1427869482', '0', '81427794933', 'cid', '291427775359', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('20', '1427869487', '0', '81427794933', 'cid', '291427707867', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('21', '1427869490', '0', '81427794933', 'cid', '291427700387', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('22', '1427869493', '0', '81427794933', 'cid', '291427707914', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('23', '1427869509', '0', '81427794933', 'cid', '341427785258', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('24', '1427869515', '0', '81427794933', 'cid', '341427784869', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('25', '1427869525', '0', '81427794933', 'cid', '301427723198', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('26', '1427869633', '0', '81427794933', 'cid', '271427441865', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('27', '1427869633', '0', '81427794933', 'cid', '271427441806', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('28', '1427869634', '0', '81427794933', 'cid', '271427701934', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('29', '1427869636', '0', '81427794933', 'cid', '271427441321', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('30', '1427869637', '0', '81427794933', 'cid', '271427441525', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('31', '1427869638', '0', '81427794933', 'cid', '271427441769', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('32', '1427869639', '0', '81427794933', 'cid', '271427435050', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('33', '1427869639', '0', '81427794933', 'cid', '271427440087', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('34', '1427869704', '0', '81427794933', 'cid', '271427702122', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('35', '1427869901', '0', '141427781015', 'cid', '341427791723', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('36', '1427869902', '0', '141427781015', 'cid', '341427791096', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('37', '1427869906', '0', '141427781015', 'cid', '341427784869', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('38', '1427869907', '0', '141427781015', 'cid', '321427775977', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('39', '1427869908', '0', '141427781015', 'cid', '341427785258', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('40', '1427869909', '0', '141427781015', 'cid', '321427775966', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('41', '1427869910', '0', '141427781015', 'cid', '321427775658', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('42', '1427869910', '0', '141427781015', 'cid', '321427775958', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('43', '1427880811', '0', '101427698727', 'cid', '341427791723', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('44', '1427880861', '0', '101427698727', 'cid', '351427858625', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('45', '1427880869', '0', '101427698727', 'cid', '341427785258', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('46', '1427880873', '0', '101427698727', 'cid', '341427791096', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('47', '1427880875', '0', '101427698727', 'cid', '341427784869', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('48', '1427880877', '0', '101427698727', 'cid', '321427775635', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('49', '1427880879', '0', '101427698727', 'cid', '321427775658', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('50', '1427880911', '0', '101427698727', 'cid', '301427723198', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('51', '1427880913', '0', '101427698727', 'cid', '271427707464', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('52', '1427944681', '0', '141427781015', 'cid', '351427858625', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('53', '1427944691', '0', '141427781015', 'cid', '291427881009', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('54', '1427956374', '0', '141427781015', 'cid', '291427880991', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('55', '1427956376', '0', '141427781015', 'cid', '291427880933', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('56', '1429157712', '0', '101427698727', 'cid', '411429156473', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('57', '1429159359', '0', '151429157737', 'cid', '411429156473', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('58', '1429159369', '0', '151429157737', 'cid', '411429157688', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('59', '1429166445', '0', '151429157737', 'cid', '321427775977', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('60', '1429246608', '0', '101427698727', 'cid', '271427441865', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('61', '1429249928', '0', '101427698727', 'cid', '421429159426', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('62', '1429429146', '0', '111427723099', 'cid', '421429159426', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('63', '1429429220', '0', '111427723099', 'cid', '411429156473', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('64', '1429429250', '0', '111427723099', 'cid', '291427881009', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('65', '1429429305', '0', '111427723099', 'cid', '291427880991', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('66', '1429429317', '0', '111427723099', 'cid', '351427858625', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('67', '1429429323', '0', '111427723099', 'cid', '291427880933', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('68', '1429429582', '0', '111427723099', 'cid', '341427784869', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('69', '1429429583', '0', '111427723099', 'cid', '341427785258', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('70', '1429429584', '0', '111427723099', 'cid', '341427791096', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('71', '1429429586', '0', '111427723099', 'cid', '321427775958', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('72', '1429429587', '0', '111427723099', 'cid', '321427775977', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('73', '1429429588', '0', '111427723099', 'cid', '321427775966', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('74', '1429429590', '0', '111427723099', 'cid', '321427775646', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('75', '1429429593', '0', '111427723099', 'cid', '341427791723', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('76', '1429429617', '0', '111427723099', 'cid', '291427792047', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('77', '1429429650', '0', '111427723099', 'cid', '321427775658', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('78', '1429429914', '0', '111427723099', 'cid', '271427701934', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('79', '1429429920', '0', '111427723099', 'cid', '271427441865', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('80', '1429429922', '0', '111427723099', 'cid', '271427441806', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('81', '1429429947', '0', '121427768841', 'cid', '291427881009', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('82', '1429429950', '0', '121427768841', 'cid', '291427880991', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('83', '1429429952', '0', '121427768841', 'cid', '291427880933', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('84', '1430234872', '0', '121427768841', 'cid', '271430234803', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('85', '1430234908', '0', '111427723099', 'cid', '311430234892', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('86', '1430234909', '0', '111427723099', 'cid', '311430234864', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('87', '1430234911', '0', '111427723099', 'cid', '271430234803', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('88', '1430235010', '0', '131427770385', 'cid', '301430234960', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('89', '1430235011', '0', '131427770385', 'cid', '301430234922', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('90', '1430235011', '0', '131427770385', 'cid', '311430234864', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('91', '1430235012', '0', '131427770385', 'cid', '311430234892', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('92', '1430235214', '0', '131427770385', 'cid', '271430234803', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('93', '1430235268', '0', '101427698727', 'cid', '321430234999', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('94', '1430235279', '0', '101427698727', 'cid', '301430234960', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('95', '1430235307', '0', '101427698727', 'cid', '301430234922', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('96', '1430235318', '0', '101427698727', 'cid', '311430234892', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('97', '1430235355', '0', '201427430248', 'cid', '311430234892', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('98', '1430235360', '0', '201427430248', 'cid', '301430234922', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('99', '1430235381', '0', '201427430248', 'cid', '301430234960', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('100', '1430235530', '0', '101427698727', 'cid', '311430234864', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('101', '1430235533', '0', '101427698727', 'cid', '271430234803', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('102', '1430235605', '0', '81427794933', 'cid', '321430234999', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('103', '1430235606', '0', '81427794933', 'cid', '301430234922', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('104', '1430235606', '0', '81427794933', 'cid', '311430234892', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('105', '1430235608', '0', '81427794933', 'cid', '291430235260', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('106', '1430235612', '0', '81427794933', 'cid', '301430234960', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('107', '1430235615', '0', '81427794933', 'cid', '271430234803', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('108', '1430235633', '0', '81427794933', 'cid', '291427881009', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('109', '1430235633', '0', '81427794933', 'cid', '291427880991', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('110', '1430370860', '0', '141427781015', 'cid', '291430235260', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('111', '1430371698', '0', '141427781015', 'cid', '321430234999', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('112', '1430371701', '0', '141427781015', 'cid', '301430234922', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('113', '1430371702', '0', '141427781015', 'cid', '311430234892', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('114', '1430372124', '0', '161429287781', 'cid', '331430372046', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('115', '1430372125', '0', '161429287781', 'cid', '331430371975', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('116', '1430372125', '0', '161429287781', 'cid', '331430371916', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('117', '1430372130', '0', '161429287781', 'cid', '331430371778', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('118', '1430372130', '0', '161429287781', 'cid', '331430371734', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('119', '1430372131', '0', '161429287781', 'cid', '331430371850', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('120', '1430372132', '0', '161429287781', 'cid', '291430235260', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('121', '1430372133', '0', '161429287781', 'cid', '301430234960', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('122', '1430372134', '0', '161429287781', 'cid', '321430234999', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('123', '1430372137', '0', '161429287781', 'cid', '301430234922', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('124', '1430372138', '0', '161429287781', 'cid', '311430234864', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('125', '1430372139', '0', '161429287781', 'cid', '311430234892', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('126', '1430372140', '0', '161429287781', 'cid', '271430234803', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('127', '1430372178', '0', '71427784723', 'cid', '331430372046', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('128', '1430372179', '0', '71427784723', 'cid', '331430371975', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('129', '1430372180', '0', '71427784723', 'cid', '331430371916', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('130', '1430372181', '0', '71427784723', 'cid', '331430371734', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('131', '1430372183', '0', '71427784723', 'cid', '331430371778', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('132', '1430372186', '0', '71427784723', 'cid', '321430234999', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('133', '1430372386', '0', '121427768841', 'cid', '331430372046', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('134', '1430372387', '0', '121427768841', 'cid', '331430371975', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('135', '1430372388', '0', '121427768841', 'cid', '331430371916', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('136', '1430372389', '0', '121427768841', 'cid', '331430371778', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('137', '1430372389', '0', '121427768841', 'cid', '331430371734', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('138', '1430372391', '0', '121427768841', 'cid', '331430371850', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('139', '1430372393', '0', '121427768841', 'cid', '321430234999', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('140', '1430372394', '0', '121427768841', 'cid', '301430234960', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('141', '1430372394', '0', '121427768841', 'cid', '291430235260', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('142', '1430372401', '0', '121427768841', 'cid', '341430372364', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('143', '1430372402', '0', '121427768841', 'cid', '341430372274', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('144', '1430372425', '0', '111427723099', 'cid', '341430372364', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('145', '1430372425', '0', '111427723099', 'cid', '331430372046', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('146', '1430372427', '0', '111427723099', 'cid', '331430371975', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('147', '1430372429', '0', '111427723099', 'cid', '331430371916', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('148', '1430372433', '0', '111427723099', 'cid', '331430371734', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('149', '1430372451', '0', '131427770385', 'cid', '331430371916', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('150', '1430372454', '0', '131427770385', 'cid', '331430371975', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('151', '1430372455', '0', '131427770385', 'cid', '331430371734', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('152', '1430372458', '0', '131427770385', 'cid', '331430371778', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('153', '1430372502', '0', '101427698727', 'cid', '331430371916', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('154', '1430372513', '0', '201427430248', 'cid', '331430371916', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('155', '1430372528', '0', '201427430248', 'cid', '331430371975', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('156', '1430386561', '0', '201427430248', 'cid', '341430372274', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('157', '1430386564', '0', '201427430248', 'cid', '341430372364', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('158', '1430386573', '0', '201427430248', 'cid', '331430372046', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('159', '1430910615', '0', '101427698727', 'cid', '271430890513', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('160', '1430913562', '0', '101427698727', 'cid', '341430372364', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('161', '1430913564', '0', '101427698727', 'cid', '341430372274', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('162', '1430913566', '0', '101427698727', 'cid', '331430372046', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('163', '1430913568', '0', '101427698727', 'cid', '331430371975', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('164', '1430913571', '0', '101427698727', 'cid', '331430371850', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('165', '1431493971', '0', '201427430248', 'cid', '321430984741', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('166', '1431924588', '0', '171431924543', 'cid', '271431495591', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('167', '1431924592', '0', '171431924543', 'cid', '271431495555', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('168', '1431924600', '0', '171431924543', 'cid', '271431495375', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('169', '1431924671', '0', '171431924543', 'cid', '311430234864', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('170', '1431924699', '0', '171431924543', 'cid', '271431495209', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('171', '1431924716', '0', '171431924543', 'cid', '271431494759', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('172', '1431924733', '0', '171431924543', 'cid', '271431494335', '0', '0');
INSERT INTO `ux73_logs_purchase` VALUES ('173', '1432172608', '0', '201427430248', 'cid', '291432019724', '0', '0');
