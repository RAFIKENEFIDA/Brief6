-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 23 juin 2021 à 10:57
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `brief6`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `date_naissance` varchar(255) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_user`, `nom`, `prenom`, `date_naissance`, `reference`) VALUES
(30, 'RAFIK', 'enefida', '1999-14-06', 'enefida30'),
(38, 'rofix', 'enfida', '11-15-2920', 'enfida38'),
(39, 'rof', 'enfida', '11-15-2920', 'enfida39'),
(40, 'enefida30', 'enefida30', '11-12-1998', 'enefida3040'),
(41, 'enefida30', 'enefida30', '11-12-1998', 'enefida3041'),
(139, 'youssef', 'enefida', '2021-06-15', 'enefida139'),
(140, 'rafik', 'ENEFIDA', '2021-06-16', 'ENEFIDA140'),
(141, 'safae', 'safae', '2021-06-03', 'safae141'),
(142, 'oussal', 'ter', '2021-06-08', 'ter142'),
(143, 'trer', 'etretr', '2021-06-09', 'etretr143'),
(144, 'hicham ', 'hghjghjg', '2021-06-03', 'hghjghjg144');

-- --------------------------------------------------------

--
-- Structure de la table `créneau`
--

CREATE TABLE `créneau` (
  `id_cr` int(11) NOT NULL,
  `time_on` time DEFAULT NULL,
  `time_out` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `créneau`
--

INSERT INTO `créneau` (`id_cr`, `time_on`, `time_out`) VALUES
(1, '10:00:00', '10:30:00'),
(2, '11:00:00', '11:30:00'),
(3, '14:00:00', '14:30:00'),
(4, '15:00:00', '15:30:00'),
(5, '16:00:00', '16:30:00');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_user` int(11) DEFAULT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_cr` int(11) DEFAULT NULL,
  `jour` varchar(255) DEFAULT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_user`, `id_reservation`, `id_cr`, `jour`, `note`) VALUES
(30, 25, 2, '2021-09-23', 'mohssssin'),
(30, 29, 2, '2021-11-10', 'ytrtyrtdhcgqtuyt'),
(30, 32, 3, '2021-06-10', 'eeeeee'),
(30, 34, 3, '2021-06-12', 'bbbbbbbbbbb'),
(30, 36, 2, '2021-06-04', 'ehhhhhhhh'),
(38, 37, 2, '2021-06-09', 'hfhfhfhfhfh'),
(38, 38, 3, '2021-06-09', 'ggggg'),
(144, 39, 3, '2021-06-01', 'rafujjkkjh');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `créneau`
--
ALTER TABLE `créneau`
  ADD PRIMARY KEY (`id_cr`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_cr` (`id_cr`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT pour la table `créneau`
--
ALTER TABLE `créneau`
  MODIFY `id_cr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `client` (`id_user`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_cr`) REFERENCES `créneau` (`id_cr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
