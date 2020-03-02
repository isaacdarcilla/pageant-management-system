-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2020 at 05:21 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pageant_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `00-auto-bestinswimsuit`
--

CREATE TABLE `00-auto-bestinswimsuit` (
  `increment` int(11) NOT NULL,
  `judge_id` int(11) NOT NULL,
  `contestant_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `added_by_sponsor` int(11) NOT NULL,
  `criterion55` int(11) NOT NULL,
  `criterion56` int(11) NOT NULL,
  `criterion57` int(11) NOT NULL,
  `criterion58` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `00-auto-productionnumber`
--

CREATE TABLE `00-auto-productionnumber` (
  `increment` int(11) NOT NULL,
  `judge_id` int(11) NOT NULL,
  `contestant_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `added_by_sponsor` int(11) NOT NULL,
  `criterion51` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `00-auto-productionnumber`
--

INSERT INTO `00-auto-productionnumber` (`increment`, `judge_id`, `contestant_id`, `rank`, `total`, `deduction`, `event_id`, `added_by_sponsor`, `criterion51`) VALUES
(9, 17, 31, 2, 90, 0, 43, 0, 90),
(11, 17, 32, 1, 98, 0, 43, 0, 98),
(12, 17, 34, 2, 90, 0, 43, 0, 90),
(13, 19, 31, 2, 89, 0, 43, 0, 89),
(14, 19, 32, 1, 99, 0, 43, 0, 99),
(15, 19, 34, 3, 78, 0, 43, 0, 78);

-- --------------------------------------------------------

--
-- Table structure for table `00-auto-sportsattire`
--

CREATE TABLE `00-auto-sportsattire` (
  `increment` int(11) NOT NULL,
  `judge_id` int(11) NOT NULL,
  `contestant_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `added_by_sponsor` int(11) NOT NULL,
  `criterion52` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `00-auto-talentsnight`
--

CREATE TABLE `00-auto-talentsnight` (
  `increment` int(11) NOT NULL,
  `judge_id` int(11) NOT NULL,
  `contestant_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `deduction` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `added_by_sponsor` int(11) NOT NULL,
  `criterion47` int(11) NOT NULL,
  `criterion48` int(11) NOT NULL,
  `criterion49` int(11) NOT NULL,
  `criterion50` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `00-auto-talentsnight`
--

INSERT INTO `00-auto-talentsnight` (`increment`, `judge_id`, `contestant_id`, `rank`, `total`, `deduction`, `event_id`, `added_by_sponsor`, `criterion47`, `criterion48`, `criterion49`, `criterion50`) VALUES
(2, 9, 13, 8, 85, 0, 42, 0, 25, 25, 18, 17),
(3, 14, 13, 4, 85, 0, 42, 0, 26, 26, 17, 16),
(4, 10, 13, 11, 77, 0, 42, 0, 24, 23, 15, 15),
(5, 6, 13, 11, 70, 0, 42, 0, 20, 25, 15, 10),
(6, 16, 13, 13, 60, 0, 42, 0, 20, 20, 10, 10),
(7, 7, 13, 11, 50, 0, 42, 0, 15, 15, 10, 10),
(8, 4, 13, 8, 55, 0, 42, 0, 10, 20, 15, 10),
(9, 13, 13, 6, 82, 0, 42, 0, 25, 27, 17, 13),
(10, 8, 13, 3, 83, 0, 42, 0, 25, 28, 16, 14),
(13, 5, 13, 11, 72, 0, 42, 0, 20, 22, 15, 15),
(14, 12, 13, 13, 50, 0, 42, 0, 15, 15, 12, 8),
(15, 15, 13, 9, 85, 0, 42, 0, 26, 26, 17, 16),
(16, 9, 14, 15, 72, 0, 42, 0, 20, 22, 15, 15),
(17, 14, 14, 2, 91, 0, 42, 0, 27, 26, 19, 19),
(18, 7, 14, 4, 75, 0, 42, 0, 25, 20, 15, 15),
(19, 5, 14, 4, 85, 0, 42, 0, 25, 25, 19, 16),
(20, 13, 14, 1, 95, 0, 42, 0, 29, 29, 20, 17),
(21, 10, 14, 2, 92, 0, 42, 0, 28, 28, 18, 18),
(22, 16, 14, 12, 66, 0, 42, 0, 19, 20, 14, 13),
(23, 4, 14, 3, 85, 0, 42, 0, 25, 25, 20, 15),
(24, 8, 14, 7, 75, 0, 42, 0, 25, 23, 14, 13),
(25, 6, 14, 3, 95, 0, 42, 0, 30, 27, 20, 18),
(26, 12, 14, 8, 69, 0, 42, 0, 20, 20, 15, 14),
(27, 15, 14, 6, 88, 0, 42, 0, 26, 25, 19, 18),
(28, 11, 13, 5, 82, 0, 42, 0, 25, 28, 15, 14),
(29, 11, 14, 2, 86, 0, 42, 0, 26, 27, 15, 18),
(30, 9, 15, 5, 90, 0, 42, 0, 28, 26, 20, 16),
(31, 14, 15, 4, 85, 0, 42, 0, 25, 26, 18, 16),
(32, 16, 15, 2, 95, 0, 42, 0, 28, 28, 20, 19),
(33, 5, 15, 5, 83, 0, 42, 0, 26, 24, 17, 16),
(34, 15, 15, 10, 84, 0, 42, 0, 27, 26, 16, 15),
(35, 4, 15, 8, 55, 0, 42, 0, 15, 20, 10, 10),
(36, 13, 15, 2, 88, 0, 42, 0, 28, 25, 16, 19),
(37, 7, 15, 13, 48, 0, 42, 0, 15, 15, 10, 8),
(38, 11, 15, 4, 84, 0, 42, 0, 28, 25, 16, 15),
(39, 10, 15, 6, 83, 0, 42, 0, 26, 25, 16, 16),
(40, 6, 15, 7, 88, 0, 42, 0, 30, 25, 18, 15),
(41, 8, 15, 2, 84, 0, 42, 0, 27, 27, 17, 13),
(43, 12, 15, 11, 61, 0, 42, 0, 18, 18, 15, 10),
(44, 9, 16, 7, 86, 0, 42, 0, 25, 25, 18, 18),
(45, 10, 16, 12, 76, 0, 42, 0, 23, 23, 14, 16),
(46, 14, 16, 8, 75, 0, 42, 0, 20, 25, 15, 15),
(47, 5, 16, 6, 82, 0, 42, 0, 25, 24, 17, 16),
(48, 16, 16, 10, 72, 0, 42, 0, 19, 19, 17, 17),
(49, 4, 16, 7, 60, 0, 42, 0, 10, 10, 20, 20),
(50, 7, 16, 14, 46, 0, 42, 0, 13, 10, 9, 14),
(51, 13, 16, 9, 79, 0, 42, 0, 24, 23, 17, 15),
(52, 8, 16, 6, 77, 0, 42, 0, 23, 25, 14, 15),
(53, 11, 16, 5, 82, 0, 42, 0, 25, 25, 16, 16),
(54, 15, 16, 11, 82, 0, 42, 0, 25, 25, 15, 17),
(55, 6, 16, 10, 76, 0, 42, 0, 20, 23, 15, 18),
(56, 12, 16, 12, 59, 0, 42, 0, 17, 17, 15, 10),
(57, 7, 17, 7, 70, 0, 42, 0, 18, 21, 17, 14),
(58, 5, 17, 5, 83, 0, 42, 0, 24, 26, 17, 16),
(59, 4, 17, 6, 65, 0, 42, 0, 15, 15, 20, 15),
(60, 9, 17, 10, 82, 0, 42, 0, 24, 23, 18, 17),
(61, 10, 17, 5, 84, 0, 42, 0, 25, 26, 17, 16),
(62, 13, 17, 12, 71, 0, 42, 0, 22, 22, 15, 12),
(63, 8, 17, 5, 78, 0, 42, 0, 26, 26, 14, 12),
(64, 14, 17, 6, 79, 0, 42, 0, 24, 23, 15, 17),
(65, 6, 17, 5, 93, 0, 42, 0, 23, 30, 20, 20),
(66, 11, 17, 3, 85, 0, 42, 0, 25, 26, 18, 16),
(67, 16, 17, 7, 80, 0, 42, 0, 23, 23, 17, 17),
(68, 15, 17, 3, 91, 0, 42, 0, 27, 28, 18, 18),
(69, 12, 17, 10, 64, 0, 42, 0, 17, 20, 15, 12),
(70, 9, 18, 11, 81, 0, 42, 0, 24, 23, 17, 17),
(71, 5, 18, 10, 76, 0, 42, 0, 23, 22, 16, 15),
(72, 4, 18, 10, 40, 0, 42, 0, 10, 10, 10, 10),
(73, 11, 18, 7, 80, 0, 42, 0, 23, 26, 16, 15),
(74, 10, 18, 10, 78, 0, 42, 0, 24, 23, 16, 15),
(75, 13, 18, 8, 80, 0, 42, 0, 26, 22, 17, 15),
(76, 16, 18, 7, 80, 0, 42, 0, 23, 23, 16, 18),
(77, 14, 18, 9, 73, 0, 42, 0, 20, 21, 15, 17),
(78, 7, 18, 8, 64, 0, 42, 0, 20, 20, 11, 13),
(79, 8, 18, 7, 75, 0, 42, 0, 22, 24, 15, 14),
(80, 6, 18, 8, 85, 0, 42, 0, 30, 25, 15, 15),
(81, 15, 18, 8, 86, 0, 42, 0, 26, 27, 16, 17),
(82, 12, 18, 9, 67, 0, 42, 0, 20, 18, 17, 12),
(83, 14, 19, 14, 60, 0, 42, 0, 20, 20, 10, 10),
(84, 10, 19, 10, 78, 0, 42, 0, 24, 23, 15, 16),
(85, 7, 19, 15, 35, 0, 42, 0, 10, 9, 9, 7),
(86, 4, 19, 13, 25, 0, 42, 0, 5, 10, 5, 5),
(87, 12, 19, 13, 50, 0, 42, 0, 20, 12, 10, 8),
(88, 9, 19, 14, 75, 0, 42, 0, 22, 21, 16, 16),
(89, 11, 19, 8, 77, 0, 42, 0, 24, 23, 15, 15),
(90, 15, 19, 12, 81, 0, 42, 0, 26, 24, 14, 17),
(91, 13, 19, 12, 71, 0, 42, 0, 25, 21, 11, 14),
(92, 5, 19, 11, 72, 0, 42, 0, 20, 22, 16, 14),
(93, 8, 19, 9, 69, 0, 42, 0, 20, 22, 14, 13),
(94, 16, 19, 11, 68, 0, 42, 0, 18, 18, 16, 16),
(95, 6, 19, 13, 60, 0, 42, 0, 20, 15, 13, 12),
(96, 10, 20, 6, 83, 0, 42, 0, 24, 24, 18, 17),
(97, 14, 20, 5, 83, 0, 42, 0, 25, 24, 17, 17),
(98, 8, 20, 1, 92, 0, 42, 0, 28, 28, 18, 18),
(99, 11, 20, 6, 81, 0, 42, 0, 25, 26, 14, 16),
(100, 5, 20, 4, 85, 0, 42, 0, 25, 26, 18, 16),
(101, 4, 20, 4, 75, 0, 42, 0, 20, 25, 20, 10),
(102, 6, 20, 6, 90, 0, 42, 0, 25, 28, 20, 17),
(103, 16, 20, 5, 83, 0, 42, 0, 24, 24, 18, 17),
(104, 9, 20, 4, 91, 0, 42, 0, 27, 28, 18, 18),
(105, 13, 20, 2, 88, 0, 42, 0, 26, 28, 18, 16),
(106, 7, 20, 12, 49, 0, 42, 0, 15, 13, 12, 9),
(107, 12, 20, 9, 67, 0, 42, 0, 17, 20, 18, 12),
(108, 15, 20, 2, 92, 0, 42, 0, 27, 28, 19, 18),
(109, 9, 21, 3, 92, 0, 42, 0, 28, 28, 18, 18),
(110, 5, 21, 2, 88, 0, 42, 0, 27, 26, 18, 17),
(111, 14, 21, 10, 70, 0, 42, 0, 16, 24, 15, 15),
(112, 16, 21, 4, 87, 0, 42, 0, 26, 25, 18, 18),
(113, 11, 21, 6, 81, 0, 42, 0, 27, 27, 13, 14),
(114, 10, 21, 5, 84, 0, 42, 0, 25, 25, 17, 17),
(115, 8, 21, 4, 82, 0, 42, 0, 26, 25, 15, 16),
(116, 4, 21, 2, 90, 0, 42, 0, 25, 25, 20, 20),
(117, 13, 21, 3, 87, 0, 42, 0, 26, 27, 18, 16),
(118, 7, 21, 6, 71, 0, 42, 0, 18, 19, 18, 16),
(119, 6, 21, 3, 95, 0, 42, 0, 27, 28, 20, 20),
(120, 12, 21, 5, 80, 0, 42, 0, 25, 25, 15, 15),
(121, 15, 21, 1, 94, 0, 42, 0, 28, 28, 20, 18),
(122, 14, 22, 1, 93, 0, 42, 0, 28, 28, 18, 19),
(123, 16, 22, 1, 96, 0, 42, 0, 28, 28, 20, 20),
(124, 5, 22, 1, 89, 0, 42, 0, 28, 28, 17, 16),
(126, 13, 22, 2, 88, 0, 42, 0, 28, 25, 17, 18),
(127, 4, 22, 1, 100, 0, 42, 0, 30, 30, 20, 20),
(128, 9, 22, 2, 93, 0, 42, 0, 28, 29, 18, 18),
(129, 11, 22, 6, 81, 0, 42, 0, 26, 25, 15, 15),
(130, 10, 22, 4, 85, 0, 42, 0, 26, 25, 16, 18),
(131, 7, 22, 2, 98, 0, 42, 0, 30, 28, 20, 20),
(132, 8, 22, 5, 78, 0, 42, 0, 25, 24, 14, 15),
(133, 12, 22, 2, 86, 0, 42, 0, 27, 27, 17, 15),
(134, 6, 22, 5, 93, 0, 42, 0, 28, 30, 15, 20),
(135, 15, 22, 5, 89, 0, 42, 0, 28, 27, 17, 17),
(136, 10, 23, 1, 93, 0, 42, 0, 28, 29, 19, 17),
(137, 4, 23, 2, 90, 0, 42, 0, 25, 25, 20, 20),
(138, 7, 23, 1, 100, 0, 42, 0, 30, 30, 20, 20),
(139, 9, 23, 1, 94, 0, 42, 0, 29, 28, 18, 19),
(140, 5, 23, 3, 86, 0, 42, 0, 28, 25, 17, 16),
(141, 14, 23, 3, 90, 0, 42, 0, 28, 28, 17, 17),
(142, 11, 23, 5, 82, 0, 42, 0, 27, 26, 15, 14),
(143, 16, 23, 3, 90, 0, 42, 0, 26, 26, 20, 18),
(144, 8, 23, 4, 82, 0, 42, 0, 24, 24, 17, 17),
(145, 13, 23, 4, 85, 0, 42, 0, 25, 25, 15, 20),
(146, 6, 23, 6, 90, 0, 42, 0, 28, 28, 18, 16),
(147, 15, 23, 7, 87, 0, 42, 0, 26, 26, 18, 17),
(148, 12, 23, 4, 82, 0, 42, 0, 27, 20, 15, 20),
(149, 10, 24, 7, 81, 0, 42, 0, 25, 24, 15, 17),
(150, 14, 24, 12, 68, 0, 42, 0, 19, 20, 14, 15),
(151, 5, 24, 9, 77, 0, 42, 0, 24, 24, 14, 15),
(152, 9, 24, 9, 83, 0, 42, 0, 26, 24, 17, 16),
(153, 16, 24, 8, 76, 0, 42, 0, 23, 21, 18, 14),
(154, 4, 24, 9, 50, 0, 42, 0, 15, 15, 10, 10),
(157, 11, 24, 9, 74, 0, 42, 0, 23, 20, 14, 17),
(158, 7, 24, 9, 56, 0, 42, 0, 14, 14, 13, 15),
(160, 13, 24, 5, 83, 0, 42, 0, 25, 22, 16, 20),
(169, 6, 24, 11, 70, 0, 42, 0, 24, 18, 13, 15),
(179, 8, 24, 9, 69, 0, 42, 0, 22, 23, 12, 12),
(182, 15, 24, 6, 88, 0, 42, 0, 26, 27, 16, 19),
(194, 12, 24, 3, 83, 0, 42, 0, 20, 25, 18, 20),
(199, 9, 25, 14, 75, 0, 42, 0, 23, 21, 16, 15),
(200, 14, 25, 14, 60, 0, 42, 0, 14, 19, 12, 15),
(201, 16, 25, 14, 56, 0, 42, 0, 14, 14, 14, 14),
(202, 10, 25, 13, 75, 0, 42, 0, 23, 23, 14, 15),
(203, 13, 25, 13, 60, 0, 42, 0, 25, 15, 10, 10),
(204, 11, 25, 8, 77, 0, 42, 0, 23, 24, 15, 15),
(206, 7, 25, 5, 74, 0, 42, 0, 21, 24, 13, 16),
(207, 4, 25, 12, 30, 0, 42, 0, 10, 10, 5, 5),
(208, 5, 25, 12, 71, 0, 42, 0, 22, 22, 14, 13),
(209, 15, 25, 12, 81, 0, 42, 0, 25, 26, 14, 16),
(210, 6, 25, 12, 67, 0, 42, 0, 23, 20, 14, 10),
(211, 8, 25, 10, 64, 0, 42, 0, 20, 20, 12, 12),
(212, 12, 25, 13, 50, 0, 42, 0, 18, 15, 10, 7),
(213, 14, 26, 11, 69, 0, 42, 0, 20, 20, 14, 15),
(214, 10, 26, 9, 79, 0, 42, 0, 24, 24, 15, 16),
(215, 11, 26, 1, 88, 0, 42, 0, 28, 28, 17, 15),
(216, 4, 26, 8, 55, 0, 42, 0, 15, 15, 15, 10),
(217, 6, 26, 4, 94, 0, 42, 0, 28, 26, 20, 20),
(219, 13, 26, 7, 81, 0, 42, 0, 25, 23, 18, 15),
(220, 5, 26, 10, 76, 0, 42, 0, 24, 23, 16, 13),
(221, 16, 26, 7, 80, 0, 42, 0, 23, 23, 17, 17),
(227, 9, 26, 6, 89, 0, 42, 0, 27, 27, 18, 17),
(230, 8, 26, 3, 83, 0, 42, 0, 26, 25, 16, 16),
(231, 7, 26, 10, 55, 0, 42, 0, 16, 16, 11, 12),
(232, 15, 26, 4, 90, 0, 42, 0, 28, 27, 18, 17),
(233, 12, 26, 1, 88, 0, 42, 0, 27, 27, 18, 16),
(234, 10, 27, 8, 80, 0, 42, 0, 24, 25, 15, 16),
(235, 11, 27, 8, 77, 0, 42, 0, 24, 26, 12, 15),
(236, 14, 27, 13, 65, 0, 42, 0, 17, 22, 14, 12),
(238, 7, 27, 12, 49, 0, 42, 0, 14, 15, 10, 10),
(240, 13, 27, 10, 78, 0, 42, 0, 25, 22, 17, 14),
(241, 5, 27, 8, 78, 0, 42, 0, 23, 24, 16, 15),
(242, 4, 27, 9, 50, 0, 42, 0, 15, 15, 10, 10),
(244, 8, 27, 5, 78, 0, 42, 0, 25, 23, 15, 15),
(245, 9, 27, 13, 76, 0, 42, 0, 22, 21, 16, 17),
(247, 16, 27, 9, 73, 0, 42, 0, 19, 19, 18, 17),
(248, 6, 27, 9, 83, 0, 42, 0, 25, 26, 14, 18),
(249, 12, 27, 7, 73, 0, 42, 0, 20, 20, 15, 18),
(250, 15, 27, 6, 88, 0, 42, 0, 26, 27, 17, 18),
(251, 11, 28, 10, 72, 0, 42, 0, 25, 22, 11, 14),
(252, 10, 28, 11, 77, 0, 42, 0, 23, 23, 15, 16),
(253, 9, 28, 12, 77, 0, 42, 0, 23, 21, 17, 16),
(254, 14, 28, 11, 69, 0, 42, 0, 22, 20, 14, 13),
(255, 4, 28, 11, 35, 0, 42, 0, 10, 10, 10, 5),
(256, 16, 28, 11, 68, 0, 42, 0, 21, 21, 13, 13),
(257, 12, 28, 14, 44, 0, 42, 0, 15, 15, 9, 5),
(258, 5, 28, 11, 72, 0, 42, 0, 21, 22, 14, 15),
(259, 7, 28, 11, 50, 0, 42, 0, 15, 15, 10, 10),
(260, 8, 28, 8, 70, 0, 42, 0, 20, 19, 16, 15),
(261, 13, 28, 11, 77, 0, 42, 0, 25, 22, 15, 15),
(262, 6, 28, 1, 99, 0, 42, 0, 30, 30, 19, 20),
(263, 15, 28, 11, 82, 0, 42, 0, 26, 25, 15, 16),
(265, 5, 29, 7, 80, 0, 42, 0, 26, 23, 15, 16),
(266, 11, 29, 5, 82, 0, 42, 0, 27, 27, 13, 15),
(267, 10, 29, 7, 81, 0, 42, 0, 24, 25, 16, 16),
(268, 9, 29, 2, 93, 0, 42, 0, 28, 29, 18, 18),
(269, 8, 29, 7, 75, 0, 42, 0, 24, 21, 16, 14),
(270, 14, 29, 15, 57, 0, 42, 0, 14, 20, 13, 10),
(271, 16, 29, 6, 82, 0, 42, 0, 23, 24, 17, 18),
(272, 7, 29, 8, 64, 0, 42, 0, 20, 18, 12, 14),
(273, 6, 29, 3, 95, 0, 42, 0, 28, 30, 18, 19),
(274, 13, 29, 7, 81, 0, 42, 0, 25, 23, 17, 16),
(275, 12, 29, 6, 78, 0, 42, 0, 25, 25, 15, 13),
(276, 15, 29, 3, 91, 0, 42, 0, 27, 28, 18, 18),
(277, 10, 30, 3, 86, 0, 42, 0, 26, 26, 17, 17),
(278, 9, 30, 9, 83, 0, 42, 0, 25, 24, 17, 17),
(281, 11, 30, 3, 85, 0, 42, 0, 27, 27, 16, 15),
(282, 13, 30, 7, 81, 0, 42, 0, 25, 23, 18, 15),
(283, 8, 30, 6, 77, 0, 42, 0, 24, 22, 14, 17),
(284, 7, 30, 3, 96, 0, 42, 0, 29, 28, 20, 19),
(285, 6, 30, 2, 96, 0, 42, 0, 28, 30, 18, 20),
(286, 14, 30, 7, 78, 0, 42, 0, 21, 21, 16, 20),
(287, 16, 30, 7, 80, 0, 42, 0, 22, 22, 18, 18),
(288, 15, 30, 5, 89, 0, 42, 0, 26, 26, 18, 19),
(289, 12, 30, 3, 83, 0, 42, 0, 25, 25, 18, 15),
(303, 5, 30, 9, 77, 0, 42, 0, 22, 24, 15, 16),
(304, 0, 15, 0, -2, 0, 42, 0, 0, 0, 0, 0),
(305, 0, 23, 0, -4, 0, 42, 0, 0, 0, 0, 0),
(307, 25, 14, 1, 100, 0, 42, 0, 30, 30, 20, 20),
(308, 25, 13, 1, 100, 0, 42, 0, 30, 30, 20, 20);

-- --------------------------------------------------------

--
-- Table structure for table `audience_votes`
--

CREATE TABLE `audience_votes` (
  `increment` int(11) NOT NULL,
  `contestant_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `ticket_id` varchar(32) NOT NULL,
  `date_voted` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audience_votes`
--

INSERT INTO `audience_votes` (`increment`, `contestant_id`, `event_id`, `votes`, `ticket_id`, `date_voted`) VALUES
(67, 31, 43, 1, '9159', 'Feb, 04 2019 at 3:13 AM'),
(68, 31, 43, 1, '9933117', 'Feb, 04 2019 at 3:27 AM'),
(69, 34, 43, 1, '135278', 'Feb, 04 2019 at 3:57 AM'),
(70, 32, 43, 1, '1570181', 'Feb, 04 2019 at 3:57 AM'),
(75, 32, 43, 1, '98057', 'Feb, 04 2019 at 4:04 AM'),
(76, 13, 42, 1, '9591', 'Feb, 04 2019 at 4:46 AM');

-- --------------------------------------------------------

--
-- Table structure for table `contest`
--

CREATE TABLE `contest` (
  `contest_id` int(11) NOT NULL,
  `contest_name` varchar(40) NOT NULL,
  `event_id` int(11) NOT NULL,
  `added_by_sponsor` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `top` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contest`
--

INSERT INTO `contest` (`contest_id`, `contest_name`, `event_id`, `added_by_sponsor`, `start`, `top`) VALUES
(20, 'Talents Night', 42, 12, 1, 5),
(21, 'Production Number', 43, 12, 1, 3),
(22, 'Sports Attire', 43, 12, 1, 0),
(24, 'Best in Swimsuit', 44, 14, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contestant_info_table`
--

CREATE TABLE `contestant_info_table` (
  `contestant_id` int(1) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `middle_name` varchar(32) NOT NULL,
  `sur_name` varchar(32) NOT NULL,
  `contestant_number` int(8) NOT NULL,
  `birthday` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `height` varchar(8) NOT NULL,
  `weight` varchar(8) NOT NULL,
  `age` int(11) NOT NULL,
  `complexion` varchar(18) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `municipality` varchar(30) NOT NULL,
  `province` varchar(32) NOT NULL,
  `zipcode` int(8) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contestant_code` varchar(20) NOT NULL,
  `event_id_sponsor` int(11) NOT NULL,
  `added_by_sponsor` int(11) NOT NULL,
  `over_all_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contestant_info_table`
--

INSERT INTO `contestant_info_table` (`contestant_id`, `first_name`, `middle_name`, `sur_name`, `contestant_number`, `birthday`, `sex`, `height`, `weight`, `age`, `complexion`, `email`, `phone_number`, `municipality`, `province`, `zipcode`, `username`, `password`, `contestant_code`, `event_id_sponsor`, `added_by_sponsor`, `over_all_total`) VALUES
(13, 'Jose Miguel', 'Abin', 'Tendencia', 1, '1998-11-14', 'Male', '171', '65', 20, 'Fair', 'jose@gmail.com', '', 'Baras', 'Catanduanes', 4803, 'jmiguel', 'default', 'J0qM3jU6k', 42, 12, 0),
(14, 'John Brix', 'Sabusap', 'Sabeniano', 2, '1998-07-15', 'Male', '163', '60', 20, 'Fair', 'johnbrix@gmail.com', '', 'Caramoran', 'Catanduanes', 4808, 'johnbrix', 'default', 'M2cU0lK0h', 42, 12, 0),
(15, 'Steven', 'Arevalo', 'Tabuzo', 3, '1998-09-10', 'Male', '164', '51', 19, 'Fair', 'steven@gmail.com', '', 'Virac', 'Catanduanes', 4800, 'steven', 'default', 'N8vZ7sJ2h', 42, 12, 0),
(16, 'Jerick Jay', 'Vergara', 'Tapia', 4, '1999-03-19', 'Male', '170', '72', 19, 'Fair', 'jerick@gmail.com', '', 'Virac', 'Catanduanes', 4800, 'jerickjay', 'default', 'R7rP8sR3l', 42, 12, 0),
(17, 'John Benedict', 'Null', 'Trilles', 5, '1998-09-05', 'Male', '170', '65', 20, 'Fair', 'benedict@gmail.com', '', 'Caramoran', 'Catanduanes', 4808, 'johnbenedict', 'default', 'K4gD7wG0l', 42, 12, 0),
(18, 'Joseph', 'Borja', 'Delos Santos', 6, '1998-06-30', 'Male', '174', '59', 20, 'Fair', 'joseph@gmail.com', '', 'Pandan', 'Catanduanes', 4809, 'joseph', 'default', 'E7oG5cF1c', 42, 12, 0),
(19, 'Nelson', 'Taperla', 'Torrente', 7, '2000-02-20', 'Male', '159', '55', 18, 'Fair', 'nelson@gmail.com', '', 'Bato', 'Catanduanes', 4801, 'nelson', 'default', 'J6oQ9hD6o', 42, 12, 0),
(20, 'Jun Lester', 'Frias', 'Vargas', 8, '1996-10-01', 'Male', '161', '58', 21, 'Fair', 'jun@gmail.com', '', 'Pandan', 'Catanduanes', 4809, 'junlester', 'default', 'Z4gP4gD1y', 42, 12, 0),
(21, 'Mark Oliver', 'Talaro', 'Sarmiento', 9, '1997-03-03', 'Male', '160', '56', 21, 'Fair', 'oliver@gmail.com', '', 'Virac', 'Catanduanes', 4800, 'markoliver', 'default', 'I6xV7qH0b', 42, 12, 0),
(22, 'Ian Paul', 'Panti', 'Balmadrid', 10, '1999-07-12', 'Male', '172', '55', 19, 'Fair', 'paul@gmail.com', '', 'Virac', 'Catanduanes', 4800, 'ianpaul', 'default', 'M9wQ1cV1a', 42, 12, 0),
(23, 'Joderic', 'Soneja', 'Araojo', 11, '1998-11-09', 'Male', '162', '48', 20, 'Fair', 'joderic@gmai.com', '', 'Virac', 'Catanduanes', 4800, 'joderic', 'default', 'M9vJ5lX8j', 42, 12, 0),
(24, 'John Arron', 'TemeÃ±a', 'Tulalian', 12, '1997-03-03', 'Male', '170', '65', 23, 'Fair', 'arron@gmail.com', '', 'Bato', 'Catanduanes', 4801, 'johnarron', 'default', 'W0pW2lM3y', 42, 12, 0),
(25, 'Ruel', 'Null', 'Toledana', 13, '1999-05-15', 'Male', '170', '65', 19, 'Fair', 'ruel@gmail.com', '', 'San Andress', 'Catanduanes', 4802, 'ruel', 'default', 'B0yY6tF5q', 42, 12, 0),
(26, 'Albert', 'Cebuano', 'Benitez', 14, '1999-01-03', 'Male', '170', '60', 19, 'Fair', 'albert@gmail.com', '', 'Virac', 'Catanduanes', 4800, 'albert', 'default', 'U3hC9cT9g', 42, 12, 0),
(27, 'Kristoffer', 'De Leon', 'Ogalesco', 15, '1998-04-10', 'Male', '167', '69', 20, 'Fair', 'kriss@gmail.com', '', 'Virac', 'Catanduanes', 4800, 'kristoffer', 'default', 'P0aV9cH5a', 42, 12, 0),
(28, 'Daniel', 'Null', 'Reoma', 16, '1999-12-12', 'Male', '168', '72', 18, 'Fair', 'daniel@gmail.com', '', 'Virac', 'Catanduanes', 4800, 'daniel', 'default', 'R4cS0lY1d', 42, 12, 0),
(29, 'Christian Gabriel', 'Tacorda', 'Tablate', 17, '2000-11-10', 'Male', '174', '50', 17, 'Fair', 'gabriel@gmail.com', '', 'Virac', 'Catanduanes', 4800, 'christiangabriel', 'default', 'X6bI0sR5s', 42, 12, 0),
(30, 'Mark Anthony', 'Diwata', 'Gianan', 18, '1998-01-23', 'Male', '164', '52', 20, 'Fair', 'gianan@gmail.com', '', 'Virac', 'Catanduanes', 4800, 'markanthony', 'default', 'Q9lB2iE4g', 42, 12, 0),
(31, 'Lyndon ', 'Abin ', 'Sins', 1, '2018-12-09', 'Male', '180', '50', 20, 'Fair', 'null@yahoo.com', '', 'Viga', 'Catanduanes', 4800, 'josemiguel', 'default', 'N1hJ4yV2l', 43, 12, 0),
(32, 'Jack', 'Paul', 'Jack', 2, '2018-12-12', 'Male', '180', '50', 20, 'Fair', 'isaacdarcilla@yahoo.com', '', 'Viga', 'Catanduanes', 4800, 'jack', 'default', 'W8gG3eG1v', 43, 12, 0),
(34, 'John Paul', 'Khalifa', 'Banares', 3, '2018-12-19', 'Male', '180', '60', 24, 'Fair', 'jp@yahoo.com', '', 'San Andres', 'Catanduanes', 4800, 'johnpaul', 'default', 'A4gZ2nO0h', 43, 12, 0),
(35, 'Donita', 'M', 'Teano', 1, '2019-02-09', 'Female', '180', '60', 20, 'Fair', 'donita@yahoo.com', '', 'Viga', 'Catanduanes', 4800, 'donita', 'default', 'O3yA8nP1p', 44, 14, 0),
(36, 'Jonah', 'M', 'Sarmiento', 2, '2019-02-09', 'Female', '180', '60', 20, 'Fair', 'jonah@yahoo.com', '', 'Virac', 'Catanduanes', 4800, 'jonah', 'default', 'Q1fH2dU8k', 44, 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `criteria_and_contest`
--

CREATE TABLE `criteria_and_contest` (
  `increment` int(11) NOT NULL,
  `criteria_id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `added_by_sponsor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `criteria_and_contest`
--

INSERT INTO `criteria_and_contest` (`increment`, `criteria_id`, `contest_id`, `percentage`, `event_id`, `added_by_sponsor`) VALUES
(39, 47, 20, 30, 42, 12),
(40, 48, 20, 30, 42, 12),
(41, 49, 20, 20, 42, 12),
(42, 50, 20, 20, 42, 12),
(43, 51, 21, 100, 43, 12),
(44, 52, 22, 100, 43, 12),
(45, 53, 23, 20, 43, 12),
(46, 54, 23, 80, 43, 12),
(47, 55, 24, 20, 44, 14),
(48, 56, 24, 30, 44, 14),
(49, 57, 24, 25, 44, 14),
(50, 58, 24, 25, 44, 14);

-- --------------------------------------------------------

--
-- Table structure for table `criteria_contest`
--

CREATE TABLE `criteria_contest` (
  `criteria_id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `added_by_sponsor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `criteria_of_judging`
--

CREATE TABLE `criteria_of_judging` (
  `criteria_id` int(1) NOT NULL,
  `criterias` varchar(80) NOT NULL,
  `event_id` int(11) NOT NULL,
  `added_by_sponsor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `criteria_of_judging`
--

INSERT INTO `criteria_of_judging` (`criteria_id`, `criterias`, `event_id`, `added_by_sponsor`) VALUES
(47, 'Originality & Creativity', 42, 12),
(48, 'Delivery/Performance', 42, 12),
(49, 'Appeal to the Intellect & Emotion', 42, 12),
(50, 'Appropriateness of Attire & Effectiveness of Technical Devices', 42, 12),
(51, 'Originality', 43, 12),
(52, 'Relevance', 43, 12),
(53, 'Content of Answer', 43, 12),
(54, 'Delivery', 43, 12),
(55, 'Posture ', 44, 14),
(56, 'Execution of Modeling Technique & Movement', 44, 14),
(57, 'Confidence ', 44, 14),
(58, 'Poise & Choice of Swimsuit', 44, 14);

-- --------------------------------------------------------

--
-- Table structure for table `event_logs`
--

CREATE TABLE `event_logs` (
  `log_id` int(11) NOT NULL,
  `event_id` smallint(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL,
  `sponsor_id` int(11) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_logs`
--

INSERT INTO `event_logs` (`log_id`, `event_id`, `status`, `message`, `sponsor_id`, `created_at`) VALUES
(5, 43, 'Success', 'Added Arjay Tarnate as judge by FYESA', 12, 'Dec, 19 2018 at 10:57 am'),
(6, 43, 'Success', 'Arjay Tarnate was selected as judge for Miss Mach-O: Coronation Night', 12, 'Dec, 19 2018 at 10:58 am'),
(7, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Dec, 19 2018 at 11:49 am'),
(8, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Dec, 19 2018 at 11:51 am'),
(9, 43, 'Added', 'Contest Question and Answer for Miss Mach-O: Coronation Night successfully added by FYESA', 12, 'Dec, 19 2018 at 12:01 pm'),
(10, 43, 'Added', 'Content of Answer with 20% for contest Question and Answer was added by FYESA', 12, 'Dec, 19 2018 at 12:07 pm'),
(11, 43, 'Signed', 'Delivery with 80% for contest Question and Answer was added by FYESA', 12, 'Dec, 19 2018 at 12:10 pm'),
(13, 43, 'Rename', 'Question & Answer successfully renamed to Question And Answer', 12, 'Dec, 19 2018 at 12:20 pm'),
(14, 43, 'Removed', 'Question And Answer was removed from Miss Mach-O: Coronation Night', 12, 'Dec, 19 2018 at 12:23 pm'),
(15, 43, 'Added', 'John Paul Banares was successfully registered as contestant for ', 12, 'Dec, 19 2018 at 12:29 pm'),
(16, 43, 'Added', 'John Paul Banares was successfully registered as contestant for Miss Mach-O: Coronation Night', 12, 'Dec, 19 2018 at 12:30 pm'),
(17, 0, 'Signed', 'Successfully logged in as ', 0, 'Dec, 20 2018 at 6:58 am'),
(18, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Dec, 20 2018 at 6:58 am'),
(19, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Dec, 20 2018 at 6:58 am'),
(20, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Dec, 20 2018 at 7:27 am'),
(21, 0, 'Signed', 'Successfully logged in as ', 0, 'Dec, 20 2018 at 7:29 am'),
(22, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Dec, 20 2018 at 7:30 am'),
(23, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Dec, 20 2018 at 7:30 am'),
(24, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Dec, 21 2018 at 2:24 am'),
(25, 43, 'Removed', 'Individual score was deleted from contestant in Sports Attire', 12, 'Dec, 21 2018 at 2:54 am'),
(26, 43, 'Success', 'Overall scores for Miss Mach-O: Coronation Night was submitted', 12, 'Dec, 21 2018 at 3:01 am'),
(27, 43, 'Removed', 'Individual score was deleted from contestant in Sports Attire', 12, 'Dec, 21 2018 at 5:40 am'),
(28, 43, 'Removed', 'Individual score was deleted from contestant in Production Number', 12, 'Dec, 21 2018 at 5:41 am'),
(29, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Dec, 21 2018 at 5:44 am'),
(30, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Dec, 22 2018 at 1:57 pm'),
(31, 43, 'Removed', 'Individual score was deleted from contestant in Production Number', 12, 'Dec, 23 2018 at 6:52 am'),
(32, 43, 'Removed', 'Individual score was deleted from contestant in Production Number', 12, 'Dec, 23 2018 at 6:52 am'),
(33, 43, 'Removed', 'Individual score was deleted from contestant in Production Number', 12, 'Dec, 23 2018 at 6:52 am'),
(34, 0, 'Signed', 'Successfully logged in as ', 0, 'Dec, 23 2018 at 7:00 am'),
(35, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Dec, 23 2018 at 7:00 am'),
(36, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Jan, 06 2019 at 12:39 pm'),
(37, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Jan, 06 2019 at 1:36 pm'),
(38, 0, 'Signed', 'Successfully logged in as CPESA', 13, 'Jan, 07 2019 at 1:16 pm'),
(39, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Jan, 07 2019 at 1:19 pm'),
(40, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Jan, 08 2019 at 2:45 pm'),
(41, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Jan, 09 2019 at 4:14 am'),
(42, 43, 'Success', 'Overall scores for Miss Mach-O: Coronation Night was submitted', 12, 'Jan, 09 2019 at 4:15 am'),
(43, 43, 'Success', 'Overall scores for Miss Mach-O: Coronation Night was submitted', 12, 'Jan, 09 2019 at 4:15 am'),
(44, 43, 'Success', 'Overall scores for Miss Mach-O: Coronation Night was submitted', 12, 'Jan, 09 2019 at 4:15 am'),
(45, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Jan, 10 2019 at 3:41 am'),
(46, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Jan, 10 2019 at 1:24 pm'),
(47, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Jan, 12 2019 at 4:51 am'),
(48, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Jan, 16 2019 at 2:50 pm'),
(49, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Jan, 22 2019 at 2:52 pm'),
(50, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Jan, 22 2019 at 2:53 pm'),
(51, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Feb, 04 2019 at 2:58 am'),
(52, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Feb, 04 2019 at 4:08 am'),
(53, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Feb, 04 2019 at 4:10 am'),
(54, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Feb, 04 2019 at 4:36 am'),
(55, 42, 'Removed', 'Individual score was deleted from contestant in Talents Night', 12, 'Feb, 04 2019 at 4:37 am'),
(56, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Feb, 04 2019 at 9:11 am'),
(57, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Feb, 04 2019 at 9:15 am'),
(58, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Feb, 08 2019 at 3:01 pm'),
(59, 0, 'Signed', 'Successfully logged in as FCSC', 14, 'Feb, 08 2019 at 3:10 pm'),
(60, 0, 'Signed', 'Successfully logged in as FCSC', 14, 'Feb, 08 2019 at 3:16 pm'),
(61, 0, 'Signed', 'Successfully logged in as ', 0, 'Feb, 08 2019 at 3:17 pm'),
(62, 0, 'Signed', 'Successfully logged in as CPESA', 13, 'Feb, 08 2019 at 3:17 pm'),
(63, 0, 'Signed', 'Successfully logged in as FCSC', 14, 'Feb, 08 2019 at 3:19 pm'),
(64, 0, 'Signed', 'Successfully logged in as CPESA', 13, 'Feb, 08 2019 at 3:20 pm'),
(65, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Feb, 08 2019 at 3:20 pm'),
(66, 0, 'Signed', 'Successfully logged in as FCSC', 14, 'Feb, 08 2019 at 3:21 pm'),
(67, 0, 'Signed', 'Successfully logged in as FCSC', 14, 'Feb, 08 2019 at 6:30 pm'),
(68, 44, 'Success', 'Added Donita Teano as judge by FCSC', 14, 'Feb, 08 2019 at 6:38 pm'),
(69, 44, 'Success', 'Added Jonah Sarmiento as judge by FCSC', 14, 'Feb, 08 2019 at 6:39 pm'),
(70, 44, 'Added', 'Donita Teano was successfully registered as contestant for Miss Engineering ', 14, 'Feb, 08 2019 at 6:44 pm'),
(71, 44, 'Added', 'Jonah Sarmiento was successfully registered as contestant for Miss Engineering ', 14, 'Feb, 08 2019 at 6:44 pm'),
(72, 44, 'Signed', 'Contest Swim Wear Attire for Miss Engineering  successfully added by FCSC', 14, 'Feb, 08 2019 at 6:48 pm'),
(73, 44, 'Removed', 'Swim Wear Attire was removed from Miss Engineering ', 14, 'Feb, 08 2019 at 6:48 pm'),
(74, 44, 'Signed', 'Contest Best in Swimsuit for Miss Engineering  successfully added by FCSC', 14, 'Feb, 08 2019 at 6:49 pm'),
(75, 44, 'Added', 'Posture  with 20% for contest Best in Swimsuit was added by FCSC', 14, 'Feb, 08 2019 at 6:50 pm'),
(76, 44, 'Added', 'Execution of Modeling Technique & Movement with 30% for contest Best in Swimsuit was added by FCSC', 14, 'Feb, 08 2019 at 6:51 pm'),
(77, 44, 'Added', 'Confidence  with 25% for contest Best in Swimsuit was added by FCSC', 14, 'Feb, 08 2019 at 6:51 pm'),
(78, 44, 'Added', 'Poise & Choice of Swimsuit with 25% for contest Best in Swimsuit was added by FCSC', 14, 'Feb, 08 2019 at 6:52 pm'),
(79, 44, 'Success', 'Added Morris Aquino as judge by FCSC', 14, 'Feb, 08 2019 at 6:54 pm'),
(80, 44, 'Success', 'Morris Aquino was selected as judge for Miss Engineering ', 14, 'Feb, 08 2019 at 6:54 pm'),
(81, 44, 'Removed', 'Individual score was deleted from contestant in Best in Swimsuit', 14, 'Feb, 08 2019 at 6:57 pm'),
(82, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Jan, 10 2020 at 7:15 am'),
(83, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Feb, 06 2020 at 7:35 am'),
(84, 0, 'Signed', 'Successfully logged in as FYESA', 12, 'Feb, 21 2020 at 5:05 am');

-- --------------------------------------------------------

--
-- Table structure for table `event_sponsor_two`
--

CREATE TABLE `event_sponsor_two` (
  `increment` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `sponsor_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_sponsor_two`
--

INSERT INTO `event_sponsor_two` (`increment`, `event_id`, `sponsor_id`, `added_by`) VALUES
(8, 42, 12, 1),
(9, 43, 12, 1),
(11, 44, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_table`
--

CREATE TABLE `event_table` (
  `event_id` int(5) NOT NULL,
  `event_name` varchar(32) NOT NULL,
  `event_code` varchar(8) NOT NULL,
  `event_location` varchar(50) NOT NULL,
  `event_time` varchar(10) NOT NULL,
  `event_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `judging_system` int(11) NOT NULL,
  `invite_code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_table`
--

INSERT INTO `event_table` (`event_id`, `event_name`, `event_code`, `event_location`, `event_time`, `event_date`, `created_by`, `judging_system`, `invite_code`) VALUES
(42, 'Miss Mach-O: Talents Night', 'MM2018', 'CSU Gymnasium', '7:00 PM', '2018-11-23', 1, 0, 'SS5Y7H'),
(43, 'Miss Mach-O: Coronation Night', 'MACHO', 'CSU Gymnasium', '12:00 AM', '2018-12-09', 1, 0, 'Q8H0D2'),
(44, 'Miss Engineering ', 'CPESA', 'Ateneo de Naga', '12:00 AM', '2018-11-21', 1, 0, 'P8G4E3');

-- --------------------------------------------------------

--
-- Table structure for table `join_event`
--

CREATE TABLE `join_event` (
  `increment` int(11) NOT NULL,
  `contestant_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `event_total` int(11) NOT NULL,
  `event_rank` int(11) NOT NULL,
  `event_deduction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `judge_event`
--

CREATE TABLE `judge_event` (
  `increment` int(11) NOT NULL,
  `judge_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `added_by_sponsor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `judge_event`
--

INSERT INTO `judge_event` (`increment`, `judge_id`, `event_id`, `added_by_sponsor`) VALUES
(4, 4, 42, 12),
(5, 5, 42, 12),
(6, 6, 42, 12),
(7, 7, 42, 12),
(8, 8, 42, 12),
(9, 9, 42, 12),
(10, 10, 42, 12),
(11, 11, 42, 12),
(12, 12, 42, 12),
(13, 13, 42, 12),
(14, 14, 42, 12),
(15, 15, 42, 12),
(16, 16, 42, 12),
(20, 17, 43, 12),
(21, 19, 43, 12),
(22, 25, 42, 12),
(28, 28, 43, 12),
(29, 33, 44, 14);

-- --------------------------------------------------------

--
-- Table structure for table `judge_rate_software`
--

CREATE TABLE `judge_rate_software` (
  `increment` int(11) NOT NULL,
  `judge_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `args` varchar(20) NOT NULL,
  `remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `judge_rate_software`
--

INSERT INTO `judge_rate_software` (`increment`, `judge_id`, `event_id`, `rate`, `args`, `remarks`) VALUES
(1, 17, 43, 3, 'isaac', 'I love it'),
(2, 17, 43, 3, 'isaac', 'I love it'),
(3, 17, 43, 3, 'isaac', 'I love it'),
(4, 17, 43, 3, 'isaac', 'I love it'),
(5, 17, 43, 3, 'isaac', 'I love it'),
(6, 17, 43, 3, 'isaac', 'I love it'),
(7, 17, 43, 3, 'isaac', 'I love it'),
(8, 17, 43, 1, 'isaac', 'I hate it'),
(9, 17, 43, 1, 'isaac', 'I hate it'),
(10, 17, 43, 1, 'isaac', 'I hate it'),
(11, 17, 43, 1, 'isaac', 'I hate it'),
(12, 17, 43, 2, 'isaac', 'I like it');

-- --------------------------------------------------------

--
-- Table structure for table `judge_table`
--

CREATE TABLE `judge_table` (
  `judge_id` int(1) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `middle_name` varchar(32) NOT NULL,
  `sur_name` varchar(32) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profession` varchar(32) NOT NULL,
  `registered_by_sponsor` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `is_updated` int(11) NOT NULL,
  `is_unhash` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `judge_table`
--

INSERT INTO `judge_table` (`judge_id`, `first_name`, `middle_name`, `sur_name`, `sex`, `email`, `phone_number`, `username`, `password`, `profession`, `registered_by_sponsor`, `event_id`, `is_updated`, `is_unhash`) VALUES
(17, 'Isaac', 'Diwata', 'Newton', 'Straight', 'isaacdarcilla@pageant.com', '0900000000', 'isaac', 'Y4S0F6', 'Engineer', 12, 43, 0, 'd83cc5be0237b88192490e31adbe3822');

-- --------------------------------------------------------

--
-- Table structure for table `official_scores`
--

CREATE TABLE `official_scores` (
  `increment` int(255) NOT NULL,
  `contestant_number` int(11) NOT NULL,
  `contestant_name` varchar(50) NOT NULL,
  `final_ranking` int(11) NOT NULL,
  `overall_percentage` float NOT NULL,
  `overall_points` int(11) NOT NULL,
  `deductions` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `overall`
--

CREATE TABLE `overall` (
  `increment` int(255) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `contestant_id` int(11) NOT NULL,
  `contestant_number` int(11) NOT NULL,
  `contestant_name` varchar(50) NOT NULL,
  `deductions` int(11) NOT NULL,
  `percentage` decimal(11,0) NOT NULL,
  `total_points` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overall`
--

INSERT INTO `overall` (`increment`, `contest_id`, `contestant_id`, `contestant_number`, `contestant_name`, `deductions`, `percentage`, `total_points`, `rank`, `event_id`) VALUES
(1, 20, 22, 10, 'Ian Paul Balmadrid', 0, '37', 1169, 1, 42),
(2, 20, 23, 11, 'Joderic Araojo', 4, '44', 1147, 2, 42),
(3, 20, 21, 9, 'Mark Oliver Sarmiento', 0, '54', 1101, 3, 42),
(4, 20, 20, 8, 'Jun Lester Vargas', 0, '66', 1059, 4, 42),
(5, 20, 30, 18, 'Mark Anthony Gianan', 0, '69', 1081, 5, 42),
(6, 20, 14, 2, 'John Brix Sabeniano', 0, '69', 1074, 5, 42),
(7, 20, 15, 3, 'Steven Tabuzo', 2, '79', 1026, 6, 42),
(8, 20, 26, 14, 'Albert Benitez', 0, '81', 1027, 7, 42),
(9, 20, 17, 5, 'John Benedict Trilles', 0, '84', 1025, 8, 42),
(10, 20, 29, 17, 'Christian Gabriel Tablate', 0, '85', 1009, 9, 42),
(11, 20, 24, 12, 'John Arron Tulalian', 0, '106', 958, 10, 42),
(12, 20, 18, 6, 'Joseph Delos Santos', 0, '112', 965, 11, 42),
(13, 20, 13, 1, 'Jose Miguel Tendencia', 0, '113', 936, 12, 42),
(14, 20, 16, 4, 'Jerick Jay Tapia', 0, '117', 952, 13, 42),
(15, 20, 27, 15, 'Kristoffer Ogalesco', 0, '117', 948, 13, 42),
(16, 20, 28, 16, 'Daniel Reoma', 0, '133', 892, 14, 42),
(17, 20, 25, 13, 'Ruel Toledana', 0, '152', 840, 15, 42),
(18, 20, 19, 7, 'Nelson Torrente', 0, '155', 821, 16, 42),
(19, 21, 32, 2, 'Jack Jack', 0, '2', 197, 1, 43),
(20, 21, 31, 1, 'Lyndon  Sins', 0, '4', 179, 2, 43),
(21, 21, 34, 3, 'John Paul Banares', 0, '5', 168, 3, 43);

-- --------------------------------------------------------

--
-- Table structure for table `sponsor_organizer`
--

CREATE TABLE `sponsor_organizer` (
  `sponsor_id` int(15) NOT NULL,
  `sponsor_name` varchar(50) NOT NULL,
  `in_charge` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `established` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `registered_by` int(11) NOT NULL,
  `pass_unhash` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sponsor_organizer`
--

INSERT INTO `sponsor_organizer` (`sponsor_id`, `sponsor_name`, `in_charge`, `position`, `established`, `email`, `phone_number`, `username`, `password`, `registered_by`, `pass_unhash`) VALUES
(12, 'FYESA', 'Jhonel Ragos', 'President', '22/11/2018', 'jondexter.017@gmail.com', '', 'fyesa', '683d75426de7ee73ca95e06a0e453275', 1, 'MM2018'),
(13, 'CpESA', 'Francis Palomer', 'President', '22/11/2018', 'francis@yahoo.com', '', 'cpesa', '3aa496174336442aa08db8b4ba7b6fbd', 1, 'CPE2018'),
(14, 'FCSC', 'Isaac Arcilla', 'President', '08/02/2019', 'fcsc@yahoo.com', '', 'fcsc', '21232f297a57a5a743894a0e4a801fc3', 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `ticketing`
--

CREATE TABLE `ticketing` (
  `ticket_id` int(11) NOT NULL,
  `ticket_number` varchar(45) DEFAULT NULL,
  `event_id` int(45) DEFAULT NULL,
  `sponsor_id` int(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticketing`
--

INSERT INTO `ticketing` (`ticket_id`, `ticket_number`, `event_id`, `sponsor_id`) VALUES
(48, '9933117', 43, 12),
(49, '135278', 43, 12),
(50, '1570181', 43, 12),
(51, '945977', 43, 12),
(52, '363075', 43, 12),
(53, '912644', 43, 12),
(54, '98057', 43, 12),
(55, '455474', 43, 12),
(56, '4956131', 43, 12),
(57, '9159', 43, 12),
(58, '4945116', 43, 12),
(59, '863212', 43, 12),
(60, '9616173', 43, 12),
(61, '59315', 43, 12),
(62, '7650152', 43, 12),
(63, '3683168', 43, 12),
(64, '273141', 43, 12),
(65, '8249111', 43, 12),
(66, '9038100', 43, 12),
(67, '845140', 43, 12),
(68, '2325158', 43, 12),
(69, '566683', 43, 12),
(70, '9326161', 43, 12),
(71, '956580', 43, 12),
(72, '683358', 42, 12),
(73, '717954', 42, 12),
(74, '8259164', 42, 12),
(75, '2046181', 42, 12),
(76, '547122', 42, 12),
(77, '716154', 42, 12),
(78, '974039', 42, 12),
(79, '872759', 42, 12),
(80, '962125', 42, 12),
(81, '9591', 42, 12),
(82, '862125', 42, 12),
(83, '2348', 42, 12),
(84, '252419', 42, 12),
(85, '7869199', 42, 12),
(86, '699179', 42, 12),
(87, '839112', 42, 12),
(88, '505968', 42, 12),
(89, '786049', 42, 12),
(90, '606336', 44, 14),
(91, '354289', 44, 14),
(92, '7445149', 44, 14),
(93, '492143', 44, 14),
(94, '2137129', 44, 14),
(95, '2156193', 44, 14),
(96, '456510', 44, 14);

-- --------------------------------------------------------

--
-- Table structure for table `top_contestant`
--

CREATE TABLE `top_contestant` (
  `increment` int(11) NOT NULL,
  `sponsor_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `top_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` smallint(8) NOT NULL,
  `admin` varchar(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `admin`, `username`, `email`, `password`) VALUES
(1, 'Isaac', 'isaac', 'isaacdarcilla@yahoo.com', '8bdca1674961121a55ac330e734a24ea');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `00-auto-bestinswimsuit`
--
ALTER TABLE `00-auto-bestinswimsuit`
  ADD PRIMARY KEY (`increment`);

--
-- Indexes for table `00-auto-productionnumber`
--
ALTER TABLE `00-auto-productionnumber`
  ADD PRIMARY KEY (`increment`);

--
-- Indexes for table `00-auto-sportsattire`
--
ALTER TABLE `00-auto-sportsattire`
  ADD PRIMARY KEY (`increment`);

--
-- Indexes for table `00-auto-talentsnight`
--
ALTER TABLE `00-auto-talentsnight`
  ADD PRIMARY KEY (`increment`);

--
-- Indexes for table `audience_votes`
--
ALTER TABLE `audience_votes`
  ADD PRIMARY KEY (`increment`);

--
-- Indexes for table `contest`
--
ALTER TABLE `contest`
  ADD PRIMARY KEY (`contest_id`),
  ADD UNIQUE KEY `contest_name` (`contest_name`);

--
-- Indexes for table `contestant_info_table`
--
ALTER TABLE `contestant_info_table`
  ADD PRIMARY KEY (`contestant_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `contestant_info_identification` (`contestant_id`);

--
-- Indexes for table `criteria_and_contest`
--
ALTER TABLE `criteria_and_contest`
  ADD PRIMARY KEY (`increment`);

--
-- Indexes for table `criteria_contest`
--
ALTER TABLE `criteria_contest`
  ADD PRIMARY KEY (`criteria_id`,`contest_id`),
  ADD UNIQUE KEY `contest_id` (`contest_id`);

--
-- Indexes for table `criteria_of_judging`
--
ALTER TABLE `criteria_of_judging`
  ADD PRIMARY KEY (`criteria_id`);

--
-- Indexes for table `event_logs`
--
ALTER TABLE `event_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `event_sponsor_two`
--
ALTER TABLE `event_sponsor_two`
  ADD PRIMARY KEY (`increment`);

--
-- Indexes for table `event_table`
--
ALTER TABLE `event_table`
  ADD PRIMARY KEY (`event_id`),
  ADD UNIQUE KEY `event_name` (`event_name`);

--
-- Indexes for table `join_event`
--
ALTER TABLE `join_event`
  ADD PRIMARY KEY (`increment`);

--
-- Indexes for table `judge_event`
--
ALTER TABLE `judge_event`
  ADD PRIMARY KEY (`increment`);

--
-- Indexes for table `judge_rate_software`
--
ALTER TABLE `judge_rate_software`
  ADD PRIMARY KEY (`increment`);

--
-- Indexes for table `judge_table`
--
ALTER TABLE `judge_table`
  ADD PRIMARY KEY (`judge_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `official_scores`
--
ALTER TABLE `official_scores`
  ADD PRIMARY KEY (`increment`);

--
-- Indexes for table `overall`
--
ALTER TABLE `overall`
  ADD PRIMARY KEY (`increment`);

--
-- Indexes for table `sponsor_organizer`
--
ALTER TABLE `sponsor_organizer`
  ADD PRIMARY KEY (`sponsor_id`),
  ADD UNIQUE KEY `sponsor_identification` (`sponsor_id`),
  ADD UNIQUE KEY `sponsor_name` (`sponsor_name`);

--
-- Indexes for table `ticketing`
--
ALTER TABLE `ticketing`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `top_contestant`
--
ALTER TABLE `top_contestant`
  ADD PRIMARY KEY (`increment`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `00-auto-bestinswimsuit`
--
ALTER TABLE `00-auto-bestinswimsuit`
  MODIFY `increment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `00-auto-productionnumber`
--
ALTER TABLE `00-auto-productionnumber`
  MODIFY `increment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `00-auto-sportsattire`
--
ALTER TABLE `00-auto-sportsattire`
  MODIFY `increment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `00-auto-talentsnight`
--
ALTER TABLE `00-auto-talentsnight`
  MODIFY `increment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT for table `audience_votes`
--
ALTER TABLE `audience_votes`
  MODIFY `increment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `contest`
--
ALTER TABLE `contest`
  MODIFY `contest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `contestant_info_table`
--
ALTER TABLE `contestant_info_table`
  MODIFY `contestant_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `criteria_and_contest`
--
ALTER TABLE `criteria_and_contest`
  MODIFY `increment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `criteria_of_judging`
--
ALTER TABLE `criteria_of_judging`
  MODIFY `criteria_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `event_logs`
--
ALTER TABLE `event_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `event_sponsor_two`
--
ALTER TABLE `event_sponsor_two`
  MODIFY `increment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `event_table`
--
ALTER TABLE `event_table`
  MODIFY `event_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `join_event`
--
ALTER TABLE `join_event`
  MODIFY `increment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `judge_event`
--
ALTER TABLE `judge_event`
  MODIFY `increment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `judge_rate_software`
--
ALTER TABLE `judge_rate_software`
  MODIFY `increment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `judge_table`
--
ALTER TABLE `judge_table`
  MODIFY `judge_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `official_scores`
--
ALTER TABLE `official_scores`
  MODIFY `increment` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `overall`
--
ALTER TABLE `overall`
  MODIFY `increment` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sponsor_organizer`
--
ALTER TABLE `sponsor_organizer`
  MODIFY `sponsor_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ticketing`
--
ALTER TABLE `ticketing`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `top_contestant`
--
ALTER TABLE `top_contestant`
  MODIFY `increment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` smallint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `criteria_contest`
--
ALTER TABLE `criteria_contest`
  ADD CONSTRAINT `criteria_contest_ibfk_1` FOREIGN KEY (`criteria_id`) REFERENCES `criteria_of_judging` (`criteria_id`),
  ADD CONSTRAINT `criteria_contest_ibfk_2` FOREIGN KEY (`contest_id`) REFERENCES `contest` (`contest_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
