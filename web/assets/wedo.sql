/*
Navicat MySQL Data Transfer

Source Server         : 陈学卫
Source Server Version : 50540
Source Host           : 192.168.1.142:3306
Source Database       : wedoaaa

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-07-21 18:53:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `aname` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `appid` varchar(50) NOT NULL,
  `appsecret` varchar(50) NOT NULL,
  `atoken` varchar(50) DEFAULT NULL,
  `atok` varchar(255) DEFAULT NULL,
  `aurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`aid`),
  KEY `FK_Relationship_4` (`uid`),
  KEY `FK_Relationship_5` (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of account
-- ----------------------------
INSERT INTO `account` VALUES ('1', null, '1', '大超', '阿达', 'wx4ba75e6b561a4c30', 'ba448d430d3ab2344b6281f791bbfe38', 'la182a16e66268d7ce85fcfe945df787', 'gc5RY', ' http://www.chao2.com/php9shizhan/WeDo/weixin.php?str=gc5RY');

-- ----------------------------
-- Table structure for graphic
-- ----------------------------
DROP TABLE IF EXISTS `graphic`;
CREATE TABLE `graphic` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_title` char(15) DEFAULT NULL,
  `s_img` varchar(50) DEFAULT NULL,
  `s_url` varchar(35) DEFAULT NULL,
  `s_guan` varchar(50) DEFAULT NULL,
  `s_desc` varchar(60) DEFAULT NULL,
  `a_id` int(6) DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of graphic
-- ----------------------------

-- ----------------------------
-- Table structure for graphic_reply
-- ----------------------------
DROP TABLE IF EXISTS `graphic_reply`;
CREATE TABLE `graphic_reply` (
  `grid` int(11) NOT NULL AUTO_INCREMENT,
  `reid` int(11) DEFAULT NULL,
  `grtitle` varchar(50) NOT NULL,
  `grauthor` varchar(20) NOT NULL,
  `grcover` varchar(255) NOT NULL,
  `grinfo` varchar(255) NOT NULL,
  `grsource` varchar(100) NOT NULL,
  PRIMARY KEY (`grid`),
  KEY `FK_Relationship_3` (`reid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of graphic_reply
-- ----------------------------

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `son_type` varchar(1) DEFAULT NULL,
  `menu_name` varchar(50) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `menu_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`mid`),
  KEY `FK_Relationship_6` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------

-- ----------------------------
-- Table structure for reply
-- ----------------------------
DROP TABLE IF EXISTS `reply`;
CREATE TABLE `reply` (
  `reid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `rename` varchar(50) DEFAULT NULL,
  `rekeyword` varchar(50) DEFAULT NULL,
  `retype` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`reid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reply
-- ----------------------------

-- ----------------------------
-- Table structure for text_reply
-- ----------------------------
DROP TABLE IF EXISTS `text_reply`;
CREATE TABLE `text_reply` (
  `trid` int(11) NOT NULL AUTO_INCREMENT,
  `reid` int(11) DEFAULT NULL,
  `trcontent` varchar(255) NOT NULL,
  PRIMARY KEY (`trid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of text_reply
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `upwd` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3');
