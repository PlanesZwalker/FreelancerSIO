-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 01 Décembre 2016 à 09:26
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ppe_freelancer`
--

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
  `id_competence` int(11) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_test` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `id_contrat` int(11) NOT NULL,
  `tarif` float NOT NULL,
  `delai` varchar(255) NOT NULL,
  `date_sign` varchar(255) NOT NULL,
  `id_paiement` int(11) NOT NULL,
  `id_projet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) NOT NULL,
  `username_canonical` varchar(180) NOT NULL,
  `email` varchar(180) NOT NULL,
  `email_canonical` varchar(180) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext NOT NULL,
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `pseudo`) VALUES
(0, 'administrateur', 'administrateur', 'admin@admin.fr', 'admin@admin.fr', 1, '9wsjmofofq0cck84ksksow4w044k4s', '$2y$13$7leln/ef0cdptoqSkmJNfek0qiC5kB/L1LIM8VesupEXVvCUvXdSW', '2016-12-01 09:02:06', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `freelancer`
--

CREATE TABLE `freelancer` (
  `id_freelancer` int(11) NOT NULL,
  `url_cv` varchar(255) NOT NULL,
  `url_photo` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `adresse` varchar(25) DEFAULT NULL,
  `pseudo` varchar(25) DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL,
  `date_insc` date DEFAULT NULL,
  `date_modif` date DEFAULT NULL,
  `id_offre` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `id_paiement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `type` varchar(255) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `contenu` varchar(255) NOT NULL,
  `date` varchar(55) NOT NULL,
  `id_freelancer` int(11) NOT NULL,
  `id_societe` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE `offre` (
  `id_offre` int(11) NOT NULL,
  `tarif` float NOT NULL,
  `delai` varchar(255) NOT NULL,
  `prop_commerciale` varchar(255) NOT NULL,
  `particularite` varchar(255) NOT NULL,
  `id_freelancer` int(11) NOT NULL,
  `id_projet` int(11) NOT NULL,
  `id_projet_1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paiement` int(11) NOT NULL,
  `etat` varchar(55) NOT NULL,
  `dp_societe` varchar(255) NOT NULL,
  `dp_freelancer` varchar(255) NOT NULL,
  `id_contrat` int(11) NOT NULL,
  `id_freelancer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `passe`
--

CREATE TABLE `passe` (
  `id_freelancer` int(11) NOT NULL,
  `id_test` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id_projet` int(11) NOT NULL,
  `prix` float NOT NULL,
  `etape` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_societe` int(11) NOT NULL,
  `id_offre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

CREATE TABLE `societe` (
  `id_societe` int(11) NOT NULL,
  `siret` bigint(20) NOT NULL,
  `denomination` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `adresse` varchar(25) DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL,
  `date_insc` date DEFAULT NULL,
  `date_modif` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `id_test` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `url_test` varchar(255) NOT NULL,
  `resultat` varchar(255) NOT NULL,
  `date_passage` varchar(55) NOT NULL,
  `id_competence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`id_competence`),
  ADD KEY `FK_competence_id_test` (`id_test`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`id_contrat`),
  ADD KEY `FK__contrat_id_paiement` (`id_paiement`),
  ADD KEY `FK__contrat_id_projet` (`id_projet`);

--
-- Index pour la table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `freelancer`
--
ALTER TABLE `freelancer`
  ADD PRIMARY KEY (`id_freelancer`),
  ADD KEY `FK_freelancer_id_offre` (`id_offre`),
  ADD KEY `FK_freelancer_id` (`id`),
  ADD KEY `FK_freelancer_id_paiement` (`id_paiement`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_freelancer`,`id_societe`,`id`),
  ADD KEY `FK_message_id_societe` (`id_societe`),
  ADD KEY `FK_message_id` (`id`);

--
-- Index pour la table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`id_offre`),
  ADD KEY `FK_offre_id_freelancer` (`id_freelancer`),
  ADD KEY `FK_offre_id_projet` (`id_projet`),
  ADD KEY `FK_offre_id_projet_1` (`id_projet_1`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_paiement`),
  ADD KEY `FK_paiement_id_contrat` (`id_contrat`),
  ADD KEY `FK_paiement_id_freelancer` (`id_freelancer`);

--
-- Index pour la table `passe`
--
ALTER TABLE `passe`
  ADD PRIMARY KEY (`id_freelancer`,`id_test`),
  ADD KEY `FK_Passe_id_test` (`id_test`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id_projet`),
  ADD KEY `FK_projet_id_societe` (`id_societe`),
  ADD KEY `FK_projet_id_offre` (`id_offre`);

--
-- Index pour la table `societe`
--
ALTER TABLE `societe`
  ADD PRIMARY KEY (`id_societe`),
  ADD KEY `FK_societe_id` (`id`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id_test`),
  ADD KEY `FK_test_id_competence` (`id_competence`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `competence`
--
ALTER TABLE `competence`
  ADD CONSTRAINT `FK_competence_id_test` FOREIGN KEY (`id_test`) REFERENCES `test` (`id_test`);

--
-- Contraintes pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `FK__contrat_id_paiement` FOREIGN KEY (`id_paiement`) REFERENCES `paiement` (`id_paiement`),
  ADD CONSTRAINT `FK__contrat_id_projet` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`);

--
-- Contraintes pour la table `freelancer`
--
ALTER TABLE `freelancer`
  ADD CONSTRAINT `FK_freelancer_id` FOREIGN KEY (`id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_freelancer_id_offre` FOREIGN KEY (`id_offre`) REFERENCES `offre` (`id_offre`),
  ADD CONSTRAINT `FK_freelancer_id_paiement` FOREIGN KEY (`id_paiement`) REFERENCES `paiement` (`id_paiement`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_message_id` FOREIGN KEY (`id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_message_id_freelancer` FOREIGN KEY (`id_freelancer`) REFERENCES `freelancer` (`id_freelancer`),
  ADD CONSTRAINT `FK_message_id_societe` FOREIGN KEY (`id_societe`) REFERENCES `societe` (`id_societe`);

--
-- Contraintes pour la table `offre`
--
ALTER TABLE `offre`
  ADD CONSTRAINT `FK_offre_id_freelancer` FOREIGN KEY (`id_freelancer`) REFERENCES `freelancer` (`id_freelancer`),
  ADD CONSTRAINT `FK_offre_id_projet` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`),
  ADD CONSTRAINT `FK_offre_id_projet_1` FOREIGN KEY (`id_projet_1`) REFERENCES `projet` (`id_projet`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `FK_paiement_id_contrat` FOREIGN KEY (`id_contrat`) REFERENCES `contrat` (`id_contrat`),
  ADD CONSTRAINT `FK_paiement_id_freelancer` FOREIGN KEY (`id_freelancer`) REFERENCES `freelancer` (`id_freelancer`);

--
-- Contraintes pour la table `passe`
--
ALTER TABLE `passe`
  ADD CONSTRAINT `FK_Passe_id_freelancer` FOREIGN KEY (`id_freelancer`) REFERENCES `freelancer` (`id_freelancer`),
  ADD CONSTRAINT `FK_Passe_id_test` FOREIGN KEY (`id_test`) REFERENCES `test` (`id_test`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `FK_projet_id_offre` FOREIGN KEY (`id_offre`) REFERENCES `offre` (`id_offre`),
  ADD CONSTRAINT `FK_projet_id_societe` FOREIGN KEY (`id_societe`) REFERENCES `societe` (`id_societe`);

--
-- Contraintes pour la table `societe`
--
ALTER TABLE `societe`
  ADD CONSTRAINT `FK_societe_id` FOREIGN KEY (`id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `FK_test_id_competence` FOREIGN KEY (`id_competence`) REFERENCES `competence` (`id_competence`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
