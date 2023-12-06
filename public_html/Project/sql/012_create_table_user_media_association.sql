CREATE TABLE IF NOT EXISTS `User_Media_Association`(
    `id`         int auto_increment not null,
    `user_id` INT,
    `media_id` INT,
    `class_id` INT,
    `created`    timestamp default current_timestamp,
    `modified`   timestamp default current_timestamp on update current_timestamp,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES Users(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`media_id`) REFERENCES Media(`id`),
    FOREIGN KEY (`class_id`) REFERENCES Media_Classification(`id`)
)
