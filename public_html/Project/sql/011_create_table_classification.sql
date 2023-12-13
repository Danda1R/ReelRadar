CREATE TABLE IF NOT EXISTS `Media_Classification`(
    `id`        int auto_increment not null,
    `isFavorite`    INT,
    `isWatched` INT,
    `numOfStars` INT,
    `isReviewed` INT,
    `review` LONGTEXT,
    `created`    timestamp default current_timestamp,
    `modified`   timestamp default current_timestamp on update current_timestamp,
    PRIMARY KEY (`id`)
)
