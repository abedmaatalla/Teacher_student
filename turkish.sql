-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2016 at 06:03 PM
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
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `skype` varchar(128) NOT NULL,
  `facebook` varchar(128) NOT NULL,
  `twitter` varchar(128) NOT NULL,
  `linkedin` varchar(128) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `phone`, `skype`, `facebook`, `twitter`, `linkedin`, `id_user`, `created_at`, `updated_at`) VALUES
(2, '771358318', '', '', '', '', 17, '2016-11-10 18:21:41', '2016-11-11 12:31:20'),
(3, '771358318', 'msj', 'http://jmsfd.com', 'http://jmsfd.com', 'http://jmsfd.com', 15, '2016-11-10 18:24:12', '2016-11-10 18:26:12'),
(4, '771358318', '', '', 'http://jmsfd.com', 'http://jmsfd.com', 16, '2016-11-10 18:30:57', '2016-11-11 17:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `docs`
--

CREATE TABLE `docs` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `url` varchar(256) NOT NULL,
  `extension` enum('pdf','png','jpg','jpeg') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docs`
--

INSERT INTO `docs` (`id`, `name`, `url`, `extension`, `created_at`, `updated_at`, `id_user`) VALUES
(1, 'image', 'https://placeholdit.imgix.net/~text?txtsize=75&txt=800%C3%97500&w=800&h=500', 'png', '2016-11-10 10:05:59', '2016-11-10 10:05:59', 16),
(28, 'f6903eeaef5ae50c4d26fb2a55661c3a.pdf', 'http://turedu.com/upload/f6903eeaef5ae50c4d26fb2a55661c3a.pdf', 'pdf', '2016-11-11 09:23:33', '2016-11-11 09:23:33', 17);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(256) NOT NULL,
  `lastName` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `sexe` enum('f','m') NOT NULL,
  `age` int(11) NOT NULL,
  `country` varchar(3) NOT NULL,
  `address` varchar(1024) NOT NULL,
  `language` varchar(3) NOT NULL,
  `experience` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `bio` varchar(2048) NOT NULL,
  `type` enum('admin','teacher','student') NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `image`, `sexe`, `age`, `country`, `address`, `language`, `experience`, `price`, `email`, `password`, `bio`, `type`, `active`, `created_at`, `updated_at`) VALUES
(15, 'Abed', 'MAATALLA', 'http://turedu.com/assets/img/profile.png', 'f', 0, 'tr', '', '', 0, 0, 'abedmaalla@gmail.com', 'admin', '', 'admin', 1, '2016-11-07 12:16:19', '2016-11-11 17:27:52'),
(16, 'abed', 'MAATALLA', 'http://turedu.com/upload/9b60615a325eb721b2ee00911237ca4f.jpg', 'f', 24, 'dz', '     Algeria - 02 Chlef - 02300 Boukadir- Hay douaidia     ', 'fr', 1, 50, 'stud@gmail.com', 'admin', 'mjsdf                    ', 'student', 1, '2016-11-07 12:30:23', '2016-12-12 17:01:35'),
(17, 'Abeds', 'maatalla', 'http://turedu.com/upload/f8984f8a28f6e433d35aaa646e94385f.jpg', 'f', 23, 'tr', 'Boukadir, Chlef, Algeria', 'en', 0, 40, 'student@gmail.com', 'admin', 'qsdf', 'teacher', 1, '2016-11-07 12:32:11', '2016-11-11 14:04:53'),
(18, 'Abed', 'Ketrouci', 'http://turedu.com/assets/img/profile.png', 'f', 0, 'fr', '', 'fr', 2, 30, 'student1@gmail.com', 'admin', '', 'student', 1, '2016-11-07 12:32:51', '2016-11-07 12:32:51'),
(19, 'Abed', 'MAATALLA', 'http://turedu.com/assets/img/profile.png', 'm', 0, 'dz', 'Algeria - 02 Chlef - 02300 Boukadir- Hay douaidia', 'ar', 0, 40, 'abeed@gmail.com', 'root', 'qsdf', 'teacher', 1, '2016-11-08 11:29:16', '2016-11-10 14:15:26'),
(20, 'Abed', 'MAATALLA', 'http://turedu.com/assets/img/profile.png', 'f', 24, 'tr', 'Boukadir, Chlef, Algeria', 'fr', 0, 200, 'tach@gmail.com', 'admin', '', 'teacher', 1, '2016-11-09 13:30:31', '2016-11-10 14:16:12'),
(22, 'Abed', 'MAATALLA', 'http://turedu.com/assets/img/profile.png', 'f', 24, 'tr', 'Boukadir, Chlef, Algeria', 'tr', 3, 200, 'tacsh@gmail.com', 'admin', 'kjqsdfmqsdf', 'teacher', 0, '2016-11-09 13:31:36', '2016-11-09 13:31:36'),
(23, 'Abed', 'MAATALLA', 'http://turedu.com/assets/img/profile.png', 'f', 24, 'tr', 'Boukadir, Chlef, Algeria', 'tr', 3, 200, 'tacssh@gmail.com', 'admin', 'kjqsdfmqsdf', 'teacher', 0, '2016-11-09 13:32:12', '2016-11-09 13:32:12'),
(24, 'Abed', 'MAATALLA', 'http://turedu.com/assets/img/profile.png', 'f', 24, 'tr', 'Boukadir, Chlef, Algeria', 'tr', 3, 200, 'tacssssh@gmail.com', 'sqdfqds', 'kjqsdfmqsdf', 'teacher', 0, '2016-11-09 13:33:18', '2016-11-09 13:33:18'),
(25, 'Abed', 'MAATALLA', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'dz', 'Algeria - 02 Chlef - 02300 Boukadir- Chez Mokhefi', 'fr', 4, 342, 'qssqfd@gmail.com', 'qsdfq', 'qsfqsf', 'teacher', 0, '2016-11-09 13:38:44', '2016-11-09 13:38:44'),
(26, 'Abed', 'MAATALLA', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'dz', 'Algeria - 02 Chlef - 02300 Boukadir- Chez Mokhefi', 'fr', 4, 342, 'qsssdqfd@gmail.com', 'qsdfq', 'qsfqsf', 'teacher', 0, '2016-11-09 13:40:02', '2016-11-09 13:40:02'),
(27, 'Abed', 'MAATALLA', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'dz', 'Algeria - 02 Chlef - 02300 Boukadir- Chez Mokhefi', 'fr', 4, 342, 'qsssdqfsqfdd@gmail.com', 'admin', 'qsfqsf', 'teacher', 0, '2016-11-09 13:40:27', '2016-11-09 13:40:27'),
(28, 'Mounir', 'MAATALLA', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'fr', 'Algeria - 02 Chlef - 02300 Boukadir- Hay douaidia - Chez Mokhefi', 'fr', 3, 234, 'qssqfsqfd@gmail.com', 'qsdfq', 'sdfqsdf', 'teacher', 0, '2016-11-09 13:55:01', '2016-11-09 13:55:01'),
(29, 'Abed', 'MAATALLA', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'dz', 'Algeria - 02 Chlef - 02300 Boukadir- Hay douaidia', 'fr', 2, 230, 'qssqfsqsdfd@gmail.com', 'qsdfq', 'sdf', 'teacher', 1, '2016-11-09 14:03:16', '2016-11-09 14:03:16'),
(30, 'Abed', 'MAATALLA', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'dz', 'Algeria - 02 Chlef - 02300 Boukadir- Hay douaidia', 'fr', 2, 230, 'qssqfssqsdfd@gmail.com', 'qsdfq', 'sdf', 'teacher', 0, '2016-11-09 14:03:50', '2016-11-09 14:03:50'),
(31, 'Abed', 'Ketrouci', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'fr', 'Chez mokhefi, hay douaidia, Bouakdir 02002, Chlef, Algeria', 'fr', 34, 34, 'qss3sdfd@gmail.com', 'qsdfq', 'sdfqsf', 'student', 1, '2016-11-09 14:08:01', '2016-11-09 14:08:01'),
(33, 'Abed', 'Ketrouci', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'fr', 'Chez mokhefi, hay douaidia, Bouakdir 02002, Chlef, Algeria', 'fr', 34, 34, 'qss3sd4fd@gmail.com', 'sqdf', 'sdfqsf', 'teacher', 1, '2016-11-09 14:11:18', '2016-11-09 14:11:18'),
(34, 'qssf', 'sdfqsdf', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'dz', 'Holstenhofweg', 'fr', 3, 2, 'qss3sdd4fd@gmail.com', 'sqdf', 'df', 'teacher', 1, '2016-11-09 15:36:30', '2016-11-09 15:36:30'),
(35, 'qsqsdf', 'sqdfsdf', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'dz', 'Holstenhofweg', 'fr', 3, 2, 'qss3sdds4fd@gmail.com', 'sdf', 'df', 'teacher', 0, '2016-11-09 15:39:27', '2016-11-09 15:39:27'),
(37, 'qsdfqsdf', 'qsdfqsdf', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'dz', 'Holstenhofweg', 'fr', 3, 2, 'qss3dsdds4fd@gmail.com', 'sdf', 'df', 'teacher', 1, '2016-11-09 15:40:34', '2016-11-09 15:40:34'),
(38, 'Abed', 'Ketrouci', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'dz', 'Algeria - 02 Chlef - 02300 Boukadir- Chez Mokhefi', 'fr', 0, 354, 'qss3s3Dfd@gmail.com', 'sqdf', 'sdfqsf', 'student', 1, '2016-11-09 16:01:42', '2016-11-10 14:13:48'),
(40, 'Abed', 'Ketrouci', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'dz', 'Algeria - 02 Chlef - 02300 Boukadir- Chez Mokhefi', 'fr', 0, 354, 'qss3D3Dfd@gmail.com', 'qsfd', 'sdfqsf', 'student', 1, '2016-11-09 16:02:11', '2016-11-10 14:14:38'),
(41, 'Abed', 'Ketrouci', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'dz', 'Algeria - 02 Chlef - 02300 Boukadir- Chez Mokhefi', 'fr', 0, 354, 'qss3D3Dfds@gmail.com', 'sdf', 'sdfqsf', 'student', 0, '2016-11-09 16:03:25', '2016-11-09 16:03:25'),
(42, 'Abed', 'MAATALLA', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'dz', 'Algeria - 02 Chlef - 02300 Boukadir- Hay douaidia', 'fr', 3, 24, 'qss3Dsd4fd@gmail.com', 'sqdf', '                        qsdf', 'student', 0, '2016-11-09 16:06:13', '2016-11-09 16:06:13'),
(43, 'Abed', 'MAATALLA', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'dz', 'Algeria - 02 Chlef - 02300 Boukadir- Hay douaidia', 'fr', 3, 24, 'qss3Dssfdfd@gmail.com', 'qsdf', '                        qsdf', 'student', 0, '2016-11-09 16:08:34', '2016-11-09 16:08:34'),
(44, 'Mounir', 'Ketrouci', 'http://turedu.com/assets/img/profile.png', 'm', 32, 'dz', 'Algeria - 02 Chlef - 02300 Boukadir- Chez Mokhefi', 'fr', 0, 34, 'qss3sQFDS@gmail.com', 'sqdf', '                  qsdfs      ', 'student', 0, '2016-11-09 16:09:51', '2016-11-09 16:09:51'),
(45, 'Abed', 'Ketrouci', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'dz', 'Algeria - 02 Chlef - 02300 Boukadir- Hay douaidia', 'fr', 4, 34, 'tacher@gmail.com', 'admin', 'mjqsdf', 'teacher', 1, '2016-11-10 17:23:34', '2016-11-10 17:23:34'),
(46, 'abed', 'MAATALLA', 'http://turedu.com/assets/img/profile.png', 'f', 24, 'dz', 'Algeria - 02 Chlef - 02300 Boukadir- Hay douaidia - Chez Mokhefi', 'fr', 7, 23, 'abedmaaSQDFlla@gmail.com', 'admin', 'sqdfqsf', 'teacher', 0, '2016-11-14 20:06:22', '2016-11-14 20:06:22'),
(47, 'Abed', 'lkjsqdf', 'http://turedu.com/assets/img/profile.png', 'm', 24, 'dz', 'Algeria - 02 Chlef - 02300 Boukadir- Hay douaidia', 'fr', 5, 43, 'abedmaallasf@gmail.com', 'admin', 'sqdf', 'teacher', 0, '2016-11-14 20:07:43', '2016-11-14 20:07:43');

--
-- Indexes for dumped tables
--

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
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
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
