ALTER TABLE `blog` ADD COLUMN `deleted_datetime` datetime DEFAULT NULL AFTER `created`;
ALTER TABLE `blog` ADD COLUMN `deleted_user_id` int(10) DEFAULT NULL AFTER `deleted_datetime`;
ALTER TABLE `blog` ADD COLUMN `deleted_reason` varchar(255) DEFAULT NULL AFTER `deleted_user_id`;
