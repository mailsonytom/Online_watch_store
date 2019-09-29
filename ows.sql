-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 29, 2019 at 11:13 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ows`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$Y41RUXFgKELmVGWb9Snj6O474dnWecUUUlkOlazRpemLZfDzsCgSW');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(3000) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `product_id`, `user_id`) VALUES
(2, 'My comment', 10, 12),
(3, 'My comment', 10, 12),
(4, 'My comment', 10, 12),
(5, 'fs', 10, 12),
(6, 'fdas', 10, 12),
(7, 'fas', 10, 12),
(8, 'fas', 10, 12);

-- --------------------------------------------------------

--
-- Table structure for table `dealer`
--

CREATE TABLE `dealer` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `owner` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `address` varchar(500) NOT NULL,
  `bio` varchar(1000) NOT NULL,
  `approved` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dealer`
--

INSERT INTO `dealer` (`id`, `name`, `owner`, `email`, `password`, `phone`, `location`, `address`, `bio`, `approved`) VALUES
(1, 'Tony', 'Sherona', 'she@she.com', '$2y$10$FWZbX1a0BSj/YE2NcCHKBO3qbhXF2fYpJP7Y75jL/u/mSEBHEs3jS', '2341', 'location', 'Address', 'Bio', 1),
(2, 'sdfef', '', '', '$2y$10$rSMhpXQZ3KPlqghHVaaaeekNBsUBzVvpPlN05WlUTvymZ5DxPn8.i', '', 'location', '', '', 1),
(3, 'Tony Tom', 'Tony', 't@t.com', '$2y$10$RhaLmIvEYqPDC1Nd8XEF9OKxBdf/oCJfj.y8Bpz1iuC7eIhFvdIZm', '1234', 'location', 'Address', 'Bio', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `brand` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `brand`, `code`, `category`, `gender`, `type`, `price`, `image`, `description`, `dealer_id`, `count`) VALUES
(6, 'Timex', 'Timex', 'TT45', 'analog', 'male', 'strap', '34', 'TT45.jpg', 'The watch face of industry', 3, 28),
(7, 'Cisco', 'Cisco', 'CS43', 'analog', 'male', 'strap', '23', 'CS43.jpg', 'Desc', 3, 30),
(8, 'iNdian', 'Indian', 'IND43', 'analog', 'male', 'strap', '34', 'IND43.jpg', 'FKDASLJ', 3, 10),
(9, 'FJAKL', 'FOURFK', 'FD43', 'analog', 'male', 'strap', '34', 'FD43.jpg', 'FLSAJ', 3, 30),
(10, 'KFJK', 'FKUK', 'KJJ98', 'analog', 'male', 'strap', '34', 'KJJ98.jpg', 'FKASJ', 3, 10),
(11, 'The new watch', 'Thenew brand', '12Add', 'analog', 'male', 'strap', '12', '12Add.jpg', 'flkajf', 0, 20);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `shipped` tinyint(1) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `product_id`, `user_id`, `count`, `date`, `shipped`, `price`) VALUES
(1, 7, 12, 1, '8.308641975296296296', 1, 23),
(2, 6, 12, 2, '8.308641975296296296', 1, 34),
(3, 7, 12, 1, '8.308641975296296296', 1, 23),
(4, 8, 12, 1, '12/13/1992', 1, 34),
(5, 6, 12, 1, '8.308641975296296296', 1, 34),
(6, 8, 13, 1, '8.011904761892857142', 0, 34),
(7, 9, 12, 1, '8.011904761892857142', 0, 34);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `gender` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `gender`) VALUES
(11, 'Tony', 't@t.com', '$2y$10$qy9EbmIfzhWtAGBjy3m6KumSHAuYS/9/XCVj7OjHcpvhV4hm9qHzC', '123', 'lfkdjsa', 'male'),
(12, 'Maria', 'm@m.com', '$2y$10$rCrumdjJlWsarnAkcte7AuOnMg1OKX.mkLZ2hmAmua6PFPAuKJZ5K', '1234', '1234', 'male'),
(13, 'Kevin Jose Minj', 'kevinjoseminj98@gmail.com', '$2y$10$s06ZX4uBm5rwgynEHoQ.Q.wcFrlSZfbzjS2oV.h0CNm4rPqC5WGo6', '9495031479', 'Murickal (H)', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer`
--
ALTER TABLE `dealer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `dealer`
--
ALTER TABLE `dealer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;