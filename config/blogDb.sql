DROP SCHEMA IF EXISTS blog ;

-- -----------------------------------------------------
-- Schema blog
-- -----------------------------------------------------
CREATE SCHEMA blog DEFAULT CHARACTER SET utf8 ;
USE blog ;

-- -----------------------------------------------------
-- Table articles
-- -----------------------------------------------------
CREATE TABLE articles (
                          `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                          `imageLink` VARCHAR(70) NOT NULL,
                          `title` VARCHAR(100) NOT NULL,
                          `lead` VARCHAR(100) NOT NULL,
                          `content` TEXT NOT NULL,
                          `author` VARCHAR(50) NOT NULL,
                          `dte` DATETIME NOT NULL,
                          PRIMARY KEY (`id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table user
-- -----------------------------------------------------
CREATE TABLE user (
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
-- Table comments
-- -----------------------------------------------------
CREATE TABLE comments (
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
                                  REFERENCES articles(`id`)
                                  ON DELETE NO ACTION
                                  ON UPDATE NO ACTION,
                          CONSTRAINT `fk_comments_user1`
                              FOREIGN KEY (`user_id`)
                                  REFERENCES user(`id`)
                                  ON DELETE NO ACTION
                                  ON UPDATE NO ACTION)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- Data for table articles
-- -----------------------------------------------------
START TRANSACTION;
USE blog;
INSERT INTO articles (`id`,`imageLink`,`title`, `lead`, `content`, `author`, `dte`) VALUES (1,'../public/src/images/php.jpg','PHP', 'PHP', 'php c\'est super cool', 'kiki', DEFAULT);
INSERT INTO articles (`id`, `title`, `lead`, `content`, `author`, `dte`) VALUES (2, 'Mysql', 'mysql', 'blblblblblbblblblbl', 'koukou', DEFAULT);
INSERT INTO articles (`id`,`imageLink`,`title`, `lead`, `content`, `author`, `dte`) VALUES (3,'../public/src/images/php.jpg','Symfony', 'Framework', 'Soyez un super musicien avec composer et Symfony !', 'Tom', DEFAULT);
COMMIT;
