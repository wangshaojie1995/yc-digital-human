SET FOREIGN_KEY_CHECKS=0;

ALTER TABLE `la_dh_scene` ADD COLUMN `channel` int NULL DEFAULT 1 AFTER `uid`;

ALTER TABLE `la_dh_video` ADD COLUMN `channel` int NULL DEFAULT 1 AFTER `duration`;

ALTER TABLE `la_dh_video` ADD COLUMN `points` int NULL DEFAULT 0 AFTER `channel`;

ALTER TABLE `la_dh_voice` ADD COLUMN `status` int NULL DEFAULT 1 AFTER `voice_id`;

ALTER TABLE `la_dh_voice` ADD COLUMN `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL AFTER `status`;

ALTER TABLE `la_dh_voice` ADD COLUMN `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'yiding' AFTER `content`;

SET FOREIGN_KEY_CHECKS=1;