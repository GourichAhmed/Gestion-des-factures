-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 06 juin 2021 à 03:04
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `facture`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Nom_admin` varchar(50) NOT NULL,
  `Prenom_admin` varchar(50) NOT NULL,
  `Email_admin` varchar(100) NOT NULL,
  `Tel_admin` varchar(50) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `Nom_admin`, `Prenom_admin`, `Email_admin`, `Tel_admin`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'gourich', 'ahmed', 'ahmedgorich@gmail.com', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2021-06-06 00:51:12');

-- --------------------------------------------------------

--
-- Structure de la table `allprodruits`
--

CREATE TABLE `allprodruits` (
  `ref_all_produit` int(11) NOT NULL,
  `Num_f` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `allprodruits`
--

INSERT INTO `allprodruits` (`ref_all_produit`, `Num_f`) VALUES
(1, 2),
(7, 7),
(10, 10),
(15, 15),
(17, 17),
(18, 18),
(27, 36),
(47, 56),
(48, 57),
(60, 69),
(64, 73);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_C` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Raison_soc` varchar(50) NOT NULL,
  `Adresse_Facturation` varchar(100) NOT NULL,
  `ICE_C` varchar(15) NOT NULL,
  `Adresse` varchar(50) NOT NULL,
  `Tel` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_C`, `Nom`, `Prenom`, `Raison_soc`, `Adresse_Facturation`, `ICE_C`, `Adresse`, `Tel`, `email`) VALUES
(1, 'gourich', 'ahmed', 'GAMING CENTRE ', 'MATMATA ', '4565483132545', 'matmataa', '0631994856', 'ahmedgorich@gmail.com'),
(2, 'boukhrite', 'yassine', 'AFRAH MIX', 'matmata rue 13', '7845965412535', 'fes', '0656897845', 'boukhrityassine@gmail.com'),
(16, 'gourich', 'ahmed', '', '', '', 'jkhjkh', '4564654654', ''),
(17, 'gourich', 'el mehdi', '', '', '', 'matmata', '4564654654', ''),
(20, 'adrdare', 'youssef', 'APX Gaming', 'fes', '245464549787542', 'rue 13 fes', '0631994856', 'adrdaryoussef@gmail.com'),
(23, 'Gourich', 'hamido', 'MarocExpress', 'n', '789654123654789', 'nnnn', '0631994856', 'ahmedgorich@gmail.com'),
(24, 'bahnas', 'amjad', 'TCP Maroc', 'matmata', '456654825479523', 'j', '0654653212', 'amjad@gmail.com'),
(25, 'maftah', 'hamza', 'NVIDIA SHOP', 'fes', '787878454545121', 'rue 45 fes', '0656457856', 'miftah@gmail.com'),
(26, 'khana', 'Mohamed', 'VER Maroc ', 'matmata rue 48 ', '789466134568', 'matmata', '0656895623', 'khana@gmail.com'),
(27, 'sakhi', 'aissam', 'GLOVO ', 'fes', '789789485156456', 'fes', '0689564578', 'sakhiAissam@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `Num_f` int(11) NOT NULL,
  `Date` date NOT NULL,
  `id_C` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`Num_f`, `Date`, `id_C`) VALUES
(2, '2021-05-21', 1),
(7, '2021-05-10', 2),
(10, '2021-05-30', 1),
(15, '2021-05-18', 1),
(17, '2021-05-18', 1),
(18, '2021-05-18', 2),
(23, '2021-05-30', 1),
(36, '2021-05-26', 20),
(56, '2021-06-18', 1),
(57, '2021-06-27', 17),
(69, '2021-06-02', 25),
(73, '2021-06-03', 20);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `ref` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `description_produit` varchar(100) NOT NULL,
  `prix` double NOT NULL,
  `tva` double NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`ref`, `designation`, `description_produit`, `prix`, `tva`, `image`) VALUES
(4, 'clavier', 'arabic', 300, 10, 'clavierarabic-1622823168.jpg'),
(5, 'usb', '32 Go,  KINGSTON', 250.17, 5, 'usb32gb-1622823286.webp'),
(6, 'casque gamer 7.1', 'green', 446.78, 4, 'casque-gamer-7.1-1622823374.jpg'),
(8, 'GTX 1030', 'MSI Lp 1 Fan 2GB', 1150.56, 10, 'capture-d’écran-(12)-1622817701.png'),
(9, 'GTX 1050Ti', 'Gainward 4GB', 1800.99, 10, 'gtx-1050ti-1622823452.png'),
(10, 'GTX 1660  Super', 'Asus Tuf gaming 3 fans Advanced Edition 6GB', 3550.99, 20, 'gtx-1660-super-1622823548.jpg'),
(11, 'RTX 2060 ZOTAC ', 'Gaming Dual Fans 6GB', 4250.99, 20, 'rtx-2060-zotac-1622823619.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `seule_produit`
--

CREATE TABLE `seule_produit` (
  `ref_seule_produit` int(11) NOT NULL,
  `ref_all_produit` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  `ref` int(11) NOT NULL,
  `tva` double NOT NULL,
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `seule_produit`
--

INSERT INTO `seule_produit` (`ref_seule_produit`, `ref_all_produit`, `qte`, `ref`, `tva`, `prix`) VALUES
(29, 1, 1, 6, 0, 0),
(32, 1, 1, 11, 0, 0),
(41, 7, 1, 11, 0, 0),
(45, 10, 10, 8, 0, 0),
(46, 10, 5, 11, 0, 0),
(58, 17, 1, 11, 200, 425000000.99),
(60, 18, 1, 9, 20, 1850.99),
(179, 18, 1, 9, 10, 1800.99),
(199, 18, 3, 10, 2, 355.99),
(200, 18, 1, 4, 10, 30),
(207, 27, 1, 6, 4, 446.78),
(209, 27, 3, 8, 20, 11),
(213, 10, 1, 6, 4, 446.78),
(216, 1, 1, 4, 10, 300),
(221, 1, 1, 5, 5, 250.17),
(222, 1, 1, 9, 10, 1800.99),
(226, 1, 1, 9, 10, 1800.99),
(227, 1, 1, 11, 20, 4250.99),
(232, 1, 1, 8, 10, 1150.56),
(236, 1, 1, 10, 20, 3550.99),
(239, 1, 1, 6, 4, 446.78),
(241, 1, 1, 10, 20, 3550.99),
(247, 47, 1, 11, 0, 0),
(248, 47, 1, 9, 0, 0),
(249, 47, 1, 9, 0, 0),
(250, 48, 1, 10, 0, 0),
(251, 48, 1, 10, 0, 0),
(256, 48, 1, 11, 0, 0),
(257, 48, 1, 11, 0, 0),
(322, 1, 1, 11, 111, 4250.99),
(324, 60, 1, 11, 15, 4250.99),
(328, 1, 1, 9, 10, 1800.99),
(329, 1, 1, 6, 4, 446.78),
(330, 1, 1, 6, 4, 446.78),
(332, 1, 1, 11, 20, 4250.99),
(333, 1, 1, 8, 10, 1150.56),
(334, 1, 1, 9, 10, 1800.99),
(336, 1, 1, 9, 10, 1800.99),
(337, 1, 1, 11, 20, 4250.99),
(339, 1, 1, 11, 20, 4250.99),
(344, 1, 1, 6, 4, 446.78),
(349, 64, 1, 11, 2, 3000.99),
(351, 47, 1, 10, 20, 3550.99),
(352, 47, 1, 6, 4, 446.78),
(353, 47, 1, 8, 10, 1150.56),
(354, 47, 1, 6, 4, 446.78),
(355, 47, 1, 5, 5, 250.17),
(356, 47, 1, 5, 5, 250.17),
(357, 47, 1, 6, 4, 446.78),
(358, 47, 1, 8, 10, 1150.56),
(359, 47, 1, 5, 5, 250.17),
(360, 47, 1, 5, 5, 250.17),
(361, 47, 1, 9, 10, 1800.99),
(362, 1, 1, 8, 10, 1150.56),
(363, 1, 1, 10, 20, 3550.99),
(364, 1, 1, 9, 10, 1800.99),
(365, 1, 1, 9, 10, 1800.99),
(366, 1, 1, 5, 5, 250.17),
(367, 1, 1, 8, 10, 1150.56),
(368, 1, 1, 6, 4, 446.78),
(369, 1, 1, 8, 10, 1150.56),
(370, 1, 1, 8, 10, 1150.56);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `allprodruits`
--
ALTER TABLE `allprodruits`
  ADD PRIMARY KEY (`ref_all_produit`),
  ADD KEY `Num_f` (`Num_f`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_C`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`Num_f`),
  ADD KEY `id_C` (`id_C`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`ref`);

--
-- Index pour la table `seule_produit`
--
ALTER TABLE `seule_produit`
  ADD PRIMARY KEY (`ref_seule_produit`),
  ADD KEY `ref_all_produit` (`ref_all_produit`),
  ADD KEY `ref` (`ref`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `allprodruits`
--
ALTER TABLE `allprodruits`
  MODIFY `ref_all_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_C` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `Num_f` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `ref` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `seule_produit`
--
ALTER TABLE `seule_produit`
  MODIFY `ref_seule_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `allprodruits`
--
ALTER TABLE `allprodruits`
  ADD CONSTRAINT `allprodruits_ibfk_1` FOREIGN KEY (`Num_f`) REFERENCES `facture` (`Num_f`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`id_C`) REFERENCES `client` (`id_C`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `seule_produit`
--
ALTER TABLE `seule_produit`
  ADD CONSTRAINT `seule_produit_ibfk_1` FOREIGN KEY (`ref_all_produit`) REFERENCES `allprodruits` (`ref_all_produit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seule_produit_ibfk_2` FOREIGN KEY (`ref`) REFERENCES `produits` (`ref`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
