-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 11 Décembre 2016 à 09:34
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  5.6.28

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
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `id_user`) VALUES
(1, 2),
(2, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `blog_post`
--

CREATE TABLE `blog_post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `draft` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `blog_post`
--

INSERT INTO `blog_post` (`id`, `title`, `body`, `draft`, `created_at`) VALUES
(1, '123', '123', 0, '2011-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `cahierdescharges`
--

CREATE TABLE `cahierdescharges` (
  `id_cdc` int(11) NOT NULL,
  `tarif` double NOT NULL,
  `delai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_contrat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `cahierdescharges`
--

INSERT INTO `cahierdescharges` (`id_cdc`, `tarif`, `delai`, `id_contrat`) VALUES
(1, 12, '12', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_post` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `draft` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `blog_post`, `category`, `draft`) VALUES
(1, 'test', 'test', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
  `id_competence` int(11) NOT NULL,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_freelancer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `competence`
--

INSERT INTO `competence` (`id_competence`, `categorie`, `description`, `id_freelancer`) VALUES
(1, 'test', 'test', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `id_contrat` int(11) NOT NULL,
  `tarif` double NOT NULL,
  `delai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_sign` datetime NOT NULL,
  `id_paiement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `contrat`
--

INSERT INTO `contrat` (`id_contrat`, `tarif`, `delai`, `date_sign`, `id_paiement`) VALUES
(1, 15.25, '15 jours', '2014-05-05 05:03:00', NULL),
(2, 12, '12', '2011-01-01 10:10:10', NULL),
(3, 123.2, '8 ans', '2011-01-01 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `freelancer`
--

CREATE TABLE `freelancer` (
  `id_freelancer` int(11) NOT NULL,
  `url_cv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `freelancer`
--

INSERT INTO `freelancer` (`id_freelancer`, `url_cv`, `url_photo`, `age`, `id_user`) VALUES
(1, 'ici', 'la', 12, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `id_freelancer` int(11) DEFAULT NULL,
  `id_societe` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sujet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_sign` datetime DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id_message`, `id_freelancer`, `id_societe`, `type`, `sujet`, `contenu`, `date_sign`, `id_admin`) VALUES
(1, NULL, NULL, 'test', 'test', 'test', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE `offre` (
  `id_offre` int(11) NOT NULL,
  `tarif` double NOT NULL,
  `delai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prop_commerciale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `particularite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_freelancer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `offre`
--

INSERT INTO `offre` (`id_offre`, `tarif`, `delai`, `prop_commerciale`, `particularite`, `id_freelancer`) VALUES
(1, 12, 'test', 'test', 'test', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paiement` int(11) NOT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dp_societe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dp_freelancer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `paiement`
--

INSERT INTO `paiement` (`id_paiement`, `etat`, `dp_societe`, `dp_freelancer`) VALUES
(1, '2', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id_projet` int(11) NOT NULL,
  `prix` double NOT NULL,
  `etape` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_societe` int(11) DEFAULT NULL,
  `id_cdc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `projet`
--

INSERT INTO `projet` (`id_projet`, `prix`, `etape`, `description`, `id_societe`, `id_cdc`) VALUES
(1, 12, 2, 'test', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

CREATE TABLE `societe` (
  `id_societe` int(11) NOT NULL,
  `siret` bigint(20) NOT NULL,
  `denomination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `societe`
--

INSERT INTO `societe` (`id_societe`, `siret`, `denomination`, `id_user`) VALUES
(1, 321654987654, 'societeTest', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `id_test` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_test` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resultat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_passage` datetime NOT NULL,
  `id_freelancer` int(11) DEFAULT NULL,
  `id_competence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `test`
--

INSERT INTO `test` (`id_test`, `description`, `url_test`, `resultat`, `date_passage`, `id_freelancer`, `id_competence`) VALUES
(1, 'test', 'test', 'test', '2011-01-01 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'admin', 'admin', 'admin@admin.fr', 'admin@admin.fr', 1, NULL, '$2y$13$I5lFmZYM5tpf3XghpLHChO/a4Om2c7c5npvJbe.NSoodkIEMAzxJC', '2016-12-11 09:14:33', NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}'),
(2, 'test', 'test', 'test@test.fr', 'test@test.fr', 0, NULL, 'test', NULL, NULL, NULL, 'a:0:{}');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cahierdescharges`
--
ALTER TABLE `cahierdescharges`
  ADD PRIMARY KEY (`id_cdc`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`id_competence`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`id_contrat`);

--
-- Index pour la table `freelancer`
--
ALTER TABLE `freelancer`
  ADD PRIMARY KEY (`id_freelancer`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`id_offre`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_paiement`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id_projet`);

--
-- Index pour la table `societe`
--
ALTER TABLE `societe`
  ADD PRIMARY KEY (`id_societe`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id_test`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `cahierdescharges`
--
ALTER TABLE `cahierdescharges`
  MODIFY `id_cdc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `competence`
--
ALTER TABLE `competence`
  MODIFY `id_competence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `id_contrat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `freelancer`
--
ALTER TABLE `freelancer`
  MODIFY `id_freelancer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `offre`
--
ALTER TABLE `offre`
  MODIFY `id_offre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id_paiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `societe`
--
ALTER TABLE `societe`
  MODIFY `id_societe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `test`
--
ALTER TABLE `test`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
