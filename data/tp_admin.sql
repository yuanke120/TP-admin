/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : bolong_mplus

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 28/07/2020 13:48:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bl_admin
-- ----------------------------
DROP TABLE IF EXISTS `bl_admin`;
CREATE TABLE `bl_admin`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `account` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '帐号',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `state` tinyint(1) NOT NULL COMMENT '状态：0-禁用  1-启用',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '最近修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bl_admin
-- ----------------------------
INSERT INTO `bl_admin` VALUES (1, '000000000000000', 'yuanke', '1ac6e3c521bf59bfa780d42407ab097b', 1, '2020-03-07 15:42:46', '2020-03-07 15:42:46');

-- ----------------------------
-- Table structure for bl_admin_profile
-- ----------------------------
DROP TABLE IF EXISTS `bl_admin_profile`;
CREATE TABLE `bl_admin_profile`  (
  `uid` int(11) UNSIGNED NOT NULL COMMENT '用户id',
  `avatar` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '头像',
  `nickname` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '昵称',
  `email` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '最近修改时间'
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bl_admin_profile
-- ----------------------------
INSERT INTO `bl_admin_profile` VALUES (1, '/upload/avatar/yuanke_6305f1fb24230f28.png', 'Yuanke', '936519785@qq.com', '2020-03-07 15:42:46', '2020-03-07 15:42:46');

-- ----------------------------
-- Table structure for bl_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `bl_auth_group`;
CREATE TABLE `bl_auth_group`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户组名称',
  `rules` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id， 多个规则\",\"隔开',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态：1-正常  0-禁用',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '最近修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bl_auth_group
-- ----------------------------
INSERT INTO `bl_auth_group` VALUES (1, '超级管理员', '1,2,3,4,5,6,7,8,9,10', 1, '2020-03-07 15:42:46', '2020-03-07 15:42:46');

-- ----------------------------
-- Table structure for bl_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `bl_auth_group_access`;
CREATE TABLE `bl_auth_group_access`  (
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) UNSIGNED NOT NULL COMMENT '用户组id',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '最近修改时间',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of bl_auth_group_access
-- ----------------------------
INSERT INTO `bl_auth_group_access` VALUES (1, 1, '2020-03-07 15:42:46', '2020-03-07 15:42:46');

-- ----------------------------
-- Table structure for bl_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `bl_auth_rule`;
CREATE TABLE `bl_auth_rule`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `type` tinyint(1) NOT NULL DEFAULT 1,
  `relation` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '规则附件条件,满足附加条件的规则,才认为是有效的规则',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态：1-正常  0-禁用',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '最近修改时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bl_auth_rule
-- ----------------------------
INSERT INTO `bl_auth_rule` VALUES (1, 'Admin-Add', '添加用户', 1, '', 1, '2020-03-07 15:42:46', '2020-03-07 15:42:46');
INSERT INTO `bl_auth_rule` VALUES (2, 'Admin-Edit', '编辑用户', 1, '', 1, '2020-03-07 15:42:46', '2020-03-07 15:42:46');
INSERT INTO `bl_auth_rule` VALUES (3, 'Admin-Delete', '删除用户', 1, '', 1, '2020-03-07 15:42:46', '2020-03-07 15:42:46');
INSERT INTO `bl_auth_rule` VALUES (4, 'Admin-UpdatePassword', '更改用户密码', 1, '', 1, '2020-03-07 15:42:46', '2020-03-07 15:42:46');
INSERT INTO `bl_auth_rule` VALUES (5, 'AuthGroup-Add', '添加角色', 1, '', 1, '2020-03-07 15:42:46', '2020-03-07 15:42:46');
INSERT INTO `bl_auth_rule` VALUES (6, 'AuthGroup-Edit', '编辑角色', 1, '', 1, '2020-03-07 15:42:46', '2020-03-07 15:42:46');
INSERT INTO `bl_auth_rule` VALUES (7, 'AuthGroup-Delete', '删除角色', 1, '', 1, '2020-03-07 15:42:46', '2020-03-07 15:42:46');
INSERT INTO `bl_auth_rule` VALUES (8, 'AuthRule-Add', '添加权限节点', 1, '', 1, '2020-03-07 15:42:46', '2020-03-07 15:42:46');
INSERT INTO `bl_auth_rule` VALUES (9, 'AuthRule-Edit', '编辑权限节点', 1, '', 1, '2020-03-07 15:42:46', '2020-03-07 15:42:46');
INSERT INTO `bl_auth_rule` VALUES (10, 'AuthRule-Delete', '删除权限节点', 1, '', 1, '2020-03-07 15:42:46', '2020-03-07 15:42:46');

SET FOREIGN_KEY_CHECKS = 1;
