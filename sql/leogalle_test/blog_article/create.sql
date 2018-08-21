CREATE TABLE `blog_article` (
    `blog_article_id` int(10) unsigned not null auto_increment,
    `blog_id` int(10) unsigned not null,
    `user_id` int(10) not null,
    `title` varchar(255) not null,
    `body` varchar(255) not null,
    `views` int unsigned not null default 0,
    `created` datetime not null,
    PRIMARY KEY (`blog_article_id`),
    INDEX `blog_id` (`blog_id`),
) charset=utf8mb4 collation utf8mb4_unicode_ci;
