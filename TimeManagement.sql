-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 01 jan. 2019 à 19:38
-- Version du serveur :  10.1.29-MariaDB
-- Version de PHP :  7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `TimeManagement`
--
CREATE DATABASE IF NOT EXISTS `TimeManagement` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `TimeManagement`;

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `subscription_date` date NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `mail`, `subscription_date`, `pass`) VALUES
(3, 'Valentin', 'Fontaine', 'vfontaine92@orange.fr', '2018-12-27', '$2y$10$jiwh4pYdUKGVAsIZUCN3GeqLrthNZ.7uCK7Ckt5pIaH0iLQ9jeF5i'),
(4, 'admin', 'admin', 'admin@admin.fr', '2018-12-27', '$2y$10$M/jxSz5dxLBim/tKRDbEVehSWArUQXTDWirl.ArkoiY4YsOEDppay'),
(5, 'Raphael', 'Pauchet', 'rapha@orange.fr', '2018-12-29', '$2y$10$9/WjC2qT8yscB8cVdRKite7VxzmL8WZRnqAMNVtZsQIk4YNJ.4Kn6');

-- --------------------------------------------------------

--
-- Structure de la table `planification`
--

CREATE TABLE `planification` (
  `id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `members_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`id`, `members_id`, `name`, `description`) VALUES
(1, 3, 'Tiny House', 'Construire une tiny House'),
(2, 3, 'TimeManagement', ''),
(3, 3, 'Autres Tâches', '');

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `project_id` int(11) NOT NULL,
  `members_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `entry_date` datetime NOT NULL,
  `started_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `importance` int(11) NOT NULL,
  `estimated_duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tasks`
--

INSERT INTO `tasks` (`id`, `category`, `project_id`, `members_id`, `name`, `description`, `entry_date`, `started_date`, `due_date`, `end_date`, `importance`, `estimated_duration`) VALUES
(1, 'perso', 1, 3, 'implantation tiny hous', 'Faire un plan 2D de la tiny pour pouvoir commencer la conception', '2018-12-29 07:07:00', '0000-00-00 00:00:00', '2019-02-01 00:00:00', '0000-00-00 00:00:00', 2, 2),
(2, 'personal', 1, 3, 'faire tutoriel Free CAD', 'Apprendre à utiliser FreeCAD pour faire la conception de la tiny house', '2018-12-30 19:15:00', '0000-00-00 00:00:00', '2018-03-31 00:00:00', '0000-00-00 00:00:00', 3, 8),
(3, 'personal', 1, 3, 'faire planning tiny House', 'Faire le planning complet pour fabriquer la tiny house', '2018-12-30 19:20:58', '0000-00-00 00:00:00', '2019-02-20 00:00:00', '0000-00-00 00:00:00', 2, 8),
(4, 'personal', 1, 3, 'faire budget tiny House', 'Faire le budget pour a tiny house et sélectionner les composants clés', '2018-12-30 19:23:40', '0000-00-00 00:00:00', '2019-02-15 00:00:00', '0000-00-00 00:00:00', 2, 8),
(41, 'personal', 3, 3, 'Test', 'test', '2019-01-01 10:04:56', '0000-00-00 00:00:00', '2019-02-01 00:00:00', '2019-01-01 10:31:52', 3, 1),
(42, 'personal', 3, 3, 'test', 'test2', '2019-01-01 10:33:50', '0000-00-00 00:00:00', '2019-02-01 00:00:00', '2019-01-01 10:33:53', 3, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `planification`
--
ALTER TABLE `planification`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `planification`
--
ALTER TABLE `planification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
