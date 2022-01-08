-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:3306
-- Tid vid skapande: 08 jan 2022 kl 18:11
-- Serverversion: 5.7.36-0ubuntu0.18.04.1
-- PHP-version: 7.2.24-0ubuntu0.18.04.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `website`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `CARTS`
--

CREATE TABLE `CARTS` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `CARTS`
--

INSERT INTO `CARTS` (`cart_id`, `user_id`, `total_price`) VALUES
(113, 52, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `CART_ITEMS`
--

CREATE TABLE `CART_ITEMS` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(2) NOT NULL,
  `color` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `CATEGORIES`
--

CREATE TABLE `CATEGORIES` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `CATEGORIES`
--

INSERT INTO `CATEGORIES` (`category_id`, `category_name`, `category_description`, `is_deleted`) VALUES
(12, 'Mouse', 'This category is for mouses', 0),
(13, 'Processor', 'processor', 0),
(16, 'Graphics Card', 'GPU', 0),
(17, 'Monitors', 'Pixels, hz and refresh rate. ', 0),
(18, 'NFT', 'This is very wow', 0),
(20, 'TV', '123', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `ORDERS`
--

CREATE TABLE `ORDERS` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL DEFAULT '0',
  `purchase_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `ORDERS`
--

INSERT INTO `ORDERS` (`order_id`, `user_id`, `total_price`, `purchase_date`) VALUES
(48, 31, 0, '2021-12-17 08:25:42'),
(49, 31, 0, '2021-12-17 08:28:58'),
(52, 31, 0, '2021-12-17 09:18:23'),
(54, 31, 0, '2021-12-17 09:19:53'),
(59, 31, 0, '2021-12-17 09:27:58'),
(62, 31, 0, '2021-12-17 09:46:04'),
(63, 31, 0, '2021-12-17 09:46:44'),
(66, 31, 0, '2021-12-17 09:55:56'),
(68, 31, 0, '2021-12-17 09:56:26'),
(69, 43, 0, '2021-12-17 12:08:47'),
(74, 31, 0, '2021-12-21 21:19:56'),
(75, 31, 0, '2021-12-21 21:43:19'),
(76, 31, 0, '2021-12-21 21:44:23'),
(77, 31, 0, '2021-12-21 21:46:15'),
(78, 31, 0, '2021-12-21 21:47:54'),
(79, 31, 0, '2021-12-21 21:49:33'),
(80, 31, 0, '2021-12-21 21:55:48'),
(82, 31, 0, '2021-12-21 21:57:10'),
(83, 31, 0, '2021-12-21 22:16:32'),
(84, 31, 0, '2021-12-21 22:43:58'),
(85, 31, 0, '2021-12-21 22:45:47'),
(86, 31, 0, '2021-12-21 22:46:58'),
(87, 31, 1018, '2021-12-21 22:48:17'),
(88, 43, 598, '2021-12-22 16:22:03'),
(90, 50, 329, '2021-12-22 19:42:33'),
(91, 51, 29, '2021-12-27 10:38:23'),
(92, 51, 39, '2021-12-27 10:39:35'),
(93, 51, 29, '2021-12-27 10:40:47'),
(94, 51, 300, '2021-12-30 16:29:54'),
(95, 46, 29, '2022-01-04 15:31:01'),
(96, 46, 1049, '2022-01-06 14:10:54');

-- --------------------------------------------------------

--
-- Tabellstruktur `ORDER_ITEMS`
--

CREATE TABLE `ORDER_ITEMS` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `color` varchar(20) NOT NULL,
  `purchase_price` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `ORDER_ITEMS`
--

INSERT INTO `ORDER_ITEMS` (`order_item_id`, `order_id`, `product_id`, `quantity`, `color`, `purchase_price`) VALUES
(74, 48, 13, 1, 'Red', 0),
(75, 48, 11, 1, 'Black', 0),
(77, 49, 19, 1, 'Black', 0),
(78, 49, 17, 2, 'Black', 0),
(79, 49, 8, 1, 'Black', 0),
(82, 52, 16, 1, 'Black', 0),
(84, 54, 16, 1, 'Black', 0),
(85, 54, 10, 1, 'Black', 0),
(91, 59, 14, 1, 'Black', 0),
(94, 62, 11, 1, 'Black', 0),
(95, 63, 10, 1, 'Red', 0),
(97, 66, 16, 1, 'Black', 0),
(98, 68, 17, 1, 'Black', 0),
(99, 69, 17, 2, 'Black', 0),
(100, 69, 11, 2, 'Black', 0),
(101, 69, 8, 3, 'Black', 0),
(104, 74, 23, 1, 'Black', 0),
(105, 74, 12, 1, 'Black', 0),
(107, 75, 11, 1, 'Black', 0),
(108, 76, 11, 1, 'Black', 0),
(109, 77, 23, 1, 'Black', 0),
(110, 78, 8, 1, 'Black', 0),
(111, 79, 10, 1, 'Red', 0),
(112, 79, 10, 2, 'Black', 0),
(113, 79, 11, 1, 'Black', 0),
(114, 80, 10, 1, 'Red', 150),
(115, 80, 11, 1, 'Black', 150),
(117, 82, 13, 1, 'Yellow', 9),
(118, 82, 13, 2, 'Red', 9),
(119, 82, 10, 12, 'Red', 150),
(120, 83, 17, 1, 'Black', 249),
(121, 84, 12, 2, 'Black', 29),
(122, 84, 17, 2, 'Black', 249),
(123, 84, 16, 2, 'Black', 299),
(124, 85, 16, 1, 'Black', 299),
(125, 86, 10, 1, 'Black', 150),
(126, 87, 17, 2, 'Black', 249),
(127, 87, 11, 3, 'Black', 150),
(128, 87, 8, 2, 'Blue', 35),
(129, 88, 23, 2, 'Black', 299),
(130, 90, 23, 1, 'Black', 299),
(131, 90, 13, 1, 'Red', 30),
(133, 91, 12, 1, 'Black', 29),
(134, 92, 12, 1, 'Black', 39),
(135, 93, 8, 1, 'Black', 29),
(136, 94, 10, 2, 'Black', 150),
(137, 95, 8, 1, 'Yellow', 29),
(138, 96, 11, 5, 'Black', 150),
(139, 96, 23, 1, 'Black', 299);

-- --------------------------------------------------------

--
-- Tabellstruktur `PRODUCTS`
--

CREATE TABLE `PRODUCTS` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `product_description` varchar(155) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `picture` text NOT NULL,
  `average_score` float NOT NULL DEFAULT '0',
  `is_deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `PRODUCTS`
--

INSERT INTO `PRODUCTS` (`product_id`, `product_name`, `product_description`, `category_id`, `price`, `discount`, `picture`, `average_score`, `is_deleted`) VALUES
(8, 'Gaming mouse', 'This mouse is suited for gaming', 12, 35, 29, 'https://cdn.cnetcontent.com/53/32/53328f2a-3a44-42b9-ae5e-2436238dccab.jpg', 1, 0),
(10, 'Cpu', 'test', 13, 199, 0, 'https://www.techinn.com/f/13817/138174441/amd-processor-ryzen-9-5900x-3.7ghz.jpg', 5, 0),
(11, 'RTX 3080 ti', 'Super good graphics card', 16, 200, 150, 'data:image/jpeg;base64,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', 5, 0),
(12, 'Office mouse', 'This mouse is greate for office work', 12, 39, 0, 'https://ae01.alicdn.com/kf/HTB1ie9ZXsvrK1Rjy0Feq6ATmVXaV/New-Rapoo-N200-Wired-Optical-Gaming-Office-Mouse-with-1000DPI-For-PC-Computer-Home-Office.jpg_640x640.jpg', 1, 0),
(13, 'Dank', 'Hello I am very dank, dont harass me also i know the way', 18, 30, 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTe7Q1Q-DOQJXxiUyk4ElGbC36d62IPbbCYwQ&usqp=CAU', 2, 0),
(14, 'Shitel', 'amd>intel', 13, 270, 1, 'https://www.komplett.se/img/p/800/1155684.jpg', 5, 0),
(16, 'Lg Monitor', 'Monitor with pixels', 17, 299, 0, 'https://www.techinn.com/f/13736/137365867/lg-22mk600m-b-21.5-full-hd-led-monitor.jpg', 5, 0),
(17, 'AMD Radeon', 'Graphic card by AMD ', 16, 399, 249, 'https://asset.conrad.com/media10/isa/160267/c1/-/sv/002199489PI00/image.jpg', 3, 0),
(19, 'Big Thonka NFT', 'Big Thonka NFT', 18, 999999, 0, 'https://cdn.discordapp.com/attachments/411610489920028682/921188791941754900/3213123qwe.PNG', 5, 0),
(23, 'Samsung Tv', 'Big monitor with pixels', 20, 299, 0, 'https://www.techinn.com/f/13770/137706789/samsung-tv-ue24n4305-24-full-hd-led.jpg', 3, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `PRODUCT_INVENTORY`
--

CREATE TABLE `PRODUCT_INVENTORY` (
  `inventory_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `PRODUCT_INVENTORY`
--

INSERT INTO `PRODUCT_INVENTORY` (`inventory_id`, `product_id`, `quantity`, `color`) VALUES
(1, 8, 52, 'Black'),
(2, 10, 104, 'Black'),
(3, 10, 1170, 'Red'),
(4, 11, 93, 'Black'),
(5, 8, 68, 'Blue'),
(6, 12, 2, 'Black'),
(7, 13, 12, 'Yellow'),
(9, 13, 4, 'Red'),
(11, 16, 39, 'Black'),
(12, 17, 89, 'Black'),
(14, 19, 0, 'Black'),
(16, 13, 2, 'Green'),
(20, 8, 4, 'Yellow'),
(23, 8, 99, 'Black'),
(24, 23, 98, 'Black');

-- --------------------------------------------------------

--
-- Tabellstruktur `USERS`
--

CREATE TABLE `USERS` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `t_number` varchar(10) NOT NULL,
  `address_1` varchar(50) NOT NULL,
  `pwd` varchar(40) NOT NULL,
  `address_2` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `postal_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `USERS`
--

INSERT INTO `USERS` (`user_id`, `first_name`, `last_name`, `email_address`, `t_number`, `address_1`, `pwd`, `address_2`, `city`, `postal_code`) VALUES
(0, '', '', 'admin@gmail.com', '', '', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '', ''),
(31, 'Joe', 'Biden', 'biden@hotmail.com', '1234567899', 'White House', '16a9a54ddf4259952e3c118c763138e83693d7fd', '', 'Washington', '49753'),
(43, 't', 's', 'test@test.com', '0722333308', 'DesvÃ¤gen 2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', 'sdf', '12345'),
(45, 'test', 'user6', 'test6@gmail.com', '1111111111', 'testvÃ¤gen 12', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', 'testby', '12345'),
(46, 'Bob', 'bobbson', 'bob@bob.com', '0702691179', 'bobstreet 3', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', 'Bobtown', '12345'),
(49, 'Trackman', 'Backman', 'trackman@gmail.com', '0700707000', 'a', 'c412b37f8c0484e6db8bce177ae88c5443b26e92', '', 'a', '12345'),
(50, 'Rune', 'Ollson', 'rune@hotmail.com', '0726773952', 'holmgatan 5', 'ed3eaad301caea11fa53bfa89d33805f910a4e88', '', 'KÃ¶pmanholmen', '89340'),
(51, 'Bob', 'bobbson', 'bob@gmail.com', '0701234567', 'bobstreet 3', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'bobstreet 4', 'Bobtown', '12345'),
(52, 'test2', 'test22', 'test2@test.com', '0722324408', 'DesvÃ¤gen 2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', 'ss', '12345');

-- --------------------------------------------------------

--
-- Tabellstruktur `USER_COMMENTS`
--

CREATE TABLE `USER_COMMENTS` (
  `comment_id` int(11) NOT NULL,
  `review_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `comment_name` varchar(30) DEFAULT NULL,
  `comment_comment` varchar(200) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `USER_COMMENTS`
--

INSERT INTO `USER_COMMENTS` (`comment_id`, `review_id`, `user_id`, `comment_name`, `comment_comment`, `dislikes`, `likes`, `created_at`) VALUES
(14, 11, 31, 'Boe Jiden', 'wow thats a nice review', 0, 12, '2021-12-17 10:15:21');

-- --------------------------------------------------------

--
-- Tabellstruktur `USER_LIKES_COMMENT`
--

CREATE TABLE `USER_LIKES_COMMENT` (
  `likes_comment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `user_disliked` tinyint(1) DEFAULT NULL,
  `user_liked` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `USER_LIKES_COMMENT`
--

INSERT INTO `USER_LIKES_COMMENT` (`likes_comment_id`, `user_id`, `comment_id`, `user_disliked`, `user_liked`) VALUES
(1, 43, 14, 0, 0),
(11, 43, 14, 0, 0),
(12, 43, 14, 0, 0),
(13, 46, 31, 1, 0),
(14, 46, 33, 1, 0),
(15, 52, 33, 0, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `USER_LIKES_REVIEW`
--

CREATE TABLE `USER_LIKES_REVIEW` (
  `likes_review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `review_id` int(11) DEFAULT NULL,
  `user_disliked` tinyint(1) NOT NULL DEFAULT '0',
  `user_liked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `USER_LIKES_REVIEW`
--

INSERT INTO `USER_LIKES_REVIEW` (`likes_review_id`, `user_id`, `review_id`, `user_disliked`, `user_liked`) VALUES
(1, 0, 2222, 0, 0),
(4, 46, 11, 0, 1),
(8, 31, 19, 1, 1),
(9, 31, 20, 1, 0),
(10, 47, 23, 0, 1),
(11, 47, 24, 0, 1),
(12, 49, 25, 1, 1),
(13, 49, 20, 1, 1),
(14, 49, 27, 1, 0),
(15, 49, 11, 0, 1),
(21, 43, 20, 0, 1),
(22, 0, 11, 0, 0),
(23, 51, 34, 0, 0),
(24, 43, 11, 0, 0),
(25, 52, 37, 0, 0),
(26, 46, 20, 1, 0),
(27, 46, 39, 0, 0),
(28, 52, 20, 1, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `USER_REVIEWS`
--

CREATE TABLE `USER_REVIEWS` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `review_name` varchar(30) NOT NULL,
  `review_score` int(11) NOT NULL,
  `review_comment` varchar(50) NOT NULL,
  `dislikes` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `USER_REVIEWS`
--

INSERT INTO `USER_REVIEWS` (`review_id`, `user_id`, `product_id`, `review_name`, `review_score`, `review_comment`, `dislikes`, `likes`, `created_at`) VALUES
(11, 31, 16, 'Joe Biden', 4, 'Many pixels verry nice', 0, 4, '2021-12-17 10:13:05'),
(25, 49, 19, 'Dr Mundo', 5, 'Big very! Must buy', 1, 20023, '2021-12-20 00:19:48'),
(34, 51, 23, 'Mediocre', 3, 'Mediocre product', 0, 0, '2021-12-27 10:46:44'),
(37, 43, 13, 'test 2', 3, 'this is second review', 0, 0, '2022-01-06 14:25:59'),
(38, 52, 13, 'test3', 1, 'This brought me joy', 0, 0, '2022-01-06 14:27:54'),
(48, 43, 17, 'Man of steel', 3, 'Did a pretty decent job ', 0, 0, '2022-01-06 16:29:49');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `CARTS`
--
ALTER TABLE `CARTS`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_user_id_CARTS` (`user_id`);

--
-- Index för tabell `CART_ITEMS`
--
ALTER TABLE `CART_ITEMS`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `fk_cart_id_CART_ITEMS` (`cart_id`),
  ADD KEY `fk_product_id_CART_ITEMS` (`product_id`);

--
-- Index för tabell `CATEGORIES`
--
ALTER TABLE `CATEGORIES`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Index för tabell `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_user_id_ORDERS` (`user_id`);

--
-- Index för tabell `ORDER_ITEMS`
--
ALTER TABLE `ORDER_ITEMS`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `fk_order_id_ORDER_ITEMS` (`order_id`),
  ADD KEY `fk_product_id_ORDER_ITEMS` (`product_id`);

--
-- Index för tabell `PRODUCTS`
--
ALTER TABLE `PRODUCTS`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_category_id_PRODUCTS` (`category_id`);

--
-- Index för tabell `PRODUCT_INVENTORY`
--
ALTER TABLE `PRODUCT_INVENTORY`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `fk_product_id_PRODUCT_INVENTORY` (`product_id`);

--
-- Index för tabell `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_address` (`email_address`);

--
-- Index för tabell `USER_COMMENTS`
--
ALTER TABLE `USER_COMMENTS`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_comment_review_id` (`review_id`);

--
-- Index för tabell `USER_LIKES_COMMENT`
--
ALTER TABLE `USER_LIKES_COMMENT`
  ADD PRIMARY KEY (`likes_comment_id`);

--
-- Index för tabell `USER_LIKES_REVIEW`
--
ALTER TABLE `USER_LIKES_REVIEW`
  ADD PRIMARY KEY (`likes_review_id`);

--
-- Index för tabell `USER_REVIEWS`
--
ALTER TABLE `USER_REVIEWS`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_user_id_REVIEWS` (`user_id`),
  ADD KEY `fk_product_id_REVIEWS` (`product_id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `CARTS`
--
ALTER TABLE `CARTS`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT för tabell `CART_ITEMS`
--
ALTER TABLE `CART_ITEMS`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;
--
-- AUTO_INCREMENT för tabell `CATEGORIES`
--
ALTER TABLE `CATEGORIES`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT för tabell `ORDERS`
--
ALTER TABLE `ORDERS`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT för tabell `ORDER_ITEMS`
--
ALTER TABLE `ORDER_ITEMS`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
--
-- AUTO_INCREMENT för tabell `PRODUCTS`
--
ALTER TABLE `PRODUCTS`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT för tabell `PRODUCT_INVENTORY`
--
ALTER TABLE `PRODUCT_INVENTORY`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT för tabell `USERS`
--
ALTER TABLE `USERS`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT för tabell `USER_COMMENTS`
--
ALTER TABLE `USER_COMMENTS`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT för tabell `USER_LIKES_COMMENT`
--
ALTER TABLE `USER_LIKES_COMMENT`
  MODIFY `likes_comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT för tabell `USER_LIKES_REVIEW`
--
ALTER TABLE `USER_LIKES_REVIEW`
  MODIFY `likes_review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT för tabell `USER_REVIEWS`
--
ALTER TABLE `USER_REVIEWS`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `CARTS`
--
ALTER TABLE `CARTS`
  ADD CONSTRAINT `fk_user_id_CARTS` FOREIGN KEY (`user_id`) REFERENCES `USERS` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restriktioner för tabell `CART_ITEMS`
--
ALTER TABLE `CART_ITEMS`
  ADD CONSTRAINT `fk_cart_id_CART_ITEMS` FOREIGN KEY (`cart_id`) REFERENCES `CARTS` (`cart_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_id_CART_ITEMS` FOREIGN KEY (`product_id`) REFERENCES `PRODUCTS` (`product_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restriktioner för tabell `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD CONSTRAINT `fk_user_id_ORDERS` FOREIGN KEY (`user_id`) REFERENCES `USERS` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restriktioner för tabell `ORDER_ITEMS`
--
ALTER TABLE `ORDER_ITEMS`
  ADD CONSTRAINT `fk_order_id_ORDER_ITEMS` FOREIGN KEY (`order_id`) REFERENCES `ORDERS` (`order_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_id_ORDER_ITEMS` FOREIGN KEY (`product_id`) REFERENCES `PRODUCTS` (`product_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restriktioner för tabell `PRODUCTS`
--
ALTER TABLE `PRODUCTS`
  ADD CONSTRAINT `fk_category_id_PRODUCTS` FOREIGN KEY (`category_id`) REFERENCES `CATEGORIES` (`category_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restriktioner för tabell `PRODUCT_INVENTORY`
--
ALTER TABLE `PRODUCT_INVENTORY`
  ADD CONSTRAINT `fk_product_id_PRODUCT_INVENTORY` FOREIGN KEY (`product_id`) REFERENCES `PRODUCTS` (`product_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restriktioner för tabell `USER_COMMENTS`
--
ALTER TABLE `USER_COMMENTS`
  ADD CONSTRAINT `fk_comment_review_id` FOREIGN KEY (`review_id`) REFERENCES `USER_REVIEWS` (`review_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restriktioner för tabell `USER_REVIEWS`
--
ALTER TABLE `USER_REVIEWS`
  ADD CONSTRAINT `fk_product_id_REVIEWS` FOREIGN KEY (`product_id`) REFERENCES `PRODUCTS` (`product_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id_REVIEWS` FOREIGN KEY (`user_id`) REFERENCES `USERS` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
