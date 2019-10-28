-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 28 oct. 2019 à 12:53
-- Version du serveur :  10.1.39-MariaDB
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) UNSIGNED NOT NULL,
  `imageLink` varchar(70) NOT NULL,
  `title` varchar(100) NOT NULL,
  `chapo` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `dte` datetime NOT NULL,
  `mod_dte` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `imageLink`, `title`, `chapo`, `content`, `author`, `dte`, `mod_dte`) VALUES
(16, '', 'MySQL', 'MySQL  est un système de gestion de bases de données relationnelles (SGBDR)', 'Exsistit autem ho', 'Tom', '2019-10-25 14:39:12', '2019-10-25 14:39:12'),
(17, '', 'Symfony', 'Non non aucun rapport avec la musique ! Symfony est un Framework PHP', 'Symfony est un ensemble de composants PHP ainsi qu\'un framework MVC libre écrit en PHP. Il fournit des fonctionnalités modulables et adaptables qui permettent de faciliter et d’accélérer le développement d\'un site web. ', 'admin', '2019-10-26 10:34:14', '2019-10-26 10:34:14'),
(22, '', 'PHP', 'Bien... mais qu\'est ce que cela veut dire ? ', ' PHP (officiellement, ce sigle est un acronyme récursif pour PHP Hypertext Preprocessor) est un langage de scripts généraliste et Open Source, spécialement conçu pour le développement d\'applications web. Il peut être intégré facilement au HTML.\r\n\r\nUn exemple :\r\n\r\nExemple #1 Exemple d\'introduction\r\n<!DOCTYPE html>\r\n<html>\r\n<head>\r\n<title>Exemple</title>\r\n</head>\r\n<body>\r\n\r\n<?php\r\necho \"Bonjour, je suis un script PHP !\";\r\n?>\r\n\r\n</body>\r\n</html>\r\n\r\nAu lieu d\'utiliser des tonnes de commandes afin d\'afficher du HTML (comme en C ou en Perl), les pages PHP contiennent des fragments HTML dont du code qui fait \"quelque chose\" (dans ce cas, il va afficher \"Bonjour, je suis un script PHP !\"). Le code PHP est inclus entre une balise de début <?php et une balise de fin ?> qui permettent au serveur web de passer en mode PHP.\r\n\r\nCe qui distingue PHP des langages de script comme le Javascript, est que le code est exécuté sur le serveur, générant ainsi le HTML, qui sera ensuite envoyé au client. Le client ne reçoit que le résultat du script, sans aucun moyen d\'avoir accès au code qui a produit ce résultat. Vous pouvez configurer votre serveur web afin qu\'il analyse tous vos fichiers HTML comme des fichiers PHP. Ainsi, il n\'y a aucun moyen de distinguer les pages qui sont produites dynamiquement des pages statiques.<br>\r\n\r\nLe grand avantage de PHP est qu\'il est extrêmement simple pour les néophytes, mais offre des fonctionnalités avancées pour les experts. Ne craignez pas de lire la longue liste de fonctionnalités PHP. Vous pouvez vous plonger dans le code, et en quelques instants, écrire des scripts simples.\r\n\r\nBien que le développement de PHP soit orienté vers la programmation pour les sites web, vous pouvez en faire bien d\'autres usages. Lisez donc la section Que peut faire PHP ? ou bien le tutoriel d\'introduction si vous êtes uniquement intéressé dans la programmation web. ', 'Tom', '2019-10-26 10:27:48', '2019-10-26 10:27:48');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `author` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `dte` datetime NOT NULL,
  `statement` tinyint(1) NOT NULL,
  `articles_id` int(11) UNSIGNED NOT NULL,
  `user_id` mediumint(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `author`, `content`, `dte`, `statement`, `articles_id`, `user_id`) VALUES
(59, 'Tom', 'super article !', '2019-10-24 02:08:05', 1, 17, 17),
(65, 'Tom', 'super', '2019-10-25 14:22:08', 1, 17, 17),
(68, 'admin', 'Bravo !', '2019-10-26 10:29:18', 1, 22, 22),
(69, 'admin', 'Un peu léger comme article non ?', '2019-10-26 10:29:54', 1, 16, 22);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` mediumint(9) UNSIGNED NOT NULL,
  `firstname` varchar(70) NOT NULL,
  `surname` varchar(70) NOT NULL,
  `username` varchar(70) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` varchar(20) NOT NULL,
  `register_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `surname`, `username`, `email`, `password`, `role`, `register_date`) VALUES
(17, 'Thomas', 'DEMAGNY', 'Tom', 'demagny.t@hotmail.fr', '$2y$10$K/gYV3.SChsG.SkSzfgu8u/o/4DBgkbX7CZVrg6OXteDiz2KxhL/2', 'admin', '2019-09-18'),
(22, 'admin', 'ADMIN', 'admin', 'admin@admin.fr', '$2y$10$ydvmAEAQYgRCbgwI2dYOYenlx.YN3XJ0lLn7ALsvG.mZhCpZranmq', 'admin', '2019-10-25'),
(23, 'moi', 'MOI', 'user', 'moi@moi.fr', '$2y$10$1cTKXNk9st8YvebQpn.HdeZddhbEW4GEDmlNXB.oP3HngAWI3lZla', 'membre', '2019-10-25');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_articles_idx` (`articles_id`),
  ADD KEY `fk_comments_user1_idx` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `password_UNIQUE` (`password`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` mediumint(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_articles` FOREIGN KEY (`articles_id`) REFERENCES `articles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
