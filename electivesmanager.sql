-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2019 at 10:39 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electivesmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `electives`
--

CREATE TABLE `electives` (
  `name` varchar(140) NOT NULL,
  `lecturer` varchar(140) NOT NULL,
  `assistant` varchar(140) DEFAULT NULL,
  `busyness` int(11) DEFAULT NULL,
  `description` text,
  `requirements` text,
  `results` text,
  `creator` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `electives`
--

INSERT INTO `electives` (`name`, `lecturer`, `assistant`, `busyness`, `description`, `requirements`, `results`, `creator`) VALUES
('Programming Basics', 'Ivan Ivanov2', 'Petko Petkov23', 140, 'Very hard.', 'SO hard.', 'So hd.', 'asdasd'),
('Pyhton', 'Pesho Peshev', 'Mitko Mitkov Mitkov', 123, 'Very interesting.', 'Java and Rust.', 'Expand your previous knowledge.', 'asdasd'),
('Rust', 'Mitko Dimitrov', 'Petko Petkovvski', 140, 'Very hard.', 'Programming, Python.', 'Will start their first job.', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`) VALUES
('asdasd', '$2y$10$vSuQ8hJ1ce/xCua9g2ahRuC9UM0QEkasX9CohH3zFvdF5Wn/KDIPm', 'asd@abv.bg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `electives`
--
ALTER TABLE `electives`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
