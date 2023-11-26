CREATE TABLE IF NOT EXISTS `Media_Details`(
    `id`         int auto_increment not null,
    `api_id`    VARCHAR(15),
    `original_title` VARCHAR(50),
    `isSeries` TINYINT(1),
    `isEpisode` TINYINT(1),
    `year` TINYINT(4),
    `release_date` DATE,
    `api_image_id` VARCHAR(15) COMMENT 'Image id from the API',
    `url` VARCHAR(255),
    `caption` VARCHAR(255),
    `created`    timestamp default current_timestamp,
    `modified`   timestamp default current_timestamp on update current_timestamp,
    PRIMARY KEY (`id`),
    UNIQUE KEY(`api_id`)
)
