-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Pritësi (host): 127.0.0.1
-- Koha e gjenerimit: Maj 26, 2023 në 03:19 MD
-- Versioni i serverit: 10.1.36-MariaDB
-- PHP Versioni: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databaza: `estore`
--

-- --------------------------------------------------------

--
-- Struktura e tabelës për tabelën `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zbraz të dhënat për tabelën `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Food'),
(2, 'Drinks'),
(3, 'Pasta');

-- --------------------------------------------------------

--
-- Struktura e tabelës për tabelën `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_data` text NOT NULL,
  `notes` text,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zbraz të dhënat për tabelën `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_data`, `notes`, `total`) VALUES
(6, 3, 'Shaban Ejupi<br />+38345601379<br />shabanejupi5@gmail.com<br />128 Zejnel Salihu', '', 2.25);

-- --------------------------------------------------------

--
-- Struktura e tabelës për tabelën `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(11) DEFAULT NULL,
  `products_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zbraz të dhënat për tabelën `order_product`
--

INSERT INTO `order_product` (`order_id`, `products_id`) VALUES
(NULL, 6),
(NULL, 2),
(NULL, 8),
(NULL, 6),
(6, 2);

-- --------------------------------------------------------

--
-- Struktura e tabelës për tabelën `products`
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
-- Zbraz të dhënat për tabelën `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `price`, `qty`, `discount`, `description`, `image`, `category_id`) VALUES
(2, NULL, 'Bread', 0.45, 10, 5, 'White Bread 500gr', '1678134163download.jpg', 1),
(6, NULL, 'Coca Cola 0.5l', 1.25, 10, 0, 'Coca Cola 0.5l\r\n<br />\r\nOrigin: RKS', '16782999921678132836coca-cola-original-20oz.png', 2),
(7, NULL, 'Coca Cola 0.33l', 0.88, 50, 2, 'Coca Cola 0.33l\r\n<br />\r\nOrigin: Macedonia', '16782999721678133665coca-cola-classic-033-l-sweet-water-w-w.jpg', 2),
(8, NULL, 'Fanta 0.5l', 1.15, 8, 10, 'Fanta 0.5l\r\n<br />\r\nOrigin: RKS', '1678302734fanta-0.5-L-pet.jpg', 2);

-- --------------------------------------------------------

--
-- Struktura e tabelës për tabelën `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `subtitle` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `image` varchar(255) NOT NULL DEFAULT 'noimage.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zbraz të dhënat për tabelën `promotions`
--

INSERT INTO `promotions` (`id`, `title`, `subtitle`, `is_active`, `image`) VALUES
(13, 'ASUS Rog Strike 500', 'Best gaming laptop of 2023', 1, '1678131699mb_d-KS-1678094748.jpg'),
(14, 'Karrige per gamera', 'Karrige komode nga brendi i ASUS', 0, '1678131832mb-d-1677936208.jpg'),
(15, 'Samsung HQ TV', 'Bota reale ne ekranin tuaj', 0, '1678131859tc.jpg');

-- --------------------------------------------------------

--
-- Struktura e tabelës për tabelën `users`
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
-- Zbraz të dhënat për tabelën `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `address`, `phone`, `avatar`, `role`) VALUES
(3, 'Arianit', 'Likaj', 'arianitlikaj46@gmail.com', '$2y$10$.jVNuiz9abwy5npn6mv2JeJ2OluOXshH48DIT/ymjFNRWVbggPfRi', 'Prizren', '045807088', 'avatar.png', 'admin'),
(4, 'Shaban', 'Ejupi', 'shabanejupi5@gmail.com', '$2y$10$6NhHYe1g5DBYnizZo2q6wOhiW7DR1eAQyv.e8wNqlBTxn/eX3TFxm', 'Podujevë', '045601379', 'avatar.png', 'customer');

--
-- Indekset për tabelat e hedhura
--

--
-- Indekset për tabelë `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indekset për tabelë `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_users_idx` (`user_id`);

--
-- Indekset për tabelë `order_product`
--
ALTER TABLE `order_product`
  ADD KEY `fk_op_orders_idx` (`order_id`),
  ADD KEY `fk_op_products_idx` (`products_id`);

--
-- Indekset për tabelë `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_user_idx` (`user_id`),
  ADD KEY `fk_products_categories_idx` (`category_id`);

--
-- Indekset për tabelë `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indekset për tabelë `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT për tabelat e hedhura
--

--
-- AUTO_INCREMENT për tabelë `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT për tabelë `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT për tabelë `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT për tabelë `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT për tabelë `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Detyrimet për tabelat e hedhura
--

--
-- Detyrimet për tabelën `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Detyrimet për tabelën `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `fk_op_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_op_products` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Detyrimet për tabelën `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_products_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
