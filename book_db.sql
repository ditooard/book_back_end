-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2023 at 02:33 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books`
--

CREATE TABLE `tbl_books` (
  `book_id` int NOT NULL,
  `user_id` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `book_isbn` varchar(17) COLLATE utf8mb4_general_ci NOT NULL,
  `book_title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `book_desc` varchar(2000) COLLATE utf8mb4_general_ci NOT NULL,
  `book_author` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `book_price` decimal(6,2) NOT NULL,
  `book_qty` int NOT NULL,
  `book_status` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `book_date` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_books`
--

INSERT INTO `tbl_books` (`book_id`, `user_id`, `book_isbn`, `book_title`, `book_desc`, `book_author`, `book_price`, `book_qty`, `book_status`, `book_date`) VALUES
(1, '3', '978-0-7475-3269-9', 'Harry Potter and the Philosopher\'s Stone', 'Harry makes close friends and a few enemies during his first year at the school and with the help of his friends, Ron Weasley and Hermione Granger, he faces an attempted comeback by the dark wizard Lord Voldemort, who killed Harry\'s parents, but failed to kill Harry when he was just 15 months old.', 'J.K. Rowling', '260.00', 2, 'Used', '2023-11-27 09:27:18.289638'),
(2, '3', '978-0-439-35548-4', 'The Lord of the Rings', 'One Ring to rule them all, One Ring to find them, One Ring to bring them all, and in the darkness bind them.', 'J.R.R. Tolkien', '560.00', 3, 'Used', '2023-11-27 09:58:52.975503'),
(3, '3', '978-0-316-06529-2', 'The Hitchhiker\'s Guide to the Galaxy', 'Don\'t Panic!', 'Douglas Adams', '300.00', 1, 'Used', '2023-11-27 09:58:52.975503'),
(4, '3', '978-0-099-54281-9', 'Pride and Prejudice', 'It is a truth universally acknowledged, that a single man in possession of a good fortune, must be in want of a wife.', 'Jane Austen', '250.00', 2, 'New', '2023-11-27 09:58:52.975503'),
(5, '3', '978-0-141-00807-0', 'To Kill a Mockingbird', 'In the sleepy town of Maycomb, Alabama, during the 1930s, Scout Finch, a young girl, experiences racial injustice and defends her father, a lawyer defending a black man accused of raping a white woman.', 'Harper Lee', '350.00', 1, 'Used', '2023-11-27 09:58:52.975503'),
(6, '3', '978-0-8052-1128-9', 'The Catcher in the Rye', 'Holden Caulfield is a troubled teenager who is expelled from his boarding school and wanders around New York City, disillusioned with the world around him.', 'J.D. Salinger', '250.00', 1, 'Used', '2023-11-27 09:58:52.975503'),
(7, '3', '978-0-143-03513-8', 'Animal Farm', 'The animals of Manor Farm overthrow their human owners and establish a utopian society, but their ideals are soon corrupted by power and greed.', 'George Orwell', '300.00', 2, 'New', '2023-11-27 09:58:52.975503'),
(8, '3', '978-0-316-06273-0', 'The Great Gatsby', 'The mysterious millionaire Jay Gatsby throws lavish parties in his mansion, hoping to win back his lost love, Daisy Buchanan.', 'F. Scott Fitzgerald', '450.00', 1, 'Used', '2023-11-27 09:58:52.975503'),
(9, '3', '978-0-141-43175-5', '1984', 'Winston Smith works for the Thought Police in a dystopian society where Big Brother monitors every citizen\'s move.', 'George Orwell', '400.00', 3, 'New', '2023-11-27 09:58:52.975503'),
(10, '3', '978-0-316-00613-9', 'The Handmaid\'s Tale', 'Offred, a woman forced into sexual servitude, recounts her life in a totalitarian society where women are valued only for their reproductive abilities.', 'Margaret Atwood', '350.00', 2, 'Used', '2023-11-27 09:58:52.975503');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int NOT NULL,
  `user_email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `user_password` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `user_datereg` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_email`, `user_name`, `user_password`, `user_datereg`) VALUES
(3, 'slumberjer@gmail.com', 'Hanis', 'bec75d2e4e2acf4f4ab038144c0d862505e52d07', '2023-11-15 12:06:53.765976'),
(7, 'halim@email.com', 'Halim', 'bec75d2e4e2acf4f4ab038144c0d862505e52d07', '2023-11-15 12:17:15.964762');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_books`
--
ALTER TABLE `tbl_books`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `book_isbn` (`book_isbn`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_books`
--
ALTER TABLE `tbl_books`
  MODIFY `book_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
