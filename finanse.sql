-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2019 at 07:02 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finanse`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expenseId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL,
  `payingMethod` text COLLATE utf8_polish_ci NOT NULL,
  `category` text COLLATE utf8_polish_ci NOT NULL,
  `comment` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expenseId`, `userId`, `amount`, `date`, `payingMethod`, `category`, `comment`) VALUES
(1, 10, 233, '0000-00-00', 'kd', 'o', ''),
(2, 10, 122, '2019-10-29', 'kd', 'e', ''),
(3, 10, 10, '2019-11-06', 'kd', 'e', '45345gffgf'),
(4, 10, 10, '2019-11-06', 'kd', 'e', '45345gffgf'),
(5, 10, 15, '2019-11-13', 'kd', 'o', ''),
(6, 10, 3223, '2019-11-05', 'kd', 'o', ''),
(7, 11, 15, '2019-11-05', 'kd', 'o', '');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `incomeId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL,
  `category` text COLLATE utf8_polish_ci NOT NULL,
  `comment` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`incomeId`, `userId`, `amount`, `date`, `category`, `comment`) VALUES
(1, 10, 122, '2019-11-12', 'kd', 'aaaaa'),
(2, 10, 12.22, '2019-11-12', 'kk', 'sadassda'),
(10, 10, 423, '2019-11-03', 'g', ''),
(11, 10, 423, '2019-11-03', 'g', ''),
(12, 10, 15, '2019-11-03', 'g', 'sdaada$$@#@'),
(13, 10, 10, '2019-11-03', 'kd', 'aaaaa'),
(14, 11, 15231.2, '2019-11-03', 'kd', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(10, 'Pawel', 'pawluh.p@gmail.com', '$2y$10$n2ob1LOj4itIyzh9sWlY3ORAUZkCUopFp48oGUA2I0PffqiT568kG'),
(11, 'Pawel', 'paczwap@gmail.com', '$2y$10$EOzg0XmkaAzRCsgHZEd18Ob3CW7BE4SMMyHWRmtODR3DB77j4jARu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expenseId`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`incomeId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `incomeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
