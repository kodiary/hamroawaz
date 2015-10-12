-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2015 at 06:48 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hamroawaz`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
`id` int(11) NOT NULL,
  `username` varchar(650) NOT NULL,
  `password` varchar(650) NOT NULL,
  `email` varchar(650) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'lalhopeislife77@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `categorymanagers`
--

CREATE TABLE IF NOT EXISTS `categorymanagers` (
`id` int(11) NOT NULL,
  `title` varchar(650) NOT NULL,
  `display_order` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `categorymanagers`
--

INSERT INTO `categorymanagers` (`id`, `title`, `display_order`) VALUES
(3, 'Business', 1),
(4, 'Sport', 2),
(5, 'money', 3),
(6, 'Entertainment', 4),
(7, 'Science', 5),
(8, 'Technology', 6);

-- --------------------------------------------------------

--
-- Table structure for table `newsmanagers`
--

CREATE TABLE IF NOT EXISTS `newsmanagers` (
`id` int(11) NOT NULL,
  `title` varchar(650) NOT NULL,
  `image_file` varchar(650) NOT NULL,
  `audio` varchar(650) NOT NULL,
  `video` text NOT NULL,
  `description` text NOT NULL,
  `national` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `zone` int(11) NOT NULL,
  `slider` varchar(650) DEFAULT NULL,
  `is_headline` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `newsmanagers`
--

INSERT INTO `newsmanagers` (`id`, `title`, `image_file`, `audio`, `video`, `description`, `national`, `region`, `zone`, `slider`, `is_headline`) VALUES
(31, 'Money In the bank', '771868_350900.jpg', '', '', '<p>this is required money</p>', 1, 2, 5, '278994_416680.jpg', 0),
(32, 'Wornderfull world', '463757_994863.jpg', '', '', '<p>World is beautiful</p>', 2, 1, 1, '341452_671398.jpg', 1),
(33, 'Science is magic', '821417_632919.jpg', '', '', '', 2, 1, 1, '241751_575872.jpg', 1),
(34, 'Entertainment', '679364_730368.jpeg', '', '', '<p>asdfasdf</p>', 2, 1, 1, '119006_429507.jpeg', 1),
(35, 'Business is major', '458868_940097.jpg', '', 'http://localhost/hamroawaz/dashboard/news', '<p>http://localhost/hamroawaz/dashboard/news</p>', 2, 0, 0, '167456_254275.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news_categories`
--

CREATE TABLE IF NOT EXISTS `news_categories` (
`id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=161 ;

--
-- Dumping data for table `news_categories`
--

INSERT INTO `news_categories` (`id`, `news_id`, `cat_id`) VALUES
(153, 31, 5),
(154, 32, 6),
(155, 32, 7),
(156, 33, 7),
(157, 34, 6),
(158, 35, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pagemanagers`
--

CREATE TABLE IF NOT EXISTS `pagemanagers` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `pagemanagers`
--

INSERT INTO `pagemanagers` (`id`, `title`, `description`) VALUES
(109, 'asdfasdf', '<p>asdfsdaf</p>');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
`id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`) VALUES
(24, '838336_114584.jpg'),
(25, '749072_762942.jpg'),
(26, '235736_412423.jpg'),
(27, '294567_778213.jpg'),
(28, '632315_228594.jpg'),
(29, '140292_288745.jpg'),
(30, '874783_163885.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `categorymanagers`
--
ALTER TABLE `categorymanagers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsmanagers`
--
ALTER TABLE `newsmanagers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_categories`
--
ALTER TABLE `news_categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagemanagers`
--
ALTER TABLE `pagemanagers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categorymanagers`
--
ALTER TABLE `categorymanagers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `newsmanagers`
--
ALTER TABLE `newsmanagers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `news_categories`
--
ALTER TABLE `news_categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=161;
--
-- AUTO_INCREMENT for table `pagemanagers`
--
ALTER TABLE `pagemanagers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
