-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2024 at 03:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `BookID` int(11) NOT NULL,
  `Title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Url` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Category` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Cover` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Date` date NOT NULL,
  `Views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`BookID`, `Title`, `Description`, `Url`, `Category`, `Cover`, `Date`, `Views`) VALUES
(5, 'time', 'Enter the word count into the tool below (or paste in text) to see how many minutes it will take you to read. Estimates number of minutes based on a slow ...', 'newlink', 'Politics', 'IMG-65d5959824e5d0.81628851.jpg', '2024-01-20', 69),
(10, 'ff', 'dd', 'dd', 'Biography and Memoir', 'IMG-65d595a67829b2.75920850.jpg', '2024-01-25', 15),
(14, 'gg', 'gg', 'gg', 'Literature', 'IMG-65d595b1adde86.83098478.jpg', '2024-02-21', 14),
(16, 'ss', 'ss', 'ss', 'Biography and Memoir', 'IMG-65d595ccc70bb9.61907664.jpg', '2024-02-21', 8),
(22, 'bb', 'bb', 'bb', 'Philosophy', 'IMG-65e29fbbe21dc4.86257738.jpg', '2024-03-02', 1),
(23, 'gg', 'gg', 'gg', 'Science', 'IMG-65e2a1bfe6a117.22236646.jpg', '2024-03-02', 0),
(25, 'mm', 'mm', 'mm', 'Literature', 'IMG-65e29a17e53a30.03706521.jpg', '2024-03-02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `covers`
--

CREATE TABLE `covers` (
  `CoverID` int(11) NOT NULL,
  `UserIDF` int(11) DEFAULT NULL,
  `Cover` varchar(255) DEFAULT NULL,
  `Url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `covers`
--

INSERT INTO `covers` (`CoverID`, `UserIDF`, `Cover`, `Url`) VALUES
(1, 9, 'image_1.png', 'none'),
(6, 9, 'IMG-65e1cee1cb0a87.35472296.png', 'cc'),
(11, 9, 'IMG-65e299d56a22c6.22830253.png', 'nn');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `FavID` int(11) NOT NULL,
  `UserIDF` int(11) DEFAULT NULL,
  `BookIDF` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`FavID`, `UserIDF`, `BookIDF`) VALUES
(218, 9, 23),
(220, 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `interactions`
--

CREATE TABLE `interactions` (
  `IntID` int(11) NOT NULL,
  `UserIDF` int(11) DEFAULT NULL,
  `BookIDF` int(11) DEFAULT NULL,
  `LikeStatus` tinyint(1) DEFAULT NULL,
  `Comment` text DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `interactions`
--

INSERT INTO `interactions` (`IntID`, `UserIDF`, `BookIDF`, `LikeStatus`, `Comment`, `Date`) VALUES
(1, 9, 5, NULL, 'minutes it will take you to read. Estimates number of minutes based on a slow', '2024-02-22 02:50:31'),
(2, 29, 10, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', '2024-02-22 02:53:37'),
(5, 9, 5, NULL, 'top', '2024-02-22 06:37:22'),
(6, 9, 5, NULL, 'naa', '2024-02-22 06:39:11'),
(7, 9, 10, NULL, 'standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled', '2024-02-22 08:24:48'),
(9, 9, 16, NULL, 'ÙˆØ§Ø´ Ø§Ù†Ø§ ðŸ˜«', '2024-02-22 08:30:23'),
(10, 34, 5, NULL, 'top ðŸ¥°', '2024-02-22 19:29:58'),
(11, 9, 14, NULL, 'nice', '2024-03-01 09:43:37'),
(14, 9, 5, NULL, 'ss', '2024-03-01 12:59:08'),
(15, 9, 22, NULL, 'cc', '2024-03-02 07:19:39');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `MessageID` int(11) NOT NULL,
  `SenderUserID` int(11) DEFAULT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`MessageID`, `SenderUserID`, `Subject`, `Message`, `CreatedAt`) VALUES
(15, 9, 'ana', 'simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2024-02-16 10:16:30'),
(16, 9, 'Contrary', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur', '2024-02-16 11:01:13'),
(17, 9, 'passages', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '2024-02-16 11:01:54'),
(18, 9, 'mm', 'mm', '2024-03-01 12:58:35'),
(19, 9, 'mm', 'mm', '2024-03-02 03:20:43'),
(20, 9, 'mm', 'mm', '2024-03-02 03:43:28'),
(21, 9, 'mm', 'mm', '2024-03-02 03:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Email` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Password` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `FullName` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Avatar` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Roll` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `Password`, `FullName`, `Avatar`, `Roll`) VALUES
(9, 'cc', 'abderrahman.erahali@gmail.com', 'e0323a9039add2978bf5b49550572c7c', 'cc', 'IMG-65e2a37f895476.11693828.jpg', 1),
(14, 'qq', 'qq', '099b3b060154898840f0ebdfb46ec78f', 'qq', 'IMG-65d536baa3d7e5.01880982.jpg', 0),
(29, 'dd', 'dd', '1aabac6d068eef6a7bad3fdf50a05cc8', 'dd', 'IMG-65d57fe63b52e2.74292232.jpg', 0),
(34, 'ff', 'ff@ff.ff', '633de4b0c14ca52ea2432a3c8a5c4c31', 'ff', 'IMG-65d877087cae03.30171310.png', 1),
(36, 'pp', 'pp', 'c483f6ce851c9ecd9fb835ff7551737c', 'pp@pp.com', 'IMG-65d8775681b631.92290349.png', 0),
(37, 'vv', 'vv', 'c4055e3a20b6b3af3d10590ea446ef6c', 'vv', '', 0),
(42, 'ggo', 'ggo@ggo.ggo', '1bfdfc95a8d44c2a4fe644ac85bab66d', 'ggo', 'IMG-65d87a8cead508.15432638.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`BookID`);

--
-- Indexes for table `covers`
--
ALTER TABLE `covers`
  ADD PRIMARY KEY (`CoverID`),
  ADD KEY `covers_ibfk_1` (`UserIDF`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`FavID`),
  ADD KEY `favorites_ibfk_1` (`UserIDF`),
  ADD KEY `favorites_ibfk_2` (`BookIDF`);

--
-- Indexes for table `interactions`
--
ALTER TABLE `interactions`
  ADD PRIMARY KEY (`IntID`),
  ADD KEY `interactions_ibfk_2` (`BookIDF`),
  ADD KEY `interactions_ibfk_1` (`UserIDF`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `messages_ibfk_1` (`SenderUserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `BookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `covers`
--
ALTER TABLE `covers`
  MODIFY `CoverID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `FavID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `interactions`
--
ALTER TABLE `interactions`
  MODIFY `IntID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `covers`
--
ALTER TABLE `covers`
  ADD CONSTRAINT `covers_ibfk_1` FOREIGN KEY (`UserIDF`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`UserIDF`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`BookIDF`) REFERENCES `books` (`BookID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interactions`
--
ALTER TABLE `interactions`
  ADD CONSTRAINT `interactions_ibfk_1` FOREIGN KEY (`UserIDF`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `interactions_ibfk_2` FOREIGN KEY (`BookIDF`) REFERENCES `books` (`BookID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`SenderUserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
