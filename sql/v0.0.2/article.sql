ALTER TABLE `article` ADD
  CONSTRAINT FOREIGN KEY (`blog_id`)
    REFERENCES `blog` (`blog_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
;
ALTER TABLE `article` ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
