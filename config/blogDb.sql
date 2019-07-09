DROP DATABASE IF EXISTS blog ;

-- -----------------------------------------------------
-- Schema blog
-- -----------------------------------------------------
CREATE DATABASE blog CHARACTER SET utf8 ;
USE blog ;

-- -----------------------------------------------------
-- Table articles
-- -----------------------------------------------------

CREATE TABLE articles
(
            id            INT             UNSIGNED   PRIMARY KEY  AUTO_INCREMENT,
            imageLink     VARCHAR(70)     NOT NULL,
            title         VARCHAR(100)    NOT NULL,
            subtitle      VARCHAR(100)    NOT NULL,
            content       TEXT            NOT NULL,
            author        VARCHAR(50)     NOT NULL,
            dte           DATETIME        NOT NULL
)


    ENGINE = InnoDB
    CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table user
-- -----------------------------------------------------
CREATE TABLE user (

            id            MEDIUMINT(9)        UNSIGNED  PRIMARY KEY     AUTO_INCREMENT,
            name          VARCHAR(70)         NOT NULL,
            surname       VARCHAR(70)         NOT NULL,
            nickname      VARCHAR(70)         NOT NULL,
            email         VARCHAR(100)        NOT NULL,
            password      VARCHAR(50)         NOT NULL,

          UNIQUE INDEX `email_UNIQUE` (`email` ASC),
          UNIQUE INDEX `password_UNIQUE` (`password` ASC))



    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table comments
-- -----------------------------------------------------

CREATE TABLE comments
(
            id          MEDIUMINT        UNSIGNED     PRIMARY KEY       AUTO_INCREMENT,
            author      VARCHAR(50)      NOT NULL,
            comment     TEXT             NOT NULL,
            dte         DATETIME         NOT NULL,
            articles_id INT              UNSIGNED,
            user_id     MEDIUMINT        UNSIGNED,

    INDEX `fk_comments_articles_idx` (`articles_id` ASC),
    INDEX `fk_comments_user1_idx` (`user_id` ASC),
    CONSTRAINT `fk_comments_articles`
    FOREIGN KEY (`articles_id`)
    REFERENCES articles (`id`),
    CONSTRAINT `fk_comments_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES user (`id`)
)


    ENGINE = InnoDB
    CHARACTER SET = utf8;


-- Data for table articles
-- -----------------------------------------------------
START TRANSACTION;
USE blog;
INSERT INTO articles (id, imageLink, title, subtitle, content, author, dte) VALUES (1,'../public/src/images/php.jpg','PHP', 'PHP', 'php est super cool', 'kiki', DEFAULT);
INSERT INTO articles (id, imageLink, title, subtitle, content, author, dte) VALUES (2,'../public/src/images/php.jpg','Mysql', 'mysql', 'ceci sera un article sur Mysql', 'koukou', DEFAULT);
INSERT INTO articles (id, imageLink, title, subtitle, content, author, dte) VALUES (3,'../public/src/images/php.jpg','Symfony', 'Framework', 'Soyez un super musicien avec composer et Symfony !', 'Tom', DEFAULT);
COMMIT;
