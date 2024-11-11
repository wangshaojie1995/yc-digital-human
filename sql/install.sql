/*
 Navicat Premium Data Transfer

 Source Server         : 下次一定
 Source Server Type    : MySQL
 Source Server Version : 80024 (8.0.24)
 Source Host           : localhost:3306
 Source Schema         : aiszr

 Target Server Type    : MySQL
 Target Server Version : 80024 (8.0.24)
 File Encoding         : 65001

 Date: 08/11/2024 19:45:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0; 

-- ----------------------------
-- Table structure for yc_dh_cdkey
-- ----------------------------
DROP TABLE IF EXISTS `la_dh_cdkey`;
CREATE TABLE `la_dh_cdkey`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `used_status` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `points` int NULL DEFAULT 0,
  `create_time` int NULL DEFAULT NULL,
  `update_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '卡密' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for yc_dh_order
-- ----------------------------
DROP TABLE IF EXISTS `la_dh_order`;
CREATE TABLE `la_dh_order`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `wechat_order_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `package_id` int NULL DEFAULT NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  `uid` int NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `pay_type` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'applet',
  `pay_time` datetime NULL DEFAULT NULL,
  `create_time` int NULL DEFAULT NULL,
  `update_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yc_dh_package
-- ----------------------------
DROP TABLE IF EXISTS `la_dh_package`;
CREATE TABLE `la_dh_package`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '套餐名称',
  `desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '简介',
  `price` decimal(10, 2) NULL DEFAULT NULL COMMENT '套餐价格',
  `points` int NULL DEFAULT NULL COMMENT '套餐点数',
  `sort` int NULL DEFAULT 0 COMMENT '排序（升序）',
  `create_time` int NULL DEFAULT NULL,
  `update_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '套餐' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yc_dh_scene
-- ----------------------------
DROP TABLE IF EXISTS `la_dh_scene`;
CREATE TABLE `la_dh_scene`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cover_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `local_video_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `api_video_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `scene_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `task_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `uid` int NULL DEFAULT 0,
  `type` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'yiding',
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `massage` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `robotid` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_time` int NULL DEFAULT NULL,
  `update_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '场景' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yc_dh_video
-- ----------------------------
DROP TABLE IF EXISTS `la_dh_video`;
CREATE TABLE `la_dh_video`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `task_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `uid` int NULL DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '文本',
  `cover_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `api_video_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `local_video_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `local_voice_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `voice_task_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `scene_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `line_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `duration` decimal(10, 2) NULL DEFAULT NULL,
  `create_time` int NULL DEFAULT NULL,
  `update_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yc_dh_voice
-- ----------------------------
DROP TABLE IF EXISTS `la_dh_voice`;
CREATE TABLE `la_dh_voice`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `task_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `local_voice_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `uid` int NULL DEFAULT NULL,
  `duration` int NULL DEFAULT 0,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `voice_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_time` int NULL DEFAULT NULL,
  `update_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '声音' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yc_dh_voice_text
-- ----------------------------
DROP TABLE IF EXISTS `la_dh_voice_text`;
CREATE TABLE `la_dh_voice_text`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `content` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sort` int NULL DEFAULT 0,
  `create_time` int NULL DEFAULT NULL,
  `update_time` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;


ALTER TABLE `la_user` ADD COLUMN `points` int NULL DEFAULT 0 AFTER `total_recharge_amount`;

INSERT INTO `la_system_menu` VALUES (179, 28, 'C', '创作配置', 'el-icon-Ship', 0, 'setting.digitalhuman.create/getConfig', 'create', 'setting/digitalhuman/create', '', '', 1, 1, 0, 1730344135, 1730789390);
INSERT INTO `la_system_menu` VALUES (184, 119, 'A', '点数调整', '', 0, 'user.user/adjustPoints', '', '', '', '', 1, 1, 0, 1730450572, 1730450572);
INSERT INTO `la_system_menu` VALUES (185, 28, 'C', '创作协议', 'el-icon-Memo', 0, 'setting.digitalhuman.agreement/get', 'createAgreement', 'setting/digitalhuman/protocol', '', '', 1, 1, 0, 1730789411, 1730789680);
INSERT INTO `la_system_menu` VALUES (186, 179, 'A', '保存', '', 0, 'setting.digitalhuman.create/setConfig', '', '', '', '', 1, 1, 0, 1730789554, 1730789554);
INSERT INTO `la_system_menu` VALUES (187, 185, 'A', '保存', '', 0, 'setting.digitalhuman.agreement/set', '', '', '', '', 1, 1, 0, 1730789575, 1730789575);
INSERT INTO `la_system_menu` VALUES (188, 213, 'C', '卡密管理', 'el-icon-Key', 1, 'digitalhuman.dh_cdkey/lists', 'dh_cdkey', 'dh_cdkey/index', '', '', 0, 1, 0, 1730862002, 1730949054);
INSERT INTO `la_system_menu` VALUES (189, 188, 'A', '添加', '', 1, 'digitalhuman.dh_cdkey/add', '', '', '', '', 0, 1, 0, 1730862002, 1730862002);
INSERT INTO `la_system_menu` VALUES (190, 188, 'A', '编辑', '', 1, 'digitalhuman.dh_cdkey/edit', '', '', '', '', 0, 1, 0, 1730862002, 1730862002);
INSERT INTO `la_system_menu` VALUES (191, 188, 'A', '删除', '', 1, 'digitalhuman.dh_cdkey/delete', '', '', '', '', 0, 1, 0, 1730862002, 1730862002);
INSERT INTO `la_system_menu` VALUES (192, 0, 'M', '创作管理', 'el-icon-Orange', 0, '', 'createAll', '', '', '', 1, 1, 0, 1730863328, 1730863351);
INSERT INTO `la_system_menu` VALUES (197, 192, 'C', '场景管理', '', 1, 'digitalhuman.dh_scene/lists', 'dh_scene', 'dh_scene/index', '', '', 0, 1, 0, 1730864001, 1730864083);
INSERT INTO `la_system_menu` VALUES (198, 197, 'A', '添加', '', 1, 'digitalhuman.dh_scene/add', '', '', '', '', 0, 1, 0, 1730864001, 1730864001);
INSERT INTO `la_system_menu` VALUES (199, 197, 'A', '编辑', '', 1, 'digitalhuman.dh_scene/edit', '', '', '', '', 0, 1, 0, 1730864001, 1730864001);
INSERT INTO `la_system_menu` VALUES (200, 197, 'A', '删除', '', 1, 'digitalhuman.dh_scene/delete', '', '', '', '', 0, 1, 0, 1730864001, 1730864001);
INSERT INTO `la_system_menu` VALUES (201, 192, 'C', '音频管理', '', 1, 'digitalhuman.dh_voice/lists', 'dh_voice', 'dh_voice/index', '', '', 0, 1, 0, 1730873648, 1730873648);
INSERT INTO `la_system_menu` VALUES (202, 201, 'A', '添加', '', 1, 'digitalhuman.dh_voice/add', '', '', '', '', 0, 1, 0, 1730873648, 1730873648);
INSERT INTO `la_system_menu` VALUES (203, 201, 'A', '编辑', '', 1, 'digitalhuman.dh_voice/edit', '', '', '', '', 0, 1, 0, 1730873648, 1730873648);
INSERT INTO `la_system_menu` VALUES (204, 201, 'A', '删除', '', 1, 'digitalhuman.dh_voice/delete', '', '', '', '', 0, 1, 0, 1730873648, 1730873648);
INSERT INTO `la_system_menu` VALUES (205, 192, 'C', '创作记录', '', 1, 'digitalhuman.dh_video/lists', 'dh_video', 'dh_video/index', '', '', 0, 1, 0, 1730874532, 1730874532);
INSERT INTO `la_system_menu` VALUES (206, 205, 'A', '添加', '', 1, 'digitalhuman.dh_video/add', '', '', '', '', 0, 1, 0, 1730874532, 1730874532);
INSERT INTO `la_system_menu` VALUES (207, 205, 'A', '编辑', '', 1, 'digitalhuman.dh_video/edit', '', '', '', '', 0, 1, 0, 1730874532, 1730874532);
INSERT INTO `la_system_menu` VALUES (208, 205, 'A', '删除', '', 1, 'digitalhuman.dh_video/delete', '', '', '', '', 0, 1, 0, 1730874532, 1730874532);
INSERT INTO `la_system_menu` VALUES (209, 213, 'C', '套餐管理', 'el-icon-List', 1, 'digitalhuman.dh_package/lists', 'dh_package', 'dh_package/index', '', '', 0, 1, 0, 1730948879, 1730949045);
INSERT INTO `la_system_menu` VALUES (210, 209, 'A', '添加', '', 1, 'digitalhuman.dh_package/add', '', '', '', '', 0, 1, 0, 1730948879, 1730948879);
INSERT INTO `la_system_menu` VALUES (211, 209, 'A', '编辑', '', 1, 'digitalhuman.dh_package/edit', '', '', '', '', 0, 1, 0, 1730948879, 1730948879);
INSERT INTO `la_system_menu` VALUES (212, 209, 'A', '删除', '', 1, 'digitalhuman.dh_package/delete', '', '', '', '', 0, 1, 0, 1730948879, 1730948879);
INSERT INTO `la_system_menu` VALUES (213, 0, 'M', '服务管理', 'el-icon-Grid', 0, '', 'service', '', '', '', 1, 1, 0, 1730949035, 1730949035);
INSERT INTO `la_system_menu` VALUES (214, 192, 'C', '训练文本', '', 1, 'digitalhuman.dh_voice_text/lists', 'dh_voice_text', 'dh_voice_text/index', '', '', 0, 1, 0, 1730961975, 1730961975);
INSERT INTO `la_system_menu` VALUES (215, 214, 'A', '添加', '', 1, 'digitalhuman.dh_voice_text/add', '', '', '', '', 0, 1, 0, 1730961975, 1730961975);
INSERT INTO `la_system_menu` VALUES (216, 214, 'A', '编辑', '', 1, 'digitalhuman.dh_voice_text/edit', '', '', '', '', 0, 1, 0, 1730961975, 1730961975);
INSERT INTO `la_system_menu` VALUES (217, 214, 'A', '删除', '', 1, 'digitalhuman.dh_voice_text/delete', '', '', '', '', 0, 1, 0, 1730961975, 1730961975);
INSERT INTO `la_system_menu` VALUES (222, 213, 'C', '订单管理', 'el-icon-GoodsFilled', 1, 'digitalhuman.dh_order/lists', 'dh_order', 'dh_order/index', '', '', 0, 1, 0, 1730962719, 1730962953);
INSERT INTO `la_system_menu` VALUES (223, 222, 'A', '添加', '', 1, 'digitalhuman.dh_order/add', '', '', '', '', 0, 1, 0, 1730962719, 1730962719);
INSERT INTO `la_system_menu` VALUES (224, 222, 'A', '编辑', '', 1, 'digitalhuman.dh_order/edit', '', '', '', '', 0, 1, 0, 1730962719, 1730962719);
INSERT INTO `la_system_menu` VALUES (225, 222, 'A', '删除', '', 1, 'digitalhuman.dh_order/delete', '', '', '', '', 0, 1, 0, 1730962719, 1730962719);

SET FOREIGN_KEY_CHECKS = 1;



