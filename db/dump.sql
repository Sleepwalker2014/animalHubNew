-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 22. Mai 2016 um 21:38
-- Server Version: 5.5.49-0+deb8u1
-- PHP-Version: 5.6.20-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `animal`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animals`
--

CREATE TABLE IF NOT EXISTS `animals` (
`animal` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `birthDay` date DEFAULT NULL,
  `sexId` int(11) NOT NULL,
  `furColourId` int(11) unsigned NOT NULL,
  `eyeColourId` int(11) unsigned NOT NULL,
  `speciesId` int(11) unsigned NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `specification` varchar(255) NOT NULL,
  `raceId` int(11) unsigned DEFAULT NULL,
  `userId` int(10) unsigned NOT NULL,
  `image` varchar(256) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `animals`
--

INSERT INTO `animals` (`animal`, `name`, `birthDay`, `sexId`, `furColourId`, `eyeColourId`, `speciesId`, `size`, `specification`, `raceId`, `userId`, `image`) VALUES
(2, 'Kacy', '2013-05-01', 2, 1, 1, 2, 1, 'ziemlich verschmust', 2, 1, NULL),
(7, 'Kacyc', '2016-02-18', 1, 1, 2, 2, 5, 'oki    hsrhw wdas ist heir ein bisschen zu lang wa ssoll cih tun?', 2, 2, '56edbf5d3390f.png');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `colours`
--

CREATE TABLE IF NOT EXISTS `colours` (
`colour` int(11) unsigned NOT NULL,
  `code` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `colours`
--

INSERT INTO `colours` (`colour`, `code`, `name`) VALUES
(1, 'grey', 'Grau'),
(2, 'black', 'Schwarz');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
`notification` int(10) unsigned NOT NULL,
  `latitude` double NOT NULL,
  `notificationTypeId` int(10) unsigned NOT NULL,
  `creationDate` date NOT NULL,
  `description` varchar(2048) NOT NULL,
  `animalId` int(11) NOT NULL,
  `longitude` double NOT NULL,
  `location` varchar(255) NOT NULL,
  `user` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `notifications`
--

INSERT INTO `notifications` (`notification`, `latitude`, `notificationTypeId`, `creationDate`, `description`, `animalId`, `longitude`, `location`, `user`) VALUES
(2, 40.45, 1, '2016-02-17', 'sgg', 2, 40.45, 'Hennigsdorf, Deutschland', 1),
(6, 40.45, 1, '2016-03-31', 'awf', 7, 40.45, 'Afwateringskanaal, Niederlande', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notificationType`
--

CREATE TABLE IF NOT EXISTS `notificationType` (
`notificationType` int(10) unsigned NOT NULL,
  `code` varchar(25) NOT NULL,
  `description` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `notificationType`
--

INSERT INTO `notificationType` (`notificationType`, `code`, `description`) VALUES
(1, 'missing', 'vermisst');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `races`
--

CREATE TABLE IF NOT EXISTS `races` (
`race` int(10) unsigned NOT NULL,
  `code` varchar(15) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `races`
--

INSERT INTO `races` (`race`, `code`, `name`) VALUES
(1, 'bkh', 'Britisch Kurzhaar'),
(2, 'russianBlue', 'Russisch Blau');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `searchNotifications`
--

CREATE TABLE IF NOT EXISTS `searchNotifications` (
`searchNotification` int(10) unsigned NOT NULL,
  `notification` int(10) unsigned NOT NULL,
  `missingDate` date NOT NULL,
  `additionalInformation` varchar(1024) NOT NULL,
  `reward` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `searchNotifications`
--

INSERT INTO `searchNotifications` (`searchNotification`, `notification`, `missingDate`, `additionalInformation`, `reward`) VALUES
(2, 2, '2016-02-19', 'sgg', 2),
(4, 6, '2016-03-17', 'awf', 23);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
`session` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `sessionID` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sexes`
--

CREATE TABLE IF NOT EXISTS `sexes` (
`sex` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `description` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `sexes`
--

INSERT INTO `sexes` (`sex`, `code`, `description`) VALUES
(1, 'male', 'männlich'),
(2, 'female', 'weiblich'),
(3, 'unknown', 'keine Angabe');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sizes`
--

CREATE TABLE IF NOT EXISTS `sizes` (
`size` int(10) unsigned NOT NULL,
  `description` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `species`
--

CREATE TABLE IF NOT EXISTS `species` (
`species` int(11) unsigned NOT NULL,
  `code` varchar(25) NOT NULL,
  `description` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `species`
--

INSERT INTO `species` (`species`, `code`, `description`) VALUES
(1, 'cat', 'Katze'),
(2, 'dog', 'Hund');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user`, `name`, `password`) VALUES
(2, 'Horst', 'Deutschrock1'),
(1, 'Marcel', 'Deutschrock');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `animals`
--
ALTER TABLE `animals`
 ADD PRIMARY KEY (`animal`), ADD KEY `fk_sex` (`sexId`), ADD KEY `fk_furColour` (`furColourId`), ADD KEY `fk_eyeColour` (`eyeColourId`), ADD KEY `fk_race` (`raceId`), ADD KEY `fk_species` (`speciesId`), ADD KEY `userId` (`userId`);

--
-- Indizes für die Tabelle `colours`
--
ALTER TABLE `colours`
 ADD PRIMARY KEY (`colour`);

--
-- Indizes für die Tabelle `notifications`
--
ALTER TABLE `notifications`
 ADD PRIMARY KEY (`notification`), ADD KEY `fk_animal` (`animalId`), ADD KEY `fk_notificationType` (`notificationTypeId`), ADD KEY `user` (`user`);

--
-- Indizes für die Tabelle `notificationType`
--
ALTER TABLE `notificationType`
 ADD PRIMARY KEY (`notificationType`);

--
-- Indizes für die Tabelle `races`
--
ALTER TABLE `races`
 ADD PRIMARY KEY (`race`);

--
-- Indizes für die Tabelle `searchNotifications`
--
ALTER TABLE `searchNotifications`
 ADD PRIMARY KEY (`searchNotification`), ADD UNIQUE KEY `notification` (`notification`);

--
-- Indizes für die Tabelle `sessions`
--
ALTER TABLE `sessions`
 ADD PRIMARY KEY (`session`), ADD UNIQUE KEY `user` (`user`,`sessionID`);

--
-- Indizes für die Tabelle `sexes`
--
ALTER TABLE `sexes`
 ADD PRIMARY KEY (`sex`);

--
-- Indizes für die Tabelle `sizes`
--
ALTER TABLE `sizes`
 ADD PRIMARY KEY (`size`);

--
-- Indizes für die Tabelle `species`
--
ALTER TABLE `species`
 ADD PRIMARY KEY (`species`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user`), ADD KEY `name` (`name`,`password`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `animals`
--
ALTER TABLE `animals`
MODIFY `animal` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT für Tabelle `colours`
--
ALTER TABLE `colours`
MODIFY `colour` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `notifications`
--
ALTER TABLE `notifications`
MODIFY `notification` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT für Tabelle `notificationType`
--
ALTER TABLE `notificationType`
MODIFY `notificationType` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `races`
--
ALTER TABLE `races`
MODIFY `race` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `searchNotifications`
--
ALTER TABLE `searchNotifications`
MODIFY `searchNotification` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `sessions`
--
ALTER TABLE `sessions`
MODIFY `session` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `sexes`
--
ALTER TABLE `sexes`
MODIFY `sex` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `sizes`
--
ALTER TABLE `sizes`
MODIFY `size` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `species`
--
ALTER TABLE `species`
MODIFY `species` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
MODIFY `user` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `animals`
--
ALTER TABLE `animals`
ADD CONSTRAINT `animals_ibfk_10` FOREIGN KEY (`raceId`) REFERENCES `races` (`race`) ON UPDATE CASCADE,
ADD CONSTRAINT `animals_ibfk_11` FOREIGN KEY (`userId`) REFERENCES `users` (`user`) ON UPDATE CASCADE,
ADD CONSTRAINT `animals_ibfk_6` FOREIGN KEY (`speciesId`) REFERENCES `species` (`species`) ON UPDATE CASCADE,
ADD CONSTRAINT `animals_ibfk_7` FOREIGN KEY (`sexId`) REFERENCES `sexes` (`sex`) ON UPDATE CASCADE,
ADD CONSTRAINT `animals_ibfk_8` FOREIGN KEY (`furColourId`) REFERENCES `colours` (`colour`) ON UPDATE CASCADE,
ADD CONSTRAINT `animals_ibfk_9` FOREIGN KEY (`eyeColourId`) REFERENCES `colours` (`colour`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `notifications`
--
ALTER TABLE `notifications`
ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`notificationTypeId`) REFERENCES `notificationType` (`notificationType`) ON UPDATE CASCADE,
ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`animalId`) REFERENCES `animals` (`animal`) ON UPDATE CASCADE,
ADD CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`user`) REFERENCES `users` (`user`);

--
-- Constraints der Tabelle `searchNotifications`
--
ALTER TABLE `searchNotifications`
ADD CONSTRAINT `searchNotifications_ibfk_1` FOREIGN KEY (`notification`) REFERENCES `notifications` (`notification`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
