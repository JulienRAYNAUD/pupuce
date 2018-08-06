-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2018 at 03:41 PM
-- Server version: 5.7.22-0ubuntu0.17.10.1
-- PHP Version: 7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pupuce`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `nom` char(32) NOT NULL,
  `prenom` char(32) NOT NULL,
  `mail` char(32) NOT NULL,
  `adresse` char(64) NOT NULL,
  `cp` char(5) NOT NULL,
  `ville` char(32) NOT NULL,
  `dateNaissance` date NOT NULL,
  `id` int(11) NOT NULL,
  `dateCreationCompte` date NOT NULL,
  `motDePasse` char(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `numCommande` int(11) NOT NULL,
  `dateCommande` date NOT NULL,
  `dateLivraison` date NOT NULL,
  `numPanier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employe`
--

CREATE TABLE `employe` (
  `nom` char(32) NOT NULL,
  `prenom` char(32) NOT NULL,
  `mail` char(32) NOT NULL,
  `adresse` char(64) NOT NULL,
  `cp` char(5) NOT NULL,
  `ville` char(32) NOT NULL,
  `dateNaissance` date NOT NULL,
  `id` int(11) NOT NULL,
  `numSecu` int(11) NOT NULL,
  `fonction` char(32) NOT NULL,
  `salaire` double NOT NULL,
  `superieur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `nom` char(32) NOT NULL,
  `prenom` char(32) NOT NULL,
  `mail` char(32) NOT NULL,
  `adresse` char(64) NOT NULL,
  `cp` char(5) NOT NULL,
  `ville` char(32) NOT NULL,
  `dateNaissance` date NOT NULL,
  `id` int(11) NOT NULL,
  `codeComptable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` char(32) NOT NULL,
  `description` char(64) NOT NULL,
  `image` varchar(255) NOT NULL,
  `prix` double NOT NULL,
  `quantiteStock` int(11) NOT NULL,
  `TypeProduit` char(1) NOT NULL COMMENT 'N -> Nourriture, J -> Jouets, M -> Médicaments'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `image`, `prix`, `quantiteStock`, `TypeProduit`) VALUES
(1, 'Croquettes', 'Croquettes chat Royal Canin', 'images/croqRoyalCanin.jpeg', 12, 1, 'N'),
(2, 'Os à mâcher', 'Nonosse pour chienchien', 'images/nonos.jpg', 2, 123, 'N'),
(3, 'Balle', 'Baballe pour chatchat', 'images/baballe.jpg', 1, 234, 'J'),
(4, 'Antipuce', 'Antipuce contre les puces', 'images/antipuce.jpg', 15, 67, 'M'),
(5, 'Vermifuge', 'Vermifuge contre les vers', 'images/vermifuge.png', 16, 45, 'M'),
(6, 'Peluche', 'Peluche pour toutou', 'images/peluche.jpg', 7, 222, 'J');

-- --------------------------------------------------------

--
-- Table structure for table `produitsFournisseurs`
--

CREATE TABLE `produitsFournisseurs` (
  `fournisseur_id` int(11) NOT NULL,
  `produits_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Users_id` int(11) NOT NULL,
  `Users_nom` varchar(255) NOT NULL,
  `Users_email` varchar(255) NOT NULL,
  `Users_pass` char(41) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Users_id`, `Users_nom`, `Users_email`, `Users_pass`) VALUES
(1, 'Julien', 'julray@laposte.net', '12345678'),
(2, 'Fassol', 'fassol@seinplomb.co', 'Y0llo?3310');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`numCommande`);

--
-- Indexes for table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `numCommande` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `Users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
