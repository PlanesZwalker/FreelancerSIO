-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 04 Décembre 2016 à 10:01
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
  `id_admin` int(254) NOT NULL,
  `id_user` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `id_user`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cahierdescharges`
--

CREATE TABLE `cahierdescharges` (
  `id_cdc` int(255) NOT NULL,
  `tarif` float NOT NULL,
  `delai` varchar(255) NOT NULL,
  `id_contrat` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cahierdescharges`
--

INSERT INTO `cahierdescharges` (`id_cdc`, `tarif`, `delai`, `id_contrat`) VALUES
(1, 1245.25, '8 semaines a compté du 23 octobre 2016', 0);

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
  `id_competence` int(11) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_freelancer` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `competence`
--

INSERT INTO `competence` (`id_competence`, `categorie`, `description`, `id_freelancer`) VALUES
(1, 'MaPremiereCategorieDeCompetence', 'Competence en PHP très utile pour la création de site web', 1);

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `id_contrat` int(11) NOT NULL,
  `tarif` float NOT NULL,
  `delai` varchar(255) NOT NULL,
  `date_sign` varchar(255) NOT NULL,
  `id_paiement` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contrat`
--

INSERT INTO `contrat` (`id_contrat`, `tarif`, `delai`, `date_sign`, `id_paiement`) VALUES
(1, 1234.2, '3 semaines à partir du 12/10/2016', '10/10/2016', 0);

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `typecompte` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `pseudo`, `typecompte`) VALUES
(1, 'admin', 'admin', 'anne@cohmbox.fr', 'anne@cohmbox.fr', 1, '4spgg4cjea6844cwggs84gw404ww4wg', '$2y$13$Oyxn4njJGCB3OOTHP.jbvuHWKcPCiE/iqaL7hLrMLpeOfH9tLKp9G', '2016-12-04 09:19:29', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, '', ''),
(2, 'adminuser', 'adminuser', 'contact@cohmbox.fr', 'contact@cohmbox.fr', 1, 'f3iufqjit1k4owgcwws8wgwg88go0wo', '$2y$13$wGH/BbZUPioMoZil8tt3VeKUQA3zZlStwaTAq0HNKOHx.3Vby43MG', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, '', ''),
(3, 'anne', 'anne', 'fruityannej@gmail.com', 'fruityannej@gmail.com', 1, 'neiuwcgtsbkgck0sc8ssww4g0ckkw4o', '$2y$13$fiD9JJmP3rAeq8UJUStg1uOC8DjSDfobG0aKhhJGgCzdw/m79Zv3S', '2016-11-07 18:36:19', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, '', ''),
(4, 'truc', 'truc', 'lksjfd@sdf.fr', 'lksjfd@sdf.fr', 1, 'akt8v2kf0q8ssskwkc8ok0sk80g8c0c', '$2y$13$5C/7S6vV9yRzFTEcE/9ape4UteROxj7EV57TIpLLUhPOr1Q4zJVUG', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '', ''),
(5, 'ajj', 'ajj', 'ajj@ajj.fr', 'ajj@ajj.fr', 1, '92y5lkjijoso4k8ss4s0wos8go8o44s', '$2y$13$q9GgQ2ZP7VXioMTNr2/t9.CcHlz/yPH03MejH8CgRmqSdL9.8P52i', '2016-11-06 18:50:40', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'ajj', ''),
(6, 'test', 'test', 'test@test.fr', 'test@test.fr', 1, 'dh9loeuck7c4w8ko04ckwgcswg0owc0', '$2y$13$Yc.eHHPF6cuwd84r9BznOOXlkywpD2WQN/HQXUg8DXDjkAHagHwvu', '2016-12-04 09:37:01', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'test', ''),
(7, '123', '123', '123@123.fr', '123@123.fr', 1, 'b6xmg63hpu04koog408408skkg04ogc', '$2y$13$xkjKceMyLfsx82P4DOk5nuQRpUnMqqAJlkrExqvkI/lU1Vlqx/qfe', '2016-11-06 20:27:09', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '123', ''),
(12, 'rere', 'rere', 're@re.fr', 're@re.fr', 1, 'aheaqjv23m88koocoso844wc0ww4sck', '$2y$13$ImGUaCwFjVuPFfkDat0IWeThhCTb9zcs7NSZqnuaaNql4IpZ7RIAy', '2016-11-06 23:22:07', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'rere', ''),
(13, 'test2', 'test2', 'test2@test.fr', 'test2@test.fr', 1, 'hqpixguwrs0gwc40k40wckgs4kw84ok', '$2y$13$jxpmNGKUP5G6JDzAPBei1exD2g2xFXTBUSkYLkQn4uAvNC8xdBIsm', '2016-12-04 09:31:21', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'test', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `freelancer`
--

CREATE TABLE `freelancer` (
  `id_freelancer` int(11) NOT NULL,
  `url_cv` varchar(255) NOT NULL,
  `url_photo` varchar(255) NOT NULL,
  `age` int(25) NOT NULL,
  `id_user` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `freelancer`
--

INSERT INTO `freelancer` (`id_freelancer`, `url_cv`, `url_photo`, `age`, `id_user`) VALUES
(1, '/id_freelancer', '/id_freelancer', 22, 2);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_admin` int(254) NOT NULL,
  `id_freelancer` int(254) NOT NULL,
  `id_societe` int(254) NOT NULL,
  `type` varchar(255) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `contenu` varchar(255) NOT NULL,
  `date` varchar(55) NOT NULL,
  `id_message` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id_admin`, `id_freelancer`, `id_societe`, `type`, `sujet`, `contenu`, `date`, `id_message`) VALUES
(0, 0, 0, 'commentaire', 'Réponse Offre', 'Nous sommes au regret de ne pas pouvoir accepter votre offre pour des raisons de budget', '10/10/2016', 0);

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE `offre` (
  `id_offre` int(255) NOT NULL,
  `tarif` float NOT NULL,
  `delai` varchar(255) NOT NULL,
  `prop_commerciale` varchar(255) NOT NULL,
  `particularite` varchar(255) NOT NULL,
  `id_freelancer` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `offre`
--

INSERT INTO `offre` (`id_offre`, `tarif`, `delai`, `prop_commerciale`, `particularite`, `id_freelancer`) VALUES
(1, 12345.2, '3 jours / 2 nuits', 'Maquette et Remise du projet en 3 jours', 'usage d''un CMS', 0);

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paiement` int(255) NOT NULL,
  `etat` varchar(55) NOT NULL,
  `dp_societe` varchar(255) NOT NULL,
  `dp_freelancer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `paiement`
--

INSERT INTO `paiement` (`id_paiement`, `etat`, `dp_societe`, `dp_freelancer`) VALUES
(0, 'Terminé : reglement effectué', '10/10/2016', '14/10/2016');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id_projet` int(11) NOT NULL,
  `prix` float NOT NULL,
  `etape` int(55) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_societe` int(255) NOT NULL,
  `id_cdc` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `projet`
--

INSERT INTO `projet` (`id_projet`, `prix`, `etape`, `description`, `id_societe`, `id_cdc`) VALUES
(1, 1594.25, 0, 'Demande de création de site web commerciale', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

CREATE TABLE `societe` (
  `id_societe` int(11) NOT NULL,
  `siret` bigint(255) NOT NULL,
  `denomination` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_user` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `societe`
--

INSERT INTO `societe` (`id_societe`, `siret`, `denomination`, `description`, `id_user`) VALUES
(1, 12456987123123465, 'MaPremiereSociété', 'Societe super cool qui paie ses factures !!!', 3);

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
  `id_freelancer` int(255) NOT NULL,
  `id_competence` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `test`
--

INSERT INTO `test` (`id_test`, `description`, `url_test`, `resultat`, `date_passage`, `id_freelancer`, `id_competence`) VALUES
(1, 'MonpremierTest', '/cheminversmonfichiertest', '35/40 : réussit a 90%', '12/10/2016', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(55) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `role` varchar(25) NOT NULL,
  `email` varchar(55) NOT NULL,
  `nomuser` varchar(55) NOT NULL,
  `prenomuser` varchar(55) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone` varchar(25) NOT NULL,
  `motdepasse` varchar(155) NOT NULL,
  `salt` varchar(54) NOT NULL,
  `date_insc` varchar(25) NOT NULL,
  `date_modif` varchar(25) NOT NULL,
  `statut_connect` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `pseudo`, `role`, `email`, `nomuser`, `prenomuser`, `adresse`, `telephone`, `motdepasse`, `salt`, `date_insc`, `date_modif`, `statut_connect`) VALUES
(1, 'admin', 'ROLE_ADMIN', 'admin@admin.fr', 'admin', 'admin', 'AdresseAdmin', '0102030415', 'NrkV7QPvOjE56h2Y/czhXud8dcQlOK7GSs7ogsNCFQH2G7VWAuJkma6tIO7TdVaoCWT1AckGB44xEPUQMqNZmA==', 'd85e71eff5937e2d7217bae', '20/10/2016', '20/10/2016', 0),
(2, 'MonPremierFreelancer', 'ROLE_FREELANCER', 'free@lancer.fr', 'PremierNomFreelancer', 'PremierPrenomFreelancer', 'adresse premier freelancer', '011111111111', '49dQCkDno6jFCBHGx2nGjiYqbCnxRYHT3akYjyVEjB2xj6kvZrzqKEhuCr7Tfb5dbSeUHrito9QThtkZ4Tis2Q==', 'a467c2a48c90c7079fc423d', '2016-10-23 12:34:47', '2016-10-23 12:34:47', 0),
(3, 'MapremiereSociete', 'ROLE_SOCIETE', 'societe@mail.fr', 'PremierNomSociete', 'PremierPrenomSociete', 'Premiere Adresse societe', '1234567890', 'motdepassssssss', 'dfgh45', '12/10/2016', '12/10/2016', 0),
(7, 'test', 'ROLE_ADMIN', 'test@test.fr', 'test', 'test', '', '0101010011', 'hNy3fmjTRLf2mMw0VmvLPJHqjQ4zDv4FL62bBx1lBW0Z4eNfWn28l+K7JmNt1xhPHcL1+YYbcD2ZPTWERq0PNg==', 'b84d9b64d5a8d4b03d1a66f', '2016-10-23 11:34:25', '2016-10-23 11:34:25', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `cahierdescharges`
--
ALTER TABLE `cahierdescharges`
  ADD PRIMARY KEY (`id_cdc`),
  ADD KEY `id_contrat` (`id_contrat`);

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`id_competence`),
  ADD KEY `id_freelancer` (`id_freelancer`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`id_contrat`),
  ADD KEY `id_paiement` (`id_paiement`);

--
-- Index pour la table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- Index pour la table `freelancer`
--
ALTER TABLE `freelancer`
  ADD PRIMARY KEY (`id_freelancer`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`id_offre`),
  ADD KEY `id_freelance` (`id_freelancer`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_paiement`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id_projet`),
  ADD KEY `id_societe` (`id_societe`),
  ADD KEY `id_cdc` (`id_cdc`);

--
-- Index pour la table `societe`
--
ALTER TABLE `societe`
  ADD PRIMARY KEY (`id_societe`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id_test`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cahierdescharges`
--
ALTER TABLE `cahierdescharges`
  MODIFY `id_cdc` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `competence`
--
ALTER TABLE `competence`
  MODIFY `id_competence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `id_contrat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `freelancer`
--
ALTER TABLE `freelancer`
  MODIFY `id_freelancer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `offre`
--
ALTER TABLE `offre`
  MODIFY `id_offre` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id_user` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
