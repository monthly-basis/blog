CREATE TABLE `article` (
    `article_id` int(10) unsigned not null auto_increment,
    `blog_id` int(10) unsigned not null,
    `user_id` int(10) not null,
    `title` varchar(255) not null,
    `body` text not null,
    `views` int unsigned not null default 0,
    `created` datetime not null,
    `deleted` datetime default null,
    PRIMARY KEY (`article_id`),
    INDEX `blog_id_deleted_created` (`blog_id`, `deleted`, `created`)
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
