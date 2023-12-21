SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE SCHEMA upholster;

use upholster;

CREATE TABLE `addresses` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_region` varchar(225) NOT NULL,
  `address_province` varchar(225) NOT NULL,
  `address_city` varchar(225) NOT NULL,
  `address_barangay` varchar(225) NOT NULL,
  `address_street` varchar(225) NOT NULL,
  `address_zipCode` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantityCart` int(11) NOT NULL DEFAULT 1,
  `statusCart` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 3 COMMENT '1 = approve, 2 = cancelled, 3 = pending.',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_picture` text NOT NULL,
  `productName` varchar(125) NOT NULL,
  `productDescription` text NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `productStatus` int(11) NOT NULL DEFAULT 1 COMMENT '0 = Recommended,  1 = displayed, 2 = Not displayed',
  `productSales` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `products` (`product_id`, `product_picture`, `productName`, `productDescription`, `productPrice`, `productQuantity`, `productStatus`, `productSales`, `created_at`, `updated_at`) VALUES
(1, 'bedroom set of 4.jpg', 'bedroom sets of 4', 'This product is bedroom sets of 4.', 25000, 1, 1, 0, '2023-12-21 11:50:25', '2023-12-21 11:50:25'),
(2, 'chair 2 set.jpg', 'chair set of 2', 'This chair is good for 2 people.', 10000, 1, 1, 0, '2023-12-21 11:51:04', '2023-12-21 11:51:04'),
(3, 'chair set of 2.jpg', 'chair set of 2', 'This product is sets of 2 people.', 12000, 1, 1, 0, '2023-12-21 11:51:35', '2023-12-21 11:51:35'),
(4, 'couple bed.jpg', 'Couple bed', 'This is a bed for couple.', 8000, 1, 1, 0, '2023-12-21 11:51:58', '2023-12-21 11:51:58'),
(5, 'full set.jpg', 'Full set', 'full sets of products.', 25000, 5, 1, 0, '2023-12-21 11:53:42', '2023-12-21 11:53:42'),
(6, 'ottoman.jpg', 'Ottomans', 'Ottomans is on sale.', 15000, 1, 1, 0, '2023-12-21 11:54:31', '2023-12-21 11:54:31'),
(7, 'single chair.png', 'Single Chair', 'single chair for singles', 9000, 1, 1, 0, '2023-12-21 11:55:01', '2023-12-21 11:55:01'),
(8, 'single set.jpg', 'Single chair blue', 'Single chair but color blue', 9000, 1, 1, 0, '2023-12-21 11:55:56', '2023-12-21 11:55:56'),
(9, 'singlewhitechair.jpg', 'Single white chair', 'Single chair but white color.', 13000, 1, 1, 0, '2023-12-21 11:56:23', '2023-12-21 11:56:23');

CREATE TABLE `recommendations` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(16) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `Types` varchar(125) NOT NULL,
  `color` varchar(125) NOT NULL,
  `fabric` varchar(125) NOT NULL,
  `paymentTotalPrice` int NOT NULL,
  `message` text NOT NULL,
  `paymentMethod` varchar(125) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 is not done, 2 is done',
  `dateDeliver` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;    

CREATE TABLE `requestform` (
  `requestForm_id` int(11) NOT NULL,
  `Types` varchar(125) NOT NULL,
  `Color` varchar(125) NOT NULL,
  `fabric` varchar(125) NOT NULL,
  `typePrice` int(11) NOT NULL,
  `colorPrice` int(11) NOT NULL,
  `fabricPrice` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `requestform` (`requestForm_id`, `Types`, `Color`, `fabric`, `typePrice`, `colorPrice`, `fabricPrice`, `created_at`, `updated_at`) VALUES
(1, 'Velvet', 'Rich jewel tones', 'Velvet', 1500, 300, 400, '2023-12-21 11:58:34', '2023-12-21 11:58:34'),
(2, 'Leather', ' Brown, black, tan, or burgundy', 'Genuine or faux leather', 1000, 200, 300, '2023-12-21 11:59:21', '2023-12-21 11:59:21'),
(3, 'Linen ', 'Natural hues like beige', 'Linen', 1000, 200, 420, '2023-12-21 12:00:32', '2023-12-21 12:00:32'),
(4, 'Microfiber', 'Neutral tones like gray', 'Microfiber', 12000, 1299, 999, '2023-12-21 12:01:04', '2023-12-21 12:01:04'),
(5, 'Polyester ', 'Wide range of colors', 'Polyester', 12999, 499, 699, '2023-12-21 12:01:33', '2023-12-21 12:01:33'),
(6, 'Jacquard', 'Intricate patterns', 'Jacquard', 32559, 1450, 1250, '2023-12-21 12:02:15', '2023-12-21 12:02:15');

CREATE TABLE `transactions` (
  `transac_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `transac_quantity` int(11) NOT NULL,
  `transac_status` int(11) NOT NULL COMMENT '1 = delivered, 2 = delivered',
  `date_delivery` varchar(110) DEFAULT NULL,
  `date_deleted` varchar(112) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text DEFAULT NULL,
  `email` varchar(125) NOT NULL,
  `phone` bigint(14) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `code` text NOT NULL,
  `reset_password` text NOT NULL,
  `verifyEmail` int(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 3,
  `profilePicture` text NOT NULL DEFAULT 'DefualtProfile.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `email`, `phone`, `status`, `code`, `role`, `profilePicture`, `created_at`, `updated_at`) VALUES
(1, 'George Alfeser', 'Inoc', 'Admin', '202cb962ac59075b964b07152d234b70', 'villarubia@gmail.com', 9484750030, 1, 'O85jI6YGgz', 1, 'DefualtProfile.png', NULL, '2023-07-11 05:24:24');

ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`);

ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`);

ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `requestform`
  ADD PRIMARY KEY (`requestForm_id`);

ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transac_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `recommendations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `requestform`
  MODIFY `requestForm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `transactions`
  MODIFY `transac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;