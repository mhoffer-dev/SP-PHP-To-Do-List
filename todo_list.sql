-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 12 juin 2026 à 22:00
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `todo_list`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int NOT NULL AUTO_INCREMENT,
  `categorie` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `categorie`, `description`) VALUES
(1, 'Math Info', 'Travaux liés au module Math Info'),
(2, 'Développement Web', 'Projets HTML, CSS, JavaScript'),
(3, 'Personnel', 'Tâches personnelles');

-- --------------------------------------------------------

--
-- Structure de la table `priorite`
--

DROP TABLE IF EXISTS `priorite`;
CREATE TABLE IF NOT EXISTS `priorite` (
  `idPriorite` int NOT NULL AUTO_INCREMENT,
  `priorite` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `valeur` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idPriorite`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `priorite`
--

INSERT INTO `priorite` (`idPriorite`, `priorite`, `valeur`) VALUES
(1, 'Faible', 'faible'),
(2, 'Moyenne', 'moyenne'),
(3, 'Importante', 'importante'),
(4, 'Urgente', 'urgente');

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

DROP TABLE IF EXISTS `statut`;
CREATE TABLE IF NOT EXISTS `statut` (
  `idStatut` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idStatut`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`idStatut`, `statut`) VALUES
(1, 'à faire'),
(2, 'en cours'),
(3, 'terminée');

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

DROP TABLE IF EXISTS `tache`;
CREATE TABLE IF NOT EXISTS `tache` (
  `idTache` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `dateCreation` date NOT NULL,
  `dateEcheance` date DEFAULT NULL,
  `idPriorite` int NOT NULL,
  `idStatut` int NOT NULL,
  `idCategorie` int DEFAULT NULL,
  PRIMARY KEY (`idTache`),
  KEY `fk_tache_priorite` (`idPriorite`),
  KEY `fk_tache_statut` (`idStatut`),
  KEY `fk_tache_categorie` (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`idTache`, `title`, `description`, `dateCreation`, `dateEcheance`, `idPriorite`, `idStatut`, `idCategorie`) VALUES
(5, 'Créer la page accueil', 'Développer la page principale du site', '2026-06-11', '2026-06-21', 3, 2, 2),
(6, 'Finaliser le MCD', 'Vérifier les relations de la base de données', '2026-06-11', '2026-06-18', 4, 2, 1),
(7, 'Corriger les bugs CSS', 'Améliorer l\'affichage responsive', '2026-06-11', '2026-06-22', 2, 1, 2),
(8, 'Préparer soutenance', 'Créer les diapositives de présentation', '2026-06-11', '2026-06-25', 4, 1, 1),
(9, 'Acheter des courses', 'Faire les achats de la semaine', '2026-06-11', '2026-06-15', 1, 1, 3),
(10, 'Nettoyer le bureau', 'Ranger les documents et câbles', '2026-06-11', '2026-06-16', 1, 3, 3),
(11, 'Mettre à jour GitHub', 'Pousser la dernière version du projet', '2026-06-11', '2026-06-19', 3, 2, 2),
(12, 'Tester CRUD', 'Vérifier ajout modification suppression', '2026-06-11', '2026-06-17', 4, 2, 2),
(13, 'Faire sauvegarde BDD', 'Exporter la base MySQL', '2026-06-11', '2026-06-18', 3, 1, 1),
(14, 'Lire documentation PDO', 'Comprendre les requêtes préparées', '2026-06-11', '2026-06-23', 2, 2, 2),
(15, 'Créer formulaire contact', 'Ajouter un formulaire au portfolio', '2026-06-11', '2026-06-24', 2, 1, 2),
(17, 'Corriger rapport', 'Relire et corriger le document PDF', '2026-06-11', '2026-06-20', 3, 1, 1),
(18, 'Ajouter authentification', 'Créer système de connexion utilisateur', '2026-06-11', '2026-06-30', 4, 1, 2),
(19, 'Tester hébergement', 'Déployer sur AlwaysData', '2026-06-11', '2026-06-28', 3, 1, 2),
(20, 'Mettre à jour CV', 'Ajouter les derniers projets', '2026-06-11', '2026-06-26', 2, 3, 3),
(21, 'Organiser fichiers', 'Nettoyer la structure du projet', '2026-06-11', '2026-06-21', 1, 2, 2),
(22, 'Préparer démonstration', 'Tester toutes les fonctionnalités', '2026-06-11', '2026-06-29', 4, 1, 1),
(23, 'VValider projet final', 'Vérification complète avant rendu', '2026-06-11', '2026-07-01', 4, 1, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `fk_tache_categorie` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tache_priorite` FOREIGN KEY (`idPriorite`) REFERENCES `priorite` (`idPriorite`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tache_statut` FOREIGN KEY (`idStatut`) REFERENCES `statut` (`idStatut`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
