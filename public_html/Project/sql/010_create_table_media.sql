CREATE TABLE IF NOT EXISTS `Media`(
    `id`         int auto_increment not null,
    `title` VARCHAR(50),
    `details_id` INT,
    `type_id` INT,
    `list_id` INT,
    `genre_id` INT,
    `created`    timestamp default current_timestamp,
    `modified`   timestamp default current_timestamp on update current_timestamp,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`details_id`) REFERENCES Media_Details(`id`),
    FOREIGN KEY (`type_id`) REFERENCES Media_Type(`id`),
    FOREIGN KEY (`list_id`) REFERENCES Media_List(`id`),
    FOREIGN KEY (`genre_id`) REFERENCES Media_Genre(`id`)
)
