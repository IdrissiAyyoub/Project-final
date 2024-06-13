-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 02:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pfe`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `ShareID` int(11) NOT NULL,
  `BookID` varchar(255) DEFAULT NULL,
  `UserID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `Genre` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `CoverImage` varchar(255) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ShareID`, `BookID`, `UserID`, `Title`, `Author`, `Genre`, `Description`, `CoverImage`, `CreatedAt`) VALUES
(1, 'mFT_CgAAQBAJ', 9, 'To Kill a Mockingbird', 'Harper Lee', 'Fiction', 'A novel about racial injustice.', 'mockingbird.jpg', '2024-06-12 00:00:00'),
(2, 'SNAjMMp3H5UC', 10, '1984', 'George Orwell', 'Dystopian', 'A novel about a totalitarian regime.', '1984.jpg', '2024-06-12 01:00:00'),
(3, 'h56jAgAAQBAJ', 9, 'Pride and Prejudice', 'Jane Austen', 'Romance', 'A classic novel of manners.', 'pride_prejudice.jpg', '2024-06-12 02:00:00'),
(4, 'LD9tCQAAQBAJ', 10, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Fiction', 'A novel about the American dream.', 'gatsby.jpg', '2024-06-12 03:00:00'),
(5, 'p7mHEAAAQBAJ', 9, 'Moby Dick', 'Herman Melville', 'Adventure', 'A story about a giant whale.', 'moby_dick.jpg', '2024-06-12 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ShareID` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentID`, `UserID`, `ShareID`, `Comment`, `CreatedAt`) VALUES
(1, 9, 1, 'Amazing book!', '2024-06-12 04:00:00'),
(2, 10, 2, 'A thought-provoking read.', '2024-06-12 04:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `LikeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ShareID` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`LikeID`, `UserID`, `ShareID`, `CreatedAt`) VALUES
(1, 9, 1, '2024-06-12 05:00:00'),
(2, 10, 2, '2024-06-12 05:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `savedbooks`
--

CREATE TABLE `savedbooks` (
  `SavedBookID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ShareID` int(11) NOT NULL,
  `ReadingStatus` enum('to-read','reading','read') NOT NULL DEFAULT 'to-read',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savedbooks`
--

INSERT INTO `savedbooks` (`SavedBookID`, `UserID`, `ShareID`, `ReadingStatus`, `CreatedAt`) VALUES
(0, 14, 1, 'to-read', '2024-06-12 00:44:33'),
(27, 14, 3, 'to-read', '2024-06-12 00:44:33'),
(78, 14, 2, 'to-read', '2024-06-12 00:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `sharedbooks`
--

CREATE TABLE `sharedbooks` (
  `ShareID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BookID` varchar(255) DEFAULT NULL,
  `DateShared` timestamp NOT NULL DEFAULT current_timestamp(),
  `Comment` text DEFAULT NULL,
  `PDFPath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userbooksinterests`
--

CREATE TABLE `userbooksinterests` (
  `UserID` int(11) NOT NULL,
  `BookInterest` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userbooksinterests`
--

INSERT INTO `userbooksinterests` (`UserID`, `BookInterest`) VALUES
(9, 'Classic'),
(10, 'Dystopian');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Genre` enum('male','female','other') NOT NULL DEFAULT 'other',
  `Birthday` date DEFAULT NULL,
  `Bio` text DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `ProfilePicture` varchar(255) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `FullName`, `Genre`, `Birthday`, `Bio`, `Password`, `ProfilePicture`, `CreatedAt`) VALUES
(9, 'AyoubTest', 'AYOUB@gmail.com', 'AYoub', 'male', '2024-05-27', 'A man obsessed with books ', '$2y$10$fgiGViwkh.gjadF3/w2ymepdEl1.y2dsqjmysV/jjq6F/KBrvL7Ua', 'uploads/Capture.PNG', '2024-06-05 16:27:47'),
(10, 'Idrissi', 'Ayyoub@idrissi.com', 'Ayyoub', 'male', '2024-06-14', 'A man obsessed with books ', '$2y$10$NLRJOv1CVfYxq8dDtf02leIBEg6WaQyHrHFOqJRUo2U4Sc4/RyLYy', 'uploads/screencapture-localhost-Final-Projects-Project-final-register-login-php-2024-06-06-23_57_58.png', '2024-06-07 11:01:42'),
(11, 'AyoubTest', 'yaho@yaho.com', 'Ayyoub', 'female', '2004-01-08', 'A man obsessed with books ', '$2y$10$jaJid88b25R5ZG32ozkhaeL9KBmUGVofql.sDtIhvhOTXUuV/zYTa', 'uploads/screencapture-localhost-Final-Projects-Project-final-register-login-php-2024-06-07-00_06_35.png', '2024-06-08 15:09:08'),
(12, 'Idrissi', 'ayy@gmail.com', 'ayoub', 'male', '2024-06-06', 'A man obsessed with books ', '$2y$10$SosUWXyVcd5NuNyKlC6kvucLUYjDljo4DmCUCuEi4ukuVRQmXQkbO', 'uploads/image1-ezgif.com-gif-maker.gif', '2024-06-10 01:05:51'),
(14, 'AyoubTest', 'idrissiayyoub@gmail.com', 'ijio', 'other', '2024-06-08', 'A man obsessed with books ', '$2y$10$bIFlEDx5xFUQb0WEKNFztO3LYV3Ca9hlSW8.2EPT2cbk4aL3NCfGe', 'uploads/DICTIONARY.png', '2024-06-10 15:01:39'),
(16, 'AyoubTest', 'testpfe@gmail.com', 'ayoub', 'male', '2018-02-11', 'A man obsessed with books ', '$2y$10$LnCaWptb6nKzu8xbIV4sIuzqxFjBnLaise8ctCCDAaXJCqk9KLf4q', 'uploads/Capture.PNG', '2024-06-11 23:02:48'),
(17, 'ayoub', 'ayou@gmail.com', 'ayoub', 'male', '2024-06-07', 'someone interesset it ', '$2y$10$nO/Zan1R6M.i9zddSRFXpuQ4rPpw431oz9sl2aBSzL6B3Ck7g6gnK', 'uploads/Desktop - 3.png', '2024-06-12 23:17:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ShareID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ShareID` (`ShareID`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`LikeID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ShareID` (`ShareID`);

--
-- Indexes for table `savedbooks`
--
ALTER TABLE `savedbooks`
  ADD PRIMARY KEY (`SavedBookID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ShareID` (`ShareID`);

--
-- Indexes for table `sharedbooks`
--
ALTER TABLE `sharedbooks`
  ADD PRIMARY KEY (`ShareID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `userbooksinterests`
--
ALTER TABLE `userbooksinterests`
  ADD PRIMARY KEY (`UserID`,`BookInterest`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `ShareID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `LikeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `savedbooks`
--
ALTER TABLE `savedbooks`
  MODIFY `SavedBookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `sharedbooks`
--
ALTER TABLE `sharedbooks`
  MODIFY `ShareID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`ShareID`) REFERENCES `books` (`ShareID`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`ShareID`) REFERENCES `books` (`ShareID`) ON DELETE CASCADE;

--
-- Constraints for table `savedbooks`
--
ALTER TABLE `savedbooks`
  ADD CONSTRAINT `savedbooks_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `savedbooks_ibfk_2` FOREIGN KEY (`ShareID`) REFERENCES `books` (`ShareID`);

--
-- Constraints for table `userbooksinterests`
--
ALTER TABLE `userbooksinterests`
  ADD CONSTRAINT `userbooksinterests_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
