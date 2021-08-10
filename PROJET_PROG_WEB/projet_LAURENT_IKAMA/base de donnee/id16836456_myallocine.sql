-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 19 mai 2021 à 20:55
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP : 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `id16836456_myallocine`
--

-- --------------------------------------------------------

--
-- Structure de la table `ACTEUR`
--

CREATE TABLE `ACTEUR` (
  `acteur_id` int(5) NOT NULL,
  `acteur_nom` varchar(25) NOT NULL,
  `acteur_iso` char(3) NOT NULL,
  `acteur_photo` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ACTEUR`
--

INSERT INTO `ACTEUR` (`acteur_id`, `acteur_nom`, `acteur_iso`, `acteur_photo`) VALUES
(1, 'Millie Bobby Brown', 'ESP', 'A1'),
(2, ' Sam Claflin', 'GBR', 'A2'),
(3, 'Keiko Yokozawa', 'JPN', 'A3'),
(4, 'Mayumi Tanaka', 'JPN', 'A4'),
(5, 'Christian Clavier', 'FRA', 'A5'),
(6, 'Chantal Lauby', 'FRA', 'A6'),
(7, 'Saoirse Ronan', 'USA', 'A7'),
(8, 'Timothée Chalamet', 'USA', 'A8'),
(9, 'Anna Kendrick', 'USA', 'A9'),
(10, 'Rebel Wilson', 'USA', 'A10'),
(11, 'Chris Pratt', 'USA', 'A11'),
(12, 'Zoe Saldana', 'USA', 'A12'),
(13, 'Hayden Christensen', 'CAN', 'A13'),
(14, 'Ewan McGregor', 'GBR', 'A14'),
(15, 'Jenna Ortega', 'USA', 'A15'),
(16, 'Jennifer Garner', 'USA', 'A16'),
(17, 'Anna Popplewell', 'GBR', 'A17'),
(18, 'Liam Neeson', 'IRL', 'A18'),
(19, 'George MacKay', 'GBR', 'A19'),
(20, 'Dean-Charles Chapman', 'GBR', 'A20'),
(21, 'K. J. Apa', 'NZL', 'A21'),
(22, 'Alexandra Daddario', 'USA', 'A22'),
(23, 'Robert Downey Jr.', 'USA', 'A23'),
(24, 'Gwyneth Paltrow', 'USA', 'A24'),
(25, 'Octavia Spencer', 'USA', 'A25'),
(26, 'Diana Silvers', 'USA', 'A26'),
(27, 'Shanann Watts', 'USA', 'A27'),
(28, 'Nickole Atkinson', 'USA', 'A28'),
(29, 'Viola Davis', 'USA', 'A29'),
(30, 'Emma Stone', 'USA', 'A30'),
(31, 'Taraji P. Henson', 'USA', 'A31'),
(32, 'Janelle Monáe', 'USA', 'A32'),
(33, 'Mahershala Ali', 'USA', 'A33'),
(34, 'Viggo Mortensen', 'USA', 'A34');

-- --------------------------------------------------------

--
-- Structure de la table `CATEGORIE`
--

CREATE TABLE `CATEGORIE` (
  `categorie_id` int(3) NOT NULL,
  `categorie_nom` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CATEGORIE`
--

INSERT INTO `CATEGORIE` (`categorie_id`, `categorie_nom`) VALUES
(1, 'Drame'),
(2, 'Comédie'),
(3, 'Comédie dramatique'),
(4, 'Documentaire'),
(5, 'Fantastique'),
(6, 'Science-fiction'),
(7, 'Horreur'),
(8, 'Comédie musicales'),
(9, 'Guerre'),
(10, 'Histoire'),
(11, 'Action'),
(12, 'Anime'),
(13, 'Français'),
(14, 'Mystère'),
(15, 'Policier'),
(16, 'Jeunesse'),
(17, 'Thriller'),
(18, 'Famille'),
(19, 'Indépendant'),
(20, 'Romance');

-- --------------------------------------------------------

--
-- Structure de la table `EST`
--

CREATE TABLE `EST` (
  `est_film` int(3) NOT NULL,
  `est_categorie` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `EST`
--

INSERT INTO `EST` (`est_film`, `est_categorie`) VALUES
(1, 11),
(1, 18),
(2, 18),
(3, 11),
(3, 18),
(4, 15),
(5, 12),
(6, 2),
(6, 13),
(7, 3),
(8, 8),
(9, 11),
(10, 6),
(11, 18),
(12, 5),
(12, 16),
(13, 9),
(13, 10),
(14, 17),
(15, 11),
(15, 18),
(16, 7),
(17, 4),
(18, 1),
(19, 1),
(20, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ETOILE`
--

CREATE TABLE `ETOILE` (
  `etoile_id` int(3) NOT NULL,
  `etoile_nombre` int(1) NOT NULL,
  `etoile_commentaire` varchar(255) DEFAULT NULL,
  `etoile_film` int(3) NOT NULL,
  `etoile_utilisateur` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ETOILE`
--

INSERT INTO `ETOILE` (`etoile_id`, `etoile_nombre`, `etoile_commentaire`, `etoile_film`, `etoile_utilisateur`) VALUES
(1, 3, NULL, 19, NULL),
(2, 3, NULL, 19, NULL),
(3, 3, NULL, 19, NULL),
(4, 5, NULL, 19, NULL),
(5, 5, NULL, 19, NULL),
(6, 2, NULL, 19, NULL),
(7, 3, NULL, 19, NULL),
(8, 1, NULL, 19, NULL),
(9, 4, NULL, 19, NULL),
(10, 3, NULL, 19, NULL),
(11, 5, NULL, 5, NULL),
(12, 4, NULL, 4, NULL),
(13, 4, NULL, 5, NULL),
(14, 5, NULL, 5, NULL),
(15, 3, NULL, 20, NULL),
(16, 2, NULL, 7, NULL),
(17, 1, NULL, 7, NULL),
(18, 1, NULL, 7, NULL),
(19, 4, NULL, 7, NULL),
(20, 5, NULL, 5, NULL),
(21, 5, NULL, 5, NULL),
(22, 3, NULL, 5, NULL),
(23, 3, NULL, 2, NULL),
(24, 4, NULL, 2, NULL),
(25, 5, NULL, 2, NULL),
(26, 1, NULL, 2, NULL),
(27, 1, NULL, 2, NULL),
(28, 5, NULL, 2, NULL),
(29, 5, NULL, 2, NULL),
(30, 5, NULL, 2, NULL),
(31, 5, NULL, 2, NULL),
(32, 5, NULL, 2, NULL),
(33, 5, NULL, 2, NULL),
(34, 5, NULL, 2, NULL),
(35, 5, NULL, 2, NULL),
(36, 3, NULL, 5, NULL),
(37, 3, NULL, 9, NULL),
(38, 4, NULL, 3, NULL),
(39, 2, NULL, 12, NULL),
(40, 1, NULL, 12, NULL),
(41, 4, NULL, 12, NULL),
(42, 4, NULL, 12, NULL),
(43, 3, NULL, 4, NULL),
(44, 2, NULL, 4, NULL),
(45, 3, NULL, 4, NULL),
(46, 5, NULL, 4, NULL),
(47, 4, NULL, 4, NULL),
(48, 3, NULL, 4, NULL),
(49, 3, NULL, 4, NULL),
(50, 2, NULL, 4, NULL),
(51, 1, NULL, 4, NULL),
(52, 5, NULL, 4, NULL),
(53, 4, NULL, 4, NULL),
(54, 4, NULL, 4, NULL),
(55, 3, NULL, 1, NULL),
(56, 3, NULL, 7, NULL),
(57, 4, NULL, 7, NULL),
(58, 4, NULL, 18, NULL),
(59, 4, NULL, 18, NULL),
(60, 1, NULL, 18, NULL),
(61, 4, NULL, 1, NULL),
(62, 1, NULL, 1, NULL),
(63, 3, NULL, 6, NULL),
(64, 5, NULL, 6, NULL),
(65, 1, NULL, 6, NULL),
(66, 3, NULL, 6, NULL),
(67, 4, NULL, 6, NULL),
(68, 4, NULL, 6, NULL),
(69, 1, NULL, 6, NULL),
(70, 1, NULL, 6, NULL),
(71, 2, NULL, 17, NULL),
(72, 4, NULL, 17, NULL),
(73, 4, NULL, 10, NULL),
(74, 3, NULL, 11, NULL),
(75, 1, NULL, 17, NULL),
(76, 3, NULL, 15, NULL),
(77, 3, NULL, 18, NULL),
(78, 5, NULL, 18, NULL),
(79, 3, NULL, 13, NULL),
(80, 3, NULL, 13, NULL),
(81, 1, NULL, 14, NULL),
(82, 1, NULL, 13, NULL),
(83, 1, NULL, 13, NULL),
(84, 1, NULL, 13, NULL),
(85, 1, NULL, 13, NULL),
(86, 1, NULL, 13, NULL),
(87, 1, NULL, 13, NULL),
(88, 1, NULL, 13, NULL),
(89, 1, NULL, 13, NULL),
(90, 5, NULL, 13, NULL),
(91, 4, NULL, 13, NULL),
(92, 3, NULL, 13, NULL),
(93, 2, NULL, 13, NULL),
(94, 1, NULL, 13, NULL),
(95, 3, NULL, 13, NULL),
(96, 3, NULL, 13, NULL),
(97, 1, NULL, 13, NULL),
(98, 3, NULL, 13, NULL),
(99, 2, NULL, 13, NULL),
(100, 3, NULL, 13, NULL),
(101, 4, NULL, 13, NULL),
(102, 5, NULL, 13, NULL),
(103, 1, NULL, 13, NULL),
(104, 2, NULL, 13, NULL),
(105, 3, NULL, 13, NULL),
(106, 3, NULL, 1, NULL),
(107, 2, NULL, 1, NULL),
(108, 2, NULL, 1, NULL),
(109, 1, NULL, 1, NULL),
(110, 2, NULL, 1, NULL),
(111, 3, NULL, 1, NULL),
(112, 1, NULL, 1, NULL),
(113, 1, NULL, 1, NULL),
(114, 1, NULL, 1, NULL),
(115, 1, NULL, 1, NULL),
(116, 2, NULL, 1, NULL),
(117, 3, NULL, 1, NULL),
(118, 3, NULL, 1, NULL),
(119, 2, NULL, 1, NULL),
(120, 3, NULL, 1, NULL),
(121, 4, NULL, 1, NULL),
(122, 5, NULL, 1, NULL),
(123, 5, NULL, 1, NULL),
(124, 3, NULL, 1, NULL),
(125, 4, NULL, 1, NULL),
(126, 4, NULL, 18, NULL),
(127, 5, NULL, 18, NULL),
(128, 5, NULL, 18, NULL),
(129, 3, NULL, 18, NULL),
(130, 1, NULL, 18, NULL),
(131, 4, NULL, 18, NULL),
(132, 3, NULL, 19, NULL),
(133, 5, NULL, 19, NULL),
(134, 1, NULL, 19, NULL),
(135, 3, NULL, 19, NULL),
(136, 4, NULL, 19, NULL),
(137, 5, NULL, 19, NULL),
(138, 3, NULL, 19, NULL),
(139, 1, NULL, 19, NULL),
(140, 3, NULL, 19, NULL),
(141, 4, NULL, 1, NULL),
(142, 4, NULL, 1, NULL),
(143, 4, NULL, 1, NULL),
(144, 4, NULL, 1, NULL),
(145, 4, NULL, 1, NULL),
(146, 4, NULL, 1, NULL),
(147, 4, NULL, 1, NULL),
(148, 4, NULL, 1, NULL),
(149, 4, NULL, 1, NULL),
(150, 4, NULL, 1, NULL),
(151, 4, NULL, 1, NULL),
(152, 4, NULL, 1, NULL),
(153, 5, NULL, 1, NULL),
(154, 5, NULL, 1, NULL),
(155, 3, NULL, 18, NULL),
(156, 3, NULL, 18, NULL),
(157, 5, NULL, 5, NULL),
(158, 4, NULL, 18, NULL),
(159, 4, NULL, 18, NULL),
(160, 4, NULL, 18, NULL),
(161, 4, NULL, 18, NULL),
(162, 4, NULL, 18, NULL),
(163, 4, NULL, 18, NULL),
(164, 5, NULL, 18, NULL),
(165, 5, NULL, 18, NULL),
(166, 5, NULL, 18, NULL),
(167, 5, NULL, 18, NULL),
(168, 5, NULL, 18, NULL),
(169, 5, NULL, 18, NULL),
(170, 5, NULL, 18, NULL),
(171, 2, NULL, 9, NULL),
(172, 3, NULL, 18, NULL),
(173, 3, NULL, 1, NULL),
(174, 3, NULL, 1, NULL),
(175, 3, NULL, 2, NULL),
(176, 3, NULL, 2, NULL),
(177, 3, NULL, 2, NULL),
(178, 3, NULL, 2, NULL),
(179, 3, NULL, 2, NULL),
(180, 3, NULL, 2, NULL),
(181, 3, NULL, 2, NULL),
(182, 3, NULL, 2, NULL),
(183, 3, NULL, 2, NULL),
(184, 3, NULL, 2, NULL),
(185, 3, NULL, 2, NULL),
(186, 3, NULL, 2, NULL),
(187, 3, NULL, 2, NULL),
(188, 3, NULL, 2, NULL),
(189, 3, NULL, 2, NULL),
(190, 3, NULL, 20, NULL),
(191, 5, NULL, 12, NULL),
(192, 5, NULL, 8, NULL),
(193, 5, NULL, 8, NULL),
(194, 5, NULL, 8, NULL),
(195, 5, NULL, 17, NULL),
(196, 5, NULL, 17, NULL),
(197, 1, NULL, 17, NULL),
(198, 3, NULL, 1, NULL),
(199, 2, NULL, 1, NULL),
(200, 3, NULL, 1, NULL),
(201, 3, NULL, 1, NULL),
(202, 3, NULL, 1, NULL),
(203, 3, NULL, 1, NULL),
(204, 3, NULL, 1, NULL),
(205, 3, NULL, 1, NULL),
(206, 5, NULL, 17, NULL),
(207, 3, NULL, 1, NULL),
(208, 3, NULL, 1, NULL),
(209, 3, NULL, 1, NULL),
(210, 3, NULL, 1, NULL),
(211, 3, NULL, 1, NULL),
(212, 3, NULL, 1, NULL),
(213, 5, NULL, 8, NULL),
(214, 3, NULL, 8, NULL),
(215, 2, NULL, 8, NULL),
(216, 3, NULL, 8, NULL),
(217, 4, NULL, 8, NULL),
(218, 3, NULL, 8, NULL),
(219, 2, NULL, 8, NULL),
(220, 5, NULL, 8, NULL),
(221, 3, NULL, 8, NULL),
(222, 3, NULL, 8, NULL),
(223, 3, NULL, 8, NULL),
(224, 3, NULL, 8, NULL),
(225, 3, NULL, 8, NULL),
(226, 4, NULL, 8, NULL),
(227, 2, NULL, 8, NULL),
(228, 2, NULL, 8, NULL),
(229, 2, NULL, 8, NULL),
(230, 2, NULL, 8, NULL),
(231, 2, NULL, 8, NULL),
(232, 4, NULL, 8, NULL),
(233, 4, NULL, 8, NULL),
(234, 5, NULL, 8, NULL),
(235, 5, NULL, 8, NULL),
(236, 3, NULL, 8, NULL),
(237, 3, NULL, 8, NULL),
(238, 4, NULL, 8, NULL),
(239, 4, NULL, 8, NULL),
(240, 2, NULL, 8, NULL),
(241, 4, NULL, 8, NULL),
(242, 4, NULL, 8, NULL),
(243, 4, NULL, 8, NULL),
(244, 5, NULL, 8, NULL),
(245, 5, NULL, 8, NULL),
(246, 5, NULL, 8, NULL),
(247, 4, NULL, 8, NULL),
(248, 4, NULL, 8, NULL),
(249, 4, NULL, 8, NULL),
(250, 4, NULL, 8, NULL),
(251, 4, NULL, 8, NULL),
(252, 4, NULL, 8, NULL),
(253, 4, NULL, 8, NULL),
(254, 4, NULL, 8, NULL),
(255, 4, NULL, 8, NULL),
(256, 4, NULL, 8, NULL),
(257, 4, NULL, 8, NULL),
(258, 4, NULL, 8, NULL),
(259, 4, NULL, 8, NULL),
(260, 4, NULL, 8, NULL),
(261, 4, NULL, 8, NULL),
(262, 4, NULL, 8, NULL),
(263, 4, NULL, 8, NULL),
(264, 4, NULL, 8, NULL),
(265, 4, NULL, 8, NULL),
(266, 4, NULL, 8, NULL),
(267, 4, NULL, 8, NULL),
(268, 3, NULL, 8, NULL),
(269, 3, NULL, 8, NULL),
(270, 3, NULL, 8, NULL),
(271, 3, NULL, 8, NULL),
(272, 3, NULL, 8, NULL),
(273, 3, NULL, 8, NULL),
(274, 3, NULL, 8, NULL),
(275, 3, NULL, 8, NULL),
(276, 3, NULL, 8, NULL),
(277, 3, NULL, 8, NULL),
(278, 3, NULL, 8, NULL),
(279, 3, NULL, 8, NULL),
(280, 3, NULL, 8, NULL),
(281, 3, NULL, 8, NULL),
(282, 3, NULL, 8, NULL),
(283, 3, NULL, 8, NULL),
(284, 3, NULL, 8, NULL),
(285, 3, NULL, 8, NULL),
(286, 3, NULL, 8, NULL),
(287, 3, NULL, 8, NULL),
(288, 3, NULL, 8, NULL),
(289, 3, NULL, 8, NULL),
(290, 3, NULL, 8, NULL),
(291, 3, NULL, 8, NULL),
(292, 3, NULL, 8, NULL),
(293, 3, NULL, 8, NULL),
(294, 3, NULL, 8, NULL),
(295, 3, NULL, 8, NULL),
(296, 3, NULL, 8, NULL),
(297, 3, NULL, 8, NULL),
(298, 3, NULL, 8, NULL),
(299, 3, NULL, 8, NULL),
(300, 3, NULL, 8, NULL),
(301, 3, NULL, 8, NULL),
(302, 5, NULL, 8, NULL),
(303, 5, NULL, 8, NULL),
(304, 5, NULL, 8, NULL),
(305, 5, NULL, 8, NULL),
(306, 5, NULL, 8, NULL),
(307, 5, NULL, 8, NULL),
(308, 5, NULL, 8, NULL),
(309, 5, NULL, 8, NULL),
(310, 5, NULL, 8, NULL),
(311, 5, NULL, 8, NULL),
(312, 3, NULL, 7, NULL),
(313, 3, NULL, 20, NULL),
(314, 4, NULL, 20, NULL),
(315, 4, NULL, 1, NULL),
(316, 4, NULL, 1, NULL),
(317, 4, NULL, 1, NULL),
(318, 4, NULL, 1, NULL),
(319, 4, NULL, 1, NULL),
(320, 4, NULL, 1, NULL),
(321, 4, NULL, 1, NULL),
(322, 4, NULL, 1, NULL),
(323, 5, NULL, 1, NULL),
(324, 5, NULL, 1, NULL),
(325, 5, NULL, 1, NULL),
(326, 5, NULL, 1, NULL),
(327, 5, NULL, 1, NULL),
(328, 5, NULL, 1, NULL),
(329, 5, NULL, 1, NULL),
(330, 5, NULL, 1, NULL),
(331, 5, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `FILM`
--

CREATE TABLE `FILM` (
  `film_id` int(3) NOT NULL,
  `film_titre` varchar(255) NOT NULL,
  `film_iso` char(3) NOT NULL,
  `film_minutes` int(3) NOT NULL,
  `film_annee` year(4) NOT NULL,
  `film_photo` int(5) NOT NULL,
  `film_realisateur` int(3) NOT NULL,
  `film_synopsis` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `FILM`
--

INSERT INTO `FILM` (`film_id`, `film_titre`, `film_iso`, `film_minutes`, `film_annee`, `film_photo`, `film_realisateur`, `film_synopsis`) VALUES
(1, 'Avengers', 'USA', 143, 2012, 10, 1, 'Lorsque Nick Fury, le directeur du S.H.I.E.L.D., l\'organisation qui préserve la paix au plan mondial, cherche à former une équipe de choc pour empêcher la destruction du monde, Iron Man, Hulk, Thor, Captain America, Hawkeye et Black Widow répondent présents.'),
(2, 'Avengers:  L\'Ere d\'Ultron', 'USA', 142, 2015, 20, 1, 'Alors que Tony Stark tente de relancer un programme de maintien de la paix jusque-là suspendu, les choses tournent mal et les super-héros Iron Man, Captain America, Thor, Hulk, Black Widow et Hawkeye vont devoir à nouveau unir leurs forces pour combattre le plus puissant de leurs adversaires : le terrible Ultron, un être technologique terrifiant qui s’est juré d’éradiquer l’espèce humaine.\r\nAfin d’empêcher celui-ci d’accomplir ses sombres desseins, des alliances inattendues se scellent, les entraînant dans une incroyable aventure et une haletante course contre le temps…'),
(3, 'Avengers: Infinity War', 'USA', 149, 2018, 30, 1, 'Les Avengers et leurs alliés devront être prêts à tout sacrifier pour neutraliser le redoutable Thanos avant que son attaque éclair ne conduise à la destruction complète de l’univers.'),
(4, 'Enola Holmes', 'GBR', 123, 2020, 40, 2, 'Enola, la jeune sœur de Sherlock Holmes, met ses talents de détective à l\'épreuve pour tenter de retrouver sa mère disparue et déjouer une dangereuse conspiration.'),
(5, 'Le Château dans le ciel', 'JPN', 124, 1986, 50, 3, 'Retenue prisonnière par des pirates dans un dirigeable, la jeune Sheeta saute dans le vide en tentant de leur échapper. Elle est sauvée in extremis par Pazu, un jeune pilote d\'avion travaillant dans une cité minière. Les pirates leur donnent la chasse.\r\n\r\nAu terme d\'une course-poursuite effrénée, Sheeta se confie à Pazu, lui avouant qu\'elle est la descendante des souverains de Laputa, la cité mythique située dans les airs. Elle est par conséquent la seule détentrice du secret de Laputa que le chef des armées, le cruel Muska, cherche à percer.'),
(6, 'Qu\'est ce qu\'on a fait au bon dieu?', 'FRA', 97, 2014, 60, 4, 'Claude et Marie Verneuil, issus de la grande bourgeoisie catholique provinciale sont des parents plutôt \"vieille France\". Mais ils se sont toujours obligés à faire preuve d\'ouverture d\'esprit...Les pilules furent cependant bien difficiles à avaler quand leur première fille épousa un musulman, leur seconde un juif et leur troisième un chinois.\r\nLeurs espoirs de voir enfin l\'une d\'elles se marier à l\'église se cristallisent donc sur la cadette, qui, alléluia, vient de rencontrer un bon catholique.'),
(7, 'Lady Bird', 'USA', 95, 2017, 70, 5, 'Christine « Lady Bird » McPherson se bat désespérément pour ne pas ressembler à sa mère, aimante mais butée et au fort caractère, qui travaille sans relâche en tant qu’infirmière pour garder sa famille à flot après que le père de Lady Bird a perdu son emploi.'),
(8, 'The Hit Girls', 'USA', 112, 2012, 80, 6, 'Beca est le genre de fille qui préfère écouter son lecteur MP3 que la personne assise en face d\'elle. Fraîchement arrivée à la fac, elle a du mal à y trouver sa place. Elle intègre alors, plus ou moins contre son gré, une clique de filles qu\'elle n\'aurait jamais considérées abordables ou fréquentables : un mélange de pestes, de bonnes pâtes et d\'originales dont le seul point commun est la perfection avec laquelle elles chantent a cappella. Et quand la nouvelle venue les initie, au-delà des arrangements traditionnels et des harmonies classiques, à des interprétations et des combinaisons musicales novatrices, toutes se rallient à son ambition d\'accéder au sommet du podium dans cet univers impitoyable qu\'est celui du chant a cappella à l\'université, ce qui pourrait bien s\'avérer la chose la plus cool qu\'elles aient jamais faite, ou la plus folle.'),
(9, 'Les gardiens de la Galaxie', 'USA', 124, 2014, 90, 9, 'Peter Quill est un aventurier traqué par tous les chasseurs de primes pour avoir volé un mystérieux globe convoité par le puissant Ronan, dont les agissements menacent l’univers tout entier. Lorsqu’il découvre le véritable pouvoir de ce globe et la menace qui pèse sur la galaxie, il conclut une alliance fragile avec quatre aliens disparates : Rocket, un raton laveur fin tireur, Groot, un humanoïde semblable à un arbre, l’énigmatique et mortelle Gamora, et Drax le Destructeur, qui ne rêve que de vengeance. En les ralliant à sa cause, il les convainc de livrer un ultime combat aussi désespéré soit-il pour sauver ce qui peut encore l’être …'),
(10, 'Star Wars, épisode III : La Revanche des Sith', 'USA', 140, 2025, 100, 10, 'La Guerre des Clones fait rage. Une franche hostilité oppose désormais le Chancelier Palpatine au Conseil Jedi. Anakin Skywalker, jeune Chevalier Jedi pris entre deux feux, hésite sur la conduite à tenir. Séduit par la promesse d\'un pouvoir sans précédent, tenté par le côté obscur de la Force, il prête allégeance au maléfique Darth Sidious et devient Dark Vador.\r\nLes Seigneurs Sith s\'unissent alors pour préparer leur revanche, qui commence par l\'extermination des Jedi. Seuls rescapés du massacre, Yoda et Obi Wan se lancent à la poursuite des Sith. La traque se conclut par un spectaculaire combat au sabre entre Anakin et Obi Wan, qui décidera du sort de la galaxie.'),
(11, 'Yes Day', 'USA', 86, 2021, 110, 7, 'Un couple de parents décide de dire \"oui\" à tout pendant 24 heures. Avec leurs demandes les plus folles, ses enfants lui font passer une journée mémorable.'),
(12, 'Le Monde de Narnia : Le Lion, la Sorcière blanche et l\'Armoire magique', 'USA', 150, 2005, 120, 8, 'Happés à l’intérieur d’un intriguant tableau, Edmund et Lucy Pevensie, ainsi que leur détestable cousin Eustache, se retrouvent subitement projetés dans le royaume de Narnia, à bord d’un navire majestueux : le Passeur d’Aurore.\r\nRejoignant Caspian, devenu roi, et l’intrépide souris guerrière Ripitchip, ils embarquent pour une périlleuse mission dont dépend le sort même de Narnia. A la recherche de sept seigneurs disparus, nos voyageurs entament un envoûtant périple vers les îles mystérieuses de l’Est, où ils ne manqueront pas de rencontrer tant de créatures magiques que de merveilles inimaginables. Mais ils devront surtout vaincre leurs peurs les plus profondes en affrontant de sinistres ennemis, tout en résistant à de terribles tentations auxquelles ils seront confrontés. \r\nIl est temps pour eux de faire preuve d’un courage légendaire au cours d’une odyssée qui les transformera à jamais et les emportera au bout du monde, où le grand Lion Aslan les attend.'),
(13, '1917', 'GBR', 119, 2019, 130, 11, 'Pris dans la tourmente de la Première Guerre Mondiale, Schofield et Blake, deux jeunes soldats britanniques, se voient assigner une mission à proprement parler impossible. Porteurs d’un message qui pourrait empêcher une attaque dévastatrice et la mort de centaines de soldats, dont le frère de Blake, ils se lancent dans une véritable course contre la montre, derrière les lignes ennemies.'),
(14, 'Songbird', 'USA', 90, 2020, 140, 12, 'Cela fait maintenant quatre ans que le monde vit en confinement. Désormais, les personnes infectées du Covid-23 sont envoyées de force en quarantaine dans des camps devenus peu à peu d’inquiétants ghettos. A Los Angeles, Nico est un coursier immunisé au virus qui arpente la ville lors de ses livraisons. C’est ainsi qu’il fait la connaissance de Sara, une jeune femme confinée chez elle. Malgré les impératifs sanitaires qui les empêchent de s’approcher, Sara et Nico tombent amoureux. Mais lorsque Sara est suspectée d’être contaminée, elle est contrainte de rejoindre les camps de quarantaine. Nico tente alors l’impossible pour la sauver.'),
(15, 'Iron Man', 'USA', 126, 2008, 150, 13, 'Tony Stark, inventeur de génie, vendeur d\'armes et playboy milliardaire, est kidnappé en Aghanistan. Forcé par ses ravisseurs de fabriquer une arme redoutable, il construit en secret une armure high-tech révolutionnaire qu\'il utilise pour s\'échapper. Comprenant la puissance de cette armure, il décide de l\'améliorer et de l\'utiliser pour faire régner la justice et protéger les innocents.'),
(16, 'Ma', 'USA', 98, 2019, 160, 14, 'Sue Ann, une femme solitaire vit dans une petite ville de l’Ohio. Un jour, une adolescente ayant récemment emménagé, lui demande d’acheter de l’alcool pour elle et ses amis ; Sue Ann y voit la possibilité de se faire de nouveaux amis plus jeunes qu’elle. Elle propose aux adolescents de traîner et de boire en sûreté dans le sous-sol aménagé de sa maison. Mais Sue Ann a quelques règles : ne pas blasphémer, l’adolescent qui conduit doit rester sobre, ne jamais monter dans sa maison et l’appeler MA. Mais l’hospitalité de MA commence à virer à l’obsession. Le sous-sol qui au début était pour les adolescents l’endroit rêvé pour faire la fête va devenir le pire endroit sur terre.'),
(17, 'American Murder: The Family Next Door', 'USA', 82, 2020, 170, 15, 'Le récit de la disparition de Shanann Watts et de ses deux filles au Colorado en 2018.'),
(18, 'La couleur des sentiments', 'USA', 147, 2011, 180, 14, 'Dans la petite ville de Jackson, Mississippi, durant les années 60, trois femmes que tout devait opposer vont nouer une incroyable amitié. Elles sont liées par un projet secret qui les met tout en danger, l’écriture d’un livre qui remet en cause les conventions sociales les plus sensibles de leur époque... '),
(19, 'Les Figures de l\'ombre', 'USA', 127, 2016, 190, 16, 'Le destin extraordinaire des trois scientifiques afro-américaines qui ont permis aux États-Unis de prendre la tête de la conquête spatiale, grâce à la mise en orbite de l’astronaute John Glenn. \r\n\r\nMaintenues dans l’ombre de leurs collègues masculins et dans celle d’un pays en proie à de profondes inégalités, leur histoire longtemps restée méconnue est enfin portée à l’écran.'),
(20, 'Green Book : Sur les routes du Sud', 'USA', 130, 2018, 200, 17, 'En 1962, alors que règne la ségrégation, Tony Lip, un videur italo-américain du Bronx, est engagé pour conduire et protéger le Dr Don Shirley, un pianiste noir de renommée mondiale, lors d’une tournée de concerts. Durant leur périple de Manhattan jusqu’au Sud profond, ils s’appuient sur le Green Book pour dénicher les établissements accueillant les personnes de couleur, où l’on ne refusera pas de servir Shirley et où il ne sera ni humilié ni maltraité.\r\n\r\nDans un pays où le mouvement des droits civiques commence à se faire entendre, les deux hommes vont être confrontés au pire de l’âme humaine, dont ils se guérissent grâce à leur générosité et leur humour. Ensemble, ils vont devoir dépasser leurs préjugés, oublier ce qu’ils considéraient comme des différences insurmontables, pour découvrir leur humanité commune. ');

-- --------------------------------------------------------

--
-- Structure de la table `MESSAGE`
--

CREATE TABLE `MESSAGE` (
  `message_id` int(110) NOT NULL,
  `message_utilisateur` int(3) NOT NULL,
  `message_film` int(3) DEFAULT NULL,
  `message_acteur` int(5) DEFAULT NULL,
  `message_realisateur` int(3) DEFAULT NULL,
  `message_valeur` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `MESSAGE`
--

INSERT INTO `MESSAGE` (`message_id`, `message_utilisateur`, `message_film`, `message_acteur`, `message_realisateur`, `message_valeur`) VALUES
(1, 1, 18, NULL, NULL, 'J\'adore ce film'),
(2, 1, NULL, 17, NULL, 'Super actrice !'),
(3, 2, 18, NULL, NULL, 'Moi aussi ^^'),
(4, 2, NULL, 7, NULL, 'super actrice!');

-- --------------------------------------------------------

--
-- Structure de la table `REALISATEUR`
--

CREATE TABLE `REALISATEUR` (
  `realisateur_id` int(3) NOT NULL,
  `realisateur_nom` varchar(25) NOT NULL,
  `realisateur_iso` char(3) NOT NULL,
  `realisateur_photo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `REALISATEUR`
--

INSERT INTO `REALISATEUR` (`realisateur_id`, `realisateur_nom`, `realisateur_iso`, `realisateur_photo`) VALUES
(1, 'Whedon Joss', 'USA', 'R1'),
(2, 'Harry Bradbeer', 'GBR', 'R2'),
(3, 'Hayao Miyazaki', 'JPN', 'R3'),
(4, 'Philippe de Chauveron', 'FRA', 'R4'),
(5, 'Greta Gerwig', 'USA', 'R5'),
(6, 'Trish Sie', 'USA', 'R6'),
(7, 'Miguel Arteta', 'PRI', 'R7'),
(8, ' Andrew Adamson', 'NZL', 'R8'),
(9, 'James Gunn', 'USA', 'R9'),
(10, 'George Lucas', 'USA', 'R10'),
(11, 'Sam Mendes', 'GBR', 'R11'),
(12, 'Adam Mason', 'GBR', 'R12'),
(13, 'Jon Favreau', 'USA', 'R13'),
(14, 'Tate Taylor', 'USA', 'R14'),
(15, 'Jenny Popplewell', 'USA', 'R15'),
(16, 'Theodore Melfi', 'USA', 'R16'),
(17, 'Peter Farrelly', 'USA', 'R17');

-- --------------------------------------------------------

--
-- Structure de la table `TRAVAILLE`
--

CREATE TABLE `TRAVAILLE` (
  `travaille_film` int(3) NOT NULL,
  `travaille_acteur` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `TRAVAILLE`
--

INSERT INTO `TRAVAILLE` (`travaille_film`, `travaille_acteur`) VALUES
(1, 23),
(1, 24),
(2, 23),
(2, 24),
(3, 23),
(3, 24),
(4, 1),
(4, 2),
(5, 3),
(5, 4),
(6, 5),
(6, 6),
(7, 7),
(7, 8),
(8, 9),
(8, 10),
(9, 11),
(9, 12),
(10, 13),
(10, 14),
(11, 15),
(11, 16),
(12, 17),
(12, 18),
(13, 19),
(13, 20),
(14, 21),
(14, 22),
(15, 23),
(15, 24),
(16, 25),
(16, 26),
(17, 27),
(17, 28),
(18, 25),
(18, 29),
(18, 30),
(19, 25),
(19, 31),
(19, 32),
(20, 33),
(20, 34);

-- --------------------------------------------------------

--
-- Structure de la table `UTILISATEUR`
--

CREATE TABLE `UTILISATEUR` (
  `utilisateur_id` int(3) NOT NULL,
  `utilisateur_nom` varchar(25) NOT NULL,
  `utilisateur_prenom` varchar(25) NOT NULL,
  `utilisateur_mail` varchar(25) NOT NULL,
  `utilisateur_mdp` varchar(20) NOT NULL,
  `couleur` varchar(10) NOT NULL,
  `police` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `UTILISATEUR`
--

INSERT INTO `UTILISATEUR` (`utilisateur_id`, `utilisateur_nom`, `utilisateur_prenom`, `utilisateur_mail`, `utilisateur_mdp`, `couleur`, `police`) VALUES
(1, 'Laurent', 'Jessica', 'jessica@laurent.com', 'mawqi7-nAmmus-cochax', 'yellow', ''),
(2, 'Ikama', 'Sarra', 'sarra@ikama.com', 'nabcat-Xuxto9-mofsyj', 'pink', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ACTEUR`
--
ALTER TABLE `ACTEUR`
  ADD PRIMARY KEY (`acteur_id`);

--
-- Index pour la table `CATEGORIE`
--
ALTER TABLE `CATEGORIE`
  ADD PRIMARY KEY (`categorie_id`);

--
-- Index pour la table `EST`
--
ALTER TABLE `EST`
  ADD PRIMARY KEY (`est_film`,`est_categorie`),
  ADD KEY `fk_est_categorie` (`est_categorie`);

--
-- Index pour la table `ETOILE`
--
ALTER TABLE `ETOILE`
  ADD PRIMARY KEY (`etoile_id`),
  ADD KEY `fk_etoile_film` (`etoile_film`),
  ADD KEY `fk_etoile_utilisateur` (`etoile_utilisateur`);

--
-- Index pour la table `FILM`
--
ALTER TABLE `FILM`
  ADD PRIMARY KEY (`film_id`),
  ADD KEY `fk_film_realisateur` (`film_realisateur`);

--
-- Index pour la table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `message_utilisateur` (`message_utilisateur`),
  ADD KEY `message_film` (`message_film`),
  ADD KEY `message_acteur` (`message_acteur`),
  ADD KEY `message_realisateur` (`message_realisateur`);

--
-- Index pour la table `REALISATEUR`
--
ALTER TABLE `REALISATEUR`
  ADD PRIMARY KEY (`realisateur_id`);

--
-- Index pour la table `TRAVAILLE`
--
ALTER TABLE `TRAVAILLE`
  ADD PRIMARY KEY (`travaille_film`,`travaille_acteur`),
  ADD KEY `fk_travaille_acteur` (`travaille_acteur`);

--
-- Index pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  ADD PRIMARY KEY (`utilisateur_id`),
  ADD UNIQUE KEY `utilisateur_mail` (`utilisateur_mail`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `EST`
--
ALTER TABLE `EST`
  ADD CONSTRAINT `fk_est_categorie` FOREIGN KEY (`est_categorie`) REFERENCES `CATEGORIE` (`categorie_id`),
  ADD CONSTRAINT `fk_est_film` FOREIGN KEY (`est_film`) REFERENCES `FILM` (`film_id`);

--
-- Contraintes pour la table `ETOILE`
--
ALTER TABLE `ETOILE`
  ADD CONSTRAINT `fk_etoile_film` FOREIGN KEY (`etoile_film`) REFERENCES `FILM` (`film_id`),
  ADD CONSTRAINT `fk_etoile_utilisateur` FOREIGN KEY (`etoile_utilisateur`) REFERENCES `UTILISATEUR` (`utilisateur_id`);

--
-- Contraintes pour la table `FILM`
--
ALTER TABLE `FILM`
  ADD CONSTRAINT `fk_film_realisateur` FOREIGN KEY (`film_realisateur`) REFERENCES `REALISATEUR` (`realisateur_id`);

--
-- Contraintes pour la table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD CONSTRAINT `MESSAGE_ibfk_1` FOREIGN KEY (`message_utilisateur`) REFERENCES `UTILISATEUR` (`utilisateur_id`),
  ADD CONSTRAINT `MESSAGE_ibfk_2` FOREIGN KEY (`message_film`) REFERENCES `FILM` (`film_id`),
  ADD CONSTRAINT `MESSAGE_ibfk_3` FOREIGN KEY (`message_acteur`) REFERENCES `ACTEUR` (`acteur_id`),
  ADD CONSTRAINT `MESSAGE_ibfk_4` FOREIGN KEY (`message_realisateur`) REFERENCES `REALISATEUR` (`realisateur_id`);

--
-- Contraintes pour la table `TRAVAILLE`
--
ALTER TABLE `TRAVAILLE`
  ADD CONSTRAINT `fk_travaille_acteur` FOREIGN KEY (`travaille_acteur`) REFERENCES `ACTEUR` (`acteur_id`),
  ADD CONSTRAINT `fk_travaille_film` FOREIGN KEY (`travaille_film`) REFERENCES `FILM` (`film_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
