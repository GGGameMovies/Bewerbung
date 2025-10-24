-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: db5015689286.hosting-data.io
-- Erstellungszeit: 23. Okt 2025 um 19:10
-- Server-Version: 10.6.15-MariaDB-1:10.6.15+maria~deb11-log
-- PHP-Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `dbs12804397`
--
CREATE DATABASE IF NOT EXISTS `dbs12804397` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_bin;
USE `dbs12804397`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `besucher`
--

CREATE TABLE `besucher` (
  `BesucherID` int(11) NOT NULL,
  `Benutzername` varchar(64) DEFAULT NULL,
  `Passwort` varchar(64) DEFAULT NULL,
  `Email` varchar(64) DEFAULT NULL,
  `Profilbild` varchar(64) DEFAULT NULL,
  `Pruefcode` varchar(64) DEFAULT NULL,
  `Bgeprueft` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Daten für Tabelle `besucher`
--

INSERT INTO `besucher` (`BesucherID`, `Benutzername`, `Passwort`, `Email`, `Profilbild`, `Pruefcode`, `Bgeprueft`) VALUES
(1, 'ggame', '$2y$10$YJRT5U07i5W5plaGXv5Ide4K4ENPdhLn5p9fqvKYOsbaYhIR1lxcS', 'alphagame1988@gmail.com', NULL, 'ca1e239e405bf90628a332e303c01184', 1),
(2, 'gg_gamemovie', '$2y$10$Y5J2TjilyiKJoGAM3my01.Sa0MJWYJukj9kUy2/KHx6ezdnR.kRhG', 'danielgonzalez1988@web.de', NULL, 'e348ff6a64537efdc16c8ccab0412117', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bewertungen`
--

CREATE TABLE `bewertungen` (
  `BewertungID` int(11) NOT NULL,
  `BesucherID` int(11) DEFAULT NULL,
  `SpielID` int(11) DEFAULT NULL,
  `GameplayB` int(11) DEFAULT NULL,
  `GraphicB` int(11) DEFAULT NULL,
  `StoryB` int(11) DEFAULT NULL,
  `AIB` int(11) DEFAULT NULL,
  `CreativityB` int(11) DEFAULT NULL,
  `ImmersionB` int(11) DEFAULT NULL,
  `SoundB` int(11) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `genres`
--

CREATE TABLE `genres` (
  `GenreID` int(11) NOT NULL,
  `GenreName` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `genres`
--

INSERT INTO `genres` (`GenreID`, `GenreName`) VALUES
(1, 'Action'),
(23, 'Action-Adventure'),
(26, 'Action-Rollenspiel'),
(8, 'Adventure'),
(7, 'Battle Royale'),
(13, 'Beat em Up'),
(21, 'Cardgame'),
(10, 'Escape Room'),
(14, 'Fighting'),
(31, 'Hack and Slay'),
(4, 'Hack-and-Slash'),
(6, 'Idle'),
(17, 'MMORPGs'),
(5, 'MOBA'),
(28, 'Party'),
(2, 'Point-and-Click-Adventures'),
(12, 'Puzzle'),
(15, 'Rennspiele'),
(16, 'Rhythmusspiel'),
(30, 'Rogue-like '),
(3, 'Roguelike'),
(24, 'RPG'),
(19, 'Sandbox'),
(11, 'Shooter'),
(29, 'Simulation'),
(25, 'Sports'),
(18, 'Stealth'),
(33, 'Survival Horror'),
(22, 'Tabletop'),
(20, 'Tower Defense'),
(9, 'Visual Novels');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `minispiel`
--

CREATE TABLE `minispiel` (
  `MinispielID` int(11) NOT NULL,
  `Charakter` varchar(64) DEFAULT NULL,
  `Orte` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plattform`
--

CREATE TABLE `plattform` (
  `PlattformID` int(11) NOT NULL,
  `PlattformName` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `plattform`
--

INSERT INTO `plattform` (`PlattformID`, `PlattformName`) VALUES
(19, ' Android'),
(23, 'Amazon Luna'),
(17, 'GeForce Now'),
(18, 'iOS'),
(10, 'Mobile'),
(12, 'New Nintendo 3DS'),
(11, 'Nintendo 3DS'),
(4, 'Nintendo Switch'),
(1, 'PC'),
(14, 'PS3'),
(5, 'PS4'),
(2, 'PS5'),
(13, 'Wii U'),
(15, 'Xbox 360'),
(6, 'Xbox One'),
(3, 'Xbox X');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `player`
--

CREATE TABLE `player` (
  `PlayerID` int(11) NOT NULL,
  `PlayerName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `player`
--

INSERT INTO `player` (`PlayerID`, `PlayerName`) VALUES
(9, ' Online-KOOP'),
(4, 'Couch-Koop'),
(2, 'Lokaler-Multiplayer'),
(7, 'Multiplayer'),
(3, 'Online-Koop'),
(5, 'Online-Multiplayer'),
(1, 'Singleplayer');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ps`
--

CREATE TABLE `ps` (
  `PSID` int(11) NOT NULL,
  `PSName` varchar(64) DEFAULT NULL,
  `PSLogo` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `ps`
--

INSERT INTO `ps` (`PSID`, `PSName`, `PSLogo`) VALUES
(1, 'Nintendo', '/bilder/Logo/Nintendo.png'),
(2, 'Sony Interactive Entertainment', '/bilder/Logo/Sony_Interactive_Entertainment.png'),
(3, 'Xbox Game Studios', '/bilder/Logo/Xbox_Game_Studios.png'),
(4, 'EA', '/bilder/Logo/EA.png'),
(5, 'Activision Blizzard', '/bilder/Logo/Activision_Blizzard.png'),
(6, 'Square Enix', '/bilder/Logo/Square_Enix.png'),
(7, 'Bethesda', '/bilder/Logo/Bethesda.png'),
(8, 'Valve Corporation', '/bilder/Logo/Valve_Corporation.png'),
(9, 'Epic Games', '/bilder/Logo/Epic_Games.png'),
(10, 'Capcom', '/bilder/Logo/Capcom.png'),
(11, 'Bandai Namco Entertainment', '/bilder/Logo/Bandai_Namco_Entertainment.png'),
(12, 'Sega', '/bilder/Logo/Sega.png'),
(13, '2K Games', '/bilder/Logo/2K_Games.png'),
(14, 'Naughty Dog', '/bilder/Logo/Naughty_Dog.png'),
(15, 'Insomniac Games', '/bilder/Logo/Insomniac_Games.png'),
(16, 'BioWare', '/bilder/Logo/BioWare.png'),
(17, 'FromSoftware', '/bilder/Logo/FromSoftware.png'),
(18, 'Bungie', '/bilder/Logo/Bungie.png'),
(19, 'Konami', '/bilder/Logo/Konami.png'),
(20, 'Gearbox Software', '/bilder/Logo/Gearbox_Software.png'),
(21, 'Mojang Studios', '/bilder/Logo/Mojang_Studios.png'),
(22, 'Riot Games', '/bilder/Logo/Riot_Games.png'),
(23, 'Remedy Entertainment', '/bilder/Logo/Remedy_Entertainment.png'),
(24, 'Guerrilla Games', '/bilder/Logo/Guerrilla_Games.png'),
(25, 'Firaxis Games', '/bilder/Logo/Firaxis_Games.png'),
(26, 'PlatinumGames', '/bilder/Logo/PlatinumGames.png'),
(27, 'Treyarch', '/bilder/Logo/Treyarch.png'),
(28, 'id Software', '/bilder/Logo/id_Software.png'),
(29, 'Kojima Productions', '/bilder/Logo/Kojima_Productions.png'),
(30, 'Telltale Games', '/bilder/Logo/Telltale_Games.png'),
(31, 'NetherRealm Studios', '/bilder/Logo/NetherRealm_Studios.png'),
(32, 'Sucker Punch Productions', '/bilder/Logo/Sucker_Punch_Productions.png'),
(33, 'Monolith Productions', '/bilder/Logo/Monolith_Productions.png'),
(34, 'Crystal Dynamics', '/bilder/Logo/Crystal_Dynamics.png'),
(35, 'DICE', '/bilder/Logo/DICE.png'),
(36, 'Obsidian Entertainment', '/bilder/Logo/Obsidian_Entertainment.png'),
(37, 'Playground Games', '/bilder/Logo/Playground_Games.png'),
(38, 'Polyphony Digital', '/bilder/Logo/Polyphony_Digital.png'),
(39, 'Respawn Entertainment', '/bilder/Logo/Respawn_Entertainment.png'),
(40, 'ZeniMax Online Studios', '/bilder/Logo/ZeniMax_Online_Studios.png'),
(41, 'Hangar 13', '/bilder/Logo/Hangar_13.png'),
(42, 'Raven Software', '/bilder/Logo/Raven_Software.png'),
(43, 'Arkane Studios', '/bilder/Logo/Arkane_Studios.png'),
(44, 'Supermassive Games', '/bilder/Logo/Supermassive_Games.png'),
(45, 'Dontnod Entertainment', '/bilder/Logo/Dontnod_Entertainment.png'),
(46, 'Codemasters', '/bilder/Logo/Codemasters.png'),
(47, 'Gearbox Publishing', '/bilder/Logo/Gearbox_Publishing.png'),
(48, 'Hello Games', '/bilder/Logo/Hello_Games.png'),
(49, 'Housemarque', '/bilder/Logo/Housemarque.png'),
(50, 'Tripwire Interactive', '/bilder/Logo/Tripwire_Interactive.png'),
(51, 'Digital Extremes', '/bilder/Logo/Digital_Extremes.png'),
(52, 'Psyonix', '/bilder/Logo/Psyonix.png'),
(53, 'Paradox Interactive', '/bilder/Logo/Paradox_Interactive.png'),
(54, 'Klei Entertainment', '/bilder/Logo/Klei_Entertainment.png'),
(55, 'Double Fine Productions', '/bilder/Logo/Double_Fine_Productions.png'),
(56, 'Tequila Works', '/bilder/Logo/Tequila_Works.png'),
(57, '11 bit studios', '/bilder/Logo/11_bit_studios.png'),
(58, 'Ninja Theory', '/bilder/Logo/Ninja_Theory.png'),
(59, 'Chucklefish', '/bilder/Logo/Chucklefish.png'),
(60, 'Lab Zero Games', '/bilder/Logo/Lab_Zero_Games.png'),
(61, 'Supergiant Games', '/bilder/Logo/Supergiant_Games.png'),
(62, 'Annapurna Interactive', '/bilder/Logo/Annapurna_Interactive.png'),
(63, 'DrinkBox Studios', '/bilder/Logo/DrinkBox_Studios.png'),
(64, 'Yacht Club Games', '/bilder/Logo/Yacht_Club_Games.png'),
(65, 'Stoic Studio', '/bilder/Logo/Stoic_Studio.png'),
(66, 'Motion Twin', '/bilder/Logo/Motion_Twin.png'),
(67, 'WayForward Technologies', '/bilder/Logo/WayForward_Technologies.png'),
(68, 'MercurySteam', '/bilder/Logo/MercurySteam.png'),
(69, 'Moon Studios', '/bilder/Logo/Moon_Studios.png'),
(70, 'Roll7', '/bilder/Logo/Roll7.png'),
(71, 'Image & Form Games', '/bilder/Logo/Image_&_Form_Games.png'),
(72, 'Thunder Lotus Games', '/bilder/Logo/Thunder_Lotus_Games.png'),
(73, 'Devolver Digital', '/bilder/Logo/Devolver_Digital.png'),
(74, 'Gaijin Entertainment', '/bilder/Logo/Gaijin_Entertainment.png'),
(75, 'Rebellion Developments', '/bilder/Logo/Rebellion_Developments.png'),
(76, '343 Industries', '/bilder/Logo/343_Industries.png'),
(77, 'GSC Game World', '/bilder/Logo/GSC_Game_World.png'),
(78, 'Red Barrels', '/bilder/Logo/Red_Barrels.png'),
(79, 'Team17', '/bilder/Logo/Team17.png'),
(80, 'CI Games', '/bilder/Logo/CI_Games.png'),
(81, 'Fatshark', '/bilder/Logo/Fatshark.png'),
(82, 'tinyBuild', '/bilder/Logo/tinyBuild.png'),
(83, 'Asobo Studio', '/bilder/Logo/Asobo_Studio.png'),
(84, 'Frogwares', '/bilder/Logo/Frogwares.png'),
(85, '4A Games', '/bilder/Logo/4A_Games.png'),
(86, 'Bloober Team', '/bilder/Logo/Bloober_Team.png'),
(87, 'IO Interactive', '/bilder/Logo/IO_Interactive.png'),
(88, 'Kylotonn', '/bilder/Logo/Kylotonn.png'),
(89, 'Mimimi Games', '/bilder/Logo/Mimimi_Games.png'),
(90, 'Quantic Dream', '/bilder/Logo/Quantic_Dream.png'),
(91, 'Spiders', '/bilder/Logo/Spiders.png'),
(92, 'Compulsion Games', '/bilder/Logo/Compulsion_Games.png'),
(93, '4J Studios', '/bilder/Logo/4J_Studios.png'),
(94, 'The Creative Assembly', '/bilder/Logo/The_Creative_Assembly.png'),
(95, 'Creative Assembly', '/bilder/Logo/Creative_Assembly_Sofia.png'),
(96, 'Relic Entertainment', '/bilder/Logo/Relic_Entertainment.png'),
(97, 'High Moon Studios', '/bilder/Logo/High_Moon_Studios.png'),
(98, 'Certain Affinity', '/bilder/Logo/Certain_Affinity.png'),
(99, 'Vicarious Visions', '/bilder/Logo/Vicarious_Visions.png'),
(100, 'Toys for Bob', '/bilder/Logo/Toys_for_Bob.png'),
(101, 'Infinity Ward', '/bilder/Logo/Infinity_Ward.png'),
(102, 'Rocksteady Studios', '/bilder/Logo/Rocksteady_Studios.png'),
(103, 'WB Games Montréal', '/bilder/Logo/WB_Games_Montreal.png'),
(109, 'Techland', '/bilder/Logo/Techland.png'),
(110, 'People Can Fly', '/bilder/Logo/People_Can_Fly.png'),
(114, 'Focus Home Interactive', '/bilder/Logo/Focus_Home_Interactive.png'),
(118, 'Deck Nine', '/bilder/Logo/Deck_Nine.png'),
(123, 'Mimimi Productions', '/bilder/Logo/Mimimi_Productions.png'),
(125, 'Avalanche Studios', '/bilder/Logo/Avalanche_Studios.png'),
(126, 'Gunfire Games', '/bilder/Logo/Gunfire_Games.png'),
(127, 'WayForward', '/bilder/Logo/WayForward.png'),
(129, 'Tango Gameworks', '/bilder/Logo/Tango_Gameworks.png'),
(130, 'Bluepoint Games', '/bilder/Logo/Bluepoint_Games.png'),
(131, 'Team Cherry', '/bilder/Logo/Team_Cherry.png'),
(135, 'Playdead', '/bilder/Logo/Playdead.png'),
(138, 'Playtonic Games', '/bilder/Logo/Playtonic_Games.png'),
(139, 'Ready at Dawn', '/bilder/Logo/Ready_at_Dawn.png'),
(140, 'Camelot Software Planning', '/bilder/Logo/Camelot_Software_Planning.png'),
(141, 'Maxis', '/bilder/Logo/Maxis.png'),
(148, 'Thatgamecompany', '/bilder/Logo/Thatgamecompany.png'),
(151, 'Larian Studios', '/bilder/Logo/Larian_Studios.png'),
(154, 'Behaviour Interactive', '/bilder/Logo/Behaviour_Interactive.png'),
(158, 'Turtle Rock Studios', '/bilder/Logo/Turtle_Rock_Studios.png'),
(159, 'Splash Damage', '/bilder/Logo/Splash_Damage.png'),
(160, 'Nightdive Studios', '/bilder/Logo/Nightdive_Studios.png'),
(161, 'IllFonic', '/bilder/Logo/IllFonic.png'),
(162, 'Asymmetric Publications', '/bilder/Logo/Asymmetric_Publications.png'),
(168, 'Pearl Abyss', '/bilder/Logo/Pearl_Abyss.png'),
(169, 'Smilegate Entertainment', '/bilder/Logo/Smilegate_Entertainment.png'),
(170, 'Jagex', '/bilder/Logo/Jagex.png'),
(171, 'Roblox Corporation', '/bilder/Logo/Roblox_Corporation.png'),
(172, 'Funcom', '/bilder/Logo/Funcom.png'),
(174, 'Phoenix Labs', '/bilder/Logo/Phoenix_Labs.png'),
(176, 'Boss Key Productions', '/bilder/Logo/Boss_Key_Productions.png'),
(177, 'V1 Interactive', '/bilder/Logo/V1_Interactive.png'),
(179, 'Freebird Games', '/bilder/Logo/Freebird_Games.png'),
(180, 'Game Science', NULL),
(181, 'Game Science Interactive Technology ', NULL),
(182, 'Massive Entertainment', NULL),
(184, 'Ubisoft', NULL),
(185, 'Innersloth', NULL),
(186, 'PlayEveryWare', NULL),
(187, 'Monolith Soft', NULL),
(189, 'NDcube', NULL),
(191, 'LLC', NULL),
(192, 'Capcom U.S.A', NULL),
(193, 'Creative Business Unit I', NULL),
(194, 'Saber Interactive', NULL),
(195, 'Warhammer Games Workshop', NULL),
(197, 'Rovio Entertainment', NULL),
(198, 'Chillingo', NULL),
(199, 'Panic Button', NULL),
(203, 'Feral Interactive', NULL),
(204, 'Iron Galaxy Studios', NULL),
(205, 'Virtuos', NULL),
(206, 'Warner Bros. International Enterprises', NULL),
(209, 'Electronic Arts', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `spiele`
--

CREATE TABLE `spiele` (
  `SpielID` int(11) NOT NULL,
  `SpielName` varchar(64) DEFAULT NULL,
  `YoutubeURL` mediumtext DEFAULT NULL,
  `Beschreibung` mediumtext DEFAULT NULL,
  `KBeschreibung` mediumtext DEFAULT NULL,
  `Audio` varchar(255) DEFAULT NULL,
  `Datum` date DEFAULT NULL,
  `BuyURLPS` varchar(255) DEFAULT NULL,
  `BuyURLPC` varchar(255) DEFAULT NULL,
  `BuyURLXbox` varchar(255) DEFAULT NULL,
  `BuyURLNintendo` varchar(255) DEFAULT NULL,
  `Logo` varchar(255) DEFAULT NULL,
  `Orte` varchar(255) DEFAULT NULL,
  `Cover` varchar(255) DEFAULT NULL,
  `Gameplay` int(11) DEFAULT NULL,
  `Graphic` int(11) DEFAULT NULL,
  `Story` int(11) DEFAULT NULL,
  `AI` int(11) DEFAULT NULL,
  `Creativity` int(11) DEFAULT NULL,
  `Immersion` int(11) DEFAULT NULL,
  `Sound` int(11) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `WievieleUserVote` int(11) DEFAULT NULL,
  `Geprüft` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `spiele`
--

INSERT INTO `spiele` (`SpielID`, `SpielName`, `YoutubeURL`, `Beschreibung`, `KBeschreibung`, `Audio`, `Datum`, `BuyURLPS`, `BuyURLPC`, `BuyURLXbox`, `BuyURLNintendo`, `Logo`, `Orte`, `Cover`, `Gameplay`, `Graphic`, `Story`, `AI`, `Creativity`, `Immersion`, `Sound`, `Rating`, `WievieleUserVote`, `Geprüft`) VALUES
(1, 'Stellar Blade', 'DYen6-TaSB8?si=0HCNCSnD0qIvyx6g', 'EROBERE DIE ERDE FÜR DIE MENSCHHEIT ZURÜCK', 'Beschreibung', 'Deutsch,Englisch, Französisch, Italienisch, Spanisch, Portugiesisch, Koreanisch', '2024-04-26', 'https://www.playstation.com/de-de/games/stellar-blade/', '', '', '', '/Bilder/Spielelogo/Stellar_Blade.png', '/Bilder/Orte/Stellar_Blade/Stellar_Blade.png', '/Bilder/Cover/Stellar_Blade.png', 85, 80, 85, 70, 85, 80, 85, 81, 10, 1),
(2, 'Senua’s Saga: Hellblade 2 ', '6z04b5a-13Y?si=heZSizQwUHTPtpGG', 'Senua ist entschlossen, diejenigen zu retten, die Opfer der Tyrannei geworden sind.', 'Beschreibung', 'Englisch', '2024-05-21', '', 'https://www.xbox.com/de-de/games/store/senuas-saga-hellblade-ii/9pmbb7nghv95', 'https://www.xbox.com/de-de/games/store/senuas-saga-hellblade-ii/9pmbb7nghv95', '', '/Bilder/Spielelogo/Senuas_Saga_Hellblade_2.png', '/Bilder/Orte/Senuas_Saga_Hellblade_2/Senuas_Saga_Hellblade_2.png', '/Bilder/Cover/Senuas_Saga_Hellblade_2.png', 75, 85, 85, 75, 85, 90, 90, 84, 10, 1),
(4, 'Black Myth: Wukong', 'rPPwsqfoy0w?si=43wdKaLrtV9OgQDj', 'Eine Reise nach Westen durch die chinesischen Mythologie', 'Beschreibung', 'Englisch', '2024-08-20', 'https://www.playstation.com/de-de/games/black-myth-wukong/', 'https://store.steampowered.com/app/2358720/Black_Myth_Wukong/?l=german', 'https://www.xbox.com/de-DE/search/results?q=Black+Myth+WuKong', '', '/Bilder/Spielelogo/Black_Myth_Wukong.png', '/Bilder/Orte/Black_Myth_Wukong/Black_Myth_Wukong.png', '/Bilder/Cover/Black_Myth_Wukong.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(5, 'Star Wars Outlaws', 'ymcpwq1ltQc?si=HpFSzXPaKZNxgeIw', 'Ein Abendteuer zwischen den Ereignissen von Das Imperium schlägt zurück und Die Rückkehr der Jedi-Ritter', 'Beschreibung', 'Deutsch, Englisch, Französisch, Spanisch, Portugiesisch, Japanisch', '2024-08-30', 'https://store.playstation.com/de-de/product/EP0001-PPSA08260_00-GAME000000000000', 'https://store.ubisoft.com/de/star-wars-outlaws/645ba713a9ce0448bffa4c12.html', 'https://www.xbox.com/de-DE/games/store/star-wars-outlaws/9PJ5BTQ1X7X9/0017', '', '/Bilder/Spielelogo/Star_Wars_Outlaws.png', '/Bilder/Orte/Star_Wars_Outlaws/Star_Wars_Outlaws.png', '/Bilder/Cover/Star_Wars_Outlaws.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(6, 'Among Us', '0YKjFoGxbec?si=0wdlJFdvsyO0FeFP', '', '', '-', '2018-06-15', '', '', '', '', '/Bilder/Spielelogo/Among_Us.png', '/Bilder/Orte/Among_Us/Among_Us.png', '/Bilder/Cover/Among_Us.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(7, 'Animal Crossing: New Leaf', 'https://www.youtube.com/watch?v=example_new_leaf', '', '', 'Englisch', '2012-11-08', '', '', '', 'https://www.amazon.de/s?k=Animal+Crossing%3A+New+Leaf&i=videogames&__mk_de_DE=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=3QLJXYAG3RUZ3&sprefix=animal+crossing+new+leaf%2Cvideogames%2C142&ref=nb_sb_noss_2', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(8, 'Animal Crossing: New Horizons', '_3YNL0OWio0?si=oBtwINFkG1EdSAyA', '', '', 'Englisch', '2020-03-20', '', '', '', 'https://store.nintendo.de/de/animal-crossing-new-horizons-000000000010002027', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(9, 'Animal Crossing: Happy Home Designer', 'TSpD2X2eG00?si=qyFZet-LaAC3jM5I', '', '', 'Englisch', '2015-07-30', '', '', '', 'https://www.amazon.de/s?k=Animal+Crossing%3A+Happy+Home+Designer&i=videogames&__mk_de_DE=%C3%85M%C3%85%C5%BD%C3%95%C3%91&ref=nb_sb_noss_1', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(10, 'Animal Crossing: Amiibo Festival', 'WbrdvC9qRc8?si=cKrdoRUCKaMCgqSu', '', '', 'Englisch', '2015-11-13', '', '', '', 'https://www.amazon.de/Animal-Crossing-Festival-amiibo-Figuren-amiibo-Karten/dp/B016BCC3NC/ref=sr_1_1?__mk_de_DE=%C3%85M%C3%85%C5%BD%C3%95%C3%91&s=videogames&sr=1-1', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(11, 'Animal Crossing: Pocket Camp', '9bpeQL52Tsw?si=M6Wadkeo8db8J-ze', '', '', 'Englisch', '2017-10-25', '', '', '', 'https://play.google.com/store/search?q=animal+crossing+pocket+camp&c=apps&hl=de&gl=US', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(12, 'Assassin\'s Creed', 'lZsSnHFsGio?si=vQ0-OLXMsAhU72NG', '', '', 'Englisch,Französisch,Italienisch,Deutsch,Spanisch,Japanisch', '2007-11-13', 'https://store.playstation.com/de-de/product/EP0001-CUSA04893_00-ACLEGACYHD000000', 'https://www.ubisoft.com/de-de/game/assassins-creed/the-ezio-collection#4vh4lM1YLwSX4NXjz87nqL', 'https://www.xbox.com/de-DE/games/store/assassins-creed-the-ezio-collection/bq9s8zkct3q7', 'https://store.ubisoft.com/de/assassins-creed--ii/56c4947f88a7e300458b4690.html', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(13, 'Assassin\'s Creed II', 'lZsSnHFsGio?si=vQ0-OLXMsAhU72NG', '', '', 'Deutsch,Englisch,Französisch,Italienisch,Spanisch', '2009-11-17', 'https://store.playstation.com/de-de/product/EP0001-CUSA04893_00-ACLEGACYHD000000', 'https://www.ubisoft.com/de-de/game/assassins-creed/the-ezio-collection#4vh4lM1YLwSX4NXjz87nqL', 'https://www.xbox.com/de-DE/games/store/assassins-creed-the-ezio-collection/bq9s8zkct3q7', 'https://store.ubisoft.com/de/assassins-creed--ii/56c4947f88a7e300458b4690.html', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(14, 'Assassin\'s Creed Brotherhood', 'lZsSnHFsGio?si=vQ0-OLXMsAhU72NG', '', '', 'Deutsch,Englisch,Französisch,Italienisch,Spanisch,Russisch', '2010-11-16', 'https://store.playstation.com/de-de/product/EP0001-CUSA04893_00-ACLEGACYHD000000', 'https://www.ubisoft.com/de-de/game/assassins-creed/the-ezio-collection#4vh4lM1YLwSX4NXjz87nqL', 'https://www.xbox.com/de-DE/games/store/assassins-creed-the-ezio-collection/bq9s8zkct3q7', 'https://www.nintendo.com/de-de/Spiele/Nintendo-Switch-Spiele/ASSASSIN-S-CREED-THE-EZIO-COLLECTION-2171132.html', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(15, 'Assassin\'s Creed Revelations', 'lZsSnHFsGio?si=vQ0-OLXMsAhU72NG', '', '', 'Deutsch,Englisch,Französisch,Italienisch,Spanisch,Russisch', '2011-11-15', 'https://store.playstation.com/de-de/product/EP0001-CUSA04893_00-ACLEGACYHD000000', 'https://www.ubisoft.com/de-de/game/assassins-creed/the-ezio-collection#4vh4lM1YLwSX4NXjz87nqL', 'https://www.xbox.com/de-DE/games/store/assassins-creed-the-ezio-collection/bq9s8zkct3q7', 'https://www.nintendo.com/de-de/Spiele/Nintendo-Switch-Spiele/ASSASSIN-S-CREED-THE-EZIO-COLLECTION-2171132.html', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(16, 'Hades 2', 'l-iHDj3EwdI?si=JVpN2hD1VcBDiYez', 'Schlüpf in die Rolle von Melinoe, der unsterblichen Prinzessin der Unterwelt.', 'Beschreibung', 'Englisch', '2024-05-06', '', 'https://store.steampowered.com/app/1145350/Hades_II/', '', '', '/Bilder/Spielelogo/Hades_2.png', '/Bilder/Orte/Hades_2/Hades_2.png', '/Bilder/Cover/Hades_2.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(17, 'Dragon\'s Dogma 2', 'FOCCI53JYBA?si=aQH-YYlzXbjnaixT', 'Setze Schwerter, Bögen und Magie gegen geheimnisvollen Wesen ein.', 'Beschreibung', 'Englisch, Japanisch', '2024-03-07', 'https://store.playstation.com/de-de/product/EP0102-PPSA09664_00-DD2GAME000000000', 'https://store.steampowered.com/app/2054970/Dragons_Dogma_2/', 'https://www.xbox.com/de-DE/games/store/dragons-dogma-2/9pjqmbmj3154', '', '/Bilder/Spielelogo/Dragons_Dogma_2.png', '/Bilder/Orte/Dragons_Dogma_2/Dragons_Dogma_2.png', '/Bilder/Cover/Dragons_Dogma_2.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(18, 'Final Fantasy VII Rebirth', 'GHr1ecp9da4?si=ztRBMDoT06ykkmCl', 'Nach ihrer Flucht aus der dystopischen Stadt Midgar brechen Cloud und seine Freunde zu einer Reise auf. ', 'Beschreibung', 'Deutsch, Japanisch, Englisch, Französisch', '2024-02-29', 'https://store.playstation.com/de-de/product/EP0082-PPSA08668_00-0783148264580163', '', '', '', '/Bilder/Spielelogo/Final_Fantasy_VII_Rebirth.png', '/Bilder/Orte/Final_Fantasy_VII_Rebirth/Final_Fantasy_VII_Rebirth.png', '/Bilder/Cover/Final_Fantasy_VII_Rebirth.png', 80, 90, 90, 85, 90, 85, 90, 87, 10, 1),
(19, 'Warhammer 40.000 Space Marine 2', 'GpYIuo3xGA8?si=eCzj-vXg2adBt6Tt', 'Verkörpere die übermenschlichen Fähigkeiten und Brutalität der Space Marines', 'Beschreibung', 'Deutsch, Japanisch, Englisch, Französisch, Italienisch,Spanisch,Russisch,Chinesisch', '2024-09-09', 'https://store.playstation.com/de-de/concept/10003330', 'https://store.steampowered.com/app/2183900/Warhammer_40000_Space_Marine_2/', 'https://www.xbox.com/de-DE/games/store/warhammer-40000-space-marine-2-pre-order/9N6KKQ71WQ6G/0017', '', '/Bilder/Spielelogo/Warhammer_40.000_Space_Marine_2.png', '/Bilder/Orte/Warhammer_40000_Space_Marine_2/Warhammer_40.000_Space_Marine_2.png', '/Bilder/Cover/Warhammer_40.000_Space_Marine_2.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(20, 'Assassins Creed Shadow', 'G9BiTL3FlH8?si=Cmnfqbt0CUlHKvsd', 'Eine Reise durch Japan auf einer Rachemission. ', 'Beschreibung', 'Deutsch, Japanisch, Englisch, Französisch, Italienisch,Spanisch,Portugiesisch', '2024-11-12', 'https://store.playstation.com/de-de/product/EP0001-PPSA20397_00-GAME000000000000', 'https://store.ubisoft.com/de/assassins-creed-shadows/660e5a03fbff4e2940488bcd.html', 'https://www.xbox.com/de-DE/games/store/assassins-creed-shadows/9N9P758CH65M/0017', '', '/Bilder/Spielelogo/Assassins_Creed_Shadow.png', '/Bilder/Orte/Assassins_Creed_Shadow/Assassins_Creed_Shadow.png', '/Bilder/Cover/Assassins_Creed_Shadow.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 0),
(21, 'S.T.A.L.K.E.R. 2', 'r4xyN1n7ysQ?si=ks8q2toFoqgfEkXk', 'Das Herz von Tschornobyl wartet auf euch. ', 'Beschreibung', 'Englisch, Ukrainisch', '2024-11-20', '', 'https://store.steampowered.com/app/1643320/STALKER_2_Heart_of_Chornobyl/?l=german', 'https://www.xbox.com/de-DE/games/stalker-2', '', '/Bilder/Spielelogo/S.T.A.L.K.E.R._2.png', '/Bilder/Orte/STALKER_2/S.T.A.L.K.E.R._2.png', '/Bilder/Cover/S.T.A.L.K.E.R._2.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 0),
(22, 'Angry Birds', 'bNNzRyd1xz0?si=W5PfiwRpH2FMt_dz', '', '', '-', '2009-12-11', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(23, 'Apex Legends', 'innmNewjkuk?si=G-t73mPNKPZGvn-V', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Japanisch, Chinesisch, Koreanisch, Russisch, Polnisch', '2019-02-04', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(24, 'Assassin\'s Creed III Remastered', '4rWU9PB-3Ns?si=bTqCYbXQpNq_lTYa', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Japanisch, Chinesisch, Russisch, Portugiesisch', '2012-10-30', '', 'https://store.ubisoft.com/de/assassins-creed-iii-remastered/5c62f61dadc72438053897eb.html', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(25, 'Assassin\'s Creed IV: Black Flag', 'pLW6vwtQlRE?si=18UqO_49AOKXRm4O', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Japanisch, Portugiesisch, Russisch', '2013-10-29', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(26, 'Assassin\'s Creed: Odyssey', '5d115sePmaU?si=CC66rC2vWB9w3sXO', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Japanisch, Portugiesisch, Russisch', '2018-10-02', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(27, 'Assassin\'s Creed: Valhalla', 'EGQKZoChalk?si=JGrZqUecL1Vi6hag', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Japanisch, Portugiesisch, Russisch', '2020-11-10', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(28, 'Assassin\'s Creed: Mirage', 'oKcLmWEArTw?si=xNkTTnZ4c6crBTAx', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Arabisch, Italienisch, Japanisch, Portugiesisch, Russisch', '2023-10-12', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(29, 'Batman: Arkham Knight', '49E53VjJCPo?si=iczXmReqFfL6HRmA', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Japanisch, Portugiesisch', '2015-06-23', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(30, 'Batman: Arkham City', 'AQhsVRYELKk?si=9XxxyHGvLSk0sxkK', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch', '2011-10-18', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(31, 'Batman: Arkham Asylum', 'T8bu2Y_cZb8?si=unF7Vl4W2YBds_0p', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch', '2009-08-25', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(32, 'Batman: Return to Arkham', 'w_zhk10EuBk?si=euEVi2mi0nZEDBfC', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch', '2016-10-18', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(33, 'The Last of Us', '', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Portugiesisch', '2013-06-14', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(34, 'The Last of Us Remastered', '', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Portugiesisch', '2014-07-29', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(35, 'The Last of Us Part II', '', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Portugiesisch,Türkisch,Griechisch,Russisch', '2020-06-19', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(36, 'The Last of Us Part II Remastered', '', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Portugiesisch,Türkisch,Griechisch,Russisch', '2024-01-19', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(37, 'The Last of Us Part I', '', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Portugiesisch,Türkisch,Griechisch,Russisch', '2022-09-02', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(38, 'Battlefield 1', '', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Japanisch, Arabisch, Portugiesisch, Russisch', '2016-10-21', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(39, 'Battlefield 2', '', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Japanisch, Arabisch, Portugiesisch, Russisch', '2005-06-21', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(40, 'Battlefield 3', '', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Japanisch, Arabisch, Portugiesisch, Russisch', '2011-10-25', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(41, 'Battlefield 4', '', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Japanisch, Arabisch, Portugiesisch, Russisch', '2013-10-29', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(42, 'Battlefield V', '', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Japanisch, Arabisch, Portugiesisch, Russisch', '2018-11-20', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(43, 'Battlefield 2042', '', '', '', 'Deutsch, Englisch, Französisch, Spanisch, Italienisch, Japanisch, Arabisch, Portugiesisch, Russisch', '2021-11-19', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 2),
(44, 'Silent Hill 2 Remake', '197HwuGGF74?si=wKSzo8BrF2okXxBx', '', 'Einen Brief von seiner verstorbenen Frau, lässt ihn nicht los', 'Englisch, Japanisch', '2024-10-08', 'https://store.playstation.com/de-de/product/EP0101-PPSA08709_00-MAINGAME00000000', 'https://store.steampowered.com/app/2124490/SILENT_HILL_2', '', '', '/Bilder/Spielelogo/Silent_Hill_2_Remake.png', '/Bilder/Orte/Silent_Hill_2_Remake/Silent_Hill_2_Remake.png', '/Bilder/Cover/Silent_Hill_2_Remake.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `spiele2`
--

CREATE TABLE `spiele2` (
  `SpielID` int(11) NOT NULL,
  `SpielName` varchar(64) DEFAULT NULL,
  `Gameplay` int(11) DEFAULT NULL,
  `Graphic` int(11) DEFAULT NULL,
  `Story` int(11) DEFAULT NULL,
  `AI` int(11) DEFAULT NULL,
  `Creativity` int(11) DEFAULT NULL,
  `Immersion` int(11) DEFAULT NULL,
  `Sound` int(11) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Geprüft` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `spiel_Genre`
--

CREATE TABLE `spiel_Genre` (
  `SpielID` int(11) NOT NULL,
  `GenreID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `spiel_Genre`
--

INSERT INTO `spiel_Genre` (`SpielID`, `GenreID`) VALUES
(1, 14),
(1, 23),
(2, 1),
(4, 8),
(4, 14),
(4, 26),
(5, 11),
(5, 23),
(6, 28),
(7, 8),
(7, 29),
(8, 8),
(8, 29),
(9, 8),
(9, 29),
(10, 12),
(10, 28),
(11, 8),
(11, 29),
(12, 1),
(12, 8),
(12, 18),
(13, 1),
(13, 8),
(13, 18),
(14, 1),
(14, 8),
(14, 18),
(15, 1),
(15, 8),
(16, 8),
(16, 14),
(16, 30),
(17, 14),
(17, 26),
(18, 8),
(18, 14),
(18, 26),
(19, 8),
(19, 11),
(19, 31),
(20, 23),
(20, 24),
(21, 23),
(21, 24),
(22, 12),
(23, 7),
(23, 11),
(24, 18),
(24, 23),
(25, 18),
(25, 23),
(26, 23),
(26, 24),
(27, 23),
(27, 24),
(28, 18),
(28, 23),
(29, 13),
(29, 23),
(30, 13),
(30, 23),
(31, 13),
(31, 23),
(32, 23),
(33, 23),
(33, 33),
(34, 23),
(34, 33),
(35, 23),
(35, 33),
(36, 23),
(36, 33),
(37, 23),
(37, 33),
(38, 11),
(39, 11),
(40, 11),
(41, 11),
(42, 11),
(43, 11),
(44, 8),
(44, 33);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `spiel_Minispiel`
--

CREATE TABLE `spiel_Minispiel` (
  `MinispielID` int(11) NOT NULL,
  `SpielID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `spiel_Plattform`
--

CREATE TABLE `spiel_Plattform` (
  `SpielID` int(11) NOT NULL,
  `PlattformID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `spiel_Plattform`
--

INSERT INTO `spiel_Plattform` (`SpielID`, `PlattformID`) VALUES
(1, 2),
(2, 1),
(2, 3),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 6),
(6, 10),
(7, 11),
(8, 4),
(9, 11),
(9, 12),
(10, 13),
(11, 10),
(12, 1),
(12, 14),
(12, 15),
(13, 1),
(13, 4),
(13, 5),
(13, 6),
(13, 14),
(13, 15),
(13, 17),
(14, 1),
(14, 4),
(14, 5),
(14, 6),
(14, 14),
(14, 15),
(15, 1),
(15, 4),
(15, 5),
(15, 6),
(15, 14),
(15, 15),
(16, 1),
(16, 2),
(16, 3),
(16, 5),
(16, 6),
(17, 1),
(17, 2),
(17, 3),
(17, 17),
(18, 2),
(19, 1),
(19, 2),
(19, 3),
(20, 1),
(20, 2),
(20, 3),
(21, 1),
(21, 3),
(22, 1),
(22, 18),
(22, 19),
(23, 1),
(23, 2),
(23, 3),
(23, 4),
(23, 5),
(23, 6),
(23, 17),
(23, 19),
(24, 1),
(24, 4),
(24, 5),
(24, 6),
(24, 13),
(24, 14),
(24, 15),
(24, 17),
(24, 23),
(25, 1),
(25, 4),
(25, 5),
(25, 6),
(25, 13),
(25, 14),
(25, 15),
(25, 17),
(26, 1),
(26, 5),
(26, 6),
(26, 17),
(26, 23),
(27, 1),
(27, 2),
(27, 3),
(27, 5),
(27, 6),
(28, 1),
(28, 2),
(28, 3),
(28, 5),
(28, 6),
(28, 17),
(28, 23),
(29, 1),
(29, 5),
(29, 6),
(30, 1),
(30, 5),
(30, 6),
(30, 13),
(30, 14),
(30, 15),
(31, 1),
(31, 5),
(31, 6),
(31, 14),
(31, 15),
(32, 3),
(32, 5),
(32, 6),
(33, 14),
(34, 5),
(35, 5),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 5),
(38, 6),
(39, 1),
(40, 1),
(40, 14),
(40, 15),
(41, 1),
(41, 5),
(41, 6),
(41, 14),
(41, 15),
(42, 1),
(42, 5),
(42, 6),
(43, 1),
(43, 2),
(43, 3),
(43, 5),
(43, 6),
(44, 1),
(44, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `spiel_Player`
--

CREATE TABLE `spiel_Player` (
  `SpielID` int(11) NOT NULL,
  `PlayerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `spiel_Player`
--

INSERT INTO `spiel_Player` (`SpielID`, `PlayerID`) VALUES
(1, 1),
(2, 1),
(4, 1),
(5, 1),
(6, 3),
(6, 5),
(7, 1),
(7, 2),
(7, 3),
(7, 5),
(8, 1),
(8, 2),
(8, 3),
(8, 5),
(9, 1),
(10, 2),
(10, 5),
(11, 1),
(11, 5),
(12, 1),
(13, 1),
(14, 1),
(14, 5),
(15, 1),
(15, 5),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(19, 3),
(19, 7),
(20, 1),
(21, 1),
(22, 1),
(23, 3),
(23, 7),
(24, 1),
(25, 1),
(25, 7),
(25, 9),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(33, 7),
(34, 1),
(34, 7),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(38, 7),
(39, 7),
(40, 1),
(40, 7),
(41, 1),
(41, 7),
(42, 1),
(42, 7),
(43, 7),
(44, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `spiel_PS`
--

CREATE TABLE `spiel_PS` (
  `SpielID` int(11) NOT NULL,
  `PSID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Daten für Tabelle `spiel_PS`
--

INSERT INTO `spiel_PS` (`SpielID`, `PSID`) VALUES
(1, 2),
(2, 3),
(2, 58),
(4, 180),
(4, 181),
(5, 182),
(5, 184),
(6, 185),
(6, 186),
(7, 1),
(7, 187),
(8, 1),
(9, 1),
(10, 1),
(10, 189),
(11, 1),
(12, 184),
(13, 184),
(14, 184),
(15, 184),
(16, 61),
(16, 191),
(17, 10),
(17, 192),
(18, 6),
(18, 193),
(19, 114),
(19, 194),
(19, 195),
(20, 184),
(21, 77),
(22, 3),
(22, 197),
(22, 198),
(23, 39),
(23, 191),
(23, 199),
(24, 184),
(25, 184),
(26, 184),
(27, 184),
(28, 184),
(29, 102),
(29, 203),
(29, 204),
(30, 102),
(30, 103),
(31, 99),
(31, 102),
(31, 203),
(31, 204),
(32, 99),
(32, 102),
(32, 206),
(33, 2),
(33, 14),
(34, 2),
(34, 14),
(35, 2),
(35, 14),
(36, 2),
(36, 14),
(37, 2),
(37, 14),
(38, 35),
(38, 209),
(39, 4),
(39, 35),
(40, 4),
(40, 35),
(41, 4),
(41, 35),
(42, 4),
(42, 35),
(43, 4),
(43, 35),
(44, 19),
(44, 86);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `besucher`
--
ALTER TABLE `besucher`
  ADD PRIMARY KEY (`BesucherID`);

--
-- Indizes für die Tabelle `bewertungen`
--
ALTER TABLE `bewertungen`
  ADD PRIMARY KEY (`BewertungID`),
  ADD KEY `BesucherID` (`BesucherID`),
  ADD KEY `SpielID` (`SpielID`);

--
-- Indizes für die Tabelle `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`GenreID`),
  ADD UNIQUE KEY `uc_GenreName` (`GenreName`);

--
-- Indizes für die Tabelle `minispiel`
--
ALTER TABLE `minispiel`
  ADD PRIMARY KEY (`MinispielID`);

--
-- Indizes für die Tabelle `plattform`
--
ALTER TABLE `plattform`
  ADD PRIMARY KEY (`PlattformID`),
  ADD UNIQUE KEY `uc_PlattformName` (`PlattformName`);

--
-- Indizes für die Tabelle `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`PlayerID`),
  ADD UNIQUE KEY `uc_PlayerName` (`PlayerName`);

--
-- Indizes für die Tabelle `ps`
--
ALTER TABLE `ps`
  ADD PRIMARY KEY (`PSID`),
  ADD UNIQUE KEY `unique_ps_name` (`PSName`);

--
-- Indizes für die Tabelle `spiele`
--
ALTER TABLE `spiele`
  ADD PRIMARY KEY (`SpielID`);

--
-- Indizes für die Tabelle `spiele2`
--
ALTER TABLE `spiele2`
  ADD PRIMARY KEY (`SpielID`);

--
-- Indizes für die Tabelle `spiel_Genre`
--
ALTER TABLE `spiel_Genre`
  ADD PRIMARY KEY (`SpielID`,`GenreID`),
  ADD KEY `GenreID` (`GenreID`);

--
-- Indizes für die Tabelle `spiel_Minispiel`
--
ALTER TABLE `spiel_Minispiel`
  ADD PRIMARY KEY (`SpielID`,`MinispielID`),
  ADD KEY `MinispielID` (`MinispielID`);

--
-- Indizes für die Tabelle `spiel_Plattform`
--
ALTER TABLE `spiel_Plattform`
  ADD PRIMARY KEY (`SpielID`,`PlattformID`),
  ADD KEY `PlattformID` (`PlattformID`);

--
-- Indizes für die Tabelle `spiel_Player`
--
ALTER TABLE `spiel_Player`
  ADD PRIMARY KEY (`SpielID`,`PlayerID`),
  ADD KEY `PlayerID` (`PlayerID`);

--
-- Indizes für die Tabelle `spiel_PS`
--
ALTER TABLE `spiel_PS`
  ADD PRIMARY KEY (`SpielID`,`PSID`),
  ADD KEY `PSID` (`PSID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `besucher`
--
ALTER TABLE `besucher`
  MODIFY `BesucherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `bewertungen`
--
ALTER TABLE `bewertungen`
  MODIFY `BewertungID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `genres`
--
ALTER TABLE `genres`
  MODIFY `GenreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT für Tabelle `minispiel`
--
ALTER TABLE `minispiel`
  MODIFY `MinispielID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `plattform`
--
ALTER TABLE `plattform`
  MODIFY `PlattformID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `player`
--
ALTER TABLE `player`
  MODIFY `PlayerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `ps`
--
ALTER TABLE `ps`
  MODIFY `PSID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT für Tabelle `spiele`
--
ALTER TABLE `spiele`
  MODIFY `SpielID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT für Tabelle `spiele2`
--
ALTER TABLE `spiele2`
  MODIFY `SpielID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bewertungen`
--
ALTER TABLE `bewertungen`
  ADD CONSTRAINT `bewertungen_ibfk_1` FOREIGN KEY (`BesucherID`) REFERENCES `besucher` (`BesucherID`),
  ADD CONSTRAINT `bewertungen_ibfk_2` FOREIGN KEY (`SpielID`) REFERENCES `spiele` (`SpielID`);

--
-- Constraints der Tabelle `spiel_Genre`
--
ALTER TABLE `spiel_Genre`
  ADD CONSTRAINT `spiel_Genre_ibfk_1` FOREIGN KEY (`SpielID`) REFERENCES `spiele` (`SpielID`),
  ADD CONSTRAINT `spiel_Genre_ibfk_2` FOREIGN KEY (`GenreID`) REFERENCES `genres` (`GenreID`);

--
-- Constraints der Tabelle `spiel_Minispiel`
--
ALTER TABLE `spiel_Minispiel`
  ADD CONSTRAINT `spiel_Minispiel_ibfk_1` FOREIGN KEY (`SpielID`) REFERENCES `spiele` (`SpielID`),
  ADD CONSTRAINT `spiel_Minispiel_ibfk_2` FOREIGN KEY (`MinispielID`) REFERENCES `minispiel` (`MinispielID`);

--
-- Constraints der Tabelle `spiel_Plattform`
--
ALTER TABLE `spiel_Plattform`
  ADD CONSTRAINT `spiel_Plattform_ibfk_1` FOREIGN KEY (`SpielID`) REFERENCES `spiele` (`SpielID`),
  ADD CONSTRAINT `spiel_Plattform_ibfk_2` FOREIGN KEY (`PlattformID`) REFERENCES `plattform` (`PlattformID`);

--
-- Constraints der Tabelle `spiel_Player`
--
ALTER TABLE `spiel_Player`
  ADD CONSTRAINT `spiel_Player_ibfk_1` FOREIGN KEY (`SpielID`) REFERENCES `spiele` (`SpielID`),
  ADD CONSTRAINT `spiel_Player_ibfk_2` FOREIGN KEY (`PlayerID`) REFERENCES `player` (`PlayerID`);

--
-- Constraints der Tabelle `spiel_PS`
--
ALTER TABLE `spiel_PS`
  ADD CONSTRAINT `spiel_PS_ibfk_1` FOREIGN KEY (`SpielID`) REFERENCES `spiele` (`SpielID`),
  ADD CONSTRAINT `spiel_PS_ibfk_2` FOREIGN KEY (`PSID`) REFERENCES `ps` (`PSID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
