-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 12, 2017 at 04:53 PM
-- Server version: 5.7.16
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `turkish`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `category` varchar(256) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT "0000-00-00 00:00:00",
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `code`, `category`, `created_at`, `updated_at`) VALUES
(7, 0, 'Science', '2017-05-12 14:59:28', '2017-05-12 14:59:28'),
(8, 0, 'Math', '2017-05-12 15:47:10', '2017-05-12 15:47:10');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `phone` varchar(12) CHARACTER SET utf8 NOT NULL,
  `skype` varchar(128) CHARACTER SET utf8 NOT NULL,
  `facebook` varchar(128) CHARACTER SET utf8 NOT NULL,
  `twitter` varchar(128) CHARACTER SET utf8 NOT NULL,
  `linkedin` varchar(128) CHARACTER SET utf8 NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT "0000-00-00 00:00:00",
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `phone`, `skype`, `facebook`, `twitter`, `linkedin`, `id_user`, `created_at`, `updated_at`) VALUES
(3, '771358318', 'msj', 'http://jmsfd.com', 'http://jmsfd.com', 'http://jmsfd.com', 15, '2016-11-10 18:24:12', '2016-11-10 18:26:12');

-- --------------------------------------------------------

--
-- Table structure for table `docs`
--

CREATE TABLE `docs` (
  `id` int(11) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `url` varchar(256) CHARACTER SET utf8 NOT NULL,
  `extension` enum('pdf','png','jpg','jpeg') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT "0000-00-00 00:00:00",
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docs`
--

INSERT INTO `docs` (`id`, `name`, `url`, `extension`, `created_at`, `updated_at`, `id_user`) VALUES
(1, 'image', 'https://placeholdit.imgix.net/~text?txtsize=75&txt=800%C3%97500&w=800&h=500', 'png', '2016-11-10 10:05:59', '2016-11-10 10:05:59', 15);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(256) CHARACTER SET utf8 NOT NULL,
  `lastName` varchar(256) CHARACTER SET utf8 NOT NULL,
  `image` varchar(256) CHARACTER SET utf8 NOT NULL,
  `sexe` enum('f','m') CHARACTER SET utf8 NOT NULL,
  `age` int(11) NOT NULL,
  `country` varchar(3) CHARACTER SET utf8 NOT NULL,
  `address` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `id_category` int(11) NOT NULL,
  `experience` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `email` varchar(256) CHARACTER SET utf8 NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 NOT NULL,
  `bio` varchar(2048) CHARACTER SET utf8 NOT NULL,
  `type` enum('admin','teacher','student') CHARACTER SET utf8 NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT "0000-00-00 00:00:00",
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `image`, `sexe`, `age`, `country`, `address`, `id_category`, `experience`, `price`, `email`, `password`, `bio`, `type`, `active`, `created_at`, `updated_at`) VALUES
(15, 'Abed', 'MAATALLA', 'http://site.dev/Freelance/Turkish/source/public/assets/img/profile.png', 'f', 0, 'tr', '', 0, 0, 0, 'abedmaatalla@gmail.com', 'admin', '', 'admin', 1, '2016-11-07 12:16:19', '2016-12-13 19:04:19');

-- akinyavuz1@gmail.com
--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `docs`
--
ALTER TABLE `docs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_category` (`id_category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `docs`
--
ALTER TABLE `docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `docs`
--
ALTER TABLE `docs`
  ADD CONSTRAINT `docs_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
