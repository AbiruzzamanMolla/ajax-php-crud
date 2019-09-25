-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 25, 2019 at 07:58 AM
-- Server version: 10.3.14-MariaDB
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `customer_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `gender` tinytext NOT NULL,
  `dob` date NOT NULL,
  `education` tinytext NOT NULL,
  `address` varchar(150) NOT NULL,
  `bio` varchar(160) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fname`, `lname`, `email`, `password`, `gender`, `dob`, `education`, `address`, `bio`) VALUES
(42, 'Nusrat', 'Jahan', 'nusrat@jahan.co', '123456', 'female', '2019-09-12', 'SSC', 'Upojila Mor, Narsingdi Sadar', 'Feni'),
(40, 'Rumon', 'Bhia', 'rumon@bhiaa.com', '123456', 'male', '2019-09-15', 'BSc in CSE', 'Dhaka', 'Bhiaa from Uttara'),
(1, 'Abiruzzaman', 'Molla', 'abiruzzaman@gmail.com', '123456', 'male', '2019-09-18', 'Diploma in Medical', 'Dhaka', 'Bangladesh'),
(41, 'Md Abiruzzaman', 'Bhia', 'pulock@gmail.co', '123456', 'female', '2019-09-26', 'Diploma In Engineering', 'Upojila Mor, Narsingdi Sadar', 'fdsaf'),
(38, 'Arif', 'Hosain', 'arif.hosain@email.ext', '123456', 'female', '2019-09-26', 'BA', 'Upojila Mor, Narsingdi Sadar', 'Nothing Much');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
