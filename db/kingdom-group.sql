drop database if exists `kingdom-group`;
create database if not exists `kingdom-group`;

use `kingdom-group`;

create table if not exists `images`(
 `id` INT(10) NOT NULL,
 `image` LONGBLOB NOT NULL,
 `type` VARCHAR(100) NOT NULL,
 `created` DATETIME NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table if not exists `roles`(
	`id` INT(10) NOT NULL AUTO_INCREMENT,
    `role` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table if not exists `users`(
	`id` INT(10) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `user` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `role_id` INT(10) NOT NULL,
    `img_id` INT(10),
    PRIMARY KEY (`id`),
    INDEX (`img_id`),
    FOREIGN KEY (`img_id`) REFERENCES images(`id`),
    INDEX (`role_id`),
    FOREIGN KEY (`role_id`) REFERENCES roles(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `roles` (`id`, `role`) VALUES ('1', 'admin');
INSERT INTO `roles` (`id`, `role`) VALUES ('2', 'cliente');

INSERT INTO `users` VALUES (null, 'admin', 'root', 'P45swoRd#123', 'example@example.com', 1, null);


