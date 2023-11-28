-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 08:34 AM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `addProduct` (IN `p_user_id` INT, IN `p_name` VARCHAR(255), IN `p_description` VARCHAR(255), IN `p_quantity` INT, IN `p_price` DOUBLE, IN `p_images` TEXT, IN `p_qrcode` TEXT)   BEGIN
    INSERT INTO products(user_id, name, description, quantity, price, images, qrcode)
    VALUES(p_user_id, p_name, p_description, p_quantity, p_price, p_images, p_qrcode);
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

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `qrcode` text NOT NULL,
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
  `counterlock` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

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
