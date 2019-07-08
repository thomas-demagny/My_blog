DROP SCHEMA IF EXISTS `blog` ;

-- -----------------------------------------------------
-- Schema blog
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8 ;
USE `blog` ;

-- -----------------------------------------------------
-- Table `blog`.`articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`articles` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) NOT NULL,
  `lead` VARCHAR(100) NOT NULL,
  `content` TEXT NOT NULL,
  `author` VARCHAR(50) NOT NULL,
  `dte` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `blog`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`user` (
  `id` MEDIUMINT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NOT NULL,
  `surname` VARCHAR(70) NOT NULL,
  `nickname` VARCHAR(70) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `password_UNIQUE` (`password` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `blog`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`comments` (
  `id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `author` VARCHAR(50) NOT NULL,
  `comment` TEXT NOT NULL,
  `dte` DATETIME NOT NULL,
  `articles_id` INT(11) UNSIGNED NOT NULL,
  `user_id` MEDIUMINT(9) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comments_articles_idx` (`articles_id` ASC),
  INDEX `fk_comments_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_comments_articles`
    FOREIGN KEY (`articles_id`)
    REFERENCES `blog`.`articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `blog`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- Data for table `blog`.`articles`
-- -----------------------------------------------------
START TRANSACTION;
USE `blog`;
INSERT INTO `blog`.`articles` (`id`, `title`, `lead`, `content`, `author`, `dte`) VALUES (1, 'PHP', 'PHP', 'php c\'est super cool', 'kiki', DEFAULT);
INSERT INTO `blog`.`articles` (`id`, `title`, `lead`, `content`, `author`, `dte`) VALUES (2, 'Mysql', 'mysql', 'blblblblblbblblblbl', 'koukou', DEFAULT);

COMMIT;
