-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 11, 2018 at 02:40 PM
-- Server version: 5.6.40
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asdouglc_achievementEngine`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `achStr` varchar(32) NOT NULL,
  `achName` varchar(32) NOT NULL,
  `gameID` int(11) NOT NULL,
  `achType` varchar(32) NOT NULL,
  `achDesc` varchar(128) NOT NULL,
  `achValue` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`achStr`, `achName`, `gameID`, `achType`, `achDesc`, `achValue`) VALUES
('destroy_ship', 'Destroy a Ship', 1, 'bronze', 'Rid the galaxy of a minion of the red menace!', 1),
('five_missiles', 'Fire 5 Missiles', 1, 'silver', 'Fire 5 missiles into the great expanse', 5),
('click_screen', 'Click anywhere', 2, 'bronze', 'Click anywhere on the screen', 1),
('kill_one_enemy', 'Kill an enemy', 2, 'silver', 'Kill one enemy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `gameID` int(11) NOT NULL,
  `gameName` varchar(32) NOT NULL,
  `gameStr` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`gameID`, `gameName`, `gameStr`) VALUES
(1, 'Project Space', 'Project_Space'),
(2, 'Block Battle', 'Block_Battle');

-- --------------------------------------------------------

--
-- Table structure for table `uachievements`
--

CREATE TABLE `uachievements` (
  `achStr` varchar(32) NOT NULL,
  `gameID` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `progress` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uachievements`
--

INSERT INTO `uachievements` (`achStr`, `gameID`, `username`, `progress`) VALUES
('destroy_ship', 1, 'Asdougl', 1),
('five_missiles', 1, 'Asdougl', 5),
('destroy_ship', 1, 'Kris', 1),
('five_missiles', 1, 'Kris', 1),
('click_screen', 2, 'Kris', 1),
('kill_one_enemy', 2, 'Kris', 1),
('destroy_ship', 1, 'Animorphs', 1),
('five_missiles', 1, 'Animorphs', 1),
('click_screen', 2, 'Animorphs', 1),
('kill_one_enemy', 2, 'Animorphs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ugames`
--

CREATE TABLE `ugames` (
  `username` varchar(50) NOT NULL,
  `gameID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ugames`
--

INSERT INTO `ugames` (`username`, `gameID`) VALUES
('Kris', 1),
('Kris', 2),
('Animorphs', 1),
('Animorphs', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `pword` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `dispName` varchar(25) NOT NULL,
  `country` varchar(25) NOT NULL,
  `discord` varchar(50) NOT NULL,
  `featuredach` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pword`, `email`, `fname`, `lname`, `dispName`, `country`, `discord`, `featuredach`) VALUES
('asdougl', '$2y$10$TUeuyLDtNYKYOU0Hr2SqJehZkLRnqPgiiHh19Ee.s/78rHDCJxITq', 'cameronb@outlook.com.au', 'Cameron', 'Burrows', 'Asdougl', 'Australia', 'Asdougl#8666', NULL),
('willy', '$2y$10$hNfXF7kjxEG79QoG2co4B.VFrsVoyf6ZmvXEKNfau.h.ggBq8pg1G', 'will@hotmail.com', 'Will', 'Willy', 'Xxx_willy_xxx', 'Aus', 'willybumbum#1234', NULL),
('kris', '$2y$10$2A2g2yvPzimwU6NCsjp7CulHmBfd8Slv1mkk5Hiq67mbM1hTLUh2i', 'chrislawson987@gmail.com', 'Chris', 'Lawson', 'Kris', 'Australia', 'Kris#9222', 'kill_one_enemy'),
('bob', '$2y$10$wL6Ca076CK/vSt.ZJR9Ab.C67uD0t5iLlEvZPb7eVYUSo0mva9JEa', 'bob@bob.com', '', '', 'bob', '', '', NULL),
('q', '$2y$10$Cn0Msj2oQMXmUKjIAXGScuKPbyjq4mKQoVHtEmRoIKV1zBhyu01nq', 'q@q.com', 'Jake', 'Juretic', 'q', 'Australia', 'Ani#1234', ''),
('greg', '$2y$10$lTmF/rjuvzMyBcrIlPQol.bBD64i7UOvFkIt7daYt1Ghxs9uToPIO', 'greg@greg.com', '', '', 'Greg', '', '', NULL),
('r', '$2y$10$e/NYO1qK49ojTsBmY0nQJeOFxWzDvAh/Q9WLKTYJju9OclNwUobae', 'r@r.com', '', '', 'r', '', '', NULL),
('eggman', '$2y$10$djI0LaPvDK6Gx8UsjAJxg.g.AVai4HxJe0p3R5/69pwS7i3Ems9P.', 'eggmen@egg.com', '', '', 'Eggman', '', '', NULL),
('animorphs', '$2y$10$txla/icFdPUMHkOwgeFIoOkA5LJvfl/Nv4.fEHyJUnjs6uC7ZmxjK', 'a@a.com', 'Jake', 'Juretic', 'Animorphs', 'Australia', 'Animorphs#9412', 'kill_one_enemy'),
('gimmedatdick', '$2y$10$GDDPMPba8NxDTijspPW15ushyNbipibrbyOgm8qfJp8tN7g7h2iJu', 'gimme@dick.com', '', '', 'Gimmedatdick', '', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`gameID`,`achStr`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gameID`);

--
-- Indexes for table `uachievements`
--
ALTER TABLE `uachievements`
  ADD PRIMARY KEY (`gameID`,`achStr`,`username`),
  ADD KEY `uAchievements_fk2` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `gameID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
