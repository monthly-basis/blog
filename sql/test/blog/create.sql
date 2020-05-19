CREATE TABLE `blog` (
    `blog_id` int(10) unsigned not null auto_increment,
    `user_id` int(10) not null,
    `name` varchar(255) not null,
    `slug` varchar(255) not null,
    `description` varchar(255) not null,
    `views` int unsigned not null default 0,
    `created` datetime not null,
    `deleted_datetime` datetime DEFAULT NULL,
    `deleted_user_id` int(10) DEFAULT NULL,
    `deleted_reason` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`blog_id`),
    INDEX `user_id` (`user_id`),
    UNIQUE `slug` (`slug`)
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
