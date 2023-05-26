-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 11:41 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estore`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Food'),
(2, 'Drinks'),
(3, 'Pasta'),
(8, 'Akullore'),
(9, 'KripÃ«'),
(10, 'Kuzhine');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_data` text NOT NULL,
  `notes` text,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_data`, `notes`, `total`) VALUES
(14, 3, 'Shaban Ejupi<br />+38345601379<br />shabanejupi5@gmail.com<br />128 Zejnel Salihu', 'E pa hapur', 1.25);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(11) DEFAULT NULL,
  `products_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `products_id`) VALUES
(NULL, NULL),
(NULL, NULL),
(NULL, NULL),
(NULL, NULL),
(NULL, 3),
(NULL, 17),
(NULL, 1),
(NULL, 2),
(NULL, 18),
(14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT '0',
  `description` text,
  `image` varchar(150) DEFAULT 'noimage.png',
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `price`, `qty`, `discount`, `description`, `image`, `category_id`) VALUES
(1, 1, 'Bread', 0.45, 10, 5, 'White Bread 500gr', '1678134163download.jpg', 1),
(2, 3, 'Coca Cola 0.5l', 1.25, 10, 3, 'Coca Cola 0.5l\r\n<br />\r\nOrigin: RKS', '168513449416782999921678132836coca-cola-original-20oz.png', 2),
(3, 1, 'Coca Cola 0.33l', 0.88, 50, 2, 'Coca Cola 0.33l\r\n<br />\r\nOrigin: Macedonia', '16782999721678133665coca-cola-classic-033-l-sweet-water-w-w.jpg', 2),
(4, 1, 'Fanta 0.5l', 1.15, 8, 10, 'Fanta 0.5l\r\n<br />\r\nOrigin: RKS', '1678302734fanta-0.5-L-pet.jpg', 2),
(5, 2, 'Chipsa Vipa', 0.5, 100, 5, '', '168513094308-Clasic-i-thjesht.png', 1),
(6, 2, 'UjÃ« 500ml', 0.5, 100, 5, 'UjÃ« natyral', '1685132059Uji.jpg', 2),
(17, 2, 'KripÃ« deti', 6.88, 55, 5, 'KripÃ« deti natyral e pÃ«rfituar nga Mesdheu Francez.', '1685132532Kripe.jpg', 9),
(18, 3, 'Peanut Butter', 13.23, 200, 10, 'Spread on the smiles with tasty, creamy peanut buttery perfection. Itâ€™s nothing but great snacking with this creamy classic.', '1685133339Peanut Butter.jpg', 10),
(20, 3, 'Snack mix', 2.98, 45, 7, 'SNACK MIX: Indulgent Turtle Snack Mix is loaded with fun, flavorful shapes of Chex, pretzels, nuts and more', '1685134288Snack mix.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `subtitle` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `image` varchar(255) NOT NULL DEFAULT 'noimage.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `title`, `subtitle`, `is_active`, `image`) VALUES
(18, 'Promocion', '50% Zbritje', 1, '1685135548Yellow Black Creative Modern Fried Chicken Promotion Banner.jpg'),
(19, 'Pije V8', 'Zbritje 16%', 1, '1685137055Juice Promotion Template (Facebook Post) (1).png'),
(20, 'Pije V8', '7% Zbritje', 0, '1685137157Juice Promotion Template (Facebook Post) (2).png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(150) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT 'avatar.png',
  `role` varchar(45) DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `address`, `phone`, `avatar`, `role`) VALUES
(1, 'Arianit', 'Likaj', 'arianitlikaj46@gmail.com', 'asdfsfsdfdsfsd', 'cdsxfvsddfds', 'r5tr34wr53434', 'avatar.png', '1'),
(2, 'Flamur', 'Avdylaj', 'flamur.avdylaj1@gmail.com', '$2y$10$l7c.B4WAtLAkhl6sClRu5.4yccvXoW2CiEksWTH2LMYdjqj95FvjO', 'Po Box 105', '070580780', '16787383093.jpg', 'admin'),
(3, 'Shaban', 'Ejupi', 'shabanejupi5@gmail.com', '$2y$10$0POZWcE1ZLYxJfFkMW34CucT6BZtcbDeQ.QkDPtG8iwZeFYDa6pR2', NULL, NULL, 'avatar.png', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_users_idx` (`user_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD KEY `fk_op_orders_idx` (`order_id`),
  ADD KEY `fk_op_products_idx` (`products_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_user_idx` (`user_id`),
  ADD KEY `fk_products_categories_idx` (`category_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `fk_op_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_op_products` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_products_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
