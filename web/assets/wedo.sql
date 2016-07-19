/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : 127.0.0.1:3306
Source Database       : wedo

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-07-19 13:44:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wd_account
-- ----------------------------
DROP TABLE IF EXISTS `wd_account`;
CREATE TABLE `wd_account` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wd_account
-- ----------------------------

-- ----------------------------
-- Table structure for wd_graphic_reply
-- ----------------------------
DROP TABLE IF EXISTS `wd_graphic_reply`;
CREATE TABLE `wd_graphic_reply` (
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
-- Records of wd_graphic_reply
-- ----------------------------

-- ----------------------------
-- Table structure for wd_menu
-- ----------------------------
DROP TABLE IF EXISTS `wd_menu`;
CREATE TABLE `wd_menu` (
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
-- Records of wd_menu
-- ----------------------------

-- ----------------------------
-- Table structure for wd_reply
-- ----------------------------
DROP TABLE IF EXISTS `wd_reply`;
CREATE TABLE `wd_reply` (
  `reid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `rename` varchar(50) DEFAULT NULL,
  `rekeyword` varchar(50) DEFAULT NULL,
  `retype` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`reid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wd_reply
-- ----------------------------

-- ----------------------------
-- Table structure for wd_text_reply
-- ----------------------------
DROP TABLE IF EXISTS `wd_text_reply`;
CREATE TABLE `wd_text_reply` (
  `trid` int(11) NOT NULL AUTO_INCREMENT,
  `reid` int(11) DEFAULT NULL,
  `trcontent` varchar(255) NOT NULL,
  PRIMARY KEY (`trid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wd_text_reply
-- ----------------------------

-- ----------------------------
-- Table structure for wd_user
-- ----------------------------
DROP TABLE IF EXISTS `wd_user`;
CREATE TABLE `wd_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `upwd` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wd_user
-- ----------------------------
