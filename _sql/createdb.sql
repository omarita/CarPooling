CREATE DATABASE carpoolingdb;
CREATE USER 'carpoolingusr'@'localhost' IDENTIFIED BY 'carpoolingusr';
GRANT ALL ON carpoolingdb.* to 'carpoolingusr'@'localhost';
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL UNIQUE,
  `userPass` varchar(100) NOT NULL,
  `userStatus` enum('Y','N') NOT NULL DEFAULT 'N',
  `tokenCode` varchar(100) NOT NULL,
PRIMARY KEY (`userID`)
);

CREATE TABLE IF NOT EXISTS `transfers` (
  `transferID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `created` datetime NOT NULL,
PRIMARY KEY (`transferID`)
);

CREATE TABLE IF NOT EXISTS `requests` (
  `requestID` int(11) NOT NULL AUTO_INCREMENT,
  `transferID` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `message` varchar(100) NOT NULL,
  `accepted` enum('Y','N') NOT NULL DEFAULT 'N',
PRIMARY KEY (`requestID`)
);
