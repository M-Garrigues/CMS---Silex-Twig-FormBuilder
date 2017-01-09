-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 25 Juillet 2016 à 14:51
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fc_bdd`
--

DROP DATABASE IF EXISTS `fc_bdd`;
CREATE DATABASE fc_bdd CHARACTER SET 'utf8';
GRANT ALL PRIVILEGES ON fc_bdd.* TO "admin"@"localhost" IDENTIFIED BY 'aufçà,noiâénéDZç&çnnè_nbdlisVZidzbuoV632adbjqdkdvac2123azcaé"&éd&_ç&';
FLUSH PRIVILEGES;


 USE fc_bdd;
-- --------------------------------------------------------

--
-- Structure de la table `r_docs_articles`
--

CREATE TABLE `r_docs_articles` (
  `article_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `r_docs_entries`
--

CREATE TABLE `r_docs_entries` (
  `doc_id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `r_images_articles`
--

CREATE TABLE `r_images_articles` (
  `article_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `r_images_entries`
--

CREATE TABLE `r_images_entries` (
  `entry_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `r_kw_articles`
--

CREATE TABLE `r_kw_articles` (
  `article_id` int(11) NOT NULL,
  `kw_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `r_kw_articles`
--

INSERT INTO `r_kw_articles` (`article_id`, `kw_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 2),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8);

-- --------------------------------------------------------

--
-- Structure de la table `t_articles`
--

CREATE TABLE `t_articles` (
  `article_id` int(11) NOT NULL,
  `article_title` varchar(25) DEFAULT NULL,
  `article_content` varchar(25) NOT NULL,
  `article_date` date NOT NULL,
  `entry_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_articles`
--

INSERT INTO `t_articles` (`article_id`, `article_title`, `article_content`, `article_date`, `entry_id`) VALUES
(1, 'Premier test stage', 'Ceci est le premier test ', '2016-05-06', 3),
(2, 'Premier test maquette', 'Ceci est le premier test ', '2016-05-07', 9);

-- --------------------------------------------------------

--
-- Structure de la table `t_docs`
--

CREATE TABLE `t_docs` (
  `doc_id` int(11) NOT NULL,
  `doc_label` varchar(25) NOT NULL,
  `doc_path` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_entries`
--

CREATE TABLE `t_entries` (
  `entry_id` int(11) NOT NULL,
  `entry_name` varchar(25) NOT NULL,
  `entry_url` varchar(25) NOT NULL,
  `entry_content` varchar(500) DEFAULT NULL,
  `tab_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_entries`
--

INSERT INTO `t_entries` (`entry_id`, `entry_name`, `entry_url`, `entry_content`, `tab_id`) VALUES
(1, 'Prochains événements', 'prochain_evenement', 'Liste de tous les événements à venir!', 1),
(2, 'Actualités', 'actu', 'Toutes les actualités dans le monde de l''astronomie!', 1),
(3, 'Stages', 'stage', 'Les stages de cette année et des années précédentes.', 2),
(4, 'Ateliers', 'atelier', 'Liste de tous les ateliers par années!', 2),
(5, 'Documents des formations', 'documents_formations', 'Les documents utilisés pendant chaque formation.', 2),
(6, 'Travaux dirigés', 'td', 'Liste de tous les tds faisables en cours!', 3),
(7, 'Documents', 'docs', 'Liste de tous les documents!', 3),
(8, 'Mallettes pédagogiques', 'mallette', 'Liste de tous les mallettes pédagogiques disponibles!', 3),
(9, 'Maquettes', 'maquette', 'Maquettes à but pédagogique.', 3),
(10, 'Matériels d''observation', 'materiel_observation', 'Matériels d''observations disponibles.', 3),
(11, 'Logiciels', 'logiciel', 'Liste de tous les logiciels utiles à l astronomie!', 3),
(12, 'Liens', 'lien', 'Liste de tous les liens utiles!', 3),
(13, 'Astrogebra', 'astrogebra', 'Des travaux pratiques utilisant le logiciel Astrogebra.', 4),
(14, 'Expériences de Physique', 'experiences_physique', 'Des travaux pratiques déjà réaliés, sur différents sujets touchant à l astronomie.', 5),
(15, 'Classes à PAC', 'classes_a_pac', 'Les classes_a_pac.', 6),
(16, 'Ateliers scientifiques', 'ateliers_scientifiques', 'Des... ateliers scientifiques.', 6),
(17, 'TPE - TIPE', 'tpe_tipe', 'Les tpe_tipe.', 6),
(18, 'Rosetta et Philae 2014-15', 'rosetta_philae', 'Différents articles sur cet événement.', 7),
(19, 'Ama09', 'ama09', 'Différents articles sur l ama09.', 7),
(20, 'Année de la physique 2015', 'annee_physique_2015', 'Articles sur l année de la physique', 7),
(21, 'Passage Vénus 2004', 'passage_venus_2004', 'articles vénus 2004.', 7),
(22, 'Eclipse 2015', 'passage_venus_2004', 'articles éclipse de soleil 2015.', 7);

-- --------------------------------------------------------

--
-- Structure de la table `t_images`
--

CREATE TABLE `t_images` (
  `image_id` int(11) NOT NULL,
  `image_label` varchar(25) NOT NULL,
  `image_path` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_keywords`
--

CREATE TABLE `t_keywords` (
  `kw_id` int(11) NOT NULL,
  `kw_kw` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_keywords`
--

INSERT INTO `t_keywords` (`kw_id`, `kw_kw`) VALUES
(8, 'deuxieme'),
(4, 'essai'),
(6, 'ipsum'),
(5, 'lorem'),
(7, 'maquette'),
(1, 'premier'),
(3, 'stage'),
(2, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `t_tabs`
--

CREATE TABLE t_tabs(
        tab_id      int (11) Auto_increment  NOT NULL ,
        tab_name    Varchar (25) NOT NULL ,
        tab_url     Varchar (25) NOT NULL ,
        tab_content Varchar (25) ,
        PRIMARY KEY (tab_id ) ,
        UNIQUE (tab_name ,tab_url )
)ENGINE=InnoDB;
#------------------------------------------------------------
# Table: r_images_tabs
#------------------------------------------------------------

CREATE TABLE r_images_tabs(
        tab_id   Int NOT NULL ,
        image_id Int NOT NULL ,
        PRIMARY KEY (tab_id ,image_id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: r_docs_tabs
#------------------------------------------------------------

CREATE TABLE r_docs_tabs(
        tab_id Int NOT NULL ,
        doc_id Int NOT NULL ,
        PRIMARY KEY (tab_id ,doc_id )
)ENGINE=InnoDB;

--
-- Contenu de la table `t_tabs`
--

INSERT INTO `t_tabs` (`tab_id`, `tab_name`, `tab_url`, `tab_content`) VALUES
(1, 'Actualités', 'actus', 'test lorem ipsum test lorem ipsum test lorem ipsum test lorem ipsum'),
(4, 'Astrogebra', 'astrogebra', 'test lorem ipsum test lorem ipsum test lorem ipsum test lorem ipsum'),
(7, 'Evénements antérieurs', 'evenements_anterieurs', 'test lorem ipsum test lorem ipsum test lorem ipsum test lorem ipsum'),
(5, 'Expériences de physique', 'experiences', 'test lorem ipsum test lorem ipsum test lorem ipsum test lorem ipsum'),
(2, 'Formations', 'formations', 'test lorem ipsum test lorem ipsum test lorem ipsum test lorem ipsum'),
(6, 'Parrainages', 'parrainages', 'test lorem ipsum test lorem ipsum test lorem ipsum test lorem ipsum'),
(3, 'Ressources pédagogiques', 'ressources_pedagogiques', 'test lorem ipsum test lorem ipsum test lorem ipsum test lorem ipsum');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `r_docs_articles`
--
ALTER TABLE `r_docs_articles`
  ADD PRIMARY KEY (`article_id`,`doc_id`),
  ADD KEY `FK_r_docs_articles_doc_id` (`doc_id`);

--
-- Index pour la table `r_docs_entries`
--
ALTER TABLE `r_docs_entries`
  ADD PRIMARY KEY (`doc_id`,`entry_id`),
  ADD KEY `FK_r_docs_entries_entry_id` (`entry_id`);

--
-- Index pour la table `r_images_articles`
--
ALTER TABLE `r_images_articles`
  ADD PRIMARY KEY (`article_id`,`image_id`),
  ADD KEY `FK_r_images_articles_image_id` (`image_id`);

--
-- Index pour la table `r_images_entries`
--
ALTER TABLE `r_images_entries`
  ADD PRIMARY KEY (`entry_id`,`image_id`),
  ADD KEY `FK_r_images_entries_image_id` (`image_id`);

--
-- Index pour la table `r_kw_articles`
--
ALTER TABLE `r_kw_articles`
  ADD PRIMARY KEY (`article_id`,`kw_id`),
  ADD KEY `FK_r_kw_articles_kw_id` (`kw_id`);

--
-- Index pour la table `t_articles`
--
ALTER TABLE `t_articles`
  ADD PRIMARY KEY (`article_id`),
  ADD UNIQUE KEY `article_title` (`article_title`),
  ADD KEY `FK_t_articles_entry_id` (`entry_id`);

--
-- Index pour la table `t_docs`
--
ALTER TABLE `t_docs`
  ADD PRIMARY KEY (`doc_id`),
  ADD UNIQUE KEY `doc_path` (`doc_path`);

--
-- Index pour la table `t_entries`
--
ALTER TABLE `t_entries`
  ADD PRIMARY KEY (`entry_id`),
  ADD UNIQUE KEY `entry_name` (`entry_name`,`entry_url`),
  ADD KEY `FK_t_entries_tab_id` (`tab_id`);

--
-- Index pour la table `t_images`
--
ALTER TABLE `t_images`
  ADD PRIMARY KEY (`image_id`),
  ADD UNIQUE KEY `image_path` (`image_path`);

--
-- Index pour la table `t_keywords`
--
ALTER TABLE `t_keywords`
  ADD PRIMARY KEY (`kw_id`),
  ADD UNIQUE KEY `kw_kw` (`kw_kw`);

--
-- Index pour la table `t_tabs`
--
ALTER TABLE `t_tabs`
  ADD PRIMARY KEY (`tab_id`),
  ADD UNIQUE KEY `tab_name` (`tab_name`,`tab_url`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_articles`
--
ALTER TABLE `t_articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `t_docs`
--
ALTER TABLE `t_docs`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_entries`
--
ALTER TABLE `t_entries`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `t_images`
--
ALTER TABLE `t_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_keywords`
--
ALTER TABLE `t_keywords`
  MODIFY `kw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `t_tabs`
--
ALTER TABLE `t_tabs`
  MODIFY `tab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `r_docs_articles`
--
ALTER TABLE `r_docs_articles`
  ADD CONSTRAINT `FK_r_docs_articles_article_id` FOREIGN KEY (`article_id`) REFERENCES `t_articles` (`article_id`),
  ADD CONSTRAINT `FK_r_docs_articles_doc_id` FOREIGN KEY (`doc_id`) REFERENCES `t_docs` (`doc_id`);

--
-- Contraintes pour la table `r_docs_entries`
--
ALTER TABLE `r_docs_entries`
  ADD CONSTRAINT `FK_r_docs_entries_doc_id` FOREIGN KEY (`doc_id`) REFERENCES `t_docs` (`doc_id`),
  ADD CONSTRAINT `FK_r_docs_entries_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `t_entries` (`entry_id`);

--
-- Contraintes pour la table `r_images_articles`
--
ALTER TABLE `r_images_articles`
  ADD CONSTRAINT `FK_r_images_articles_article_id` FOREIGN KEY (`article_id`) REFERENCES `t_articles` (`article_id`),
  ADD CONSTRAINT `FK_r_images_articles_image_id` FOREIGN KEY (`image_id`) REFERENCES `t_images` (`image_id`);

--
-- Contraintes pour la table `r_images_entries`
--
ALTER TABLE `r_images_entries`
  ADD CONSTRAINT `FK_r_images_entries_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `t_entries` (`entry_id`),
  ADD CONSTRAINT `FK_r_images_entries_image_id` FOREIGN KEY (`image_id`) REFERENCES `t_images` (`image_id`);

--
-- Contraintes pour la table `r_kw_articles`
--
ALTER TABLE `r_kw_articles`
  ADD CONSTRAINT `FK_r_kw_articles_article_id` FOREIGN KEY (`article_id`) REFERENCES `t_articles` (`article_id`),
  ADD CONSTRAINT `FK_r_kw_articles_kw_id` FOREIGN KEY (`kw_id`) REFERENCES `t_keywords` (`kw_id`);

--
-- Contraintes pour la table `t_articles`
--
ALTER TABLE `t_articles`
  ADD CONSTRAINT `FK_t_articles_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `t_entries` (`entry_id`);

--
-- Contraintes pour la table `t_entries`
--
ALTER TABLE `t_entries`
  ADD CONSTRAINT `FK_t_entries_tab_id` FOREIGN KEY (`tab_id`) REFERENCES `t_tabs` (`tab_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
