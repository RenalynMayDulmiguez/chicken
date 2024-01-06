-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 01:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chicken_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addProduct` (IN `p_user_id` INT, IN `p_name` VARCHAR(255), IN `p_description` VARCHAR(255), IN `p_quantity` INT, IN `p_price` DOUBLE, IN `p_images` TEXT)   BEGIN
    INSERT INTO products(user_id, name, description, quantity, price, images)
    VALUES(p_user_id, p_name, p_description, p_quantity, p_price, p_images);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addToCart` (IN `p_user_id` INT, IN `p_product_id` INT)   BEGIN
	INSERT INTO carts(user_id, product_id) 
    VALUES(p_user_id, p_product_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addToCartFromFavorites` (IN `p_user_id` INT, IN `p_id` INT, IN `p_product_id` INT)   BEGIN

	DELETE
	FROM favorites
	WHERE user_id = p_user_id
	AND id = p_id;

	INSERT INTO carts (user_id, product_id, quantity)
	VALUES (p_user_id, p_product_id, 1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteProduct` (IN `p_user_id` INT)   BEGIN
	UPDATE products 
    SET deleted_at = NOW() 
    WHERE id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteUser` (IN `p_id` INT)   BEGIN
    DELETE FROM users WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `displayAllUser` ()   SELECT *
FROM users
WHERE deleted_at 
IS NULL
AND role = 0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `displayCarts` (IN `p_user_id` INT)   BEGIN
	SELECT carts.*, images, name, price 
    FROM carts 
    LEFT JOIN products 
    ON carts.product_id = products.id  
    WHERE carts.deleted_at is null 
    AND carts.user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `displayFavorites` (IN `p_user_id` INT)   SELECT favorites.*, name, price, images
FROM favorites 
LEFT JOIN products 
ON products.id = favorites.product_id
WHERE favorites.user_id = p_user_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `displayProducts` ()   BEGIN
	SELECT *
    FROM products
    WHERE deleted_at
    IS NULL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `displayUser` (IN `p_user_id` INT)   SELECT * 
    FROM users
    WHERE id = p_user_id
    AND deleted_at
    IS NULL$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `p_username` VARCHAR(255))   BEGIN

	SELECT * 
	FROM users
    WHERE (username = p_username OR email = p_username)
    AND deleted_at 
    IS NULL
    LIMIT 1;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `register` (IN `p_fullname` VARCHAR(255), IN `p_username` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_password` VARCHAR(255), IN `p_address` VARCHAR(255), IN `p_mobile` VARCHAR(255), IN `p_qrcode` TEXT)   BEGIN
	INSERT 
    INTO users(fullname, username, email, password, address, mobile, profile)
    VALUES (p_fullname, p_username, p_email, p_password, p_address, p_mobile, p_qrcode);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `removeCart` (IN `p_id` INT)   BEGIN
	UPDATE carts 
    SET deleted_at = NOW() 
    WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `restoreProductInCart` (IN `p_id` INT)   BEGIN
	UPDATE carts
    SET deleted_at = null
    WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `softDeleteProductInCart` (IN `p_id` INT)   BEGIN
	UPDATE carts
    SET deleted_at = now()
    WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateCounterlock` (IN `p_user_id` INT, IN `p_counterlock` INT)   BEGIN
	SELECT * 
    FROM users
    WHERE id = p_user_id
	AND deleted_at
	IS NULL;

	IF p_counterlock < 3 THEN
	 	UPDATE users
        SET counterlock = 5
        WHERE id = p_user_id
        AND deleted_at 
        IS NULL;
    ELSE
        UPDATE users
        SET counterlock = 0
        WHERE id = p_user_id
        AND deleted_at 
        IS NULL;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateFavorites` (IN `p_user_id` INT, IN `p_product_id` INT)   BEGIN
  -- Declare a variable to hold the count
  DECLARE count INT;
  
  -- Check if the record exists
  SELECT COUNT(*) INTO count
  FROM favorites
  WHERE user_id = p_user_id
  AND product_id = p_product_id;
  
  -- If the record doesn't exist, add it
  IF count = 0 THEN
    INSERT INTO favorites (user_id, product_id)
    VALUES (p_user_id, p_product_id);
  -- If records exists, then delete it
  ELSEIF count > 0 THEN
  	DELETE
	FROM favorites
    WHERE user_id = p_user_id
  	AND product_id = p_product_id;
  END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateProduct` (IN `p_id` INT, IN `p_quantity` INT, IN `p_price` INT)   BEGIN
  UPDATE products
  SET quantity = p_quantity, price = p_price, updated_at = now()
  WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateQuantity` (IN `p_quantity` INT, IN `p_id` INT)   BEGIN
	UPDATE carts
    SET quantity = p_quantity
    WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateUser` (IN `p_id` INT, IN `p_fullname` VARCHAR(255), IN `p_mobile` VARCHAR(255), IN `p_email` VARCHAR(255))   BEGIN
    UPDATE users
    SET
        fullname = p_fullname,
        mobile = p_mobile,
        email = p_email
    WHERE
        id = p_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 5, 38, 1, '2023-11-30 13:48:06', '2023-11-30 13:48:06', NULL),
(8, 5, 42, 1, '2023-11-30 13:48:13', '2023-11-30 13:48:13', NULL),
(9, 6, 39, 1, '2023-12-04 03:51:00', '2023-12-04 03:51:00', NULL),
(13, 7, 44, 1, '2023-12-04 04:19:26', '2023-12-04 04:19:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(13, 4, 44, '2023-12-17 15:40:13', '2023-12-17 15:40:13'),
(14, 4, 44, '2023-12-17 15:40:15', '2023-12-17 15:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `images` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `description`, `quantity`, `price`, `images`, `created_at`, `updated_at`, `deleted_at`) VALUES
(37, 1, '23123', '123123', 10, 12, '[\"product-23123-77081.jpg\"]', '2023-11-26 06:41:25', '2023-11-26 06:41:25', '2023-12-04 03:56:28'),
(38, 1, '123123', 'This is just a sample', 3, 11, '[\"product-123123-32732.png\"]', '2023-11-28 07:01:59', '2023-11-28 07:01:59', '2023-12-04 03:56:23'),
(39, 1, '123123', 'This is just a sample', 6, 11, '[\"product-123123-73487.jpg\"]', '2023-11-28 07:17:23', '2023-11-28 07:17:23', '2023-12-04 03:56:35'),
(40, 1, 'Prods', 'This is just a sample.', 9, 11, '[\"product-Prods-67426.png\"]', '2023-11-28 07:18:54', '2023-11-28 07:18:54', '2023-12-04 03:56:18'),
(41, 1, '123123', '123123', 121, 123, '[\"product-123123-76614.jpg\"]', '2023-11-30 13:38:06', '2023-11-30 13:38:06', '2023-12-04 03:56:13'),
(42, 1, '123', '123123', 115, 12, '[\"product-123-56908.jpg\"]', '2023-11-30 13:38:27', '2023-11-30 13:38:27', '2023-12-04 03:56:09'),
(43, 1, 'chicken  feet', 'lami nga dili bidle', 82, 15, '[\"product-chicken  feet-23407.jpg\"]', '2023-12-04 04:09:00', '2023-12-04 04:09:00', NULL),
(44, 1, 'chicken ', 'chicken', 5, 25, '[\"product-chicken -22385.jpg\"]', '2023-12-04 04:18:29', '2023-12-04 04:18:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `trans_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `transaction_amount` int(11) NOT NULL,
  `paymentMethod` varchar(125) NOT NULL,
  `proofOfQRcode` text NOT NULL,
  `deliver_status` int(11) NOT NULL DEFAULT 0 COMMENT '0 if not yet delivered, 1 if delivered',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`trans_id`, `product_id`, `seller_id`, `buyer_id`, `transaction_amount`, `paymentMethod`, `proofOfQRcode`, `deliver_status`, `created_date`) VALUES
(10, 44, 1, 4, 250, '1', 'product-123123-76614.jpg', 3, '2023-12-17 14:48:13'),
(11, 43, 1, 4, 30, '1', 'product-123123-76614.jpg', 3, '2023-12-17 14:50:37'),
(12, 44, 1, 4, 175, '2', '../uploads/products/gcash.jpg', 2, '2023-12-18 03:14:57'),
(13, 43, 1, 4, 180, '2', '../uploads/products/gcash.jpg', 3, '2023-12-18 03:17:00'),
(14, 43, 1, 9, 135, '2', '../uploads/products/gcash.jpg', 3, '2023-12-18 05:23:08'),
(15, 44, 1, 4, 25, '2', '../uploads/products/intro_2.jpg', 0, '2023-12-19 00:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `profile` text NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `qrcodeMain` text DEFAULT NULL,
  `counterlock` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile`, `fullname`, `username`, `password`, `email`, `address`, `mobile`, `role`, `created_at`, `updated_at`, `status`, `qrcodeMain`, `counterlock`, `deleted_at`) VALUES
(1, '', 'Admin', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'LLC', '09123456789', 1, '2023-11-24 02:33:02', '2023-11-24 02:33:02', 0, '../uploads/products/qrcode.jpg', 0, NULL),
(2, '', '12312323', 'Sample Of This', 'caf1a3dfb505ffed0d024130f58c5cfa', '123123@123', '123123', '123123', 1, '2023-11-26 05:11:03', '2023-11-26 05:11:03', 0, '', 0, NULL),
(3, '', '1231234', '123123', '4297f44b13955235245b2497399d7a93', '123123@123123', '123123', '123123', 0, '2023-11-28 06:32:01', '2023-11-30 13:41:38', 0, '', 0, '2023-11-30 13:41:57'),
(4, '', '123123', '123123', '202cb962ac59075b964b07152d234b70', '123@123', '123123', '1231234', 0, '2023-11-28 06:34:12', '2023-12-04 04:03:02', 0, '', 0, '2023-12-17 10:50:21'),
(5, '../uploads/products/3.png', '123', '123', '202cb962ac59075b964b07152d234b70', 'q', '123', '123', 0, '2023-11-28 06:47:13', '2023-11-28 06:47:13', 0, '', 0, NULL),
(6, '../uploads/products/381017611_813509207223329_5352612233222037167_n.jpg', 'renalyn', 'rena123', '202cb962ac59075b964b07152d234b70', 'renalyn@gmail.com', 'pusok llc ', '0921312123', 0, '2023-12-04 03:50:29', '2023-12-04 03:50:29', 0, NULL, 0, '2023-12-04 03:57:00'),
(7, '../uploads/products/381017611_813509207223329_5352612233222037167_n.jpg', 'bitay mendez', 'bitay', '7c6f5bdc16b3748b481fb5ea98bd4ace', 'mendez@gmail.com', 'buagsong cordova', '09923880528', 0, '2023-12-04 04:13:32', '2023-12-04 04:13:32', 0, NULL, 0, NULL),
(8, '../uploads/products/381017611_813509207223329_5352612233222037167_n.jpg', 'elgrids V mendez', 'pogi123', '81dc9bdb52d04dc20036dbd8313ed055', 'bitay@123', 'isla kanto panki', '922312312', 0, '2023-12-04 04:51:18', '2023-12-04 04:51:18', 0, NULL, 0, NULL),
(9, '../uploads/products/bleulock.jpg', 'stephanie rose pogoy mendez', 'phanie', '202cb962ac59075b964b07152d234b70', 'phanie@123', 'cpc', '922312312', 0, '2023-12-18 05:22:17', '2023-12-18 05:22:17', 0, NULL, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts.product_id` (`product_id`),
  ADD KEY `carts.user_id` (`user_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorites.user_id` (`user_id`),
  ADD KEY `favorites.product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id` (`user_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts.product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts.user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites.product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites.user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products.user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
