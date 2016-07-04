
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- animals
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `animals`;

CREATE TABLE `animals`
(
    `animal` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    `birthDay` DATE NOT NULL,
    `sex` INTEGER NOT NULL,
    `furColour` INTEGER DEFAULT 2 NOT NULL,
    `eyeColour` INTEGER NOT NULL,
    `species` INTEGER NOT NULL,
    `size` int(10) unsigned NOT NULL,
    `specification` VARCHAR(255) NOT NULL,
    `race` INTEGER NOT NULL,
    `test` INTEGER,
    `blah` DATE,
    PRIMARY KEY (`animal`),
    UNIQUE INDEX `animal` (`animal`),
    INDEX `fk_sex` (`sex`),
    CONSTRAINT `sex`
        FOREIGN KEY (`sex`)
        REFERENCES `sexes` (`sex`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- colours
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `colours`;

CREATE TABLE `colours`
(
    `colour` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`colour`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- notificationType
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `notificationType`;

CREATE TABLE `notificationType`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(25) NOT NULL,
    `description` VARCHAR(256) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- notifications
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `latitude` DOUBLE NOT NULL,
    `notificationType` int(10) unsigned NOT NULL,
    `creationDate` DATE NOT NULL,
    `description` VARCHAR(2048) NOT NULL,
    `animal` INTEGER NOT NULL,
    `longitude` DOUBLE NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- races
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `races`;

CREATE TABLE `races`
(
    `race` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(15) NOT NULL,
    `name` VARCHAR(25) NOT NULL,
    PRIMARY KEY (`race`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- registrations
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `registrations`;

CREATE TABLE `registrations`
(
    `registration` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user` int(10) unsigned NOT NULL,
    `code` VARCHAR(32) NOT NULL,
    PRIMARY KEY (`registration`),
    UNIQUE INDEX `user` (`user`),
    UNIQUE INDEX `code` (`code`),
    CONSTRAINT `fk_users_user`
        FOREIGN KEY (`user`)
        REFERENCES `users` (`user`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- sexes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sexes`;

CREATE TABLE `sexes`
(
    `sex` INTEGER NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(10) NOT NULL,
    `description` VARCHAR(25) NOT NULL,
    PRIMARY KEY (`sex`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- sizes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sizes`;

CREATE TABLE `sizes`
(
    `size` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(25) NOT NULL,
    PRIMARY KEY (`size`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- species
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `species`;

CREATE TABLE `species`
(
    `species` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(25) NOT NULL,
    `description` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`species`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- testt
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `testt`;

CREATE TABLE `testt`
(
    `f` DATE NOT NULL,
    PRIMARY KEY (`f`),
    UNIQUE INDEX `f_2` (`f`),
    UNIQUE INDEX `f_4` (`f`),
    INDEX `f` (`f`),
    INDEX `f_3` (`f`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `user` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `active` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`user`),
    UNIQUE INDEX `email` (`email`),
    UNIQUE INDEX `name` (`name`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
