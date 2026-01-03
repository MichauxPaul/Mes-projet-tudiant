-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 24 avr. 2025 à 21:06
-- Version du serveur : 10.5.27-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e50199u`
--

-- --------------------------------------------------------

--
-- Structure de la table `SDL_AUTHOR`
--

CREATE TABLE `SDL_AUTHOR` (
  `AR_Code` int(11) NOT NULL,
  `AR_Surname` varchar(50) NOT NULL,
  `AR_Firstname` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `SDL_AUTHOR`
--

INSERT INTO `SDL_AUTHOR` (`AR_Code`, `AR_Surname`, `AR_Firstname`) VALUES
(1, 'Calvin', 'Alex'),
(2, 'Schell', 'Jesse'),
(3, 'Billiotte', 'Julien'),
(4, 'Coelho', 'Paulo'),
(5, 'Tolkien', 'John Ronald Reuel'),
(6, 'Rowling', 'Joanne'),
(7, 'Doherty', 'Gordon'),
(8, 'Bowden', 'Oliver');

-- --------------------------------------------------------

--
-- Structure de la table `SDL_BILL`
--

CREATE TABLE `SDL_BILL` (
  `BL_Code` int(11) NOT NULL,
  `BL_Date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `SDL_BILL`
--

INSERT INTO `SDL_BILL` (`BL_Code`, `BL_Date`) VALUES
(1, '0000-00-00'),
(2, '0000-00-00'),
(3, '0000-00-00'),
(4, '0000-00-00'),
(64, '2025-04-24');

-- --------------------------------------------------------

--
-- Structure de la table `SDL_BOOK`
--

CREATE TABLE `SDL_BOOK` (
  `BK_Code` int(11) NOT NULL,
  `BK_Name` varchar(50) NOT NULL,
  `BK_Release` date NOT NULL,
  `BK_Cost` decimal(19,2) NOT NULL,
  `BK_Visual` varchar(200) NOT NULL,
  `BK_Description` varchar(1000) DEFAULT NULL,
  `TE_Code` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `SDL_BOOK`
--

INSERT INTO `SDL_BOOK` (`BK_Code`, `BK_Name`, `BK_Release`, `BK_Cost`, `BK_Visual`, `BK_Description`, `TE_Code`) VALUES
(1, 'Assassin\'s Creed 15è anniversaire le making off', '2023-10-03', 16.00, 'image1.webp', 'Découvrez la genèse de chaque opus, les secrets qui ont présidé à leur création, et les coulisses d\'une des plus grandes franchises de l\'industrie du jeu vidéo', 6),
(2, 'Alpine F1 Team Inside – Saison 2', '2022-11-10', 17.50, 'image2.webp', 'Enfilez de nouveau la combinaison frappée du A fléché, attachez votre ceinture et replongez dans les coulisses de la seule écurie française du plateau de Formule 1', 5),
(3, 'Alpine F1 Team Inside – Saison 3', '2023-11-23', 17.50, 'image3.webp', 'La marque au A fléché met le bleu de chauffe dans ce troisième volet de la série Alpine F1 Team Inside avec l\'arrivé de Pierre Gasly aux côté d\'Esteban Ocon. Les Normands forment un duo 100% français, inédit dans un sport aussi fascinant que secret et élitiste.', 5),
(4, 'L\'art du Game Design', '2022-02-10', 23.50, 'image4.webp', 'Le but de ce livre est de faire de vous le meilleur game designer possible. Il vous explique les principes fondamentaux des jeux et montre comment les tactiques utilisées dans les jeux de cartes, de plateau ou les jeux de plein air fonctionnent aussi pour les jeux vidéo.', 14),
(5, 'Harry Potter : À l\'École des Sorciers', '1997-06-26', 24.50, 'image5.webp', 'Le jour de ses onze ans, Harry Potter, un orphelin élevé par un oncle et une tante qui le détestent, voit son existence bouleversée. Un géant vient le chercher pour l\'emmener à Poudlard, une école de sorcellerie ! Voler en balai, jeter des sorts, combattre les trolls : Harry se révèle un sorcier doué. Mais un mystère entoure sa naissance et l\'effroyable V., le mage dont personne n\'ose prononcer le nom.', 7),
(6, 'Le Seigneur des Anneaux : La Fraternité de l\'Annea', '1954-07-29', 5.70, 'image6.webp', 'Prenant place dans le monde fictionnel de la Terre du Milieu, il suit la quête du hobbit Frodon Sacquet (Frodo Bessac), qui doit détruire l\'Anneau unique afin que celui-ci ne tombe pas entre les mains de Sauron, le Seigneur des ténèbres, qui l\'a créé. Plusieurs personnages lui viennent en aide, parmi lesquels son jardinier Sam, les hobbits Meriadoc et Peregrin (Merry et Pippin), le mage Gandalf ou encore l\'humain Aragorn, héritier d\'une longue lignée de rois.', 7),
(7, 'L\'Alchimiste', '1988-01-01', 3.75, 'image7.webp', 'Pour des millions de lecteurs dans le monde, ce livre a été une révélation : la clef d\'une quête spirituelle que chacun de nous peut entreprendre, l\'invitation à suivre son rêve pour y trouver sa vérité. L\'histoire est celle de Santiago, jeune berger andalou parti à la recherche d\'un trésor enfoui au pied des pyramides. Dans le désert, initié par l\'alchimiste, il apprendra à écouter son cour et à déchiffrer les signes du destin. Merveilleux conte philosophique, souvent comparé aux classiques du genre - Le Petit Prince, Jonathan Livingstone le goéland -, ce livre, devenu un best-seller international, a valu en France le Grand Prix des lectrices de Elle à l\'auteur du Pèlerin de Compostelle et de La Cinquième Montagne.', 7),
(8, 'Assassin\'s Creed, Tome 1 : Renaissance', '2010-04-09', 5.00, 'image8.webp', '« Je me vengerai de ceux qui ont trahi ma famille. Ezio est ma nouvelle identité. Assassin est ma destinée. »Trahi par les familles dirigeantes d’Italie, un jeune homme se lance dans une épique quête de vengeance. Afin d’éliminer la corruption et de rétablir l’honneur des siens, il deviendra un assassin. Il fera appel à la sagesse de grands esprits comme Léonard de Vinci ou Nicolas Machiavel, car il sait que sa survie dépend des dons qu’il doit développer. Aux yeux de ses alliés, il représente le changement car il combat pour la liberté et la justice. Mais ses ennemis le considèrent comme la pire des menaces car il a voué son existence à la destruction des tyrans qui oppriment le peuple d’Italie. Ainsi commence une histoire de pouvoir, de vengeance et de conspiration. La vérité s’écrit dans le sang.', 4),
(9, 'Assassin\'s Creed, Tome 2 : Brotherhood', '2011-01-21', 5.00, 'image9.webp', 'Rome, autrefois glorieuse, est désormais en ruine. Les citoyens vivent dans l\'ombre de l\'impitoyable famille Borgia. Un seul homme peut libérer le peuple de cette tyrannie : Ezio Auditore, le Maître Assassin. Il va transcender ses limites face à Césare Borgia, un homme aussi dangereux et malfaisant que son père, le pape. Et en ces temps troublés, la conspiration et la traîtrise sont partout... y compris au sein des rangs de la Confrérie.', 4),
(10, 'Assassin\'s Creed, Tome 3 : La Croisade Secrète', '2011-11-18', 5.00, 'image10.webp', 'Niccolò Polo, père de Marco, révèle enfin l\'histoire qu\'il a toute sa vie gardée secrète : celle d\'Altaïr, l\'un des Assassins les plus illustres qu\'ait jamais compté la fraternité. Pour prouver sa dévotion, Altaïr accepte d\'éliminer neuf redoutables adversaires, dont le Grand Maître Templier Robert de Sablé... Il est embarqué dans une aventure épique qui l\'entraîne jusqu\'en Terre Sainte.', 4),
(11, 'Assassin\'s Creed, Tome 4 : Révélations', '2011-11-07', 5.00, 'image11.webp', 'Le maître Assassin Ezio Auditore est plus aguerri et plus dangereux que jamais lorsqu’il part à la recherche de la légendaire bibliothèque d’Al taïr. C’est là que se cache depuis des siècles le secret qui mettra fin à la domination des Templiers. Mais une terrible découverte attend Ezio. Dans cette bibliothèque, le secret le mieux gardé du monde donne aux croisés le pouvoir d’asservir l’humanité. Pour percer le mystère, Ezio doit réunir pas moins de cinq clés. Ce chemin périlleux conduira l’Assassin jusqu’à Constantinople, le coeur de l’Empire ottoman, que l’armée des Templiers, en pleine expansion, menace de mettre à feu et à sang. Marchant dans les pas de son prédécesseur, le grand Altaïr, Ezio s’apprête à livrer son dernier combat contre les ennemis jurés des Assassins. L’enjeu n’a jamais été aussi décisif, et le pèlerinage tourne à la course contre la montre.', 4),
(12, 'Assassin\'s Creed, Tome 5 : Forsaken', '2012-11-23', 5.00, 'image12.webp', '« Je suis un maître des lames. Jamais je ne prends le moindre plaisir à tuer. Je suis simplement doué pour ça. » 1735 : Londres. Haytham Kenway a appris à manier l\'épée depuis qu\'il est capable d\'en tenir une. Alors, quand des hommes armés attaquent la demeure familiale, assassinent son père et enlèvent sa soeur, Haytham défend son foyer de la seule manière possible : il tue. Après ce drame, un mystérieux tuteur le prend sous son aile et l\'entraîne pour faire de lui un assassin redoutable. Consumé par sa soif de vengeance, Haytham se lance dans une véritable vendetta. Il ne se fie à personne et remet en question tout ce qu\'il a toujours connu. Conspirations et trahisons l\'assailliront de toutes parts tandis qu\'il plongera au coeur du conflit séculaire qui oppose les Assassins aux Templiers.', 4),
(13, 'Assassin\'s Creed, Tome 6 : Black Flag', '2013-10-31', 5.00, 'image13.webp', 'J\'étais hypnotisé par l\'homme cagoulé. Médusé par cet émissaire de la Faucheuse qui, faisant fi du carnage autour de lui, avait attendu son heure, patient, imperturbable, pour fondre sur sa cible. C\'est l\'âge d\'or de la piraterie et du Nouveau Monde. Attiré par les promesses de fortune de ces temps troublés, Edward Kenway, fils cabochard d\'un marchand de laine, rêve de prendre la mer en quête de gloire. Le jour où la chaumière familiale est attaquée, il juge le moment opportun pour fuir sa vie de misère. Très vite, il devient l\'un des plus redoutables pirates de son temps. Mais la convoitise, l\'ambition et la traîtrise sévissent dans son sillage et, lorsque Kenway découvre l\'existence d\'un terrible complot qui menace tout ce qui lui est cher, la vengeance devient son unique but. C\'est ainsi qu\'il va se retrouver propulsé au coeur de la lutte séculaire qui oppose les Assassins et les Templiers.', 4),
(14, 'Assassin\'s Creed, Tome 7 : Unity', '2013-11-13', 5.00, 'image14.webp', '1789 : La révolution est aux portes de Paris. Le peuple se dresse contre l\'oppression de l\'aristocratie, inondant de sang les rues pavées de la capitale. Mais la justice révolutionnaire se paie au prix fort... Alors que les inégalités entre les riches et les pauvres sont à leur paroxysme et que la nation se déchire, un jeune homme et une jeune femme tentent de se venger de tout ce dont on les a privés. Arno et Elise ne tardent pas à se retrouver plongés au beau milieu du conflit qui oppose les Assassins et les Templiers depuis plusieurs siècles déjà, dans un monde où les dangers sont plus redoutables qu\'ils l\'auraient imaginé.', 4),
(15, 'Assassin\'s Creed, Tome 8 : Underworld', '2015-11-02', 5.00, 'image15.webp', 'Un assassin en disgrâce. Un agent infiltré. Une quête de rédemption. 1862. Londres est à l’aube de la Révolution Industrielle, tandis qu’on y construit la première ligne de métropolitain au monde. La découverte d’un cadavre sur le chantier écrit un nouveau chapitre dans le combat séculaire entre Assassins et Templiers. Loin sous la surface, tapi dans l’ombre, un Assassin portant de lourds secrets doit mettre un terme à l’emprise des Templiers sur la capitale. La Confrérie le connaîtra bientôt sous le nom d’Henry Green, mentor de Jacob et d’Evie Frye. Pour l’heure, il est juste le Fantôme.', 4),
(16, 'Assassin\'s Creed, Tome 9 : Origins - Le Serment du', '2017-10-27', 5.00, 'image16.webp', 'Avant Assassin’s Creed : Origins, un Serment fut conclu. Égypte, en l’an 70 avant notre ère. Un impitoyable assassin sévit. Sa mission : trouver et tuer les derniers membres d’un ordre ancien, les Medjaÿ, et mettre un terme définitif à la lignée. Dans la paisible Siwa, le départ précipité du protecteur local laisse son jeune fils, Bayek, avec des questions sans réponse concernant son propre avenir et le sentiment qu’il a un devoir à accomplir. Bayek part à son tour en quête de réponses. Son périple le conduit sur les rives du Nil, à la découverte d’une Égypte en ébullition. Il emprunte sans le savoir la voie des Medjaÿ, une voie périlleuse et truffée de mystères…', 4),
(17, 'Assassin\'s Creed, Tome 10 : Odyssey', '2018-10-10', 5.00, 'image17.webp', 'Grèce, Ve siècle avant Jésus-Christ. Kassandra est une mercenaire au sang spartiate condamnée à mort par sa famille. Envoyée en exil, elle se lance dans un voyage épique pour devenir une héroïne de légende, et découvrir la vérité sur ses mystérieuses origines...', 4);

-- --------------------------------------------------------

--
-- Structure de la table `SDL_CLIENT`
--

CREATE TABLE `SDL_CLIENT` (
  `CT_Code` int(11) NOT NULL,
  `CT_Firstname` varchar(50) NOT NULL,
  `CT_Surname` varchar(50) NOT NULL,
  `CT_Password` varchar(100) NOT NULL,
  `CT_Email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `SDL_CLIENT`
--

INSERT INTO `SDL_CLIENT` (`CT_Code`, `CT_Firstname`, `CT_Surname`, `CT_Password`, `CT_Email`) VALUES
(1, 'Julien', 'Antoinette', 'fbc54207ecb55e318f9cb9aef6d01b9615b23268b0f1373a2476cc74624a7e8a', 'julien.antoinette@gmail.com'),
(2, 'Elie', 'Bernard', '3a4d5b86cfa208b50f1175f39165355a3b05a4ce8ef30fa6ee9ea326905efe9b', 'elie.bernard@gmail.com'),
(3, 'Gerald', 'Nicephore', '4f9d2695d2b3c2d8cafb7ab1f44b3d6b3a482876f0ffe5e21524d88c703e844a', 'gerald.nicephore@gmail.com'),
(4, 'Corrine', 'François-Xavier', '5a6e65f02af7661042a2a36d8eb6cf2b2f35b4d92b54eb93e01f573c604a74f8', 'corrine.françois-xavier@gmail.com'),
(5, 'Basile', 'Corun', '52cbf76b5b1b56ed87ae7ef784f1dbaaf0aad3842c9db62a8f295e69f113e1e8', 'basile.corun@gmail.com'),
(6, 'Leane', 'Patrie', '913e47776f46ec736e483b2cae6f111fe3a771626e4e6dfbe93b8b9ca056e0c8', 'leane.patrie@gmail.com'),
(7, 'Chrisine', 'Verene', 'd6506fc644135147a7e636a80a09f926ea80f5ebb64ab073fed12cab8cff79af', 'chrisine.verene@gmail.com'),
(8, 'Rolland', 'Rainier', '1dbd74c393e2ab8b5c9446875aa9716de5be8c7bfeda20d997eb448466a86062', 'rolland.rainier@gmail.com'),
(9, 'Killian', 'Jordan', 'e8bfe1ed693510570ced8b5ee70049cc4b985a77ec066ee345892f685d72cca6', 'killian.jordan@gmail.com'),
(10, 'Victoria', 'Elvire', '16cf76f547e3aa8ed571299a8c7917d1faa37edf56901c19a5af60bb1e0028eb', 'victoria.elvire@gmail.com'),
(11, 'Damien', 'Frederic', '9e77efec0676269d818bacef8fc19ec6fc3d03fef38428a0e58b9f640d02a99a', 'damien.frederic@gmail.com'),
(12, 'Frank', 'Martin', '39d3a2e969b3dec11478d65ecb96ee6066ebd98920c816df9de7d131d9c67d0c', 'frank.martin@gmail.com'),
(13, 'Gerald', 'Melody', 'cdae687418a1b542f785991623206c15a2bfe4eb1cf6fdbcc933beb7cbc5f30c', 'gerald .melody@gmail.com'),
(14, 'Gontran', 'Laure', '4dc3713a419f0d87b1409eb001607e8df27edc127a9dd93060d1abcb9faa2a87', 'gontran.laure@gmail.com'),
(15, 'Cecilia', 'Augustine', 'e7f8e37c3ee7b07d4a699cd1b95df9fdbcf147143c87da80fb21925856de7aa3', 'cecilia.augustine@gmail.com'),
(16, 'Odette', 'Jasmine', '7876ab82ad2df908f840d321b01fe60a7891c73e45f1857e7557e6f8295482e5', 'odette.jasmine@gmail.com'),
(17, 'Baptistine', 'Nolan', '71f90b7c03aad530eafa769b2ad97cb333ca6dd455fce1080bc0b302e4231220', 'baptistine.nolan@gmail.com'),
(18, 'Amandine', 'Casimir', '10984a55a146fba4e650eeae1141ee556ad280415e753909b346959b75aa608e', 'amandine.casimir@gmail.com'),
(19, 'Lucette', 'Ismael', 'd2387047c719e987bb7562747e4fa75f2bf0a92d4f3dfc8339fd7b63fe079dc2', 'lucette.ismael@gmail.com'),
(20, 'Leonce', 'Elise', '62875e5633fe8a4fe8bfd9070fe90c87fb9e1b7b4861abfe64acef5b4f891ad2', 'leonce.elise@gmail.com'),
(24, 'Paul', 'Michaux', '513dbbc7d7ab94bcd1933da71ce1e17922199351', 'paul.michaux9@etu.univ-lorraine.fr');

-- --------------------------------------------------------

--
-- Structure de la table `SDL_COVER`
--

CREATE TABLE `SDL_COVER` (
  `BK_Code` int(11) NOT NULL,
  `TH_Code` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `SDL_COVER`
--

INSERT INTO `SDL_COVER` (`BK_Code`, `TH_Code`) VALUES
(1, 17),
(2, 20),
(3, 20),
(4, 17),
(5, 2),
(6, 4),
(7, 11),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 4);

-- --------------------------------------------------------

--
-- Structure de la table `SDL_PUBLISH`
--

CREATE TABLE `SDL_PUBLISH` (
  `BK_Code` int(11) NOT NULL,
  `PR_Code` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `SDL_PUBLISH`
--

INSERT INTO `SDL_PUBLISH` (`BK_Code`, `PR_Code`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 3),
(5, 4),
(5, 5),
(6, 5),
(7, 10),
(8, 11),
(9, 11),
(10, 11),
(11, 11),
(12, 11),
(13, 11),
(14, 11),
(15, 11),
(16, 11),
(17, 11);

-- --------------------------------------------------------

--
-- Structure de la table `SDL_PUBLISHER`
--

CREATE TABLE `SDL_PUBLISHER` (
  `PR_Code` int(11) NOT NULL,
  `PR_Name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `SDL_PUBLISHER`
--

INSERT INTO `SDL_PUBLISHER` (`PR_Code`, `PR_Name`) VALUES
(1, 'Larousse'),
(2, 'Amphora'),
(3, 'Dunod'),
(4, 'Bloomsburry'),
(5, 'Gallimard'),
(6, 'Allen & Unwin'),
(7, 'Christian Bourgois'),
(8, 'Planeta'),
(9, 'Anne Carrière'),
(10, 'Flammarion'),
(11, '‎Bragelonne');

-- --------------------------------------------------------

--
-- Structure de la table `SDL_RATING`
--

CREATE TABLE `SDL_RATING` (
  `BK_Code` int(11) NOT NULL,
  `CT_Code` int(11) NOT NULL,
  `RG_Value` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `SDL_RATING`
--

INSERT INTO `SDL_RATING` (`BK_Code`, `CT_Code`, `RG_Value`) VALUES
(1, 24, 80);

-- --------------------------------------------------------

--
-- Structure de la table `SDL_RENTAL`
--

CREATE TABLE `SDL_RENTAL` (
  `BK_Code` int(11) NOT NULL,
  `CT_Code` int(11) NOT NULL,
  `BL_Code` int(11) NOT NULL,
  `RL_Start` datetime NOT NULL,
  `RL_End` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `SDL_RENTAL`
--

INSERT INTO `SDL_RENTAL` (`BK_Code`, `CT_Code`, `BL_Code`, `RL_Start`, `RL_End`) VALUES
(1, 1, 1, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(2, 1, 1, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(3, 1, 1, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(4, 1, 1, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(1, 2, 5, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(2, 2, 6, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(3, 2, 7, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(4, 2, 8, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(1, 3, 9, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(2, 3, 10, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(3, 3, 11, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(4, 3, 12, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(1, 4, 13, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(2, 4, 14, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(3, 4, 15, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(4, 4, 16, '2025-01-16 15:57:57', '2025-02-16 15:57:00'),
(1, 24, 64, '2025-04-24 00:00:00', '2025-05-25 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `SDL_THEME`
--

CREATE TABLE `SDL_THEME` (
  `TH_Code` int(11) NOT NULL,
  `TH_Name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `SDL_THEME`
--

INSERT INTO `SDL_THEME` (`TH_Code`, `TH_Name`) VALUES
(1, 'Amour'),
(2, 'Amitié'),
(3, 'Famille'),
(4, 'Voyage/Aventure'),
(5, 'Guerre'),
(6, 'Policier'),
(7, 'Surnaturel'),
(8, 'Gothique'),
(9, 'Horreur'),
(10, 'Utopie/Dystopie'),
(11, 'Introspection'),
(12, 'Écologie'),
(13, 'Destin'),
(14, 'Isolement'),
(15, 'Religion'),
(16, 'Spiritualité'),
(17, 'Art/Créativité'),
(18, 'I.A'),
(19, 'Technologie'),
(20, 'Sport'),
(21, 'Mort/immortalité');

-- --------------------------------------------------------

--
-- Structure de la table `SDL_TYPE`
--

CREATE TABLE `SDL_TYPE` (
  `TE_Code` int(11) NOT NULL,
  `TE_Name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `SDL_TYPE`
--

INSERT INTO `SDL_TYPE` (`TE_Code`, `TE_Name`) VALUES
(1, 'Roman'),
(2, 'Nouvelle'),
(3, 'Novella'),
(4, 'Bande-dessiné/Comics'),
(5, 'Documentaire'),
(6, 'Artbook'),
(7, 'Recueil'),
(8, 'Pièce de théâtre'),
(9, 'Manga'),
(10, 'Roman graphique'),
(11, 'Biographie/Autobiographie'),
(12, 'Essai'),
(13, 'Littérature jeunesse'),
(14, 'Explicatif');

-- --------------------------------------------------------

--
-- Structure de la table `SDL_WISHLIST`
--

CREATE TABLE `SDL_WISHLIST` (
  `CT_Code` int(11) NOT NULL,
  `BK_Code` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `SDL_WISHLIST`
--

INSERT INTO `SDL_WISHLIST` (`CT_Code`, `BK_Code`) VALUES
(24, 2);

-- --------------------------------------------------------

--
-- Structure de la table `SDL_WRITE`
--

CREATE TABLE `SDL_WRITE` (
  `BK_Code` int(11) NOT NULL,
  `AR_Code` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `SDL_WRITE`
--

INSERT INTO `SDL_WRITE` (`BK_Code`, `AR_Code`) VALUES
(1, 1),
(2, 3),
(3, 3),
(4, 2),
(5, 6),
(6, 5),
(7, 4),
(8, 8),
(9, 8),
(10, 8),
(11, 8),
(12, 8),
(13, 8),
(14, 8),
(15, 8),
(16, 8),
(17, 8);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `SDL_AUTHOR`
--
ALTER TABLE `SDL_AUTHOR`
  ADD PRIMARY KEY (`AR_Code`);

--
-- Index pour la table `SDL_BILL`
--
ALTER TABLE `SDL_BILL`
  ADD PRIMARY KEY (`BL_Code`);

--
-- Index pour la table `SDL_BOOK`
--
ALTER TABLE `SDL_BOOK`
  ADD PRIMARY KEY (`BK_Code`),
  ADD KEY `TE_Code` (`TE_Code`);

--
-- Index pour la table `SDL_CLIENT`
--
ALTER TABLE `SDL_CLIENT`
  ADD PRIMARY KEY (`CT_Code`);

--
-- Index pour la table `SDL_COVER`
--
ALTER TABLE `SDL_COVER`
  ADD PRIMARY KEY (`BK_Code`,`TH_Code`),
  ADD KEY `TH_Code` (`TH_Code`);

--
-- Index pour la table `SDL_PUBLISH`
--
ALTER TABLE `SDL_PUBLISH`
  ADD PRIMARY KEY (`BK_Code`,`PR_Code`),
  ADD KEY `PR_Code` (`PR_Code`);

--
-- Index pour la table `SDL_PUBLISHER`
--
ALTER TABLE `SDL_PUBLISHER`
  ADD PRIMARY KEY (`PR_Code`);

--
-- Index pour la table `SDL_RATING`
--
ALTER TABLE `SDL_RATING`
  ADD PRIMARY KEY (`BK_Code`,`CT_Code`),
  ADD KEY `CT_Code` (`CT_Code`);

--
-- Index pour la table `SDL_RENTAL`
--
ALTER TABLE `SDL_RENTAL`
  ADD PRIMARY KEY (`BK_Code`,`CT_Code`,`BL_Code`),
  ADD KEY `CT_Code` (`CT_Code`),
  ADD KEY `BL_Code` (`BL_Code`);

--
-- Index pour la table `SDL_THEME`
--
ALTER TABLE `SDL_THEME`
  ADD PRIMARY KEY (`TH_Code`);

--
-- Index pour la table `SDL_TYPE`
--
ALTER TABLE `SDL_TYPE`
  ADD PRIMARY KEY (`TE_Code`);

--
-- Index pour la table `SDL_WISHLIST`
--
ALTER TABLE `SDL_WISHLIST`
  ADD PRIMARY KEY (`CT_Code`,`BK_Code`);

--
-- Index pour la table `SDL_WRITE`
--
ALTER TABLE `SDL_WRITE`
  ADD PRIMARY KEY (`BK_Code`,`AR_Code`),
  ADD KEY `AR_Code` (`AR_Code`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `SDL_AUTHOR`
--
ALTER TABLE `SDL_AUTHOR`
  MODIFY `AR_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `SDL_BILL`
--
ALTER TABLE `SDL_BILL`
  MODIFY `BL_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `SDL_BOOK`
--
ALTER TABLE `SDL_BOOK`
  MODIFY `BK_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `SDL_CLIENT`
--
ALTER TABLE `SDL_CLIENT`
  MODIFY `CT_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `SDL_PUBLISHER`
--
ALTER TABLE `SDL_PUBLISHER`
  MODIFY `PR_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `SDL_THEME`
--
ALTER TABLE `SDL_THEME`
  MODIFY `TH_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `SDL_TYPE`
--
ALTER TABLE `SDL_TYPE`
  MODIFY `TE_Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
