-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour climactions2
CREATE DATABASE IF NOT EXISTS `climactions2` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `climactions2`;

-- Listage de la structure de la table climactions2. admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.admin : ~0 rows (environ)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. author
CREATE TABLE IF NOT EXISTS `author` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.author : ~0 rows (environ)
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
/*!40000 ALTER TABLE `author` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. condition
CREATE TABLE IF NOT EXISTS `condition` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `condition` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.condition : ~0 rows (environ)
/*!40000 ALTER TABLE `condition` DISABLE KEYS */;
/*!40000 ALTER TABLE `condition` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. contact
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) NOT NULL,
  `fisrtname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `object` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.contact : ~0 rows (environ)
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. creator
CREATE TABLE IF NOT EXISTS `creator` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.creator : ~0 rows (environ)
/*!40000 ALTER TABLE `creator` DISABLE KEYS */;
/*!40000 ALTER TABLE `creator` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. editor
CREATE TABLE IF NOT EXISTS `editor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.editor : ~0 rows (environ)
/*!40000 ALTER TABLE `editor` DISABLE KEYS */;
/*!40000 ALTER TABLE `editor` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. film
CREATE TABLE IF NOT EXISTS `film` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `productor_id` int(11) unsigned NOT NULL,
  `realisator_id` int(11) unsigned NOT NULL,
  `public_id` int(11) unsigned NOT NULL,
  `ressources_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productor_id` (`productor_id`),
  KEY `FK_film_realisator` (`realisator_id`),
  KEY `FK_film_public` (`public_id`),
  KEY `FK_film_ressources` (`ressources_id`),
  CONSTRAINT `FK_film_productor` FOREIGN KEY (`productor_id`) REFERENCES `productor` (`id`),
  CONSTRAINT `FK_film_public` FOREIGN KEY (`public_id`) REFERENCES `public` (`id`),
  CONSTRAINT `FK_film_realisator` FOREIGN KEY (`realisator_id`) REFERENCES `realisator` (`id`),
  CONSTRAINT `FK_film_ressources` FOREIGN KEY (`ressources_id`) REFERENCES `ressources` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.film : ~0 rows (environ)
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
/*!40000 ALTER TABLE `film` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. flyers
CREATE TABLE IF NOT EXISTS `flyers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `format` binary(50) NOT NULL,
  `ressources_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_flyers_ressources` (`ressources_id`),
  CONSTRAINT `FK_flyers_ressources` FOREIGN KEY (`ressources_id`) REFERENCES `ressources` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.flyers : ~0 rows (environ)
/*!40000 ALTER TABLE `flyers` DISABLE KEYS */;
/*!40000 ALTER TABLE `flyers` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. games
CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `format` varchar(255) NOT NULL,
  `creator_id` int(11) unsigned NOT NULL,
  `public_id` int(11) unsigned NOT NULL,
  `ressources_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_jeux_creator` (`creator_id`),
  KEY `FK_jeux_public` (`public_id`),
  KEY `FK_jeux_ressources` (`ressources_id`),
  CONSTRAINT `FK_jeux_creator` FOREIGN KEY (`creator_id`) REFERENCES `creator` (`id`),
  CONSTRAINT `FK_jeux_public` FOREIGN KEY (`public_id`) REFERENCES `public` (`id`),
  CONSTRAINT `FK_jeux_ressources` FOREIGN KEY (`ressources_id`) REFERENCES `ressources` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.games : ~0 rows (environ)
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
/*!40000 ALTER TABLE `games` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. livre
CREATE TABLE IF NOT EXISTS `livre` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `editor_id` int(11) unsigned NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `public_id` int(11) unsigned NOT NULL,
  `ressource_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_livre_editor` (`editor_id`),
  KEY `FK_livre_author` (`author_id`),
  KEY `FK_livre_public` (`public_id`),
  KEY `FK_livre_ressources` (`ressource_id`),
  CONSTRAINT `FK_livre_author` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`),
  CONSTRAINT `FK_livre_editor` FOREIGN KEY (`editor_id`) REFERENCES `editor` (`id`),
  CONSTRAINT `FK_livre_public` FOREIGN KEY (`public_id`) REFERENCES `public` (`id`),
  CONSTRAINT `FK_livre_ressources` FOREIGN KEY (`ressource_id`) REFERENCES `ressources` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.livre : ~0 rows (environ)
/*!40000 ALTER TABLE `livre` DISABLE KEYS */;
/*!40000 ALTER TABLE `livre` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. location
CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.location : ~0 rows (environ)
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
/*!40000 ALTER TABLE `location` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. productor
CREATE TABLE IF NOT EXISTS `productor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.productor : ~0 rows (environ)
/*!40000 ALTER TABLE `productor` DISABLE KEYS */;
/*!40000 ALTER TABLE `productor` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. public
CREATE TABLE IF NOT EXISTS `public` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.public : ~0 rows (environ)
/*!40000 ALTER TABLE `public` DISABLE KEYS */;
/*!40000 ALTER TABLE `public` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. realisator
CREATE TABLE IF NOT EXISTS `realisator` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.realisator : ~0 rows (environ)
/*!40000 ALTER TABLE `realisator` DISABLE KEYS */;
/*!40000 ALTER TABLE `realisator` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. ressources
CREATE TABLE IF NOT EXISTS `ressources` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `ademe` binary(50) NOT NULL,
  `caution` int(11) NOT NULL,
  `catalogue` binary(50) NOT NULL,
  `type_id` int(11) unsigned NOT NULL,
  `condition_id` int(11) unsigned NOT NULL,
  `theme_id` int(11) unsigned NOT NULL,
  `location_id` int(11) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_validated` binary(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ressources_type` (`type_id`),
  KEY `FK_ressources_condition` (`condition_id`),
  KEY `FK_ressources_theme` (`theme_id`),
  KEY `FK_ressources_location` (`location_id`),
  CONSTRAINT `FK_ressources_condition` FOREIGN KEY (`condition_id`) REFERENCES `condition` (`id`),
  CONSTRAINT `FK_ressources_location` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`),
  CONSTRAINT `FK_ressources_theme` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`),
  CONSTRAINT `FK_ressources_type` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.ressources : ~0 rows (environ)
/*!40000 ALTER TABLE `ressources` DISABLE KEYS */;
/*!40000 ALTER TABLE `ressources` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. theme
CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.theme : ~0 rows (environ)
/*!40000 ALTER TABLE `theme` DISABLE KEYS */;
/*!40000 ALTER TABLE `theme` ENABLE KEYS */;

-- Listage de la structure de la table climactions2. type
CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table climactions2.type : ~0 rows (environ)
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
/*!40000 ALTER TABLE `type` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
