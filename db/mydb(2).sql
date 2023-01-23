-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 21 jan. 2023 à 20:35
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
-- Base de données : `mydb`
--

-- --------------------------------------------------------

--
-- Structure de la table `labboxtable`
--

CREATE TABLE `labboxtable` (
  `idLabBox` int(11) NOT NULL,
  `LocalIP` varchar(15) DEFAULT NULL,
  `nomBox` varchar(40) DEFAULT NULL,
  `laboratoires_idlaboratoires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `labboxtable`
--

INSERT INTO `labboxtable` (`idLabBox`, `LocalIP`, `nomBox`, `laboratoires_idlaboratoires`) VALUES
(1, '192.168.3.7', 'LabBox Salle Curie', 1),
(2, '192.168.3.11', 'LabBox Salle 312', 1),
(3, '192.168.3.12', 'LabBox Salle 102', 1),
(4, '192.168.3.14', 'LabBox Salle Pasteur', 1),
(5, '192.168.13.2', 'LabBox Salle 104', 1),
(9, '192.135.3.45', 'LabBox Bruhfordlol', 1),
(10, '123.234.2.34', 'LabBox Salle Cring', 1),
(11, '234.234.3.3', 'LabBox Cognor', 1),
(15, '112.22.123.3', 'LabBox Bruhfordlol', 1),
(16, '234.23.42.3', 'GROGRougou', 1),
(17, '4.3.3.3', 'LabBox Salle Crounguy', 1);

-- --------------------------------------------------------

--
-- Structure de la table `laboratoires`
--

CREATE TABLE `laboratoires` (
  `idlaboratoires` int(11) NOT NULL,
  `nomLabo` varchar(45) NOT NULL,
  `emailLabo` varchar(75) NOT NULL,
  `adresseLabo` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `laboratoires`
--

INSERT INTO `laboratoires` (`idlaboratoires`, `nomLabo`, `emailLabo`, `adresseLabo`) VALUES
(1, 'Laboratoire de la cote', 'infolabocote@gmail.com', '32 rue de la charrue rouillée 76020 Le Tréport'),
(2, 'Laboratoire Issy Centre 92130', 'laboissycentre@gmail.com', '10 rue de Vanves 92130, Issy-les-Moulineaux'),
(3, 'Laboratoire des ondines', 'laboondine@sorsen.lol', '10 rue de la chambre');

-- --------------------------------------------------------

--
-- Structure de la table `newsletters`
--

CREATE TABLE `newsletters` (
  `email` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `newsletters`
--

INSERT INTO `newsletters` (`email`) VALUES
('blep.doge@gmail.com'),
('dfgdgfg@fr.fr'),
('lm.szymko@gmail.com'),
('lolxdddd@mai.com'),
('xddd@lglmf.fr');

-- --------------------------------------------------------

--
-- Structure de la table `sensorvalues`
--

CREATE TABLE `sensorvalues` (
  `timestamp` datetime NOT NULL,
  `CO2value` int(11) DEFAULT NULL,
  `COvalue` int(11) DEFAULT NULL,
  `dBvalue` int(11) DEFAULT NULL,
  `Tempvalue` decimal(3,1) DEFAULT NULL,
  `BPMvalue` int(11) DEFAULT NULL,
  `LabBoxTable_idLabBox` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sensorvalues`
--

INSERT INTO `sensorvalues` (`timestamp`, `CO2value`, `COvalue`, `dBvalue`, `Tempvalue`, `BPMvalue`, `LabBoxTable_idLabBox`) VALUES
('2023-01-17 16:39:00', 500, 2, 40, '19.9', 79, 1),
('2023-01-17 16:39:15', 495, 1, 38, '19.9', 77, 1),
('2023-01-17 16:39:30', 499, 1, 39, '20.0', 77, 1),
('2023-01-17 16:39:45', 509, 1, 41, '20.3', 80, 1),
('2023-01-17 16:40:00', 504, 2, 42, '19.8', 79, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sysadmins`
--

CREATE TABLE `sysadmins` (
  `idAdmin` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sysadmins`
--

INSERT INTO `sysadmins` (`idAdmin`, `email`, `password`, `nom`, `prenom`) VALUES
(1, 'rootsysadmin', '$2y$10$uPUMJMMMXlioUwGhv.I7HOs/hFpVAfSNe5Q7ccEkYib64ODgIpSJK', 'Stark', 'Tony');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `adresse` varchar(128) NOT NULL,
  `email` varchar(75) NOT NULL,
  `adminPerm` tinyint(4) NOT NULL,
  `password` varchar(75) DEFAULT NULL,
  `laboratoires_idlaboratoires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idusers`, `nom`, `prenom`, `adresse`, `email`, `adminPerm`, `password`, `laboratoires_idlaboratoires`) VALUES
(1, 'Szymkowiak', 'Louis-Marie', '10 rue claude matrat 92130 issy-les-moulineaux', 'lm.szymko@gmail.com', 1, '$2y$10$XlG.0H/9Ht1eXNJrrZbvrOsuz/Zpf6f0zyo6mbhdbw3qLZFK/maLm', 1),
(2, 'Rey', 'Tiffany', '52 Rue Gaston Monmousseau, Guyancourt', 'tiffanyreypro@gmail.com', 1, '$2y$10$9wixV8gJy4hqbSiFDOydmeUJSvEBK.f7UhyfoB3wWoX4/gojstE.O', 1),
(3, 'Ta', 'Alexis', 'Vitry sur seine', 'alexista@gmail.com', 0, '$2y$10$Pb/iA4ZCQLyzr3XfktuNdObeBoRJewqI3t9hGIKuiXEZ9vHb4.7Oa', 1),
(4, 'Serain', 'Mathis', 'Boulogne-Billancourt', 'serainmathis@gmail.com', 0, '$2y$10$EW0CubwW5MfosZnY637b7ujTXg6noDoAyHBbk/B5t49PK2XWejcmq', 1),
(5, 'Xiong', 'Zelin', 'Paris 15e', 'zelin.xiong@gmail.com', 0, '$2y$10$YxK7mjGbRPJ.bkzyuKjNAOzaqiNYa8cwLppJ21k0vBXQDHWGYP5yK', 1),
(6, 'd\'Hebrail', 'Mathilde', 'Paris 6e', 'mathildedhebrail@gmail.com', 0, '$2y$10$YYc3mb5zv8v7jGyPVcaEROKsvdowHbtnrILkR7yapzLfCTU0EC/42', 1),
(9, 'kbfbkf', 'bobibib', '52 Rue gaston Monmousseau', 'b@i.f', 0, '$2y$10$n0YgQxriCn0wcQ5UW/JQJuCDCsjjQXWms.jeUBwd9P3iqXXIMtvia', 1),
(11, 'bresil', 'michel', '52 au bresil', 'michelbresil@gmail.com', 1, '$2y$10$.PF0awS1M/6cqQFot2FDIe0Qyp9Z.LbX4QI8hHDJqEYOb/7Id2FaW', 1),
(12, 'raoboaub', 'Roger', '10 rue de la vache', 'rogermicro@gmail.com', 0, '$2y$10$6c.arL2vR7B/RgeVHArHy.mVYHnXdOu3d6sOW9cJUGItsRufe.UCG', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `labboxtable`
--
ALTER TABLE `labboxtable`
  ADD PRIMARY KEY (`idLabBox`),
  ADD KEY `fk_LabBoxTable_laboratoires1_idx` (`laboratoires_idlaboratoires`);

--
-- Index pour la table `laboratoires`
--
ALTER TABLE `laboratoires`
  ADD PRIMARY KEY (`idlaboratoires`);

--
-- Index pour la table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `sensorvalues`
--
ALTER TABLE `sensorvalues`
  ADD PRIMARY KEY (`timestamp`),
  ADD KEY `fk_sensorValues_LabBoxTable1_idx` (`LabBoxTable_idLabBox`);

--
-- Index pour la table `sysadmins`
--
ALTER TABLE `sysadmins`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`),
  ADD KEY `fk_users_laboratoires1_idx` (`laboratoires_idlaboratoires`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `labboxtable`
--
ALTER TABLE `labboxtable`
  MODIFY `idLabBox` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `laboratoires`
--
ALTER TABLE `laboratoires`
  MODIFY `idlaboratoires` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `sysadmins`
--
ALTER TABLE `sysadmins`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `labboxtable`
--
ALTER TABLE `labboxtable`
  ADD CONSTRAINT `fk_LabBoxTable_laboratoires1` FOREIGN KEY (`laboratoires_idlaboratoires`) REFERENCES `laboratoires` (`idlaboratoires`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `sensorvalues`
--
ALTER TABLE `sensorvalues`
  ADD CONSTRAINT `fk_sensorValues_LabBoxTable1` FOREIGN KEY (`LabBoxTable_idLabBox`) REFERENCES `labboxtable` (`idLabBox`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_laboratoires1` FOREIGN KEY (`laboratoires_idlaboratoires`) REFERENCES `laboratoires` (`idlaboratoires`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
