-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Mai 2024 um 23:18
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

--
-- Daten für Tabelle `notes`
--

INSERT INTO `notes` (`nid`, `tid`, `uid`, `text`) VALUES
(4, 21, 18, 'test notiz new'),
(5, 21, 18, 'ggdfgfdg'),
(6, 21, 18, 'hfdhfdhdfh'),
(7, 18, 18, 'sdfsdfsdf'),
(15, 21, 18, 'hfghfghfgh'),
(16, 21, 18, 'fsdfsf'),
(17, 21, 18, 'fsdfsf'),
(18, 21, 18, 'sdfsdf'),
(19, 21, 18, 'fsdfsf'),
(20, 21, 18, 'fsdfs'),
(21, 20, 18, 'fsdfs'),
(22, 8, 18, 'gfdgdg'),
(23, 21, 18, ''),
(24, 27, 16, 'dsfsdfdsf'),
(25, 18, 18, ''),
(26, 18, 18, ''),
(27, 25, 16, ''),
(28, 27, 16, ''),
(29, 27, 16, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tickets`
--

CREATE TABLE `tickets` (
  `tid` int(10) NOT NULL,
  `description` varchar(1500) NOT NULL,
  `category` enum('E-Mail','Windows','Hardware','Citrix','Software','Sonstiges') NOT NULL,
  `priority` enum('niedrig','mittel','hoch','') NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp(),
  `status` enum('Neu','In Bearbeitung','Fertig') NOT NULL DEFAULT 'Neu',
  `title` varchar(150) NOT NULL,
  `created_by` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tickets`
--

INSERT INTO `tickets` (`tid`, `description`, `category`, `priority`, `timestamp`, `status`, `title`, `created_by`) VALUES
(6, 'gdfgd', 'E-Mail', 'niedrig', '2024-05-14', 'Neu', 'gfdgd', 18),
(7, 'Ich kann keine E-Mails senden oder empfangen. Es scheint, dass mein E-Mail-Konto nicht richtig konfiguriert ist. Bitte überprüfen Sie die Servereinstellungen und helfen Sie mir, dieses Problem zu lösen.', 'E-Mail', 'hoch', '2024-05-14', 'Neu', 'E-Mail Anmeldung funktioniert nicht', 18),
(8, 'Ich kann keine E-Mails senden oder empfangen. Es scheint, dass mein E-Mail-Konto nicht richtig konfiguriert ist. Bitte überprüfen Sie die Servereinstellungen und helfen Sie mir, dieses Problem zu lösen.', 'E-Mail', 'hoch', '2024-05-14', 'In Bearbeitung', 'E-Mail Anmeldung funktioniert nicht', 18),
(9, 'Ich kann keine E-Mails senden oder empfangen. Es scheint, dass mein E-Mail-Konto nicht richtig konfiguriert ist. Bitte überprüfen Sie die Servereinstellungen und helfen Sie mir, dieses Problem zu lösen.', 'E-Mail', 'hoch', '2024-05-14', 'Neu', 'E-Mail Anmeldung funktioniert nicht', 18),
(10, 'gzh65h56h jhgkhkjhk jhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\nvjhgkhkjhkjhgkhkjhkjhgkhkjhk', 'E-Mail', 'mittel', '2024-05-14', 'Neu', 'fsdfsdf jhgkhkjhk', 18),
(11, 'gzh65h56h jhgkhkjhk jhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\nvjhgkhkjhkjhgkhkjhkjhgkhkjhk', 'E-Mail', 'mittel', '2024-05-14', 'Neu', 'fsdfsdf jhgkhkjhk', 18),
(12, 'Ich kann keine E-Mails senden oder empfangen. Es scheint, dass mein E-Mail-Konto nicht richtig konfiguriert ist. Bitte überprüfen Sie die Servereinstellungen und helfen Sie mir, dieses Problem zu lösen.', 'Hardware', 'mittel', '2024-05-14', 'Neu', 'E-Mail Anmeldung funktioniert nicht', 18),
(13, 'gzh65h56h jhgkhkjhk jhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\nvjhgkhkjhkjhgkhkjhkjhgkhkjhk', 'E-Mail', 'mittel', '2024-05-14', 'Neu', 'fsdfsdf jhgkhkjhk', 18),
(14, 'gzh65h56h jhgkhkjhk jhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\nvjhgkhkjhkjhgkhkjhkjhgkhkjhk', 'E-Mail', 'mittel', '2024-05-14', 'Neu', 'fsdfsdf jhgkhkjhk', 18),
(15, 'gzh65h56h jhgkhkjhk jhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\nvjhgkhkjhkjhgkhkjhkjhgkhkjhk', 'E-Mail', 'mittel', '2024-05-14', 'Neu', 'fsdfsdf jhgkhkjhk', 18),
(16, 'gzh65h56h jhgkhkjhk jhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\nvjhgkhkjhkjhgkhkjhkjhgkhkjhk', 'E-Mail', 'mittel', '2024-05-14', 'Neu', 'fsdfsdf jhgkhkjhk', 18),
(17, 'gzh65h56h jhgkhkjhk jhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\nvjhgkhkjhkjhgkhkjhkjhgkhkjhk', 'E-Mail', 'mittel', '2024-05-14', 'Neu', 'fsdfsdf jhgkhkjhk', 18),
(18, 'gzh65h56h jhgkhkjhk jhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\njhgkhkjhk\r\nvjhgkhkjhkjhgkhkjhkjhgkhkjhk', 'E-Mail', 'mittel', '2024-05-14', 'Neu', 'fsdfsdf jhgkhkjhk', 18),
(19, 'Hardware Ticket Beschreibung', 'Hardware', 'niedrig', '2024-05-14', 'Neu', 'Hardware Ticket', 18),
(20, 'Citrix FehlermeldungCitrix Fehlermeldung Citrix Fehlermeldung Citrix Fehlermeldung Citrix Fehlermeldung Citrix Fehlermeldung Citrix Fehlermeldung Citrix Fehlermeldung', 'Citrix', 'hoch', '2024-05-14', 'In Bearbeitung', 'Citrix Fehlermeldung', 18),
(21, 'Beim Versuch, auf Citrix-Anwendungen zuzugreifen, erhalte ich eine Fehlermeldung, dass die Verbindung nicht hergestellt werden kann. Ich benötige dringend Zugriff auf meine Citrix-Anwendungen für meine Arbeit. Bitte helfen Sie mir, dieses Problem zu lösen.', 'Citrix', 'mittel', '2024-05-14', 'In Bearbeitung', 'Citrix Fehlermeldung', 18),
(23, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'Windows', 'hoch', '2024-05-15', 'Neu', 'Test from Dashboard', 16),
(24, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'Windows', 'hoch', '2024-05-15', 'Neu', 'Test from Dashboard', 16),
(25, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'Windows', 'hoch', '2024-05-15', 'Neu', 'Test from Dashboard', 16),
(26, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'Windows', 'hoch', '2024-05-15', 'Neu', 'Test from Dashboard', 16),
(27, 'ohfsdh f sdf sdef fsdf sdf sdf sdfrwef ', 'Software', 'niedrig', '2024-05-15', 'Neu', 'test', 16);

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

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `users_tickets_view`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `users_tickets_view` (
`description` varchar(1500)
,`tid` int(10)
,`category` enum('E-Mail','Windows','Hardware','Citrix','Software','Sonstiges')
,`priority` enum('niedrig','mittel','hoch','')
,`timestamp` date
,`status` enum('Neu','In Bearbeitung','Fertig')
,`title` varchar(150)
,`username` varchar(50)
,`uid` int(4)
);

-- --------------------------------------------------------

--
-- Struktur des Views `users_tickets_view`
--
DROP TABLE IF EXISTS `users_tickets_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `users_tickets_view`  AS SELECT `t`.`description` AS `description`, `t`.`tid` AS `tid`, `t`.`category` AS `category`, `t`.`priority` AS `priority`, `t`.`timestamp` AS `timestamp`, `t`.`status` AS `status`, `t`.`title` AS `title`, `u`.`username` AS `username`, `u`.`uid` AS `uid` FROM (`tickets` `t` join `users` `u` on(`t`.`created_by` = `u`.`uid`)) ;

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
  ADD KEY `cid` (`category`),
  ADD KEY `created_by` (`created_by`);

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
  MODIFY `nid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT für Tabelle `tickets`
--
ALTER TABLE `tickets`
  MODIFY `tid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
-- Constraints der Tabelle `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
