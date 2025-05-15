-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 15 maj 2025 kl 23:04
-- Serverversion: 10.4.32-MariaDB
-- PHP-version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `forum`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `inlägg`
--

CREATE TABLE `inlägg` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `comment` varchar(255) NOT NULL,
  `user` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `topic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `inlägg`
--

INSERT INTO `inlägg` (`id`, `created_at`, `comment`, `user`, `name`, `topic`) VALUES
(12, '2025-05-15 22:55:42', 'Jag ska ha en ananas', 'ananas', 'ananas', 'Ananas');

-- --------------------------------------------------------

--
-- Tabellstruktur `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `topics`
--

INSERT INTO `topics` (`id`, `title`, `username`, `name`, `created_at`) VALUES
(14, 'ost', 'ost', 'ost', '2025-05-15 13:42:00'),
(18, 'Ananas', 'ananas', 'ananas', '2025-05-15 22:53:48');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password_hash`, `created_at`) VALUES
(10, 'sa', 'sa', '$2y$10$g7mkh4gqqrABrBdwmGig7OUQSwQxAjv/fUKZUezfIJWmYz78tn5Bi', '2025-05-14 19:22:47'),
(11, 'ost', 'ost', '$2y$10$NxW1ZLZAXSOabVrnS.mQm.8HdKMEx.JSHL4lL4jeevUmFPURrVQD.', '2025-05-14 19:30:54'),
(13, 'kiwi', 'kiwi', '$2y$10$ByjsQCr1s/auEZmJ3d2ifenwkeOQSn3bnRaihQs7lXDh7tFQ8r8QG', '2025-05-15 22:52:44'),
(15, 'ananas', 'ananas', '$2y$10$Er9IaqHnpKsWr0DDegjCi.Naf3ffHwNhgMfPB/7TyWB7OhTqeBvjC', '2025-05-15 22:53:31');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `inlägg`
--
ALTER TABLE `inlägg`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `inlägg`
--
ALTER TABLE `inlägg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT för tabell `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
