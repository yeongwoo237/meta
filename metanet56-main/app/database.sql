SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS bluebirdhotel;
CREATE DATABASE IF NOT EXISTS bluebirdhotel;

DROP USER IF EXISTS'bluebird_user'@'%';
CREATE USER IF NOT EXISTS 'bluebird_user'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON bluebirdhotel.* TO 'bluebird_user'@'%';
USE bluebirdhotel;

CREATE TABLE `signup` (
  `UserID` int(100) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL UNIQUE,
  `Password` varchar(255) NOT NULL,
  `idnum` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
