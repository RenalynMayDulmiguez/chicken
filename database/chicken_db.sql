-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2023 at 04:26 AM
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
    INTO users(fullname, username, email, password, address, mobile, myQrCode)
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
(71, 7678, 36, 1, '2023-11-05 07:46:06', '2023-11-05 07:46:06', NULL);

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
(109, 7678, 36, '2023-11-05 07:46:00', '2023-11-05 07:46:00');

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
(22, 3, 'amaw', '22', 33, 22, '[\"product-amaw-68903.png\"]', '2023-06-29 05:14:46', '2023-06-29 05:14:46', '2023-06-29 05:16:46'),
(23, 3, 'aw aw aw', '2', 2, 2, '[\"product-aw aw aw-82910.png\"]', '2023-06-29 05:15:27', '2023-06-29 05:15:27', '2023-06-29 05:16:43'),
(24, 3, '2', '2', 2, 2, '[\"product-2-55933.png\"]', '2023-06-29 05:15:50', '2023-06-29 05:15:50', '2023-06-29 05:16:39'),
(25, 3, '2', '2', 2, 2, '[\"product-2-66068.png\"]', '2023-06-29 05:15:59', '2023-06-29 05:15:59', '2023-06-29 05:16:36'),
(26, 3, '4', '4', 4, 400, '[\"product-4-91539.png\"]', '2023-06-29 05:16:13', '2023-06-29 05:16:13', '2023-06-29 05:16:32'),
(27, 3, 'aw aw aw', '5', 5, 500, '[\"product-aw aw aw-85194.png\"]', '2023-06-29 05:17:22', '2023-06-29 05:17:22', '2023-06-29 12:16:34'),
(29, 3, 'admin', 'fdfd', 232, 400, '[\"product-admin-83938.jpeg\"]', '2023-06-29 11:50:44', '2023-06-29 11:50:44', '2023-06-29 12:16:38'),
(30, 3, 'cake', 'cake', 232, 500, '[\"product-cake-85005.png\"]', '2023-06-29 12:24:34', '2023-06-29 12:24:34', '2023-06-30 02:02:15'),
(31, 3, 'cheese', 'tam is', 3, 320, '[\"product-cheese-91244.jpeg\"]', '2023-06-29 13:13:26', '2023-06-29 13:13:26', '2023-06-30 02:02:09'),
(32, 3, 'chicken', 'lami nga dli bidle', 500, 622, '[\"product-chicken-49338.png\"]', '2023-06-30 02:52:21', '2023-06-30 02:52:21', '2023-06-30 02:57:31'),
(33, 3, 'gfgf', '232323', 235, 400, '[\"product-gfgf-10462.png\"]', '2023-06-30 02:59:05', '2023-06-30 02:59:05', '2023-06-30 02:59:10'),
(34, 3, 'aw aw aw', '3232', 12, 323, '[\"product-aw aw aw-54795.png\"]', '2023-06-30 04:33:46', '2023-06-30 04:33:46', '2023-06-30 11:47:11'),
(36, 3, 'fdfd fdfd fdfd', 'dfd', 678, 12, '[\"product-fdfd fdfd fdfd-48705.jpg\"]', '2023-06-30 11:47:59', '2023-07-01 04:43:30', NULL);

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
(55, 0, 0, 0, 123, '', '', 1, '2023-11-09 23:58:46'),
(56, 0, 0, 0, 125, '', '', 1, '2023-11-09 23:58:46'),
(57, 123, 123, 123, 123, '123', '123', 0, '2023-11-09 23:59:16'),
(58, 123, 123, 123, 123, '123', '123', 0, '2023-11-09 23:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
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
  `counterlock` int(11) NOT NULL DEFAULT 0,
  `myQrCode` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `password`, `email`, `address`, `mobile`, `role`, `created_at`, `updated_at`, `status`, `counterlock`, `myQrCode`, `deleted_at`) VALUES
(3, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'admin', '2323232', 1, '2023-05-25 06:38:22', '2023-05-25 06:38:22', 0, 0, '[\"product-aw aw aw-54795.png\"]', NULL),
(7678, '123', '123', '4297f44b13955235245b2497399d7a93', '123@123', '123123', '123123123', 0, '2023-11-05 07:39:56', '2023-11-05 07:39:56', 0, 3, '../uploads/products/image-removebg-preview.png', NULL),
(7679, '123', '123', '202cb962ac59075b964b07152d234b70', '123@123', '123', '123', 0, '2023-11-05 07:42:11', '2023-11-05 07:42:11', 0, 0, '../uploads/products/image-removebg-preview.png', NULL),
(7680, '123123', '123123', '4297f44b13955235245b2497399d7a93', '123123@12312', '123', '123123', 0, '2023-11-05 09:09:17', '2023-11-05 09:09:17', 0, 0, '../uploads/products/image-removebg-preview (2).png', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7681;

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
