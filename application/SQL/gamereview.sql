-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2020 at 09:11 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamereview`
--

-- --------------------------------------------------------

--
-- Table structure for table `activereviews`
--

CREATE TABLE `activereviews` (
  `ID` int(11) NOT NULL,
  `GameName` varchar(250) NOT NULL,
  `GameBlurb` longtext NOT NULL,
  `GameReview` longtext NOT NULL,
  `GameComments_YN` varchar(1) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `ReviewImage` varchar(250) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16le;

--
-- Dumping data for table `activereviews`
--

INSERT INTO `activereviews` (`ID`, `GameName`, `GameBlurb`, `GameReview`, `GameComments_YN`, `slug`, `ReviewImage`, `UserID`) VALUES
(1, 'Borderlands 3', 'This text was retrieved from the database.', 'This is a test review of the game.', 'Y', 'borderlands-3', 'borderlands-3.jpg', 1),
(2, 'Days Gone', 'This text was retrieved from the database.', 'This is a test review of the game.', 'Y', 'days-gone', 'days-gone.jpg', 2),
(3, 'Wolcen: Lords of Mayhem', 'Run n Gun', 'pew pew ninja teleports n stuff', 'N', 'wolcen-lords-of-mayhem', 'wolcen.jpg', 2),
(4, 'Frostpunk', 'Cold', 'play this game in winter with ur window open so u can get immersed because u really cant otherwise', 'Y', 'frostpunk', 'frostpunk.jpg', 2),
(5, 'Greedfall', 'Not sure', 'Think this game has something to do with sailors/pirates? Because it has nothing to do with them', 'Y', 'greedfall', 'greedfall.jpg', 2),
(6, 'Crusader Kings: 2', 'Grand Strategy', 'I got 70 hours racked up in 2 weeks on this game. My bloodline was strong. A series of unfortunate events occured. Everyone died. I had 1 opportunity left, however, deep down, I knew it would never work. My club-footed imbecile child ruler died. Apparently, marrying your sister off to powerful kings was a really bad decision a few years ago.', 'Y', 'crusader-kings-2', 'crusader-kings-2.jpg', 2),
(7, 'Archero', 'Casual Phone Game', 'Most innovative game 2019. Nearly snapped my phone in half. Innovation is key.', 'Y', 'archero', 'archero.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `gamescomments`
--

CREATE TABLE `gamescomments` (
  `UID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ReviewID` int(11) NOT NULL,
  `UserComment` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16le;

--
-- Dumping data for table `gamescomments`
--

INSERT INTO `gamescomments` (`UID`, `UserID`, `ReviewID`, `UserComment`) VALUES
(1, 1, 1, 'This is a comment that was generated manually in the database.'),
(2, 1, 1, 'Comment added from web page'),
(13, 2, 1, 'i made this commet'),
(14, 2, 1, 'auto update check lol'),
(15, 2, 1, 'didn\'t work lol'),
(16, 2, 1, 'hehehehehe'),
(17, 2, 1, 'yeehaw added  a button'),
(18, 2, 1, 'sick'),
(19, 2, 1, 'k design now'),
(20, 2, 2, 'heh');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UID` int(11) NOT NULL,
  `UserName` varchar(250) NOT NULL,
  `UserPassword` varchar(250) NOT NULL,
  `DarkMode` int(11) NOT NULL,
  `isAdmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16le;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `UserName`, `UserPassword`, `DarkMode`, `isAdmin`) VALUES
(1, 'Lecturer', '$2y$10$LU6wToj/RlEltGwzmqrQSu1I4gZTllB5PxKYMGXozk3kiXZNNDhda', 1, 0),
(2, 'tests', '$2y$10$uMQLePqycTE0OtBC8oqIU.6Q6qNvQ.FIjGpnS7ZoN4bNhVtlx/.jq', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activereviews`
--
ALTER TABLE `activereviews`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `gamescomments`
--
ALTER TABLE `gamescomments`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `UID` (`UID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `UID` (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activereviews`
--
ALTER TABLE `activereviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `gamescomments`
--
ALTER TABLE `gamescomments`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
