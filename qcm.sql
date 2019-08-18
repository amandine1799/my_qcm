-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  Dim 18 août 2019 à 15:17
-- Version du serveur :  10.3.12-MariaDB
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `qcm`
--

-- --------------------------------------------------------

--
-- Structure de la table `qcm`
--

CREATE TABLE `qcm` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `qcm`
--

INSERT INTO `qcm` (`id`, `name`) VALUES
(1, 'QCM1');

-- --------------------------------------------------------

--
-- Structure de la table `qcm_question`
--

CREATE TABLE `qcm_question` (
  `id_question` int(11) NOT NULL,
  `id_qcm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `qcm_question`
--

INSERT INTO `qcm_question` (`id_question`, `id_qcm`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `question`) VALUES
(1, 'De quelle couleur est le rat ?'),
(2, 'Quelle drogue aime le Roi Shadok?'),
(3, 'Qu\'est-ce que le marin aime ?');

-- --------------------------------------------------------

--
-- Structure de la table `question_response`
--

CREATE TABLE `question_response` (
  `id_response` int(11) NOT NULL,
  `id_question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `question_response`
--

INSERT INTO `question_response` (`id_response`, `id_question`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 2),
(6, 3),
(7, 3),
(8, 3);

-- --------------------------------------------------------

--
-- Structure de la table `response`
--

CREATE TABLE `response` (
  `id` int(11) NOT NULL,
  `response` varchar(255) NOT NULL,
  `valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `response`
--

INSERT INTO `response` (`id`, `response`, `valid`) VALUES
(1, 'Marron', 0),
(2, 'Bleu', 1),
(3, 'La coke', 1),
(4, 'La meth', 0),
(5, 'L\'herbe', 0),
(6, 'GA BU ZO MEU', 1),
(7, 'L\'alcool', 1),
(8, 'Disneyland', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `qcm`
--
ALTER TABLE `qcm`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `qcm_question`
--
ALTER TABLE `qcm_question`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `id_qcm` (`id_qcm`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `question_response`
--
ALTER TABLE `question_response`
  ADD PRIMARY KEY (`id_response`),
  ADD KEY `id_question` (`id_question`);

--
-- Index pour la table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `qcm`
--
ALTER TABLE `qcm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `response`
--
ALTER TABLE `response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `qcm_question`
--
ALTER TABLE `qcm_question`
  ADD CONSTRAINT `qcm_question_ibfk_1` FOREIGN KEY (`id_qcm`) REFERENCES `qcm` (`id`),
  ADD CONSTRAINT `qcm_question_ibfk_2` FOREIGN KEY (`id_question`) REFERENCES `question` (`id`);

--
-- Contraintes pour la table `question_response`
--
ALTER TABLE `question_response`
  ADD CONSTRAINT `question_response_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `question` (`id`),
  ADD CONSTRAINT `question_response_ibfk_2` FOREIGN KEY (`id_response`) REFERENCES `response` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
