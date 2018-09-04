-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2018 at 07:43 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`achStr`, `achName`, `gameID`, `achType`, `achDesc`, `achValue`) VALUES
('destroy_ship', 'Destroy a ship', 1, 'bronze', 'blew up a ship woo', 1),
('five_missiles', 'Shoot 5 missiles', 1, 'bronze', 'Fire missiles', 5);

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `gameID` int(11) NOT NULL,
  `gameName` varchar(32) NOT NULL,
  `gameStr` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`gameID`, `gameName`, `gameStr`) VALUES
(1, 'Project Space', 'Project_Space');

-- --------------------------------------------------------

--
-- Table structure for table `uachievements`
--

CREATE TABLE `uachievements` (
  `achStr` varchar(32) NOT NULL,
  `gameID` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `progress` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uachievements`
--

INSERT INTO `uachievements` (`achStr`, `gameID`, `username`, `progress`) VALUES
('destroy_ship', 1, 'Animorphs', 1),
('five_missiles', 1, 'Animorphs', 1);

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
  `about` varchar(200) NOT NULL,
  `featuredach` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pword`, `email`, `fname`, `lname`, `dispName`, `country`, `about`, `featuredach`) VALUES
('a', '$2y$10$4jTgmo65gqeltTny8clYCeqzqQziByyJgB1DCf/Nk2DkbmA2Ipv6C', 'a@a.com', '', '', 'a', '', '', ''),
('Animorphs', '$2y$10$WOoBvbzI.7UDQSFxxGs88e82i0jhS1T76NiE/poPlCyGqMD7h/pme', 'jakejuretic@hotmail.com', 'Jake', 'Juretic', 'Animorphs199', 'Australia', 'I like computers and all sort of stuff. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis.', 'five_missiles'),
('b', '$2y$10$Rcu9sm3syaLqAESsDBarv.p1A2BVfimB4s06s.Gc7Qb23eHHFJtty', 'b@b.com', 'Britney', 'Bitch', 'BritBitch', '\'Murica', 'I\'m Britney Bitch', NULL),
('c', '$2y$10$1V/8AI5mDWOC65UX8Yd1Iuj.bO7axp6ci1f8BQItkTa.kpPi4FvIq', 'c@c.com', '', '', 'c', '', '', NULL),
('d', '$2y$10$OhJMjCt.c81Nmok4gfcYWevCh.OYmAGecunj4UWzXQVlb554gCnKW', 'd@d.com', '', '', 'd', '', '', NULL),
('e', '$2y$10$B3vPZVkLwHStpwx4s2W3XuTR8ay4amTz07kyDt5lLMRUzC0KE0LdO', '', '', '', 'e', '', '', NULL),
('f', '$2y$10$kKivTEdpVmk2Fk7pGZ/qYO2eT6VQB7qIn0sB/jBF4bJLCoGpwaqPC', 'f@f.com', '', '', 'f', '', '', NULL),
('g', '$2y$10$koeW8Oy9pheabf57v5K6qe.FabaDUTO8sCMH9hc7uJLZWELl2Inxu', 'g@g.com', '', '', 'g', '', '', NULL),
('h', '$2y$10$KAvgq/IZxxNWtaCv30JfBeCtCzRF3Ec001P6TZOkNKlQM9njC7R6O', 'h@h.com', '', '', 'H', '', '', NULL),
('q', '$2y$10$HwpktG8sI/IsI2yRi3KFPe51It85e8moA6YMfnRdK9p3Ou8gvIJ7S', '', '', '', '', '', '', NULL),
('Sally', '$2y$10$2QeTID/eNy.LA6t4rf/uw.0p2t07r4nkHAGoKsWYjAeVt.RDdxkcS', 's@s.com', 'Silly', 'Sally', 'xxx_Sally_xxx', 'Australia', 'I like cats', NULL),
('v', '$2y$10$78YprTvzUKsapJ/rBzSJTORTq7NTalRqt1Mx0HzCpf0STdxqJ.R/q', 'v@v.com', '', '', 'v', '', '', NULL),
('x', '$2y$10$383fVClsV9RCzf3RHhieAuxCxwoNUtva0suZCZBN2k5JUbaPhT.QS', 'x@x.com', 'x', 'x', 'x', 'x', 'x', NULL),
('z', '$2y$10$XRR5VcPuRUautwfk1PEb1utpuvSDImlEiCoH8017AsXY0gjiRYYRy', 'z@z.com', '', '', 'z', '', '', NULL);

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
  MODIFY `gameID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achievements`
--
ALTER TABLE `achievements`
  ADD CONSTRAINT `achievements_fk` FOREIGN KEY (`gameID`) REFERENCES `games` (`gameID`);

--
-- Constraints for table `uachievements`
--
ALTER TABLE `uachievements`
  ADD CONSTRAINT `uAchievements_fk1` FOREIGN KEY (`gameID`,`achStr`) REFERENCES `achievements` (`gameID`, `achStr`),
  ADD CONSTRAINT `uAchievements_fk2` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
