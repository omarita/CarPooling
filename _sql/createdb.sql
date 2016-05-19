CREATE DATABASE carpoolingdb;
CREATE USER 'carpoolingusr'@'localhost' IDENTIFIED BY 'carpoolingusr';
GRANT ALL ON carpoolingdb.* to 'carpoolingusr'@'localhost';

USE carpoolingdb;
--DROP TABLE `users`;
--DROP TABLE `transfers`;
--DROP TABLE `requests`;

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL UNIQUE,
  `userPass` varchar(100) NOT NULL,
  `phoneNo` varchar(20) NULL,
  `paypalAccount` varchar(60) NULL,
  `userStatus` enum('Y','N') NOT NULL DEFAULT 'N',
  `tokenCode` varchar(100) NOT NULL,
  `accountLocked` enum('Y','N') NOT NULL DEFAULT 'N',
PRIMARY KEY (`userID`)
);

CREATE TABLE IF NOT EXISTS `transfers` (
  `transferID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `departure` datetime NOT NULL,
  `fromLocation` varchar(100) NOT NULL,
  `toLocation` varchar(100) NOT NULL,
  `availableSeats` numeric NOT NULL,
  `price` numeric NOT NULL,
  `created` datetime NOT NULL,
PRIMARY KEY (`transferID`)
);

CREATE TABLE IF NOT EXISTS `requests` (
  `requestID` int(11) NOT NULL AUTO_INCREMENT,
  `transferID` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `message` varchar(100) NOT NULL,
  `seats` numeric NOT NULL,
  `feedback` numeric NOT NULL,
PRIMARY KEY (`requestID`)
);
