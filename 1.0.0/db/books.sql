-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 05:58 AM
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
-- Database: `books`
--

-- --------------------------------------------------------

--
-- Table structure for table `addbooks`
--

CREATE TABLE `addbooks` (
  `id` int(11) NOT NULL,
  `titlebook` varchar(50) NOT NULL,
  `textbook` varchar(10000) NOT NULL,
  `linkbook` varchar(255) NOT NULL,
  `photobook` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `addbooks`
--

INSERT INTO `addbooks` (`id`, `titlebook`, `textbook`, `linkbook`, `photobook`) VALUES
(6, 'java script', 'often abbreviated as JS, is a programming language that conforms to the ECMAScript specification.[7] JavaScript is high-level, often just-in-time compiled, and multi-paradigm. It has curly-bracket syntax, dynamic typing, prototype-based object-orientation, and first-class functions.', 'https://www.google.com/', 'javascript1.jpg'),
(7, 'html css', 'often abbreviated as JS, is a programming language that conforms to the ECMAScript specification.[7] JavaScript is high-level, often just-in-time compiled, and multi-paradigm. It has curly-bracket syntax, dynamic typing, prototype-based object-orientation, and first-class functions.', 'https://www.google.com/', 'html css.jpg'),
(8, 'php', 'often abbreviated as JS, is a programming language that conforms to the ECMAScript specification.[7] JavaScript is high-level, often just-in-time compiled, and multi-paradigm. It has curly-bracket syntax, dynamic typing, prototype-based object-orientation, and first-class functions.', 'https://www.google.com/', 'php.jpg'),
(9, 'javascript 2', 'often abbreviated as JS, is a programming language that conforms to the ECMAScript specification.[7] JavaScript is high-level, often just-in-time compiled, and multi-paradigm. It has curly-bracket syntax, dynamic typing, prototype-based object-orientation, and first-class functions.', 'https://www.google.com/', 'javascript2.jpg'),
(10, 'html css 2', 'often abbreviated as JS, is a programming language that conforms to the ECMAScript specification.[7] JavaScript is high-level, often just-in-time compiled, and multi-paradigm. It has curly-bracket syntax, dynamic typing, prototype-based object-orientation, and first-class functions.', 'https://www.google.com/', 'html css 2.jpg'),
(11, 'react', 'often abbreviated as JS, is a programming language that conforms to the ECMAScript specification.[7] JavaScript is high-level, often just-in-time compiled, and multi-paradigm. It has curly-bracket syntax, dynamic typing, prototype-based object-orientation, and first-class functions.', 'https://www.google.com/', 'react.jpg'),
(14, 'aaaaa', 'bbbbbb', 'bbbbb', 'Google Flutter.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'cc', 'admin@admin.com', 'cc'),
(2, 'aa', 'aaa@g.com', 'aa');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `yourname` varchar(300) NOT NULL,
  `youremail` varchar(50) NOT NULL,
  `text` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `yourname`, `youremail`, `text`) VALUES
(32, 'Comforts and enjoyment when you read books Comforts and enjoyment when you read books', 'abdo@abdo.com', 'absolutly the rest has a special taste, rarely when you find it in some place. absolutly the rest has a special taste, rarely when you find it in some place.absolutly the rest has a special taste, rarely when you find it in some place.\r\nabsolutly the rest has a special taste, rarely when you find it in some place.absolutly the rest has a special taste, rarely when you find it in some place.absolutly the rest has a special taste, rarely when you find it in some place.absolutly the rest has a special taste, rarely when you find it in some place.absolutly the rest has a special taste, rarely when you find it in some place.absolutly the rest has a special taste, rarely when you find it in some place.'),
(33, 'Comforts and enjoyment when you read books', 'abdo@abdo.com', 'absolutly the rest has a special taste, rarely when you find it in some place.\r\n'),
(34, 'aaa', 'bf@gnsg.h', 'grqere'),
(35, '(tgtz', 'zegzgzbtr@h.com', 'rtbzrb'),
(36, 'jdjt', 'gdts@g.v', 'htsyrs'),
(37, 'Abderrahman Erahali', 'abderrahman.erahali@gmail.com', ' vcnn');

-- --------------------------------------------------------

--
-- Table structure for table `image_book`
--

CREATE TABLE `image_book` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `auteur` varchar(10000) NOT NULL,
  `link` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `image_book`
--

INSERT INTO `image_book` (`id`, `titre`, `auteur`, `link`, `photo`) VALUES
(83, 'ffffffff', 'ffffffffffff', 'ffffffff', 'img.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `username`, `email`, `password`) VALUES
(1, 'abdo', 'abdo@hotmail.com', '1111'),
(40, 'cc', 'abdo2@hotmail.com', 'cc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addbooks`
--
ALTER TABLE `addbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_book`
--
ALTER TABLE `image_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addbooks`
--
ALTER TABLE `addbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `image_book`
--
ALTER TABLE `image_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
