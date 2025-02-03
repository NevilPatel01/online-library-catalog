-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 03, 2024 at 03:32 PM
-- Server version: 8.0.35
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_catalog`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre_id` int NOT NULL,
  `publication_date` date DEFAULT NULL,
  `summary` text,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `genre_id`, `publication_date`, `summary`, `cover_image`, `created_at`, `updated_at`) VALUES
(1, 'The Time Machine', 'H.G. Wells', 1, '1895-01-01', 'A science fiction novella about time travel.', 'time_machine.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(2, 'Dune', 'Frank Herbert', 1, '1965-08-01', 'A science fiction novel about a desert planet and its political struggles.', 'dune.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(3, 'The Hobbit', 'J.R.R. Tolkien', 2, '1937-09-21', 'A fantasy novel about the journey of Bilbo Baggins.', 'hobbit.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(4, 'The Lord of the Rings', 'J.R.R. Tolkien', 2, '1954-07-29', 'A high fantasy epic about the battle to destroy the One Ring.', 'lotr.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(5, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 3, '2011-01-01', 'A historical exploration of humanity\'s origins and evolution.', 'sapiens.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(6, 'The Diary of a Young Girl', 'Anne Frank', 3, '1947-06-25', 'The writings of Anne Frank during her time in hiding during WWII.', 'diary_anne.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(7, 'The Power of Habit', 'Charles Duhigg', 8, '2012-02-28', 'A self-help book on the science of habits and how to change them.', 'power_of_habit.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(8, 'Atomic Habits', 'James Clear', 8, '2018-10-16', 'A guide to building good habits and breaking bad ones.', 'atomic_habits.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(9, 'Dracula', 'Bram Stoker', 9, '1897-05-26', 'A horror novel about the vampire Count Dracula and his attempt to move from Transylvania to England.', 'dracula.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(10, 'Frankenstein', 'Mary Shelley', 9, '1818-01-01', 'A gothic horror novel about the creation of a monster.', 'frankenstein.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(13, 'Pride and Prejudice', 'Jane Austen', 7, '1813-01-28', 'A romantic novel about the life of Elizabeth Bennet.', 'pride_prejudice.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(14, 'The Fault in Our Stars', 'John Green', 7, '2012-01-10', 'A romance novel about two teenagers battling cancer.', 'fault_in_our_stars.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(15, 'The Shining', 'Stephen King', 9, '1977-01-28', 'A horror novel about a haunted hotel and a family’s experience there.', 'shining.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(16, 'To Kill a Mockingbird', 'Harper Lee', 3, '1960-07-11', 'A historical novel about racism in the American South.', 'mockingbird.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(17, '1984', 'George Orwell', 3, '1949-06-08', 'A dystopian novel about totalitarianism and surveillance.', '1984.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(18, 'The Catcher in the Rye', 'J.D. Salinger', 3, '1951-07-16', 'A novel about the troubled teenager Holden Caulfield.', 'catcher_in_the_rye.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(19, 'The Hunger Games', 'Suzanne Collins', 2, '2008-09-14', 'A dystopian novel set in a future where children fight to the death in televised games.', 'hunger_games.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(20, 'The Maze Runner', 'James Dashner', 2, '2009-10-06', 'A science fiction novel about teenagers trapped in a maze.', 'maze_runner.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(21, 'Beloved', 'Toni Morrison', 3, '1987-09-16', 'A novel about the haunting legacy of slavery in post-Civil War America.', 'beloved.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(22, 'Shutter Island', 'Dennis Lehane', 6, '2003-02-01', 'A psychological mystery about a detective investigating the disappearance of a patient from a mental institution.', 'shutter_island.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(23, 'Brave New World', 'Aldous Huxley', 3, '1932-08-01', 'A dystopian novel about a futuristic society and its control over individuals.', 'brave_new_world.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(24, 'Catch-22', 'Joseph Heller', 3, '1961-11-10', 'A satirical novel about the absurdities of war and bureaucracy.', 'catch22.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(25, 'The Silent Patient', 'Alex Michaelides', 6, '2019-02-05', 'A psychological thriller about a woman who stops speaking after being accused of murder.', 'silent_patient.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(26, 'The Alchemist', 'Paulo Coelho', 7, '1988-01-01', 'A novel about a shepherd’s journey to find a hidden treasure.', 'alchemist.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(27, 'The Help', 'Kathryn Stockett', 3, '2009-02-10', 'A novel about the lives of African-American maids working in white households in the 1960s South.', 'help.jpg', '2024-11-28 06:05:26', '2024-11-28 06:05:26'),
(40, 'The Girl with the Dragon Tattoo', 'Stieg Larsson', 6, '2005-08-01', 'A mystery thriller about the investigation of a missing girl.', 'dragon_tattoo.jpg', '2024-11-28 06:07:59', '2024-11-28 06:07:59'),
(41, 'Gone Girl', 'Gillian Flynn', 6, '2012-05-24', 'A psychological thriller about the disappearance of a woman.', 'gone_girl.jpg', '2024-11-28 06:07:59', '2024-11-28 06:07:59'),
(42, 'Shutter Island', 'Dennis Lehane', 7, '2003-02-01', 'A psychological mystery about a detective investigating the disappearance of a patient from a mental institution.', 'shutter_island.jpg', '2024-11-28 06:07:59', '2024-11-28 06:07:59'),
(43, 'The Secret History', 'Donna Tartt', 7, '1992-09-01', 'A mystery novel about a group of elite students who commit a murder.', 'secret_history.jpg', '2024-11-28 06:07:59', '2024-11-28 06:07:59'),
(44, 'Pride and Prejudice', 'Jane Austen', 8, '1813-01-28', 'A romantic novel about the life of Elizabeth Bennet.', 'pride_prejudice.jpg', '2024-11-28 06:07:59', '2024-11-28 06:07:59'),
(45, 'The Fault in Our Stars', 'John Green', 8, '2012-01-10', 'A romance novel about two teenagers battling cancer.', 'fault_in_our_stars.jpg', '2024-11-28 06:07:59', '2024-11-28 06:07:59'),
(46, 'The Power of Habit', 'Charles Duhigg', 9, '2012-02-28', 'A self-help book on the science of habits and how to change them.', 'power_of_habit.jpg', '2024-11-28 06:07:59', '2024-11-28 06:07:59'),
(47, 'Atomic Habits', 'James Clear', 9, '2018-10-16', 'A guide to building good habits and breaking bad ones.', 'atomic_habits.jpg', '2024-11-28 06:07:59', '2024-11-28 06:07:59'),
(48, 'Dracula', 'Bram Stoker', 10, '1897-05-26', 'A horror novel about the vampire Count Dracula and his attempt to move from Transylvania to England.', 'dracula.jpg', '2024-11-28 06:07:59', '2024-11-28 06:07:59'),
(49, 'Frankenstein', 'Mary Shelley', 10, '1818-01-01', 'A gothic horror novel about the creation of a monster.', 'frankenstein.jpg', '2024-11-28 06:07:59', '2024-11-28 06:07:59'),
(50, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 11, '2011-01-01', 'A historical exploration of humanity\'s origins and evolution.', 'sapiens.jpg', '2024-11-28 06:07:59', '2024-11-28 06:07:59'),
(51, 'The Diary of a Young Girl', 'Anne Frank', 11, '1947-06-25', 'The writings of Anne Frank during her time in hiding during WWII.  ', 'diary_anne.jpg', '2024-11-28 06:07:59', '2024-12-03 15:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `book_id` int NOT NULL,
  `user_id` int NOT NULL,
  `content` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `moderated` tinyint(1) DEFAULT '0',
  `moderated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Science Fiction', '2024-11-28 05:57:06', '2024-11-28 05:57:06'),
(2, 'Fantasy', '2024-11-28 05:57:06', '2024-11-28 05:57:06'),
(3, 'History', '2024-11-28 05:57:06', '2024-11-28 05:57:06'),
(4, 'Biography', '2024-11-28 05:57:06', '2024-11-28 05:57:06'),
(5, 'Thriller', '2024-11-28 05:57:06', '2024-11-28 05:57:06'),
(6, 'Science Fiction', '2024-11-28 06:04:51', '2024-11-28 06:04:51'),
(7, 'Fantasy', '2024-11-28 06:04:51', '2024-11-28 06:04:51'),
(8, 'History', '2024-11-28 06:04:51', '2024-11-28 06:04:51'),
(9, 'Biography', '2024-11-28 06:04:51', '2024-11-28 06:04:51'),
(10, 'Thriller', '2024-11-28 06:04:51', '2024-11-28 06:04:51'),
(11, 'Mystery', '2024-11-28 06:04:51', '2024-11-28 06:04:51'),
(12, 'Romance', '2024-11-28 06:04:51', '2024-11-28 06:04:51'),
(13, 'Self-Help', '2024-11-28 06:04:51', '2024-11-28 06:04:51'),
(14, 'Horror', '2024-11-28 06:04:51', '2024-11-28 06:04:51'),
(15, 'Non-Fiction', '2024-11-28 06:04:51', '2024-11-28 06:04:51'),
(16, 'Comics', '2024-11-29 04:52:29', '2024-11-29 04:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin123', 'admin', '2024-11-29 06:32:32', '2024-11-29 06:32:32'),
(2, 'nevil', 'nevil', 'user', '2024-11-29 06:32:32', '2024-11-29 06:32:32'),
(3, 'heet', 'heet123', 'user', '2024-11-29 06:32:32', '2024-11-29 06:32:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `moderated_by` (`moderated_by`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`moderated_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
