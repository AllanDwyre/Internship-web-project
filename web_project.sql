-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 04 avr. 2022 à 14:00
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `web_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `accept`
--

CREATE TABLE `accept` (
  `id_student` int(11) NOT NULL,
  `id_offer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `accept`
--

INSERT INTO `accept` (`id_student`, `id_offer`) VALUES
(1, 6),
(4, 5);

-- --------------------------------------------------------

--
-- Structure de la table `authentification`
--

CREATE TABLE `authentification` (
  `id_auth` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `authentification`
--

INSERT INTO `authentification` (`id_auth`, `login`, `password`) VALUES
(35, 'vguillon', '$2y$10$A7bsuNWgse1sSgmkq99i7OsaW2CM7ClVAo8v7LLeVFroi2CfP7s1y'),
(36, 'taltazin', '$2y$10$V7MEOmCnA.wHRmbB3NB3u.xbA90JPuAfDFo7QcjYoo846upnhaW3m'),
(37, 'agelabert', '$2y$10$x8j2jHWQbqZK.da/9IMzreD11DtfHHHcRkhcSh23KA427sYEXD6Wy'),
(38, 'gpairot', '$2y$10$c5SGwNsUzgwJG7S3IvVAI.o3mhSo8wqt7p7ZjjRQh/wvsBsAjEDbu'),
(39, 'ahiver', '$2y$10$WF/62Pf3LFt1qyOtyuPyPO7hvhzK9g20Ghc3xKMBdAFnX4oSAgpve'),
(40, 'allan_dwyre', '$2y$10$tLPo.eKjYpo4/9YvyeTUZufKqF6HkxSQh.MlUHp674LZ4tzh8zU7e'),
(41, 'ahilmi', '$2y$10$hHeet/YbwJ5C/3j.2EJ/Mex4e99xYlUtN8gdsqIwieqdO9qdS39Pm'),
(42, 'tballini', '$2y$10$G0RkWdwuUD5iOSJg7fPsA.nThIMqMZYdhbTWq4IOzdLZFj01LjsaG'),
(43, 'cflatres', '$2y$10$1b6S5oinyfnyOVZGmCgyz.c0U50ml93ArcGe4YZ7tkL5di47DO2nO'),
(44, 'mbrugeaud', '$2y$10$WfN6o23mR.cWnkag5q3ke./9E6/KNnas1dm44YT9FsbefrvPenSFO'),
(45, 'gmekhelian', '$2y$10$ZsWqdgr9D8RVUjYAST0steoOzX1dkl47iVasc9zZ/03zPi9PRjuPi'),
(46, 'llegrand', '$2y$10$d1SOJK/MbNhR3Q1m7Brm8OkUZPRi8E5J136xI3BnOhk4LOQxpAiZq'),
(51, 'tjcochran', '$2y$10$It/pK60lfZBwKn4D8xyF5uKHnyny4YEdE2Omj8.cIUNmdLccnX9VG'),
(52, 'gnakach', '$2y$10$1i2z94KwAAMouVpkIKcWVeH.p7va/stn/22pEhVIuO8KKs50aQFi6'),
(53, 'acensi', '$2y$10$7ZP00Ygj7KGZySA0Mjo2kODstv6JJuJ3hQ7980wd6jZ8bbikaWYfW'),
(59, 'julie_ruellan', '$2y$10$.2cPJj97PYxPylG63Rrl0eeqlmUShw37msEX05gmVhj5gpCZBbYl2');

-- --------------------------------------------------------

--
-- Structure de la table `business`
--

CREATE TABLE `business` (
  `id_form` int(11) NOT NULL,
  `business_name` varchar(50) NOT NULL,
  `Activity_sector` varchar(50) NOT NULL,
  `Locality` varchar(50) NOT NULL,
  `Number_Cesi_trainees` varchar(50) NOT NULL,
  `Trainee_mark` decimal(5,0) NOT NULL,
  `Pilot_trust` decimal(5,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `business`
--

INSERT INTO `business` (`id_form`, `business_name`, `Activity_sector`, `Locality`, `Number_Cesi_trainees`, `Trainee_mark`, `Pilot_trust`) VALUES
(1, 'Googlee', 'Computer', 'Paris', '3', '8', '10'),
(2, 'Amazon', 'E-commerce', 'New', '8', '9', '9'),
(3, 'Apple', 'Electronic', 'Los Angeles', '2', '6', '8'),
(4, 'Eiffage', 'BTP', 'Montpellier', '10', '8', '4');

-- --------------------------------------------------------

--
-- Structure de la table `candidacy`
--

CREATE TABLE `candidacy` (
  `id_candidacy` int(11) NOT NULL,
  `step` int(11) NOT NULL,
  `accept` tinyint(1) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_offer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `candidacy`
--

INSERT INTO `candidacy` (`id_candidacy`, `step`, `accept`, `id_student`, `id_offer`) VALUES
(1, 2, 0, 11, 7),
(2, 6, 1, 8, 5);

-- --------------------------------------------------------

--
-- Structure de la table `inform`
--

CREATE TABLE `inform` (
  `id_notif` int(11) NOT NULL,
  `id_student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `informs`
--

CREATE TABLE `informs` (
  `id_pilot` int(11) NOT NULL,
  `id_notif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `internship_offers`
--

CREATE TABLE `internship_offers` (
  `id_offer` int(11) NOT NULL,
  `skills` varchar(50) NOT NULL,
  `localicy` varchar(50) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `remuneration` decimal(15,3) NOT NULL,
  `added_date` date DEFAULT NULL,
  `offer_date` date NOT NULL,
  `id_form` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `internship_offers`
--

INSERT INTO `internship_offers` (`id_offer`, `skills`, `localicy`, `duration`, `remuneration`, `added_date`, `offer_date`, `id_form`) VALUES
(5, 'Web DEV', 'Paris', '3 months', '590.000', '2022-03-01', '2022-04-04', 1),
(6, 'Database', 'New York City', '5 months', '680.000', '2022-02-20', '2022-03-24', 2),
(7, 'Embedded System', 'Los Angeles', '3 months', '550.000', '2022-04-01', '2022-05-02', 3),
(11, 'UX', 'Paris', '5', '530.000', '0000-00-00', '2022-04-22', 4);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id_notif` int(11) NOT NULL,
  `message` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id_permissions` int(11) NOT NULL,
  `Search_business` tinyint(1) NOT NULL,
  `Create_business` tinyint(1) NOT NULL,
  `Modify_business` tinyint(1) NOT NULL,
  `Evaluate_business` tinyint(1) NOT NULL,
  `Delete_business` tinyint(1) NOT NULL,
  `Consult_business_stats` tinyint(1) NOT NULL,
  `Search_offer` tinyint(1) NOT NULL,
  `Create_offer` tinyint(1) NOT NULL,
  `Modify_offer` tinyint(1) NOT NULL,
  `Delete_offer` tinyint(1) NOT NULL,
  `Consult_offer_stats` tinyint(1) NOT NULL,
  `Search_pilot_account` tinyint(1) NOT NULL,
  `Create_pilot_account` tinyint(1) NOT NULL,
  `Modify_pilot_account` tinyint(1) NOT NULL,
  `Delete_pilot_account` tinyint(1) NOT NULL,
  `Search_delegate_account` tinyint(1) NOT NULL,
  `Create_delegate_account` tinyint(1) NOT NULL,
  `Modify_delegate_account` tinyint(1) NOT NULL,
  `Delete_delegate_account` tinyint(1) NOT NULL,
  `Search_student_account` tinyint(1) NOT NULL,
  `Create_student_account` tinyint(1) NOT NULL,
  `Modify_student_account` tinyint(1) NOT NULL,
  `Delete_student_account` tinyint(1) NOT NULL,
  `Consult_student_account_stats` tinyint(1) NOT NULL,
  `Add_offer_to_wish-list` tinyint(1) NOT NULL,
  `Remove_offer_to_wish-list` tinyint(1) NOT NULL,
  `Apply_for_offer` tinyint(1) NOT NULL,
  `Inform_system_about_step_1_avancement` tinyint(1) NOT NULL,
  `Inform_system_about_step_2_avancement` tinyint(1) NOT NULL,
  `Inform_system_about_step_3_avancement` tinyint(1) NOT NULL,
  `Inform_system_about_step_4_avancement` tinyint(1) NOT NULL,
  `Inform_system_about_step_5_avancement` tinyint(1) NOT NULL,
  `Inform_system_about_step_6_avancement` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id_permissions`, `Search_business`, `Create_business`, `Modify_business`, `Evaluate_business`, `Delete_business`, `Consult_business_stats`, `Search_offer`, `Create_offer`, `Modify_offer`, `Delete_offer`, `Consult_offer_stats`, `Search_pilot_account`, `Create_pilot_account`, `Modify_pilot_account`, `Delete_pilot_account`, `Search_delegate_account`, `Create_delegate_account`, `Modify_delegate_account`, `Delete_delegate_account`, `Search_student_account`, `Create_student_account`, `Modify_student_account`, `Delete_student_account`, `Consult_student_account_stats`, `Add_offer_to_wish-list`, `Remove_offer_to_wish-list`, `Apply_for_offer`, `Inform_system_about_step_1_avancement`, `Inform_system_about_step_2_avancement`, `Inform_system_about_step_3_avancement`, `Inform_system_about_step_4_avancement`, `Inform_system_about_step_5_avancement`, `Inform_system_about_step_6_avancement`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 1, 1, 0, 0),
(3, 1, 1, 0, 0, 1, 0, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 1, 0),
(4, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `pilot`
--

CREATE TABLE `pilot` (
  `id_pilot` int(11) NOT NULL,
  `assigned_promotions` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pilot`
--

INSERT INTO `pilot` (`id_pilot`, `assigned_promotions`, `id_user`) VALUES
(1, 'CPI A2 INFO', 2),
(2, 'CPI A1', 4);

-- --------------------------------------------------------

--
-- Structure de la table `possesses`
--

CREATE TABLE `possesses` (
  `id_permissions` int(11) NOT NULL,
  `ID_Role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `possesses`
--

INSERT INTO `possesses` (`id_permissions`, `ID_Role`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `ID_Role` int(11) NOT NULL,
  `Nom_Role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`ID_Role`, `Nom_Role`) VALUES
(1, 'Admin'),
(2, 'Pilote'),
(3, 'Etudiant'),
(4, 'Délégué');

-- --------------------------------------------------------

--
-- Structure de la table `send`
--

CREATE TABLE `send` (
  `id_notif` int(11) NOT NULL,
  `id_form` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE `student` (
  `id_student` int(11) NOT NULL,
  `Promotion` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`id_student`, `Promotion`, `id_user`) VALUES
(1, 'CPI A2 INFO', 5),
(2, 'CPI A2 INFO', 6),
(3, 'CPI A2 INFO', 7),
(4, 'CPI A2 INFO', 8),
(5, 'CPI A2 INFO', 9),
(6, 'CPI A2 INFO', 10),
(7, 'CPI A2 INFO', 11),
(8, 'CPI A2 INFO', 12),
(9, 'CPI A1', 13),
(10, 'CPI A2 S3E', 15),
(11, 'CPI A2 S3E', 16);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `center` varchar(50) NOT NULL,
  `ID_Role` int(11) NOT NULL,
  `id_auth` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `firstname`, `lastname`, `email`, `center`, `ID_Role`, `id_auth`) VALUES
(1, 'Laura', 'Guillon', 'veronique.guillon@cesi.fr', 'MTP', 1, 35),
(2, 'Thomas', 'Altazin', 'thomas.altazin@cesi.fr', 'MTP', 2, 36),
(4, 'Alexandra', 'Gelabert', 'alexandra.gelabert@cesi.fr', 'MTP', 2, 37),
(5, 'Guillem', 'Pairot', 'guillem.pairot@viacesi.fr', 'MTP', 3, 38),
(6, 'Andrew', 'Hiver', 'andrew.hiver@viacesi.fr', 'MTP', 3, 39),
(7, 'Allan', 'Golding-Dwyre', 'allan.goldingdwyre@viacesi.fr', 'MTP', 3, 40),
(8, 'Aymane', 'Hilmi', 'aymane.hilmi@viacesi.fr', 'MTP', 3, 41),
(9, 'Thomas', 'Ballini', 'thomas.ballini@viacesi.fr', 'MTP', 3, 42),
(10, 'Cléa', 'Flatres', 'clea.flatres@viacesi.fr', 'MTP', 3, 43),
(11, 'Mathis', 'Brugeaud', 'mathis.brugeaud@viacesi.fr', 'MTP', 3, 44),
(12, 'Gautier', 'Mekhelian', 'gautier.mekhelian@viacesi.fr', 'MTP', 3, 45),
(13, 'Luca', 'Legrand', 'luca.legrand@viacesi.fr', 'MTP', 3, 46),
(14, 'Thommy J.', 'Cochran', 'thommyj.cochran@cesi.fr', 'NAN', 4, 51),
(15, 'Gabriel', 'Nakach', 'gabriel.nakach@viacesi.fr', 'TOU', 3, 52),
(16, 'Antonio', 'Cenci', 'antonio.cenci@viacesi.fr', 'TOU', 3, 53),
(21, 'Julie', 'Ruellan', 'julie.ruellan@gmail.com', 'MTP', 1, 59);

-- --------------------------------------------------------

--
-- Structure de la table `wish_list`
--

CREATE TABLE `wish_list` (
  `id_wish_list` int(11) NOT NULL,
  `Business_Name` varchar(50) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_offer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `wish_list`
--

INSERT INTO `wish_list` (`id_wish_list`, `Business_Name`, `id_student`, `id_offer`) VALUES
(1, 'Google', 4, 5),
(2, 'Amazon', 1, 6),
(24, 'Google', 2, 5),
(25, 'Amazon', 2, 6),
(29, 'Googlee', 7, 5),
(30, 'Apple', 7, 7),
(31, 'Googlee', 3, 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accept`
--
ALTER TABLE `accept`
  ADD PRIMARY KEY (`id_student`,`id_offer`),
  ADD KEY `accepter_Offre_de_Stage1_FK` (`id_offer`);

--
-- Index pour la table `authentification`
--
ALTER TABLE `authentification`
  ADD PRIMARY KEY (`id_auth`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Index pour la table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id_form`);

--
-- Index pour la table `candidacy`
--
ALTER TABLE `candidacy`
  ADD PRIMARY KEY (`id_candidacy`),
  ADD KEY `Candidature_Eleve0_FK` (`id_student`),
  ADD KEY `Candidature_Offre_de_Stage1_FK` (`id_offer`);

--
-- Index pour la table `inform`
--
ALTER TABLE `inform`
  ADD PRIMARY KEY (`id_notif`,`id_student`),
  ADD KEY `informe_Eleve1_FK` (`id_student`);

--
-- Index pour la table `informs`
--
ALTER TABLE `informs`
  ADD PRIMARY KEY (`id_pilot`,`id_notif`),
  ADD KEY `INFORMER_notification1_FK` (`id_notif`);

--
-- Index pour la table `internship_offers`
--
ALTER TABLE `internship_offers`
  ADD PRIMARY KEY (`id_offer`),
  ADD KEY `Offre_de_Stage_Entreprise0_FK` (`id_form`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id_notif`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id_permissions`);

--
-- Index pour la table `pilot`
--
ALTER TABLE `pilot`
  ADD PRIMARY KEY (`id_pilot`),
  ADD KEY `Pilote_User0_FK` (`id_user`);

--
-- Index pour la table `possesses`
--
ALTER TABLE `possesses`
  ADD PRIMARY KEY (`id_permissions`,`ID_Role`),
  ADD KEY `possede_Role1_FK` (`ID_Role`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID_Role`);

--
-- Index pour la table `send`
--
ALTER TABLE `send`
  ADD PRIMARY KEY (`id_notif`,`id_form`),
  ADD KEY `ENVOIE_Entreprise1_FK` (`id_form`);

--
-- Index pour la table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`),
  ADD KEY `Eleve_User0_FK` (`id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `User_Authentification0_AK` (`id_auth`),
  ADD KEY `User_Role0_FK` (`ID_Role`);

--
-- Index pour la table `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`id_wish_list`),
  ADD KEY `Wish_list_Offre_de_Stage0_FK` (`id_offer`),
  ADD KEY `Wish_list_Eleve0_AK` (`id_student`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `authentification`
--
ALTER TABLE `authentification`
  MODIFY `id_auth` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `business`
--
ALTER TABLE `business`
  MODIFY `id_form` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `candidacy`
--
ALTER TABLE `candidacy`
  MODIFY `id_candidacy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `internship_offers`
--
ALTER TABLE `internship_offers`
  MODIFY `id_offer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id_permissions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `pilot`
--
ALTER TABLE `pilot`
  MODIFY `id_pilot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `student`
--
ALTER TABLE `student`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `id_wish_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `accept`
--
ALTER TABLE `accept`
  ADD CONSTRAINT `accepter_Eleve0_FK` FOREIGN KEY (`id_student`) REFERENCES `student` (`id_student`),
  ADD CONSTRAINT `accepter_Offre_de_Stage1_FK` FOREIGN KEY (`id_offer`) REFERENCES `internship_offers` (`id_offer`);

--
-- Contraintes pour la table `candidacy`
--
ALTER TABLE `candidacy`
  ADD CONSTRAINT `Candidature_Eleve0_FK` FOREIGN KEY (`id_student`) REFERENCES `student` (`id_student`),
  ADD CONSTRAINT `Candidature_Offre_de_Stage1_FK` FOREIGN KEY (`id_offer`) REFERENCES `internship_offers` (`id_offer`);

--
-- Contraintes pour la table `inform`
--
ALTER TABLE `inform`
  ADD CONSTRAINT `informe_Eleve1_FK` FOREIGN KEY (`id_student`) REFERENCES `student` (`id_student`),
  ADD CONSTRAINT `informe_notification0_FK` FOREIGN KEY (`id_notif`) REFERENCES `notification` (`id_notif`);

--
-- Contraintes pour la table `informs`
--
ALTER TABLE `informs`
  ADD CONSTRAINT `INFORMER_Pilote0_FK` FOREIGN KEY (`id_pilot`) REFERENCES `pilot` (`id_pilot`),
  ADD CONSTRAINT `INFORMER_notification1_FK` FOREIGN KEY (`id_notif`) REFERENCES `notification` (`id_notif`);

--
-- Contraintes pour la table `internship_offers`
--
ALTER TABLE `internship_offers`
  ADD CONSTRAINT `Offre_de_Stage_Entreprise0_FK` FOREIGN KEY (`id_form`) REFERENCES `business` (`id_form`);

--
-- Contraintes pour la table `pilot`
--
ALTER TABLE `pilot`
  ADD CONSTRAINT `Pilote_User0_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `possesses`
--
ALTER TABLE `possesses`
  ADD CONSTRAINT `possede_Permissions0_FK` FOREIGN KEY (`id_permissions`) REFERENCES `permissions` (`id_permissions`),
  ADD CONSTRAINT `possede_Role1_FK` FOREIGN KEY (`ID_Role`) REFERENCES `role` (`ID_Role`);

--
-- Contraintes pour la table `send`
--
ALTER TABLE `send`
  ADD CONSTRAINT `ENVOIE_Entreprise1_FK` FOREIGN KEY (`id_form`) REFERENCES `business` (`id_form`),
  ADD CONSTRAINT `ENVOIE_notification0_FK` FOREIGN KEY (`id_notif`) REFERENCES `notification` (`id_notif`);

--
-- Contraintes pour la table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `Eleve_User0_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `User_Authentification1_FK` FOREIGN KEY (`id_auth`) REFERENCES `authentification` (`id_auth`),
  ADD CONSTRAINT `User_Role0_FK` FOREIGN KEY (`ID_Role`) REFERENCES `role` (`ID_Role`);

--
-- Contraintes pour la table `wish_list`
--
ALTER TABLE `wish_list`
  ADD CONSTRAINT `Wish_list_Eleve0_FK` FOREIGN KEY (`id_student`) REFERENCES `student` (`id_student`),
  ADD CONSTRAINT `Wish_list_Offre_de_Stage0_FK` FOREIGN KEY (`id_offer`) REFERENCES `internship_offers` (`id_offer`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
