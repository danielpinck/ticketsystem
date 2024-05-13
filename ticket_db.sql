-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 13. Mai 2024 um 17:39
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `ticket_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notes`
--

CREATE TABLE `notes` (
  `nid` int(2) NOT NULL,
  `tid` int(4) NOT NULL,
  `uid` int(4) NOT NULL,
  `text` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tickets`
--

CREATE TABLE `tickets` (
  `tid` int(10) NOT NULL,
  `description` varchar(1500) NOT NULL,
  `category` enum('E-Mail','Windows','Hardware','Citrix','Software') NOT NULL,
  `priority` enum('niedrig','mittel','hoch','') NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp(),
  `status` enum('neu','in_bearbeitung','fertig','') NOT NULL DEFAULT 'neu',
  `title` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tickets`
--

INSERT INTO `tickets` (`tid`, `description`, `category`, `priority`, `timestamp`, `status`, `title`) VALUES
(1, 'test description', 'Windows', 'mittel', '2024-05-13', 'neu', 'test title'),
(2, 'test description', 'Windows', 'mittel', '2024-05-13', 'neu', 'test title'),
(3, 'gfdgdfg', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'gfdgfd'),
(4, 'gfdgdfg', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'gfdgfd'),
(5, 'zrrtzrtz', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticket'),
(6, 'zrrtzrtz', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticket'),
(7, 'zrrtzrtz', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticket'),
(8, 'zrrtzrtz', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticket'),
(9, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(10, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(11, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(12, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(13, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(14, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(15, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(16, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(17, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(18, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(19, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(20, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(21, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(22, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(23, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(24, 'gfdgdfg', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'gfdgfd'),
(25, 'gfdgdfg', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'gfdgfd'),
(26, 'gfdgdfg', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'gfdgfd'),
(27, 'dfgfdg', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticket'),
(28, 'dfgfdg', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticket'),
(29, 'fsdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticket'),
(30, 'fsdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticket'),
(31, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(32, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(33, 'sdfsdfsdf', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'test ticketsdfsdf'),
(34, 'test beschreibung', 'Hardware', 'hoch', '2024-05-13', 'neu', 'test ticket'),
(35, 'hahahddh', 'Citrix', 'hoch', '2024-05-13', 'neu', 'test ticket'),
(36, 'fdgfd', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'gfdg'),
(37, 'fdgfd', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'gfdg'),
(38, 'fdgfd', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'gfdg'),
(39, 'fdgfd', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'gfdg'),
(40, 'fdgfd', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'gfdg'),
(41, 'fdgfd', 'E-Mail', 'niedrig', '2024-05-13', 'neu', 'gfdg'),
(42, 'meine maus geht nicht mehr sadge', 'Hardware', 'hoch', '2024-05-13', 'neu', 'Maus kaputt'),
(43, 'gfdg', 'E-Mail', 'hoch', '2024-05-13', 'neu', 'dfgd'),
(44, 'gfdg', 'E-Mail', 'hoch', '2024-05-13', 'neu', 'dfgd'),
(45, 'gfdg', 'E-Mail', 'hoch', '2024-05-13', 'neu', 'dfgd'),
(46, 'gfdg', 'E-Mail', 'hoch', '2024-05-13', 'neu', 'dfgd'),
(47, 'gfdg', 'E-Mail', 'hoch', '2024-05-13', 'neu', 'dfgd'),
(48, 'gfdg', 'E-Mail', 'hoch', '2024-05-13', 'neu', 'dfgd'),
(49, 'gfdg', 'E-Mail', 'hoch', '2024-05-13', 'neu', 'dfgd'),
(50, 'gfdg', 'E-Mail', 'hoch', '2024-05-13', 'neu', 'dfgd'),
(51, 'gfdg', 'E-Mail', 'hoch', '2024-05-13', 'neu', 'dfgd'),
(52, 'gfdg', 'E-Mail', 'hoch', '2024-05-13', 'neu', 'dfgd'),
(53, 'gfdg', 'E-Mail', 'hoch', '2024-05-13', 'neu', 'dfgd'),
(54, 'gfdg', 'E-Mail', 'hoch', '2024-05-13', 'neu', 'dfgd'),
(55, 'dfgfd  gsdgsdg gsdg sdg  gsdg sdg sdg sdg sdgsdgfsdgsdg sdgsdgrehthcv rezehreg rereg ', 'Windows', 'niedrig', '2024-05-13', 'neu', 'sdf fdg sdgwefs'),
(56, 'dfgfd  gsdgsdg gsdg sdg  gsdg sdg sdg sdg sdgsdgfsdgsdg sdgsdgrehthcv rezehreg rereg ', 'Windows', 'niedrig', '2024-05-13', 'neu', 'sdf fdg sdgwefs'),
(57, 'dfgfd  gsdgsdg gsdg sdg  gsdg sdg sdg sdg sdgsdgfsdgsdg sdgsdgrehthcv rezehreg rereg ', 'Windows', 'niedrig', '2024-05-13', 'neu', 'sdf fdg sdgwefs'),
(58, 'dfgfd  gsdgsdg gsdg sdg  gsdg sdg sdg sdg sdgsdgfsdgsdg sdgsdgrehthcv rezehreg rereg ', 'Windows', 'niedrig', '2024-05-13', 'neu', 'sdf fdg sdgwefs');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticket_support`
--

CREATE TABLE `ticket_support` (
  `uid` int(4) DEFAULT NULL,
  `tid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `uid` int(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `rolle` enum('user','support','admin','') NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`uid`, `username`, `rolle`, `password`) VALUES
(16, 'a', 'user', 'b'),
(18, 'admin', 'admin', 'pw'),
(19, 'test', 'user', '$2y$10$d2PJffcA/XltQpuPrRNmwuPny1tyG9LrE4kcKIDMED/4qVBzckUb2'),
(20, 'testuser', 'user', '$2y$10$TNvxUSNQUcfBT5PUhebwUeiBcRly1Ym/lXRoHpHtOsgnzr7YuqL0K');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`nid`),
  ADD KEY `tid` (`tid`),
  ADD KEY `uid` (`uid`);

--
-- Indizes für die Tabelle `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `cid` (`category`);

--
-- Indizes für die Tabelle `ticket_support`
--
ALTER TABLE `ticket_support`
  ADD KEY `uid` (`uid`),
  ADD KEY `tid` (`tid`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `name` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `notes`
--
ALTER TABLE `notes`
  MODIFY `nid` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tickets`
--
ALTER TABLE `tickets`
  MODIFY `tid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `tickets` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `ticket_support`
--
ALTER TABLE `ticket_support`
  ADD CONSTRAINT `ticket_support_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_support_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `tickets` (`tid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
