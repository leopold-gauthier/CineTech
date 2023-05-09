-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 09 mai 2023 à 16:09
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cinetech`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `commentaire` text COLLATE utf8mb4_general_ci NOT NULL,
  `id_utilisateur` int NOT NULL,
  `id_film` int NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_utilisateur`, `id_film`, `type`, `date`) VALUES
(27, 'superr', 1, 502356, 'movie', '2023-05-04 08:23:10'),
(26, 'super', 1, 502356, 'movie', '2023-05-04 08:22:19'),
(25, 'j\'ai vraiment adoré ce film quelle effet spéciaux dit donc !', 1, 502356, 'movie', '2023-05-04 08:21:57'),
(30, 'Hello body', 2, 594767, 'movie', '2023-05-04 10:15:08');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_film` int NOT NULL,
  `type` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `id_utilisateur` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id`, `id_film`, `type`, `id_utilisateur`) VALUES
(60, 594767, 'movie', 1),
(59, 758323, 'movie', 1),
(58, 948713, 'movie', 2),
(57, 215315, 'tv', 2),
(56, 213713, 'tv', 2),
(52, 502356, 'movie', 3),
(47, 603692, 'movie', 2),
(43, 804150, 'movie', 2),
(55, 758323, 'movie', 2),
(41, 603692, 'movie', 3),
(51, 934433, 'movie', 3),
(61, 15260, 'tv', 2);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

DROP TABLE IF EXISTS `reponses`;
CREATE TABLE IF NOT EXISTS `reponses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reponse` text COLLATE utf8mb4_general_ci NOT NULL,
  `id_utilisateur` int NOT NULL,
  `id_commentaire` int NOT NULL,
  `date_reponse` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`id`, `reponse`, `id_utilisateur`, `id_commentaire`, `date_reponse`) VALUES
(6, 'super j\'adore le systeme !!', 2, 27, '2023-05-04 10:11:07'),
(5, 'j\'aime vraiment pas', 2, 27, '2023-05-04 09:52:06'),
(4, 'nann', 2, 27, '2023-05-04 09:48:25'),
(7, 'rsalut', 3, 30, '2023-05-04 10:15:42'),
(8, 'super', 3, 25, '2023-05-05 10:36:06');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `firstname`, `lastname`, `password`, `avatar`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', 'admin', 'admin', ''),
(2, 'red', 'red@gmail.com', 'red', 'red', 'red', ''),
(3, 'blue', 'blue@gmail.com', 'blue', 'blue', 'blue', ''),
(4, 'green', 'green@gmail.com', 'green', 'green', 'green', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
