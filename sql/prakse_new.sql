-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2023 at 05:54 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prakse`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`id`, `name`) VALUES
(1, 'Guest'),
(2, 'User'),
(3, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_amount` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `product_amount`, `order_id`) VALUES
(582, 3, 24, 1, 27),
(586, 4, 7, 22, 29),
(589, 3, 14, 1, 30),
(593, 3, 4, 80, 31),
(603, 3, 1, 5, 32),
(607, 3, 1, 1, 33),
(613, 3, 3, 1, 36),
(614, 3, 1, 1, NULL),
(615, 3, 3, 1, NULL),
(616, 3, 4, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(128) NOT NULL DEFAULT 'missing.png',
  `main` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `product_id`, `image`, `main`) VALUES
(1, 1, 'recyclable-material.png', 1),
(2, 3, 'ironore.png', 1),
(3, 4, 'gold-bar.png', 1),
(4, 5, 'missing.png', 1),
(5, 6, 'unknown-metal.png', 1),
(6, 7, 'missing.png', 1),
(7, 8, 'missing.png', 1),
(8, 9, 'missing.png', 1),
(9, 10, 'missing.png', 1),
(10, 11, 'aluminum-oxide.png', 1),
(11, 12, 'missing.png', 1),
(12, 13, 'rubber.png', 1),
(13, 14, 'aluminum.png', 1),
(14, 15, 'missing.png', 1),
(15, 16, 'missing.png', 1),
(16, 17, 'rifle-body.png', 1),
(17, 18, 'plastic.png', 1),
(18, 19, 'scrapmetal.png', 1),
(19, 20, 'weed-plant-seed.png', 1),
(20, 21, 'weed-plant-seed.png', 1),
(21, 22, 'rolex-watch.png', 1),
(22, 23, 'missing.png', 1),
(23, 24, 'cigar-box.png', 1),
(24, 25, 'gold-record.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `total_sum` int(11) NOT NULL,
  `order_number` varchar(12) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `phone_number` int(10) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total_sum`, `order_number`, `date`, `user_id`, `name`, `phone_number`, `status`) VALUES
(27, 6000, 'd8a825e6-f0a', '2023-05-12', 3, 'admin1', 123456, 'cancelled'),
(29, 34200, 'f5e9e450-f0a', '2023-05-12', 4, 'user1', 1234567890, 'cancelled'),
(30, 1015, '4947392d-f24', '2023-05-14', 3, 'admin3', 1222, 'finished'),
(31, 135580, 'dd17f170-f30', '2023-05-15', 3, 'test', 12124124, 'cancelled'),
(32, 5000, '03193d90-f32', '2023-05-15', 3, 'saaaaaaa', 2147483647, 'on-hold'),
(33, 1000, 'c4759460-f32', '2023-05-15', 3, '1111', 2147483647, 'finished'),
(36, 500, '76618ff4-f42', '2023-05-16', 3, 'rahsezd', 2147483647, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` char(50) NOT NULL COMMENT 'Preces nosaukums',
  `price` decimal(10,2) DEFAULT 0.00 COMMENT 'Cena',
  `count` int(11) NOT NULL COMMENT 'Gab',
  `access` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `count`, `access`) VALUES
(1, 'Spaiņi', '30.00', 49, 1),
(3, 'HQM', '500.00', 23, 1),
(4, 'Gold bar', '1001.00', 0, 1),
(5, 'Small pipe', '100.00', 0, 1),
(6, 'Unknown metal', '500.00', 0, 3),
(7, 'Long pipe', '100.00', 1, 2),
(8, 'Lead', '100.00', 0, 1),
(9, 'Rifle trigger', '500.00', 0, 2),
(10, 'Pistol trigger', '100.00', 2, 2),
(11, 'Aluminium oxide', '50.00', 0, 2),
(12, 'Grenade shell', '1000.00', 0, 1),
(13, 'Rubber', '25.00', 0, 2),
(14, 'Aluminium', '25.00', 0, 1),
(15, 'Steel', '25.00', 0, 2),
(16, 'Pistol body', '1000.00', 0, 3),
(17, 'Rifle body', '4000.00', 0, 2),
(18, 'Plastic', '25.00', 0, 1),
(19, 'Scrap metal', '25.00', 0, 2),
(20, 'Female seed', '4000.00', 0, 1),
(21, 'Male seed', '30000.00', 111, 1),
(22, 'Rolex watch', '500.00', 0, 2),
(23, 'Explosive', '60000.00', 0, 2),
(24, 'Cigar box', '1000.00', 0, 3),
(25, 'Gold record', '990.00', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `access` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `access`) VALUES
(3, 'admin', 'admin@prakse.loc', '21232f297a57a5a743894a0e4a801fc3', 3),
(4, 'user', 'user@prakse.loc', 'ee11cbb19052e40b07aac0ca060c23ee', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `cart_user_id_fk` (`user_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_item` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produkt_rank` (`access`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_rank` (`access`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=617;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_item_pic_test` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `produkt_rank` FOREIGN KEY (`access`) REFERENCES `access` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `login_rank` FOREIGN KEY (`access`) REFERENCES `access` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
