-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 12 avr. 2023 à 15:04
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `eglise`
--

-- --------------------------------------------------------

--
-- Structure de la table `eglise`
--

CREATE TABLE `eglise` (
  `ideglise` varchar(50) NOT NULL DEFAULT '0',
  `Design` varchar(50) NOT NULL,
  `Solde` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `eglise`
--

INSERT INTO `eglise` (`ideglise`, `Design`, `Solde`) VALUES
('E1', 'FLM', 6500),
('E2', 'catholique', 0);

-- --------------------------------------------------------

--
-- Structure de la table `entre`
--

CREATE TABLE `entre` (
  `identre` int(50) NOT NULL,
  `motif` varchar(50) NOT NULL,
  `montantEntre` int(50) NOT NULL,
  `dateEntre` date NOT NULL,
  `idEglise` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `entre`
--

INSERT INTO `entre` (`identre`, `motif`, `montantEntre`, `dateEntre`, `idEglise`) VALUES
(14, 'rakitra', 2000, '2023-04-07', 'E1'),
(15, 'don d\'une association', 5000, '2023-04-07', 'E1');

-- --------------------------------------------------------

--
-- Structure de la table `sortie`
--

CREATE TABLE `sortie` (
  `idsortie` int(50) NOT NULL,
  `motif` varchar(50) NOT NULL,
  `montantSortie` int(50) NOT NULL,
  `dateSortie` date NOT NULL,
  `idEglise` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sortie`
--

INSERT INTO `sortie` (`idsortie`, `motif`, `montantSortie`, `dateSortie`, `idEglise`) VALUES
(16, 'Jirama', 500, '2023-04-07', 'E1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `eglise`
--
ALTER TABLE `eglise`
  ADD PRIMARY KEY (`ideglise`);

--
-- Index pour la table `entre`
--
ALTER TABLE `entre`
  ADD PRIMARY KEY (`identre`),
  ADD KEY `idEglise` (`idEglise`);

--
-- Index pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD PRIMARY KEY (`idsortie`),
  ADD KEY `idEglise` (`idEglise`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `entre`
--
ALTER TABLE `entre`
  MODIFY `identre` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `sortie`
--
ALTER TABLE `sortie`
  MODIFY `idsortie` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `entre`
--
ALTER TABLE `entre`
  ADD CONSTRAINT `entre_ibfk_1` FOREIGN KEY (`idEglise`) REFERENCES `eglise` (`ideglise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD CONSTRAINT `sortie_ibfk_1` FOREIGN KEY (`idEglise`) REFERENCES `eglise` (`ideglise`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
