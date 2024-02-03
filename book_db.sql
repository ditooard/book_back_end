-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 03, 2024 at 04:16 PM
-- Server version: 10.6.14-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u614023280_bookshelf`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books`
--

CREATE TABLE `tbl_books` (
  `book_id` int(11) NOT NULL,
  `user_id` varchar(5) NOT NULL,
  `book_isbn` varchar(17) NOT NULL,
  `book_title` varchar(200) NOT NULL,
  `book_desc` varchar(2000) NOT NULL,
  `book_author` varchar(100) NOT NULL,
  `book_price` decimal(6,2) NOT NULL,
  `book_qty` int(11) NOT NULL,
  `book_status` varchar(10) NOT NULL,
  `book_date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_books`
--

INSERT INTO `tbl_books` (`book_id`, `user_id`, `book_isbn`, `book_title`, `book_desc`, `book_author`, `book_price`, `book_qty`, `book_status`, `book_date`) VALUES
(1, '3', '978-0-7475-3269-9', 'Harry Potter and the Philosopher\'s Stone', 'Harry makes close friends and a few enemies during his first year at the school and with the help of his friends, Ron Weasley and Hermione Granger, he faces an attempted comeback by the dark wizard Lord Voldemort, who killed Harry\'s parents, but failed to kill Harry when he was just 15 months old.', 'J.K. Rowling', 200.00, 0, 'Used', '2023-11-27 09:27:18.289638'),
(2, '3', '978-0-439-35548-4', 'The Lord of the Rings', 'One Ring to rule them all, One Ring to find them, One Ring to bring them all, and in the darkness bind them.', 'J.R.R. Tolkien', 450.00, 4, 'Used', '2023-11-27 09:58:52.975503'),
(3, '3', '978-0-316-06529-2', 'The Hitchhiker\'s Guide to the Galaxy', 'Don\'t Panic!', 'Douglas Adams', 250.00, 1, 'Used', '2023-11-27 09:58:52.975503'),
(4, '9', '978-0-099-54281-9', 'Pride and Prejudice', 'It is a truth universally acknowledged, that a single man in possession of a good fortune, must be in want of a wife.', 'Jane Austen', 250.00, 1, 'New', '2023-11-27 09:58:52.975503'),
(5, '3', '978-0-141-00807-0', 'To Kill a Mockingbird', 'In the sleepy town of Maycomb, Alabama, during the 1930s, Scout Finch, a young girl, experiences racial injustice and defends her father, a lawyer defending a black man accused of raping a white woman.', 'Harper Lee', 300.00, 3, 'Used', '2023-11-27 09:58:52.975503'),
(6, '9', '978-0-8052-1128-9', 'The Catcher in the Rye', 'Holden Caulfield is a troubled teenager who is expelled from his boarding school and wanders around New York City, disillusioned with the world around him.', 'J.D. Salinger', 250.00, 1, 'Used', '2023-11-27 09:58:52.975503'),
(7, '3', '978-0-143-03513-8', 'Animal Farm', 'The animals of Manor Farm overthrow their human owners and establish a utopian society, but their ideals are soon corrupted by power and greed.', 'George Orwell', 500.00, 5, 'New', '2023-11-27 09:58:52.975503'),
(8, '9', '978-0-316-06273-0', 'The Great Gatsby', 'The mysterious millionaire Jay Gatsby throws lavish parties in his mansion, hoping to win back his lost love, Daisy Buchanan.', 'F. Scott Fitzgerald', 450.00, 1, 'Used', '2023-11-27 09:58:52.975503'),
(10, '3', '978-0-316-00613-9', 'The Handmaid\'s Tale', 'Offred, a woman forced into sexual servitude, recounts her life in a totalitarian society where women are valued only for their reproductive abilities.', 'Margaret Atwood', 350.00, 2, 'Used', '2023-11-27 09:58:52.975503'),
(11, '3', '978-0-743-29803-2', 'The Thirteenth Tale: A Novel Paperback', 'Reclusive author Vida Winter, famous for her collection of twelve enchanting stories, has spent the past six decades penning a series of alternate lives for herself. ', 'Diane Settlefield', 60.00, 1, 'Used', '2023-11-27 12:46:47.046814'),
(12, '3', '978-0-06-130362-7', 'And Then There Were None', 'Ten strangers are invited to an isolated island and are systematically murdered, one by one. The murderer is among them, but who is it?', 'Agatha Christie', 300.00, 2, 'Used', '2023-11-29 12:06:34.096621'),
(13, '9', '0-399-12321-5', 'Murder on the Orient Express', 'Hercule Poirot is on board the luxurious Orient Express when a murder occurs. He must use his detective skills to solve the case and bring the murderer to justice.', 'Agatha Christie', 350.00, 1, 'Used', '2023-11-29 12:06:34.096621'),
(14, '3', '0-06-092798-7', 'The Hound of the Baskervilles', 'Sherlock Holmes and his partner Dr. Watson investigate a series of strange and deadly events on the moors of Dartmoor.', 'Arthur Conan Doyle', 280.00, 3, 'New', '2023-11-29 12:06:34.096621'),
(15, '3', '0-7475-6320-6', 'The Adventures of Sherlock Holmes', 'A collection of twelve short stories featuring the brilliant detective Sherlock Holmes and his trusted companion Dr. Watson.', 'Arthur Conan Doyle', 400.00, 2, 'New', '2023-11-29 12:06:34.096621'),
(16, '3', '0-14-194949-5', 'The Maltese Falcon', 'Sam Spade, a private investigator in San Francisco, is hired to find a priceless jeweled falcon, but he soon finds himself entangled in a web of deceit and murder.', 'Dashiell Hammett', 320.00, 1, 'Used', '2023-11-29 12:06:34.096621'),
(17, '9', '0-394-55808-X', 'The Big Sleep', 'Raymond Chandler\'s classic detective novel follows Philip Marlowe, a private investigator, as he investigates the mysterious disappearance of a wealthy man\'s daughter.', 'Raymond Chandler', 350.00, 2, 'New', '2023-11-29 12:06:34.096621'),
(18, '3', '0-316-32223-X', 'In Cold Blood', 'Truman Capote\'s non-fiction novel recounts the real-life murder of a wealthy farm family in Kansas and the subsequent trial and execution of the killers.', 'Truman Capote', 400.00, 1, 'Used', '2023-11-29 12:06:34.096621'),
(20, '9', '0-399-12327-3', 'The Postman Always Rings Twice', 'Frank Chambers, a drifter, falls in love with Cora Knapp, a married diner waitress. Together, they plot to kill Cora\'s husband and collect the insurance money.', 'James M. Cain', 300.00, 3, 'Used', '2023-11-29 12:06:34.096621');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carts`
--

CREATE TABLE `tbl_carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` varchar(5) NOT NULL,
  `book_id` varchar(5) NOT NULL,
  `cart_qty` int(11) NOT NULL,
  `cart_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_carts`
--

INSERT INTO `tbl_carts` (`cart_id`, `user_id`, `book_id`, `cart_qty`, `cart_status`) VALUES
(5, '2', '1', 1, 'New'),
(6, '11', '1', 1, 'Paid'),
(7, '11', '2', 1, 'Paid'),
(14, '12', '2', 1, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(5) NOT NULL,
  `user_id` varchar(5) NOT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `order_date` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `order_status` varchar(10) NOT NULL,
  `cart_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `user_id`, `order_total`, `order_date`, `order_status`, `cart_id`) VALUES
(1, '7', 750.00, '2023-12-17 12:36:03.000000', 'Delivered', 13),
(2, '8', 250.00, '2023-12-17 13:11:14.000000', 'New', 20),
(3, '11', 820.00, '2024-02-02 13:39:34.117026', 'New', 0),
(4, '13', 200.00, '2024-02-03 05:26:27.789719', 'New', 13),
(5, '12', 250.00, '2024-02-03 05:27:51.257781', 'New', 10),
(6, '12', 450.00, '2024-02-03 05:33:16.416925', 'New', 14),
(7, '13', 200.00, '2024-02-03 11:09:04.841421', 'New', 19);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(5) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_phone` varchar(12) NOT NULL,
  `user_password` varchar(40) NOT NULL,
  `user_datereg` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `user_photo` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_email`, `user_name`, `user_phone`, `user_password`, `user_datereg`) VALUES
(3, 'slumberjer@gmail.com', 'Hanis', '0195555567', 'bec75d2e4e2acf4f4ab038144c0d862505e52d07', '2024-02-02 13:31:20.295485'),
(7, 'halim@email.com', 'Halim', '0122225556', 'bec75d2e4e2acf4f4ab038144c0d862505e52d07', '2024-02-02 13:31:20.295485'),
(8, 'zahir@email.com', 'Zahir', '', 'bec75d2e4e2acf4f4ab038144c0d862505e52d07', '2024-02-02 13:31:20.295485'),
(9, 'zarina@email.com', 'Zarina Ahmad', '', 'bec75d2e4e2acf4f4ab038144c0d862505e52d07', '2024-02-02 13:31:20.295485'),
(10, 'jacknick@email.com', 'Jack Nick', '0194443332', 'bec75d2e4e2acf4f4ab038144c0d862505e52d07', '2024-02-02 13:31:20.295485'),
(11, 'hendri@gmail.com', 'Adrian Ramadhan', '081357426470', 'e974e0e53a0d9a102ce197afa544a4cb9df96949', '2024-02-02 13:36:09.857473'),
(12, 'mfadilahalfarizy@gmail.com', 'Alfarizy ', '0133217268', '52bd8025305c329aa47d1bd8db795250d1337407', '2024-02-03 05:09:08.817430'),
(13, 'doplong@gmail.com', 'Ahmad Isa', '081357426470', '9c49301d5983a3c33c52faa536a7d2a8e1426427', '2024-02-03 05:20:06.468366');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_books`
--
ALTER TABLE `tbl_books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_books`
--
ALTER TABLE `tbl_books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
