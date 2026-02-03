-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 04, 2025 at 11:41 PM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars4u_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `vin` varchar(17) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` year(4) NOT NULL,
  `mileage` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`vin`, `make`, `model`, `year`, `mileage`, `price`, `description`, `image_path`) VALUES
('1HGCM82633A004352', 'Honda', 'Accord', 2020, 25000, '22000.00', 'A reliable sedan with excellent fuel efficiency.', 'Images/Cars/honda_accord_2020.jpg'),
('3KPA24AB4NE123456', 'Kia', 'Forte', 2023, 1000, '30000.00', 'Sharp styling, roomy interior, plentiful standard features.', 'Images/Cars/kia_forte_2023.jpg'),
('WDBUF56X28B302345', 'Mercedes-Benz', 'E350', 2019, 40000, '35000.00', 'Luxury sedan with premium features and smooth ride.', 'Images/Cars/mercedes_e350_2019.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `saved_cars`
--

CREATE TABLE `saved_cars` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vin` varchar(17) NOT NULL,
  `date_saved` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `saved_cars`
--

INSERT INTO `saved_cars` (`id`, `user_id`, `vin`, `date_saved`) VALUES
(1, 1, '1HGCM82633A004352', '2025-05-04 19:09:43'),
(2, 1, '3KPA24AB4NE123456', '2025-05-04 19:09:46'),
(3, 1, '1HGCM82633A004352', '2025-05-04 19:16:20'),
(4, 1, 'WDBUF56X28B302345', '2025-05-04 19:16:23'),
(5, 2, 'WDBUF56X28B302345', '2025-05-04 19:19:08'),
(6, 2, '3KPA24AB4NE123456', '2025-05-04 19:19:38'),
(7, 2, '1HGCM82633A004352', '2025-05-04 19:19:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `first_name`, `last_name`, `zip`, `mobile`, `created_at`) VALUES
(1, 'test@example.com', '$2y$10$lMMgLvpVyS.92TNYiPkml.WT93oKvy9cveGVwONDJa6/Jx9b7YV16', 'Test', 'User', '21239', '(918) 082-1616', '2025-04-13 18:31:21'),
(2, 'shamarshedden23@gmail.com', '$2y$10$6ftMTzMpsiS1u1CLxxW0sepqW9RvI47fj3ls/DwsOJ611XJu/KjZG', 'Micah\'s', 'Husband', '20723', '(817) 807-3226', '2025-04-13 18:32:26'),
(3, 'test2@example.com', '$2y$10$Io1n9DssDCEd77z8zrk04eTpT9aIzKRuQWRB9BObHqGWE2ZwBAKZe', 'Joe', 'Smith', '21239', '(206) 342-8631', '2025-04-13 18:36:16'),
(4, 'test3@example.com', '$2y$10$eFE0rtziKxWTk/fh1/W/9.I/0i77nOnfqwrWWQqpDHOgrRqOuwrIi', 'Jane', 'Smith', '21239', '(914) 331-2455', '2025-04-13 18:36:23'),
(5, 'test4@example.com', '$2y$10$eFE0rtziKxWTk/fh1/W/9.I/0i77nOnfqwrWWQqpDHOgrRqOuwrIi', 'Jessie', 'James', '21239', '(203) 460-0853', '2025-04-13 18:36:23'),
(6, 'test5@example.com', '$2y$10$eFE0rtziKxWTk/fh1/W/9.I/0i77nOnfqwrWWQqpDHOgrRqOuwrIi', 'Alex', 'Taylor', '21239', '(415) 555-1234', '2025-04-13 18:49:38'),
(7, 'test6@example.com', '$2y$10$eFE0rtziKxWTk/fh1/W/9.I/0i77nOnfqwrWWQqpDHOgrRqOuwrIi', 'Morgan', 'Lee', '21239', '(312) 555-6789', '2025-04-13 18:49:38'),
(8, 'test7@example.com', '$2y$10$eFE0rtziKxWTk/fh1/W/9.I/0i77nOnfqwrWWQqpDHOgrRqOuwrIi', 'Casey', 'Jordan', '21239', '(646) 555-2468', '2025-04-13 18:49:38'),
(9, 'test8@example.com', '$2y$10$eFE0rtziKxWTk/fh1/W/9.I/0i77nOnfqwrWWQqpDHOgrRqOuwrIi', 'Taylor', 'Brooks', '21239', '(202) 555-3344', '2025-04-13 18:49:38'),
(10, 'test9@example.com', '$2y$10$eFE0rtziKxWTk/fh1/W/9.I/0i77nOnfqwrWWQqpDHOgrRqOuwrIi', 'Drew', 'Morgan', '21239', '(718) 555-1122', '2025-04-13 18:49:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`vin`);

--
-- Indexes for table `saved_cars`
--
ALTER TABLE `saved_cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vin` (`vin`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `saved_cars`
--
ALTER TABLE `saved_cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `saved_cars`
--
ALTER TABLE `saved_cars`
  ADD CONSTRAINT `saved_cars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `saved_cars_ibfk_2` FOREIGN KEY (`vin`) REFERENCES `products` (`vin`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
