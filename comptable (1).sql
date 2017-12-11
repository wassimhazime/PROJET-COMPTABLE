-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 11 déc. 2017 à 21:58
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `comptable`
--

-- --------------------------------------------------------

--
-- Structure de la table `avoir`
--

CREATE TABLE `avoir` (
  `id` int(10) NOT NULL,
  `N` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `raison_sociale` int(11) NOT NULL,
  `les_articles` text,
  `la_somme` int(12) NOT NULL,
  `remarque` text,
  `image` varchar(250) DEFAULT 'image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avoir`
--

INSERT INTO `avoir` (`id`, `N`, `date`, `raison_sociale`, `les_articles`, `la_somme`, `remarque`, `image`) VALUES
(1, 'ddd', '2017-10-15', 1, ' test', 23456789, ' ', 'image.jpg'),
(3, 'bbb', '2017-10-22', 1, ' fff', 6, ' ss', 'image.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `bl`
--

CREATE TABLE `bl` (
  `id` int(10) NOT NULL,
  `N` varchar(200) NOT NULL,
  `raison_sociale` int(11) NOT NULL,
  `date_de_livraison` date NOT NULL,
  `la_somme` int(12) NOT NULL,
  `remarque` text,
  `BL_manque` tinyint(1) DEFAULT '0',
  `image` varchar(250) DEFAULT 'image.jpg',
  `adresse_BL` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bl`
--

INSERT INTO `bl` (`id`, `N`, `raison_sociale`, `date_de_livraison`, `la_somme`, `remarque`, `BL_manque`, `image`, `adresse_BL`) VALUES
(1, 'bl1', 1, '2017-10-29', 12344, ' test', 0, 'image.jpg', ' '),
(2, 'bl2', 1, '2017-10-15', 2345, ' test2', 0, 'image.jpg', ' ');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(10) NOT NULL,
  `raison_sociale` int(11) NOT NULL,
  `objectif` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `tarif_estime` int(12) DEFAULT NULL,
  `adresse` text,
  `remarque` text,
  `image` varchar(250) DEFAULT 'image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `raison_sociale`, `objectif`, `date`, `tarif_estime`, `adresse`, `remarque`, `image`) VALUES
(1, 1, 'zagora', '2017-10-26', 19, ' afra zagora', ' projet', 'image.jpg'),
(2, 1, 'zagora tafchan projet', '2017-10-27', 104, ' zagora', ' projet', 'image.jpg'),
(3, 1, 'afra ', '2017-10-26', 17777, ' bm', ' ', 'image.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id` int(10) NOT NULL,
  `N` varchar(200) NOT NULL,
  `raison_sociale` int(11) NOT NULL,
  `date_de_emise` date NOT NULL,
  `la_somme` int(12) NOT NULL,
  `TVA` int(12) DEFAULT NULL,
  `facture_real` tinyint(1) DEFAULT '0',
  `facture_existant` tinyint(1) DEFAULT '0',
  `image` varchar(250) DEFAULT 'image.jpg',
  `remarque` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id`, `N`, `raison_sociale`, `date_de_emise`, `la_somme`, `TVA`, `facture_real`, `facture_existant`, `image`, `remarque`) VALUES
(1, 'F1', 1, '2017-10-29', 345678, 2345, 0, 0, 'image.jpg', ' ');

-- --------------------------------------------------------

--
-- Structure de la table `mode_paiement`
--

CREATE TABLE `mode_paiement` (
  `id` int(10) NOT NULL,
  `mode_paiement` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mode_paiement`
--

INSERT INTO `mode_paiement` (`id`, `mode_paiement`) VALUES
(1, 'CHEQUE'),
(2, 'ESPEC'),
(3, 'fdi'),
(4, 'ftr'),
(5, 'add');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id` int(10) NOT NULL,
  `raison_sociale` int(11) NOT NULL,
  `mode_paiement` int(11) NOT NULL,
  `N_mode` varchar(200) NOT NULL,
  `date_Negociation` date DEFAULT NULL,
  `date_paiement` date DEFAULT NULL,
  `la_somme_factures` int(12) NOT NULL,
  `la_somme_TVA` int(12) DEFAULT NULL,
  `la_somme_remise` int(12) DEFAULT NULL,
  `remarque_remise` varchar(200) DEFAULT NULL,
  `la_somme_avoir` int(12) DEFAULT NULL,
  `la_somme_paye` int(12) NOT NULL,
  `reste` int(12) DEFAULT NULL,
  `factures_regler` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(250) NOT NULL DEFAULT 'image.jpg',
  `remarque` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id`, `raison_sociale`, `mode_paiement`, `N_mode`, `date_Negociation`, `date_paiement`, `la_somme_factures`, `la_somme_TVA`, `la_somme_remise`, `remarque_remise`, `la_somme_avoir`, `la_somme_paye`, `reste`, `factures_regler`, `image`, `remarque`) VALUES
(1, 1, 1, 'dfzfzef', '2017-10-29', '2017-10-29', 12345, 11111, 111, '111', 11, 11, 11, 0, 'image.jpg', ' ');

-- --------------------------------------------------------

--
-- Structure de la table `raison_sociale`
--

CREATE TABLE `raison_sociale` (
  `id` int(10) NOT NULL,
  `raison_sociale` varchar(200) NOT NULL,
  `ICE` varchar(200) NOT NULL,
  `I_F` varchar(201) NOT NULL,
  `T_P` varchar(201) NOT NULL,
  `CNSS` varchar(200) NOT NULL,
  `R_C` varchar(201) NOT NULL,
  `TELE1` varchar(20) NOT NULL,
  `TELE2` varchar(20) DEFAULT NULL,
  `GSM` varchar(20) DEFAULT NULL,
  `FAX` varchar(20) DEFAULT NULL,
  `site_web` varchar(200) DEFAULT NULL,
  `EMAIL` varchar(150) DEFAULT NULL,
  `adresse` text,
  `image` varchar(250) DEFAULT 'image.jpj'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `raison_sociale`
--

INSERT INTO `raison_sociale` (`id`, `raison_sociale`, `ICE`, `I_F`, `T_P`, `CNSS`, `R_C`, `TELE1`, `TELE2`, `GSM`, `FAX`, `site_web`, `EMAIL`, `adresse`, `image`) VALUES
(1, 'BCI', 'ICEBCI', 'IF BCI', 'TP BCI', 'CNSS BCI', 'RC BCI', '0523482009', '0607060706', '000000', '', '', '', ' ', 'image.jpj');

-- --------------------------------------------------------

--
-- Structure de la table `r_avoir_bl`
--

CREATE TABLE `r_avoir_bl` (
  `id_avoir` int(11) NOT NULL,
  `id_bl` int(11) NOT NULL,
  `remarque` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r_avoir_bl`
--

INSERT INTO `r_avoir_bl` (`id_avoir`, `id_bl`, `remarque`) VALUES
(1, 1, NULL),
(1, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `r_avoir_facture`
--

CREATE TABLE `r_avoir_facture` (
  `id_avoir` int(11) NOT NULL,
  `id_facture` int(11) NOT NULL,
  `remarque` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r_avoir_facture`
--

INSERT INTO `r_avoir_facture` (`id_avoir`, `id_facture`, `remarque`) VALUES
(1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `r_bl_commande`
--

CREATE TABLE `r_bl_commande` (
  `id_bl` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `remarque` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r_bl_commande`
--

INSERT INTO `r_bl_commande` (`id_bl`, `id_commande`, `remarque`) VALUES
(1, 1, NULL),
(1, 2, NULL),
(2, 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `r_facture_bl`
--

CREATE TABLE `r_facture_bl` (
  `id_facture` int(11) NOT NULL,
  `id_bl` int(11) NOT NULL,
  `remarque` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r_facture_bl`
--

INSERT INTO `r_facture_bl` (`id_facture`, `id_bl`, `remarque`) VALUES
(1, 1, NULL),
(1, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `r_paiement_avoir`
--

CREATE TABLE `r_paiement_avoir` (
  `id_paiement` int(11) NOT NULL,
  `id_avoir` int(11) NOT NULL,
  `remarque` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r_paiement_avoir`
--

INSERT INTO `r_paiement_avoir` (`id_paiement`, `id_avoir`, `remarque`) VALUES
(1, 1, NULL),
(1, 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `r_paiement_facture`
--

CREATE TABLE `r_paiement_facture` (
  `id_paiement` int(11) NOT NULL,
  `id_facture` int(11) NOT NULL,
  `remarque` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `r_paiement_facture`
--

INSERT INTO `r_paiement_facture` (`id_paiement`, `id_facture`, `remarque`) VALUES
(1, 1, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avoir`
--
ALTER TABLE `avoir`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `N` (`N`),
  ADD KEY `FOURNISSEUR` (`raison_sociale`);

--
-- Index pour la table `bl`
--
ALTER TABLE `bl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `N` (`N`),
  ADD KEY `fournisseur` (`raison_sociale`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commande_ibfk_1` (`raison_sociale`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `N` (`N`),
  ADD KEY `Fournisseur` (`raison_sociale`);

--
-- Index pour la table `mode_paiement`
--
ALTER TABLE `mode_paiement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `N_mode` (`N_mode`),
  ADD KEY `fournisseur` (`raison_sociale`),
  ADD KEY `mode` (`mode_paiement`);

--
-- Index pour la table `raison_sociale`
--
ALTER TABLE `raison_sociale`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `RAISON_SOCIALE` (`raison_sociale`),
  ADD UNIQUE KEY `ICE` (`ICE`),
  ADD UNIQUE KEY `I-F` (`I_F`),
  ADD UNIQUE KEY `CNSS` (`CNSS`),
  ADD UNIQUE KEY `T-P` (`T_P`),
  ADD UNIQUE KEY `R-C` (`R_C`);

--
-- Index pour la table `r_avoir_bl`
--
ALTER TABLE `r_avoir_bl`
  ADD PRIMARY KEY (`id_avoir`,`id_bl`),
  ADD KEY `id_bl` (`id_bl`);

--
-- Index pour la table `r_avoir_facture`
--
ALTER TABLE `r_avoir_facture`
  ADD PRIMARY KEY (`id_avoir`,`id_facture`),
  ADD KEY `id_facture` (`id_facture`);

--
-- Index pour la table `r_bl_commande`
--
ALTER TABLE `r_bl_commande`
  ADD PRIMARY KEY (`id_bl`,`id_commande`),
  ADD KEY `id_commande` (`id_commande`);

--
-- Index pour la table `r_facture_bl`
--
ALTER TABLE `r_facture_bl`
  ADD PRIMARY KEY (`id_facture`,`id_bl`),
  ADD KEY `id_bl` (`id_bl`);

--
-- Index pour la table `r_paiement_avoir`
--
ALTER TABLE `r_paiement_avoir`
  ADD PRIMARY KEY (`id_paiement`,`id_avoir`),
  ADD KEY `id_avoir` (`id_avoir`);

--
-- Index pour la table `r_paiement_facture`
--
ALTER TABLE `r_paiement_facture`
  ADD PRIMARY KEY (`id_paiement`,`id_facture`),
  ADD KEY `id_facture` (`id_facture`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avoir`
--
ALTER TABLE `avoir`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `bl`
--
ALTER TABLE `bl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `mode_paiement`
--
ALTER TABLE `mode_paiement`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `raison_sociale`
--
ALTER TABLE `raison_sociale`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avoir`
--
ALTER TABLE `avoir`
  ADD CONSTRAINT `avoir_ibfk_1` FOREIGN KEY (`raison_sociale`) REFERENCES `raison_sociale` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `bl`
--
ALTER TABLE `bl`
  ADD CONSTRAINT `bl_ibfk_1` FOREIGN KEY (`raison_sociale`) REFERENCES `raison_sociale` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`raison_sociale`) REFERENCES `raison_sociale` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`raison_sociale`) REFERENCES `raison_sociale` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`raison_sociale`) REFERENCES `raison_sociale` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paiement_ibfk_2` FOREIGN KEY (`mode_paiement`) REFERENCES `mode_paiement` (`id`);

--
-- Contraintes pour la table `r_avoir_bl`
--
ALTER TABLE `r_avoir_bl`
  ADD CONSTRAINT `d_avoir_bl_ibfk_1` FOREIGN KEY (`id_avoir`) REFERENCES `avoir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `d_avoir_bl_ibfk_2` FOREIGN KEY (`id_bl`) REFERENCES `bl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `r_avoir_facture`
--
ALTER TABLE `r_avoir_facture`
  ADD CONSTRAINT `d_avoir_facture_ibfk_1` FOREIGN KEY (`id_avoir`) REFERENCES `avoir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `d_avoir_facture_ibfk_2` FOREIGN KEY (`id_facture`) REFERENCES `facture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `r_bl_commande`
--
ALTER TABLE `r_bl_commande`
  ADD CONSTRAINT `R_bl_commande_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `R_bl_commande_ibfk_2` FOREIGN KEY (`id_bl`) REFERENCES `bl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `r_facture_bl`
--
ALTER TABLE `r_facture_bl`
  ADD CONSTRAINT `d_facture_bl_ibfk_1` FOREIGN KEY (`id_facture`) REFERENCES `facture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `d_facture_bl_ibfk_2` FOREIGN KEY (`id_bl`) REFERENCES `bl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `r_paiement_avoir`
--
ALTER TABLE `r_paiement_avoir`
  ADD CONSTRAINT `d_paiement_avoir_ibfk_1` FOREIGN KEY (`id_avoir`) REFERENCES `avoir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `d_paiement_avoir_ibfk_2` FOREIGN KEY (`id_paiement`) REFERENCES `paiement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `r_paiement_facture`
--
ALTER TABLE `r_paiement_facture`
  ADD CONSTRAINT `d_paiement_facture_ibfk_1` FOREIGN KEY (`id_facture`) REFERENCES `facture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `d_paiement_facture_ibfk_2` FOREIGN KEY (`id_paiement`) REFERENCES `paiement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
