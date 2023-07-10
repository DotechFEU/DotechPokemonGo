-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2023 at 04:17 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `currency` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `name`, `image`, `price`, `currency`) VALUES
(1, '100 PokeCoins', 'images/pokecoins-100.png', 29, 'PHP'),
(2, '550 PokeCoins', 'images/pokecoins-550.png', 249, 'PHP'),
(3, '1200 PokeCoins', 'images/pokecoins-1200.png', 299, 'PHP'),
(4, '2500 PokeCoins', 'images/pokecoins-2500.png', 999, 'PHP'),
(5, '5200 PokeCoins', 'images/pokecoins-5200.png', 1990, 'PHP'),
(6, '14500 PokeCoins', 'images/pokecoins-14500.png', 4990, 'PHP'),
(7, 'Beginner Box', 'images/boxes-beginner.png', 150, 'PKC'),
(8, 'Trainee Box', 'images/boxes-trainee.png', 215, 'PKC'),
(9, 'New Trainer Box', 'images/boxes-new_trainer.png', 75, 'PKC'),
(10, 'Remote Raid Box', 'images/boxes-remote_raid.png', 650, 'PKC'),
(11, 'Voyager Box', 'images/boxes-voyager.png', 1485, 'PKC'),
(12, 'Starter Box', 'images/boxes-starter.png', 150, 'PKC'),
(13, 'Remote Raid Pass', 'images/items-remote_raid_pass.png', 195, 'PKC'),
(14, '3 Remote Raid Passes', 'images/items-3_remote_raid_passes.png', 525, 'PKC'),
(15, 'Premium Battle Pass', 'images/items-premium_battle_pass.png', 100, 'PKC'),
(16, '3 Premium Battle Passes', 'images/items-3_premium_battle_pass.png', 250, 'PKC'),
(17, 'Egg Incubator', 'images/items-egg_incubator.png', 150, 'PKC'),
(18, 'Super Incubator', 'images/items-super_incubator.png', 200, 'PKC'),
(19, 'Poffin', 'images/items-poffin.png', 100, 'PKC'),
(20, '20 Pokeballs', 'images/items-20_pokeballs.png', 100, 'PKC'),
(21, '100 Pokeballs', 'images/items-100_pokeballs.png', 460, 'PKC'),
(22, '200 Pokeballs', 'images/items-200_pokeballs.png', 800, 'PKC'),
(23, 'Incense', 'images/items-incense.png', 40, 'PKC'),
(24, '8 Incense', 'images/items-8_incense.png', 250, 'PKC'),
(25, 'Starpiece', 'images/items-starpiece.png', 100, 'PKC'),
(26, '8 Starpiece', 'images/items_8_starpiece.png', 640, 'PKC'),
(27, 'Lucky Egg', 'images/items-lucky_egg.png', 80, 'PKC'),
(28, '8 Lucky Eggs', 'images/items-8_lucky_eggs.png', 500, 'PKC'),
(29, '10 Max Potions', 'images/items-10_max_potions.png', 200, 'PKC'),
(30, '6 Max Revives', 'images/items-6_max_revives.png', 180, 'PKC'),
(31, 'Glacial Lure Module', 'images/items-glacial_lure_module.png', 180, 'PKC'),
(32, 'Mossy Lure Module', 'images/items-mossy_lure_module.png', 180, 'PKC'),
(33, 'Magnetic Lure Module', 'images/items-magnetic_lure_module.png', 180, 'PKC'),
(34, 'Rainy Lure Module', 'images/items-rainy_lure_module.png', 180, 'PKC'),
(35, 'Lure Module', 'images/items-lure_module.png', 180, 'PKC'),
(36, '8 Lure Modules', 'images/items-8_lure_modules.png', 680, 'PKC'),
(37, 'Item Bag', 'images/upgrades-item_bag.png', 200, 'PKC'),
(38, 'Pokemon Storage', 'images/upgrades-pokemon_storage.png', 200, 'PKC'),
(39, 'Postcard Pages', 'images/upgrades-postcard_pages.png', 100, 'PKC'),
(40, 'Team Medalion', 'images/upgrades-team_medalion.png', 1000, 'PKC');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `transaction_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `id_number` varchar(20) NOT NULL,
  `date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_products`
--

CREATE TABLE `tbl_transaction_products` (
  `transaction_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_acc`
--

CREATE TABLE `tbl_user_acc` (
  `id_number` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass_word` varchar(20) NOT NULL,
  `pokecoins` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `id_number` (`id_number`);

--
-- Indexes for table `tbl_transaction_products`
--
ALTER TABLE `tbl_transaction_products`
  ADD PRIMARY KEY (`transaction_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_user_acc`
--
ALTER TABLE `tbl_user_acc`
  ADD PRIMARY KEY (`id_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `transaction_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  ADD CONSTRAINT `fk_transactions_user_acc` FOREIGN KEY (`id_number`) REFERENCES `tbl_user_acc` (`id_number`) ON DELETE CASCADE;;

--
-- Constraints for table `tbl_transaction_products`
--
ALTER TABLE `tbl_transaction_products`
  ADD CONSTRAINT `tbl_transaction_products_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `tbl_transactions` (`transaction_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_transaction_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
