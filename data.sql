-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2023 at 09:44 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignmrnt2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admi`
--

CREATE TABLE `admi` (
  `userName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwrd` varchar(50) NOT NULL,
  `phoneNumber` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admi`
--

INSERT INTO `admi` (`userName`, `email`, `passwrd`, `phoneNumber`) VALUES
('naveen', 'dileebandileeban2001@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 771234567),
('s.dileeban', 'dileebandileeban746@gmail.com', 'cb3ce9b06932da6faaa7fc70d5b5d2f4', 456221132),
('shashinda', 'fnfj@gmail.bet', '4a7d1ed414474e4033ac29ccb8653d9b', 789456123),
('kamal', 'kamal@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 2147483647),
('shjh.dileeban', 'kavi@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b', 4565341),
('lakshan', 'lakshan@gmail.com', '6074c6aa3488f3c2dddff2a7ca821aab', 789456123),
('nimal', 'nimal@gmail.com', '6074c6aa3488f3c2dddff2a7ca821aab', 2147483647),
('sunil', 'sunil@gmail.com', '98cb5b96ac325a5bfe0131efe0798cb2', 754123655),
('kavi', 'wixat21374@paldept.com', '6074c6aa3488f3c2dddff2a7ca821aab', 1234567);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_name` varchar(50) NOT NULL,
  `prod_des` text NOT NULL,
  `price` int(10) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qty` int(200) NOT NULL,
  `prod_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_name`, `prod_des`, `price`, `prod_id`, `prod_qty`, `prod_img`) VALUES
('the good artist', 'the best book i have ever read', 1500, 10, 8, '8.jpg'),
('the good artist', 'the best book i have ever read', 1500, 11, 8, '8.jpg'),
('i dont know', 'i dont kno what to do', 412, 12, 3, '4.jpg'),
('never', 'good morning', 784, 13, 6, '6.jpg'),
('giveup', 'hello', 123, 14, 45, '1.jpeg'),
('kaladevi', 'it is muy mother', 7895, 15, 5, '9.jpg'),
('dilu', 'cool', 789, 16, 45, 'WhatsApp Image 2023-09-19 at 23.14.52.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `userName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwrd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`userName`, `email`, `passwrd`) VALUES
('naveen', 'dileebandileeban2001@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwrd` varchar(50) NOT NULL,
  `phoneNumber` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userName`, `email`, `passwrd`, `phoneNumber`) VALUES
('naveen', 'dileebandileeban2001@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 777894561),
('dilu', 'dilu@gmail.com', '934b535800b1cba8f96a5d72f72f1611', 134461231),
('dilukshan', 'diludilu2001@gmail.com', '866c7ee013c58f01fa153a8d32c9ed57', 771234567),
('shashinda', 'fnfj@gmail.bet', '4a7d1ed414474e4033ac29ccb8653d9b', 789456123),
('kamal', 'kamal@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 2147483647),
('lakshan', 'lakshan@gmail.com', '6074c6aa3488f3c2dddff2a7ca821aab', 789456123),
('nimal', 'nimal@gmail.com', '6074c6aa3488f3c2dddff2a7ca821aab', 2147483647),
('sri', 'srisri6@gmail ', '48042b1dae4950fef2bd2aafa0b971a1', 774561237),
('sudu', 'sudu@gmail.com', '2be9bd7a3434f7038ca27d1918de58bd', 2147483647),
('sunil', 'sunil@gmail.com', '98cb5b96ac325a5bfe0131efe0798cb2', 754123655),
('suresh', 'suresh@gmail.com', '50f3f8c42b998a48057e9d33f4144b8b', 778945612),
('susu', 'susu@gmail.com', '3b712de48137572f3849aabd5666a4e3', 787788445);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admi`
--
ALTER TABLE `admi`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
