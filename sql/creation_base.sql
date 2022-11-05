-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 05, 2022 at 04:50 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `we_love_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `recipe` text NOT NULL,
  `author` varchar(512) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `title`, `recipe`, `author`, `is_enabled`) VALUES
(2, 'Salade Romaine', 'Caesar salad is a recipe for a mixed salad from American cuisine, traditionally prepared in the dining room next to the table, with romaine lettuce, hard-boiled egg, croutons, parmesan cheese and \"Caesar dressing\" made from grated parmesan cheese, olive oil, anchovy paste, garlic, wine vinegar, mustard, egg yolk and Worcestershire sauce.', 'laurene.castor@exemple.com', 1),
(3, 'Escalope milanaise', 'The escalope à la Milanaise, or Milanese escalope, is a breaded escalope of veal meat, traditionally taken from the sirloin. Historically, it is cooked with butter. It is usually served with salad or chips, accompanied by mayonnaise sauce. In Italy, this dish is not served with pasta.', 'mathieu.nebra@exemple.com', 1),
(4, 'Cassoulet', 'Cassoulet is a regional speciality of the Languedoc region, made with dried beans, usually white, and meat. It was originally made with beans. Cassoulet takes its name from the enamelled terracotta cassole known as caçòla1 in Occitan and made in Issel.', 'mathieu.nebra@exemple.com', 1),
(8, 'Couscous', 'Couscous is, on the one hand, durum wheat semolina prepared with olive oil (one of the traditional staples of Maghreb cuisine) and, on the other hand, a culinary speciality from Berber cuisine, based on couscous, vegetables, spices, olive oil and meat (red or poultry) or fish.', 'mickael.andrieu@exemple.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(64) NOT NULL,
  `email` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `age`) VALUES
(1, 'Mickaël Andrieu', 'mickael.andrieu@exemple.com', 'password123', 34),
(2, 'Mathieu Nebra', 'mathieu.nebra@exemple.com', 'password123', 34),
(3, 'Laurène Castor', 'laurene.castor@exemple.com', 'password123', 28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
