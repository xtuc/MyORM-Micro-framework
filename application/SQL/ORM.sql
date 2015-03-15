-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 15 Mars 2015 à 15:14
-- Version du serveur :  5.5.41-0ubuntu0.14.10.1
-- Version de PHP :  5.5.12-2ubuntu4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `testorm`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
`ID_Address` int(11) NOT NULL,
  `Address1` varchar(64) NOT NULL,
  `Address2` varchar(64) NOT NULL,
  `ZipCode` varchar(12) NOT NULL,
  `City` varchar(64) NOT NULL,
  `State` varchar(64) NOT NULL,
  `Country` varchar(2) NOT NULL,
  `Version` int(11) NOT NULL DEFAULT '1',
  `LMD` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_LM` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `binvalue`
--

CREATE TABLE IF NOT EXISTS `binvalue` (
`ID_BinValue` int(11) NOT NULL,
  `FieldName` varchar(100) NOT NULL,
  `TableName` varchar(100) NOT NULL,
  `BinValue` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `Country` varchar(2) NOT NULL,
  `Name` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `entity`
--

CREATE TABLE IF NOT EXISTS `entity` (
`ID_Entity` int(11) NOT NULL,
  `ID_EntityType` int(11) NOT NULL DEFAULT '1',
  `Country` varchar(2) NOT NULL,
  `Licence` varchar(8) DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Name` varchar(50) NOT NULL,
  `Birthday` date NOT NULL,
  `Sex` enum('F','M') NOT NULL,
  `ID_Address` int(11) DEFAULT NULL,
  `CDate` datetime NOT NULL,
  `ID_C` int(11) NOT NULL,
  `CEmail` varchar(100) NOT NULL,
  `CZipCode` varchar(10) NOT NULL,
  `BinValue` int(11) NOT NULL,
  `Version` int(11) NOT NULL DEFAULT '1',
  `LMD` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ID_LM` int(11) NOT NULL,
  `ActivationCode` varchar(8) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `entityrelationentity`
--

CREATE TABLE IF NOT EXISTS `entityrelationentity` (
`ID_EntityRelationEntity` int(11) NOT NULL,
  `ID_Entity` int(11) NOT NULL,
  `ID_Parent_Entity` int(11) NOT NULL,
  `ID_EntityRelationEntityType` int(11) NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime DEFAULT NULL,
  `LevelValue` int(11) NOT NULL DEFAULT '0',
  `ID_C` int(11) NOT NULL,
  `CDate` datetime NOT NULL,
  `BinValue` int(11) NOT NULL,
  `Version` int(11) NOT NULL DEFAULT '1',
  `LMD` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_LM` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `entityrelationentitytype`
--

CREATE TABLE IF NOT EXISTS `entityrelationentitytype` (
`ID_EntityRelationEntityType` int(11) NOT NULL,
  `ID_EntityType` int(11) NOT NULL,
  `ID_Parent_EntityType` int(11) NOT NULL,
  `Description` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `entityspecificity`
--

CREATE TABLE IF NOT EXISTS `entityspecificity` (
`ID_EntitySpecificity` int(11) NOT NULL,
  `ID_Entity` int(11) NOT NULL,
  `ID_Specificity` int(11) NOT NULL,
  `Value` varchar(255) NOT NULL,
  `ID_C` int(11) NOT NULL,
  `CDate` datetime NOT NULL,
  `Version` int(11) NOT NULL DEFAULT '1',
  `LMD` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_LM` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `entitytype`
--

CREATE TABLE IF NOT EXISTS `entitytype` (
`ID_EntityType` int(11) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `SpecificityBinValue` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
`ID_Level` int(11) NOT NULL,
  `ID_EntityRelationEntityType` int(11) NOT NULL,
  `BinValue` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `relation`
--

CREATE TABLE IF NOT EXISTS `relation` (
  `TABLE_SCHEMA` varchar(50) NOT NULL,
  `TABLE_NAME` varchar(50) NOT NULL,
  `COLUMN_NAME` varchar(50) NOT NULL,
  `REFERENCED_TABLE_SCHEMA` varchar(50) NOT NULL,
  `REFERENCED_TABLE_NAME` varchar(50) NOT NULL DEFAULT '',
  `REFERENCED_COLUMN_NAME` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `relation`
--

INSERT INTO `relation` (`TABLE_SCHEMA`, `TABLE_NAME`, `COLUMN_NAME`, `REFERENCED_TABLE_SCHEMA`, `REFERENCED_TABLE_NAME`, `REFERENCED_COLUMN_NAME`) VALUES
('', 'address', 'Country', '', 'country', 'Country'),
('', 'entity', 'Country', '', 'country', 'Country'),
('', 'entityspecificity', 'ID_Specificity', '', 'specificity', 'ID_Specificity'),
('', 'entity', 'ID_Address', '', 'address', 'ID_Address'),
('', 'entity', 'ID_EntityType', '', 'entitytype', 'ID_EntityType'),
('', 'entityspecificity', 'ID_Entity', '', 'entity', 'ID_Entity'),
('', 'entityrelationentitytype', 'ID_EntityType', '', 'entitytype', 'ID_EntityType'),
('', 'entityrelationentitytype', 'ID_Parent_EntityType', '', 'entitytype', 'ID_EntityType'),
('', 'entityrelationentity', 'ID_Entity', '', 'entity', 'ID_Entity'),
('', 'entityrelationentity', 'ID_Parent_Entity', '', 'entity', 'ID_Entity'),
('', 'entityrelationentity', 'ID_EntityRelationEntityType', '', 'entityrelationentitytype', 'ID_EntityRelationEntityType'),
('', 'level', 'ID_EntityRelationEntityType', '', 'entityrelationentitytype', 'ID_EntityRelationEntityType');

-- --------------------------------------------------------

--
-- Structure de la table `specificity`
--

CREATE TABLE IF NOT EXISTS `specificity` (
`ID_Specificity` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `BinValue` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `address`
--
ALTER TABLE `address`
 ADD PRIMARY KEY (`ID_Address`), ADD KEY `Country` (`Country`);

--
-- Index pour la table `binvalue`
--
ALTER TABLE `binvalue`
 ADD PRIMARY KEY (`ID_BinValue`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
 ADD PRIMARY KEY (`Country`);

--
-- Index pour la table `entity`
--
ALTER TABLE `entity`
 ADD PRIMARY KEY (`ID_Entity`), ADD UNIQUE KEY `ID_Address` (`ID_Address`), ADD KEY `Country` (`Country`);

--
-- Index pour la table `entityrelationentity`
--
ALTER TABLE `entityrelationentity`
 ADD PRIMARY KEY (`ID_EntityRelationEntity`), ADD KEY `ID_Entity` (`ID_Entity`), ADD KEY `ID_Parent_Entity` (`ID_Parent_Entity`), ADD KEY `ID_EntityRelationEntityType` (`ID_EntityRelationEntityType`);

--
-- Index pour la table `entityrelationentitytype`
--
ALTER TABLE `entityrelationentitytype`
 ADD PRIMARY KEY (`ID_EntityRelationEntityType`), ADD KEY `ID_EntityType` (`ID_EntityType`), ADD KEY `ID_Parent_EntityType` (`ID_Parent_EntityType`);

--
-- Index pour la table `entityspecificity`
--
ALTER TABLE `entityspecificity`
 ADD PRIMARY KEY (`ID_EntitySpecificity`), ADD UNIQUE KEY `ID_Entity` (`ID_Entity`,`ID_Specificity`), ADD KEY `ID_Specificity` (`ID_Specificity`);

--
-- Index pour la table `entitytype`
--
ALTER TABLE `entitytype`
 ADD PRIMARY KEY (`ID_EntityType`);

--
-- Index pour la table `level`
--
ALTER TABLE `level`
 ADD PRIMARY KEY (`ID_Level`);

--
-- Index pour la table `specificity`
--
ALTER TABLE `specificity`
 ADD PRIMARY KEY (`ID_Specificity`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `address`
--
ALTER TABLE `address`
MODIFY `ID_Address` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `binvalue`
--
ALTER TABLE `binvalue`
MODIFY `ID_BinValue` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `entity`
--
ALTER TABLE `entity`
MODIFY `ID_Entity` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `entityrelationentity`
--
ALTER TABLE `entityrelationentity`
MODIFY `ID_EntityRelationEntity` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `entityrelationentitytype`
--
ALTER TABLE `entityrelationentitytype`
MODIFY `ID_EntityRelationEntityType` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `entityspecificity`
--
ALTER TABLE `entityspecificity`
MODIFY `ID_EntitySpecificity` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `entitytype`
--
ALTER TABLE `entitytype`
MODIFY `ID_EntityType` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `level`
--
ALTER TABLE `level`
MODIFY `ID_Level` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `specificity`
--
ALTER TABLE `specificity`
MODIFY `ID_Specificity` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
